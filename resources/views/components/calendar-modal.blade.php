<!-- Calendar Modal (Indonesia & Hijriah) -->
<div id="calendar-modal" class="fixed inset-0 z-[100] hidden bg-on-background/50 flex items-center justify-center p-4">
    <div class="bg-surface border-3 border-on-background rounded-xl p-6 neobrutal-shadow max-w-md w-full relative transition-all">
        <!-- Close Button -->
        <button type="button" onclick="closeCalendarModal()" class="absolute top-4 right-4 bg-error text-on-error w-8 h-8 rounded border-2 border-on-background hover:scale-105 active:scale-95 transition-transform flex items-center justify-center font-bold shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:shadow-none cursor-pointer">
            <span class="material-symbols-outlined text-lg">close</span>
        </button>

        <!-- Header -->
        <div class="flex items-center gap-3 mb-5 border-b-3 border-on-background pb-3">
            <span class="material-symbols-outlined text-primary text-3xl">calendar_month</span>
            <div>
                <h2 class="font-headline-md text-lg font-black text-primary leading-tight">Kalender Kajian</h2>
                <p class="text-[10px] text-on-surface-variant font-label-sm uppercase font-bold mt-0.5">Indonesia & Hijriah</p>
            </div>
        </div>

        <!-- Month Navigation -->
        <div class="flex justify-between items-center mb-4">
            <button onclick="prevMonth()" class="bg-secondary-container text-on-secondary-container px-3 py-1.5 rounded border-2 border-on-background hover:translate-y-[-1px] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all font-bold cursor-pointer">
                &larr;
            </button>
            <span id="calendar-month-year" class="font-headline-md text-base font-black text-primary tracking-tight"></span>
            <button onclick="nextMonth()" class="bg-secondary-container text-on-secondary-container px-3 py-1.5 rounded border-2 border-on-background hover:translate-y-[-1px] shadow-[2px_2px_0px_0px_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none transition-all font-bold cursor-pointer">
                &rarr;
            </button>
        </div>

        <!-- Day Names -->
        <div class="grid grid-cols-7 gap-1 text-center font-black text-xs mb-2 text-on-surface-variant">
            <div class="text-error">Ahd</div>
            <div>Sen</div>
            <div>Sel</div>
            <div>Rab</div>
            <div>Kam</div>
            <div>Jum</div>
            <div>Sab</div>
        </div>

        <!-- Days Grid -->
        <div id="calendar-days" class="grid grid-cols-7 gap-1.5 min-h-[220px]"></div>

        <!-- Information Panel -->
        <div id="calendar-info" class="mt-4 p-3 bg-secondary-container text-on-secondary-container border-3 border-on-background rounded-lg text-xs font-bold leading-relaxed shadow-[3px_3px_0px_0px_rgba(0,0,0,1)]">
            <div class="flex items-start gap-2">
                <span class="material-symbols-outlined text-base">info</span>
                <span id="calendar-info-text">Klik tanggal merah untuk info hari libur.</span>
            </div>
        </div>
    </div>
</div>

<script>
    const hijriMonths = [
        "Muharram", "Safar", "Rabi'ul Awal", "Rabi'ul Akhir",
        "Jumadil Awal", "Jumadil Akhir", "Rajab", "Sya'ban",
        "Ramadhan", "Syawal", "Dzulqa'dah", "Dzulhijjah"
    ];

    const indonesianMonths = [
        "Januari", "Februari", "Maret", "April", "Mei", "Juni",
        "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    // Indonesian National Holidays
    const holidays = {
        // 2025
        "2025-01-01": "Tahun Baru 2025 Masehi",
        "2025-01-27": "Isra Mi'raj Nabi Muhammad SAW",
        "2025-01-29": "Tahun Baru Imlek 2576 Kongzili",
        "2025-03-29": "Hari Suci Nyepi (Tahun Baru Saka 1947)",
        "2025-03-31": "Hari Raya Idul Fitri 1446 H",
        "2025-04-01": "Hari Raya Idul Fitri 1446 H",
        "2025-04-18": "Wafat Yesus Kristus",
        "2025-04-20": "Hari Paskah",
        "2025-05-01": "Hari Buruh Internasional",
        "2025-05-12": "Hari Raya Waisak 2569 BE",
        "2025-05-29": "Kenaikan Yesus Kristus",
        "2025-06-01": "Hari Lahir Pancasila",
        "2025-06-06": "Hari Raya Idul Adha 1446 H",
        "2025-06-27": "Tahun Baru Islam 1447 H",
        "2025-08-17": "Hari Kemerdekaan RI",
        "2025-09-05": "Maulid Nabi Muhammad SAW",
        "2025-12-25": "Hari Raya Natal",

        // 2026
        "2026-01-01": "Tahun Baru 2026 Masehi",
        "2026-02-15": "Isra Mi'raj Nabi Muhammad SAW",
        "2026-02-17": "Tahun Baru Imlek 2577 Kongzili",
        "2026-03-19": "Hari Suci Nyepi (Tahun Baru Saka 1948)",
        "2026-03-20": "Hari Raya Idul Fitri 1447 H",
        "2026-03-21": "Hari Raya Idul Fitri 1447 H",
        "2026-04-03": "Wafat Yesus Kristus",
        "2026-04-05": "Hari Paskah",
        "2026-05-01": "Hari Buruh Internasional",
        "2026-05-14": "Kenaikan Yesus Kristus",
        "2026-05-27": "Hari Raya Idul Adha 1447 H",
        "2026-06-01": "Hari Lahir Pancasila",
        "2026-06-01": "Hari Raya Waisak 2570 BE",
        "2026-06-16": "Tahun Baru Islam 1448 H (1 Hijriah) 🔴",
        "2026-08-17": "Hari Kemerdekaan RI",
        "2026-08-25": "Maulid Nabi Muhammad SAW",
        "2026-12-25": "Hari Raya Natal",

        // 2027
        "2027-01-01": "Tahun Baru 2027 Masehi",
        "2027-02-06": "Tahun Baru Imlek 2578 Kongzili",
        "2027-02-06": "Isra Mi'raj Nabi Muhammad SAW",
        "2027-03-09": "Hari Raya Idul Fitri 1448 H",
        "2027-03-10": "Hari Raya Idul Fitri 1448 H",
        "2027-03-26": "Wafat Yesus Kristus",
        "2027-03-28": "Hari Paskah",
        "2027-05-01": "Hari Buruh Internasional",
        "2027-05-03": "Kenaikan Yesus Kristus",
        "2027-05-16": "Hari Raya Idul Adha 1448 H",
        "2027-05-20": "Hari Raya Waisak 2571 BE",
        "2027-06-01": "Hari Lahir Pancasila",
        "2027-06-06": "Tahun Baru Islam 1449 H",
        "2027-08-15": "Maulid Nabi Muhammad SAW",
        "2027-08-17": "Hari Kemerdekaan RI",
        "2027-12-25": "Hari Raya Natal"
    };

    // Hijri Calibration Maps (Direct Date Mapping for Islamic Holidays)
    const hijriCalibration = {
        // 2025
        "2025-01-27": { day: 27, month: 6, year: 1446 },  // 27 Rajab
        "2025-03-01": { day: 1, month: 8, year: 1446 },   // 1 Ramadhan
        "2025-03-31": { day: 1, month: 9, year: 1446 },   // 1 Syawal
        "2025-04-01": { day: 2, month: 9, year: 1446 },   // 2 Syawal
        "2025-06-06": { day: 10, month: 11, year: 1446 }, // 10 Dzulhijjah
        "2025-06-27": { day: 1, month: 0, year: 1447 },   // 1 Muharram
        "2025-09-05": { day: 12, month: 2, year: 1447 },  // 12 Rabi'ul Awal

        // 2026
        "2026-02-15": { day: 27, month: 6, year: 1447 },  // 27 Rajab
        "2026-02-18": { day: 1, month: 8, year: 1447 },   // 1 Ramadhan
        "2026-03-20": { day: 1, month: 9, year: 1447 },   // 1 Syawal
        "2026-03-21": { day: 2, month: 9, year: 1447 },   // 2 Syawal
        "2026-05-27": { day: 10, month: 11, year: 1447 }, // 10 Dzulhijjah
        "2026-06-16": { day: 1, month: 0, year: 1448 },   // 1 Muharram 1448 H (1 Hijriah)
        "2026-08-25": { day: 12, month: 2, year: 1448 },  // 12 Rabi'ul Awal

        // 2027
        "2027-02-06": { day: 27, month: 6, year: 1448 },  // 27 Rajab
        "2027-02-08": { day: 1, month: 8, year: 1448 },   // 1 Ramadhan
        "2027-03-09": { day: 1, month: 9, year: 1448 },   // 1 Syawal
        "2027-03-10": { day: 2, month: 9, year: 1448 },   // 2 Syawal
        "2027-05-16": { day: 10, month: 11, year: 1448 }, // 10 Dzulhijjah
        "2027-06-06": { day: 1, month: 0, year: 1449 },   // 1 Muharram
        "2027-08-15": { day: 12, month: 2, year: 1449 },  // 12 Rabi'ul Awal
    };

    let currentCalendarDate = new Date();

    function openCalendarModal() {
        document.getElementById('calendar-modal').classList.remove('hidden');
        renderCalendar();
    }

    function closeCalendarModal() {
        document.getElementById('calendar-modal').classList.add('hidden');
    }

    function prevMonth() {
        currentCalendarDate.setDate(1); // Mencegah bug lompat bulan pada tanggal 31
        currentCalendarDate.setMonth(currentCalendarDate.getMonth() - 1);
        renderCalendar();
    }

    function nextMonth() {
        currentCalendarDate.setDate(1); // Mencegah bug lompat bulan pada tanggal 31
        currentCalendarDate.setMonth(currentCalendarDate.getMonth() + 1);
        renderCalendar();
    }

    function getHijriDate(date) {
        const dateString = date.getFullYear() + "-" + 
            String(date.getMonth() + 1).padStart(2, '0') + "-" + 
            String(date.getDate()).padStart(2, '0');

        // Gunakan kalibrasi manual untuk hari libur/besar Islam jika terdefinisi
        if (hijriCalibration[dateString]) {
            return hijriCalibration[dateString];
        }

        try {
            // Gunakan API Intl bawaan browser (100% akurat berbasis Umm al-Qura)
            const formatter = new Intl.DateTimeFormat('id-ID-u-ca-islamic-umalqura', {
                day: 'numeric',
                month: 'numeric',
                year: 'numeric'
            });
            const parts = formatter.formatToParts(date);
            
            let day = date.getDate();
            let month = date.getMonth();
            let year = date.getFullYear();

            parts.forEach(part => {
                if (part.type === 'day') day = parseInt(part.value, 10);
                if (part.type === 'month') month = parseInt(part.value, 10) - 1; // 0-indexed untuk array hijriMonths
                if (part.type === 'year') year = parseInt(part.value, 10);
            });

            return { day: day, month: month, year: year };
        } catch (e) {
            // Fallback ke perhitungan algoritma matematika tabular jika Intl tidak didukung
            return getHijriDateFallback(date);
        }
    }

    function getHijriDateFallback(date) {
        let y = date.getFullYear();
        let m = date.getMonth();
        let d = date.getDate();

        if (m < 2) {
            y -= 1;
            m += 12;
        }
        let a = Math.floor(y / 100);
        let b = Math.floor(a / 4);
        let c = 2 - a + b;
        let e = Math.floor(365.25 * (y + 4716));
        let f = Math.floor(30.6001 * (m + 1));
        let jd = c + d + e + f - 1524.5;
        let ijd = Math.round(jd);

        let offset = -2;
        let l = ijd - 1948440 + 10630 + offset;
        let n = Math.floor((l - 1) / 10631);
        l = l - 10631 * n + 354;
        let j = (Math.floor((10985 - l) / 5316)) * (Math.floor((50 * l) / 17719)) + (Math.floor(l / 5670)) * (Math.floor((43 * l) / 15238));
        l = l - (Math.floor((30 - j) / 15)) * (Math.floor((17719 * j) / 50)) - (Math.floor(j / 16)) * (Math.floor((15238 * j) / 43)) + 29;
        let month = Math.floor((24 * l) / 709);
        let day = l - Math.floor((709 * month) / 24);
        let year = 30 * n + j - 30;

        month = (month - 1 + 12) % 12;

        return { day: day, month: month, year: year };
    }

    function renderCalendar() {
        const year = currentCalendarDate.getFullYear();
        const month = currentCalendarDate.getMonth();

        // Month & Year header
        document.getElementById('calendar-month-year').innerText = indonesianMonths[month] + " " + year;

        const firstDayIndex = new Date(year, month, 1).getDay();
        const lastDay = new Date(year, month + 1, 0).getDate();
        const prevLastDay = new Date(year, month, 0).getDate();

        const daysContainer = document.getElementById('calendar-days');
        daysContainer.innerHTML = "";

        const today = new Date();

        // Previous month's trailing days (blank/disabled)
        for (let x = firstDayIndex; x > 0; x--) {
            const dayDiv = document.createElement('div');
            dayDiv.className = "bg-surface-variant/20 border border-dashed border-outline-variant/40 rounded-lg p-1.5 h-14 flex items-center justify-center text-on-surface-variant/20 font-medium text-xs pointer-events-none";
            dayDiv.innerText = prevLastDay - x + 1;
            daysContainer.appendChild(dayDiv);
        }

        // Current month's days
        for (let i = 1; i <= lastDay; i++) {
            const currentDate = new Date(year, month, i);
            const dateString = year + "-" + String(month + 1).padStart(2, '0') + "-" + String(i).padStart(2, '0');
            const dayOfWeek = currentDate.getDay();
            
            const isToday = today.getDate() === i && today.getMonth() === month && today.getFullYear() === year;
            const isSunday = dayOfWeek === 0;
            const holidayName = holidays[dateString];
            const isRedDate = isSunday || holidayName;

            const hijri = getHijriDate(currentDate);

            // Container div
            const dayDiv = document.createElement('button');
            dayDiv.type = "button";
            
            // Build neobrutalist class lists
            let bgClass = "bg-surface";
            let borderClass = "border-2 border-on-background";
            let textClass = "text-on-background";

            if (isRedDate) {
                bgClass = "bg-red-100 dark:bg-red-950/30";
                borderClass = "border-2 border-error";
                textClass = "text-error font-black";
            }

            if (isToday) {
                bgClass = "bg-secondary-container";
                borderClass = "border-3 border-on-background ring-2 ring-primary shadow-[2px_2px_0px_0px_rgba(0,0,0,1)]";
                textClass = "text-on-secondary-container font-black";
            }

            dayDiv.className = `${bgClass} ${borderClass} ${textClass} rounded-lg p-1 h-14 flex flex-col justify-between items-center transition-all hover:-translate-y-0.5 hover:shadow-[3px_3px_0px_0px_rgba(0,0,0,1)] active:translate-y-0 active:shadow-none cursor-pointer overflow-hidden`;
            
            // On click, show holiday or Hijri info
            dayDiv.onclick = () => {
                const infoBox = document.getElementById('calendar-info');
                const infoText = document.getElementById('calendar-info-text');
                
                let text = `Tanggal Masehi: ${i} ${indonesianMonths[month]} ${year}<br>Tanggal Hijriah: ${hijri.day} ${hijriMonths[hijri.month]} ${hijri.year} H`;
                if (holidayName) {
                    text += `<br><span class="text-error font-bold flex items-center gap-1 mt-1"><span class="material-symbols-outlined text-sm">campaign</span> Hari Libur: ${holidayName}</span>`;
                }
                
                infoText.innerHTML = text;
                infoBox.classList.remove('hidden');
                
                // Visual bounce effect on click
                dayDiv.classList.add('scale-95');
                setTimeout(() => dayDiv.classList.remove('scale-95'), 150);
            };

            // HTML content: Masehi Date & Hijri Day label
            dayDiv.innerHTML = `
                <span class="text-sm font-bold block leading-none select-none">${i}</span>
                <span class="text-[8px] font-medium leading-none block select-none ${isRedDate ? 'text-error' : 'text-on-surface-variant'}">${hijri.day} ${hijriMonths[hijri.month].substring(0,4)}.</span>
            `;

            daysContainer.appendChild(dayDiv);
        }

        // Next month's leading days (blank/disabled)
        const totalCells = firstDayIndex + lastDay;
        const nextDays = totalCells % 7 === 0 ? 0 : 7 - (totalCells % 7);
        for (let y = 1; y <= nextDays; y++) {
            const dayDiv = document.createElement('div');
            dayDiv.className = "bg-surface-variant/20 border border-dashed border-outline-variant/40 rounded-lg p-1.5 h-14 flex items-center justify-center text-on-surface-variant/20 font-medium text-xs pointer-events-none";
            dayDiv.innerText = y;
            daysContainer.appendChild(dayDiv);
        }
    }

    // Automatically bind all calendar buttons on page load
    document.addEventListener("DOMContentLoaded", () => {
        // Find any icon button in header containing "calendar_month"
        const calendarIcons = document.querySelectorAll(".material-symbols-outlined");
        calendarIcons.forEach(icon => {
            if (icon.textContent.trim() === "calendar_month") {
                // If it is a bare span icon, wrap/make it a button
                const parent = icon.parentElement;
                icon.classList.add("cursor-pointer");
                icon.addEventListener("click", (e) => {
                    e.preventDefault();
                    openCalendarModal();
                });
            }
        });
    });
</script>
