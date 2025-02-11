<x-app-layout>
    <x-slot name="header">
        <div class="">
            <h3 class="text-2xl font-extrabold dark:text-white">
                {{ $evenement->nom }}
            </h3>
            <h3 class="text-1xl font-extrabold dark:text-white">

                {{ $phase->nom }}
            </h3>
            <p class="flex justify-inline items-center text-gray-500 dark:text-gray-400 ">
                {{ $phase->decription }}
            </p>
        </div>
        <div class="flex justify-between items-center pt-5">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Résultat des votes') }}
            </h2>
        </div>
    </x-slot>
    <div class="relative overflow-x-auto shadow-md" style="padding-top: 10px;">
        <div class="bg-white dark:bg-gray-800 shadow">
            <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight ">
                        {{ __('Exportation des résultats en Excel') }}
                    </h3>
                    <a href="{{ route('export_vote', $phase_id) }}"
                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        Exporter
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                            class="size-6 pl-2">
                            <path
                                d="M8.75 2.75a.75.75 0 0 0-1.5 0v5.69L5.03 6.22a.75.75 0 0 0-1.06 1.06l3.5 3.5a.75.75 0 0 0 1.06 0l3.5-3.5a.75.75 0 0 0-1.06-1.06L8.75 8.44V2.75Z" />
                            <path
                                d="M3.5 9.75a.75.75 0 0 0-1.5 0v1.5A2.75 2.75 0 0 0 4.75 14h6.5A2.75 2.75 0 0 0 14 11.25v-1.5a.75.75 0 0 0-1.5 0v1.5c0 .69-.56 1.25-1.25 1.25h-6.5c-.69 0-1.25-.56-1.25-1.25v-1.5Z" />
                        </svg>

                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400" id="resultTable">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-2">N°</th>
                    <th scope="col" class="py-2">Nom</th>
                    <th scope="col" class="py-2">Email</th>
                    <th scope="col" class="py-2" {{ strtolower($phase->type) == 'vote' ? 'hidden' : '' }}>Sexe</th>
                    @if (strtolower($phase->type) == 'vote')
                        <th scope="col" class="py-2">Image</th>
                        <th id="priveTh" scope="col" class="py-2">
                            Cote privé (Pond : {{ $ponderationJuryPrive }})
                        </th>
                        <th id="publicTh" scope="col" class="py-2">
                            Cote public (Pond : {{ $ponderationJuryPublic }})
                        </th>
                        <th scope="col" class="py-2">Cote total</th>
                    @endif
                    <th scope="col" class="py-2">Pourcentage</th>
                    <th scope="col" class="py-2" {{ strtolower($phase->type) == 'vote' ? 'hidden' : '' }}>A retenir
                    </th>
                    <th scope="col" class="py-2">Nombre jury</th>
                    <th scope="col" class="py-2">details jury</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($intervenants as $i => $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-2">{{ $i + 1 }}</td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->noms }}
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->email }}
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white"
                            {{ strtolower($phase->type) == 'vote' ? 'hidden' : '' }}>
                            {{ $item->genre == 'M' || $item->genre == 'm' ? 'Masculin' : ($item->genre == 'F' || $item->genre == 'f' ? 'Féminin' : 'Non précisé') }}
                        </td>
                        @if (strtolower($phase->type) == 'vote')
                            <td class="py-2 pr-1 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                <img width="40" height="40" class="img img-responsive"
                                    src="{{ $item->image && file_exists(public_path($item->image)) ? asset($item->image) : asset('images/profil.jpg') }}"
                                    alt="">
                            </td>
                            <td id="priveTb{{ $i }}"
                                class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->votePrive }}
                            </td>
                            <td id="publicTb{{ $i }}"
                                class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->votePublic }}
                            </td>
                            <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                {{ $item->cote }}
                            </td>
                        @endif
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->pourcentage }}%
                        </td>
                        <td class="py-2 text-gray-900 whitespace-nowrap dark:text-gray-400"
                            {{ strtolower($phase->type) == 'vote' ? 'hidden' : '' }}>
                            OUI : <span class="font-medium text-white">{{ $item->decisionOui }}</span> | NON : <span
                                class="font-medium text-white">{{ $item->decisionNon }}</span> | AT : <span
                                class="font-medium text-white">{{ $item->decisionAttente }}</span>
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nombreJury }}
                        </td>
                        <td>
                            <button onclick="openModal(this)" data-id="{{ $item->id }}" data-intervenant_phase="{{$item->intervenantPhase_id}}"
                                data-phase="{{ $item->phase_id }}"
                                class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                                Voir les votes
                            </button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Main modal -->
    <div id="voteModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-lg shadow-lg w-3/4">
            <div class="flex justify-between items-center border-b pb-2">
                <h2 class="text-xl font-semibold" id="intervenant"></h2>
            </div>
            <div id="modalBody" class="mt-4">

            </div>
            <div class="mt-4 flex justify-end">
                <button onclick="closeModal()" class="bg-red-500 text-white px-4 py-2 rounded">Fermer</button>
            </div>
        </div>
    </div>


    <script>
        window.onload = function() {
            initial("{{ $typeVote }}");
        };

        $(document).ready(function() {
            $('#resultTable').DataTable();
        });

        function initial(typeVote) {
            const priveTh = document.getElementById("priveTh");
            const publicTh = document.getElementById("publicTh");

            // Hide all td elements with id starting with "priveTb" or "publicTb"
            document.querySelectorAll('[id^="priveTb"]').forEach(el => el.style.display = "none");
            document.querySelectorAll('[id^="publicTb"]').forEach(el => el.style.display = "none");

            // Hide the headers based on typeVote
            if (typeVote !== 'prive et public') {
                priveTh.style.display = "none";
                publicTh.style.display = "none";
            } else {
                // If 'prive et public', show the relevant elements
                document.querySelectorAll('[id^="priveTb"]').forEach(el => el.style.display = "");
                document.querySelectorAll('[id^="publicTb"]').forEach(el => el.style.display = "");
                priveTh.style.display = "";
                publicTh.style.display = "";
            }
        }

        function openModal(button) {
            let intervenant_id = button.getAttribute("data-id");
            let phase_id = button.getAttribute("data-phase");
            let interveant_phase_id = button.getAttribute("data-intervenant_phase");

            fetch(`/votes/${intervenant_id}/${phase_id}/${interveant_phase_id}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('intervenant').textContent = `${data.intervenant_nom}`;

                    let modalBody = document.getElementById('modalBody');
                    modalBody.innerHTML = '';

                    let juryCotes = data.juryCotes;

                    if (Object.keys(juryCotes).length > 0) {

                        let criteres = new Set();
                        for (let jury in juryCotes) {
                            juryCotes[jury].forEach(vote => criteres.add(vote.critere));
                        }
                        criteres = Array.from(criteres);

                        let tableHtml = `<table class="w-full border border-gray-300">
                                    <thead>
                                        <tr class="bg-gray-200">
                                            <th class="border px-4 py-2">Jurys</th>`;

                        criteres.forEach(critere => {
                            tableHtml += `<th class="border px-4 py-2">${critere}</th>`;
                        });

                        tableHtml += `</tr></thead><tbody>`;

                        for (let jury in juryCotes) {
                            tableHtml += `<tr>
                                    <td class="border px-4 py-2">${jury}</td>`;

                            criteres.forEach(critere => {
                                let cote = juryCotes[jury].find(vote => vote.critere === critere);
                                tableHtml +=
                                    `<td class="border px-4 py-2 text-center">${cote ? cote.cote : '-'}</td>`;
                            });

                            tableHtml += `</tr>`;
                        }

                        tableHtml += `</tbody></table>`;
                        modalBody.innerHTML = tableHtml;
                    } else {
                        modalBody.innerHTML =
                            `<p class="text-gray-600">Aucune cote attribuée pour cet intervenant.</p>`;
                    }


                    document.getElementById('voteModal').classList.remove('hidden');
                })
                .catch(error => console.error("Erreur lors du chargement des votes :", error));
        }

        function closeModal() {
            document.getElementById('voteModal').classList.add('hidden');
        }
    </script>

</x-app-layout>
