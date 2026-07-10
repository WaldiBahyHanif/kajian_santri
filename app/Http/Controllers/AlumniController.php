<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    /**
     * Display the alumni / mahasantri directory page.
     */
    public function index(Request $request)
    {
        // Ambil semua angkatan yang unik untuk filter
        $angkatanList = Student::whereNotNull('angkatan')
            ->orderBy('angkatan', 'desc')
            ->distinct()
            ->pluck('angkatan')
            ->filter()
            ->sort()
            ->values();

        // Ambil semua universitas yang unik untuk filter
        $universitasList = Student::whereNotNull('universitas')
            ->where('universitas', '!=', '')
            ->orderBy('universitas')
            ->distinct()
            ->pluck('universitas')
            ->filter()
            ->values();

        // Query utama
        $query = Student::query();

        // Filter angkatan
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }

        // Filter universitas
        if ($request->filled('universitas')) {
            $query->where('universitas', $request->universitas);
        }

        // Filter status aktif (Santri Aktif vs Alumni/Lulus)
        if ($request->filled('status')) {
            $query->where('status_aktif', $request->status);
        }

        // Filter pencarian nama
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $students = $query->orderBy('angkatan', 'desc')
                          ->orderBy('name', 'asc')
                          ->get();

        // Statistik ringkasan
        $totalSantri   = Student::count();
        $totalDenganUni = Student::whereNotNull('universitas')->where('universitas', '!=', '')->count();
        $totalAngkatan = $angkatanList->count();
        $totalUni      = $universitasList->count();

        return view('alumni', compact(
            'students',
            'angkatanList',
            'universitasList',
            'totalSantri',
            'totalDenganUni',
            'totalAngkatan',
            'totalUni'
        ));
    }
}
