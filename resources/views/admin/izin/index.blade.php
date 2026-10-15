<x-admin-layout title="Kelola Izin" active="izin">

    <!-- Filters -->
    <form method="GET" class="bg-white border-4 border-black p-4 rounded-lg shadow-[4px_4px_0_0_#000] mb-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-3">
            <div>
                <label class="text-xs font-black uppercase block mb-1">Status</label>
                <select name="status" class="w-full border-2 border-black rounded-lg px-3 py-2 font-bold text-sm">
                    <option value="">Semua</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-black uppercase block mb-1">Tipe</label>
                <select name="type" class="w-full border-2 border-black rounded-lg px-3 py-2 font-bold text-sm">
                    <option value="">Semua</option>
                    <option value="pengajian" {{ request('type') === 'pengajian' ? 'selected' : '' }}>Izin Pengajian</option>
                    <option value="izin" {{ request('type') === 'izin' ? 'selected' : '' }}>Izin</option>
                    <option value="cuti" {{ request('type') === 'cuti' ? 'selected' : '' }}>Cuti</option>
                    <option value="sakit" {{ request('type') === 'sakit' ? 'selected' : '' }}>Sakit</option>
                </select>
            </div>
            <div>
                <label class="text-xs font-black uppercase block mb-1">Dari Tanggal</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border-2 border-black rounded-lg px-3 py-2 font-bold text-sm">
            </div>
            <div>
                <label class="text-xs font-black uppercase block mb-1">Sampai Tanggal</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border-2 border-black rounded-lg px-3 py-2 font-bold text-sm">
            </div>
            <div>
                <label class="text-xs font-black uppercase block mb-1">Cari Santri</label>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama santri..." class="w-full border-2 border-black rounded-lg px-3 py-2 font-bold text-sm">
            </div>
        </div>
        <div class="mt-3 flex gap-2">
            <button type="submit" class="bg-black text-white border-2 border-black px-4 py-2 font-black text-xs shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                <span class="material-symbols-outlined text-sm">search</span> FILTER
            </button>
            <a href="{{ route('admin.izin.index') }}" class="bg-gray-200 text-black border-2 border-black px-4 py-2 font-black text-xs shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all">
                RESET
            </a>
        </div>
    </form>

    <!-- Data -->
    @if($leaves->count() > 0)
        <div class="bg-white border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-black text-white font-black text-xs uppercase">
                        <tr>
                            <th class="text-left px-4 py-3">Santri</th>
                            <th class="text-left px-4 py-3">Tipe</th>
                            <th class="text-left px-4 py-3">Tanggal</th>
                            <th class="text-left px-4 py-3">Alasan</th>
                            <th class="text-center px-4 py-3">Status</th>
                            <th class="text-center px-4 py-3">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y-2 divide-black">
                        @foreach($leaves as $leave)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-bold text-black">{{ $leave->student->name }}</td>
                                <td class="px-4 py-3">
                                    <span class="font-black uppercase text-xs border-2 border-black px-2 py-0.5 rounded {{ $leave->type === 'sakit' ? 'bg-red-100 text-red-700' : ($leave->type === 'cuti' ? 'bg-purple-100 text-purple-700' : ($leave->type === 'pengajian' ? 'bg-teal-100 text-teal-700' : 'bg-blue-100 text-blue-700')) }}">
                                        {{ $leave->type_label }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 font-bold text-xs">
                                    {{ $leave->start_date->translatedFormat('d M') }}
                                    @if($leave->end_date != $leave->start_date)
                                        - {{ $leave->end_date->translatedFormat('d M Y') }}
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-gray-600 max-w-[300px]">
                                    <div class="font-bold text-black mb-1">{{ $leave->reason }}</div>
                                    <div class="text-[10px] text-gray-500 font-black uppercase mt-1">Kegiatan:</div>
                                    <div class="text-xs text-gray-700 font-bold">
                                        {{ implode(', ', $leave->covered_sessions_labels) }}
                                    </div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($leave->status === 'pending')
                                        <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#FFDE00] text-black">Pending</span>
                                    @elseif($leave->status === 'approved')
                                        <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-[#39FF14] text-black">Disetujui</span>
                                    @else
                                        <span class="text-xs font-black uppercase border-2 border-black px-2 py-0.5 rounded bg-red-400 text-black">Ditolak</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <div class="flex items-center justify-center gap-1">
                                        @if($leave->status === 'pending')
                                            <form action="{{ route('admin.izin.approve', $leave->id) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="bg-[#39FF14] text-black border-2 border-black px-2 py-1 font-black text-[10px] uppercase shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all cursor-pointer">
                                                    Setuju
                                                </button>
                                            </form>
                                            <button type="button" onclick="showRejectModal({{ $leave->id }}, '{{ $leave->student->name }}')" class="bg-red-400 text-black border-2 border-black px-2 py-1 font-black text-[10px] uppercase shadow-[2px_2px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all cursor-pointer">
                                                Tolak
                                            </button>
                                        @endif
                                        <form action="{{ route('admin.izin.destroy', $leave->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data pengajuan ini?')">
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
        <div class="mt-4">
            {{ $leaves->links() }}
        </div>
    @else
        <div class="bg-white border-4 border-black rounded-lg shadow-[6px_6px_0_0_#000] p-12 text-center">
            <span class="material-symbols-outlined text-5xl text-gray-300 mb-3">assignment</span>
            <p class="text-gray-400 font-bold italic">Tidak ada data pengajuan izin.</p>
        </div>
    @endif

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-black/60 z-50 flex items-center justify-center hidden" x-data>
        <div class="bg-white border-4 border-black rounded-lg shadow-[8px_8px_0_0_#000] max-w-md w-full mx-4 p-6">
            <h3 class="font-black text-lg uppercase mb-4">Tolak Pengajuan</h3>
            <form id="rejectForm" method="POST">
                @csrf
                <p class="text-sm font-bold text-gray-600 mb-4">
                    Tolak pengajuan dari: <span id="rejectStudentName" class="text-black"></span>
                </p>
                <div class="mb-4">
                    <label class="block font-black text-xs uppercase mb-2">Alasan Penolakan <span class="text-gray-400">(opsional)</span></label>
                    <textarea name="rejection_reason" rows="3" class="w-full border-4 border-black rounded-lg px-4 py-3 font-bold text-sm" placeholder="Alasan mengapa ditolak..."></textarea>
                </div>
                <div class="flex gap-2">
                    <button type="submit" class="bg-red-400 text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm">
                        TOLAK
                    </button>
                    <button type="button" onclick="closeRejectModal()" class="bg-gray-200 text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm">
                        BATAL
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function showRejectModal(id, name) {
            document.getElementById('rejectForm').action = '{{ url("admin/izin") }}/' + id + '/reject';
            document.getElementById('rejectStudentName').textContent = name;
            document.getElementById('rejectModal').classList.remove('hidden');
        }
        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
        }
    </script>
</x-admin-layout>