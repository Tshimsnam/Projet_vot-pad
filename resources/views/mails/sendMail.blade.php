<x-app-layout>
    <x-slot name="header">

        <div class="flex justify-between">
            <div>
                <div class="">
                    <h3 class="text-2xl font-extrabold dark:text-white">
                        {{ $evenement->nom }}
                    </h3>
                    <h3 class="text-1xl font-extrabold dark:text-white">
                        {{ $phaseShow->nom }}
                    </h3>
                </div>
                <div class="flex justify-between items-center">
                    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                        {{ __('Gestion des mails') }}
                    </h2>
                </div>
            </div>

        </div>
        {{-- <div class="flex justify-end">
            <div
                class="flex justify-between  w-1/4 py-2 px-3 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg dark:bg-gray-700 dark:border-gray-600 mt-3">
                <label for="nonPresent" class="ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Cochez si
                    le test est
                    hors ODC</label>
                <input id="nonPresent" type="checkbox" value="interieur" name="nonPresent"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">

            </div>
        </div> --}}

    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
        @if (session('success'))
            <div id="alert-3"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('success') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <div id="alertInterv"
            class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
            role="alert" style="display: none">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                Veuillez selectionner au moins un intervenant
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-2" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div id="alertMail"
            class="flex items-center p-4 mb-4 text-blue-800 rounded-lg bg-blue-50 dark:bg-gray-800 dark:text-blue-400"
            role="alert" style="display: none">
            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                viewBox="0 0 20 20">
                <path
                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="sr-only">Info</span>
            <div class="ms-3 text-sm font-medium">
                Vos e-mails sont actuellement en cours d'envoi.
            </div>
            <button type="button"
                class="ms-auto -mx-1.5 -my-1.5 bg-blue-50 text-blue-500 rounded-lg focus:ring-2 focus:ring-blue-400 p-1.5 hover:bg-blue-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-blue-400 dark:hover:bg-gray-700"
                data-dismiss-target="#alert-1" aria-label="Close">
                <span class="sr-only">Close</span>
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
            </button>
        </div>

        <div class="bg-white dark:bg-gray-800 shadow p-2 mb-3">
            <form class="flex justify-between " action="">
                <div class="mb-3">
                    <label for="objet" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Objet du
                        mail</label>
                    <input type="text" id="objet" name="objet"
                        class="w-96 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Saisissez l'objet du mail" required />
                </div>
                <div class="flex gap-2" id="">
                    <div>
                        <label id="dateLabel" for="dateTest"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date_Fin de
                            l'evaluation</label>
                        <div class="relative mb-3">
                            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                </svg>
                            </div>
                            <input id="dateTest" datepicker datepicker-autohide datepicker-orientation="bottom"
                                datepicker-format="dd/mm/yyyy" type="text" name="dateTest"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Select date" autocomplete="off" required>
                        </div>
                    </div>

                    <div>
                        <label for="heureTest" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Heure_Fin de l'evaluation
                        </label>
                        <div class="relative">
                            <div class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                    <path fill-rule="evenodd"
                                        d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                        clip-rule="evenodd" />
                                </svg>
                            </div>
                            <input type="time" id="heureTest" name="heureTest"
                                class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                min="00:00" max="24:00" value="08:00" />
                        </div>
                    </div>

                </div>

                <button id="submitButton" type="submit" hidden>Submit</button>
            </form>

        </div>

        <div class="pb-5 flex justify-between items-center">
            <div>
                <h3 class="text-xl dark:text-white">Candidats selectionnés: <span id="selectedCount">0</span></h3>
            </div>
            <div>
                <a id="sendMail" href=""
                    class="px-4 py-2 text-sm font-medium text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                    Envoyer les mails
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                        class="w-8 h-5 pl-2">
                        <path
                            d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                        <path
                            d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                    </svg>
                </a>
            </div>
        </div>
        <div class=" pb-4 flex justify-between items-center">
            <div class="relative mt-1">
                <div class="absolute inset-y-0 rtl:inset-r-0 start-0 flex items-center ps-3 pointer-events-none">
                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                    </svg>
                </div>
                <input type="text" id="searchIntervenant"
                    class="block pt-2 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                    placeholder="Recherche intervenant">
            </div>

            <div class="flex items-center">

                <label for="ligneParPage" class="text-sm pr-2 text-gray-900 dark:text-gray-200">Lignes</label>
                <select id="ligneParPage"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option selected value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
            </div>
        </div>

        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400 display"
            style="width: 100%" id="gestionMail">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="p-4">
                        <div class="flex items-center">
                            <input id="CheckAll" onclick="checkAll()" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="CheckAll" class="sr-only">checkbox</label>
                        </div>
                    </th>
                    <th scope="col" class="">
                        N°
                    </th>
                    <th scope="col" class="px-6 py-3">
                        noms
                    </th>
                    <th scope="col" class="px-6 py-3">
                        emails
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Sexe
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Statut
                    </th>
                </tr>
            </thead>
            <tbody id="tabBody">
                @foreach ($intervenants as $i => $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="w-4 p-4">
                            <div class="flex items-center">
                                <div class="flex items-center">
                                    <input id="checkbox-{{ $i }}" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                                        style="{{ $item->mail_send != 0 ? 'display: none;' : '' }}"
                                        {{ $item->mail_send != 0 ? 'disabled' : '' }}>
                                </div>

                                <label for="checkbox-{{ $i }}" class="sr-only">checkbox</label>
                            </div>
                        </td>
                        <td class="">{{ $i + 1 }}</td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->noms }}</th>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->email }}</th>
                        <td class="px-4">
                            {{ strtoupper($item->genre) }}
                        </td>
                        <td class="px-6 py-4">
                            @if ($item->mail_send == 0)
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-7 pl-2 text-red-500">
                                    <path
                                        d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                    <path
                                        d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                </svg>
                            @else
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-7 pl-2 text-green-500">
                                    <path
                                        d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                    <path
                                        d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                </svg>
                            @endif
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>

        <div id="pagination-container" class="flex justify-end pt-5">
            <nav aria-label="Page navigation example">
                <ul id="pagination" class="flex items-center -space-x-px h-8 text-sm">
                    <!-- La pagination sera générée dynamiquement par jQuery -->
                </ul>
            </nav>
        </div>
    </div>
    <script>
        let filteredIntervenants = [];

        $(document).ready(function() {
            const allIntervenants = @json($intervenants);
            filteredIntervenants = [...allIntervenants];
            let currentPage = 1;
            let rowsPerPage = parseInt($('#ligneParPage').val());
            let rows = $("#gestionMail tbody tr");

            // Fonction pour mettre à jour le nombre total de pages
            function updateTotalPages() {
                return Math.ceil($("#gestionMail tbody tr").length / rowsPerPage);
            }

            // Fonction pour afficher les lignes de la page courante
            function displayRows(page) {
                const start = (page - 1) * rowsPerPage;
                const end = start + rowsPerPage;
                rows = $("#gestionMail tbody tr"); // Mettre à jour la référence des lignes
                rows.hide();
                rows.slice(start, end).show();
            }

            // Fonction pour générer la pagination
            function setupPagination() {
                const totalPages = updateTotalPages();
                const ul = $("#pagination");
                ul.empty();

                // Bouton précédent
                ul.append(`
                    <li>
                        <a href="#" class="prev-page flex items-center justify-center px-3 h-8 ms-0 leading-tight text-gray-500 bg-white border border-e-0 border-gray-300 rounded-s-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Previous</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                            </svg>
                        </a>
                    </li>
                `);

                // Pages numérotées
                for (let i = 1; i <= totalPages; i++) {
                    ul.append(`
                        <li>
                            <a href="#" data-page="${i}" class="page-link flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ${currentPage === i ? 'active bg-blue-50 text-blue-600' : ''}">${i}</a>
                        </li>
                    `);
                }

                // Bouton suivant
                ul.append(`
                    <li>
                        <a href="#" class="next-page flex items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 rounded-e-lg hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            <span class="sr-only">Next</span>
                            <svg class="w-2.5 h-2.5 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                            </svg>
                        </a>
                    </li>
                `);
            }

            $("#searchIntervenant").on("keyup", function() {

                const searchValue = $(this).val().toLowerCase();
                const tabBody = $("#tabBody");
                const checkAll = $("#CheckAll");

                if (searchValue === "") {
                    tabBody.find("tr").show();
                    setupPagination();
                    displayRows(currentPage);
                    checkAll.prop("disabled", false);
                    return;
                }

                // Parcourir chaque ligne du tableau pour filtrer
                checkAll.prop("disabled", true);
                tabBody.find("tr").each(function() {
                    const row = $(this);

                    const noms = row.find("th:nth-child(3)").text().toLowerCase();
                    const email = row.find("th:nth-child(4)").text().toLowerCase();


                    if (noms.includes(searchValue) || email.includes(searchValue)) {
                        row.show();
                    } else {
                        row.hide();
                    }
                });
            });


            // Initialisation
            currentPage = 1;
            setupPagination();
            displayRows(currentPage);

            // Gestionnaires d'événements pour la pagination
            $(document).on("click", ".page-link", function(e) {
                e.preventDefault();
                currentPage = parseInt($(this).data("page"));
                displayRows(currentPage);
                setupPagination();
            });

            $(document).on("click", ".prev-page", function(e) {
                e.preventDefault();
                if (currentPage > 1) {
                    currentPage--;
                    displayRows(currentPage);
                    setupPagination();
                }
            });

            $(document).on("click", ".next-page", function(e) {
                e.preventDefault();
                const totalPages = updateTotalPages();
                if (currentPage < totalPages) {
                    currentPage++;
                    displayRows(currentPage);
                    setupPagination();
                }
            });

            // Ajouter cet écouteur d'événement pour le select
            $('#ligneParPage').on('change', function() {
                rowsPerPage = parseInt($(this).val());
                currentPage = 1; // Réinitialiser à la première page
                setupPagination();
                displayRows(currentPage);
            });

            // Fonction pour mettre à jour le compteur
            function updateSelectedCount() {
                const count = $('input[type="checkbox"]:checked').not('#CheckAll').length;
                $('#selectedCount').text(count);
            }

            // Écouteur d'événements pour tous les checkboxes
            $(document).on('change', 'input[type="checkbox"]', function() {
                updateSelectedCount();
            });

            // Modifier la fonction checkAll existante
            window.checkAll = function() {
                const isChecked = $('#CheckAll').prop('checked');
                $('input[type="checkbox"]').each(function() {
                    // Ne pas cocher les cases dont mail_send est différent de 0
                    if (!$(this).is(':disabled')) {
                        $(this).prop('checked', isChecked);
                    }
                });
                updateSelectedCount();
            }
        });

        // Envoie des mails
        $('#sendMail').on('click', function(e) {
            e.preventDefault();

            const phaseId = @json($phase_id);
            const dateTest = document.getElementById('dateTest');
            const heureTest = document.getElementById('heureTest');
            const objet = document.getElementById('objet');

            if (!dateTest.value || !heureTest.value || !objet.value) {
                $('#submitButton').click();
                return;
            }

            const selectedIntervenants = [];
            $('input[type="checkbox"]:checked').not('#CheckAll').each(function() {
                const index = $(this).attr('id').split('-')[1];
                if (filteredIntervenants[index]) {
                    selectedIntervenants.push(filteredIntervenants[
                        index]);
                }
            });

            const alertInterv = document.getElementById('alertInterv');
            if (selectedIntervenants.length < 1) {
                alertInterv.style.display = 'flex'
                setTimeout(function() {
                    let alerts = document.querySelectorAll('[role="alert"]');
                    alerts.forEach(function(alert) {
                        alert.style.transition = "opacity 0.5s ease";
                        alert.style.opacity = "0";
                        setTimeout(function() {
                            alert.remove();
                        }, 500);
                    });
                }, 5000);
                return;
            }

            const alertMail = document.getElementById("alertMail");
            fetch('/sendsmails', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    body: JSON.stringify({
                        intervenants: selectedIntervenants,
                        phase_id: phaseId,
                        dateTest: dateTest.value,
                        heureTest: heureTest.value,
                        objet: objet.value,
                        isVote: 0
                    })
                })
                .then(response => {


                    return response.json();
                })
                .then(data => {
                    alertMail.style.display = 'flex';
                    setTimeout(function() {
                        let alerts = document.querySelectorAll('[role="alert"]');
                        alerts.forEach(function(alert) {
                            alert.style.transition = "opacity 0.5s ease";
                            alert.style.opacity = "0";
                            setTimeout(function() {
                                alert.remove();
                            }, 500);
                        });
                    }, 5000);
                    $('input[type="checkbox"]').prop('checked', false); // Décocher toutes les cases
                    console.log('Réponse:', data);
                })
                .catch(error => {
                    console.error('Erreur:', error);

                });
        });
    </script>

</x-app-layout>
