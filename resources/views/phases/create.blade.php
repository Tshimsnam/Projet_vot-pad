<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('Ajouter une phase') }}
            </h2>
        </div>

    </x-slot>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="py-4">
            <form action="{{ route('phases.store') }}" method="post">
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
                <div class="relative z-0 w-full mb-5 group">
                    <label for="type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select id="type" name="type" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="Evaluation">Evaluation</option>
                        <option value="Vote">Vote</option>
                    </select>
                </div>
                <div class="w-full">
                    <div style="display: flex; align-items: center;">
                        <div>
                            <label for="datedebut" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                Date du début
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
                                    type="text" name="datedebut"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" autocomplete="off" required>
                            </div>
                        </div>
                        <div>
                            <label for="datefin"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Dâte
                                Fin</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                    <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                                        xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path
                                            d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                    </svg>
                                </div>
                                <input id="dateFin" datepicker datepicker-autohide datepicker-orientation="top"
                                    type="text" name="datefin"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" autocomplete="off">
                            </div>
                        </div>
                        <div class=" duree px-6">
                            <label for="duree" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
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
                                    min="00:00" max="24:00" value="00:00" required />
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

        document.addEventListener('DOMContentLoaded', function() {
            const dateDebutInput = document.getElementById('dateDebut');
            const dateFinInput = document.getElementById('dateFin');

            dateDebutInput.addEventListener('blur', function() {
                const dateDebut = this.value;

                const currentDate = new Date();
                const currentMonth = String(currentDate.getMonth() + 1).padStart(2, '0');
                const currentDay = String(currentDate.getDate()).padStart(2, '0');
                const currentYear = currentDate.getFullYear();
                const currentFormattedDate = `${currentMonth}/${currentDay}/${currentYear}`;

                const dateDebutDate = new Date(dateDebut);
                const currentDateDate = new Date(currentFormattedDate);

                if (dateDebutDate < currentDateDate) {
                    console.log('La date de début est antérieure à la date actuelle.');

                    // Afficher le modal
                    const checkdate = document.getElementById('checkdate-modal');
                    const message = document.querySelector('#checkdate-modal #message');
                    message.textContent = 'La date de début doit être supérieur à la date actuelle.';
                    checkdate.classList.remove('hidden');
                    checkdate.classList.add('flex');
                    this.value = '';
                }
            });

            dateFinInput.addEventListener('blur', function() {
                const dateFin = this.value;
                const dateDebut = dateDebutInput.value;

                const dateFinDate = new Date(dateFin);
                const currentDateDate = new Date(dateDebut);

                if (dateFinDate < currentDateDate) {
                    console.log('La date du début est antérieure à la date actuelle.');

                    const checkdate = document.getElementById('checkdate-modal');
                    const message = document.querySelector('#checkdate-modal #message');
                    message.textContent = 'La date de fin ne doit pas être inférieur à la date de début.';
                    checkdate.classList.remove('hidden');
                    checkdate.classList.add('flex');
                    this.value = '';
                }
            });
        });
    </script>
</x-app-layout>
