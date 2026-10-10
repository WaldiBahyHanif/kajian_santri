<x-admin-layout title="Kelola Anggota Liqo" active="liqo">

<div>
    <a href="{{ route('admin.liqo.index') }}" class="inline-flex items-center gap-1 text-xs font-black uppercase mb-4 hover:underline">
        <span class="material-symbols-outlined text-sm">arrow_back</span> Kembali ke Daftar MR
    </a>

    <h3 class="font-black text-xl uppercase text-black mb-6">Anggota Kelompok: {{ $liqo->name }}</h3>

    @if ($errors->any())
        <div class="mb-4 text-red-600 font-bold bg-red-100 p-3 border-2 border-red-600 rounded text-sm">
            @foreach ($errors->all() as $error) <p>{{ $error }}</p> @endforeach
        </div>
    @endif

    <!-- Form Tambah Anggota -->
    <div class="bg-white p-4 sm:p-5 rounded-lg border-4 border-black shadow-[4px_4px_0_0_#000] mb-6">
        <h3 class="font-black text-sm mb-3 uppercase">Tambah Santri ke Kelompok Ini</h3>
        <form action="{{ route('admin.liqo.members.add', $liqo) }}" method="POST" class="flex flex-col sm:flex-row gap-3">
            @csrf
            <select name="student_id" required class="flex-1 border-4 border-black p-2.5 rounded-lg font-bold text-sm focus:outline-none">
                <option value="" disabled selected>-- Pilih Santri --</option>
                @foreach ($availableStudents as $student)
                    <option value="{{ $student->id }}">
                        {{ $student->name }}{{ $student->liqo_group_id ? ' (pindah dari kelompok lain)' : '' }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="bg-black text-white px-4 py-2.5 font-black rounded-lg border-4 border-black hover:bg-[#FFDE00] hover:text-black shadow-[4px_4px_0_0_#000] active:translate-y-1 active:shadow-none transition-all text-sm uppercase">
                + Tambah
            </button>
        </form>
    </div>

    <!-- Daftar Anggota -->
    <div class="bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
        <div class="p-4 bg-black text-white font-black flex justify-between items-center">
            <span class="uppercase text-sm tracking-widest">Anggota ({{ $members->count() }})</span>
        </div>
        @forelse ($members as $member)
            <div class="p-3 border-b-2 border-gray-200 flex justify-between items-center hover:bg-yellow-50 transition-colors">
                <span class="font-black text-sm">{{ $member->name }}</span>
                <form action="{{ route('admin.liqo.members.remove', [$liqo, $member]) }}" method="POST" onsubmit="return confirm('Keluarkan santri ini dari kelompok?');">
                    @csrf @method('DELETE')
                    <button type="submit" class="bg-red-400 text-black px-3 py-1 rounded border-2 border-black text-xs font-black shadow-[2px_2px_0_0_#000] active:translate-y-0.5 active:shadow-none transition-all">
                        Keluarkan
                    </button>
                </form>
            </div>
        @empty
            <div class="p-8 text-center text-gray-500 font-bold">
                <span class="material-symbols-outlined text-4xl text-gray-400 block mb-2">person_off</span>
                Belum ada anggota di kelompok ini.
            </div>
        @endforelse
    </div>
</div>

</x-admin-layout>
