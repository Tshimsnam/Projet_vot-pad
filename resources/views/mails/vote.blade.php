@extends('layouts.template')

@section('content')
    <div class="pt-5 pl-5">
        <h2 class="text-2xl">{{ ucwords($noms) }}</h2>
        <p class="">
            Nous avons le plaisir de vous informer que vous avez été sélectionné(e) pour la prochaine étape de votre
            candidature qui est une interview.
            <br>
            L'interview se déroulera le {{ $date }} à {{ $heure }} à l'Orange Digital Center.
        </p>
        <p>
            Nous comptons sur votre présence.
            <br>
            Cordialement,
            <br>
            Orange Digital Center Kinshasa
        </p>
    </div>
@endsection
