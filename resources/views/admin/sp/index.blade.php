<x-admin-layout title="Evaluasi & Cetak SP" active="sp">

    @if(session('success'))
    <div class="bg-emerald-100 border-4 border-emerald-500 p-4 rounded-lg font-bold text-emerald-800 mb-6 flex items-center gap-2 shadow-[4px_4px_0_0_#000] border-black">
        <span class="material-symbols-outlined font-black">check_circle</span>
        {{ session('success') }}
    </div>
    @endif

    <!-- Filters & Settings Config -->
    <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-8">
        <h3 class="font-black text-xl mb-6 uppercase flex items-center gap-2">
            <span class="material-symbols-outlined text-red-500">tune</span> Parameter Evaluasi & Konfigurasi SP
        </h3>
        
        <form action="{{ route('admin.sp.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
            <div>
                <label class="block font-black uppercase text-xs mb-2">Tanggal Mulai</label>
                <input type="date" name="start_date" value="{{ $startDate }}" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div>
                <label class="block font-black uppercase text-xs mb-2">Tanggal Selesai</label>
                <input type="date" name="end_date" value="{{ $endDate }}" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div>
                <label class="block font-black uppercase text-xs mb-2">Batas Min Kehadiran (%)</label>
                <input type="number" name="threshold" value="{{ $threshold }}" min="1" max="100" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div>
                <label class="block font-black uppercase text-xs mb-2">Label Bulan / Periode</label>
                <input type="text" name="period_label" value="{{ $periodLabel }}" placeholder="Contoh: Oktober-November" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div>
                <label class="block font-black uppercase text-xs mb-2">Yogyakarta Tanggal Ttd</label>
                <input type="text" name="yogyakarta_date" value="{{ $yogyakartaDate }}" placeholder="Contoh: 04 Desember 2025" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div>
                <label class="block font-black uppercase text-xs mb-2">Nama Pengasuh PPM</label>
                <input type="text" name="pengasuh_name" value="{{ $pengasuhName }}" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div class="lg:col-span-2">
                <label class="block font-black uppercase text-xs mb-2">Nama Mas'ul Musyrif</label>
                <input type="text" name="musyrif_name" value="{{ $musyrifName }}" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-sm">
            </div>

            <div class="md:col-span-2 lg:col-span-4 pt-4 border-t-4 border-black flex justify-end gap-2">
                <button type="submit" class="bg-[#FFDE00] text-black px-6 py-2.5 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-xs uppercase flex items-center gap-2 cursor-pointer">
                    <span class="material-symbols-outlined text-sm font-black">refresh</span> Hitung & Terapkan
                </button>
            </div>
        </form>
    </div>

    <!-- Results Block -->
    <div class="grid grid-cols-1 gap-6">
        
        <!-- Needs SP Card -->
        <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 border-b-4 border-black pb-4">
                <div>
                    <h3 class="font-black text-xl uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-red-500 font-bold">warning</span> Santri Kurang Disiplin (SP)
                    </h3>
                    <p class="text-xs text-gray-500 font-bold mt-1">Kehadiran kajian di bawah {{ $threshold }}% pada periode {{ $periodLabel }} (Total KBM: {{ $totalKBMDays }} Hari)</p>
                </div>
                <span class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black font-black text-xs uppercase">
                    {{ count($needsSp) }} Santri
                </span>
            </div>

            @if(count($needsSp) > 0)
                <div class="grid gap-3">
                    @foreach($needsSp as $item)
                    <div class="bg-red-50 p-4 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg flex flex-col md:flex-row justify-between items-center gap-4 hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                        <div class="flex items-center gap-3 w-full md:w-auto">
                            <div class="w-10 h-10 bg-red-200 border-2 border-black rounded-full flex items-center justify-center font-black text-red-700 text-sm">
                                {{ $item['percentage'] }}%
                            </div>
                            <div>
                                <h4 class="font-bold text-sm leading-none text-black">{{ $item['student']->name }}</h4>
                                <span class="text-xs text-gray-500 font-bold block mt-1">Angkatan: {{ $item['student']->generation ?? '-' }} | Hadir: {{ $item['hadir'] }}/{{ $item['total_kbm'] }} Hari</span>
                            </div>
                        </div>

                        <div class="w-full md:w-auto flex justify-end">
                            @if($item['existing_warning'])
                                <div class="flex flex-wrap items-center gap-2 justify-end">
                                    <span class="bg-red-200 text-red-800 border-2 border-black px-3 py-1.5 rounded-lg font-black text-xs uppercase">
                                        Sudah Diterbitkan (SP {{ $item['existing_warning']->sp_number }})
                                    </span>
                                    
                                    <a href="{{ route('admin.sp.print-warning', $item['existing_warning']->id) }}" target="_blank" class="bg-black text-white hover:bg-gray-800 border-2 border-black px-4 py-2 rounded-lg font-black text-xs flex items-center gap-2 cursor-pointer shadow-[2px_2px_0_0_#000]">
                                        <span class="material-symbols-outlined text-sm font-black">print</span> CETAK PDF
                                    </a>
                                    
                                    <form action="{{ route('admin.sp.destroy', $item['existing_warning']->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan SP ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="start_date" value="{{ $startDate }}">
                                        <input type="hidden" name="end_date" value="{{ $endDate }}">
                                        <input type="hidden" name="threshold" value="{{ $threshold }}">
                                        <input type="hidden" name="period_label" value="{{ $periodLabel }}">
                                        <input type="hidden" name="yogyakarta_date" value="{{ $yogyakartaDate }}">
                                        <input type="hidden" name="pengasuh_name" value="{{ $pengasuhName }}">
                                        <input type="hidden" name="musyrif_name" value="{{ $musyrifName }}">
                                        
                                        <button type="submit" class="bg-white text-red-600 hover:bg-red-50 border-2 border-red-600 px-4 py-2 rounded-lg font-black text-xs flex items-center gap-2 cursor-pointer">
                                            <span class="material-symbols-outlined text-sm font-black">delete</span> HAPUS
                                        </button>
                                    </form>
                                </div>
                            @else
                                <form action="{{ route('admin.sp.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="student_id" value="{{ $item['student']->id }}">
                                    <input type="hidden" name="sp_number" value="{{ $item['proposed_sp_number'] }}">
                                    <input type="hidden" name="period_label" value="{{ $periodLabel }}">
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    <input type="hidden" name="attendance_percentage" value="{{ $item['percentage'] }}">
                                    <input type="hidden" name="threshold" value="{{ $threshold }}">
                                    <input type="hidden" name="yogyakarta_date" value="{{ $yogyakartaDate }}">
                                    <input type="hidden" name="pengasuh_name" value="{{ $pengasuhName }}">
                                    <input type="hidden" name="musyrif_name" value="{{ $musyrifName }}">
                                    
                                    <button type="submit" class="bg-red-500 text-white hover:bg-red-600 border-2 border-black px-4 py-2 rounded-lg font-black text-xs flex items-center gap-2 cursor-pointer shadow-[2px_2px_0_0_#000]">
                                        <span class="material-symbols-outlined text-sm font-black">gavel</span> TERBITKAN SP {{ $item['proposed_sp_number'] }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="bg-emerald-50 border-2 border-black p-4 rounded text-center font-black text-sm text-emerald-800 uppercase">
                    🎉 Alhamdulillah! Tidak ada santri yang memiliki kehadiran di bawah {{ $threshold }}% untuk periode ini.
                </div>
            @endif
        </div>

        <!-- Safe List Card -->
        <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000]">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 border-b-4 border-black pb-4">
                <div>
                    <h3 class="font-black text-xl uppercase flex items-center gap-2">
                        <span class="material-symbols-outlined text-emerald-500">check_circle</span> Santri Disiplin (Aman)
                    </h3>
                    <p class="text-xs text-gray-500 font-bold mt-1">Kehadiran kajian &ge; {{ $threshold }}% pada periode {{ $periodLabel }}</p>
                </div>
                <span class="bg-[#39FF14] text-black px-3 py-1 rounded border-2 border-black font-black text-xs uppercase">
                    {{ count($safe) }} Santri
                </span>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                @forelse($safe as $item)
                <div class="bg-gray-50 p-3 rounded-lg border-2 border-black flex justify-between items-center text-sm font-bold">
                    <div>
                        <span class="block text-black truncate max-w-[150px]">{{ $item['student']->name }}</span>
                        <span class="text-[10px] text-gray-400">Angkatan: {{ $item['student']->generation ?? '-' }}</span>
                    </div>
                    <span class="bg-emerald-100 text-emerald-700 px-2 py-0.5 rounded border border-emerald-300 text-xs font-black">
                        {{ $item['percentage'] }}%
                    </span>
                </div>
                @empty
                    <div class="col-span-full text-center text-xs text-gray-400 py-4 font-bold uppercase">
                        Tidak ada data santri aman.
                    </div>
                @endforelse
            </div>
        </div>

    </div>

    <!-- History of Issued SPs -->
    <div class="bg-white p-6 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mt-8">
        <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6 border-b-4 border-black pb-4">
            <div>
                <h3 class="font-black text-xl uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-black font-bold">history</span> Riwayat Surat Peringatan (SP) yang Telah Diterbitkan
                </h3>
                <p class="text-xs text-gray-500 font-bold mt-1">Daftar seluruh SP yang telah diterbitkan dan tersimpan di database.</p>
            </div>
            <span class="bg-[#FFDE00] text-black px-3 py-1 rounded border-2 border-black font-black text-xs uppercase">
                {{ count($issuedWarnings) }} Record SP
            </span>
        </div>

        @if(count($issuedWarnings) > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b-4 border-black bg-gray-50">
                            <th class="p-3 text-xs font-black uppercase text-black">Tanggal Dibuat</th>
                            <th class="p-3 text-xs font-black uppercase text-black">Nama Santri</th>
                            <th class="p-3 text-xs font-black uppercase text-black">Tingkat SP</th>
                            <th class="p-3 text-xs font-black uppercase text-black">Periode Evaluasi</th>
                            <th class="p-3 text-xs font-black uppercase text-black">Kehadiran</th>
                            <th class="p-3 text-xs font-black uppercase text-black">Batas Min</th>
                            <th class="p-3 text-xs font-black uppercase text-black text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black">
                        @foreach($issuedWarnings as $warning)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-3 text-sm font-bold text-gray-600">{{ \Carbon\Carbon::parse($warning->created_at)->translatedFormat('d M Y H:i') }}</td>
                            <td class="p-3 text-sm font-black text-black">{{ $warning->student->name }}</td>
                            <td class="p-3 text-sm font-bold">
                                <span class="bg-red-100 text-red-700 px-2 py-0.5 rounded border border-red-300 text-xs font-black">
                                    SP {{ $warning->sp_number }} ({{ $warning->sp_number_roman }})
                                </span>
                            </td>
                            <td class="p-3 text-sm font-bold text-gray-700">{{ $warning->period_label }}</td>
                            <td class="p-3 text-sm font-black text-red-600">{{ $warning->attendance_percentage }}%</td>
                            <td class="p-3 text-sm font-bold text-gray-500">{{ $warning->threshold }}%</td>
                            <td class="p-3 text-sm text-right flex justify-end gap-2 items-center">
                                <a href="{{ route('admin.sp.print-warning', $warning->id) }}" target="_blank" class="bg-black text-white hover:bg-gray-800 border-2 border-black px-3 py-1.5 rounded-lg font-black text-xs flex items-center gap-1.5 cursor-pointer shadow-[2px_2px_0_0_#000]">
                                    <span class="material-symbols-outlined text-xs font-black">print</span> Cetak
                                </a>
                                <form action="{{ route('admin.sp.destroy', $warning->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus catatan SP ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <input type="hidden" name="start_date" value="{{ $startDate }}">
                                    <input type="hidden" name="end_date" value="{{ $endDate }}">
                                    <input type="hidden" name="threshold" value="{{ $threshold }}">
                                    <input type="hidden" name="period_label" value="{{ $periodLabel }}">
                                    <input type="hidden" name="yogyakarta_date" value="{{ $yogyakartaDate }}">
                                    <input type="hidden" name="pengasuh_name" value="{{ $pengasuhName }}">
                                    <input type="hidden" name="musyrif_name" value="{{ $musyrifName }}">
                                    
                                    <button type="submit" class="bg-white text-red-600 hover:bg-red-50 border-2 border-red-600 px-3 py-1 rounded font-black text-xs flex items-center gap-1.5 cursor-pointer">
                                        <span class="material-symbols-outlined text-xs font-black">delete</span> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="bg-gray-50 border-2 border-black border-dashed p-8 rounded-lg text-center font-bold text-sm text-gray-400 uppercase">
                Tidak ada data riwayat surat peringatan yang diterbitkan.
            </div>
        @endif
    </div>

</x-admin-layout>
