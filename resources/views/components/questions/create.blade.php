<div id="create-modal-question" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative overflow-x-auto sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800" style="width: 80%;">
        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                Insertion des questions</h3>
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="create-modal-question">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form method="POST" id="formInsertQuestion" action="" enctype="multipart/form-data"
            style="padding: 20px 0 20px 0">
            <div id="ajout" class="m-5">
                <ul
                    class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="importerCheck" type="radio" value="" name="choice"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="importerCheck"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Importer
                                des questions
                            </label>
                        </div>
                    </li>
                    <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                        <div class="flex items-center ps-3">
                            <input id="manuelCheck" type="radio" name="choice"
                                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                            <label for="manuelCheck"
                                class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Ajouter
                                une question et cochez la bonne réponse
                            </label>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="mr-5 " style="padding-left: 20px; display: none;" id="divImporterQuestion">
                @csrf
                <input type="text" name="phase" id="phaseId" class="hidden">
                <p class="flex items-center pl-1 mb-2 text-xl font-medium text-gray-900 dark:text-white">Sélectionnez un
                    fichier CSV
                    (.csv) <button data-popover-target="popover-question" data-popover-placement="right"
                        type="button"><svg class="w-5 h-5 ms-2 text-gray-400 hover:text-gray-500" aria-hidden="true"
                            fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-8-3a1 1 0 00-.867.5 1 1 0 11-1.731-1A3 3 0 0113 8a3.001 3.001 0 01-2 2.83V11a1 1 0 11-2 0v-1a1 1 0 011-1 1 1 0 100-2zm0 8a1 1 0 100-2 1 1 0 000 2z"
                                clip-rule="evenodd"></path>
                        </svg><span class="sr-only">Show information</span></button></p>
                <div data-popover id="popover-question" role="tooltip"
                    class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                    <div class="p-3 space-y-2">
                        <h3 class="font-semibold text-gray-900 dark:text-white">Details du fichier </h3>
                        <p>Pour importer des questions, veuillez télécharger ce modèle <br>Veuillez
                            cliquer <a href="{{ route('question_format') }}"
                                class="font-medium text-blue-600 underline dark:text-blue-500 hover:no-underline"><strong class="text-xl"> ici</strong></a>
                            pour télécharger</p>
                    </div>
                    <div data-popper-arrow></div>
                </div>

                <input
                    class="block w-full text-xs text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                    aria-describedby="file_input_help" id="fichierInput" type="file" name="fichier"
                    accept=".csv, .xlsx">
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">Importer</button>
            </div>
            <div id="divManuelQuestion" style="display: none" class="m-5 mr-5" style="padding-left: 20px; margin:5px">

                <div class="mb-5">
                    <label for="questionInput"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Question</label>
                    <textarea id="questionInput" rows="5"
                        class="dynamic-input block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Editer la question" name="question"></textarea>
                </div>
                <div id="" class="mb-5">
                    <label i for="ponderationQuestion"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pondération</label>
                    <input type="number" id="ponderationQuestion" name="ponderation" max="99" min="0"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="0" />
                </div>

                <div id="dynamicForm" class="mb-5">
                    <div class="input-container mb-5">
                        <label for="assertionInput1"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Assertion 1
                            <input type="radio" name="bonneReponse" value="1"
                                class="w-4 h-4 ml-5 text-green-600 bg-gray-100 border-gray-300 rounded-full focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                        </label>
                        <textarea id="assertionInput1" rows="4"
                            class="dynamic-input block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Editer l'assertion" name="assertions[1]"></textarea>
                    </div>
                </div>

                <div class="flex justify-between items-center mt-4 sm:mt-6">
                    <button id="valider" type="submit"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        Valider
                    </button>
                </div>
            </div>
        </form>

    </div>
</div>
<script>
    const formInsertQuestion = document.getElementById('formInsertQuestion');
    const divManuelQuestion = document.getElementById('divManuelQuestion');
    const divImporterQuestion = document.getElementById('divImporterQuestion');
    const importerCheckboxQuestion = document.getElementById('importerCheck');
    const manuelcCheckboxQuestion = document.getElementById('manuelCheck');
    const questionInput = document.getElementById('questionInput');
    const fichierInput = document.getElementById('fichierInput');
    const ponderationQuestion = document.getElementById('ponderationQuestion');
    const assertion1 = document.getElementById('assertionInput1');

    const actionImport = @json(route('importQuestion'));
    const actionManuel = @json(route('questions.store'));

    const formInput = {};

    importerCheckboxQuestion.addEventListener('change', () => {
        if (importerCheckboxQuestion.checked) {

            divManuelQuestion.style.display = 'none';
            divImporterQuestion.style.display = 'block';
            formInsertQuestion.action = actionImport
            fichierInput.required = true;
            questionInput.required = false
            ponderationQuestion.required = false
            assertion1.required = false

            // console.log(formInput)
            // console.log(actionImport)
        }
    });

    manuelcCheckboxQuestion.addEventListener('change', () => {
        if (manuelcCheckboxQuestion.checked) {
            divImporterQuestion.style.display = 'none';
            divManuelQuestion.style.display = 'block';
            formInsertQuestion.action = actionManuel

            fichierInput.required = false;
            ponderationQuestion.required = true
            questionInput.required = true
            assertion1.required = true

            // console.log(formInput)
            // console.log(actionManuel)
        }
    });


    const form = document.getElementById('dynamicForm');

    form.addEventListener('input', function(event) {
        const inputs = document.querySelectorAll('.dynamic-input');
        const lastInput = inputs[inputs.length - 1];
        const num = inputs.length;


        if (lastInput.value !== '') {

            const newInputContainer = document.createElement('div');
            newInputContainer.className = "mb-5";
            newInputContainer.classList.add('input-container');

            const newInput = document.createElement('textarea');
            newInput.className =
                "block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
            newInput.classList.add('dynamic-input');
            newInput.placeholder = 'Saisir l"assertion ';
            newInput.name = `assertions[${num}]`
            newInput.rows = "4"

            const labelAssertion = document.createElement('label');
            labelAssertion.className = "block mb-2 text-sm font-medium text-gray-900 dark:text-white";
            labelAssertion.textContent = `Assertion ${num}`
            const radioReponse = document.createElement('input');
            radioReponse.type = 'radio';
            radioReponse.className =
                "w-4 h-4 ml-5 text-green-600 bg-gray-100 border-gray-300 rounded-full focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500";
            radioReponse.value = `${num}`;
            radioReponse.name = "bonneReponse";

            labelAssertion.appendChild(radioReponse);
            newInputContainer.appendChild(labelAssertion);
            newInputContainer.appendChild(newInput);
            form.appendChild(newInputContainer);
        }
    });
</script>
