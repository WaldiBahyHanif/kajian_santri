<x-admin-layout title="Kalender Kegiatan" active="kalender">

    <!-- Action Bar -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="font-black text-xl uppercase text-black">Event Kalender</h3>
        <button onclick="openCreateModal()" class="bg-[#39FF14] text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm flex items-center gap-2 cursor-pointer">
            <span class="material-symbols-outlined">add</span> TAMBAH EVENT
        </button>
    </div>

    <!-- Data -->
    @if($events->count() > 0)
        <div class="bg-white border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] overflow-hidden mb-6">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-black text-white font-black text-xs uppercase">
                        <tr>
                            <th class="text-left px-4 py-3">Judul</th>
                            <th class="text-left px-4 py-3">Tipe</th>
                            <th class="text-left px-4 py-3">Tanggal</th>
                            <th class="text-left px-4 py-3">Waktu</th>
                            <th class="text-center px-4 py-3">Status</th>
                            <th class="text-center px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black">
                        @foreach($events as $event)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3">
                                    <div class="flex items-center gap-2">
                                        <div class="w-4 h-4 rounded border-2 border-black" style="background: {{ $event->color ?? '#FF007F' }}"></div>
                                        <span class="font-bold text-black">{{ $event->title }}</span>
                                    </div>
                                </td>
                                <td class="px-4 py-3">
                                    <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded
                                        {{ $event->type === 'kajian' ? 'bg-[#39FF14] text-black' : '' }}
                                        {{ $event->type === 'acara' ? 'bg-purple-100 text-purple-700' : '' }}
                                        {{ $event->type === 'libur' ? 'bg-red-100 text-red-700' : '' }}
                                        {{ $event->type === 'tahsin' ? 'bg-blue-100 text-blue-700' : '' }}
                                        {{ $event->type === 'subuh' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                        {{ $event->type === 'other' ? 'bg-gray-100 text-gray-700' : '' }}
                                    ">
                                        {{ $event->type_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-bold text-xs text-black">
                                    {{ $event->formatted_date_range }}
                                </td>
                                <td class="px-4 py-3 text-xs text-gray-600">
                                    {{ $event->formatted_time ?? '-' }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($event->is_active)
                                        <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#39FF14] text-black">Aktif</span>
                                    @else
                                        <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-gray-200 text-gray-500">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <button onclick="openEditModal({{ $event->id }})" class="text-[#00E5FF] hover:text-black">
                                            <span class="material-symbols-outlined text-sm">edit</span>
                                        </button>
                                        <form action="{{ route('admin.kalender.destroy', $event->id) }}" method="POST" onsubmit="return confirm('Hapus event ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-800">
                                                <span class="material-symbols-outlined text-sm">delete</span>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $events->links() }}
    @else
        <div class="bg-white border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] p-12 text-center mb-6">
            <span class="material-symbols-outlined text-5xl text-gray-300 mb-3">calendar_month</span>
            <p class="text-gray-400 font-bold italic">Belum ada event kalender.</p>
        </div>
    @endif

    <!-- Mini Calendar View -->
    <div class="bg-white border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] p-4">
        <h4 class="font-black text-sm uppercase mb-3 text-black">📅 Preview Kalender</h4>
        <div id="adminCalendar" class="min-h-[400px]"></div>
    </div>

    <!-- Create/Edit Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center hidden">
        <div class="bg-white border-4 border-black rounded-lg shadow-[8px_8px_0_0_#000] max-w-lg w-full mx-4 p-6 max-h-[90vh] overflow-y-auto">
            <div class="flex justify-between items-start mb-4">
                <h3 id="modalTitle" class="font-black text-lg uppercase text-black">Tambah Event</h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-black cursor-pointer">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>

            <form id="eventForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="mb-4">
                    <label class="block font-black text-xs uppercase mb-1">Judul Event</label>
                    <input type="text" name="title" id="eventTitle" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm" required>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block font-black text-xs uppercase mb-1">Tipe</label>
                        <select name="type" id="eventType" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm" required>
                            <option value="kajian">Kajian</option>
                            <option value="acara">Acara</option>
                            <option value="libur">Libur</option>
                            <option value="tahsin">Tahsin</option>
                            <option value="subuh">Subuh Berjama'ah</option>
                            <option value="other">Lainnya</option>
                        </select>
                    </div>
                    <div>
                        <label class="block font-black text-xs uppercase mb-1">Warna</label>
                        <input type="color" name="color" id="eventColor" class="w-full h-[42px] border-4 border-black rounded-lg p-1" value="#FF007F">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block font-black text-xs uppercase mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date" id="eventStartDate" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm" required>
                    </div>
                    <div>
                        <label class="block font-black text-xs uppercase mb-1">Tanggal Selesai</label>
                        <input type="date" name="end_date" id="eventEndDate" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm">
                    </div>
                </div>

                <div class="grid grid-cols-2 gap-3 mb-4">
                    <div>
                        <label class="block font-black text-xs uppercase mb-1">Waktu Mulai</label>
                        <input type="time" name="start_time" id="eventStartTime" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm">
                    </div>
                    <div>
                        <label class="block font-black text-xs uppercase mb-1">Waktu Selesai</label>
                        <input type="time" name="end_time" id="eventEndTime" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block font-black text-xs uppercase mb-1">Lokasi</label>
                    <input type="text" name="location" id="eventLocation" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm">
                </div>

                <div class="mb-4">
                    <label class="block font-black text-xs uppercase mb-1">Deskripsi</label>
                    <textarea name="description" id="eventDescription" rows="3" class="w-full border-4 border-black rounded-lg px-4 py-2 font-bold text-sm"></textarea>
                </div>

                <div class="mb-4 flex items-center gap-2">
                    <input type="checkbox" name="is_active" id="eventIsActive" value="1" checked class="w-5 h-5 border-4 border-black">
                    <label for="eventIsActive" class="font-black text-xs uppercase">Aktif</label>
                </div>

                <div class="flex gap-2">
                    <button type="submit" class="bg-[#FF007F] text-white border-4 border-black px-6 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm">
                        SIMPAN
                    </button>
                    <button type="button" onclick="closeModal()" class="bg-gray-200 text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm cursor-pointer">
                        BATAL
                    </button>
                </div>
            </form>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/main.min.css" rel="stylesheet">
    <style>
        #adminCalendar { font-family: 'Space Grotesk', sans-serif; }
        .fc-toolbar-title { font-weight: 900 !important; text-transform: uppercase; font-size: 1rem !important; }
        .fc-button { font-weight: 900 !important; text-transform: uppercase !important; border: 2px solid #000 !important; background: #fff !important; color: #000 !important; box-shadow: 2px 2px 0 0 #000 !important; font-size: 0.7rem !important; padding: 3px 8px !important; }
        .fc-button:hover { transform: translate(1px, 1px); box-shadow: none !important; }
        .fc-button-active { background: #000 !important; color: #fff !important; }
        .fc-day-today { background: #FFDE00 !important; }
        .fc-event { cursor: pointer !important; border: 2px solid #000 !important; font-weight: 700 !important; font-size: 0.65rem !important; padding: 1px 3px !important; }
        .dark .fc-toolbar-title { color: #fff !important; }
        .dark .fc-button { background: #27272a !important; color: #fff !important; border-color: #fff !important; box-shadow: 2px 2px 0 0 #fff !important; }
        .dark .fc-button:hover { box-shadow: none !important; }
        .dark .fc-button-active { background: #fff !important; color: #000 !important; }
        .dark .fc-daygrid-day-number { color: #fff !important; }
        .dark .fc-col-header-cell-cushion { color: #fff !important; }
        .dark .fc-day-today { background: #3d3200 !important; }
        .dark .fc-theme-standard td, .dark .fc-theme-standard th { border-color: #444 !important; }
        .dark .fc-scrollgrid { border-color: #444 !important; }
    </style>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script>
    <script>
        let adminCalendar;

        document.addEventListener('DOMContentLoaded', function () {
            const el = document.getElementById('adminCalendar');
            if (!el) return;

            adminCalendar = new FullCalendar.Calendar(el, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next',
                    center: 'title',
                    right: 'today'
                },
                locale: 'id',
                firstDay: 1,
                height: 'auto',
                events: '{{ route("admin.kalender.data") }}',
                eventClick: function(info) {
                    alert(info.event.title + '\n' + (info.event.extendedProps.description || ''));
                }
            });
            adminCalendar.render();
        });

        function openCreateModal() {
            document.getElementById('modalTitle').textContent = 'Tambah Event';
            document.getElementById('formMethod').value = 'POST';
            document.getElementById('eventForm').action = '{{ route("admin.kalender.store") }}';
            document.getElementById('eventTitle').value = '';
            document.getElementById('eventType').value = 'kajian';
            document.getElementById('eventColor').value = '#FF007F';
            document.getElementById('eventStartDate').value = '';
            document.getElementById('eventEndDate').value = '';
            document.getElementById('eventStartTime').value = '';
            document.getElementById('eventEndTime').value = '';
            document.getElementById('eventLocation').value = '';
            document.getElementById('eventDescription').value = '';
            document.getElementById('eventIsActive').checked = true;
            document.getElementById('eventModal').classList.remove('hidden');
        }

        function openEditModal(id) {
            // Fetch event data via API
            fetch('{{ route("admin.kalender.data") }}')
                .then(r => r.json())
                .then(events => {
                    const event = events.find(e => e.id === id);
                    if (!event) return;
                    document.getElementById('modalTitle').textContent = 'Edit Event';
                    document.getElementById('formMethod').value = 'PUT';
                    document.getElementById('eventForm').action = '{{ url("admin/kalender") }}/' + id;
                    document.getElementById('eventTitle').value = event.title;
                    document.getElementById('eventType').value = event.extendedProps?.type || 'other';
                    document.getElementById('eventColor').value = event.backgroundColor || '#FF007F';
                    document.getElementById('eventStartDate').value = event.start;
                    document.getElementById('eventEndDate').value = event.end ? new Date(event.end).toISOString().split('T')[0] : '';
                    document.getElementById('eventStartTime').value = event.extendedProps?.time || '';
                    document.getElementById('eventEndTime').value = '';
                    document.getElementById('eventLocation').value = event.extendedProps?.location || '';
                    document.getElementById('eventDescription').value = event.extendedProps?.description || '';
                    document.getElementById('eventIsActive').checked = true;
                    document.getElementById('eventModal').classList.remove('hidden');
                });
        }

        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>