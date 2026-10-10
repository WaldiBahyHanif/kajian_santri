<x-admin-layout title="Kelola Liqo" active="liqo">

<div x-data="{ editOpen: false, data: {} }">

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-3 mb-6">
        <h3 class="font-black text-xl uppercase text-black">Kelola Kelompok Liqo (MR)</h3>
    </div>

    @if (session('importSummary'))
        @php($summary = session('importSummary'))
        <div class="bg-white p-4 sm:p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
            <h3 class="font-black text-lg mb-2 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-green-600">fact_check</span> Hasil Import Spreadsheet
            </h3>
            <p class="font-bold text-sm mb-2">
                ✅ {{ $summary['success_count'] }} baris berhasil.
                @if (count($summary['errors']) > 0)
                    &nbsp;❌ {{ count($summary['errors']) }} baris gagal.
                @endif
            </p>
            @if (count($summary['errors']) > 0)
                <div class="max-h-56 overflow-y-auto border-2 border-red-300 rounded-lg">
                    <table class="w-full text-xs">
                        <thead class="bg-red-100 sticky top-0">
                            <tr>
                                <th class="p-2 text-left font-black">Baris</th>
                                <th class="p-2 text-left font-black">Nama Santri</th>
                                <th class="p-2 text-left font-black">Nama MR</th>
                                <th class="p-2 text-left font-black">Alasan Gagal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($summary['errors'] as $err)
                                <tr class="border-t border-red-200">
                                    <td class="p-2">{{ $err['row'] }}</td>
                                    <td class="p-2">{{ $err['name'] ?: '-' }}</td>
                                    <td class="p-2">{{ $err['mr'] ?: '-' }}</td>
                                    <td class="p-2">{{ $err['reason'] }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
        <!-- Form Tambah MR Manual -->
        <div class="bg-white p-4 sm:p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000]">
            <h3 class="font-black text-lg mb-4 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-[#00E5FF]">person_add</span> Tambah MR Manual
            </h3>
            <form action="{{ route('admin.liqo.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                @csrf
                <input type="text" name="name" placeholder="Nama MR / Pembimbing" required
                       class="flex-1 border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none focus:bg-yellow-50 text-black placeholder-gray-500 text-sm">
                <button type="submit" class="bg-black text-white px-4 py-2.5 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                    + Tambah
                </button>
            </form>
            @if ($errors->any() && !session('importSummary'))
                <div class="mt-3 text-red-600 font-bold bg-red-100 p-2 border-2 border-red-600 rounded text-sm">
                    @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
                </div>
            @endif
        </div>

        <!-- Import Spreadsheet -->
        <div class="bg-white p-4 sm:p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000]">
            <h3 class="font-black text-lg mb-2 uppercase flex items-center gap-2">
                <span class="material-symbols-outlined text-green-600">upload_file</span> Import Spreadsheet
            </h3>
            <p class="text-xs font-bold text-gray-500 mb-3">Kolom: <span class="font-black">Nama Santri</span> | <span class="font-black">Nama MR</span>. MR yang belum ada otomatis dibuat.</p>
            <div class="flex flex-col sm:flex-row gap-3">
                <a href="{{ route('admin.liqo.template') }}" class="shrink-0 bg-blue-200 text-black px-4 py-2.5 font-black rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-xs uppercase flex items-center justify-center gap-1.5">
                    <span class="material-symbols-outlined text-sm">download</span> Download Template
                </a>
                <form action="{{ route('admin.liqo.import') }}" method="POST" enctype="multipart/form-data" class="flex-1 flex gap-2">
                    @csrf
                    <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                           class="flex-1 border-4 border-black p-2 rounded-lg font-bold text-xs focus:outline-none bg-white">
                    <button type="submit" class="bg-black text-white px-4 py-2.5 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-xs uppercase shrink-0">
                        Import
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Data Table -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black flex justify-between items-center">
            <span class="uppercase text-sm tracking-widest truncate">Daftar Kelompok MR ({{ $groups->count() }})</span>
        </div>

        @forelse ($groups as $group)
            <div class="p-3 border-b-2 border-gray-200 grid grid-cols-1 sm:grid-cols-12 gap-2 items-center hover:bg-yellow-50 transition-colors">
                <div class="sm:col-span-4 min-w-0">
                    <span class="font-black text-sm block truncate">{{ $group->name }}</span>
                </div>
                <div class="sm:col-span-2 flex items-center">
                    <span class="text-[10px] px-2 py-0.5 rounded border-2 border-black font-black uppercase {{ $group->is_active ? 'bg-green-300' : 'bg-gray-300' }}">
                        {{ $group->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
                <div class="sm:col-span-2 text-xs font-bold">{{ $group->members_count }} santri</div>
                <div class="sm:col-span-4 flex justify-end gap-2">
                    <a href="{{ route('admin.liqo.members', $group) }}" class="bg-purple-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Kelola Anggota
                    </a>
                    <button type="button"
                        @click="data = { id: {{ $group->id }}, name: '{{ addslashes($group->name) }}', is_active: {{ $group->is_active ? 1 : 0 }} }; editOpen = true"
                        class="bg-cyan-300 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Edit
                    </button>
                    <form action="{{ route('admin.liqo.destroy', $group) }}" method="POST" onsubmit="return confirm('Hapus kelompok MR ini? Anggotanya akan dilepas dari kelompok.');" class="inline">
                        @csrf @method('DELETE')
                        <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                            Hapus
                        </button>
                    </form>
                </div>
            </div>
        @empty
            <div class="p-8 text-center text-gray-500 font-bold">
                <span class="material-symbols-outlined text-4xl text-gray-400 block mb-2">diversity_3</span>
                Belum ada kelompok MR. Tambahkan manual atau import spreadsheet.
            </div>
        @endforelse
    </div>

    <!-- Edit Modal -->
    <div x-show="editOpen" x-cloak class="fixed inset-0 bg-black/70 z-[100] flex items-center justify-center p-4">
        <div @click.away="editOpen = false" class="bg-white border-4 border-black p-6 rounded-xl w-full max-w-sm shadow-[8px_8px_0_0_#000] relative">
            <button @click="editOpen = false" class="absolute -top-3 -right-3 bg-red-400 border-4 border-black w-8 h-8 rounded-full font-black text-sm hover:bg-red-500 shadow-[2px_2px_0_0_#000]">X</button>
            <h2 class="text-xl font-black mb-4 uppercase">Edit Kelompok MR</h2>
            <form :action="`/admin/liqo/${data.id}`" method="POST" class="space-y-3">
                @csrf @method('PUT')
                <div>
                    <label class="block font-black uppercase text-xs mb-1">Nama MR</label>
                    <input type="text" name="name" x-model="data.name" class="w-full border-4 border-black p-2.5 rounded-lg font-bold focus:outline-none text-sm" required>
                </div>
                <div>
                    <label class="block font-black uppercase text-xs mb-1">Status</label>
                    <select name="is_active" x-model="data.is_active" class="w-full border-4 border-black p-2.5 rounded-lg font-bold text-sm">
                        <option value="1">Aktif</option>
                        <option value="0">Nonaktif</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-[#39FF14] text-black font-black py-3 rounded-lg border-4 border-black hover:bg-[#2ecc00] shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase mt-2">
                    Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
</div>

</x-admin-layout>
