@extends('layouts.template')
@section('content')
    <section>
        <h1 class="mt-2  text-3xl font-bold">{{ $phaseAndSpeaker->nom }}</h1>
        <p class="mb-5 font-extralight text-gray-500  text-justify sm:w-3/4"></p>
        <div class="">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">N°</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Groupe</th>
                        <th scope="col" class="px-6 py-3">Cotes</th>
                        <th scope="col" class="px-6 py-3">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phaseAndSpeaker->intervenants as $i => $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->email }}</td>
                            <td class="px-6 py-4">
                                @if ($item->groupe_id == 0)
                                    <span
                                        class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10">Seul(e)</span>
                                @else
                                    <span
                                        class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Team</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 cote" id="cote-{{ $item->id }}">0</td>
                            <td class="px-4">
                                <a href="{{ route('showIntervenant', [$phaseAndSpeaker->slug, 'candidat' => $item->id, 'jury' => $jury_id]) }}"
                                    class="px-3 text-sm gap-3 font-medium text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:font-medium rounded-lg focus:text-sm focus:px-5 py-2.5 me-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                    <span class="text-md">Voter</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-4">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pt-5">
                <a href="#" id="submit-btn" data-modal-target="valid-modal" data-modal-toggle="valid-modal"
                    class="text-white bg-gray-800 hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 font-medium rounded-md text-sm px-5 py-2.5 me-2 mb-2 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
                    Envoyer
                </a>
            </div>
        </div>

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
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Voulez-vous confirmer votre vote</h3>
                        <button data-modal-hide="valid-modal" type="button" onclick="clearLocalStorage(event, '{{ $phase_id }}', '{{ $candidats }}', '{{ $jury_id }}')"
                            class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
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
        function getDataFromLocalStorage(phaseId, candidats_id, jury_id) {
            let data = [];
            let somme = Array(candidats_id.length).fill(0);
            let coteValue = Array(candidats_id.length);

            for (let j = 0; j < candidats_id.length; j++) {
                let i = 0;
                let allFound = true;
                while (allFound) {
                    let cote = localStorage.getItem(`cote-${phaseId}${i}${ jury_id }${candidats_id[j]}`);
                    if (cote === null) {
                        allFound = false;
                        break;
                    }
                    coteValue[j] = parseInt(cote);
                    somme[j] += coteValue[j];
                    i++;
                }
            }

            for (let j = 0; j < candidats_id.length; j++) {
                data.push({
                    candidat_id: candidats_id[j],
                    somme: somme[j]
                });
            }

            return somme;
        }

        document.addEventListener('DOMContentLoaded', () => {
            let candidats = {{ $candidats }};
            let jury_id = {{ $jury_id }}
            let phase_id = {{ $phase_id }}
            getLocalStorage(phase_id, candidats, jury_id);
        });

        function clearLocalStorage(event, phase_id, candidats, jury_id) {
            event.preventDefault();
            Object.keys(localStorage).forEach((key) => {
                if (key.startsWith(`cote-${phase_id}`)) {
                    localStorage.removeItem(key);
                }
            });
            getLocalStorage(phase_id, candidats, jury_id);
        }

        function getLocalStorage(phase_id, candidats, jury_id) {

            const savedData = getDataFromLocalStorage(phase_id, candidats, jury_id);
            const taille = savedData.length;
            console.log(jury_id);
            const coteCandidat = [];

            for (let i = 0; i < taille; i++) {
                coteCandidat[i] = document.getElementById(`cote-${i+1}`);

                if (coteCandidat[i]) {
                    coteCandidat[i].textContent = savedData[i];
                }
            }
        }
    </script>
@endsection
