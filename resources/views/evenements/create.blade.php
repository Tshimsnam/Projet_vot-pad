<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                    {{ __("Création d'un événement") }}
                </h2>
            </div>

        </div>
    </x-slot>

    <div class="relative overflow-x-auto sm:rounded-lg" style="padding-top: 30px;">
        <form action="{{ route('evenements.store') }}" autocomplete="off" method="post">
            @csrf
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
                    <textarea type="text" id="description" name="description"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="La description de l'événement" required style="height: 132px;"></textarea>
                </div>
                <div>
                    <label for="type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select id="type" name="type"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option>Compétition</option>
                        <option>Evaluation</option>
                    </select>
                </div>
            </div>
            <button type="submit"
                class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                Valider
            </button>
        </form>

    </div>

    <script>
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
