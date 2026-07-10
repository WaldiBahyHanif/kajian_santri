<x-admin-layout title="Asisten AI Admin" active="ai-assistant">
    <div class="max-w-4xl mx-auto flex flex-col h-[calc(100vh-12rem)] min-h-[500px]">
        
        <!-- Header & Action Bar -->
        <div class="bg-white border-4 border-black p-4 rounded-t-lg border-b-0 flex items-center justify-between shadow-[4px_0_0_0_#000]">
            <div class="flex items-center gap-3">
                <div class="w-10 h-10 rounded-lg border-2 border-black bg-violet-300 flex items-center justify-center font-black text-xl shadow-[2px_2px_0_0_#000]">🤖</div>
                <div>
                    <h3 class="font-black text-sm uppercase tracking-tight text-black dark:text-white">🤖 Asisten AI Admin</h3>
                    <p class="text-[10px] text-gray-500 font-bold uppercase mt-0.5">Asisten Administratif Otomatis</p>
                </div>
            </div>
            @if(count($history) > 0)
                <form action="{{ route('admin.ai.assistant.clear') }}" method="POST" onsubmit="return confirm('Hapus seluruh riwayat obrolan dengan asisten AI?')">
                    @csrf
                    <button type="submit" class="bg-red-400 text-black border-2 border-black px-3 py-1.5 font-black text-xs shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center gap-1 cursor-pointer">
                        <span class="material-symbols-outlined text-sm">delete</span> RESET CHAT
                    </button>
                </form>
            @endif
        </div>

        <!-- Chat Pane -->
        <div id="admin-chat-messages-pane" class="flex-grow bg-white border-4 border-black p-6 overflow-y-auto space-y-4 shadow-[4px_4px_0_0_#000] flex flex-col">
            <!-- Welcome message -->
            <div class="flex gap-3 max-w-[90%] self-start">
                <div class="shrink-0">
                    <div class="w-8 h-8 rounded-lg border-2 border-black bg-violet-300 flex items-center justify-center font-black text-sm shadow-[1px_1px_0_0_#000]">🤖</div>
                </div>
                <div class="bg-gray-50 dark:bg-zinc-800 text-black dark:text-white border-2 border-black rounded-2xl rounded-tl-none px-4 py-3 text-sm shadow-[2px_2px_0_0_#000]">
                    <p class="text-xs md:text-sm font-bold mb-2">
                        Assalamualaikum! Saya <strong>Asisten AI Admin Daaru Hiraa</strong> dengan akses penuh ke seluruh data pondok secara <em>realtime</em>. Saya bisa membantu:
                    </p>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-1 text-xs font-medium opacity-90">
                        <div>📋 <strong>Perizinan</strong> — lihat, setujui, tolak izin pending</div>
                        <div>📢 <strong>Pengumuman</strong> — buat & hapus pengumuman</div>
                        <div>✅ <strong>Absensi Santri</strong> — catat & hapus absen kajian massal</div>
                        <div>🕌 <strong>Absensi Ustadz</strong> — catat kehadiran ustadz</div>
                        <div>🎓 <strong>Data Santri</strong> — tambah, edit (incl. universitas & angkatan), hapus, reset password</div>
                        <div>👳 <strong>Data Ustadz</strong> — tambah, edit, hapus asatiz</div>
                        <div>📖 <strong>Jadwal Kajian</strong> — buat, ubah, batalkan kajian</div>
                        <div>🚨 <strong>Surat Peringatan (SP)</strong> — keluarkan & hapus SP</div>
                        <div>📅 <strong>Kegiatan/Event</strong> — jadwalkan kegiatan pondok</div>
                        <div>📊 <strong>Statistik</strong> — ringkasan data lengkap pondok</div>
                    </div>
                    <p class="mt-2 text-[10px] opacity-70 font-bold">Contoh: "Setujui semua izin pending" · "Catat absen hari ini semua hadir kecuali Ahmad Alpha" · "Tambah santri baru Ahmad dari UGM angkatan 2023"</p>
                </div>
            </div>


            <!-- Loop History -->
            @foreach($history as $msg)
                @php
                    $isUser = $msg['role'] === 'user';
                    $message = $msg['message'];
                    
                    // Parse thinking if present
                    $thinkingHtml = '';
                    if (strpos($message, '<thinking>') !== false && strpos($message, '</thinking>') !== false) {
                        $startIdx = strpos($message, '<thinking>') + 10;
                        $endIdx = strpos($message, '</thinking>');
                        $thinkingText = trim(substr($message, $startIdx, $endIdx - $startIdx));
                        $message = trim(substr($message, $endIdx + 11));
                        
                        if ($thinkingText) {
                            $formattedThinking = nl2br(e($thinkingText));
                            $thinkingHtml = '
                                <details class="mb-3 border-2 border-black rounded-lg overflow-hidden bg-zinc-50 dark:bg-zinc-900 group">
                                    <summary class="flex justify-between items-center px-3 py-2 text-[10px] font-black uppercase bg-zinc-200 dark:bg-zinc-800 cursor-pointer select-none border-b-2 border-black">
                                        <span class="flex items-center gap-1.5 text-zinc-600 dark:text-zinc-400">
                                            <span class="material-symbols-outlined text-xs animate-pulse">psychology</span>
                                            Analisis Pemikiran AI
                                        </span>
                                        <span class="material-symbols-outlined text-xs transition-transform duration-200 group-open:rotate-180">expand_more</span>
                                    </summary>
                                    <div class="p-3 text-[10px] text-zinc-500 dark:text-zinc-400 leading-relaxed font-mono max-h-40 overflow-y-auto select-text break-words">
                                        ' . $formattedThinking . '
                                    </div>
                                </details>
                            ';
                        }
                    }
                @endphp

                <div class="flex gap-3 max-w-[85%] {{ $isUser ? 'self-end flex-row-reverse' : 'self-start' }}">
                    <div class="shrink-0 flex items-start">
                        @if($isUser)
                            <div class="w-8 h-8 rounded-lg border-2 border-black bg-cyan-300 flex items-center justify-center font-black text-xs shadow-[1px_1px_0_0_#000]">AD</div>
                        @else
                            <div class="w-8 h-8 rounded-lg border-2 border-black bg-violet-300 flex items-center justify-center font-black text-sm shadow-[1px_1px_0_0_#000]">🤖</div>
                        @endif
                    </div>
                    <div class="{{ $isUser ? 'bg-black text-white dark:bg-white dark:text-black' : 'bg-gray-50 dark:bg-zinc-800 text-black dark:text-white' }} border-2 border-black rounded-2xl {{ $isUser ? 'rounded-tr-none' : 'rounded-tl-none' }} px-4 py-3 text-sm font-bold shadow-[2px_2px_0_0_#000]">
                        {!! $thinkingHtml !!}
                        <p class="leading-relaxed text-xs md:text-sm text-left break-words font-bold select-text">{!! nl2br(e($message)) !!}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Input Box -->
        <div class="bg-white border-4 border-black p-4 rounded-b-lg border-t-0 shadow-[4px_4px_0_0_#000] flex gap-3 items-center">
            <textarea id="admin-chat-message-input" rows="1" class="flex-grow border-4 border-black rounded-lg px-4 py-3 font-bold text-sm bg-white dark:bg-zinc-700 dark:text-white focus:ring-0 resize-none overflow-hidden max-h-24" placeholder="Ketik perintah administrasi Anda di sini..."></textarea>
            <button id="admin-mic-btn" onclick="toggleAdminSpeechRecognition()" class="bg-yellow-300 text-black border-4 border-black p-3 font-black shadow-[3px_3px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all flex items-center justify-center cursor-pointer shrink-0" title="Input Suara (Speech to Text)">
                <span id="admin-mic-icon" class="material-symbols-outlined text-xl">mic</span>
            </button>
            <button id="admin-chat-send-btn" onclick="sendAdminAIChatMessage()" class="bg-black dark:bg-white text-white dark:text-black border-4 border-black px-5 py-3 font-black shadow-[3px_3px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm flex items-center gap-2 cursor-pointer h-full shrink-0">
                KIRIM <span class="material-symbols-outlined text-sm">send</span>
            </button>
        </div>

    </div>

    <!-- Styles and Scripts -->
    <script>
        const inputArea = document.getElementById('admin-chat-message-input');
        const messagesPane = document.getElementById('admin-chat-messages-pane');
        const sendBtn = document.getElementById('admin-chat-send-btn');

        // Speech Recognition for Admin AI Chat
        let adminRecognition = null;
        let isAdminListening = false;

        function initAdminSpeechRecognition() {
            const SpeechRecognition = window.SpeechRecognition || window.webkitSpeechRecognition;
            if (!SpeechRecognition) {
                console.warn('Speech recognition not supported in this browser.');
                const micBtn = document.getElementById('admin-mic-btn');
                if (micBtn) micBtn.style.display = 'none';
                return null;
            }

            const rec = new SpeechRecognition();
            rec.lang = 'id-ID';
            rec.continuous = false;
            rec.interimResults = false;

            rec.onstart = function() {
                isAdminListening = true;
                const micIcon = document.getElementById('admin-mic-icon');
                const micBtn = document.getElementById('admin-mic-btn');
                if (micIcon) micIcon.innerText = 'settings_voice';
                if (micBtn) {
                    micBtn.classList.remove('bg-yellow-300');
                    micBtn.classList.add('bg-red-400', 'animate-pulse');
                }
                if (inputArea) inputArea.placeholder = 'Mendengarkan suara Anda...';
            };

            rec.onend = function() {
                isAdminListening = false;
                const micIcon = document.getElementById('admin-mic-icon');
                const micBtn = document.getElementById('admin-mic-btn');
                if (micIcon) micIcon.innerText = 'mic';
                if (micBtn) {
                    micBtn.classList.remove('bg-red-400', 'animate-pulse');
                    micBtn.classList.add('bg-yellow-300');
                }
                if (inputArea) inputArea.placeholder = 'Ketik perintah administrasi Anda di sini...';
            };

            rec.onresult = function(event) {
                const text = event.results[0][0].transcript.trim();
                if (inputArea && text) {
                    inputArea.value = text;
                    inputArea.dispatchEvent(new Event('input'));
                    sendAdminAIChatMessage();
                }
            };

            rec.onerror = function(event) {
                console.error('Speech recognition error:', event.error);
            };

            return rec;
        }

        function toggleAdminSpeechRecognition() {
            if (!adminRecognition) {
                adminRecognition = initAdminSpeechRecognition();
            }
            if (!adminRecognition) return;

            if (isAdminListening) {
                adminRecognition.stop();
            } else {
                try {
                    adminRecognition.start();
                } catch (e) {
                    console.error(e);
                }
            }
        }

        // Auto-expand input height
        if (inputArea) {
            inputArea.addEventListener('input', function() {
                this.style.height = 'auto';
                this.style.height = (this.scrollHeight) + 'px';
            });
            inputArea.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' && !e.shiftKey) {
                    e.preventDefault();
                    sendAdminAIChatMessage();
                }
            });
        }

        // Scroll to bottom on load
        scrollAdminChatToBottom();

        function scrollAdminChatToBottom() {
            if (messagesPane) {
                messagesPane.scrollTop = messagesPane.scrollHeight;
            }
        }

        function appendAdminMessageBubble(role, message) {
            if (!messagesPane) return;

            const bubble = document.createElement('div');
            bubble.className = `flex gap-3 max-w-[85%] ${role === 'user' ? 'self-end flex-row-reverse' : 'self-start'}`;

            const avatarHtml = role === 'user'
                ? `<div class="w-8 h-8 rounded-lg border-2 border-black bg-cyan-300 flex items-center justify-center font-black text-xs shadow-[1px_1px_0_0_#000]">AD</div>`
                : `<div class="w-8 h-8 rounded-lg border-2 border-black bg-violet-300 flex items-center justify-center font-black text-sm shadow-[1px_1px_0_0_#000]">🤖</div>`;

            let thinkingHtml = '';
            if (message.includes('<thinking>') && message.includes('</thinking>')) {
                const startIdx = message.indexOf('<thinking>') + 10;
                const endIdx = message.indexOf('</thinking>');
                const thinkingText = message.substring(startIdx, endIdx).trim();
                message = message.substring(endIdx + 11).trim();

                if (thinkingText) {
                    let formattedThinking = thinkingText
                        .replace(/\n/g, '<br>');

                    thinkingHtml = `
                        <details class="mb-3 border-2 border-black rounded-lg overflow-hidden bg-zinc-50 dark:bg-zinc-900 group">
                            <summary class="flex justify-between items-center px-3 py-2 text-[10px] font-black uppercase bg-zinc-200 dark:bg-zinc-800 cursor-pointer select-none border-b-2 border-black">
                                <span class="flex items-center gap-1.5 text-zinc-600 dark:text-zinc-400">
                                    <span class="material-symbols-outlined text-xs animate-pulse">psychology</span>
                                    Analisis Pemikiran AI
                                </span>
                                <span class="material-symbols-outlined text-xs transition-transform duration-200 group-open:rotate-180">expand_more</span>
                            </summary>
                            <div class="p-3 text-[10px] text-zinc-500 dark:text-zinc-400 leading-relaxed font-mono max-h-40 overflow-y-auto select-text break-words">
                                ${formattedThinking}
                            </div>
                        </details>
                    `;
                }
            }

            let formattedText = message
                .replace(/\*\*(.*?)\*\*/g, '<strong>$1</strong>')
                .replace(/\*(.*?)\*/g, '<em>$1</em>')
                .replace(/\n/g, '<br>');

            const contentClass = role === 'user'
                ? 'bg-black text-white dark:bg-white dark:text-black border-2 border-black rounded-2xl rounded-tr-none px-4 py-3 text-sm font-bold shadow-[2px_2px_0_0_#000]'
                : 'bg-gray-50 dark:bg-zinc-800 text-black dark:text-white border-2 border-black rounded-2xl rounded-tl-none px-4 py-3 text-sm font-bold shadow-[2px_2px_0_0_#000]';

            bubble.innerHTML = `
                <div class="shrink-0 flex items-start">
                    ${avatarHtml}
                </div>
                <div class="${contentClass} min-w-0">
                    ${thinkingHtml}
                    <p class="leading-relaxed text-xs md:text-sm text-left break-words font-bold select-text">${formattedText}</p>
                </div>
            `;

            messagesPane.appendChild(bubble);
        }

        function sendAdminAIChatMessage() {
            if (!inputArea || !sendBtn) return;

            const text = inputArea.value.trim();
            if (!text) return;

            // Clear and disable input
            inputArea.value = '';
            inputArea.style.height = 'auto';
            inputArea.disabled = true;
            sendBtn.disabled = true;

            // Append user bubble
            appendAdminMessageBubble('user', text);
            scrollAdminChatToBottom();

            // Append typing indicator
            const typingIndicator = document.createElement('div');
            typingIndicator.id = 'admin-ai-typing-indicator';
            typingIndicator.className = 'flex gap-3 max-w-[85%] self-start';
            typingIndicator.innerHTML = `
                <div class="shrink-0">
                    <div class="w-8 h-8 rounded-lg border-2 border-black bg-violet-300 flex items-center justify-center font-black text-sm shadow-[1px_1px_0_0_#000]">🤖</div>
                </div>
                <div class="bg-gray-50 dark:bg-zinc-800 text-black dark:text-white border-2 border-black rounded-2xl rounded-tl-none px-4 py-3 text-sm font-bold shadow-[2px_2px_0_0_#000] animate-pulse">
                    <span>Sedang memproses perintah...</span>
                </div>
            `;
            messagesPane.appendChild(typingIndicator);
            scrollAdminChatToBottom();

            // POST to server — gunakan AbortController agar browser tidak timeout duluan
            const controller = new AbortController();
            const timeoutId = setTimeout(() => controller.abort(), 180000); // 3 menit

            fetch('{{ route("admin.ai.assistant.chat") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({
                    message: text
                }),
                signal: controller.signal
            })
            .then(res => {
                clearTimeout(timeoutId);
                if (!res.ok) throw new Error(`HTTP ${res.status}`);
                return res.json();
            })
            .then(data => {
                const indicator = document.getElementById('admin-ai-typing-indicator');
                if (indicator) indicator.remove();

                inputArea.disabled = false;
                sendBtn.disabled = false;
                inputArea.focus();

                if (data.success) {
                    appendAdminMessageBubble('assistant', data.message);
                } else {
                    appendAdminMessageBubble('assistant', 'Gagal memproses pesan Anda. Silakan coba kembali.');
                }
                scrollAdminChatToBottom();
            })
            .catch(err => {
                clearTimeout(timeoutId);
                const indicator = document.getElementById('admin-ai-typing-indicator');
                if (indicator) indicator.remove();

                inputArea.disabled = false;
                sendBtn.disabled = false;

                const msg = err.name === 'AbortError'
                    ? 'Permintaan timeout (>3 menit). AI mungkin sedang sibuk, coba lagi.'
                    : `Terjadi gangguan jaringan atau kegagalan server. (${err.message})`;
                appendAdminMessageBubble('assistant', msg);
                scrollAdminChatToBottom();
            });
        }
    </script>
</x-admin-layout>
