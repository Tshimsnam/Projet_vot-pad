@extends('layouts.template')
@section('content')
    <section id="voteUser" class="px-4 md:px-8">
        <div class="mb-5 pt-8 flex justify-center">
            <h2
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold text-white">
                <img class="w-12 h-12" src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                    alt="logo">
                otePad2
            </h2>
        </div>
        <h2 class="mb-1 text-4xl font-extrabold text-white">{{ $evenement->nom }}</h2>
        <h2 class="mb-3 text-xl font-extrabold text-white">{{ $phaseAndSpeaker->nom }}</h2>
        <p class="text-sm font-normal text-white">{{ $phaseAndSpeaker->description }}</p>
        <div class="py-5">
            <div class="text-center mb-4">
                <h3 class="text-2xl font-bold leading-none text-white uppercase">Les candidats</h3>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($intervenants as $item)
                    <div class="bg-white bg-opacity-90 border border-gray-300 border-opacity-90 rounded-lg shadow sm:p-4">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse p-2 md:p-0">
                            <div class="flex-shrink-0">
                                <img class="w-16 h-16 rounded-full border border-gray-300"
                                    src="{{ $item->image && file_exists(public_path($item->image)) ? asset($item->image) : asset('images/profil.jpg') }}"
                                    alt="">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xl font-medium uppercase text-gray-900 truncate dark:text-black">
                                    {{ $item->nom_groupe }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $item->email }}
                                </p>
                                <h3 id="cote-{{ $item->id }}"
                                    class="inline-flex items-center text-base font-semibold text-gray-900">
                                </h3>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    <a id="vote-{{ $item->id }}"
                                        href="{{ route('showIntervenant', [$phaseAndSpeaker->slug, 'candidat' => $item->id, 'jury' => $jury_id, 'nombreUser' => $nombreUser, 'evenement' => $evenement]) }}"
                                        class="px-3 text-sm gap-3 font-medium text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:font-medium rounded-lg focus:text-sm focus: py-2.5 me-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <a id="icon-{{ $item->id }}"
                                        href="{{ route('showIntervenant', [$phaseAndSpeaker->slug, 'candidat' => $item->id, 'jury' => $jury_id, 'nombreUser' => $nombreUser, 'evenement' => $evenement]) }}"
                                        class="px-3 text-sm gap-3 font-medium text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:font-medium rounded-lg focus:text-sm focus: py-2.5 me-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800"
                                        style="display: none">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-5">
                                            <path
                                                d="m5.433 13.917 1.262-3.155A4 4 0 0 1 7.58 9.42l6.92-6.918a2.121 2.121 0 0 1 3 3l-6.92 6.918c-.383.383-.84.685-1.343.886l-3.154 1.262a.5.5 0 0 1-.65-.65Z" />
                                            <path
                                                d="M3.5 5.75c0-.69.56-1.25 1.25-1.25H10A.75.75 0 0 0 10 3H4.75A2.75 2.75 0 0 0 2 5.75v9.5A2.75 2.75 0 0 0 4.75 18h9.5A2.75 2.75 0 0 0 17 15.25V10a.75.75 0 0 0-1.5 0v5.25c0 .69-.56 1.25-1.25 1.25h-9.5c-.69 0-1.25-.56-1.25-1.25v-9.5Z" />
                                        </svg>

                                    </a>

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="pb-5">
            <button id="buttonCheck" data-modal-target="check-modal" data-modal-toggle="check-modal"
                class="block text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800"
                type="button" style="display: none">
                Valider
            </button>
        </div>
        <div id="check-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
            <div class="relative p-4 w-full max-w-2xl max-h-full">
                <!-- Modal content -->
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <!-- Modal header -->
                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                            Résumé du vote
                        </h3>
                    </div>
                    <!-- Modal body -->
                    <div class="p-4 md:p-5 space-y-4">
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Nom</th>
                                    <th scope="col" class="px-6 py-3">Cotes</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-tbody">
                                @foreach ($intervenants as $i => $item)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4 uppercase font-bold">{{ $item->nom_groupe }}</td>
                                        <td class="px-6 py-4 cote" id="sum-{{ $item->id }}">{{ $item->id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- Modal footer -->
                    <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                        <button data-modal-hide="check-modal" type="button"
                            onclick="finVote('{{ $phase_id }}', '{{ $candidats }}', '{{ $jury_id }}')"
                            class="text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">Confirmer</button>
                        <button data-modal-hide="check-modal" type="button"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Annuler</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function getDataFromLocalStorage(phaseId, candidats_id, jury_id, criteresIds, nombreUser) {
            let data = [];
            let somme = Array(candidats_id.length).fill(0);
            let coteValue = Array(candidats_id.length);
            for (let j = 0; j < candidats_id.length; j++) {
                let i = 0;
                let nombreCritere = criteresIds.length;
                while (i < nombreCritere) {
                    let cote = localStorage.getItem(`sum-${phaseId}${ jury_id }${candidats_id[j]}${nombreUser}`);
                    if (cote === null) {
                        break;
                    }
                    coteValue[j] = parseInt(cote);
                    somme[j] = coteValue[j];
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
            let criteresIds = {{ $criteres }}
            let nombreUser = {{ $nombreUser }}

            getLocalStorage(phase_id, candidats, jury_id, criteresIds, nombreUser);

            let tbody = document.getElementById('sortable-tbody');
            let rows = Array.from(tbody.getElementsByTagName('tr'));
            rows.sort(function(a, b) {
                let coteA = parseFloat(a.querySelector('.cote').textContent);
                let coteB = parseFloat(b.querySelector('.cote').textContent);

                return coteB - coteA;
            });
            rows.forEach(function(row) {
                tbody.appendChild(row);
            });
        });

        function getLocalStorage(phase_id, candidats, jury_id, criteresIds, nombreUser) {
            const savedData = getDataFromLocalStorage(phase_id, candidats, jury_id, criteresIds, nombreUser);
            const taille = savedData.length;
            let check = taille;
            const coteCandidat = [];
            const voteCandidat = [];
            const iconCandidat = [];
            const sumCandidat = [];
            for (let i = 0; i < taille; i++) {
                coteCandidat[i] = document.getElementById(`cote-${candidats[i]}`);
                if (coteCandidat[i]) {
                    if (savedData[i] != 0) {
                        voteCandidat[i] = document.getElementById(`vote-${candidats[i]}`);
                        iconCandidat[i] = document.getElementById(`icon-${candidats[i]}`);
                        voteCandidat[i].style.display = 'none';
                        iconCandidat[i].style.display = 'block';
                        check--;
                    }
                    coteCandidat[i].textContent = "COTE : " + savedData[i];
                }
            }
            if (check === 0) {
                for (let i = 0; i < taille; i++) {
                    sumCandidat[i] = document.getElementById(`sum-${candidats[i]}`);
                    if (sumCandidat[i]) {
                        sumCandidat[i].textContent = savedData[i];
                    }
                }
                const buttonCheck = document.getElementById('buttonCheck');
                buttonCheck.style.display = 'block';
            }
        }

        function finVote(phaseId, candidats_id, jury_id) {
            for (let j = 0; j < candidats_id.length; j++) {
                localStorage.removeItem(`sum-${phaseId}${jury_id}${candidats_id[j]}{{ $nombreUser }}`);
            }
            window.location.href = "{{ route('voteIndex') }}";
        }
    </script>
@endsection
