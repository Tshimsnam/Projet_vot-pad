@extends('layouts.template')
@section('content')
<section class="">
    <h1 class="mt-2  text-3xl font-bold">Vote</h1>
    <p class="mb-5 font-extralight text-gray-500  text-justify sm:w-3/4">Vous trouverez ici la liste des critères lié à cette phase spécifique de la compétition. Chaque candidat est évaluer a l'aide des ces cri-ères.</p>
    <section class="sm:mx-auto md:w-2/3 space-y-5">
        <form action="" method="post" class="space-y-4">
            @csrf
            <div class="px-5 w-full space-y-2">
                    <div class="px-5 py-3 bg-white flex justify-between items-center rounded-xl border drop-shadow-xl">
                        <h1 class="text-xl font-bold">1 Critères</h1>
                        <span class="text-sm font-thin">Ponderation : 30</span>
                    </div>
                    <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
                        <div class="">
                            <h2 class="text-md font-bold mb-1">Déscription</h2>
                            <p class="text-sm font-thin pb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In aliquid eligendi amet dolore dolor sit, amet consectetur adipisi ab nam explicabo.</p>
                        </div>
                        <div class="relative">
                            <label for="labels-range-input" class="sr-only">Labels range</label>
                            <input id="medium-range-1" type="range" value="0" min="0" max="100" step="10" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        </div>
                        <div class="flex justify-between items-center">
                            <h1 class="text-md font-bold">Mention</h1>
                            <span id="score-1" class="text-sm font-thin">Score : 0.0</span>
                        </div>
                    </div>
            </div>
            <div class="px-5 w-full space-y-2">
                    <div class="px-5 py-3 bg-white flex justify-between items-center rounded-xl border drop-shadow-xl">
                        <h1 class="text-xl font-bold">2 Critères</h1>
                        <span class="text-sm font-thin">Ponderation : 40</span>
                    </div>
                    <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
                        <div class="">
                            <h2 class="text-md font-bold mb-1">Déscription</h2>
                            <p class="text-sm font-thin pb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In aliquid eligendi amet dolore dolor sit, amet consectetur adipisi ab nam explicabo.</p>
                        </div>
                        <div class="relative">
                            <label for="labels-range-input" class="sr-only">Labels range</label>
                            <input id="medium-range-2" type="range" value="0" min="0" max="100" step="20" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                        </div>
                        <div class="flex justify-between items-center">
                            <h1 class="text-md font-bold">Mention</h1>
                            <span id="score-2" class="text-sm font-thin">Score : 0.0</span>
                        </div>
                    </div>
            </div>
            <div class="flex justify-between px-5">
                <button
                type="button" 
                class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                >Annuler</button>
                <button
                type="button"
                id="submit-btn" 
                class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700"
                >Envoyer</button>
            </div>

        </form>
    
     </section>
</section>
<script>
      // Sélectionner tous les inputs de type range et tous les spans de score
      const rangeInputs = document.querySelectorAll('input[type="range"]');
      const scoreSpans = document.querySelectorAll('span[id^="score-"]');
      const urlParams = window.location;

    const getCandidatId = ()=>{
        const pathname = urlParams.pathname;
        const idParts = pathname.split('/');
        const candidatId = idParts[idParts.length - 1]; 
        return candidatId
    }


    const redirect = ()=>{
        const pathname = urlParams.href;
        const idStartIndex = pathname.lastIndexOf('/');
        const phaseUrl = pathname.substring(0, idStartIndex)
       return urlParams.href = `${phaseUrl}`
    }

    // Ajouter un écouteur d'événement pour chaque input de type range
    rangeInputs.forEach((input, index) => {
        input.addEventListener('input', function() {
            // Mettre à jour le texte du span correspondant avec la nouvelle valeur du range
            scoreSpans[index].textContent = 'Score : ' + input.value;
        });
    });

    // Sélectionner le bouton de soumission
    const submitBtn = document.getElementById('submit-btn');
            // Ajouter un écouteur d'événement pour la soumission du formulaire
            submitBtn.addEventListener('click', function() {
            // Créer un objet pour stocker les valeurs des inputs
            let votes = {};

            // Récupérer les valeurs des inputs et les ajouter à l'objet
            rangeInputs.forEach((input, index) => {
                votes[`vote${index + 1}`] = input.value;
            });

            // Stocker l'objet dans le localStorage
            localStorage.setItem('votes', JSON.stringify({...votes,candidatId:getCandidatId()}));
            redirect()
        });

</script>
@endsection