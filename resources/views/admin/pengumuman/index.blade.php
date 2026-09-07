<x-admin-layout title="Pengumuman" active="pengumuman">

    <!-- Include Audio Module -->
    <script src="{{ asset('js/brimo-ai-audio.js') }}"></script>

    <!-- Form Tambah -->
    <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
            <span class="material-symbols-outlined text-[#FFDE00]">campaign</span> Buat Pengumuman & Pengingat
        </h3>
        <form action="{{ route('admin.pengumuman.store') }}" method="POST" class="space-y-4">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                <textarea name="message" placeholder="Isi pengumuman..." class="border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm md:col-span-2" rows="3" required></textarea>
                
                <div>
                    <label class="block font-black uppercase text-xs mb-1">Target Santri</label>
                    <select name="target_student_id" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm">
                        <option value="">-- Untuk Semua Santri --</option>
                        @foreach($students as $s)
                            <option value="{{ $s->id }}">{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block font-black uppercase text-xs mb-1">Status Publikasi</label>
                    <div class="flex items-center gap-3 border-4 border-black p-2 rounded-lg bg-gray-50 h-[46px]">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" checked class="w-5 h-5 border-2 border-black rounded">
                            <span class="font-black text-sm uppercase">Aktifkan Langsung</span>
                        </label>
                    </div>
                </div>

                <!-- Pengingat & Suara Notifikasi (BRImo AI Style) -->
                <div class="md:col-span-2 bg-emerald-50 border-4 border-black p-4 rounded-xl space-y-3">
                    <div class="flex flex-wrap items-center justify-between gap-2 border-b-2 border-black pb-2">
                        <label class="flex items-center gap-2 cursor-pointer font-black text-sm uppercase text-emerald-900">
                            <input type="hidden" name="is_reminder" value="0">
                            <input type="checkbox" name="is_reminder" value="1" id="create_is_reminder" checked class="w-5 h-5 border-2 border-black rounded accent-emerald-600">
                            <span>🔔 Notifikasi Pengingat (Reminder)</span>
                        </label>

                        <button type="button" 
                                onclick="const st = document.getElementById('sound_type_select').value; if(window.BrimoAudio) BrimoAudio.playSound(st);" 
                                class="bg-[#FFDE00] text-black px-3 py-1 font-black rounded-lg border-2 border-black text-xs uppercase shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all flex items-center gap-1">
                            <span class="material-symbols-outlined text-sm">volume_up</span> Tes Suara Notifikasi
                        </button>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pt-1">
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Tanggal & Waktu Pengingat (Opsional)</label>
                            <input type="datetime-local" name="scheduled_at" class="w-full border-4 border-black p-2 rounded-lg font-bold text-sm bg-white">
                            <span class="text-[10px] text-gray-500 font-bold block mt-0.5">* Biarkan kosong jika pengingat ingin langsung aktif saat ini.</span>
                        </div>

                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Suara Notifikasi AI</label>
                            <select name="sound_type" id="sound_type_select" class="w-full border-4 border-black p-2 rounded-lg font-bold text-sm bg-white">
                                <option value="brimo_ai" selected>🔊 BRImo AI Chime (Khas Futuristic)</option>
                                <option value="futuristic_synth">⚡ Futuristic Synth Pulse</option>
                                <option value="classic_bell">🔔 Classic Bell Chime</option>
                                <option value="chime">🎵 Gentle Soft Chime</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2 flex justify-end">
                    <button type="submit" class="bg-black text-white px-8 py-3 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-base">send</span> Kirim Pengumuman
                    </button>
                </div>
            </div>
        </form>
    </div>

    <!-- Data List -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest flex items-center justify-between">
            <span>Daftar Pengumuman ({{ $announcements->count() }})</span>
        </div>

        <div x-data="{ editOpen: false, data: {} }">
            @forelse($announcements as $a)
            <div class="p-4 border-b-2 border-gray-200 hover:bg-yellow-50 transition-colors">
                <div class="flex justify-between items-start gap-3">
                    <div class="flex-1">
                        <div class="flex flex-wrap items-center gap-2 mb-2">
                            <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black {{ $a->is_active ? 'bg-[#39FF14]' : 'bg-gray-300' }}">
                                {{ $a->is_active ? 'AKTIF' : 'NONAKTIF' }}
                            </span>

                            @if($a->is_reminder)
                                <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black bg-purple-200 text-purple-900 flex items-center gap-1">
                                    <span>🔔</span> REMINDER
                                </span>
                            @endif

                            <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black bg-amber-200 text-amber-900">
                                🔊 {{ strtoupper(str_replace('_', ' ', $a->sound_type ?? 'brimo_ai')) }}
                            </span>

                            <span class="text-[10px] text-gray-400 font-bold">{{ $a->created_at?->diffForHumans() }}</span>
                            
                            <span class="text-[10px] px-2 py-0.5 bg-blue-100 border-2 border-black rounded font-black">
                                {{ $a->student?->name ?? 'Semua Santri' }}
                            </span>

                            @if($a->scheduled_at)
                                <span class="text-[10px] px-2 py-0.5 bg-cyan-100 border-2 border-black rounded font-black text-cyan-900">
                                    ⏰ {{ $a->scheduled_at->format('d/m/Y H:i') }}
                                </span>
                            @endif
                        </div>
                        <p class="text-sm font-bold">{{ $a->message }}</p>
                    </div>

                    <div class="flex gap-2 shrink-0">
                        <button type="button"
                                onclick="if(window.BrimoAudio) BrimoAudio.playSound('{{ $a->sound_type ?? 'brimo_ai' }}');"
                                title="Putar Suara Notifikasi"
                                class="bg-yellow-300 text-black px-2.5 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            🔊
                        </button>
                        <button type="button"
                            @click="data = { 
                                id: {{ $a->id }}, 
                                message: `{{ addslashes($a->message) }}`, 
                                target_student_id: '{{ $a->target_student_id ?? '' }}', 
                                is_active: {{ $a->is_active ? 'true' : 'false' }},
                                is_reminder: {{ $a->is_reminder ? 'true' : 'false' }},
                                scheduled_at: '{{ $a->scheduled_at ? $a->scheduled_at->format('Y-m-d\TH:i') : '' }}',
                                sound_type: '{{ $a->sound_type ?? 'brimo_ai' }}'
                            }; editOpen = true"
                            class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Edit
                        </button>
                        <form action="{{ route('admin.pengumuman.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus pengumuman ini?');" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                                Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-8 text-center text-gray-400 font-bold">Belum ada pengumuman.</div>
            @endforelse

            <!-- Edit Modal -->
            <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-lg shadow-[8px_8px_0_0_#000] relative max-h-[90vh] overflow-y-auto">
                    <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
                    <h2 class="text-2xl font-black mb-4 uppercase">Edit Pengumuman</h2>
                    <form :action="`/admin/pengumuman/${data.id}`" method="POST" class="space-y-3">
                        @csrf @method('PUT')
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Isi Pengumuman</label>
                            <textarea name="message" x-model="data.message" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm" rows="3" required></textarea>
                        </div>
                        <div>
                            <label class="block font-black uppercase text-xs mb-1">Target Santri</label>
                            <select name="target_student_id" x-model="data.target_student_id" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                                <option value="">-- Semua Santri --</option>
                                @foreach($students as $s)
                                    <option value="{{ $s->id }}">{{ $s->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Reminder Options in Edit Modal -->
                        <div class="bg-emerald-50 border-4 border-black p-3 rounded-lg space-y-2">
                            <div class="flex items-center justify-between">
                                <label class="flex items-center gap-2 cursor-pointer font-black text-xs uppercase text-emerald-900">
                                    <input type="hidden" name="is_reminder" value="0">
                                    <input type="checkbox" name="is_reminder" value="1" :checked="data.is_reminder" x-model="data.is_reminder" class="w-4 h-4 border-2 border-black rounded accent-emerald-600">
                                    <span>🔔 Notifikasi Pengingat</span>
                                </label>
                                <button type="button" 
                                        @click="if(window.BrimoAudio) BrimoAudio.playSound(data.sound_type);" 
                                        class="bg-[#FFDE00] text-black px-2 py-0.5 font-black rounded border-2 border-black text-[10px] uppercase shadow-[1px_1px_0_0_#000]">
                                    🔊 Tes Suara
                                </button>
                            </div>
                            <div>
                                <label class="block font-black uppercase text-[10px] mb-0.5">Tanggal & Waktu Pengingat</label>
                                <input type="datetime-local" name="scheduled_at" x-model="data.scheduled_at" class="w-full border-2 border-black p-1.5 rounded font-bold text-xs bg-white">
                            </div>
                            <div>
                                <label class="block font-black uppercase text-[10px] mb-0.5">Suara Notifikasi AI</label>
                                <select name="sound_type" x-model="data.sound_type" class="w-full border-2 border-black p-1.5 rounded font-bold text-xs bg-white">
                                    <option value="brimo_ai">🔊 BRImo AI Chime (Khas Futuristic)</option>
                                    <option value="futuristic_synth">⚡ Futuristic Synth Pulse</option>
                                    <option value="classic_bell">🔔 Classic Bell Chime</option>
                                    <option value="chime">🎵 Gentle Soft Chime</option>
                                </select>
                            </div>
                        </div>

                        <div class="flex items-center gap-2">
                            <input type="hidden" name="is_active" value="0">
                            <label class="flex items-center gap-2 cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" :checked="data.is_active" class="w-5 h-5 border-2 border-black rounded">
                                <span class="font-black text-sm uppercase">Aktif</span>
                            </label>
                        </div>
                        <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-3 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                            Simpan Perubahan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
