<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Liste des compétitions') }}
        </h2>
    </x-slot>
    

    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 30px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Num</th>
                    <th scope="col" class="px-6 py-3">Nom compétition</th>
                    <th scope="col" class="px-6 py-3">description</th>
                    <th scope="col" class="px-6 py-3">type</th>
                    <th scope="col" class="px-6 py-3">date_début</th>
                    <th scope="col" class="px-6 py-3">date_fin</th>
                    <th scope="col" class="px-6 py-3">status</th>
                    <th scope="col" class="px-6 py-3">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($evenements as $i=>$item)
                    <tr>
                    <td class="px-6 py-4">{{$i+1}}</td>
                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{$item->nom}}</th>
                    <td class="px-6 py-4">{{$item->description}}</td>
                    <td class="px-6 py-4">{{$item->type}}</td>
                    <td class="px-6 py-4">{{$item->date_debut}}</td>
                    <td class="px-6 py-4">{{$item->date_fin}}</td>
                    <td class="px-6 py-4">{{$item->status}}</td>
                    <td>
                        <button id="dropdownMenuIconButton" data-dropdown-toggle="dropdownDots{{$i}}" class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600" type="button">
                            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 4 15">
                            <path d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z"/>
                            </svg>
                        </button>
                        <!-- Dropdown menu -->
                        <div id="dropdownDots{{$i}}" class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 dark:bg-gray-700 dark:divide-gray-600">
                            <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownMenuIconButton">
                            <li>
                                <a href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Editer</a>
                            </li>
                            <li>
                                <a" data-modal-target="delete-modal" data-modal-toggle="delete-modal" href="" class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">Supprimer</a>
                            </li>
                        </div>
                    </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
