<x-app-layout>
    <form action="{{ route('creationStep') }}" autocomplete="off" method="post">
        @csrf
        <div id="step-event">
            <div class="mt-6">
                <ol
                    class="flex items-center w-full p-3 space-x-4 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            1
                        </span>
                        Création de l'événement
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>
                    <li class="flex items-center">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                            2
                        </span>
                        Création de la phase
                    </li>
                </ol>

            </div>
            <div class="relative overflow-x-auto sm:rounded-lg" style="padding-top: 30px;">

                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="name"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Evénement</label>
                        <input type="text" id="name" name="name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Nom événement" required />
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Description</label>
                        <textarea type="text" id="description" name="description_event"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="La description de l'événement" required style="height: 132px;"></textarea>
                    </div>
                    <div>
                        <label for="type"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                        <select id="type_event" name="type_event"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option>Compétition</option>
                            <option>Evaluation</option>
                        </select>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40 hidden">
                    Suivant
                </button>

                <button type="button" onclick="step('phase')"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                    Suivant
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-5">
                        <path fill-rule="evenodd"
                            d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
            </div>
        </div>

        <div id="step-phase" style="display: none">
            <div class="mt-6">
                <ol
                    class="flex items-center w-full p-3 space-x-4 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse">
                    <li class="flex items-center text-gray-800 dark:text-gray-100">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs text-blue-600 dark:text-blue-500 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                class="size-5">
                                <path fill-rule="evenodd"
                                    d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                    clip-rule="evenodd" />
                            </svg>
                        </span>
                        Création de l'événement
                        <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                        </svg>
                    </li>
                    <li class="flex items-center text-blue-600 dark:text-blue-500">
                        <span
                            class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                            2
                        </span>
                        Création de la phase
                    </li>
                </ol>


            </div>
            <div class="relative overflow-x-auto sm:rounded-lg" style="padding-top: 30px;">
                <div class="relative z-0 w-full mb-5 group">
                    <input type="hidden" name="evenement_id" value="">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phase</label>
                    <input type="text" name="nom" id="floating_email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nom de la phase" required />

                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description
                    </label>
                    <textarea id="message" name="description" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="La description de la phase" required style="height: 132px;"></textarea>
                </div>
                <div id="divSelect" class="relative z-0 w-full mb-5 group" style="padding-top: 20px">
                    <label for="type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select id="type" name="type" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Evaluation">Evaluation</option>
                        <option value="Vote">Vote</option>
                    </select>
                </div>
                <div class="w-full mt-5">
                    <div style="display: flex; align-items: center;">
                        <div>
                            <label for="datedebut"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Date début
                            </label>
                            <div class="relative " style="padding-right: 20px;">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="dateDebut" datepicker datepicker-autohide datepicker-orientation="top"
                                    datepicker-format="dd/mm/yyyy" type="text"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" autocomplete="off" name="date_debut" required
                                    value="">
                            </div>
                        </div>
                        <div>
                            <label for="datefin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Date
                                fin</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="dateFin" datepicker datepicker-autohide datepicker-orientation="top"
                                    datepicker-format="dd/mm/yyyy" type="text" name="date_fin"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" autocomplete="off">
                            </div>
                        </div>
                        <div class=" duree px-6">
                            <label for="duree"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Durée
                            </label>
                            <div class="relative">
                                <div
                                    class="absolute inset-y-0 end-0 top-0 flex items-center pe-3.5 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                                        <path fill-rule="evenodd"
                                            d="M2 12C2 6.477 6.477 2 12 2s10 4.477 10 10-4.477 10-10 10S2 17.523 2 12Zm11-4a1 1 0 1 0-2 0v4a1 1 0 0 0 .293.707l3 3a1 1 0 0 0 1.414-1.414L13 11.586V8Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="time" id="duree" name="duree"
                                    class="bg-gray-50 border leading-none border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    min="00:00" max="24:00" value="01:00"/>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between">
                    <button type="button" onclick="step('event')"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5">
                            <path fill-rule="evenodd"
                                d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                clip-rule="evenodd" />
                        </svg>

                        Précedent
                    </button>
                    <button type="submit"
                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        Valider
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                            class="size-5">
                            <path fill-rule="evenodd"
                                d="M16.704 4.153a.75.75 0 0 1 .143 1.052l-8 10.5a.75.75 0 0 1-1.127.075l-4.5-4.5a.75.75 0 0 1 1.06-1.06l3.894 3.893 7.48-9.817a.75.75 0 0 1 1.05-.143Z"
                                clip-rule="evenodd" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </form>
    <button data-modal-target="checkdate-modal" data-modal-toggle="checkdate-modal"
        class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
        type="button" style="display: none">
        Toggle modal
    </button>
    <x-checkdate />

    <script>
        panelEvent = document.getElementById('step-event');
        panelPhase = document.getElementById('step-phase');

        document.addEventListener('DOMContentLoaded', function() {
            panelEvent.style.display = 'block';
            panelPhase.style.display = 'none';
        });

        panelEvent.style.transition = 'opacity 0.5s ease';
        panelPhase.style.transition = 'opacity 0.5s ease';

        function step(action) {
            if (action == 'phase') {
                panelEvent.style.opacity = '0';
                setTimeout(() => {
                    panelEvent.style.display = 'none';
                    panelPhase.style.display = 'block';
                    requestAnimationFrame(() => {
                        panelPhase.style.opacity = '1';
                    });
                }, 500);

                const type_event = document.getElementById('type_event');
                const selectType = type_event.value;
                autoCreate(1, selectType);

            } else if (action == 'event') {
                panelPhase.style.opacity = '0';
                setTimeout(() => {
                    panelPhase.style.display = 'none';
                    panelEvent.style.display = 'block';
                    requestAnimationFrame(() => {
                        panelEvent.style.opacity = '1';
                    });
                }, 500);
            }
        }

        const typeSelect = document.getElementById('type');
        const dureeDiv = document.querySelector('.duree');
        typeSelect.addEventListener('change', function() {
            const selectedValue = this.value;
            if (selectedValue === 'Vote') {
                dureeDiv.style.display = 'none';
                const duree = document.querySelector('#duree').required = false;
                duree.setAttribute('value', 'null');
            } else {
                dureeDiv.style.display = 'block';
            }
        });


        function autoCreate(eventCreate, eventType) {
            const divSelect = document.getElementById('divSelect');
            if (eventCreate == 1) {
                if (eventType === 'Compétition') {
                    dureeDiv.style.display = 'none';
                    duree.setAttribute('value', 'null');
                    divSelect.style.display = 'none';
                    typeSelect.value = 'Vote';
                } else {
                    dureeDiv.style.display = 'block';
                    typeSelect.value = 'Evaluation';
                    divSelect.style.display = 'none';
                }
            } else {

            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const dateDebutInput = document.getElementById('dateDebut');
            const dateFinInput = document.getElementById('dateFin');

            function parseDate(dateString) {
                const [day, month, year] = dateString.split('/').map(Number);
                return new Date(year, month - 1, day);
            }

            dateDebutInput.addEventListener('blur', function() {
                const dateDebut = this.value;
                const dateDebutDate = parseDate(dateDebut);
                const currentDate = new Date();

                if (dateDebutDate.setHours(0, 0, 0, 0) < currentDate.setHours(0, 0, 0, 0)) {
                    console.log('La date de début est antérieure à la date actuelle.');

                    const checkdate = document.getElementById('checkdate-modal');
                    const message = document.querySelector('#checkdate-modal #message');
                    message.textContent = 'La date de début doit être supérieure à la date actuelle.';
                    checkdate.classList.remove('hidden');
                    checkdate.classList.add('flex');
                    this.value = '';
                }
            });

            dateFinInput.addEventListener('blur', function() {
                const dateFin = this.value;
                const dateDebut = dateDebutInput.value;

                const dateFinDate = parseDate(dateFin);
                const dateDebutDate = parseDate(dateDebut);

                if (dateFinDate.setHours(0, 0, 0, 0) < dateDebutDate.setHours(0, 0, 0, 0)) {
                    console.log('La date de fin est antérieure à la date de début.');

                    const checkdate = document.getElementById('checkdate-modal');
                    const message = document.querySelector('#checkdate-modal #message');
                    message.textContent = 'La date de fin ne doit pas être inférieure à la date de début.';
                    checkdate.classList.remove('hidden');
                    checkdate.classList.add('flex');
                    this.value = '';
                }
            });
        });


        // document.addEventListener('DOMContentLoaded', function() {
        //     const dateDebutInput = document.getElementById('dateDebut');
        //     const dateFinInput = document.getElementById('dateFin');

        //     dateDebutInput.addEventListener('blur', function() {
        //         const dateDebut = this.value;

        //         const currentDate = new Date();
        //         const currentMonth = String(currentDate.getMonth() + 1).padStart(2, '0');
        //         const currentDay = String(currentDate.getDate()).padStart(2, '0');
        //         const currentYear = currentDate.getFullYear();
        //         const currentFormattedDate = `${currentMonth}/${currentDay}/${currentYear}`;

        //         const dateDebutDate = new Date(dateDebut);
        //         const currentDateDate = new Date(currentFormattedDate);

        //         if (dateDebutDate < currentDateDate) {
        //             console.log('La date de début est antérieure à la date actuelle.');

        //             // Afficher le modal
        //             const checkdate = document.getElementById('checkdate-modal');
        //             const message = document.querySelector('#checkdate-modal #message');
        //             message.textContent = 'La date de début doit être supérieur à la date actuelle.';
        //             checkdate.classList.remove('hidden');
        //             checkdate.classList.add('flex');
        //             this.value = '';
        //         }
        //     });

        //     dateFinInput.addEventListener('blur', function() {
        //         const dateFin = this.value;
        //         const dateDebut = dateDebutInput.value;

        //         const dateFinDate = new Date(dateFin);
        //         const currentDateDate = new Date(dateDebut);

        //         if (dateFinDate < currentDateDate ) {
        //             console.log('La date du début est antérieure à la date actuelle.');

        //             const checkdate = document.getElementById('checkdate-modal');
        //             const message = document.querySelector('#checkdate-modal #message');
        //             message.textContent = 'La date de fin ne doit pas être inférieur à la date de début.';
        //             checkdate.classList.remove('hidden');
        //             checkdate.classList.add('flex');
        //             this.value = '';
        //         }else if(dateDebut == ''){
        //             const checkdate = document.getElementById('checkdate-modal');
        //             const message = document.querySelector('#checkdate-modal #message');
        //             message.textContent = "Veuillez selectionner d'abord la date de début";
        //             checkdate.classList.remove('hidden');
        //             checkdate.classList.add('flex');
        //             this.value = '';
        //         }
        //     });
        // });
    </script>

</x-app-layout>
