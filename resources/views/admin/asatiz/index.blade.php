<x-admin-layout title="Kelola Ustadz" active="asatiz">

    <!-- Tab Navigation & Main Content -->
    <div x-data="{ activeTab: new URLSearchParams(window.location.search).get('tab') || (new URLSearchParams(window.location.search).has('page') ? 'absensi' : 'daftar'), expandedUstadz: null }">
        
        <!-- Tabs -->
        <div class="flex flex-wrap gap-3 mb-6 border-b-4 border-black pb-3">
            <button @click="activeTab = 'daftar'" 
                :class="activeTab === 'daftar' ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-black hover:bg-gray-100'" 
                class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all active:translate-y-0.5 active:shadow-none">
                👥 Daftar Ustadz
            </button>
            <button @click="activeTab = 'absensi'" 
                :class="activeTab === 'absensi' ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-black hover:bg-gray-100'" 
                class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all active:translate-y-0.5 active:shadow-none">
                📅 Jadwal & Absensi
            </button>
            <button @click="activeTab = 'rekap'" 
                :class="activeTab === 'rekap' ? 'bg-[#FFDE00] text-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-black hover:bg-gray-100'" 
                class="px-5 py-2.5 font-black uppercase text-sm border-4 border-black rounded-lg transition-all active:translate-y-0.5 active:shadow-none">
                📊 Rekap Absensi
            </button>
        </div>

        <!-- Tab: Daftar Ustadz -->
        <div x-show="activeTab === 'daftar'">
            <!-- Form Tambah -->
            <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
                <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#FFDE00]">person_add</span> Tambah Ustadz
                </h3>
                <form action="{{ route('admin.asatiz.store') }}" method="POST" class="flex flex-col md:flex-row gap-3">
                    @csrf
                    <input type="text" name="name" placeholder="Nama Ustadz..." class="flex-1 border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm" required>
                    <button type="submit" class="bg-black text-white px-6 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase py-2">
                        Simpan
                    </button>
                </form>
            </div>

            <!-- Data List -->
            <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
                <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
                    Daftar Ustadz ({{ $asatiz->count() }})
                </div>

                <div x-data="{ editOpen: false, data: {} }">
                    @forelse($asatiz as $a)
                    <div class="p-4 border-b-2 border-gray-200 flex flex-col md:flex-row justify-between items-center gap-3 hover:bg-yellow-50 transition-colors">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-[#FFDE00] rounded-full border-2 border-black flex items-center justify-center font-black text-black">
                                {{ strtoupper(substr($a->name, 0, 1)) }}
                            </div>
                            <div>
                                <h3 class="font-black text-sm text-black">{{ $a->name }}</h3>
                                <p class="text-xs text-gray-400">Bergabung: {{ $a->created_at?->translatedFormat('d M Y') ?? '-' }}</p>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button type="button"
                                @click="data = { id: {{ $a->id }}, name: '{{ addslashes($a->name) }}' }; editOpen = true"
                                class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                                Edit
                            </button>
                            <form action="{{ route('admin.asatiz.destroy', $a->id) }}" method="POST" onsubmit="return confirm('Hapus ustadz ini?');" class="inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400 font-bold">Belum ada data ustadz.</div>
                    @endforelse

                    <!-- Edit Modal -->
                    <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
                        <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-sm shadow-[8px_8px_0_0_#000] relative">
                            <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm">X</button>
                            <h2 class="text-2xl font-black mb-4 uppercase text-black">Edit Ustadz</h2>
                            <form :action="`/admin/asatiz/${data.id}`" method="POST" class="space-y-3">
                                @csrf @method('PUT')
                                <div>
                                    <label class="block font-black uppercase text-xs mb-1 text-black">Nama</label>
                                    <input type="text" name="name" x-model="data.name" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm text-black" required>
                                </div>
                                <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-3 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                                    Simpan Perubahan
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tab: Absensi Ustadz -->
        <div x-show="activeTab === 'absensi'" x-cloak class="space-y-4">
        <!-- === Kajian Tetap Hari Ini (Belum Diabsen) === -->
        @if($todayUnmarkedTopics->isNotEmpty())
        <div class="bg-amber-50 border-4 border-[#FF007F] rounded-lg shadow-[4px_4px_0_0_#FF007F] mb-4 overflow-hidden">
            <div class="p-3 bg-[#FF007F] text-white font-black uppercase text-sm tracking-widest flex items-center gap-2">
                <span class="material-symbols-outlined text-base">alarm</span>
                🔴 Kajian Tetap Hari Ini — Belum Diabsen ({{ $todayUnmarkedTopics->count() }})
            </div>
            <div class="divide-y-2 divide-amber-200">
                @foreach($todayUnmarkedTopics as $topic)
                <div class="p-4 flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <div>
                        <p class="font-black text-sm uppercase text-black">{{ $topic->title }}</p>
                        <div class="flex items-center gap-1.5 text-xs text-gray-500 font-bold mt-1">
                            <span class="material-symbols-outlined text-xs">person</span>
                            <span class="uppercase text-black font-black">{{ $topic->asatiz?->name ?? 'Tanpa Ustadz' }}</span>
                            @if($topic->start_time)
                                <span class="text-gray-400">•</span>
                                <span class="material-symbols-outlined text-xs">schedule</span>
                                <span>{{ substr($topic->start_time, 0, 5) }} WIB</span>
                            @endif
                        </div>
                    </div>
                    <!-- Quick Attendance Buttons — langsung store baru -->
                    <div class="flex gap-2 flex-wrap">
                        @if($topic->asatiz_id)
                            @foreach(['H' => ['Hadir', '#39FF14', 'text-black'], 'I' => ['Izin', '#FFDE00', 'text-black'], 'S' => ['Sakit', '#00E5FF', 'text-black'], 'A' => ['Alpha', '#FF6B6B', 'text-black']] as $code => [$label, $color, $textColor])
                            <form action="{{ route('admin.asatiz.attendance.store') }}" method="POST">
                                @csrf
                                <input type="hidden" name="asatiz_id" value="{{ $topic->asatiz_id }}">
                                <input type="hidden" name="attendance_date" value="{{ now()->toDateString() }}">
                                <input type="hidden" name="kajian_topic" value="{{ $topic->title }}">
                                <input type="hidden" name="status" value="{{ $code }}">
                                <button type="submit"
                                    class="px-3 py-1.5 text-xs font-black rounded border-2 border-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all {{ $textColor }}"
                                    style="background-color: {{ $color }}">
                                    {{ $label }}
                                </button>
                            </form>
                            @endforeach
                        @else
                            <a href="{{ route('admin.topik.index') }}" class="px-3 py-1.5 text-xs font-black rounded border-2 border-black bg-red-400 text-black shadow-[2px_2px_0_0_#000] hover:bg-[#FFDE00] active:translate-y-0.5 active:shadow-none transition-all uppercase">
                                ⚠️ Atur Ustadz
                            </a>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- Form Tambah Jadwal & Absensi -->
            <div class="bg-white p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
                <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
                    <span class="material-symbols-outlined text-[#39FF14]">event_available</span> Input Jadwal & Absensi
                </h3>
                <form action="{{ route('admin.asatiz.attendance.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    @csrf
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">Ustadz</label>
                        <select name="asatiz_id" class="w-full border-4 border-black p-2 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black text-sm" required>
                            <option value="">Pilih Ustadz...</option>
                            @foreach($asatiz as $a)
                                <option value="{{ $a->id }}">{{ $a->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">Tanggal</label>
                        <input type="date" name="attendance_date" class="w-full border-4 border-black p-2 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black text-sm" value="{{ date('Y-m-d') }}" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">Topik Kajian</label>
                        <input type="text" name="kajian_topic" placeholder="Contoh: Kitab Fathul Mu'in..." class="w-full border-4 border-black p-2 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black uppercase text-xs mb-1 text-black">Status Kehadiran</label>
                        <select name="status" class="w-full border-4 border-black p-2 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black text-sm">
                            <option value="">-- Belum Absen --</option>
                            <option value="H">Hadir</option>
                            <option value="I">Izin</option>
                            <option value="S">Sakit</option>
                            <option value="A">Alpha</option>
                        </select>
                    </div>
                    <div class="md:col-span-4 flex justify-end mt-2">
                        <button type="submit" class="bg-black text-white px-6 font-black rounded-lg border-4 border-black hover:bg-[#39FF14] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase py-2">
                            Simpan Data
                        </button>
                    </div>
                </form>
            </div>

            <!-- List Jadwal -->
            <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
                <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3">
                    <span>Data Jadwal & Absensi Ustadz</span>
                    <a href="{{ route('admin.asatiz.index', ['tab' => 'absensi', 'show_future' => $showFuture ? null : 1]) }}" 
                       class="bg-white hover:bg-gray-100 text-black px-3 py-1.5 border-2 border-white rounded text-xs font-black shadow-[2px_2px_0_0_rgba(255,255,255,0.2)] hover:translate-x-0.5 hover:translate-y-0.5 transition-all uppercase flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-sm">{{ $showFuture ? 'visibility_off' : 'visibility' }}</span>
                        {{ $showFuture ? 'Sembunyikan Jadwal Mendatang' : 'Tampilkan Jadwal Mendatang' }}
                    </a>
                </div>
                <div class="p-4 grid grid-cols-1 md:grid-cols-2 gap-6">
                    @forelse($attendances as $att)
                    <div class="bg-white border-4 border-black p-4 rounded-lg shadow-[4px_4px_0_0_#000] flex flex-col justify-between hover:translate-x-[-1px] hover:translate-y-[-1px] hover:shadow-[6px_6px_0_0_#000] transition-all">
                        <div>
                            <div class="flex justify-between items-start gap-2 mb-3">
                                <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-purple-100 text-purple-700">
                                    {{ \Carbon\Carbon::parse($att->attendance_date)->translatedFormat('d M Y') }}
                                </span>
                                @if($att->status === 'H')
                                    <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#39FF14] text-black">Hadir</span>
                                @elseif($att->status === 'I')
                                    <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#FFDE00] text-black">Izin</span>
                                @elseif($att->status === 'S')
                                    <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#00E5FF] text-black">Sakit</span>
                                @elseif($att->status === 'A')
                                    <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#FF6B6B] text-black">Alpha</span>
                                @else
                                    <span class="text-[10px] font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-gray-200 text-gray-500">Belum Absen</span>
                                @endif
                            </div>
                            
                            <h4 class="font-black text-base uppercase text-black mb-2 line-clamp-1">{{ $att->kajian_topic }}</h4>
                            
                            <div class="text-xs text-gray-600 font-bold space-y-1.5 mb-4">
                                <div class="flex items-center gap-1.5">
                                    <span class="material-symbols-outlined text-base">person</span>
                                    <span>Ustadz: <strong class="text-black font-black uppercase">{{ $att->asatiz->name ?? 'Tidak ada Ustadz' }}</strong></span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="border-t-2 border-black pt-3 flex flex-wrap justify-between items-center gap-2">
                            <span class="text-xs font-black uppercase text-black">Update Absensi:</span>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.asatiz.attendance.update', $att->id) }}" method="POST" class="flex gap-1">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="page" value="{{ $attendances->currentPage() }}">
                                    <input type="hidden" name="asatiz_id" value="{{ $att->asatiz_id }}">
                                    <input type="hidden" name="attendance_date" value="{{ $att->attendance_date }}">
                                    <input type="hidden" name="kajian_topic" value="{{ $att->kajian_topic }}">
                                    
                                    <button type="submit" name="status" value="H" 
                                        class="px-2 py-1 text-[10px] font-black rounded border-2 transition-all {{ $att->status === 'H' ? 'bg-[#39FF14] text-black border-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-gray-400 border-gray-200 hover:text-black hover:border-black' }}">
                                        Hadir
                                    </button>
                                    <button type="submit" name="status" value="I" 
                                        class="px-2 py-1 text-[10px] font-black rounded border-2 transition-all {{ $att->status === 'I' ? 'bg-[#FFDE00] text-black border-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-gray-400 border-gray-200 hover:text-black hover:border-black' }}">
                                        Izin
                                    </button>
                                    <button type="submit" name="status" value="S" 
                                        class="px-2 py-1 text-[10px] font-black rounded border-2 transition-all {{ $att->status === 'S' ? 'bg-[#00E5FF] text-black border-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-gray-400 border-gray-200 hover:text-black hover:border-black' }}">
                                        Sakit
                                    </button>
                                    <button type="submit" name="status" value="A" 
                                        class="px-2 py-1 text-[10px] font-black rounded border-2 transition-all {{ $att->status === 'A' ? 'bg-[#FF6B6B] text-black border-black shadow-[2px_2px_0_0_#000] translate-y-[-1px]' : 'bg-white text-gray-400 border-gray-200 hover:text-black hover:border-black' }}">
                                        Alpha
                                    </button>
                                    
                                    @if($att->status)
                                    <button type="submit" name="status" value="none" title="Reset Absensi"
                                        class="px-2 py-1 text-[10px] font-black rounded border-2 bg-gray-100 text-black border-black hover:bg-red-200 transition-all flex items-center justify-center">
                                        <span class="material-symbols-outlined text-xs">restart_alt</span>
                                    </button>
                                    @endif
                                </form>
                                <form action="{{ route('admin.asatiz.attendance.destroy', $att->id) }}" method="POST" onsubmit="return confirm('Hapus jadwal & absensi ini?');" class="inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" title="Hapus" class="px-2 py-1 text-[10px] font-black rounded border-2 bg-red-400 text-black border-black hover:bg-red-500 transition-all flex items-center justify-center">
                                        <span class="material-symbols-outlined text-xs">delete</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-2 p-8 text-center text-gray-400 font-bold">Belum ada data jadwal/absensi ustadz.</div>
                    @endforelse
                </div>
                <div class="p-4 border-t-4 border-black">
                    {{ $attendances->links() }}
                </div>
            </div>
        </div>

        <!-- Tab: Rekap Absensi -->
        <div x-show="activeTab === 'rekap'" x-cloak class="space-y-4">
            <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
                <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest">
                    Rekap Kehadiran Ustadz
                </div>
                
                <div class="divide-y-2 divide-gray-200">
                    @forelse($rekap as $r)
                    @php
                        $total = $r->total_jadwal;
                        $hadir = $r->hadir_count;
                        $izin = $r->izin_count;
                        $sakit = $r->sakit_count;
                        $alpha = $r->alpha_count;
                        $belum = $total - ($hadir + $izin + $sakit + $alpha);
                        
                        $presentPercentage = $total > 0 ? round(($hadir / $total) * 100) : 0;
                    @endphp
                    <div class="p-4 hover:bg-yellow-50 transition-colors">
                        <div class="flex flex-col lg:flex-row justify-between lg:items-center gap-4">
                            <!-- Left: Profile & Percentage -->
                            <div class="flex items-center gap-4 flex-1">
                                <div class="w-12 h-12 bg-[#FFDE00] rounded-full border-2 border-black flex items-center justify-center font-black text-black text-lg">
                                    {{ strtoupper(substr($r->name, 0, 1)) }}
                                </div>
                                <div class="flex-1">
                                    <h3 class="font-black text-base text-black">{{ $r->name }}</h3>
                                    
                                    <!-- Attendance Bar -->
                                    <div class="mt-2 flex items-center gap-3">
                                        <div class="w-full max-w-[200px] bg-gray-100 rounded-full h-4 border-2 border-black overflow-hidden">
                                            <div class="h-full bg-[#39FF14] rounded-full" style="width: {{ $presentPercentage }}%"></div>
                                        </div>
                                        <span class="text-xs font-black text-black">{{ $presentPercentage }}% Hadir</span>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Middle: Detail stats badges -->
                            <div class="flex flex-wrap gap-2">
                                <span class="text-xs font-black uppercase border-2 border-black px-2.5 py-1 rounded bg-black text-white">
                                    Total: {{ $total }}
                                </span>
                                <span class="text-xs font-black uppercase border-2 border-black px-2.5 py-1 rounded bg-[#39FF14] text-black">
                                    Hadir: {{ $hadir }}
                                </span>
                                <span class="text-xs font-black uppercase border-2 border-black px-2.5 py-1 rounded bg-[#FFDE00] text-black">
                                    Izin: {{ $izin }}
                                </span>
                                <span class="text-xs font-black uppercase border-2 border-black px-2.5 py-1 rounded bg-[#00E5FF] text-black">
                                    Sakit: {{ $sakit }}
                                </span>
                                <span class="text-xs font-black uppercase border-2 border-black px-2.5 py-1 rounded bg-[#FF6B6B] text-black">
                                    Alpha: {{ $alpha }}
                                </span>
                                @if($belum > 0)
                                <span class="text-xs font-black uppercase border-2 border-black px-2.5 py-1 rounded bg-gray-200 text-gray-500">
                                    Pending: {{ $belum }}
                                </span>
                                @endif
                            </div>

                            <!-- Right: Accordion Toggle Button -->
                            <div>
                                <button @click="expandedUstadz = (expandedUstadz === {{ $r->id }} ? null : {{ $r->id }})"
                                    class="bg-white text-black border-2 border-black px-3 py-1.5 rounded-lg text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none hover:bg-gray-50 transition-all flex items-center gap-1.5">
                                    <span x-text="expandedUstadz === {{ $r->id }} ? 'Sembunyikan' : 'Riwayat'"></span>
                                    <span class="material-symbols-outlined text-sm" x-text="expandedUstadz === {{ $r->id }} ? 'expand_less' : 'expand_more'"></span>
                                </button>
                            </div>
                        </div>

                        <!-- Collapsible: Ustadz Kajian History -->
                        <div x-show="expandedUstadz === {{ $r->id }}" x-transition x-cloak class="mt-4 pt-4 border-t-2 border-dashed border-gray-300">
                            <h4 class="font-black text-xs uppercase text-gray-500 mb-2">Riwayat Jadwal & Kehadiran</h4>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                @forelse($r->attendances as $kj)
                                <div class="bg-white p-3 border-2 border-black rounded-lg flex justify-between items-center text-xs shadow-[2px_2px_0_0_#000]">
                                    <div>
                                        <p class="font-black uppercase text-black">{{ $kj->kajian_topic }}</p>
                                        <p class="text-gray-400 mt-0.5 font-bold">{{ \Carbon\Carbon::parse($kj->attendance_date)->translatedFormat('d M Y') }}</p>
                                    </div>
                                    <div>
                                        @if($kj->status === 'H')
                                            <span class="text-[9px] font-black border-2 border-black px-1.5 py-0.5 rounded bg-[#39FF14] text-black">HADIR</span>
                                        @elseif($kj->status === 'I')
                                            <span class="text-[9px] font-black border-2 border-black px-1.5 py-0.5 rounded bg-[#FFDE00] text-black">IZIN</span>
                                        @elseif($kj->status === 'S')
                                            <span class="text-[9px] font-black border-2 border-black px-1.5 py-0.5 rounded bg-[#00E5FF] text-black">SAKIT</span>
                                        @elseif($kj->status === 'A')
                                            <span class="text-[9px] font-black border-2 border-black px-1.5 py-0.5 rounded bg-[#FF6B6B] text-black">ALPHA</span>
                                        @else
                                            <span class="text-[9px] font-black border-2 border-black px-1.5 py-0.5 rounded bg-gray-200 text-gray-500">PENDING</span>
                                        @endif
                                    </div>
                                </div>
                                @empty
                                <p class="text-gray-400 text-xs font-bold italic col-span-2">Belum ada riwayat jadwal/absensi.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="p-8 text-center text-gray-400 font-bold">Belum ada data ustadz.</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</x-admin-layout>
