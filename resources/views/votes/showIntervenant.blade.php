@extends('layouts.template')
@section('content')
    <section class="sm:mx-auto md:w-3/3 space-y-5">
        <div>

            <h1
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight text-gray-900 md:text-5xl lg:text-6xl dark:text-white">
                {{ $candidat->email }}</h1>
        </div>
        <form action="" method="post" class="space-y-4">
            @csrf
            @foreach ($criteres as $key => $item)
                <div class="px-5 w-full space-y-2">
                    <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
                        <div class="">
                            <h1 class="text-xl font-bold">{{ $item->libelle }}</h1>
                            <p class="text-sm font-thin pb-2">{{ $item->description }}
                            </p>
                        </div>
                        <div class="relative">
                            <label for="labels-range-input" class="sr-only">Labels range</label>
                            <input id="labels-range-input" type="range" value="0" min="0" name="cote"
                                max="{{ $item->ponderation }}"
                                class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                            @if ($item->echelle == 5)
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
                            @else
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-0 -bottom-6">Mauvais(0)</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute start-1/2 -translate-x-1/2 rtl:translate-x-1/2 -bottom-6">
                                    bien</span>
                                <span
                                    class="text-sm text-gray-500 dark:text-gray-400 absolute end-0 -bottom-6">Excellent({{ $item->ponderation }})</span>
                            @endif

                        </div>
                        <div class="flex justify-between items-center">
                            <span id="score-{{ $item->id }}" class="text-sm font-thin pt-5">Score : 0</span>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="flex justify-between px-5">
                <button type="button" id="submit-btn"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Valider</button>
            </div>

        </form>
        <div id="valid-modal" tabindex="-1"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Votre vote a été validé avec
                            succès</h3>
                        <button data-modal-hide="valid-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">OK</button>
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="valid-modal">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        const rangeInputs = document.querySelectorAll('input[type="range"]');
        const scoreSpans = document.querySelectorAll('span[id^="score-"]');
        const urlParams = window.location;

        rangeInputs.forEach((input, index) => {
            input.addEventListener('input', function() {

                scoreSpans[index].textContent = 'Score : ' + input.value;
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

            for (let i = 0; i < nombreCriteres; i++) {
                localStorage.setItem(
                    `cote-{{ $phase_id }}${critereIds[i]}{{ $jury_id }}{{ $candidat->id }}`,
                    inputCotes[i].value
                );
            }

            let voteData = {
                phaseId: {{ $phase_id }},
                juryId: {{ $jury_id }},
                candidatId: {{ $candidat->id }},
                cotes: []
            };

            let nombreCritere = critereIds.length;

            for (let i = 0; i < nombreCritere; i++) {
                let cote = localStorage.getItem(
                    `cote-{{ $phase_id }}${critereIds[i]}{{ $jury_id }}{{ $candidat->id }}`);
                if (cote !== null) {
                    let coteInt = parseInt(cote);
                    voteData.cotes.push({
                        critereId: critereIds[i],
                        valeur: coteInt
                    });
                }
            }
            let data = {
                voteData
            };

            fetch('{{ route('sendUniqueVote') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(data)
                })
                .then(response => {
                    if (response.ok) {
                        const validModal = document.getElementById('valid-modal');
                        validModal.classList.remove('hidden');
                        validModal.classList.add('flex');
                    } else {
                        throw new Error(`HTTP error ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log(data);
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

        function getDataFromLocalStorage(phase_id, candidat, jury_id, criteres_id) {
            const data = [];
            let somme = 0;
            let i = 0;
            let nombreCritere = criteres_id.length;
            while (i < nombreCritere) {
                const coteValue = localStorage.getItem(`cote-${phase_id}${criteres_id[i]}${ jury_id }${ candidat }`);
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
            const savedData = getDataFromLocalStorage({{ $phase_id }}, {{ $candidat->id }}, jury_id,
                critereIds);
            const taille = savedData.length;
            for (let i = 0; i < taille; i++) {
                const scoreSpan = document.getElementById(`score-${critereIds[i]}`);
                const labelsRangeInput = document.querySelectorAll(`#labels-range-input`)[i];

                if (scoreSpan) {
                    scoreSpan.textContent = `Score : ${savedData[i]}`;
                }

                if (labelsRangeInput) {
                    labelsRangeInput.value = savedData[i];
                }
            }
        });
    </script>
@endsection
