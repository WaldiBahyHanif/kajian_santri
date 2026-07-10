<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $table = 'settings';
    public $timestamps = false;

    protected $fillable = [
        'announcement_text',
        'is_popup_active',
        'landing_page',
        'garden_status',
        'garden_message',
        'garden_mode',
    ];

    protected $casts = [
        'is_popup_active' => 'boolean',
        'landing_page' => 'array',
    ];

    /**
     * Get default settings for landing page.
     */
    public static function defaultLandingPage(): array
    {
        return [
            'hero' => [
                'badge' => '📖 Pusat Informasi Kajian Islam',
                'title_1' => 'KAJIAN',
                'title_2' => 'SANTRI',
                'title_3' => 'ILmu BERKAH',
                'desc' => 'Selamat datang di portal informasi Daaru Hiraa — tempat terbaik untuk mengetahui jadwal kajian rutin, kegiatan pondok pesantren, dan berbagai program keislaman yang mendekatkan diri kepada Allah SWT.',
                'btn_primary_text' => 'Lihat Jadwal Kajian',
                'btn_primary_link' => '#kajian',
                'btn_secondary_text' => 'Tentang Pondok',
                'btn_secondary_link' => '#pondok',
                'image' => null,
            ],
            'kajian' => [
                'badge' => 'Jadwal Kajian',
                'title_1' => 'Kajian Rutin',
                'title_2' => 'Pondok Pesantren',
                'desc' => 'Ikuti berbagai kajian ilmu yang dibimbing oleh ustadz-ustadz berpengalaman. Semua kajian terbuka untuk umum.',
                'items' => [
                    [
                        'title' => 'Tafsir Jalalain',
                        'schedule' => '📅 Setiap Senin · Ba\'da Maghrib',
                        'desc' => 'Mentadaburi keagungan kitab suci Al-Qur\'an melalui tafsir Jalalain bersama Ustadz Tulus Musthofa.',
                        'icon' => 'auto_stories',
                        'bg_class' => 'bg-error-container',
                        'text_class' => 'text-on-error-container'
                    ],
                    [
                        'title' => 'Adabul Alim wa Mutaalim',
                        'schedule' => '📅 Setiap Selasa · Ba\'da Maghrib',
                        'desc' => 'Memperbaiki adab dan perilaku penuntut ilmu bersama Ustadz Tulus Musthofa dengan kajian kitab Adabul Alim wa Mutaalim.',
                        'icon' => 'local_library',
                        'bg_class' => 'bg-secondary-container',
                        'text_class' => 'text-on-secondary-container'
                    ],
                    [
                        'title' => 'Life Coaching',
                        'schedule' => '📅 Setiap Rabu · Ba\'da Maghrib',
                        'desc' => 'Mempererat tali persaudaraan dan membangun karakter santri melalui sesi life coaching bersama musyrif.',
                        'icon' => 'groups',
                        'bg_class' => 'bg-primary-fixed',
                        'text_class' => 'text-on-primary-fixed-variant'
                    ],
                    [
                        'title' => 'Fathul Qorib',
                        'schedule' => '📅 Setiap Kamis · Ba\'da Maghrib',
                        'desc' => 'Memperdalam pemahaman ibadah dan fiqih melalui kitab Fathul Qorib bersama Ustadz Solihan.',
                        'icon' => 'menu_book',
                        'bg_class' => 'bg-tertiary-fixed',
                        'text_class' => 'text-on-tertiary-fixed-variant'
                    ],
                    [
                        'title' => 'Al Iman',
                        'schedule' => '📅 Setiap Jumat · Ba\'da Maghrib',
                        'desc' => 'Memperkuat keimanan dan aqidah Ahlussunnah wal Jama\'ah bersama Ustadz Said Abdillah.',
                        'icon' => 'favorite',
                        'bg_class' => 'bg-secondary-container',
                        'text_class' => 'text-on-secondary-container'
                    ],
                    [
                        'title' => 'Bidayatul Hidayah',
                        'schedule' => '📅 Setiap Sabtu · Ba\'da Maghrib',
                        'desc' => 'Penyucian jiwa dan hati melalui kajian tasawuf kitab Bidayatul Hidayah bersama Ustadz Sukirno.',
                        'icon' => 'self_improvement',
                        'bg_class' => 'bg-error-container',
                        'text_class' => 'text-on-error-container'
                    ],
                    [
                        'title' => 'Hadits Arba\'in',
                        'schedule' => '📅 Setiap Minggu · Ba\'da Maghrib',
                        'desc' => 'Memahami kandungan hadits-hadits Rasulullah SAW dari kitab Arba\'in An-Nawawi bersama Ustadz Tulus Musthofa.',
                        'icon' => 'translate',
                        'bg_class' => 'bg-primary-fixed-dim',
                        'text_class' => 'text-primary'
                    ],
                ]
            ],
            'pondok' => [
                'badge' => 'Tentang Pondok',
                'title' => '🏫 Pondok Pesantren Mahasiswa Daaru Hira',
                'desc' => 'Pondok Pesantren Mahasiswa Daaru Hira berdiri di atas fondasi ilmu agama yang kokoh dengan memadukan tradisi salaf dan pendidikan modern. Kami berkomitmen mencetak generasi Qur\'ani yang berilmu, berakhlak mulia, dan siap menghadapi tantangan zaman.',
                'stat_1_val' => '35',
                'stat_1_lbl' => 'Santri Aktif',
                'stat_2_val' => '4',
                'stat_2_lbl' => 'Ustadz Pengajar',
                'stat_3_val' => '7',
                'stat_3_lbl' => 'Program Kajian',
                'visi_title' => 'Visi',
                'visi_desc' => 'Menjadi pondok pesantren terdepan dalam mencetak ulama yang faqih, berakhlaqul karimah, dan bermanfaat bagi umat.',
                'misi_title' => 'Misi',
                'misi_desc' => 'Menyelenggarakan pendidikan Islam terpadu, mengembangkan hafalan Al-Qur\'an, dan membangun karakter santri berbasis Ahlussunnah wal Jama\'ah.',
                'facilities' => [
                    ['icon' => 'mosque', 'label' => 'Masjid'],
                    ['icon' => 'school', 'label' => 'Ruang Kelas'],
                    ['icon' => 'bed', 'label' => 'Asrama Santri'],
                    ['icon' => 'local_library', 'label' => 'Perpustakaan'],
                    ['icon' => 'restaurant', 'label' => 'Dapur Umum'],
                    ['icon' => 'local_hospital', 'label' => 'Klinik Kesehatan'],
                    ['icon' => 'sports_soccer', 'label' => 'Lapangan Olahraga'],
                    ['icon' => 'wifi', 'label' => 'Area WiFi'],
                ]
            ],
            'lokasi' => [
                'badge' => 'Lokasi Kami',
                'title' => 'Temukan Pondok Kami',
                'desc' => 'Kunjungi pondok pesantren kami dan rasakan langsung suasana belajar yang penuh berkah dan ukhuwah islamiyah.',
                'maps_url' => 'https://maps.google.com/maps?q=Pondok+Pesantren+Mahasiswa+Daaru+Hira+Yogyakarta&t=&z=15&ie=UTF8&iwloc=&output=embed',
                'alamat_title' => 'Alamat Pondok',
                'alamat_text' => 'Pondok Pesantren Mahasiswa Daaru Hira, Jl. Bantul KM 7, Glondong, Tirtonirmolo, Kec. Kasihan, Kabupaten Bantul, Daerah Istimewa Yogyakarta',
                'alamat_link' => 'https://www.google.com/maps/search/Pondok+Pesantren+Mahasiswa+Daaru+Hira+Yogyakarta',
                'jam_besuk_title' => 'Jam Besuk',
                'jam_besuk_text' => "Sabtu & Minggu\n09:00 - 11:00 WIB\n14:00 - 16:00 WIB",
            ],
            'kontak' => [
                'title' => 'Hubungi Kami',
                'desc' => 'Punya pertanyaan seputar kajian atau pendaftaran santri? Jangan ragu untuk menghubungi kami.',
                'wa_title' => 'Telepon / WhatsApp',
                'wa_desc' => 'Hubungi kami langsung untuk informasi pendaftaran dan konsultasi.',
                'wa_btn' => 'Chat WhatsApp',
                'wa_link' => 'https://wa.me/6281234567890',
                'email_title' => 'Email',
                'email_desc' => 'Kirim pertanyaan detail melalui email dan kami akan membalas dalam 1x24 jam.',
                'email_btn' => 'Kirim Email',
                'email_link' => 'mailto:info@kajiansantri.id',
            ],
            'footer' => [
                'desc' => 'Portal informasi kajian Islam dan pondok pesantren. Mendekatkan ilmu agama kepada umat melalui teknologi digital.',
                'wa' => 'https://wa.me/6281234567890',
                'email' => 'mailto:info@kajiansantri.id',
                'maps' => 'https://www.google.com/maps/search/Pondok+Pesantren+Mahasiswa+Daaru+Hira+Yogyakarta',
            ]
        ];
    }

    /**
     * Accessor to merge database attributes with default attributes.
     */
    public function getLandingPageAttribute($value): array
    {
        $data = $value ? json_decode($value, true) : [];
        return array_replace_recursive(static::defaultLandingPage(), $data ?: []);
    }
}
