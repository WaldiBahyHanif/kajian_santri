<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8"/>
    <script>
        if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1"/>
    <title>Isi Absensi Liqo - Daaru Hiraa</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        :root {
            --primary: #003527;
            --on-primary: #ffffff;
            --background: #f9fafb;
            --on-background: #111827;
            --on-surface-variant: #4b5563;
            --error: #ba1a1a;
            --tertiary: #92700a;
        }
        .dark {
            --primary: #4ade80;
            --on-primary: #002117;
            --background: #09090b;
            --on-background: #f4f4f5;
            --on-surface-variant: #9ca3af;
            --error: #f87171;
            --tertiary: #ffdf9f;
        }

        body {
            font-family: 'Inter', sans-serif;
        }
        .font-display {
            font-family: 'Space Grotesk', sans-serif;
        }

        .liqo-bg {
            background: linear-gradient(135deg, #ffffff 0%, #eafaf3 45%, #f3fbf8 100%);
            min-height: 100vh;
        }
        .dark .liqo-bg {
            background: linear-gradient(135deg, #09090b 0%, #0a1f16 45%, #09090b 100%);
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.86);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.6);
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(17, 24, 39, 0.08);
        }
        .dark .glass-panel {
            background: rgba(24, 24, 27, 0.82);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.35);
        }

        .counter-pill {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }
        .dark .counter-pill {
            background: rgba(39, 39, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .status-btn {
            border: 1.5px solid var(--on-surface-variant);
            color: var(--on-surface-variant);
            background: transparent;
            opacity: 0.6;
            transition: transform 0.12s ease, opacity 0.12s ease, background-color 0.12s ease, color 0.12s ease;
        }
        .status-btn.active {
            background: var(--primary);
            border-color: var(--primary);
            color: var(--on-primary);
            opacity: 1;
            transform: scale(1.05);
        }
        .status-btn:active {
            transform: scale(0.95);
        }

        .submit-btn-ready {
            background: var(--primary);
            color: var(--on-primary);
            box-shadow: 0 10px 24px rgba(0, 53, 39, 0.25);
        }
        .submit-btn-idle {
            background: transparent;
            color: var(--on-surface-variant);
            border: 1.5px solid var(--on-surface-variant);
        }

        input[type="date"], select, input[type="text"], textarea {
            background: rgba(255, 255, 255, 0.7);
            border: 1.5px solid rgba(17, 24, 39, 0.15);
        }
        .dark input[type="date"], .dark select, .dark input[type="text"], .dark textarea {
            background: rgba(39, 39, 42, 0.7);
            border: 1.5px solid rgba(255, 255, 255, 0.12);
            color: var(--on-background);
        }

        @media (prefers-reduced-motion: reduce) {
            .status-btn, .counter-pill, .submit-btn-ready { transition: none; }
        }
    </style>
</head>
<body class="liqo-bg text-on-background">

<div class="max-w-xl mx-auto px-4 pt-6 pb-32">

    <!-- Counter Pill -->
    <div id="counter-pill" class="counter-pill sticky top-3 z-30 mx-auto w-fit px-5 py-2 rounded-full font-display font-bold text-sm flex items-center gap-2 mb-5">
        <span id="counter-icon">📋</span>
        <span id="counter-text">Pilih MR &amp; tanggal dulu</span>
    </div>

    <h1 class="font-display text-2xl font-bold text-center mb-1">Absensi Liqo</h1>
    <p class="text-center text-sm text-on-surface-variant mb-6">Isi kehadiran kelompokmu setelah sesi liqo selesai</p>

    @if (session('success'))
        <div class="glass-panel p-4 mb-5 text-sm font-semibold" style="color: var(--primary)">
            ✅ {{ session('success') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="glass-panel p-4 mb-5 text-sm font-semibold" style="color: var(--error)">
            <p class="mb-1">Ada yang perlu diperbaiki:</p>
            <ul class="list-disc list-inside space-y-0.5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form id="liqo-form" method="POST" action="{{ route('liqo.store', $code) }}">
        @csrf

        <div class="glass-panel p-5 mb-5">
            <label class="block text-xs font-bold uppercase tracking-wide text-on-surface-variant mb-1.5">Nama MR</label>
            <select id="liqo_group_id" name="liqo_group_id" required class="w-full rounded-xl px-4 py-3 font-semibold focus:outline-none mb-4">
                <option value="" disabled {{ old('liqo_group_id') ? '' : 'selected' }}>-- Pilih Nama MR --</option>
                @foreach ($groups as $group)
                    <option value="{{ $group->id }}" {{ (string) old('liqo_group_id') === (string) $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                @endforeach
            </select>

            <label class="block text-xs font-bold uppercase tracking-wide text-on-surface-variant mb-1.5">Tanggal</label>
            <input type="date" id="attendance_date" name="attendance_date"
                   value="{{ old('attendance_date', $maxDate) }}"
                   min="{{ $minDate }}" max="{{ $maxDate }}" required
                   class="w-full rounded-xl px-4 py-3 font-semibold focus:outline-none">
        </div>

        <div id="roster-panel" class="glass-panel p-5 mb-5 hidden">
            <p class="text-xs font-bold uppercase tracking-wide text-on-surface-variant mb-3">Checklist Kehadiran</p>
            <div id="roster-list" class="space-y-2 max-h-80 overflow-y-auto pr-1"></div>
        </div>

        <div id="roster-empty" class="glass-panel p-5 mb-5 text-center text-sm text-on-surface-variant">
            Pilih nama MR dan tanggal untuk menampilkan daftar santri kelompokmu.
        </div>

        <div class="glass-panel p-5 mb-5">
            <label class="block text-xs font-bold uppercase tracking-wide text-on-surface-variant mb-1.5">Materi</label>
            <input type="text" name="materi" maxlength="100" required value="{{ old('materi') }}"
                   placeholder="Contoh: Adab menuntut ilmu"
                   class="w-full rounded-xl px-4 py-3 font-semibold focus:outline-none mb-4">

            <label class="block text-xs font-bold uppercase tracking-wide text-on-surface-variant mb-1.5">Catatan Tambahan <span class="font-normal normal-case">(opsional)</span></label>
            <textarea name="catatan" rows="3" placeholder="Catatan untuk admin, kalau ada..."
                      class="w-full rounded-xl px-4 py-3 focus:outline-none">{{ old('catatan') }}</textarea>
        </div>
    </form>
</div>

<!-- Sticky Submit Bar -->
<div class="fixed bottom-0 left-0 w-full px-4 pb-5 pt-3 pointer-events-none">
    <div class="max-w-xl mx-auto pointer-events-auto">
        <button type="submit" form="liqo-form" id="submit-btn" disabled
                class="submit-btn-idle w-full py-4 rounded-2xl font-display font-bold text-base transition-all">
            Simpan Absensi
        </button>
    </div>
</div>

<script>
(function () {
    const groupSelect = document.getElementById('liqo_group_id');
    const dateInput = document.getElementById('attendance_date');
    const rosterPanel = document.getElementById('roster-panel');
    const rosterEmpty = document.getElementById('roster-empty');
    const rosterList = document.getElementById('roster-list');
    const materiInput = document.querySelector('input[name="materi"]');
    const catatanInput = document.querySelector('textarea[name="catatan"]');
    const counterText = document.getElementById('counter-text');
    const counterIcon = document.getElementById('counter-icon');
    const submitBtn = document.getElementById('submit-btn');

    const rosterRouteBase = @json(url('/liqo/' . $code . '/roster'));

    const oldStatuses = @json(old('statuses', []));
    const oldMateri = @json(old('materi'));
    const oldCatatan = @json(old('catatan'));

    let currentStudents = [];

    function updateCounterAndButton() {
        const checkedCount = currentStudents.filter(s => {
            const input = document.querySelector(`input[name="statuses[${s.id}]"]`);
            return input && input.value;
        }).length;
        const total = currentStudents.length;

        if (total === 0) {
            counterText.textContent = 'Pilih MR & tanggal dulu';
            counterIcon.textContent = '📋';
        } else {
            counterText.textContent = `${checkedCount}/${total} santri dicek`;
            counterIcon.textContent = checkedCount === total ? '✅' : '📋';
        }

        const materiFilled = materiInput.value.trim().length > 0;
        const ready = total > 0 && checkedCount === total && materiFilled;

        submitBtn.disabled = !ready;
        submitBtn.className = 'w-full py-4 rounded-2xl font-display font-bold text-base transition-all ' +
            (ready ? 'submit-btn-ready' : 'submit-btn-idle');
    }

    function setStatus(studentId, status, container) {
        const input = container.querySelector(`input[name="statuses[${studentId}]"]`);
        input.value = status;
        container.querySelectorAll('.status-btn').forEach(btn => {
            btn.classList.toggle('active', btn.dataset.status === status);
        });
        updateCounterAndButton();
    }

    function renderRoster(students, statuses) {
        currentStudents = students;
        rosterList.innerHTML = '';

        if (students.length === 0) {
            rosterPanel.classList.add('hidden');
            rosterEmpty.classList.remove('hidden');
            rosterEmpty.textContent = 'Kelompok ini belum punya santri aktif. Hubungi admin untuk menambahkan anggota.';
            updateCounterAndButton();
            return;
        }

        rosterEmpty.classList.add('hidden');
        rosterPanel.classList.remove('hidden');

        const labels = { H: 'Hadir', I: 'Izin', A: 'Alpha' };

        students.forEach(student => {
            const row = document.createElement('div');
            row.className = 'flex items-center justify-between gap-2 py-1.5';

            const name = document.createElement('span');
            name.className = 'font-semibold text-sm flex-1 truncate';
            name.textContent = student.name;

            const btnGroup = document.createElement('div');
            btnGroup.className = 'flex gap-1.5 flex-shrink-0';

            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = `statuses[${student.id}]`;
            hiddenInput.value = statuses[student.id] || '';

            Object.keys(labels).forEach(code => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.dataset.status = code;
                btn.className = 'status-btn px-2.5 py-1.5 rounded-lg text-xs font-bold';
                btn.textContent = labels[code];
                btn.addEventListener('click', () => setStatus(student.id, code, row));
                btnGroup.appendChild(btn);
            });

            row.appendChild(name);
            row.appendChild(btnGroup);
            row.appendChild(hiddenInput);
            rosterList.appendChild(row);

            if (hiddenInput.value) {
                row.querySelectorAll('.status-btn').forEach(btn => {
                    btn.classList.toggle('active', btn.dataset.status === hiddenInput.value);
                });
            }
        });

        updateCounterAndButton();
    }

    function loadRoster(applyOld) {
        const groupId = groupSelect.value;
        const date = dateInput.value;

        if (!groupId || !date) {
            rosterPanel.classList.add('hidden');
            rosterEmpty.classList.remove('hidden');
            rosterEmpty.textContent = 'Pilih nama MR dan tanggal untuk menampilkan daftar santri kelompokmu.';
            currentStudents = [];
            updateCounterAndButton();
            return;
        }

        const url = `${rosterRouteBase}?liqo_group_id=${encodeURIComponent(groupId)}&date=${encodeURIComponent(date)}`;

        fetch(url, { headers: { 'Accept': 'application/json' } })
            .then(res => res.json())
            .then(data => {
                const statuses = (applyOld && oldStatuses && Object.keys(oldStatuses).length)
                    ? oldStatuses
                    : (data.statuses || {});

                renderRoster(data.students || [], statuses);

                if (applyOld && oldMateri) {
                    materiInput.value = oldMateri;
                } else if (!materiInput.value && data.materi) {
                    materiInput.value = data.materi;
                }

                if (applyOld && oldCatatan) {
                    catatanInput.value = oldCatatan;
                } else if (!catatanInput.value && data.catatan) {
                    catatanInput.value = data.catatan;
                }

                updateCounterAndButton();
            })
            .catch(() => {
                rosterEmpty.textContent = 'Gagal memuat daftar santri. Coba lagi.';
                rosterEmpty.classList.remove('hidden');
                rosterPanel.classList.add('hidden');
            });
    }

    groupSelect.addEventListener('change', () => loadRoster(false));
    dateInput.addEventListener('change', () => loadRoster(false));
    materiInput.addEventListener('input', updateCounterAndButton);

    // Restore state after a failed submit (validation errors) or deep link.
    const hasOldSelection = groupSelect.value && dateInput.value;
    if (hasOldSelection) {
        loadRoster(true);
    }
})();
</script>

</body>
</html>
