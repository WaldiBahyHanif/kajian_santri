<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black dark:text-white uppercase tracking-tight">📝 Ajukan Izin / Cuti</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <form method="POST" action="{{ route('izin.store') }}" class="bg-white dark:bg-zinc-800 border-4 border-black p-6 rounded-lg shadow-[6px_6px_0_0_#000]">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5 mb-5">
                    <!-- Type -->
                    <div>
                        <label class="block font-black text-sm uppercase mb-2 text-black dark:text-white">Tipe Pengajuan</label>
                        <select name="type" class="w-full border-4 border-black rounded-lg px-4 py-3 font-bold text-sm bg-white dark:bg-zinc-700 dark:text-white focus:border-[#FF007F] focus:ring-0" required>
                            <option value="izin" {{ old('type') === 'izin' ? 'selected' : '' }}>📋 Izin</option>
                            <option value="cuti" {{ old('type') === 'cuti' ? 'selected' : '' }}>🏖️ Cuti</option>
                            <option value="sakit" {{ old('type') === 'sakit' ? 'selected' : '' }}>🤒 Sakit</option>
                        </select>
                        @error('type') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>

                    <!-- Start Date -->
                    <div>
                        <label class="block font-black text-sm uppercase mb-2 text-black dark:text-white">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" class="w-full border-4 border-black rounded-lg px-4 py-3 font-bold text-sm bg-white dark:bg-zinc-700 dark:text-white focus:border-[#FF007F] focus:ring-0" required>
                        @error('start_date') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    </div>
                </div>

                <!-- End Date -->
                <div class="mb-5">
                    <label class="block font-black text-sm uppercase mb-2 text-black dark:text-white">Tanggal Selesai</label>
                    <input type="date" name="end_date" value="{{ old('end_date') }}" class="w-full border-4 border-black rounded-lg px-4 py-3 font-bold text-sm bg-white dark:bg-zinc-700 dark:text-white focus:border-[#FF007F] focus:ring-0" required>
                    @error('end_date') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                    <p class="text-xs text-gray-500 mt-1 font-bold">Untuk 1 hari, isi tanggal mulai dan selesai sama.</p>
                </div>

                <!-- Reason -->
                <div class="mb-5">
                    <label class="block font-black text-sm uppercase mb-2 text-black dark:text-white">Alasan</label>
                    <textarea name="reason" rows="3" class="w-full border-4 border-black rounded-lg px-4 py-3 font-bold text-sm bg-white dark:bg-zinc-700 dark:text-white focus:border-[#FF007F] focus:ring-0" required placeholder="Tuliskan alasan pengajuan izin/cuti/sakit...">{{ old('reason') }}</textarea>
                    @error('reason') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Kegiatan Covered -->
                <div class="mb-5">
                    <label class="block font-black text-sm uppercase mb-2 text-black dark:text-white">Kegiatan yang Dilingkupi <span class="text-xs text-gray-500 dark:text-gray-400 font-normal block sm:inline sm:ml-1">(Pilih minimal satu)</span></label>
                    <div class="border-4 border-black rounded-lg p-4 bg-gray-50 dark:bg-zinc-700 grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="covered_sessions[]" value="Kajian" class="mt-1 border-2 border-black focus:ring-0 text-[#FF007F] rounded" {{ is_array(old('covered_sessions')) && in_array('Kajian', old('covered_sessions')) ? 'checked' : (!old('covered_sessions') ? 'checked' : '') }}>
                            <div>
                                <span class="font-bold text-sm text-black dark:text-white block">📖 Kajian</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold">Kegiatan Daaru Hiraa Harian/Mingguan</span>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="covered_sessions[]" value="Sholat" class="mt-1 border-2 border-black focus:ring-0 text-[#FF007F] rounded" {{ is_array(old('covered_sessions')) && in_array('Sholat', old('covered_sessions')) ? 'checked' : (!old('covered_sessions') ? 'checked' : '') }}>
                            <div>
                                <span class="font-bold text-sm text-black dark:text-white block">🕌 Shalat Jamaah</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold">Absensi Shalat Subuh / Shalat Berjamaah</span>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="covered_sessions[]" value="Tahsin" class="mt-1 border-2 border-black focus:ring-0 text-[#FF007F] rounded" {{ is_array(old('covered_sessions')) && in_array('Tahsin', old('covered_sessions')) ? 'checked' : (!old('covered_sessions') ? 'checked' : '') }}>
                            <div>
                                <span class="font-bold text-sm text-black dark:text-white block">🗣️ Tahsin</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold">Kegiatan Belajar/Setor Quran & Tahsin</span>
                            </div>
                        </label>
                        <label class="flex items-start gap-3 cursor-pointer">
                            <input type="checkbox" name="covered_sessions[]" value="Acara" class="mt-1 border-2 border-black focus:ring-0 text-[#FF007F] rounded" {{ is_array(old('covered_sessions')) && in_array('Acara', old('covered_sessions')) ? 'checked' : (!old('covered_sessions') ? 'checked' : '') }}>
                            <div>
                                <span class="font-bold text-sm text-black dark:text-white block">🎉 Acara Lain</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 font-bold">Kegiatan atau acara khusus pondok lainnya</span>
                            </div>
                        </label>
                    </div>
                    @error('covered_sessions') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Notes -->
                <div class="mb-5">
                    <label class="block font-black text-sm uppercase mb-2 text-black dark:text-white">Catatan Tambahan <span class="text-gray-400">(opsional)</span></label>
                    <textarea name="notes" rows="2" class="w-full border-4 border-black rounded-lg px-4 py-3 font-bold text-sm bg-white dark:bg-zinc-700 dark:text-white focus:border-[#FF007F] focus:ring-0" placeholder="Catatan tambahan jika ada...">{{ old('notes') }}</textarea>
                    @error('notes') <p class="text-red-500 text-xs font-bold mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Submit -->
                <div class="flex items-center gap-3">
                    <button type="submit" class="bg-[#FF007F] text-white border-4 border-black px-6 py-3 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm flex items-center gap-2">
                        <span class="material-symbols-outlined">send</span> KIRIM PENGAJUAN
                    </button>
                    <a href="{{ route('izin.index') }}" class="bg-white text-black border-4 border-black px-4 py-3 font-black text-sm shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                        BATAL
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>