<x-admin-layout title="QR Generator" active="qr">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">

        <!-- Form Controls -->
        <div class="space-y-6">
            <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000]">
                <form action="{{ route('admin.qr.store') }}" method="POST" class="space-y-4" x-data="{ session_type: '{{ $sessionType }}' }">
                    @csrf
                    <div>
                        <label class="block font-black text-xs uppercase mb-2 text-gray-400 tracking-widest">Pilih Sesi Absensi</label>
                        <select name="session_type" x-model="session_type" @change="window.location.href='?session_type=' + session_type" class="w-full p-3 border-4 border-black rounded-lg font-black text-sm focus:outline-none focus:bg-indigo-50 transition appearance-none cursor-pointer">
                            <option value="Subuh">ABSEN SUBUH</option>
                            <option value="Kajian">ABSEN KAJIAN</option>
                            <option value="Tahsin">ABSEN TAHSIN</option>
                        </select>
                    </div>

                    <div class="bg-blue-50 border-2 border-dashed border-blue-300 p-3 rounded-lg">
                        <p class="text-xs font-bold text-blue-700 italic">Gunakan tombol di bawah hanya jika ingin mereset QR yang lama sebelum 30 hari.</p>
                    </div>

                    <button type="submit" onclick="return confirm('Buat QR Code baru? QR lama tidak bisa digunakan lagi!')" class="w-full bg-black text-white px-6 py-3 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#4f46e5] active:translate-y-1 active:shadow-none transition-all uppercase text-sm">
                        Generate New QR
                    </button>
                </form>
            </div>

            <div class="bg-blue-600 border-4 border-black p-4 rounded-lg shadow-[4px_4px_0_0_#000] text-white">
                <h3 class="font-black text-sm mb-1 uppercase">Info Masa Berlaku</h3>
                <p class="text-xs font-bold leading-relaxed opacity-80">
                    QR Code berlaku <span class="text-[#FFDE00] font-black">30 HARI</span>. Admin tidak perlu membuat ulang setiap hari.
                </p>
            </div>
        </div>

        <!-- QR Display -->
        <div class="flex justify-center">
            @if($qrUrl)
                <div class="bg-white p-8 rounded-xl border-4 border-black shadow-[4px_4px_0_0_#facc15] flex flex-col items-center max-w-sm w-full relative">
                    <div class="absolute -top-3 -right-3 bg-[#39FF14] text-black px-3 py-1 border-4 border-black rounded-lg font-black text-xs rotate-3 shadow-[2px_2px_0_0_#000]">
                        ACTIVE
                    </div>
                    <h3 class="font-black text-xl mb-4 uppercase text-center bg-black text-white border-4 border-black px-4 py-1.5 rounded-lg">
                        {{ $sessionType }}
                    </h3>
                    <div class="bg-white p-4 border-4 border-black rounded-xl shadow-[4px_4px_0_0_#000]">
                        <img src="{{ $qrUrl }}" alt="QR Code" class="w-56 h-56">
                    </div>
                    <div class="mt-6 text-center">
                        <p class="font-black text-[10px] uppercase tracking-widest text-gray-400">Berlaku Sampai:</p>
                        <p class="font-black text-sm text-indigo-700 bg-indigo-50 px-3 py-1 rounded-lg border-2 border-black inline-block mt-1">
                            {{ \Carbon\Carbon::parse($activeSession->expires_at)->translatedFormat('d F Y') }}
                        </p>
                    </div>
                </div>
            @else
                <div class="bg-red-50 p-10 rounded-xl border-4 border-black border-dashed flex flex-col items-center justify-center text-center max-w-sm">
                    <span class="material-symbols-outlined text-6xl text-gray-300">qr_code</span>
                    <h3 class="font-black text-lg uppercase mb-2 mt-2">TIDAK ADA QR AKTIF</h3>
                    <p class="text-xs font-bold text-red-600 uppercase">QR Code sudah kadaluarsa atau belum dibuat. Klik tombol Generate.</p>
                </div>
            @endif
        </div>

    </div>

</x-admin-layout>
