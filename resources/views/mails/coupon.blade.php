@extends('layouts.template')

@section('content')
    @if ($nonPresent == 'exterieur')
        <div class="pt-5 pl-5">
            <h2 class="text-2xl">Bonjour {{ ucwords($noms) }}</h2>
            <p class="">
                Nous avons le plaisir de vous informer que vous avez été sélectionné(e) pour la prochaine étape de votre
                candidature qui est une évaluation (test de niveau).
                <br>
            </p>
            <p class="pb-3">
                Pour accéder au test, cliquez sur ce lien: {{ $lien }}
            </p>
            <p class="pb-3">    
                Voici votre coupon : <strong>{{ $coupon }}</strong>
            </p>
            <p>
                Cordialement,
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
