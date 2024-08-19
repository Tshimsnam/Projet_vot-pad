@extends('layouts.template')
@section('content')
    <section class="px-8 mt-8">
        <div class="flex justify-center">
            <a href="#" class="flex items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2"
                    src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg" alt="logo">
                VotePad2
            </a>
        </div>
        <h2 class="mb-5 text-4xl font-extrabold dark:text-white">{{ $phaseAndSpeaker->nom }}</h2>
        <p class="mb-4 text-lg font-normal text-gray-500 dark:text-gray-400">{{ $phaseAndSpeaker->description }}</p>
        <div class="mb-5">
            <div class="flex items-center justify-between mb-4">
                <h5 class="text-2xl font-bold leading-none text-gray-900 dark:text-white">Les candidats</h5>
            </div>
            @foreach ($intervenants as $i => $item)
                <ul
                    class="mb-3 bg-white border border-gray-200 rounded-lg shadow sm:p-1 max-w-md divide-y divide-gray-200 dark:divide-gray-700">
                    <li class="py-2 px-2">
                        <div class="flex items-center space-x-4 rtl:space-x-reverse">
                            <div class="flex-shrink-0">
                                <img class="w-8 h-8 rounded-full"
                                    src="{{ $item->image ? asset($item->image) : asset('images/profil.jpg') }}"
                                    alt="">
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate dark:text-white">
                                    {{ $item->nom_groupe }}
                                </p>
                                <p class="text-sm text-gray-500 truncate dark:text-gray-400">
                                    {{ $item->email }}
                                </p>
                            </div>
                            <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                <h3 id="cote-{{ $item->id }}"
                                    class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white">
                                </h3>
                                <div class="inline-flex items-center text-base font-semibold text-gray-900 dark:text-white"
                                    style="padding-left: 10px">
                                    <a id="vote-{{ $item->id }}"
                                        href="{{ route('showIntervenant', [$phaseAndSpeaker->slug, 'candidat' => $item->id, 'jury' => $jury_id]) }}"
                                        class="px-3 text-sm gap-3 font-medium text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:font-medium rounded-lg focus:text-sm focus: py-2.5 me-2 dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                        <span class="text-md">Voter</span>
                                    </a>
                                    <svg id="icon-{{ $item->id }}" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" class="w-6"
                                        viewBox="0 0 256 256" xml:space="preserve" hidden>
                                        <defs>
                                        </defs>
                                        <g style="stroke: none; stroke-width: 0; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: none; fill-rule: nonzero; opacity: 1;"
                                            transform="translate(1.4065934065934016 1.4065934065934016) scale(2.81 2.81)">
                                            <path
                                                d="M 43.077 63.077 c -0.046 0 -0.093 -0.001 -0.14 -0.002 c -1.375 -0.039 -2.672 -0.642 -3.588 -1.666 L 23.195 43.332 c -1.84 -2.059 -1.663 -5.22 0.396 -7.06 c 2.059 -1.841 5.22 -1.664 7.06 0.396 l 12.63 14.133 l 38.184 -38.184 c 1.951 -1.952 5.119 -1.952 7.07 0 c 1.953 1.953 1.953 5.119 0 7.071 L 46.612 61.612 C 45.674 62.552 44.401 63.077 43.077 63.077 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,165,16); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                            <path
                                                d="M 45 90 C 20.187 90 0 69.813 0 45 C 0 20.187 20.187 0 45 0 c 2.762 0 5 2.239 5 5 s -2.238 5 -5 5 c -19.299 0 -35 15.701 -35 35 s 15.701 35 35 35 s 35 -15.701 35 -35 c 0 -2.761 2.238 -5 5 -5 s 5 2.239 5 5 C 90 69.813 69.813 90 45 90 z"
                                                style="stroke: none; stroke-width: 1; stroke-dasharray: none; stroke-linecap: butt; stroke-linejoin: miter; stroke-miterlimit: 10; fill: rgb(0,165,16); fill-rule: nonzero; opacity: 1;"
                                                transform=" matrix(1 0 0 1 0 0) " stroke-linecap="round" />
                                        </g>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            @endforeach
        </div>

        <button data-modal-target="check-modal" data-modal-toggle="check-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" style="display: none">
        </button>

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
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Cotes</th>
                                </tr>
                            </thead>
                            <tbody id="sortable-tbody">
                                @foreach ($phaseAndSpeaker->intervenants as $i => $item)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-4">{{ $item->email }}</td>
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
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function getDataFromLocalStorage(phaseId, candidats_id, jury_id, criteresIds) {
            let data = [];
            let somme = Array(candidats_id.length).fill(0);
            let coteValue = Array(candidats_id.length);
            for (let j = 0; j < candidats_id.length; j++) {
                let i = 0;
                let nombreCritere = criteresIds.length;
                while (i < nombreCritere) {
                    let cote = localStorage.getItem(`sum-${phaseId}${ jury_id }${candidats_id[j]}`);
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

            getLocalStorage(phase_id, candidats, jury_id, criteresIds);

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

        function getLocalStorage(phase_id, candidats, jury_id, criteresIds) {
            const savedData = getDataFromLocalStorage(phase_id, candidats, jury_id, criteresIds);
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
                        iconCandidat[i].removeAttribute('hidden');
                        check--;
                    }
                    coteCandidat[i].textContent = "COTE : " + savedData[i];
                }
            }
            if (check === 0) {

                console.log('check ok');
                for (let i = 0; i < taille; i++) {
                    sumCandidat[i] = document.getElementById(`sum-${candidats[i]}`);
                    if (sumCandidat[i]) {
                        sumCandidat[i].textContent = savedData[i];
                    }
                }
                const checkModal = document.getElementById('check-modal');
                checkModal.classList.remove('hidden');
                checkModal.classList.add('flex');
            }
        }

        function finVote(phaseId, candidats_id, jury_id) {
            for (let j = 0; j < candidats_id.length; j++) {
                localStorage.removeItem(`sum-${phaseId}${jury_id}${candidats_id[j]}`);
            }

            console.log('test ok');
            window.location.href = "{{ route('voteIndex') }}";
        }
    </script>
@endsection
