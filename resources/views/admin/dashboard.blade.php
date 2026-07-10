<x-admin-layout title="Dashboard" active="dashboard">

    <!-- Welcome Banner -->
    <div class="bg-[#FF007F] border-4 border-black p-6 shadow-[6px_6px_0_0_#000] rounded-lg mb-6 flex flex-col md:flex-row justify-between items-center">
        <div class="text-white mb-4 md:mb-0">
            <h1 class="text-3xl font-black uppercase tracking-tighter">Selamat Datang, Admin!</h1>
            <p class="text-sm font-bold mt-1 opacity-80">{{ now()->translatedFormat('l, d F Y') }}</p>
        </div>
        <form action="{{ route('admin.sync-streaks') }}" method="POST">
            @csrf
            <button type="submit" class="bg-[#FFDE00] border-4 border-black px-4 py-2 font-black text-black shadow-[4px_4px_0_0_#000] hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all text-sm flex items-center gap-2">
                <span class="material-symbols-outlined text-lg">sync</span> SYNC STREAKS
            </button>
        </form>
    </div>

    <!-- Stats Grid -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-6">
        <div class="bg-[#00E5FF] border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-lg">group</span>
                <span class="text-xs font-black uppercase">Santri</span>
            </div>
            <div class="text-3xl font-black">{{ $stats['total_santri'] }}</div>
        </div>
        <div class="bg-[#39FF14] border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-lg">supervisor_account</span>
                <span class="text-xs font-black uppercase">Musyrif</span>
            </div>
            <div class="text-3xl font-black">{{ $stats['total_musyrif'] }}</div>
        </div>
        <div class="bg-[#FFDE00] border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-lg">person</span>
                <span class="text-xs font-black uppercase">Ustadz</span>
            </div>
            <div class="text-3xl font-black">{{ $stats['total_ustadz'] }}</div>
        </div>
        <div class="bg-[#FF6B6B] border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg text-white">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-lg">menu_book</span>
                <span class="text-xs font-black uppercase">Topik</span>
            </div>
            <div class="text-3xl font-black">{{ $stats['total_topik'] }}</div>
        </div>
        <div class="bg-white border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-lg text-emerald-600">check_circle</span>
                <span class="text-xs font-black uppercase">Hadir</span>
            </div>
            <div class="text-3xl font-black">{{ $stats['hadir'] }}</div>
        </div>
        <div class="bg-black border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg text-white">
            <div class="flex items-center gap-2 mb-1">
                <span class="material-symbols-outlined text-lg text-[#FFDE00]">percent</span>
                <span class="text-xs font-black uppercase">Persen</span>
            </div>
            <div class="text-3xl font-black">{{ $stats['persen'] }}%</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <a href="{{ route('admin.santri.index') }}" class="bg-white border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all block">
            <span class="material-symbols-outlined text-2xl text-[#00E5FF]">group</span>
            <h3 class="font-black text-sm mt-2 uppercase">Kelola Santri</h3>
        </a>
        <a href="{{ route('admin.attendance.index') }}" class="bg-white border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all block">
            <span class="material-symbols-outlined text-2xl text-[#FFDE00]">checklist</span>
            <h3 class="font-black text-sm mt-2 uppercase">Input Absensi</h3>
        </a>
        <a href="{{ route('admin.qr.index') }}" class="bg-white border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all block">
            <span class="material-symbols-outlined text-2xl text-[#39FF14]">qr_code</span>
            <h3 class="font-black text-sm mt-2 uppercase">QR Generator</h3>
        </a>
        <a href="{{ route('admin.kajian.index') }}" class="bg-white border-4 border-black p-4 shadow-[4px_4px_0_0_#000] rounded-lg hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all block">
            <span class="material-symbols-outlined text-2xl text-[#FF007F]">calendar_month</span>
            <h3 class="font-black text-sm mt-2 uppercase">Kelola Kajian</h3>
        </a>
    </div>

    <!-- Two Column Layout: Attendance statistics -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">

        <!-- Absensi 7 Hari -->
        <div class="bg-white border-4 border-black p-5 shadow-[4px_4px_0_0_#000] rounded-lg">
            <h3 class="font-black text-lg uppercase mb-4 flex items-center gap-2 text-black">
                <span class="material-symbols-outlined text-[#FF007F]">bar_chart</span>
                Absensi 7 Hari Terakhir
            </h3>
            <div class="space-y-2">
                @foreach($absensi7Hari as $item)
                <div class="flex items-center gap-3">
                    <span class="text-xs font-bold w-16 text-gray-500">{{ $item['date'] }}</span>
                    <div class="flex-1 bg-gray-100 rounded-full h-6 border-2 border-black overflow-hidden">
                        <div class="h-full bg-[#39FF14] rounded-full flex items-center justify-end pr-2" style="width: {{ $stats['total_santri'] > 0 ? min(($item['count'] / $stats['total_santri']) * 100, 100) : 0 }}%">
                            @if($item['count'] > 0)
                            <span class="text-[10px] font-black text-black">{{ $item['count'] }}</span>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Kehadiran Ustadz Hari Ini -->
        <div class="bg-white border-4 border-black p-5 shadow-[4px_4px_0_0_#000] rounded-lg">
            <h3 class="font-black text-lg uppercase mb-4 flex items-center gap-2 text-black">
                <span class="material-symbols-outlined text-[#FFDE00]">event_seat</span>
                Kehadiran Ustadz Hari Ini
            </h3>
            @if($todayUstadzAttendances->count() > 0)
                <div class="space-y-3">
                    @foreach($todayUstadzAttendances as $k)
                    <div class="border-2 border-black rounded-lg p-3 bg-gray-50 flex justify-between items-center gap-3">
                        <div class="min-w-0">
                            <p class="font-black text-sm uppercase text-black truncate">{{ $k->kajian_topic }}</p>
                            <div class="flex flex-wrap items-center gap-1 text-[11px] text-gray-500 mt-1 font-bold">
                                <span class="material-symbols-outlined text-xs">person</span>
                                <span class="uppercase text-black truncate max-w-[120px]">{{ $k->asatiz->name ?? '-' }}</span>
                            </div>
                        </div>
                        <div class="flex-shrink-0">
                            @if($k->status === 'H')
                                <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#39FF14] text-black">Hadir</span>
                            @elseif($k->status === 'I')
                                <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#FFDE00] text-black">Izin</span>
                            @elseif($k->status === 'S')
                                <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#00E5FF] text-black">Sakit</span>
                            @elseif($k->status === 'A')
                                <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#FF6B6B] text-black">Alpha</span>
                            @else
                                <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-gray-200 text-gray-500">Belum Absen</span>
                            @endif
                        </div>
                    </div>
                    @endforeach
                </div>
            @else
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 flex flex-col items-center justify-center text-center h-[200px]">
                    <span class="material-symbols-outlined text-gray-300 text-4xl mb-2">calendar_today</span>
                    <p class="text-gray-400 text-sm font-bold italic">Tidak ada jadwal ustadz hari ini.</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Two Column Layout: Feedback & Comments -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        <!-- Refleksi Terbaru -->
        <div class="bg-white border-4 border-black p-5 shadow-[4px_4px_0_0_#000] rounded-lg">
            <h3 class="font-black text-lg uppercase mb-4 flex items-center gap-2 text-black">
                <span class="material-symbols-outlined text-[#00E5FF]">edit_note</span>
                Refleksi Terbaru
            </h3>
            @if($refleksiTerbaru->count() > 0)
                <div class="space-y-3">
                    @foreach($refleksiTerbaru as $r)
                    <div class="border-2 border-black rounded-lg p-3 bg-gray-50">
                        <p class="font-bold text-sm text-black">{{ $r->name }}</p>
                        <p class="text-xs text-gray-600 mt-1 line-clamp-2">{{ $r->content }}</p>
                        <p class="text-[10px] text-gray-400 mt-1 font-bold">{{ $r->created_at?->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-sm font-bold italic">Belum ada refleksi.</p>
            @endif
        </div>

        <!-- Saran & Masukan -->
        <div class="bg-white border-4 border-black p-5 shadow-[4px_4px_0_0_#000] rounded-lg">
            <h3 class="font-black text-lg uppercase mb-4 flex items-center gap-2 text-black">
                <span class="material-symbols-outlined text-[#FFDE00]">feedback</span>
                Saran & Masukan Terbaru
            </h3>
            @if($saranTerbaru->count() > 0)
                <div class="space-y-3">
                    @foreach($saranTerbaru as $s)
                    <div class="border-2 border-black rounded-lg p-3 bg-yellow-50">
                        <p class="text-sm font-bold text-black">{{ $s->message }}</p>
                        <p class="text-[10px] text-gray-400 mt-2 font-bold">{{ $s->created_at?->diffForHumans() }}</p>
                    </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-400 text-sm font-bold italic">Belum ada saran.</p>
            @endif
        </div>
    </div>

</x-admin-layout>
