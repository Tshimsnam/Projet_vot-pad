@extends('layouts.template')
@section('content')
    <section id="voteUser" class="px-4 md:px-8">
        <div class="mb-5 pt-5 flex justify-center">
            <h2
                class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white ">
                <img class="w-10 h-10" src="{{ asset('img/momekano.png') }}" alt="logo">
                omekano
            </h2>
        </div>
        {{-- <h2 class="mb-1 text-4xl font-extrabold dark:text-white">{{ $evenement->nom }}</h2> --}}
        <h2 class=" text-3xl font-extrabold dark:text-white">{{ $phaseAndSpeaker->nom }}</h2>
        {{-- <p class="text-sm font-normal text-white">{{ $phaseAndSpeaker->description }}</p> --}}
        <div class="py-5">
            <div class="flex justify-between mb-4">
                <h3 class="text-1xl font-bold leading-none dark:text-white uppercase">Les candidats</h3>
                <h3 id="voteNombre" class="text-1xl font-bold leading-none dark:text-white uppercase"></h3>
            </div>
            <div class="mb-4">
                <input type="text" id="search" placeholder="Rechercher par nom..."
                    class="w-full px-3 py-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach ($intervenants as $item)
                    <div
                        class="bg-gray-200 bg-opacity-95 border border-gray-300 border-opacity-90 rounded-lg shadow sm:p-4 dark:bg-gray-600 dark:border-gray-600 dark:bg-opacity-95">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse p-2 md:p-0">
                            <div class="flex-shrink-0">
                                <img class="w-16 h-16 rounded-full border border-gray-300"
                                    src="{{ $item->image && file_exists(public_path($item->image)) ? asset($item->image) : asset('images/profil.jpg') }}"
                                    alt="">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xl font-medium uppercase text-gray-900 truncate dark:text-white">
                                    {{ $item->noms }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-300">
                                    {{ $item->email }}
                                </p>
                                <h3 id="cote-{{ $item->id }}"
                                    class="inline-flex items-center text-base font-semibold dark:text-white">
                                </h3>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                    <a id="vote-{{ $item->id }}"
                                        href="{{ route('showIntervenant', [$phaseAndSpeaker->slug, 'candidat' => $item->id, 'jury' => $jury_id, 'nombreUser' => $nombreUser, 'evenement' => $evenement]) }}"
                                        class="px-3 text-sm gap-3 font-medium text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:font-medium rounded-lg focus:text-sm focus: py-2.5 me-2 dark:bg-gray-100 dark:hover:bg-gray-300 focus:outline-none dark:focus:ring-gray-800 dark:text-gray-800">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                            class="size-6">
                                            <path fill-rule="evenodd"
                                                d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </a>
                                    <svg id="icon-{{ $item->id }}" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1"
                                        class="w-8 mr-5
                                        " viewBox="0 0 256 256"
                                        xml:space="preserve" hidden>
                                        <defs>
                                        </defs>
                                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                            <path
                                                d="M 43.077 63.077 c -0.046 0 -0.093 -0.001 -0.14 -0.002 c -1.375 -0.039 -2.672 -0.642 -3.588 -1.666 L 23.195 43.332 c -1.84 -2.059 -1.663 -5.22 0.396 -7.06 c 2.059 -1.841 5.22 -1.664 7.06 0.396 l 12.63 14.133 l 38.184 -38.184 c 1.951 -1.952 5.119 -1.952 7.07 0 c 1.953 1.953 1.953 5.119 0 7.071 L 46.612 61.612 C 45.674 62.552 44.401 63.077 43.077 63.077 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,165,16); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 45 90 C
                                                                                20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 2.762 0 5 2.239 5 5 s -2.238
                                                                                5 -5 5 c -19.299 0 -35 15.701 -35 35 s 15.701 35 35 35 s 35 -15.701 35 -35 c 0
                                                                                -2.761 2.238 -5 5 -5 s 5 2.239 5 5 C 90 69.813 69.813 90 45 90 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,165,16); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                        </g>
                                    </svg>
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
                                        <td class="px-6 py-4 uppercase font-bold">{{ $item->noms }}</td>
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
        if (localStorage.getItem("refreshPreviousPage") === "true") {
            console.log('back succes');
            
            let candidats = {{ $candidats }};
            let jury_id = {{ $jury_id }};
            let phase_id = {{ $phase_id }};
            let criteresIds = {{ $criteres }};
            let nombreUser = {{ $nombreUser }};
            getLocalStorage(phase_id, candidats, jury_id, criteresIds, nombreUser);
            
            localStorage.removeItem("refreshPreviousPage");
        }
        const searchInput = document.getElementById('search');
        const items = document.querySelectorAll('.grid > div');

        searchInput.addEventListener('input', function() {
            const query = searchInput.value.toLowerCase();

            items.forEach(item => {
                const name = item.querySelector('p.text-xl').textContent.toLowerCase();
                if (name.includes(query)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });


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
            let voteCount = 0;
            for (let i = 0; i < taille; i++) {
                coteCandidat[i] = document.getElementById(`cote-${candidats[i]}`);
                if (coteCandidat[i]) {
                    if (savedData[i] != 0) {
                        voteCandidat[i] = document.getElementById(`vote-${candidats[i]}`);
                        iconCandidat[i] = document.getElementById(`icon-${candidats[i]}`);
                        voteCandidat[i].style.display = 'none';
                        iconCandidat[i].style.display = 'block';
                        voteCount++;
                        check--;
                    }
                    coteCandidat[i].textContent = "COTE : " + savedData[i];
                }
            }

            const nombreCandidat = {{ count($intervenants) }};
            const voteNombre = document.getElementById('voteNombre');
            voteNombre.textContent = voteCount + "/" + nombreCandidat + " notes";

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
                localStorage.clear();
            }
            window.location.href = "{{ route('voteIndex') }}";
        }
    </script>
@endsection
