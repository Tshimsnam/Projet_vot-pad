<x-app-layout>
    <x-slot name="header">
        <div class="">
            <h2 class="text-2xl font-extrabold dark:text-white">{{ $evenement->nom }}</h2>
            <h2 class="font-semibold text-sx text-gray-500 dark:text-gray-400  ">
                {{ __('Modification de la phase') }}
            </h2>
        </div>
    </x-slot>

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
        <div class="py-4">
            <form action="{{ route('phases.update', $phaseEdit->id) }}" autocomplete="off" method="post">
                @csrf
                @method('put')
                <div class="relative z-0 w-full mb-5 group">
                    <label for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Phase</label>
                    <input type="text" name="nom" id="floating_email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nom de la phase" required value="{{ $phaseEdit->nom }}" />

                </div>
                <div class="sm:col-span-2">
                    <label for="message" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Description
                    </label>
                    <textarea id="message" name="description" rows="4"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="La description de la phase" required style="height: 132px;">{{ $phaseEdit->description }}
                    </textarea>
                </div>
                <div class="relative z-0 w-full mb-5 group" style="padding-top: 15px">
                    <label for="type"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Type</label>
                    <select id="type" name="type" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        @if ($phaseEdit->type == 'Vote' || $phaseEdit->type == 'vote')
                            <option selected value="Vote">Vote</option>
                            <option value="Evaluation">Evaluation</option>
                        @else
                            <option value="Vote">Vote</option>
                            <option selected value="Evaluation">Evaluation</option>
                        @endif
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
                                <input datepicker datepicker-autohide datepicker-orientation="top" type="text"
                                    name="date_debut"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" value="{{ $phaseEdit->date_debut }}">
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
                                <input datepicker datepicker-autohide datepicker-orientation="top" type="text"
                                    name="date_fin"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                    placeholder="Select date" value="{{ $phaseEdit->date_fin }}">
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
                                    min="00:00" max="24:00" value="{{ $phaseEdit->duree }}" required />
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
    </div>
    <script>
        const typeSelect = document.getElementById('type');
        const dureeDiv = document.querySelector('.duree');
        const selectedValue = typeSelect.value;
        if (selectedValue === 'Vote') {
            dureeDiv.style.display = 'none';
            const duree = document.querySelector('#duree').required = false;
            duree.setAttribute('value', 'null');
        } else {
            dureeDiv.style.display = 'block';
        }

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
    </script>
</x-app-layout>
