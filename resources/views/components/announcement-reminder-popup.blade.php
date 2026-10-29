<!-- Announcement Reminder Notification Popup Component with BRImo AI Sound (Vanilla JS for guaranteed rendering) -->
<script src="{{ asset('js/brimo-ai-audio.js') }}"></script>

<div id="announcement-popup-container" class="fixed bottom-4 inset-x-4 sm:left-auto sm:right-5 sm:bottom-5 sm:w-full sm:max-w-md z-[99999] hidden">
    <div class="bg-[#003527] text-white border-4 border-black p-5 rounded-2xl shadow-[8px_8px_0_0_#000] relative overflow-hidden">
        <!-- Decorative Glow Accent -->
        <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#FFDE00]/20 rounded-full blur-xl pointer-events-none"></div>

        <!-- Header -->
        <div class="flex items-center justify-between gap-2 border-b-2 border-emerald-700/60 pb-3 mb-3">
            <div class="flex items-center gap-2">
                <span id="popup-badge" class="bg-[#FFDE00] text-black px-2.5 py-1 rounded-lg border-2 border-black font-black text-xs uppercase flex items-center gap-1 shadow-[2px_2px_0_0_#000]">
                    🔄 HARIAN
                </span>
                <span id="popup-time" class="text-[10px] text-emerald-300 font-bold"></span>
            </div>

            <button id="popup-close-btn" type="button" class="bg-red-500 text-white w-7 h-7 rounded-lg border-2 border-black font-black text-xs hover:bg-red-600 active:scale-95 transition-all flex items-center justify-center shadow-[2px_2px_0_0_#000] cursor-pointer">
                ✕
            </button>
        </div>

        <!-- Content -->
        <div class="space-y-2">
            <p id="popup-message" class="text-sm font-extrabold text-emerald-50 leading-relaxed"></p>
        </div>

        <!-- Footer / Action -->
        <div class="mt-4 flex items-center justify-between pt-2 border-t border-emerald-800/80">
            <button id="popup-sound-btn" type="button" class="bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-black px-3 py-1.5 rounded-lg border-2 border-black flex items-center gap-1.5 transition-all shadow-[2px_2px_0_0_#000] cursor-pointer">
                <span class="material-symbols-outlined text-sm">volume_up</span> Putar Suara
            </button>

            <button id="popup-dismiss-btn" type="button" class="bg-[#39FF14] text-black text-xs font-black px-4 py-1.5 rounded-lg border-2 border-black uppercase shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all cursor-pointer">
                Saya Paham
            </button>
        </div>
    </div>
</div>

<script>
(function() {
    let pendingReminders = [];
    let activeReminder = null;

    function getTodayKey() {
        const d = new Date();
        return `seen_daily_${d.getFullYear()}_${d.getMonth() + 1}_${d.getDate()}`;
    }

    async function loadReminders() {
        try {
            const res = await fetch('{{ route("announcements.active-reminders") }}');
            if (!res.ok) return;
            const data = await res.json();

            if (data.status === 'success' && data.announcements && data.announcements.length > 0) {
                const seenOnceIds = JSON.parse(localStorage.getItem('seen_announcement_ids') || '[]');
                const todayKey = getTodayKey();
                const seenDailyIds = JSON.parse(localStorage.getItem(todayKey) || '[]');

                const unseen = data.announcements.filter(a => {
                    if (a.repeat_type === 'daily') {
                        return !seenDailyIds.includes(a.id);
                    } else {
                        return !seenOnceIds.includes(a.id);
                    }
                });

                if (unseen.length > 0) {
                    pendingReminders = unseen;
                    showNextReminder();
                }
            }
        } catch (e) {
            console.error('[Popup] Failed to load reminders:', e);
        }
    }

    function showNextReminder() {
        const container = document.getElementById('announcement-popup-container');
        if (!container) return;

        if (pendingReminders.length === 0) {
            activeReminder = null;
            container.classList.add('hidden');
            return;
        }

        activeReminder = pendingReminders.shift();

        const badge = document.getElementById('popup-badge');
        const timeEl = document.getElementById('popup-time');
        const msgEl = document.getElementById('popup-message');

        if (badge) badge.textContent = activeReminder.repeat_type === 'daily' ? '🔄 HARIAN' : '🔔 PENGINGAT';
        if (timeEl) timeEl.textContent = activeReminder.created_at || '';
        if (msgEl) msgEl.textContent = activeReminder.message || '';

        container.classList.remove('hidden');

        // Play sound automatically
        playSound();
    }

    function playSound() {
        if (activeReminder && window.BrimoAudio) {
            window.BrimoAudio.playSound(activeReminder.sound_type || 'brimo_ai');
        }
    }

    function dismissReminder() {
        if (activeReminder) {
            if (activeReminder.repeat_type === 'daily') {
                const todayKey = getTodayKey();
                const seenDailyIds = JSON.parse(localStorage.getItem(todayKey) || '[]');
                if (!seenDailyIds.includes(activeReminder.id)) {
                    seenDailyIds.push(activeReminder.id);
                    localStorage.setItem(todayKey, JSON.stringify(seenDailyIds));
                }
            } else {
                const seenOnceIds = JSON.parse(localStorage.getItem('seen_announcement_ids') || '[]');
                if (!seenOnceIds.includes(activeReminder.id)) {
                    seenOnceIds.push(activeReminder.id);
                    localStorage.setItem('seen_announcement_ids', JSON.stringify(seenOnceIds));
                }
            }
        }
        showNextReminder();
    }

    function initPopup() {
        const closeBtn = document.getElementById('popup-close-btn');
        const dismissBtn = document.getElementById('popup-dismiss-btn');
        const soundBtn = document.getElementById('popup-sound-btn');

        if (closeBtn) closeBtn.onclick = dismissReminder;
        if (dismissBtn) dismissBtn.onclick = dismissReminder;
        if (soundBtn) soundBtn.onclick = playSound;

        loadReminders();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initPopup);
    } else {
        setTimeout(initPopup, 200);
    }
})();
</script>
