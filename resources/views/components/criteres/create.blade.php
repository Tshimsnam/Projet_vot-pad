<div id="create-modal" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative overflow-x-auto sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800" style="width: 80%;">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Création d'un critère</h3>
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="create-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>

        <form class="" action="{{ route('criteres.store') }}" autocomplete="off" method="post"
            style="padding-top:10px">

            @csrf
            <div class=" mr-5" style="padding-left: 20px">
                <div class="mb-5">
                    <input id="phase" type="hidden" name="phase" value="" />
                    <input id="totalPond" type="hidden" name="totalPond" value="" />
                    <h3 id="titrePond" class="text-lg font-semibold text-gray-900 dark:text-white mb-3">
                    </h3>

                    <label for="libelle"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Critère</label>
                    <input type="text" id="libelle" name="libelle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Libellé du critère" required />
                </div>
                <div class="mb-5">
                    <label for="description"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                    <textarea type="text" id="description" name="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="La description du critère" style="height: 70px;"></textarea>
                </div>
                <div class="mb-5">
                    <label for="ponderation"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pondération</label>
                    <input type="number" id="ponderation" name="ponderation"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pondération" required />
                </div>
                <div class="mb-5 hidden">
                    <label for="echelle"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Echelle</label>
                    <select id="echelle" name="echelle"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>3</option>
                        <option selected>5</option>
                    </select>
                </div>
                <div class="mb-5">
                    <button type="submit"
                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        Valider
                    </button>
                </div>

            </div>

        </form>
        <div>

            <button data-modal-target="total-modal" data-modal-toggle="total-modal"
                class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 hidden"
                type="button">
                total modal
            </button>

            <div id="total-modal" tabindex="-1"
                class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                        <button type="button"
                            class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                            data-modal-hide="total-modal" onclick="fermerModal()">
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 14 14">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                            </svg>
                            <span class="sr-only">Close modal</span>
                        </button>
                        <div class="p-4 md:p-5 text-center">
                            <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">La pondération de
                                tous les critères ne doit pas dépasser 100</h3>
                            <button data-modal-hide="total-modal" type="button"
                                class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700"
                                onclick="fermerModal()">OK</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script>
        const inputPonderation = document.getElementById('ponderation');
        const sommePonderation = document.getElementById('totalPond');
        const modalTotal = document.getElementById('total-modal');

        function verifierPonderation() {
            const valeurInput = parseFloat(inputPonderation.value) || 0;
            const valeurSomme = parseFloat(sommePonderation.value) || 0;

            const total = valeurInput + valeurSomme;

            if (total > 100) {
                afficherModal();
                inputPonderation.value = "";
            }
        }

        function afficherModal() {
            modalTotal.classList.remove('hidden');
            modalTotal.classList.add('flex');
        }


        function fermerModal() {
            modalTotal.classList.add('hidden');
        }

        inputPonderation.addEventListener('change', verifierPonderation);
    </script>
</div>
