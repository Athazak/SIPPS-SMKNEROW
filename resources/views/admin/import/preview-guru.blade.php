<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Preview Data Siswa') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-lg sm:rounded-lg p-6">
                <form action="{{ route('admin.import.guru-store') }}" method="POST">
                    @csrf
                    <div class="overflow-x-auto">
                        <table class="min-w-full text-sm text-left text-gray-700 border border-gray-200 rounded-lg">
                            <thead class="bg-gray-100 text-gray-600 uppercase text-xs font-semibold">
                                <tr>
                                    <th class="px-4 py-3 border">NIP</th>
                                    <th class="px-4 py-3 border">Nama</th>
                                    <th class="px-4 py-3 border">No HP</th>
                                    <th class="px-4 py-3 border">Email</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                    @php
                                        $isDuplicate = \App\Models\User::where('nip', $row['nip'])
                                            ->where('role', 'guru')
                                            ->exists();
                                    @endphp
                                    <tr class="hover:bg-gray-50 transition {{ $isDuplicate ? 'bg-red-100' : '' }}">
                                        <td class="px-4 py-2 border">
                                            <input type="hidden" name="rows[{{ $loop->index }}][nip]"
                                                value="{{ $row['nip'] }}">
                                            {{ $row['nip'] }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <input type="hidden" name="rows[{{ $loop->index }}][nama]"
                                                value="{{ $row['nama'] }}">
                                            {{ $row['nama'] }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <input type="hidden" name="rows[{{ $loop->index }}][phone]"
                                                value="{{ $row['phone'] }}">
                                            {{ $row['phone'] }}
                                        </td>
                                        <td class="px-4 py-2 border">
                                            <input type="hidden" name="rows[{{ $loop->index }}][email]"
                                                value="{{ $row['email'] }}">
                                            {{ $row['email'] }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-primary-button>
                            {{ __('Simpan Data') }}
                        </x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>