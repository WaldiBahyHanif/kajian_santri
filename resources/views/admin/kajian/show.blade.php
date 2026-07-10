<x-admin-layout title="Detail Pendaftar Kajian" active="kajian">

    <!-- Header Action bar -->
    <div class="mb-6 flex justify-between items-center">
        <a href="{{ route('admin.kajian.index') }}" class="inline-flex items-center gap-2 bg-white text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm uppercase">
            <span class="material-symbols-outlined text-sm">arrow_back</span> KEMBALI
        </a>
        <a href="{{ route('admin.kajian.edit', $kajian->id) }}" class="bg-[#FFDE00] text-black border-4 border-black px-4 py-2 font-black shadow-[4px_4px_0_0_#000] hover:translate-x-0.5 hover:translate-y-0.5 hover:shadow-none transition-all text-sm flex items-center gap-2">
            <span class="material-symbols-outlined text-sm">edit</span> EDIT KAJIAN
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        <!-- Left: Detail Kajian -->
        <div class="lg:col-span-1 bg-white p-5 border-4 border-black rounded-lg shadow-[4px_4px_0_0_#000] space-y-4">
            <h3 class="font-black text-lg uppercase text-black border-b-2 border-black pb-2">Detail Kajian</h3>
            
            <div>
                <h4 class="text-xl font-black uppercase text-black">{{ $kajian->title }}</h4>
                <p class="text-xs text-gray-500 font-bold mt-1">Ustadz: {{ $kajian->asatiz?->name }}</p>
                @if($kajian->program)
                    <p class="text-xs text-purple-700 font-bold mt-0.5">Program: {{ $kajian->program->name }}</p>
                @endif
            </div>

            <div class="space-y-2 text-sm text-gray-700 font-bold pt-2">
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">calendar_today</span>
                    <span>{{ $kajian->date->translatedFormat('d F Y') }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">schedule</span>
                    <span>{{ substr($kajian->time, 0, 5) }} WIB</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">location_on</span>
                    <span>{{ $kajian->location }}</span>
                </div>
                <div class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-base">group</span>
                    <span>Kuota RSVP: {{ $kajian->students->count() }} / {{ $kajian->quota ?? 'Unlimited' }}</span>
                </div>
            </div>

            @if($kajian->description)
            <div class="pt-4 border-t-2 border-gray-100">
                <label class="block text-xs font-black uppercase text-gray-400 mb-1">Deskripsi</label>
                <p class="text-xs text-gray-700 leading-relaxed font-bold">{{ $kajian->description }}</p>
            </div>
            @endif

            <!-- Documentation summary status -->
            <div class="pt-4 border-t-2 border-gray-100 space-y-2">
                <label class="block text-xs font-black uppercase text-gray-400 mb-1">Dokumentasi & Ringkasan</label>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 text-[10px] font-black uppercase border-2 border-black rounded {{ $kajian->youtube_link ? 'bg-red-400 text-black' : 'bg-gray-100 text-gray-400' }}">YouTube</span>
                    <span class="px-2 py-1 text-[10px] font-black uppercase border-2 border-black rounded {{ $kajian->spotify_link ? 'bg-green-400 text-black' : 'bg-gray-100 text-gray-400' }}">Spotify</span>
                    <span class="px-2 py-1 text-[10px] font-black uppercase border-2 border-black rounded {{ $kajian->material_link ? 'bg-blue-400 text-black' : 'bg-gray-100 text-gray-400' }}">Slide PDF</span>
                    <span class="px-2 py-1 text-[10px] font-black uppercase border-2 border-black rounded {{ $kajian->summary ? 'bg-[#39FF14] text-black' : 'bg-gray-100 text-gray-400' }}">Ringkasan</span>
                </div>
            </div>
        </div>

        <!-- Right: Daftar Pendaftar -->
        <div class="lg:col-span-2 bg-white border-4 border-black rounded-lg overflow-hidden shadow-[4px_4px_0_0_#000]">
            <div class="p-4 bg-black text-white font-black uppercase text-sm tracking-widest flex justify-between items-center">
                <span>Daftar Pendaftar RSVP ({{ $kajian->students->count() }})</span>
                @if($kajian->quota)
                    <span class="text-xs bg-[#FFDE00] text-black px-2 py-0.5 rounded font-black border border-black">Sisa Kuota: {{ $kajian->quota - $kajian->students->count() }}</span>
                @endif
            </div>

            <div class="divide-y-2 divide-gray-200">
                @forelse($kajian->students as $student)
                <div class="p-4 flex flex-col sm:flex-row justify-between items-center gap-3 hover:bg-yellow-50 transition-colors">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 border-2 border-black rounded-full overflow-hidden bg-secondary-container flex items-center justify-center font-black">
                            @if($student->avatar)
                                <img src="https://api.dicebear.com/9.x/micah/svg?seed={{ $student->avatar }}&backgroundColor=transparent" class="w-full h-full object-cover" alt="User Avatar" />
                            @else
                                {{ strtoupper(substr($student->name, 0, 1)) }}
                            @endif
                        </div>
                        <div>
                            <h3 class="font-black text-sm text-black">{{ $student->name }}</h3>
                            <p class="text-xs text-gray-500 font-bold">Kamar: {{ $student->room ?? '-' }} · Angkatan: {{ $student->generation ?? '-' }}</p>
                        </div>
                    </div>
                    <div class="text-right">
                        <p class="text-xs text-gray-400 font-bold">Daftar pada: {{ $student->pivot->created_at?->translatedFormat('d M Y, H:i') ?? '-' }}</p>
                    </div>
                </div>
                @empty
                <div class="p-8 text-center text-gray-400 font-bold italic">Belum ada santri yang melakukan pendaftaran/RSVP untuk kajian ini.</div>
                @endforelse
            </div>
        </div>

    </div>

</x-admin-layout>
