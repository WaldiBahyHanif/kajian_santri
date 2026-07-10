<x-app-layout>
    <x-slot name="header">
        <h2 class="font-black text-xl text-black dark:text-white uppercase tracking-tight">📅 Kalender Kegiatan</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-zinc-800 border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] p-4 sm:p-6">
                <!-- Legend -->
                <div class="flex flex-wrap gap-4 mb-4 text-xs font-bold">
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-[#FF007F] border-2 border-black"></div>
                        <span class="text-black dark:text-white">Event</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-[#39FF14] border-2 border-black"></div>
                        <span class="text-black dark:text-white">Kajian Event</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="w-4 h-4 rounded bg-[#00E5FF] border-2 border-black"></div>
                        <span class="text-black dark:text-white">Kajian Rutin</span>
                    </div>
                </div>

                <!-- Calendar Container -->
                <div id="calendar" class="min-h-[500px]"></div>
            </div>
        </div>
    </div>

    <!-- Event Detail Modal -->
    <div id="eventModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center hidden">
        <div class="bg-white border-4 border-black rounded-lg shadow-[8px_8px_0_0_#000] max-w-md w-full mx-4 p-6">
            <div class="flex justify-between items-start mb-4">
                <h3 id="modalTitle" class="font-black text-lg uppercase text-black"></h3>
                <button onclick="closeModal()" class="text-gray-400 hover:text-black">
                    <span class="material-symbols-outlined">close</span>
                </button>
            </div>
            <div id="modalBody" class="space-y-3 text-sm"></div>
        </div>
    </div>

    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/main.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/main.min.css" rel="stylesheet">
    <style>
        #calendar { font-family: 'Space Grotesk', sans-serif; }
        .fc-toolbar-title { font-weight: 900 !important; text-transform: uppercase; font-size: 1.25rem !important; }
        .fc-button { font-weight: 900 !important; text-transform: uppercase !important; border: 2px solid #000 !important; background: #fff !important; color: #000 !important; box-shadow: 2px 2px 0 0 #000 !important; }
        .fc-button:hover { transform: translate(1px, 1px); box-shadow: none !important; }
        .fc-button-active { background: #000 !important; color: #fff !important; box-shadow: none !important; }
        .fc-daygrid-day-frame { cursor: pointer; }
        .fc-daygrid-day-number { font-weight: 700 !important; }
        .fc-day-today { background: #FFDE00 !important; }
        .fc-event { cursor: pointer !important; border: 2px solid #000 !important; font-weight: 700 !important; font-size: 0.7rem !important; padding: 1px 3px !important; }
        .fc-event:hover { transform: translate(1px, 1px); box-shadow: 2px 2px 0 0 #000; }
        .dark .fc-toolbar-title { color: #fff !important; }
        .dark .fc-button { background: #27272a !important; color: #fff !important; border-color: #fff !important; box-shadow: 2px 2px 0 0 #fff !important; }
        .dark .fc-button:hover { box-shadow: none !important; }
        .dark .fc-button-active { background: #fff !important; color: #000 !important; }
        .dark .fc-daygrid-day-number { color: #fff !important; }
        .dark .fc-col-header-cell-cushion { color: #fff !important; }
        .dark .fc-day-other .fc-daygrid-day-top { opacity: 0.3; }
        .dark .fc-day-today { background: #3d3200 !important; }
        .dark .fc-theme-standard td, .dark .fc-theme-standard th { border-color: #444 !important; }
        .dark .fc-scrollgrid { border-color: #444 !important; }
        .fc-event-title { white-space: normal !important; }
    </style>

    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.15/index.global.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@fullcalendar/daygrid@6.1.15/index.global.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const calendarEl = document.getElementById('calendar');
            if (!calendarEl) return;

            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,dayGridWeek'
                },
                locale: 'id',
                firstDay: 1,
                height: 'auto',
                eventSources: [
                    {
                        url: '{{ route("kalender.data") }}',
                        method: 'GET',
                        extraParams: {
                            start: function() { return calendar.view.currentStart.toISOString().split('T')[0]; },
                            end: function() { return calendar.view.currentEnd.toISOString().split('T')[0]; }
                        },
                        failure: function() { console.error('Failed to load calendar events'); }
                    }
                ],
                eventClick: function(info) {
                    const props = info.event.extendedProps;
                    const html = `
                        <div class="mb-2">
                            <span class="text-xs font-black uppercase bg-black text-white px-2 py-0.5 rounded">${props.type_label || info.event.title}</span>
                        </div>
                        ${props.time ? `<div class="flex gap-2"><span class="material-symbols-outlined text-sm">schedule</span><span class="font-bold">${props.time}</span></div>` : ''}
                        ${props.location ? `<div class="flex gap-2"><span class="material-symbols-outlined text-sm">location_on</span><span class="font-bold">${props.location}</span></div>` : ''}
                        ${props.ustadz ? `<div class="flex gap-2"><span class="material-symbols-outlined text-sm">person</span><span class="font-bold">Ustadz: ${props.ustadz}</span></div>` : ''}
                        ${props.program ? `<div class="flex gap-2"><span class="material-symbols-outlined text-sm">menu_book</span><span class="font-bold">Program: ${props.program}</span></div>` : ''}
                        ${props.description ? `<div class="bg-gray-50 border-2 border-black rounded-lg p-3 mt-2"><p class="text-sm">${props.description}</p></div>` : ''}
                        <div class="mt-2">
                            <span class="text-xs text-gray-500">${info.event.start.toLocaleDateString('id-ID', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' })}</span>
                        </div>
                    `;
                    document.getElementById('modalTitle').textContent = info.event.title;
                    document.getElementById('modalBody').innerHTML = html;
                    document.getElementById('eventModal').classList.remove('hidden');
                },
                loading: function(isLoading) {
                    if (!isLoading) {
                        // Fix dark mode for calendar tables
                        if (document.documentElement.classList.contains('dark')) {
                            document.querySelectorAll('.fc-theme-standard td, .fc-theme-standard th, .fc-scrollgrid').forEach(el => {
                                el.style.borderColor = '#444';
                            });
                        }
                    }
                }
            });

            calendar.render();

            // Re-render on theme change
            const themeToggle = document.getElementById('theme-toggle');
            if (themeToggle) {
                themeToggle.addEventListener('click', function() {
                    setTimeout(() => {
                        document.querySelectorAll('.fc-theme-standard td, .fc-theme-standard th, .fc-scrollgrid').forEach(el => {
                            el.style.borderColor = document.documentElement.classList.contains('dark') ? '#444' : '';
                        });
                    }, 50);
                });
            }
        });

        function closeModal() {
            document.getElementById('eventModal').classList.add('hidden');
        }
    </script>
</x-app-layout>