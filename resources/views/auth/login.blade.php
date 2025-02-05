<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="mb-5 flex space-x-2 bg-gray-100 dark:bg-gray-800 p-2 rounded-lg">
        <button type="button"
            class="flex-1 text-white {{ request()->is('login') ? 'bg-[#FF7900]' : 'bg-gray-300' }} hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40"
            aria-current="page" id="loginButton">
            Connexion
        </button>
        <button type="button"
            class="flex-1 text-gray-900 {{ request()->is('register') || $errors->has('email') || $errors->has('name') || $errors->has('password') ? 'bg-[#FF7900]' : 'bg-white' }} hover:bg-gray-100 border border-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center justify-center dark:focus:ring-gray-600 dark:bg-gray-700 dark:border-gray-700 dark:text-white dark:hover:bg-gray-900"
            id="registerButton">
            Inscription
        </button>
    </div>

    <div id="viewLogin" class="transition-opacity duration-500 ease-in-out opacity-100">
        <!-- Formulaire de connexion -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <!-- Email Address -->
            <div>
                @if ($errors->has('email') || $errors->has('name') || $errors->has('password'))
                    <!-- No error message to display when there are errors -->
                @else
                    <x-input-error :messages="$errors->get('logmail')" class="mb-2" />
                @endif

                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" placeholder="Entrez votre e-mail" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                @if ($errors->has('email') || $errors->has('name') || $errors->has('password'))
                    <!-- No error message to display when there are errors -->
                @else
                    <x-input-error :messages="$errors->get('password')" class="mb-2" />
                @endif
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" placeholder="Entrez votre mot de passe" />
            </div>

            <!-- Remember Me -->
            <div class="flex justify-between mt-4">
                <div>
                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                            href="{{ route('password.request') }}">
                            {{ __('Mot de passe oublié?') }}
                        </a>
                    @endif
                </div>
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800"
                        name="remember">
                    <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Se souvenir de moi') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-10 md:mt-5">
                <x-primary-button>
                    {{ __('Connexion') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <div id="viewRegister" class="transition-opacity duration-500 ease-in-out opacity-0" style="display: none;">
        <!-- Formulaire d'inscription -->
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                @if ($errors->has('email') || $errors->has('name') || $errors->has('password'))
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                @endif
                <x-input-label for="name" :value="__('Noms')" />
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"
                    required autofocus autocomplete="name" placeholder="Entrez votre prénom & nom" />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-input-label for="email" :value="__('E-mail')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autocomplete="username" placeholder="Entrez votre e-mail" />
                @if ($errors->has('email') || $errors->has('name') || $errors->has('password'))
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                @endif
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" placeholder="Entrez un mot de passe" />
                @if ($errors->has('email') || $errors->has('name') || $errors->has('password'))
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                @endif
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Repetez le mot de passe')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password"
                    placeholder="Confirmez votre mot de passe" />
                @if ($errors->has('email') || $errors->has('name') || $errors->has('password'))
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                @endif
            </div>

            <div class="flex items-center justify-end mt-4">
                <x-primary-button class="">
                    {{ __('Inscription') }}
                </x-primary-button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const viewLogin = document.getElementById('viewLogin');
            const viewRegister = document.getElementById('viewRegister');
            const loginButton = document.getElementById('loginButton');
            const registerButton = document.getElementById('registerButton');

            // Vérifier si des erreurs sont présentes pour l'inscription
            if (
                {{ $errors->has('email') || $errors->has('name') || $errors->has('password') ? 'true' : 'false' }}
            ) {
                // Afficher directement la vue d'inscription avec animation
                const registerClasses = registerButton.className;
                registerButton.className = loginButton.className;
                loginButton.className = registerClasses;
                viewLogin.style.opacity = '0';
                setTimeout(() => {
                    viewLogin.style.display = 'none';
                    viewRegister.style.display = 'block';
                    setTimeout(() => {
                        viewRegister.style.opacity = '1';
                    }, 10);
                }, 500);
            } else {
                // Par défaut, afficher la vue de connexion
                viewRegister.style.display = 'none';
                viewLogin.style.display = 'block';
            }

            loginButton.addEventListener('click', function() {
                // Transition vers la vue de connexion
                if (viewLogin.style.display != 'block') {
                    const loginClasses = loginButton.className;
                    loginButton.className = registerButton.className;
                    registerButton.className = loginClasses;

                    viewRegister.style.opacity = '0';
                    setTimeout(() => {
                        viewRegister.style.display = 'none';
                        viewLogin.style.display = 'block';
                        setTimeout(() => {
                            viewLogin.style.opacity = '1';
                        }, 10);
                    }, 500);
                }
            });

            registerButton.addEventListener('click', function() {
                // Transition vers la vue d'inscription
                if (viewRegister.style.display != 'block') {
                    const registerClasses = registerButton.className;
                    registerButton.className = loginButton.className;
                    loginButton.className = registerClasses;

                    viewLogin.style.opacity = '0';
                    setTimeout(() => {
                        viewLogin.style.display = 'none';
                        viewRegister.style.display = 'block';
                        setTimeout(() => {
                            viewRegister.style.opacity = '1';
                        }, 10);
                    }, 500);
                }
            });
        });
    </script>
</x-guest-layout>
