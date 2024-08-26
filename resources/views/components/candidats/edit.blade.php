<div id="edit-modal-candidat" tabindex="-1" aria-hidden="true"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800"
        style="width: 90%;">
        <div class="flex items-center justify-between p-2 md:p-5 border-b rounded-t dark:border-gray-600">
            <h3 id="insertH3" class="px-4 text-lg font-semibold text-gray-900 dark:text-white" style="display: none;">
                Insertion du candidat</h3>
            </h3>
            <h3 id="modifH3" class="px-4 text-lg font-semibold text-gray-900 dark:text-white" >
                Modification du candidat</h3>
            </h3>
            <button type="button"
                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-toggle="edit-modal-candidat">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
        </div>
        <form method="POST" action="" enctype="multipart/form-data" autocomplete="off" style="padding: 20px 0 20px 0">
            <div class=" mr-5" style="padding-left: 20px">
                @csrf
                @method("PUT")
                <input type="hidden" name="phase" id="phaseId" value="">
                <input type="hidden" name="isVote" id="isVote" value="1">
                <div id="nameDiv">
                    <label id="nameLabel" for="name"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nom</label>
                    <input type="text" id="name" name="name"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Nom du candidat" value="" required />
                </div>
                <div id="emailDiv">
                    <label id="emailLabel" for="email"
                        class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                    <input type="email" id="email" name="email"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Email du candidat" value="" required />
                </div>
                <div id="">
                    <label id="telephoneLabel" for="telephone"
                        class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white">Téléphone</label>
                    <input type="text" id="telephone" name="telephone"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Numéro de téléphone" value="" required />
                </div>
                <div id="">
                    <label id="genreLabel" for="genre"
                        class="block mb-2 pt-2  text-sm font-medium text-gray-900 dark:text-white">Genre</label>
                    <select id="genre" name="genre"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option value="M" selected>Masculin</option>
                        <option value="F">Féminin</option>
                    </select>
                </div>
                <div>
                    <label class="block mb-2 pt-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Image </label>
                    <input
                        class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                        aria-describedby="file_input_help" id="image" name="image" type="file">
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">PNG, JPG.</p>
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
