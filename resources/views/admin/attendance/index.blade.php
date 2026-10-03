<x-admin-layout title="Input Absensi" active="attendance">
    <style>
        .attendance-radio:checked + .attendance-btn {
            background-color: #000000 !important;
            color: #ffffff !important;
            box-shadow: 4px 4px 0 0 #000000 !important;
        }
        .dark .attendance-radio:checked + .attendance-btn {
            background-color: #ffffff !important;
            color: #000000 !important;
            box-shadow: 4px 4px 0 0 #ffffff !important;
        }
        .session-tab { transition: all 0.2s ease; }
        .session-tab.active {
            background-color: #000 !important;
            color: #fff !important;
            box-shadow: 4px 4px 0 0 #000 !important;
        }
        .dark .session-tab.active {
            background-color: #fff !important;
            color: #000 !important;
            box-shadow: 4px 4px 0 0 #fff !important;
        }
    </style>

    @php
        $sessionLabel = match($sessionType) {
            'Tahsin' => 'Tahsin & Tahfidz',
            'Subuh' => 'Subuh',
            default => 'Kajian Rutin',
        };
        $sessions = [
            'Kajian' => ['label' => '📖 Kajian Rutin', 'desc' => 'Harian'],
            'Tahsin' => ['label' => '🎙️ Tahsin & Tahfidz', 'desc' => '2x / Minggu'],
            'Subuh'  => ['label' => '🕌 Subuh', 'desc' => 'Harian'],
        ];
    @endphp

    <!-- Session Type Tabs -->
    <div class="flex flex-wrap gap-2 mb-4">
        @foreach($sessions as $key => $meta)
            <a href="{{ route('admin.attendance.index', ['date' => $selectedDate, 'session_type' => $key]) }}"
               class="session-tab {{ $sessionType === $key ? 'active' : '' }} bg-white border-3 border-black px-4 py-2.5 rounded-lg font-black text-sm flex items-center gap-2 no-underline text-black hover:bg-gray-50">
                <span>{{ $meta['label'] }}</span>
                <span class="text-[10px] font-bold px-1.5 py-0.5 bg-gray-100 rounded {{ $sessionType === $key ? '!bg-white/20' : '' }}">{{ $meta['desc'] }}</span>
            </a>
        @endforeach
    </div>

    <!-- Date Selector -->
    <div class="bg-white border-4 border-black p-4 rounded-lg mb-6 shadow-[4px_4px_0_0_#000] flex flex-col md:flex-row justify-between items-center gap-4">
        <div>
            <h3 class="font-black text-lg uppercase">
                {{ \Carbon\Carbon::parse($selectedDate)->translatedFormat('d F Y') }}
            </h3>
            <p class="text-xs text-gray-500 font-bold">Absensi {{ $sessionLabel }}</p>
        </div>
        <form action="{{ route('admin.attendance.index') }}" method="GET" class="flex gap-2 bg-yellow-50 p-2 rounded-lg border-2 border-black w-full md:w-auto">
            <input type="hidden" name="session_type" value="{{ $sessionType }}">
            <input type="date" name="date" value="{{ $selectedDate }}" class="border-2 border-black p-1.5 rounded font-bold w-full md:w-auto focus:outline-none text-sm">
            <button type="submit" class="bg-black text-white px-3 py-1 rounded font-bold text-sm border-2 border-black hover:bg-gray-800 whitespace-nowrap">CARI</button>
        </form>
    </div>

    <!-- Attendance Form -->
    <form action="{{ route('admin.attendance.store') }}" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ $selectedDate }}">
        <input type="hidden" name="session_type" value="{{ $sessionType }}">

        <div class="grid gap-3">
            @foreach($santris as $s)
            @php
                $log = $attendanceLogs->get($s->id);
                $logStatus = $log ? $log->status : null;
            @endphp
            <div class="bg-white p-4 border-4 border-black shadow-[4px_4px_0_0_#000] rounded-lg flex flex-col md:flex-row justify-between items-center gap-4 hover:translate-x-1 hover:translate-y-1 hover:shadow-none transition-all">
                <div class="flex items-center gap-3 w-full md:w-auto">
                    <div class="w-10 h-10 bg-gray-200 rounded-full border-2 border-black flex items-center justify-center font-black text-black">
                        {{ strtoupper(substr($s->name, 0, 1)) }}
                    </div>
                    <div>
                        <h3 class="font-bold text-sm leading-none">{{ $s->name }}</h3>
                        <span class="text-xs font-black {{ $logStatus ? 'text-emerald-500' : 'text-gray-400' }}">Saat ini: {{ $logStatus ?? 'KOSONG' }}</span>
                    </div>
                </div>

                <div class="flex gap-2 w-full md:w-auto justify-center md:justify-end">
                    <!-- HADIR -->
                    <label class="relative cursor-pointer inline-block">
                        <input type="radio" name="status[{{ $s->id }}]" value="H" {{ ($logStatus === 'H') ? 'checked' : '' }} class="attendance-radio absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="attendance-btn border-2 border-black px-3 py-2 rounded-lg font-black text-sm transition text-center w-20 bg-white text-black">
                            HADIR
                        </div>
                    </label>

                    <!-- IZIN -->
                    <label class="relative cursor-pointer inline-block">
                        <input type="radio" name="status[{{ $s->id }}]" value="I" {{ ($logStatus === 'I') ? 'checked' : '' }} class="attendance-radio absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="attendance-btn border-2 border-black px-3 py-2 rounded-lg font-black text-sm transition text-center w-20 bg-white text-black">
                            IZIN
                        </div>
                    </label>

                    <!-- ALPA -->
                    <label class="relative cursor-pointer inline-block">
                        <input type="radio" name="status[{{ $s->id }}]" value="A" {{ (!$logStatus || $logStatus === 'A') ? 'checked' : '' }} class="attendance-radio absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10">
                        <div class="attendance-btn border-2 border-black px-3 py-2 rounded-lg font-black text-sm transition text-center w-20 bg-white text-black">
                            ALPA
                        </div>
                    </label>
                </div>
            </div>
            @endforeach
        </div>

        <div class="fixed bottom-6 left-0 right-0 px-4 flex justify-center z-40">
            <button type="submit" class="bg-[#00E5FF] text-black px-8 py-4 rounded-full font-black text-lg border-4 border-black shadow-[4px_4px_0_0_#000] hover:translate-y-1 hover:shadow-none transition-all flex items-center gap-2">
                <span class="material-symbols-outlined">save</span> SIMPAN ABSEN {{ strtoupper($sessionLabel) }}
            </button>
        </div>
    </form>

</x-admin-layout>
