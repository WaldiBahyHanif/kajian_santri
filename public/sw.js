// === Daaru Hiraa Service Worker ===
// Version: bump this whenever you push an update
const CACHE_VERSION = 'kajian-santri-v1';

// Assets to cache on install (App Shell)
const STATIC_ASSETS = [
    '/',
    '/dashboard',
    '/kajian',
    '/zikir',
    '/rekap',
    '/offline',
    '/manifest.json',
    '/icons/icon-192.png',
    '/icons/icon-512.png',
    // External CDN resources
    'https://cdn.tailwindcss.com',
    'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700;800;900&family=Inter:wght@400;500;600;700&display=swap',
    'https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap',
];

// =========================================================
// INSTALL: Pre-cache the app shell
// =========================================================
self.addEventListener('install', (event) => {
    console.log('[SW] Installing Service Worker v1...');
    event.waitUntil(
        caches.open(CACHE_VERSION).then((cache) => {
            // Cache static assets — ignore failures for external CDN
            return Promise.allSettled(
                STATIC_ASSETS.map(url =>
                    cache.add(url).catch(err => console.warn('[SW] Failed to cache:', url, err))
                )
            );
        }).then(() => {
            console.log('[SW] App shell cached.');
            return self.skipWaiting(); // Activate immediately
        })
    );
});

// =========================================================
// ACTIVATE: Clean up old caches
// =========================================================
self.addEventListener('activate', (event) => {
    console.log('[SW] Activating...');
    event.waitUntil(
        caches.keys().then((keys) =>
            Promise.all(
                keys
                    .filter(key => key !== CACHE_VERSION)
                    .map(key => {
                        console.log('[SW] Deleting old cache:', key);
                        return caches.delete(key);
                    })
            )
        ).then(() => self.clients.claim())
    );
});

// =========================================================
// FETCH: Stale-While-Revalidate strategy
// - Serve from cache instantly, then update in background
// - For navigation: Network-first with offline fallback
// =========================================================
self.addEventListener('fetch', (event) => {
    const { request } = event;
    const url = new URL(request.url);

    // Skip non-GET requests and admin routes
    if (request.method !== 'GET') return;
    if (url.pathname.startsWith('/admin')) return;
    if (url.pathname.startsWith('/sanctum')) return;

    // === Navigation requests (HTML pages) ===
    // Network-first → serve offline page if no network & no cache
    if (request.mode === 'navigate') {
        event.respondWith(
            fetch(request)
                .then(response => {
                    // Cache the fresh page
                    const clone = response.clone();
                    caches.open(CACHE_VERSION).then(cache => cache.put(request, clone));
                    return response;
                })
                .catch(() =>
                    caches.match(request).then(cached =>
                        cached || caches.match('/offline')
                    )
                )
        );
        return;
    }

    // === Static assets (JS, CSS, fonts, images) ===
    // Cache-first → minimal network overhead
    if (
        url.pathname.match(/\.(js|css|woff2?|ttf|otf|png|jpg|jpeg|svg|ico|webp)$/) ||
        url.hostname.includes('fonts.googleapis.com') ||
        url.hostname.includes('fonts.gstatic.com') ||
        url.hostname.includes('cdn.tailwindcss.com') ||
        url.hostname.includes('cdn.jsdelivr.net') ||
        url.hostname.includes('api.dicebear.com')
    ) {
        event.respondWith(
            caches.match(request).then(cached => {
                if (cached) return cached;
                return fetch(request).then(response => {
                    if (response.ok) {
                        const clone = response.clone();
                        caches.open(CACHE_VERSION).then(cache => cache.put(request, clone));
                    }
                    return response;
                });
            })
        );
        return;
    }

    // === API/dynamic requests ===
    // Network-first (always fresh data for attendance, mood, etc.)
    event.respondWith(
        fetch(request)
            .then(response => {
                if (response.ok) {
                    const clone = response.clone();
                    caches.open(CACHE_VERSION).then(cache => cache.put(request, clone));
                }
                return response;
            })
            .catch(() => caches.match(request))
    );
});

// =========================================================
// PUSH NOTIFICATIONS (future-ready)
// =========================================================
self.addEventListener('push', (event) => {
    if (!event.data) return;
    const data = event.data.json();
    event.waitUntil(
        self.registration.showNotification(data.title || 'Daaru Hiraa', {
            body: data.body || 'Ada pengumuman baru dari pondok.',
            icon: '/icons/icon-192.png',
            badge: '/icons/icon-72.png',
            vibrate: [200, 100, 200],
            data: { url: data.url || '/dashboard' },
            actions: [
                { action: 'open', title: '📖 Buka' },
                { action: 'close', title: '✕ Tutup' },
            ]
        })
    );
});

self.addEventListener('notificationclick', (event) => {
    event.notification.close();
    if (event.action === 'open' || !event.action) {
        const targetUrl = event.notification.data?.url || '/dashboard';
        event.waitUntil(
            clients.matchAll({ type: 'window' }).then(clientList => {
                const existing = clientList.find(c => c.url.includes(targetUrl) && 'focus' in c);
                if (existing) return existing.focus();
                return clients.openWindow(targetUrl);
            })
        );
    }
});
