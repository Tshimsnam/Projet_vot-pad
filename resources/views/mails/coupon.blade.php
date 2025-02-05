@extends('layouts.template')

@section('content')
    @if ($nonPresent == 'exterieur')
        <div class="pt-5 pl-5">
            <h2 class="text-2xl">Bonjour {{ ucwords($noms) }}</h2>
            <p class="">
                Nous avons le plaisir de vous informer que vous avez été sélectionné(e) pour la prochaine étape de votre
                candidature, qui consiste en une évaluation (test de niveau).
                <br>
                Le test se déroulera jusqu'au {{ $date }} à {{ $heure }}.
                <br>
            </p>
            <p class="pb-3">
                Voici votre coupon : <strong>{{ $coupon }}</strong>
            </p>
            <p class="pb-3">
                Pour accéder au test, cliquez sur ce bouton:<br>
            <div class="flex justify-center items-center">
                <a id="sendMail" href="{{ $lien }}"
                    class="px-4 py-2 text-sm font-medium text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                    Cliquez ici
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M13.19 8.688a4.5 4.5 0 0 1 1.242 7.244l-4.5 4.5a4.5 4.5 0 0 1-6.364-6.364l1.757-1.757m13.35-.622 1.757-1.757a4.5 4.5 0 0 0-6.364-6.364l-4.5 4.5a4.5 4.5 0 0 0 1.242 7.244" />
                    </svg>
                </a>
            </div>
            </p>
            <p>
                Nous vous souhaitons une pleine réussite pour cette étape.
                <br>
                Orange Digital Center Kinshasa
            </p>
        </div>
    @else
        <div class="pt-5 pl-5">
            <h2 class="text-2xl">Bonjour {{ ucwords($noms) }}</h2>
            <p class="">
                Nous avons le plaisir de vous informer que vous avez été sélectionné(e) pour la prochaine étape de votre
                candidature qui est une évaluation (test de niveau).
                <br>
                Le test de niveau se déroulera le {{ $date }} à {{ $heure }} à l'Orange Digital Center.
            </p>
            <p class="pb-3">
                Pour accéder au test, veuillez présenter votre coupon : <strong>{{ $coupon }}</strong>
            </p>
            <p>
                Nous comptons sur votre présence.
                <br>
                Cordialement,
                <br>
                Orange Digital Center Kinshasa
            </p>
        </div>
    @endif
@endsection
