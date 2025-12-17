<section>
    <div class="flex items-center gap-2 mb-4">
        <x-heroicon-o-user class="w-5 h-5 text-[#0092DF]" />
        <h2 class="text-lg font-semibold text-gray-800">
            Informasi Akun
        </h2>
    </div>

    <p class="text-sm text-gray-500 mb-4">
        Username digunakan untuk login ke dalam sistem.
    </p>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-4">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="username" value="Username" />
            <x-text-input id="username" name="username" type="text" class="mt-1 block w-full rounded-xl"
                :value="old('username', $user->username)" required />
            <x-input-error class="mt-2" :messages="$errors->get('username')" />
        </div>

        <div class="flex items-center gap-3">
            <button type="submit" class="px-4 py-2 bg-[#2A166F] text-white rounded-xl
                       hover:opacity-90 transition text-sm">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <span class="text-sm text-green-600 font-medium">
                    ✔ Username berhasil diperbarui
                </span>
            @endif
        </div>
    </form>
</section>