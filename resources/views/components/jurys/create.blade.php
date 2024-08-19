<div id="create-modal-jury" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800"
        style="width: 90%;">
        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 id="insertH3" class="px-4 text-lg font-semibold text-gray-900 dark:text-white">
                Insertion de jury</h3>
            </h3>
            <h3 id="modifH3" class="px-4 text-lg font-semibold text-gray-900 dark:text-white" style="display: none;">
                Modification de jury</h3>
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
                <p id="titreType" class="flex justify-inline items-center text-2xl font-extrabold dark:text-white">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6">
                        <path fill-rule="evenodd"
                            d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z"
                            clip-rule="evenodd" />
                        <path fill-rule="evenodd"
                            d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375Zm9.586 4.594a.75.75 0 0 0-1.172-.938l-2.476 3.096-.908-.907a.75.75 0 0 0-1.06 1.06l1.5 1.5a.75.75 0 0 0 1.116-.062l3-3.75Z"
                            clip-rule="evenodd" />
                    </svg>
                </p>
                <div id="typeDiv">
                    <label for="type"
                        class="block mb-2  text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select id="type" name="type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="prive">Privé</option>
                        <option value="public">Public</option>
                        <option value="prive et public" selected>Privé et Public</option>
                    </select>
                </div>
                <div id="ajout" class="pt-5">
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="ajoutPrive" type="checkbox" value="" name="ajoutPrive"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ajoutPrive"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Ajouter un jury privé
                                    <h2 class="px-3 float-right"><strong id="getPondprive"></strong></h2>
                                </label>
                            </div>
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="ajoutPublic" type="checkbox" value="" name="ajoutPublic"
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="ajoutPublic"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">
                                    Ajouter un jury public
                                    <h2 class="px-3 float-right"><strong id="getPondpublic"></strong></h2>
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
                <div id="infoPublic" class="">

                    <p class="text-gray-500 dark:text-gray-400">Ici, un seul coupon public qui sera créé. <br> Veuillez cliquez sur le bouton pour générer le coupon</p>
                </div>
                <div id="priveDiv">
                    <div id="nombre_prive">
                        <label for="nombre_prive"
                            class="block mb-2 pt-3 text-sm font-medium text-gray-900 dark:text-white">Nombre des jurys
                            privé</label>
                        <input type="number" id="nombre_prive_input" name="nombre_prive"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Pondération" value="0" required />
                    </div>
                    <label id="label_prive" for="ponderation_prive"
                        class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white">Pondération
                        privée</label>
                    <label id="label_prive2" for="ponderation_prive"
                        class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white"
                        style="display: none">Pondération
                    </label>
                    <input type="number" id="ponderation_prive" name="ponderation_prive"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pondération" value="" required />
                </div>
                <div id="publicDiv">
                    <label id="label_public" for="ponderation_public"
                        class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white">Pondération
                        publique</label>
                    <label id="label_public2" for="ponderation_prive"
                        class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white"
                        style="display: none">Pondération
                    </label>
                    <input type="number" id="ponderation_public" name="ponderation_public"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Pondération" value="" required />
                </div>
                <div class="flex justify-between items-center mt-4 sm:mt-6">
                    <button id="valider" type="button" data-modal-target="checkValid"
                        onclick="validateForm(this)"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        Valider
                    </button>
                    <button id="edit" type="button" onclick="changer()"
                        class="ml-auto text-gray-900 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center dark:bg-gray-600 dark:focus:ring-gray-500 me-2 mb-2"
                        style="padding-top:10px; transition: all 1.0s ease-in-out;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6">
                            <path
                                d="M21.731 2.269a2.625 2.625 0 0 0-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 0 0 0-3.712ZM19.513 8.199l-3.712-3.712-8.4 8.4a5.25 5.25 0 0 0-1.32 2.214l-.8 2.685a.75.75 0 0 0 .933.933l2.685-.8a5.25 5.25 0 0 0 2.214-1.32l8.4-8.4Z" />
                            <path
                                d="M5.25 5.25a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3V13.5a.75.75 0 0 0-1.5 0v5.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5V8.25a1.5 1.5 0 0 1 1.5-1.5h5.25a.75.75 0 0 0 0-1.5H5.25Z" />
                        </svg>
                    </button>
                    <button id="annul" type="button" onclick="changer()"
                        class="ml-auto text-white bg-red-500 hover:bg-red-600 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm px-2.5 py-2.5 text-center inline-flex items-center dark:bg-red-600 dark:focus:ring-red-700 me-2 mb-2"
                        style="padding-top:10px; transition: all 1.0s ease-in-out; display: none;">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"
                            class="size-6">
                            <path fill-rule="evenodd"
                                d="M5.47 5.47a.75.75 0 0 1 1.06 0L12 10.94l5.47-5.47a.75.75 0 1 1 1.06 1.06L13.06 12l5.47 5.47a.75.75 0 1 1-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 0 1-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 0 1 0-1.06Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>

                <div id="checkValid" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-[300px] max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="checkValid">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                            <div class="p-4 md:p-5 text-center">
                                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200"
                                    aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                </svg>
                                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Veuillez
                                    selectionner au moins une case.</h3>
                                <button data-modal-hide="checkValid" type="button"
                                    class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    const ponderationPrive = document.getElementById('priveDiv');
    const ponderationPublic = document.getElementById('publicDiv');
    const typeDiv = document.getElementById('typeDiv');

    const typeSelect = document.getElementById('type');
    const ponderationPriveInput = document.getElementById('ponderation_prive');
    const labelPrive = document.getElementById('label_prive');
    const ponderationPublicInput = document.getElementById('ponderation_public');

    const checkValidModal = document.getElementById('checkValid');
    const submitButton = document.querySelector('button[type="submit"]');

    const numberPrive = document.getElementById('nombre_prive');
    const numberPriveInput = document.getElementById('nombre_prive_input');
    const ajoutPriveCheckbox = document.getElementById('ajoutPrive');
    const ajoutPublicCheckbox = document.getElementById('ajoutPublic')
    const ajoutDiv = document.getElementById('ajout');

    function validateForm(submitButton) {
        const ajoutPriveCheckbox = document.getElementById('ajoutPrive');
        const ajoutPublicCheckbox = document.getElementById('ajoutPublic');

        if (!ajoutPriveCheckbox.checked && !ajoutPublicCheckbox.checked) {

            checkValidModal.classList.remove('hidden');
            checkValidModal.classList.add('flex');

            submitButton.type = 'button';

            return false;
        }

        checkValidModal.classList.add('hidden')
        submitButton.type = 'submit';

        activer();
        return true;
    }

    function activer() {
        ponderationPriveInput.disabled = false;
        ponderationPublicInput.disabled = false;
        typeSelect.disabled = false;
    }

    typeSelect.addEventListener('change', () => {
        const selectedType = typeSelect.value;
        if (selectedType === 'prive et public') {
            ponderationPrive.style.display = 'block';
            ponderationPublic.style.display = 'block';

            //prive checked et public
            ponderationPrive.style.display = 'block';
            ponderationPriveInput.style.display = 'block';
            labelPrive.style.display = 'block';
            numberPrive.style.display = 'block';
            numberPriveInput.setAttribute('value', 1);

            ponderationPublic.style.display = 'block';
            ajoutPublicCheckbox.value = 1;

        } else if (selectedType === 'prive') {
            ponderationPrive.style.display = 'none';
            ponderationPublic.style.display = 'none';
            ponderationPriveInput.required = false;
            ponderationPriveInput.setAttribute('value',100);
            ponderationPublicInput.required = false;

            //prive checked,public no
            ponderationPrive.style.display = 'block';
            ponderationPriveInput.style.display = 'none';
            labelPrive.style.display = 'none';
            numberPrive.style.display = 'block';
            numberPriveInput.setAttribute('value', 1);

            ponderationPublic.style.display = 'none';
            ajoutPublicCheckbox.value = 0;

        } else if (selectedType === 'public') {
            ponderationPrive.style.display = 'none';
            ponderationPublic.style.display = 'none';
            ponderationPriveInput.required = false;
            ponderationPublicInput.required = false;
            ponderationPublicInput.setAttribute('value',100);

            //public checked,prive no
            ponderationPublic.style.display = 'none';
            ajoutPublicCheckbox.value = 1;

            ponderationPrive.style.display = 'none';
            numberPrive.style.display = 'none';
            numberPriveInput.setAttribute('value', 0);
        }
    });

    ajoutPriveCheckbox.addEventListener('change', () => {
        if (ajoutPriveCheckbox.checked) {
            ponderationPrive.style.display = 'block';
            ponderationPriveInput.style.display = 'none';
            labelPrive.style.display = 'none';
            numberPrive.style.display = 'block';
            numberPriveInput.setAttribute('value', 1);
        } else {
            ponderationPrive.style.display = 'none';
            numberPrive.style.display = 'none';
            numberPriveInput.setAttribute('value', 0);
        }
    });

    ajoutPublicCheckbox.addEventListener('change', () => {
        if (ajoutPublicCheckbox.checked) {
            ponderationPublic.style.display = 'none';
            ajoutPublicCheckbox.value = 1;
        } else {
            ponderationPublic.style.display = 'none';
            ajoutPublicCheckbox.value = 0;
        }
    });

    let originPondPublic
    let originPondPrive

    function changer() {
        const buttonEdit = document.getElementById('edit');
        const buttonAnnul = document.getElementById('annul');

        const insertH3 = document.getElementById('insertH3');
        const modifH3 = document.getElementById('modifH3');

        if (buttonEdit.style.display === 'none') {
            buttonEdit.style.display = 'inline-flex';
            buttonAnnul.style.display = 'none';
            insertH3.style.display = 'flex';
            modifH3.style.display = 'none';

            const selectedType = typeSelect.value;
            if (selectedType === 'prive') {
                ponderationPrive.style.display = 'block';
                numberPrive.style.display = 'block';
                ajoutPriveCheckbox.checked = true;
                numberPriveInput.setAttribute('value', 1);
                ponderationPriveInput.disabled = true;
                ponderationPublicInput.disabled = true;
                ponderationPriveInput.value = originPondPrive;

            } else if (selectedType === 'public') {
                ponderationPublic.style.display = 'block';
                ajoutPriveCheckbox.checked = true;
                numberPriveInput.setAttribute('value', 0);
                ajoutPublicCheckbox.value = 1;
                ponderationPriveInput.disabled = true;
                ponderationPublicInput.disabled = true;
                ponderationPublicInput.value = originPondPublic;
            } else {
                ponderationPrive.style.display = 'none';
                ponderationPublic.style.display = 'none';
                ajoutDiv.style.display = 'block';
                ajoutPriveCheckbox.checked = false;

                ponderationPriveInput.disabled = true;
                ponderationPublicInput.disabled = true;

                ponderationPriveInput.value = originPondPrive;
                ponderationPublicInput.value = originPondPublic;
            }

        } else {
            buttonEdit.style.display = 'none';
            buttonAnnul.style.display = 'inline-flex';
            insertH3.style.display = 'none';
            modifH3.style.display = 'flex';

            const selectedType = typeSelect.value;
            if (selectedType === 'prive') {

                originPondPrive = ponderationPriveInput.value;
                ponderationPrive.style.display = 'block';
                numberPrive.style.display = 'none';
                ajoutPriveCheckbox.checked = true;
                numberPriveInput.setAttribute('value', 0);
                ajoutPublicCheckbox.value = 0;
                ponderationPriveInput.disabled = false;
                ponderationPublicInput.disabled = false;
            } else if (selectedType === 'public') {

                originPondPublic = ponderationPublicInput.value;
                ponderationPublic.style.display = 'block';
                ajoutPriveCheckbox.checked = true;
                numberPriveInput.setAttribute('value', 0);
                ajoutPublicCheckbox.value = 0;
                ponderationPriveInput.disabled = false;
                ponderationPublicInput.disabled = false;
            } else {

                originPondPrive = ponderationPriveInput.value;
                originPondPublic = ponderationPublicInput.value;

                ponderationPrive.style.display = 'block';
                ponderationPublic.style.display = 'block';
                ajoutDiv.style.display = 'none';
                numberPrive.style.display = 'none';
                ajoutPriveCheckbox.checked = true;
                numberPriveInput.setAttribute('value', 0);
                ajoutPublicCheckbox.value = 0;
                ponderationPriveInput.disabled = false;
                ponderationPublicInput.disabled = false;
            }
        }
    }
</script>
