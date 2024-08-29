@extends('layouts.template')
@section('content')
    <section id="voteUser" class="px-4 md:px-8">
        <div class="mb-2 pt-40 flex justify-center">
            <h2
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold text-white">
                <img class="w-12 h-12" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                    alt="logo">
                otePad2
            </h2>
        </div>
        <div class="flex items-center h-full justify-center">
            <label for="" class="text-6xl text-gray-900 dark:text-white"> {{ $message }}</label>
            <form action="{{ route('inter.logout') }}" id="logout" method="get">
                @method('get')
                @csrf
                <label for="" id="element" class=""></label>
            </form>
        </div>
    </section>

    <script>
        function getDarkMode() {
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        // Applique le style en fonction du mode du navigateur
        function applyDarkMode() {
            const voteUser = document.getElementById('voteUser');
            if (getDarkMode()) {
                voteUser.classList.remove('light');
                voteUser.classList.add('dark');
            } else {
                voteUser.classList.remove('dark');
                voteUser.classList.add('light');
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyDarkMode);
        applyDarkMode();

        //script pour le chrono duree evaluation
        function paddedFormat(num) {
            return num < 10 ? '0' + num : num;
        }

        function startCountDown(duration, element) {
            let secondsRemaining = duration;
            let min = 0;
            let sec = 0;

            let countInterval = setInterval(function() {
                min = parseInt(secondsRemaining / 60);
                sec = parseInt(secondsRemaining % 60);

                const form = document.getElementById('logout');
                if (`${paddedFormat(min)}` == 0 && `${paddedFormat(sec)}` == 0) {
                    form.submit()
                } else {
                    console.log(`pas fini encore ${paddedFormat(min)} min - ${paddedFormat(sec)} sec`)
                }

                secondsRemaining = secondsRemaining - 1;
                if (secondsRemaining < 0) {
                    clearInterval(countInterval)
                };
            }, 1000);
        }

        window.onload = function() {
            let duration = 5;
            element = document.getElementById('#element');
            startCountDown(--duration, element);
        };
    </script>
@endsection
