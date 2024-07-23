<div id="print-modal" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800"
        style="width: 90%;">
        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 id="insertH3" class="px-4 text-lg font-semibold text-gray-900 dark:text-white">
                Impression des qrcodes</h3>
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="print-modal">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <div style="padding: 20px 0 20px 0">
            <form class=" mr-5" style="padding-left: 20px">
                @csrf
                <div id="ajout" class="pt-5">
                    <ul
                        class="items-center w-full text-sm font-medium text-gray-900 bg-white border border-gray-200 rounded-lg dark:bg-gray-700 dark:border-gray-600 dark:text-white">
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="printPrive" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="printPrive"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Impression
                                    qrcode privé
                                </label>
                            </div>
                            <input type="hidden" id="numPrive" name="numPrive"
                                class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Entrez le nombre des qrcodes à imprimer" value="" required />
                        </li>
                        <li class="w-full border-b border-gray-200 sm:border-b-0 sm:border-r dark:border-gray-600">
                            <div class="flex items-center ps-3">
                                <input id="printPublic" type="checkbox" value=""
                                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-700 dark:focus:ring-offset-gray-700 focus:ring-2 dark:bg-gray-600 dark:border-gray-500">
                                <label for="printPublic"
                                    class="w-full py-3 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Impression
                                    qrcode public
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>

                <div id="numberDiv" style="">
                    <label id="nombreLabel" for="nombrePublic"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nombre QrCodes</label>
                    <input type="number" id="nombrePublic" name="nombrePublic"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Entrez le nombre des qrcodes à imprimer" value="" required />

                    <input type="hidden" id="idPhase" name="idPhase"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" value="" required />

                    <input type="hidden" id="typeVote" name="typeVote"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" value="" required />

                </div>
                <div id="infoPrive" class="text-center">
                    <svg class="mx-auto mb-4 text-gray-400 w-10 h-10 dark:text-gray-200" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                    <p class="text-gray-500 dark:text-gray-400">Seuls les coupons non utilisées seront imprimés. <br> Veuillez cliquez sur le bouton pour lancer l'impression</p>
                </div>
                <div class="flex justify-between items-center mt-4 sm:mt-6">

                    <button id="validPrint" type="button" data-modal-target="checkSelect" onclick="validatePrint(this)"
                        class="inline-flex items-center px-5 py-2.5 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        Valider
                    </button>
                </div>

                <div id="checkSelect" tabindex="-1"
                    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-[300px] max-h-full">
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <button type="button"
                                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                data-modal-hide="checkSelect">
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
                                <button data-modal-hide="checkSelect" type="button"
                                    class="text-white bg-gray-600 hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:focus:ring-gray-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">OK</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script>
        const nombreInp = document.getElementById('nombrePublic');
        const numPrive = document.getElementById('numPrive');
        const printPriveCheckbox = document.getElementById('printPrive');
        const printPublicCheckbox = document.getElementById('printPublic');

        const validPrint = document.getElementById('validPrint');
        const checkSelect = document.getElementById('checkSelect');

        function validatePrint(validPrint) {
            const printPriveCheckbox = document.getElementById('printPrive');
            const printPublicCheckbox = document.getElementById('printPublic');

            if (!printPriveCheckbox.checked && !printPublicCheckbox.checked) {

                checkSelect.classList.remove('hidden');
                checkSelect.classList.add('flex');

                validPrint.type = 'button';

                return false;
            }

            checkSelect.classList.add('hidden')
            validPrint.type = 'button';

            printPage();
            return true;
        }


        function printPage() {
            const phaseId = document.getElementById('idPhase').value;
            const numPriveValue = numPrive.value;
            const printData = [phaseId, numPriveValue]
            const nombreInpValue = nombreInp.value;
            var url = '{{ route('qrcodes', ['jurys' => ':phaseId', 'nombre' => ':nombre']) }}';
            url = url.replace(':phaseId', printData);
            url = url.replace(':nombre', nombreInpValue);
            fetch(url)
                .then(response => response.text())
                .then(html => {
                    var iframe = document.createElement('iframe');
                    iframe.srcdoc = html;
                    iframe.style.display = 'none';
                    document.body.appendChild(iframe);

                    setTimeout(() => {
                        iframe.contentWindow.print();
                        document.body.removeChild(iframe);
                        window.location.reload(); // Rafraîchir la page
                    }, 1000);
                })
                .catch(error => {
                    console.error('Erreur lors de la récupération du contenu :', error);
                });
        }
        const numberDiv = document.getElementById('numberDiv');

        printPriveCheckbox.addEventListener('change', () => {
            if (printPriveCheckbox.checked) {
                numPrive.setAttribute('value', 1)
            } else {
                numPrive.setAttribute('value', 0)
            }
        });

        printPublicCheckbox.addEventListener('change', () => {
            if (printPublicCheckbox.checked) {
                numberDiv.style.display = 'block';
                nombreInp.setAttribute('value', 1)
            } else {
                numberDiv.style.display = 'none';
                nombreInp.setAttribute('value', 0)
            }
        });
    </script>
</div>
