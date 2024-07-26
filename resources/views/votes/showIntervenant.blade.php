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
                <button type="button"
                    class="py-2.5 px-5 me-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-md border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                <button type="button" id="submit-btn"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">Valider</button>
            </div>

        </form>

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
            const nombreCriteres = inputCotes.length;

            for (let i = 0; i < nombreCriteres; i++) {
                localStorage.setItem(`cote-{{ $phase_id }}${i}{{ $jury_id }}{{ $candidat->id }}`, inputCotes[i].value);
            }
        });

        function getDataFromLocalStorage(phase_id, candidat, jury_id) {
            const data = [];
            let somme = 0;
            let i = 0;
            while (true) {

                const coteValue = localStorage.getItem(`cote-${phase_id}${i}${ jury_id }${ candidat }`);
                if (coteValue === null) {
                    break;
                }
                data.push(coteValue);
                somme += parseInt(coteValue);
                i++;
            }
            return data;
        }

        document.addEventListener('DOMContentLoaded', () => {
            let jury_id = {{ $jury_id }}
            const savedData = getDataFromLocalStorage({{ $phase_id }}, {{ $candidat->id }}, jury_id);
            const taille = savedData.length;
            console.log(jury_id);
            for (let i = 0; i < taille; i++) {
                const scoreSpan = document.getElementById(`score-${i+1}`);
                const labelsRangeInput = document.querySelectorAll(`#labels-range-input`)[taille - i - 1];

                if (scoreSpan) {
                    scoreSpan.textContent = `Score : ${savedData[taille - i - 1]}`;
                }

                if (labelsRangeInput) {
                    labelsRangeInput.value = savedData[taille - i - 1];
                }
            }
        });
    </script>
@endsection
