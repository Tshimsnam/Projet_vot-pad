<div id="create-modal-interv" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800 overflow-auto"
        style="-webkit-scrollbar: none; -ms-overflow-style: none; scrollbar-width: none;" style="width: 90%;">
        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 id="insertH3" class="px-4 text-lg font-semibold text-gray-900 dark:text-white">
                Ajouter des candidats</h3>
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="create-modal-interv">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" autocomplete="off"
            style="padding: 20px 0 20px 0">
            <div class=" mr-5" style="padding-left: 20px">
                @csrf
                <input type="hidden" name="phase" id="phaseId" value="">
                <input type="hidden" name="isVote" id="isVote" value="">
                <div id="ajout" class="mb-3">
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="importer" type="radio" value="" name="choixAjout"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="importer"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Importer
                                    des candidats
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="manuel" type="radio" value="" name="choixAjout"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="manuel"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ajouter
                                    un candidat
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="divManuel" style="display: none">
                    <div id="nameDiv">
                        <label id="nameLabel" for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nom du candidat" value="" required />
                    </div>
                    <div id="emailDiv">
                        <label id="emailLabel" for="email"
                            class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="email" name="email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Email du candidat" value="" required />
                    </div>
                    <div id="">
                        <label id="telephoneLabel" for="telephone"
                            class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                        <input type="text" id="telephone" name="telephone"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Numéro de téléphone" value="" />
                    </div>
                    <div id="">
                        <label id="genreLabel" for="genre"
                            class="block mb-2 pt-2  text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                        <select id="genre" name="genre"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="M" selected>Masculin</option>
                            <option value="F">Féminin</option>
                        </select>
                    </div>
                    <div>
                        <label class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white"
                            for="file_input">Image</label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="file_input_help" id="image" name="image" type="file">
                        <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG.</p>
                    </div>
                    <div class="flex justify-between items-center mt-4 sm:mt-6">
                        <button id="valider" type="submit"
                            class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                            Valider
                        </button>
                    </div>
                </div>
                <div id="divImporter" style="display: none">
                    <p class="flex items-center pl-1 mb-2 text-xl font-medium text-gray-900 dark:text-white">
                        Sélectionnez un fichier CSV
                        (.csv) <button data-popover-target="popover-intervenant" data-popover-placement="right"
                            type="button"><svg class="w-4 h-4 ms-2 text-gray-400 hover:text-gray-500"
                                aria-hidden="true" fill="currentColor" viewBox="0 0 20 20"
                                xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd"
                                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                    clip-rule="evenodd"></path>
                            </svg><span class="sr-only">Show information</span></button></p>
                    <div data-popover id="popover-intervenant" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 dark:text-white">Details du fichier et du format
                            </h3>
                            <p>Pour importer des candidats, veuillez télécharger le fichier ci-dessous et l'enregistrer
                                au format CSV UTF-8. le fichier doit avoir l'extenseion .csv <br>Veuillez
                                cliquer <a href="{{ route('candidat_format') }}"
                                    class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline"><strong>ici</strong></a>
                                pour télécharger</p>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                    <input
                        class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="file_input" type="file" name="fichier" required>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">Importer</button>
                </div>
            </div>
        </form>
    </div>
    <script>
        const divManuel = document.getElementById('divManuel');
        const divImporter = document.getElementById('divImporter');
        const importerCheckbox = document.getElementById('importer');
        const manuelcCheckbox = document.getElementById('manuel');
        const isVote = document.getElementById('isVote');

        const email = document.getElementById('email');
        const noms = document.getElementById('name');
        const fichier = document.getElementById('file_input');

        importerCheckbox.addEventListener('change', () => {
            if (importerCheckbox.checked) {
                divManuel.style.display = 'none';
                divImporter.style.display = 'block';
                email.required = false;
                noms.required = false;
                fichier.required = true;
                isVote.value = 0;
            } else {
                divImporter.style.display = 'none';
                isVote.value = "";
            }
        });

        manuelcCheckbox.addEventListener('change', () => {
            if (manuelcCheckbox.checked) {
                divImporter.style.display = 'none';
                divManuel.style.display = 'block';
                email.required = true;
                noms.required = true;
                fichier.required = false;
                isVote.value = 1;
            } else {
                divManuel.style.display = 'none';
                isVote.value = "";
            }
        });
    </script>
</div>
