<section>
    <div class="flex items-center gap-2 mb-4">
        <x-heroicon-o-lock-closed class="w-5 h-5 text-[#DB261D]" />
        <h2 class="text-lg font-semibold text-gray-800">
            Keamanan Akun
        </h2>
    </div>

    <p class="text-sm text-gray-500 mb-4">
        Gunakan kata sandi yang kuat untuk melindungi akun Anda.
    </p>

    <form method="post" action="{{ route('password.update') }}" class="space-y-4">
        @csrf
        @method('put')

        @foreach ([
            ['id' => 'current_password', 'label' => 'Password Lama'],
            ['id' => 'password', 'label' => 'Password Baru'],
            ['id' => 'password_confirmation', 'label' => 'Konfirmasi Password Baru']
        ] as $field)

            <div class="relative">
                <x-input-label :for="$field['id']" :value="$field['label']" />

                <input
                    id="{{ $field['id'] }}"
                    name="{{ $field['id'] }}"
                    type="password"
                    class="mt-1 block w-full rounded-xl border-gray-300
                           focus:border-[#0092DF] focus:ring-[#0092DF]"
                    required
                />

                <button type="button"
                        onclick="togglePassword('{{ $field['id'] }}', this)"
                        class="absolute right-3 top-[38px] text-gray-400">
                    <x-heroicon-o-eye class="w-5 h-5" />
                </button>

                <x-input-error
                    class="mt-2"
                    :messages="$errors->updatePassword->get($field['id'])" />
            </div>

        @endforeach

        <div class="flex items-center gap-3">
            <button
                type="submit"
                class="px-4 py-2 bg-[#DB261D] text-white rounded-xl
                       hover:opacity-90 transition text-sm">
                Simpan Password
            </button>

            @if (session('status') === 'password-updated')
                <span class="text-sm text-green-600 font-medium">
                    ✔ Password berhasil diperbarui
                </span>
            @endif
        </div>
    </form>
</section>

<script>
    function togglePassword(id, btn) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
    }
</script>
