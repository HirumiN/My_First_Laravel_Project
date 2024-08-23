<x-layout>
    <x-slot:title>Log In</x-slot:title>

    <form method="POST" action="/login">
        @csrf
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-10">

                <div class=" grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
                    {{-- <x-form-field>
                        <x-form-label for="username">Username</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="username" id="username" autocomplete="off" required />
                            <x-form-error name="username" />
                        </div>
                    </x-form-field> --}}
                    <x-form-field>
                        <x-form-label for="email">Email</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="email" id="email" autocomplete="off" type="email" :value="old('email')"
                                required />
                            <x-form-error name="email" />
                        </div>
                    </x-form-field>
                    <x-form-field>
                        <x-form-label for="password">Password</x-form-label>
                        <div class="mt-2">
                            <x-form-input type="text" name="password" id="password"
                                type="password" required />
                            <x-form-error name="password" />
                        </div>
                    </x-form-field>

                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <a href="/" class="text-sm font-semibold leading-6 text-gray-900">Cancel</a>
            <x-form-button>Log In</x-form-button>
        </div>
    </form>

</x-layout>
