<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class AdminLandingPageController extends Controller
{
    /**
     * Show the landing page editor form.
     */
    public function edit()
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create([
                'id' => 1,
                'announcement_text' => '',
                'is_popup_active' => false,
                'landing_page' => null,
            ]);
        }

        $landingPage = $setting->landing_page;

        return view('admin.landing_page.edit', compact('setting', 'landingPage'));
    }

    /**
     * Update the landing page settings.
     */
    public function update(Request $request)
    {
        $setting = Setting::first();
        if (!$setting) {
            $setting = Setting::create([
                'id' => 1,
                'announcement_text' => '',
                'is_popup_active' => false,
                'landing_page' => null,
            ]);
        }

        $landingPage = $setting->landing_page;

        // Validation
        $request->validate([
            'hero.badge' => ['required', 'string'],
            'hero.title_1' => ['required', 'string'],
            'hero.title_2' => ['required', 'string'],
            'hero.title_3' => ['required', 'string'],
            'hero.desc' => ['required', 'string'],
            'hero.btn_primary_text' => ['required', 'string'],
            'hero.btn_primary_link' => ['required', 'string'],
            'hero.btn_secondary_text' => ['required', 'string'],
            'hero.btn_secondary_link' => ['required', 'string'],
            'hero_image' => ['nullable', 'image', 'max:2048'], // Max 2MB

            'kajian.badge' => ['required', 'string'],
            'kajian.title_1' => ['required', 'string'],
            'kajian.title_2' => ['required', 'string'],
            'kajian.desc' => ['required', 'string'],
            'kajian.items' => ['required', 'array'],
            'kajian.items.*.title' => ['required', 'string'],
            'kajian.items.*.schedule' => ['required', 'string'],
            'kajian.items.*.desc' => ['required', 'string'],
            'kajian.items.*.icon' => ['required', 'string'],
            'kajian.items.*.bg_class' => ['required', 'string'],

            'pondok.badge' => ['required', 'string'],
            'pondok.title' => ['required', 'string'],
            'pondok.desc' => ['required', 'string'],
            'pondok.stat_1_val' => ['required', 'string'],
            'pondok.stat_1_lbl' => ['required', 'string'],
            'pondok.stat_2_val' => ['required', 'string'],
            'pondok.stat_2_lbl' => ['required', 'string'],
            'pondok.stat_3_val' => ['required', 'string'],
            'pondok.stat_3_lbl' => ['required', 'string'],
            'pondok.visi_title' => ['required', 'string'],
            'pondok.visi_desc' => ['required', 'string'],
            'pondok.misi_title' => ['required', 'string'],
            'pondok.misi_desc' => ['required', 'string'],
            'pondok.facilities' => ['required', 'array'],
            'pondok.facilities.*.icon' => ['required', 'string'],
            'pondok.facilities.*.label' => ['required', 'string'],

            'lokasi.badge' => ['required', 'string'],
            'lokasi.title' => ['required', 'string'],
            'lokasi.desc' => ['required', 'string'],
            'lokasi.maps_url' => ['required', 'string'],
            'lokasi.alamat_title' => ['required', 'string'],
            'lokasi.alamat_text' => ['required', 'string'],
            'lokasi.alamat_link' => ['required', 'string'],
            'lokasi.jam_besuk_title' => ['required', 'string'],
            'lokasi.jam_besuk_text' => ['required', 'string'],

            'kontak.title' => ['required', 'string'],
            'kontak.desc' => ['required', 'string'],
            'kontak.wa_title' => ['required', 'string'],
            'kontak.wa_desc' => ['required', 'string'],
            'kontak.wa_btn' => ['required', 'string'],
            'kontak.wa_link' => ['required', 'string'],
            'kontak.email_title' => ['required', 'string'],
            'kontak.email_desc' => ['required', 'string'],
            'kontak.email_btn' => ['required', 'string'],
            'kontak.email_link' => ['required', 'string'],

            'footer.desc' => ['required', 'string'],
            'footer.wa' => ['required', 'string'],
            'footer.email' => ['required', 'string'],
            'footer.maps' => ['required', 'string'],
        ]);

        // Merge Hero data
        $landingPage['hero'] = [
            'badge' => $request->input('hero.badge'),
            'title_1' => $request->input('hero.title_1'),
            'title_2' => $request->input('hero.title_2'),
            'title_3' => $request->input('hero.title_3'),
            'desc' => $request->input('hero.desc'),
            'btn_primary_text' => $request->input('hero.btn_primary_text'),
            'btn_primary_link' => $request->input('hero.btn_primary_link'),
            'btn_secondary_text' => $request->input('hero.btn_secondary_text'),
            'btn_secondary_link' => $request->input('hero.btn_secondary_link'),
            'image' => $landingPage['hero']['image'] ?? null,
        ];

        // Handle Image Upload
        if ($request->hasFile('hero_image')) {
            $oldImage = $landingPage['hero']['image'] ?? null;
            if ($oldImage && file_exists(public_path($oldImage))) {
                @unlink(public_path($oldImage));
            }

            $file = $request->file('hero_image');
            $filename = 'hero_' . time() . '.' . $file->getClientOriginalExtension();
            
            // Ensure public/uploads/landing directory exists
            $targetDir = public_path('uploads/landing');
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0755, true);
            }
            
            $file->move($targetDir, $filename);
            $landingPage['hero']['image'] = '/uploads/landing/' . $filename;
        }

        // Merge Kajian data
        $landingPage['kajian'] = [
            'badge' => $request->input('kajian.badge'),
            'title_1' => $request->input('kajian.title_1'),
            'title_2' => $request->input('kajian.title_2'),
            'desc' => $request->input('kajian.desc'),
            'items' => array_map(function ($item) {
                // Determine text class automatically based on background class selection
                $bgClass = $item['bg_class'] ?? 'bg-error-container';
                $textClass = 'text-primary';
                if ($bgClass === 'bg-error-container') {
                    $textClass = 'text-on-error-container';
                } elseif ($bgClass === 'bg-secondary-container') {
                    $textClass = 'text-on-secondary-container';
                } elseif ($bgClass === 'bg-primary-fixed') {
                    $textClass = 'text-on-primary-fixed-variant';
                } elseif ($bgClass === 'bg-tertiary-fixed') {
                    $textClass = 'text-on-tertiary-fixed-variant';
                }

                return [
                    'title' => $item['title'] ?? '',
                    'schedule' => $item['schedule'] ?? '',
                    'desc' => $item['desc'] ?? '',
                    'icon' => $item['icon'] ?? 'auto_stories',
                    'bg_class' => $bgClass,
                    'text_class' => $textClass,
                ];
            }, $request->input('kajian.items', [])),
        ];

        // Merge Pondok data
        $landingPage['pondok'] = [
            'badge' => $request->input('pondok.badge'),
            'title' => $request->input('pondok.title'),
            'desc' => $request->input('pondok.desc'),
            'stat_1_val' => $request->input('pondok.stat_1_val'),
            'stat_1_lbl' => $request->input('pondok.stat_1_lbl'),
            'stat_2_val' => $request->input('pondok.stat_2_val'),
            'stat_2_lbl' => $request->input('pondok.stat_2_lbl'),
            'stat_3_val' => $request->input('pondok.stat_3_val'),
            'stat_3_lbl' => $request->input('pondok.stat_3_lbl'),
            'visi_title' => $request->input('pondok.visi_title'),
            'visi_desc' => $request->input('pondok.visi_desc'),
            'misi_title' => $request->input('pondok.misi_title'),
            'misi_desc' => $request->input('pondok.misi_desc'),
            'facilities' => array_map(function ($facility) {
                return [
                    'icon' => $facility['icon'] ?? 'mosque',
                    'label' => $facility['label'] ?? '',
                ];
            }, $request->input('pondok.facilities', [])),
        ];

        // Merge Lokasi data
        $landingPage['lokasi'] = [
            'badge' => $request->input('lokasi.badge'),
            'title' => $request->input('lokasi.title'),
            'desc' => $request->input('lokasi.desc'),
            'maps_url' => $request->input('lokasi.maps_url'),
            'alamat_title' => $request->input('lokasi.alamat_title'),
            'alamat_text' => $request->input('lokasi.alamat_text'),
            'alamat_link' => $request->input('lokasi.alamat_link'),
            'jam_besuk_title' => $request->input('lokasi.jam_besuk_title'),
            'jam_besuk_text' => $request->input('lokasi.jam_besuk_text'),
        ];

        // Merge Kontak data
        $landingPage['kontak'] = [
            'title' => $request->input('kontak.title'),
            'desc' => $request->input('kontak.desc'),
            'wa_title' => $request->input('kontak.wa_title'),
            'wa_desc' => $request->input('kontak.wa_desc'),
            'wa_btn' => $request->input('kontak.wa_btn'),
            'wa_link' => $request->input('kontak.wa_link'),
            'email_title' => $request->input('kontak.email_title'),
            'email_desc' => $request->input('kontak.email_desc'),
            'email_btn' => $request->input('kontak.email_btn'),
            'email_link' => $request->input('kontak.email_link'),
        ];

        // Merge Footer data
        $landingPage['footer'] = [
            'desc' => $request->input('footer.desc'),
            'wa' => $request->input('footer.wa'),
            'email' => $request->input('footer.email'),
            'maps' => $request->input('footer.maps'),
        ];

        $setting->landing_page = $landingPage;
        $setting->save();

        return redirect()->route('admin.landing-page.edit')->with('success', 'Konten landing page berhasil disimpan!');
    }
}
