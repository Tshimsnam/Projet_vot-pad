@extends('layouts.template')

@section('content')
    <section id="loginUser" class="bg-cover bg-center bg-white dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center min-h-screen px-6 py-8 mx-auto lg:py-0">
            <h2
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white ">
                <img class="w-10 h-10" src="{{ asset('img/momekano.png') }}" alt="logo">
                omekano
            </h2>
            <div class="container bg-white dark:bg-gray-900 opacity-95 shadow-md overflow-hidden sm:rounded-lg ">
                <div class="forms-container">
                    <div class="signin-signup">
                        <form class="sign-in-form" action="{{ route('authenticate') }}" autocomplete="off" method="post">
                            @csrf
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <h2 class="text-2xl font-bold leading-tight tracking-tight dark:text-white">
                                    Evaluation Connexion
                                </h2>
                                @if (session('unsuccess'))
                                    <div id="alert-2" class="flex items-center text-[#ff0000] rounded-lg" role="alert">
                                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div class="ms-3 text-sm font-medium">
                                            {{ session('unsuccess') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-5">
                                    <label for="email"
                                        class="block mb-2 text-sm font-medium dark:text-white">Email</label>
                                    <input type="email" autocomplete="off" id="email" name="email"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-white-500 focus:border-white-500 block w-full p-2.5"
                                        placeholder="momekano@gmail.com" required />
                                </div>
                                <div class="mb-5">
                                    <label for="coupon"
                                        class="block mb-2 text-sm font-medium dark:text-white">Coupon</label>
                                    <input type="coupon" autocomplete="off" id="coupon" name="coupon"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                                        required />
                                </div>
                                <button type="submit"
                                    class="text-white bg-gray-900 border border-gray-700 hover:bg-gray-800 hover:border-gray-600 focus:ring-4 focus:outline-none focus:ring-gray-500 font-bold rounded-lg text-sm w-full sm:w-40 h-10 text-center dark:bg-white dark:text-black dark:border-gray-300 dark:hover:bg-gray-200 dark:hover:border-gray-200 dark:text-gray-900 dark:border dark:border-red">
                                    Connexion
                                </button>

                            </div>
                        </form>
                        <form class="sign-up-form" action="{{ route('jury-authenticate') }}" autocomplete="off"
                            method="post">
                            @csrf
                            <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
                                <h2 class="text-2xl font-bold leading-tight tracking-tight dark:text-white">
                                    Vote Connexion
                                </h2>
                                @if (session('unsuccessJury'))
                                    <div id="alert-2" class="flex items-center text-[#ff0000] rounded-lg" role="alert">
                                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                        </svg>
                                        <span class="sr-only">Info</span>
                                        <div class="ms-3 text-sm font-medium">
                                            {{ session('unsuccessJury') }}
                                        </div>
                                    </div>
                                @endif
                                <div class="mb-5">
                                    <label for="coupon"
                                        class="block mb-2 text-sm font-medium dark:text-white">Coupon</label>
                                    <input type="coupon" id="coupon" name="coupon"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-gray-500 focus:border-gray-500 block w-full p-2.5"
                                        required />
                                </div>
                                <button type="submit"
                                    class="text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-500 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-white dark:text-black dark:hover:bg-gray-200">
                                    Connexion
                                </button>
                        </form>
                    </div>
                </div>

                <div class="panels-container">
                    <div class="panel left-panel">
                        <div class="content">
                            <h3>Vote Connexion</h3>
                            <p>
                                Cette section est dédiée à l'authentification des jurys.<br> Elle gère les processus de
                                vérification et de validation des informations fournies par les jurés.
                            </p>
                            <button
                                class="btn transparent text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-500 dark:bg-white dark:text-black dark:hover:bg-gray-200"
                                id="sign-up-btn">
                                Vote
                            </button>
                        </div>
                    </div>
                    <div class="panel right-panel">
                        <div class="content">
                            <h3>Evaluation Connexion</h3>
                            <p>
                                Cette section concerne l'authentification des candidats avant leur évaluation.<br> Elle
                                vérifie
                                l'identité des candidats pour s'assurer qu'ils sont éligibles à participer au processus
                                d'évaluation.
                            </p>
                            <button
                                class="btn transparent text-white bg-gray-900 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-500 dark:bg-white dark:text-black dark:hover:bg-gray-200"
                                id="sign-in-btn">
                                evaluation
                            </button>
                        </div>
                    </div>
                </div>

                <script>
                    function getDarkMode() {
                        return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
                    }

                    // Applique le style en fonction du mode du navigateur
                    function applyDarkMode() {
                        const loginUser = document.getElementById('loginUser');
                        if (getDarkMode()) {
                            loginUser.classList.remove('light');
                            loginUser.classList.add('dark');
                        } else {
                            loginUser.classList.remove('dark');
                            loginUser.classList.add('light');
                        }
                    }

                    window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyDarkMode);
                    applyDarkMode();

                    document.addEventListener("DOMContentLoaded", () => {
                        const sign_in_btn = document.querySelector("#sign-in-btn");
                        const sign_up_btn = document.querySelector("#sign-up-btn");
                        const container = document.querySelector(".container");

                        const hasUnsuccessJury = @json(session('unsuccessJury'));

                        if (hasUnsuccessJury) {
                            container.classList.add("sign-up-mode");
                        }

                        sign_up_btn.addEventListener("click", () => {
                            container.classList.add("sign-up-mode");
                        });

                        sign_in_btn.addEventListener("click", () => {
                            container.classList.remove("sign-up-mode");
                        });
                    });
                </script>

            </div>
    </section>
@endsection
