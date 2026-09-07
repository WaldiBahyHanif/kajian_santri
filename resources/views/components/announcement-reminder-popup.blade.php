<!-- Announcement Reminder Notification Popup Component with BRImo AI Sound -->
<script src="{{ asset('js/brimo-ai-audio.js') }}"></script>

<div x-data="announcementReminder()" x-init="initReminder()" x-cloak>
    <template x-if="currentReminder">
        <div class="fixed bottom-5 right-5 z-[9999] w-full max-w-md p-4 animate-bounce-short">
            <div class="bg-[#003527] text-white border-4 border-black p-5 rounded-2xl shadow-[8px_8px_0_0_#000] relative overflow-hidden">
                <!-- Decorative Glow Accent -->
                <div class="absolute -top-10 -right-10 w-24 h-24 bg-[#FFDE00]/20 rounded-full blur-xl pointer-events-none"></div>

                <!-- Header -->
                <div class="flex items-center justify-between gap-2 border-b-2 border-emerald-700/60 pb-3 mb-3">
                    <div class="flex items-center gap-2">
                        <span class="bg-[#FFDE00] text-black px-2.5 py-1 rounded-lg border-2 border-black font-black text-xs uppercase flex items-center gap-1 shadow-[2px_2px_0_0_#000]">
                            <span>🔔</span> PENGINGAT
                        </span>
                        <span class="text-[10px] text-emerald-300 font-bold" x-text="currentReminder.created_at"></span>
                    </div>

                    <button @click="dismissReminder()" class="bg-red-500 text-white w-7 h-7 rounded-lg border-2 border-black font-black text-xs hover:bg-red-600 active:scale-95 transition-all flex items-center justify-center shadow-[2px_2px_0_0_#000]">
                        ✕
                    </button>
                </div>

                <!-- Content -->
                <div class="space-y-2">
                    <p class="text-sm font-extrabold text-emerald-50 leading-relaxed" x-text="currentReminder.message"></p>
                </div>

                <!-- Footer / Action -->
                <div class="mt-4 flex items-center justify-between pt-2 border-t border-emerald-800/80">
                    <button @click="playSound()" class="bg-emerald-700 hover:bg-emerald-600 text-white text-xs font-black px-3 py-1.5 rounded-lg border-2 border-black flex items-center gap-1.5 transition-all shadow-[2px_2px_0_0_#000]">
                        <span class="material-symbols-outlined text-sm">volume_up</span> Putar Suara AI
                    </button>

                    <button @click="dismissReminder()" class="bg-[#39FF14] text-black text-xs font-black px-4 py-1.5 rounded-lg border-2 border-black uppercase shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Saya Paham
                    </button>
                </div>
            </div>
        </div>
    </template>
</div>

<script>
function announcementReminder() {
    return {
        reminders: [],
        currentReminder: null,

        async initReminder() {
            try {
                const res = await fetch('{{ route("announcements.active-reminders") }}');
                if (!res.ok) return;
                const data = await res.json();
                
                if (data.status === 'success' && data.announcements.length > 0) {
                    const seenIds = JSON.parse(localStorage.getItem('seen_announcement_ids') || '[]');
                    const unseen = data.announcements.filter(a => !seenIds.includes(a.id));
                    
                    if (unseen.length > 0) {
                        this.reminders = unseen;
                        this.showNextReminder();
                    }
                }
            } catch (e) {
                console.error('Failed to fetch announcement reminders:', e);
            }
        },

        showNextReminder() {
            if (this.reminders.length === 0) {
                this.currentReminder = null;
                return;
            }
            this.currentReminder = this.reminders.shift();
            
            // Play BRImo AI sound effect
            this.playSound();
        },

        playSound() {
            if (this.currentReminder && window.BrimoAudio) {
                window.BrimoAudio.playSound(this.currentReminder.sound_type || 'brimo_ai');
            }
        },

        dismissReminder() {
            if (this.currentReminder) {
                const seenIds = JSON.parse(localStorage.getItem('seen_announcement_ids') || '[]');
                if (!seenIds.includes(this.currentReminder.id)) {
                    seenIds.push(this.currentReminder.id);
                    localStorage.setItem('seen_announcement_ids', JSON.stringify(seenIds));
                }
            }
            this.showNextReminder();
        }
    };
}
</script>
