<x-app-layout>
    <x-slot name="header">
        <div class="">
            <h2 class="text-2xl font-extrabold dark:text-white">{{ $evenement->nom }}</h2>
            <h2 class="font-semibold text-sx text-gray-500 dark:text-gray-400  ">
                {{ __('Ajouter une phase') }}
            </h2>
        </div>

    </x-slot>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="py-4">
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
            <form action="{{ route('phases.store') }}" autocomplete="off" method="post">
                @csrf
                @method('post')
                <div class="relative z-0 w-full mb-5 group">
                    <input type="hidden" name="evenement_id" value="{{ $evenement->id }}">
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
                            <label for="datedebut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Date début
                            </label>
                            <div class="relative " style="padding-right: 20px;">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none"> <svg
                                        class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
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
                                    min="00:00" max="24:00" value="01:00" />
                            </div>
                        </div>
                    </div>
                </div>
                <button type="submit"
                    class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                    Valider
                </button>
            </form>
        </div>

        <button data-modal-target="checkdate-modal" data-modal-toggle="checkdate-modal"
            class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
            type="button" style="display: none">
            Toggle modal
        </button>
    </div>
    <x-checkdate />

    <script>
        window.onload = function() {
            autoCreate({{ $evenement->auto_create }}, '{{ $evenement->type }}')
        };

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
    </script>
</x-app-layout>
