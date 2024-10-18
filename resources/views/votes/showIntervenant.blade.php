@extends('layouts.template')
@section('content')
    <section id="voteUser" class="px-2 md:px-8">
        <div class="mb-3 pt-5 flex justify-center">
            <h2
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white ">
                <img class="w-10 h-10" src="{{ asset('img/momekano.png') }}" alt="logo">
                omekano
            </h2>

        </div>
        <div class="flex justify-between">
            <div class="flex inline-block px-4 md:px-4">
                <img class="w-12 h-12 rounded-full border border-gray-300"
                    src="{{ $candidat->image && file_exists(public_path($candidat->image)) ? asset($candidat->image) : asset('images/profil.jpg') }}"
                    alt="">
                <div class="px-5">
                    <h2 class="text-3xl uppercase font-extrabold dark:text-white">{{ $candidat->noms }}</h2>
                    <p class="text-sm truncate dark:text-white">
                        {{ $candidat->email }}
                    </p>
                </div>
            </div>
            <div class="">
                <div>
                    <h3 id="critereNombre" class="pt-1 text-1xl font-bold leading-none dark:text-white uppercase pr-4">
                        0/{{ count($criteres) }} critères</h3>
                </div>
            </div>

        </div>
        <form action="" method="post" class="space-y-4">
            @csrf
            @foreach ($criteres as $key => $item)
                <div class="px-3 w-full space-y-2">
                    <div
                        class="px-5 py-3 rounded-xl border bg-white bg-opacity-95 space-y-3 drop-shadow-xl dark:bg-gray-600 dark:border-gray-600 dark:bg-opacity-95">
                        <div class="">
                            <h1 class="text-xl font-bold dark:text-white">{{ $item->libelle }}</h1>
                            <p class="text-sm font-thin dark:text-white">Ponderation : {{ $item->ponderation }}
                            </p>
                            {{-- <p class="text-sm font-thin dark:text-white">{{ $item->description }}
                            </p> --}}
                        </div>
                        <div class="relative">
                            <style>
                                .accent {
                                    accent-color: #FF7900;
                                }
                            </style>
                            <label for="labels-range-input" class="sr-only">Labels range</label>
                            <input id="labels-range-input" type="range" value="0" min="0" name="cote"
                                max="{{ $item->ponderation }}"
                                class="w-full h-2 bg-gray-700 rounded-lg accent dark:bg-gray-100">
                            <div class="hidden md:flex justify-between text-sm text-gray-500 dark:text-gray-400 mt-2">
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Mauvais(0)</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">Assez
                                    bien</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">Bien</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-3/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">Très
                                    Bien</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Excellent({{ $item->ponderation }})</span>
                            </div>
                            <div class="flex md:hidden flex-col items-center text-sm text-gray-500 dark:text-gray-400 mt-2">
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">M(0)</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">AB</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-2/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">B</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-3/4 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">TB</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">E({{ $item->ponderation }})</span>
                            </div>


                        </div>
                        <div class="flex justify-between items-center">
                            <span id="score-{{ $item->id }}" class="text-xl font-extrabold pt-5 dark:text-white">COTE :
                                0</span>
                        </div>
                    </div>
                </div>
            @endforeach
            <div id="divButton" class="flex justify-between px-5">
                <button type="button" data-modal-target="valid-modal" data-modal-toggle="valid-modal"
                    class="text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">Valider</button>
            </div>

        </form>
        <div id="valid-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <button type="button"
                        class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="valid-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Voulez-vous confirmer votre
                            vote</h3>
                        <button data-modal-hide="valid-modal" type="button" id="submit-btn"
                            class="text-white bg-green-600 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                            Confirmer
                        </button>
                        <button data-modal-hide="valid-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                    </div>
                </div>
            </div>
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

        const rangeInputs = document.querySelectorAll('input[type="range"]');
        const scoreSpans = document.querySelectorAll('span[id^="score-"]');
        const urlParams = window.location;
        const tailleCritere = {{ count($criteres) }};
        const critereNombre = document.getElementById('critereNombre');
        let critereValide = 0;

        rangeInputs.forEach((input, index) => {
            input.addEventListener('input', function() {
                if (!input.dataset.valid) {
                    critereValide++;
                    input.dataset.valid = true; // Mark input as valid to avoid recounting
                }
                scoreSpans[index].textContent = 'COTE : ' + input.value;
                critereNombre.textContent = critereValide + "/" + tailleCritere + " critères";
            });
        });


        document.getElementById('submit-btn').addEventListener('click', () => {
            const inputCotes = document.querySelectorAll("input[name='cote']");

            let critereIds = [
                @foreach ($criteres as $critere)
                    {{ $critere->id }},
                @endforeach
            ];

            const nombreCriteres = {{ count($criteres) }};
            let sommeCand = [];
            sommeCand[{{ $candidat->id }}] = 0;
            for (let i = 0; i < nombreCriteres; i++) {
                localStorage.setItem(
                    `cote-{{ $phase_id }}${critereIds[i]}{{ $jury_id }}{{ $candidat->id }}{{ $nombreUser }}`,
                    inputCotes[i].value
                );
                sommeCand[{{ $candidat->id }}] += parseInt(inputCotes[i].value);
            }

            let voteData = {
                phase_id: {{ $phase_id }},
                intervenant_id: {{ $candidat->id }},
                nombre_user: {{ $nombreUser }},
                cote: []
            };

            let nombreCritere = critereIds.length;

            for (let i = 0; i < nombreCritere; i++) {
                let coteUnique = localStorage.getItem(
                    `cote-{{ $phase_id }}${critereIds[i]}{{ $jury_id }}{{ $candidat->id }}{{ $nombreUser }}`
                );
                if (coteUnique !== null) {
                    let coteInt = parseInt(coteUnique);
                    voteData.cote.push({
                        critere_id: critereIds[i],
                        valeur: coteInt
                    });
                }
            }
            let data = voteData;
            const token = '{{ $juryToken }}';
            fetch('{{ route('sendUniqueVote') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Authorization': `Bearer ${token}`
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (response.ok) {
                        return response.json();
                        console.log(response.body);

                    } else {
                        throw new Error(`HTTP error ${response.status}`);
                    }
                })
                .then(data => {
                    localStorage.setItem(
                        `sum-{{ $phase_id }}{{ $jury_id }}{{ $candidat->id }}{{ $nombreUser }}`,
                        sommeCand[
                            {{ $candidat->id }}]
                    );
                    localStorage.setItem("refreshPreviousPage", true);
                    // Retourner à la page précédente après une réponse réussie
                    window.history.back();
                })
                .catch(error => {
                    console.error('Error:', error.message);
                });

            console.log(voteData);

        });

        document.querySelector('#valid-modal button[class*="text-gray-900"]').addEventListener('click', () => {
            const validModal = document.getElementById('valid-modal');
            validModal.classList.remove('flex');
            validModal.classList.add('hidden');
        });

        function getDataFromLocalStorage(phase_id, candidat, jury_id, criteres_id, nombreUser) {
            const data = [];
            let somme = 0;
            let i = 0;
            let nombreCritere = criteres_id.length;
            while (i < nombreCritere) {
                const coteValue = localStorage.getItem(
                    `cote-${phase_id}${criteres_id[i]}${ jury_id }${ candidat }${ nombreUser }`);
                if (coteValue === null) {
                    break;
                }
                data.push(coteValue);
                i++;
            }
            return data;
        }

        document.addEventListener('DOMContentLoaded', () => {
            let jury_id = {{ $jury_id }}
            let critereIds = [
                @foreach ($criteres as $critere)
                    {{ $critere->id }},
                @endforeach
            ];
            let nombreUser = {{ $nombreUser }};
            const savedData = getDataFromLocalStorage({{ $phase_id }}, {{ $candidat->id }}, jury_id,
                critereIds, nombreUser);


            const taille = savedData.length;
            let sommeCand = [];
            sommeCand[{{ $candidat->id }}] = 0;
            const divButton = document.getElementById("divButton");
            const dataCand = localStorage.getItem(
                `sum-{{ $phase_id }}{{ $jury_id }}{{ $candidat->id }}{{ $nombreUser }}`);
            if (dataCand != null) {
                divButton.style.display = 'none';
                for (let i = 0; i < taille; i++) {
                    const labelsRangeInput = document.querySelectorAll(`#labels-range-input`)[i];
                    if (labelsRangeInput) {
                        labelsRangeInput.disabled = true;
                    }
                }
            } else {
                divButton.style.display = 'block';
            }

            for (let i = 0; i < taille; i++) {
                const scoreSpan = document.getElementById(`score-${critereIds[i]}`);
                const labelsRangeInput = document.querySelectorAll(`#labels-range-input`)[i];

                if (scoreSpan) {
                    scoreSpan.textContent = `COTE : ${savedData[i]}`;
                    sommeCand[{{ $candidat->id }}] += parseInt(savedData[i]);
                }

                if (labelsRangeInput) {
                    labelsRangeInput.value = savedData[i];
                }
            }

        });
    </script>
@endsection
