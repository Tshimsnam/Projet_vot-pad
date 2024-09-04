@extends('layouts.template')
@section('content')
    <section id="voteUser" class="px-4 md:px-8">
        <div class="mb-5 pt-16 flex justify-center">
            <h2
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold text-white">
                <img class="w-12 h-12" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                    alt="logo">
                otePad2
            </h2>
        </div>
        <p class="text-center md:m-16 text-xl text-white">
            Je tiens à vous exprimer toute ma gratitude pour votre participation en tant que membre du jury lors de notre
            récent événement.<br> Votre expertise et votre engagement ont été essentiels pour garantir l'intégrité et le
            succès
            de cette compétition.
        </p>
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
    </script>
@endsection
