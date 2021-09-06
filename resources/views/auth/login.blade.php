<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <svg version="1.0" xmlns="http://www.w3.org/2000/svg" width="128.000000pt" height="128.000000pt"
                    viewBox="0 0 128.000000 128.000000" preserveAspectRatio="xMidYMid meet">
                    <g transform="translate(0.000000,128.000000) scale(0.100000,-0.100000)" fill="#000000"
                        stroke="none">
                        <path d="M160 871 c0 -10 7 -21 15 -25 22 -8 22 -384 0 -392 -8 -4 -15 -15 -15 -25 0 -18 10 -19 153 -19 172 0 213 8 263 52 57 51 79 101 79 188 0 88 -24 143 -80 186 -60 45 -98 53 -262 54 -144 0 -153 -1 -153 -19z m285 -50 c50 -28 79 -94 79 -176 0 -74 -10 -103 -52 -148 -29 -30 -92 -52 -128 -43 -30 8 -37 52 -32 234 2 113 6 145 18 153 19 12 76 3 115 -20z" />
                        <path d="M705 880 c-4 -6 2 -20 14 -31 20 -19 21 -30 21 -199 0 -169 -1 -180 -21 -199 -12 -11 -18 -24 -14 -30 10 -17 337 -15 379 3 104 44 103 192 -3 236 l-30 12 40 37 c50 49 54 94 10 143 l-29 33 -180 3 c-127 2 -182 0 -187 -8z m280 -50 c17 -14 20 -62 5 -91 -10 -18 -63 -49 -107 -63 -23 -7 -23 -6 -23 71 0 50 5 84 13 92 15 15 90 9 112 -9z m14 -216 c26 -21 31 -33 31 -69 0 -52 -28 -79 -90 -90 -67 -11 -80 4 -80 89 l0 74 38 10 c57 15 68 14 101 -14z" />
                    </g>
                </svg>
            </div>
            <center><h1>POS System</h1></center>
        </div>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('register') }}">
                    Register
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
