<div id="create-modal-jury" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative overflow-x-auto sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800" style="width: 80%;">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Insertion des jurys</h3>
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="create-modal-jury">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form method="POST" action="" style="padding: 20px 0 20px 0">
            <div class=" mr-5" style="padding-left: 20px">
                @csrf
                <input type="hidden" name="phase" id="phaseId" value="">
                <label for="type" class="block mb-2  text-sm font-medium text-gray-900 dark:text-white">Type</label>
                <select id="type" name="type"
                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="prive">Privé</option>
                    <option value="public">Public</option>
                    <option value="prive et public" selected>Privé et Public</option>
                </select>

                <div id="priveDiv">
                    <label for="nombre_prive"
                        class="block mb-2 pt-5 text-sm font-medium text-gray-900 dark:text-white">Nombre des jurys
                        privé</label>
                    <input type="number" id="nombre_prive" name="nombre_prive"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pondération" value="1" required />
                    <label for="ponderation_prive"
                        class="block mb-2 pt-5 text-sm font-medium text-gray-900 dark:text-white">Pondération
                        privée</label>
                    <input type="number" id="ponderation_prive" name="ponderation_prive"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pondération" value="" required />
                </div>
                <div id="publicDiv">
                    <label for="ponderation_public"
                        class="block mb-2 pt-5 text-sm font-medium text-gray-900 dark:text-white">Pondération
                        publique</label>
                    <input type="number" id="ponderation_public" name="ponderation_public"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pondération" value="" required />
                </div>

                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">Valider</button>
            </div>
        </form>
    </div>
</div>

<script>
    const typeSelect = document.getElementById('type');
    const ponderationPrive = document.getElementById('priveDiv');
    const ponderationPublic = document.getElementById('publicDiv');

    const ponderationPriveInput = document.getElementById('ponderation_prive');
    const ponderationPublicInput = document.getElementById('ponderation_public');

    typeSelect.addEventListener('change', () => {
        const selectedType = typeSelect.value;
        if (selectedType === 'prive et public') {
            ponderationPrive.style.display = 'block';
            ponderationPublic.style.display = 'block';
        } else if (selectedType === 'prive') {
            ponderationPrive.style.display = 'block';
            ponderationPublic.style.display = 'none';
            ponderationPriveInput.required = true;
            ponderationPublicInput.required = false;
        } else if (selectedType === 'public'){
            ponderationPrive.style.display = 'none';
            ponderationPublic.style.display = 'block';
            ponderationPriveInput.required = false;
            ponderationPublicInput.required = true;
        }
    });
</script>
