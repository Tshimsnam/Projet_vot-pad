<x-app-layout>
    <x-slot name="header">
        <div class="">
            <div class="float-right">
                <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="bottom"
                    type="button"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#ff7900] hover:bg-[#ff7900]/80 focus:ring-4 focus:outline-none focus:ring-[#ff7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#ff7900]/80 dark:focus:ring-[#ff7900]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path
                            d="M8 2a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM8 6.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM9.5 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownLeft"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-15 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
                        <li class="hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white rounded-md"
                            style="margin-right: 0.2rem; margin-left: 0.2rem;">
                            <a href="{{ route('phases.edit', $phase_id) }}" class="inline-flex items-center px-3 py-2 ">
                                Editer
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 pl-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        </li>
                        <li style="margin-right: 0.2rem; margin-left: 0.2rem;">
                            <a onclick="supprimer(event, '{{ route('phases.destroy', $phase_id) }}');"
                                data-modal-target="delete-modal" data-modal-toggle="delete-modal" href="#"
                                class="inline-flex items-center px-3 py-2 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white rounded-md ">
                                Supprimer
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6 pl-2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <h3 class="text-2xl font-extrabold dark:text-white">
                @foreach ($phases as $phase)
                    {{ $phase->nom_event }}
                @endforeach
            </h3>
            <h3 class="text-1xl font-extrabold dark:text-white">
                @foreach ($phases as $phase)
                    {{ $phase->nom_phase }}
                @endforeach
            </h3>
            <p class="flex justify-inline items-center text-gray-500 dark:text-gray-400 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                    style="margin-right: 0.5rem;">
                    <path fill-rule="evenodd"
                        d="M11.986 3H12a2 2 0 0 1 2 2v6a2 2 0 0 1-1.5 1.937V7A2.5 2.5 0 0 0 10 4.5H4.063A2 2 0 0 1 6 3h.014A2.25 2.25 0 0 1 8.25 1h1.5a2.25 2.25 0 0 1 2.236 2ZM10.5 4v-.75a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 0-.75.75V4h3Z"
                        clip-rule="evenodd" />
                    <path fill-rule="evenodd"
                        d="M2 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7Zm6.585 1.08a.75.75 0 0 1 .336 1.005l-1.75 3.5a.75.75 0 0 1-1.16.234l-1.75-1.5a.75.75 0 0 1 .977-1.139l1.02.875 1.321-2.64a.75.75 0 0 1 1.006-.336Z"
                        clip-rule="evenodd" />
                </svg>
                @foreach ($phases as $phase)
                    {{ $phase->type_phase }}
                @endforeach
            </p>
            <p class="flex justify-inline items-center text-gray-500 dark:text-gray-400 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="size-4"
                    style="margin-right: 0.5rem;">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm.75-13a.75.75 0 0 0-1.5 0v5c0 .414.336.75.75.75h4a.75.75 0 0 0 0-1.5h-3.25V5Z"
                        clip-rule="evenodd" />
                </svg>
                @foreach ($phases as $phase)
                    {{ $phase->duree }}
                @endforeach
            </p>
            <p class="flex justify-inline items-center text-gray-500 dark:text-gray-400 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                    style="margin-right: 0.5rem;">
                    <path
                        d="M5.75 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM5 10.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM10.25 7.5a.75.75 0 1 0 0 1.5.75.75 0 0 0 0-1.5ZM7.25 8.25a.75.75 0 1 1 1.5 0 .75.75 0 0 1-1.5 0ZM8 9.5A.75.75 0 1 0 8 11a.75.75 0 0 0 0-1.5Z" />
                    <path fill-rule="evenodd"
                        d="M4.75 1a.75.75 0 0 0-.75.75V3a2 2 0 0 0-2 2v7a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2V1.75a.75.75 0 0 0-1.5 0V3h-5V1.75A.75.75 0 0 0 4.75 1ZM3.5 7a1 1 0 0 1 1-1h7a1 1 0 0 1 1 1v4.5a1 1 0 0 1-1 1h-7a1 1 0 0 1-1-1V7Z"
                        clip-rule="evenodd" />
                </svg>
                @foreach ($phases as $phase)
                    {{ $phase->debut_phase }}
                @endforeach
            </p>
            <p class="flex justify-inline items-center text-gray-500 dark:text-gray-400 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                    style="margin-right: 0.5rem;">
                    <path fill-rule="evenodd"
                        d="M15 8A7 7 0 1 0 1 8a7 7 0 0 0 14 0ZM4.75 7.25a.75.75 0 0 0 0 1.5h4.69L8.22 9.97a.75.75 0 1 0 1.06 1.06l2.5-2.5a.75.75 0 0 0 0-1.06l-2.5-2.5a.75.75 0 0 0-1.06 1.06l1.22 1.22H4.75Z"
                        clip-rule="evenodd" />
                </svg>

                @foreach ($phases as $phase)
                    {{ $phase->fin_phase }}
                @endforeach
            </p>
            {{-- <div class="float-right">
                <?php $message = 'Voulez-vous clôturer cette phase?'; ?>
                <a href="{{ route('open.phase', $phase_id) }}"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#ff7900] hover:bg-[#ff7900]/80 focus:ring-4 focus:outline-none focus:ring-[#ff7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#ff7900]/80 dark:focus:ring-[#ff7900]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                        style="margin-right: 0.5rem; display:none">
                        <path fill-rule="evenodd"
                            d="M6.455 1.45A.5.5 0 0 1 6.952 1h2.096a.5.5 0 0 1 .497.45l.186 1.858a4.996 4.996 0 0 1 1.466.848l1.703-.769a.5.5 0 0 1 .639.206l1.047 1.814a.5.5 0 0 1-.14.656l-1.517 1.09a5.026 5.026 0 0 1 0 1.694l1.516 1.09a.5.5 0 0 1 .141.656l-1.047 1.814a.5.5 0 0 1-.639.206l-1.703-.768c-.433.36-.928.649-1.466.847l-.186 1.858a.5.5 0 0 1-.497.45H6.952a.5.5 0 0 1-.497-.45l-.186-1.858a4.993 4.993 0 0 1-1.466-.848l-1.703.769a.5.5 0 0 1-.639-.206l-1.047-1.814a.5.5 0 0 1 .14-.656l1.517-1.09a5.033 5.033 0 0 1 0-1.694l-1.516-1.09a.5.5 0 0 1-.141-.656L2.46 3.593a.5.5 0 0 1 .639-.206l1.703.769c.433-.36.928-.65 1.466-.848l.186-1.858Zm-.177 7.567-.022-.037a2 2 0 0 1 3.466-1.997l.022.037a2 2 0 0 1-3.466 1.997Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="flex justify-inline items-center">Lancer la phase</p>
                </a>
            </div> --}}
            <div class="float-right">
                <?php $message = 'Voulez-vous clôturer cette phase?'; ?>
                <a id="closeVote" href="#" data-modal-target="status-modal" data-modal-toggle="status-modal"
                    onclick="status(event, '{{ $message }}' , '{{ route('phases.status', ['status' => 'Cloturer', 'id' => $phase_id]) }}')"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#ff7900] hover:bg-[#ff7900]/80 focus:ring-4 focus:outline-none focus:ring-[#ff7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#ff7900]/80 dark:focus:ring-[#ff7900]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                        style="margin-right: 0.5rem; display:none">
                        <path fill-rule="evenodd"
                            d="M6.455 1.45A.5.5 0 0 1 6.952 1h2.096a.5.5 0 0 1 .497.45l.186 1.858a4.996 4.996 0 0 1 1.466.848l1.703-.769a.5.5 0 0 1 .639.206l1.047 1.814a.5.5 0 0 1-.14.656l-1.517 1.09a5.026 5.026 0 0 1 0 1.694l1.516 1.09a.5.5 0 0 1 .141.656l-1.047 1.814a.5.5 0 0 1-.639.206l-1.703-.768c-.433.36-.928.649-1.466.847l-.186 1.858a.5.5 0 0 1-.497.45H6.952a.5.5 0 0 1-.497-.45l-.186-1.858a4.993 4.993 0 0 1-1.466-.848l-1.703.769a.5.5 0 0 1-.639-.206l-1.047-1.814a.5.5 0 0 1 .14-.656l1.517-1.09a5.033 5.033 0 0 1 0-1.694l-1.516-1.09a.5.5 0 0 1-.141-.656L2.46 3.593a.5.5 0 0 1 .639-.206l1.703.769c.433-.36.928-.65 1.466-.848l.186-1.858Zm-.177 7.567-.022-.037a2 2 0 0 1 3.466-1.997l.022.037a2 2 0 0 1-3.466 1.997Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="flex justify-inline items-center">Clôturer la phase</p>
                </a>

                <button type="button" id="dropdownLeftButtonStatus" data-dropdown-toggle="dropdownLeftStatus"
                    data-dropdown-placement="left"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#ff7900] hover:bg-[#ff7900]/80 focus:ring-4 focus:outline-none focus:ring-[#ff7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#ff7900]/80 dark:focus:ring-[#ff7900]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                        style="margin-right: 0.5rem;">
                        <path fill-rule="evenodd"
                            d="M6.455 1.45A.5.5 0 0 1 6.952 1h2.096a.5.5 0 0 1 .497.45l.186 1.858a4.996 4.996 0 0 1 1.466.848l1.703-.769a.5.5 0 0 1 .639.206l1.047 1.814a.5.5 0 0 1-.14.656l-1.517 1.09a5.026 5.026 0 0 1 0 1.694l1.516 1.09a.5.5 0 0 1 .141.656l-1.047 1.814a.5.5 0 0 1-.639.206l-1.703-.768c-.433.36-.928.649-1.466.847l-.186 1.858a.5.5 0 0 1-.497.45H6.952a.5.5 0 0 1-.497-.45l-.186-1.858a4.993 4.993 0 0 1-1.466-.848l-1.703.769a.5.5 0 0 1-.639-.206l-1.047-1.814a.5.5 0 0 1 .14-.656l1.517-1.09a5.033 5.033 0 0 1 0-1.694l-1.516-1.09a.5.5 0 0 1-.141-.656L2.46 3.593a.5.5 0 0 1 .639-.206l1.703.769c.433-.36.928-.65 1.466-.848l.186-1.858Zm-.177 7.567-.022-.037a2 2 0 0 1 3.466-1.997l.022.037a2 2 0 0 1-3.466 1.997Z"
                            clip-rule="evenodd" />
                    </svg>
                    <p class="flex justify-inline items-center">Changer statut</p>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownLeftStatus"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-15 dark:bg-gray-700 dark:divide-gray-600">

                    <ul class="py-1 text-xs text-gray-700 dark:text-gray-200"
                        aria-labelledby="dropdownLeftButtonStatus">
                        <li id = "enCours" style="margin-right: 0.2rem; margin-left: 0.2rem;">
                            <?php $message = 'Voulez-vous lancer cette phase?'; ?>
                            <a href="#"
                                onclick="status(event, '{{ $message }}', '{{ route('phases.status', ['status' => 'En cours', 'id' => $phase_id]) }}')"
                                data-modal-target="status-modal" data-modal-toggle="status-modal"
                                class="block px-3 py-1 text-center inline-flex items-center hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white rounded-md ">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-5">
                                    <path fill-rule="evenodd"
                                        d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14Zm3.844-8.791a.75.75 0 0 0-1.188-.918l-3.7 4.79-1.649-1.833a.75.75 0 1 0-1.114 1.004l2.25 2.5a.75.75 0 0 0 1.15-.043l4.25-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>
                                <p class="flex justify-inline items-center" style="margin-left: 0.2rem;">Lancer la
                                    phase </p>
                            </a>
                        </li>

                        <li id="fermer" style="margin-right: 0.2rem; margin-left: 0.2rem;">
                            <?php $message = 'Voulez-vous fermer cette phase?'; ?>
                            <a href="#"
                                onclick="status(event, '{{ $message }}' , '{{ route('phases.status', ['status' => 'Fermer', 'id' => $phase_id]) }}')"
                                data-modal-target="status-modal" data-modal-toggle="status-modal"
                                class="block px-3 py-1 text-center inline-flex items-center hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white rounded-md">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-5">
                                    <path
                                        d="M5.28 4.22a.75.75 0 0 0-1.06 1.06L6.94 8l-2.72 2.72a.75.75 0 1 0 1.06 1.06L8 9.06l2.72 2.72a.75.75 0 1 0 1.06-1.06L9.06 8l2.72-2.72a.75.75 0 0 0-1.06-1.06L8 6.94 5.28 4.22Z" />
                                </svg>
                                <p class="flex justify-inline items-center" style="margin-left: 0.2rem;">Fermer la
                                    phase </p>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <p class="flex justify-inline items-center text-gray-500 dark:text-gray-400 ">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4"
                    style="margin-right: 0.5rem;">
                    <path fill-rule="evenodd"
                        d="M6.455 1.45A.5.5 0 0 1 6.952 1h2.096a.5.5 0 0 1 .497.45l.186 1.858a4.996 4.996 0 0 1 1.466.848l1.703-.769a.5.5 0 0 1 .639.206l1.047 1.814a.5.5 0 0 1-.14.656l-1.517 1.09a5.026 5.026 0 0 1 0 1.694l1.516 1.09a.5.5 0 0 1 .141.656l-1.047 1.814a.5.5 0 0 1-.639.206l-1.703-.768c-.433.36-.928.649-1.466.847l-.186 1.858a.5.5 0 0 1-.497.45H6.952a.5.5 0 0 1-.497-.45l-.186-1.858a4.993 4.993 0 0 1-1.466-.848l-1.703.769a.5.5 0 0 1-.639-.206l-1.047-1.814a.5.5 0 0 1 .14-.656l1.517-1.09a5.033 5.033 0 0 1 0-1.694l-1.516-1.09a.5.5 0 0 1-.141-.656L2.46 3.593a.5.5 0 0 1 .639-.206l1.703.769c.433-.36.928-.65 1.466-.848l.186-1.858Zm-.177 7.567-.022-.037a2 2 0 0 1 3.466-1.997l.022.037a2 2 0 0 1-3.466 1.997Z"
                        clip-rule="evenodd" />
                </svg>
                {{ $status_phase }}
            </p>
        </div>
    </x-slot>

    <div id="tabs" class="border-b border-gray-200 dark:border-gray-700 pt-3 mb-3">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center text-gray-500 dark:text-gray-400">
            <li class="me-2">
                <a href="#view-content" data-target="view-content"
                    class="inline-flex items-center justify-center p-4 text-[#ff7900] border-b-2 border-[#ff7900] rounded-t-lg active dark:text-[#ff7900] dark:border-[#ff7900] group"
                    aria-current="page">
                    <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 18 18">
                        <path
                            d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                    </svg>
                    Dashboard
                </a>
            </li>
            <li class="me-2">
                <a href="#candidat-content" data-target="candidat-content"
                    class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                    <svg class="w-4 h-4 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                        viewBox="0 0 20 20">
                        <path
                            d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                    </svg>
                    Candidats
                </a>
            </li>
            <li class="me-2">
                <a href="#question-content" data-target="question-content"
                    class="inline-flex items-center justify-center p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 group">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                        class="w-5 h-5 me-2 text-gray-400 group-hover:text-gray-500 dark:text-gray-500 dark:group-hover:text-gray-300">
                        <path fill-rule="evenodd"
                            d="M18 10a8 8 0 1 1-16 0 8 8 0 0 1 16 0ZM8.94 6.94a.75.75 0 1 1-1.061-1.061 3 3 0 1 1 2.871 5.026v.345a.75.75 0 0 1-1.5 0v-.5c0-.72.57-1.172 1.081-1.287A1.5 1.5 0 1 0 8.94 6.94ZM10 15a1 1 0 1 0 0-2 1 1 0 0 0 0 2Z"
                            clip-rule="evenodd" />
                    </svg>
                    Questions
                </a>
            </li>
        </ul>
    </div>

    <div>
        <div id="view-content" class="hidden grid grid-cols-1 sm:grid-cols-1 md:grid-cols-3 gap-4">
            <div class="max-w-sm w-full bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mr-2">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center mb-3">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Details
                                candidats</h5>
                            <svg data-popover-target="chart-info" data-popover-placement="right"
                                class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                            </svg>
                            <div data-popover id="chart-info" role="tooltip"
                                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Section Tous</h3>
                                    <p>Dans cette section, c'est pour déterminer le nombre de tous les candidats liés à
                                        cette
                                        phase.</p>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Section Féminins</h3>
                                    <p>Dans cette section, c'est pour déterminer le nombre des candidats du sêxe
                                        féminin liés à cette
                                        phase.</p>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Section Mails</h3>
                                    <p>Dans cette section, c'est pour déterminer le nombre des candidats qui ont reçus
                                        un mail liés à cette
                                        phase.</p>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Section Start</h3>
                                    <p>Dans cette section, c'est pour déterminer le nombre des candidats qui ont passés
                                        l'évaluation de cette
                                        phase.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <div class="grid grid-cols-4 gap-4 mb-2">
                        <dl
                            class="bg-orange-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-orange-100 dark:bg-gray-500 text-orange-600 dark:text-orange-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $intervenantPhases->total() }}</dt>
                            <dd class="text-orange-600 dark:text-orange-300 text-sm font-medium">Tous</dd>
                        </dl>
                        <dl
                            class="bg-teal-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-teal-100 dark:bg-gray-500 text-teal-600 dark:text-teal-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ count($intervenantsFeminin) }}
                            </dt>
                            <dd class="text-teal-600 dark:text-teal-300 text-sm font-medium">Féminins</dd>
                        </dl>
                        <dl
                            class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $intervenantPhases->total() - (count($intervenantsMails) + count($intervenantStart)) }}
                            </dt>
                            <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Mails</dd>
                        </dl>
                        <dl
                            class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ count($intervenantStart) }}</dt>
                            <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Start</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class=" bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6 mr-2">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center mb-3">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Details
                                passation</h5>
                            <svg data-popover-target="chart-info-pass" data-popover-placement="top"
                                class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                            </svg>
                            <div data-popover id="chart-info-pass" role="tooltip"
                                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Section Pourcentage</h3>
                                    <p>Dans cette section, c'est pour déterminer le pourcentage minimum d'un candidat
                                        qui
                                        va passer à la phase suivanet si cette dernière existe.<br>ND : Non défini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <div class=" mb-2">
                        <dl
                            class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $phaseExist->passation_pourcent ?? 'ND' }}
                            </dt>

                            <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Pourcentage</dd>
                        </dl>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow dark:bg-gray-800 p-4 md:p-6">
                <div class="flex justify-between">
                    <div class="flex items-center">
                        <div class="flex justify-center items-center mb-3">
                            <h5 class="text-xl font-bold leading-none text-gray-900 dark:text-white pe-1">Details
                                questions
                            </h5>
                            <svg data-popover-target="chart-info-quest" data-popover-placement="top"
                                class="w-3.5 h-3.5 text-gray-500 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white cursor-pointer ms-1"
                                aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                            </svg>
                            <div data-popover id="chart-info-quest" role="tooltip"
                                class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 dark:bg-gray-800 dark:border-gray-600 dark:text-gray-400">
                                <div class="p-3 space-y-2">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Section Nombre</h3>
                                    <p>Dans cette section, c'est pour déterminer le nombre des questions insérées dans
                                        cette phase.<br>ND : Non défini</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">
                    <div class=" mb-2">
                        <dl
                            class="bg-blue-50 dark:bg-gray-600 rounded-lg flex flex-col items-center justify-center h-[78px]">
                            <dt
                                class="w-8 h-8 rounded-full bg-blue-100 dark:bg-gray-500 text-blue-600 dark:text-blue-300 text-sm font-medium flex items-center justify-center mb-1">
                                {{ $questionPhasePagnation->total() ?? 'ND' }}
                            </dt>
                            <dd class="text-blue-600 dark:text-blue-300 text-sm font-medium">Nombre</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
        <div id="candidat-content">
            <div class=" dark:bg-gray-900">
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
                    @if (session('successCand'))
                        <div id="alert-3-cand"
                            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                            role="alert">
                            <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                fill="currentColor" viewBox="0 0 20 20">
                                <path
                                    d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                            </svg>
                            <span class="sr-only">Info</span>
                            <div class="ms-3 text-sm font-medium">
                                {{ session('successCand') }}
                            </div>
                            <button type="button"
                                class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                data-dismiss-target="#alert-3-cand" aria-label="Close">
                                <span class="sr-only">Close</span>
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                </svg>
                            </button>
                        </div>
                    @endif
                    <div
                        class="flex flex-col sm:flex-row sm:justify-between sm:items-center py-2 space-y-2 sm:space-y-0 sm:space-x-2">
                        <a onclick="inserer(event, '{{ route('intervenants.store') }}', @foreach ($phaseShow as $key => $item) 
                            {{ $item->id }} @endforeach)"
                            data-modal-target="create-modal-interv" data-modal-toggle="create-modal-interv"
                            class="px-4 py-2 text-sm font-medium text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                            Ajouter le candidat
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-5 pl-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>

                        <a onclick="passation(event, '{{ route('passation') }}', '{{ $phase_id }}', '{{ $phaseExist->type }}', {{ $passPourcent }})"
                            data-modal-target="pass-modal" data-modal-toggle="pass-modal"
                            class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                            Règle de passation
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="w-8 h-5 pl-2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                        </a>

                        <a href="{{ route('mail.view', $phase_id) }}"
                            {{-- data-modal-target="mail-modal-candidat" data-modal-toggle="mail-modal-candidat" --}}
                            class="px-4 py-2 text-sm font-medium text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                            Envoyer les mails
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="w-8 h-5 pl-2">
                                <path
                                    d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                <path
                                    d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                            </svg>
                        </a>

                        <a href="{{ route('resultats.show', $phase_id) }}"
                            class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                            Résultats
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="w-8 h-5 pl-2">
                                <path
                                    d="M2.995 1a.625.625 0 1 0 0 1.25h.38v2.125a.625.625 0 1 0 1.25 0v-2.75A.625.625 0 0 0 4 1H2.995ZM3.208 7.385a2.37 2.37 0 0 1 1.027-.124L2.573 8.923a.625.625 0 0 0 .439 1.067l1.987.011a.625.625 0 0 0 .006-1.25l-.49-.003.777-.776c.215-.215.335-.506.335-.809 0-.465-.297-.957-.842-1.078a3.636 3.636 0 0 0-1.993.121.625.625 0 1 0 .416 1.179ZM2.625 11a.625.625 0 1 0 0 1.25H4.25a.125.125 0 0 1 0 .25H3.5a.625.625 0 1 0 0 1.25h.75a.125.125 0 0 1 0 .25H2.625a.625.625 0 1 0 0 1.25H4.25a1.375 1.375 0 0 0 1.153-2.125A1.375 1.375 0 0 0 4.25 11H2.625ZM7.25 2a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6ZM7.25 7.25a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6ZM6.5 13.25a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Z" />
                            </svg>
                        </a>
                    </div>
                    <div class="mb-4">
                        <input type="text" id="search" placeholder="Rechercher par nom..."
                            class="w-full px-3 py-2 border rounded-md dark:bg-gray-800 dark:border-gray-700 dark:text-white">
                    </div>
                    <div class="">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-2" id="divPagination">
                            @foreach ($intervenants as $i => $item)
                                <div class="w-full">
                                    <div
                                        class="mb-3 py-3 rounded-md border bg-white drop-shadow-xl dark:bg-gray-800 dark:border-gray-800">
                                        <div class="pl-2 pr-5 float-left">
                                            <img class="w-20 h-20 object-cover border-2 rounded-md"
                                                src="{{ $item->image && file_exists(public_path($item->image)) ? asset($item->image) : asset('images/profil.jpg') }}"
                                                alt="">
                                        </div>

                                        <div class="flex justify-between">
                                            <div>
                                                <div class="flex items-center">
                                                    <h3
                                                        class="text-xl text-gray-900 whitespace-nowrap dark:text-white capitalize">
                                                        {{ $item->noms }}
                                                    </h3>
                                                    @if ($item->mail_send == 0)
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                            fill="currentColor" class="size-7 pl-2 text-red-500">
                                                            <path
                                                                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                                            <path
                                                                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                            fill="currentColor" class="size-7 pl-2 text-green-500">
                                                            <path
                                                                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                                            <path
                                                                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="flex items-center">
                                                    <h3
                                                        class="text-gray-900 whitespace-nowrap dark:text-white capitalize">
                                                        {{ $item->coupon }}
                                                    </h3>
                                                    @if ($item->is_use == 0)
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="size-7 pl-2 text-red-500">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="size-7 pl-2 text-green-500">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                </div>

                                                <h3 class="text-sm text-gray-900 dark:text-gray-200">
                                                    {{ $item->email }}
                                                </h3>
                                                <div class="flex items-center space-x-4">
                                                    <h3 id='genre-{{ $i }}'
                                                        class="text-sm text-gray-900 whitespace-nowrap dark:text-white"
                                                        data-genre="{{ $item->genre }}">
                                                    </h3>
                                                    <h3 class="text-sm text-gray-900 dark:text-white">
                                                        +243{{ $item->telephone }}
                                                    </h3>
                                                </div>

                                            </div>
                                            <div class="pr-2">
                                                <a onclick="editer(event, '{{ route('intervenants.update', $item->id) }}', '{{ $item->noms }}', '{{ $item->email }}', '{{ $item->image }}', '{{ $phase_id }}', '{{ $item->telephone }}', '{{ $item->genre }}')"
                                                    data-modal-target="intervEdit-modal"
                                                    data-modal-toggle="intervEdit-modal" href="#"
                                                    class="py-1 px-2 mb-2 text-center font-medium text-center flex items-center text-white bg-gray-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-gray-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                        fill="currentColor" class="size-4">
                                                        <path
                                                            d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                        <path
                                                            d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                                    </svg>


                                                </a>
                                                <a onclick="supprimer(event, '{{ route('intervenant.destroy', ['intervenant' => $item->id, 'phaseId' => $phase_id]) }}');"
                                                    data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                                    href="#"
                                                    class="py-1 px-2 font-medium text-center flex items-center text-white bg-gray-700 rounded-md hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-gray-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                        fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd"
                                                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div id="divRecherche" class="grid grid-cols-1 md:grid-cols-2 gap-2 hidden">
                            @foreach ($intervenantAll as $i => $item)
                                <div id="recherche" class="w-full">
                                    <div
                                        class="mb-3 py-3 rounded-md border bg-white drop-shadow-xl dark:bg-gray-800 dark:border-gray-800">
                                        <div class="pl-2 pr-5 float-left">
                                            <img class="w-20 h-20 object-cover border-2 rounded-md"
                                                src="{{ $item->image && file_exists(public_path($item->image)) ? asset($item->image) : asset('images/profil.jpg') }}"
                                                alt="">
                                        </div>

                                        <div class="flex justify-between">
                                            <div>
                                                <div class="flex items-center">
                                                    <h3 id="h3Nom"
                                                        class="text-xl text-gray-900 whitespace-nowrap dark:text-white capitalize">
                                                        {{ $item->noms }}
                                                    </h3>
                                                    @if ($item->mail_send == 0)
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                            fill="currentColor" class="size-7 pl-2 text-red-500">
                                                            <path
                                                                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                                            <path
                                                                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                            fill="currentColor" class="size-7 pl-2 text-green-500">
                                                            <path
                                                                d="M2.5 3A1.5 1.5 0 0 0 1 4.5v.793c.026.009.051.02.076.032L7.674 8.51c.206.1.446.1.652 0l6.598-3.185A.755.755 0 0 1 15 5.293V4.5A1.5 1.5 0 0 0 13.5 3h-11Z" />
                                                            <path
                                                                d="M15 6.954 8.978 9.86a2.25 2.25 0 0 1-1.956 0L1 6.954V11.5A1.5 1.5 0 0 0 2.5 13h11a1.5 1.5 0 0 0 1.5-1.5V6.954Z" />
                                                        </svg>
                                                    @endif
                                                </div>
                                                <div class="flex items-center">
                                                    <h3
                                                        class="text-gray-900 whitespace-nowrap dark:text-white capitalize">
                                                        {{ $item->coupon }}
                                                    </h3>
                                                    @if ($item->is_use == 0)
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="size-7 pl-2 text-red-500">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM8.28 7.22a.75.75 0 0 0-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 1 0 1.06 1.06L10 11.06l1.72 1.72a.75.75 0 1 0 1.06-1.06L11.06 10l1.72-1.72a.75.75 0 0 0-1.06-1.06L10 8.94 8.28 7.22Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="size-7 pl-2 text-green-500">
                                                            <path fill-rule="evenodd"
                                                                d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                    @endif
                                                </div>

                                                <h3 class="text-sm text-gray-900 dark:text-gray-200">
                                                    {{ $item->email }}
                                                </h3>
                                                <div class="flex items-center space-x-4">
                                                    <h3 id='genre-{{ $i }}'
                                                        class="text-sm text-gray-900 whitespace-nowrap dark:text-white"
                                                        data-genre="{{ $item->genre }}">
                                                    </h3>
                                                    <h3 class="text-sm text-gray-900 dark:text-white">
                                                        +243{{ $item->telephone }}
                                                    </h3>
                                                </div>

                                            </div>
                                            <div class="pr-2">
                                                <a onclick="editer(event, '{{ route('intervenants.update', $item->id) }}', '{{ $item->noms }}', '{{ $item->email }}', '{{ $item->image }}', '{{ $phase_id }}', '{{ $item->telephone }}', '{{ $item->genre }}')"
                                                    data-modal-target="intervEdit-modal"
                                                    data-modal-toggle="intervEdit-modal" href="#"
                                                    class="py-1 px-2 mb-2 text-center font-medium text-center flex items-center text-white bg-gray-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-gray-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                        fill="currentColor" class="size-4">
                                                        <path
                                                            d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                        <path
                                                            d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                                    </svg>


                                                </a>
                                                <a onclick="supprimer(event, '{{ route('intervenant.destroy', ['intervenant' => $item->id, 'phaseId' => $phase_id]) }}');"
                                                    data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                                    href="#"
                                                    class="py-1 px-2 font-medium text-center flex items-center text-white bg-gray-700 rounded-md hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-gray-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                        fill="currentColor" class="size-4">
                                                        <path fill-rule="evenodd"
                                                            d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                            clip-rule="evenodd" />
                                                    </svg>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div id="pagination" class="p-2">
                        {{ $intervenantPhases->appends(['intervenant_page' => $intervenantPhases->currentPage()])->links() }}
                    </div>
                </div>
            </div>
        </div>
        <div id="question-content" class="hidden">
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
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            @if (session('echec'))
                <div id="alert-2"
                    class="flex items-center p-4 mb-4 text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400"
                    role="alert">
                    <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                        fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                    </svg>
                    <span class="sr-only">Info</span>
                    <div class="ms-3 text-sm font-medium">
                        {{ session('echec') }}
                    </div>
                    <button type="button"
                        class="ms-auto -mx-1.5 -my-1.5 bg-red-50 text-red-500 rounded-lg focus:ring-2 focus:ring-red-400 p-1.5 hover:bg-red-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-red-400 dark:hover:bg-gray-700"
                        data-dismiss-target="#alert-2" aria-label="Close">
                        <span class="sr-only">Close</span>
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                    </button>
                </div>
            @endif
            <div class="flex justify-between items-center pt-3">
                <a onclick="insererQuestion(event, '{{ route('importQuestion') }}', @foreach ($phaseShow as $key => $item) 
                    {{ $item->id }} @endforeach)"
                    data-modal-target="create-modal-question" data-modal-toggle="create-modal-question"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                    Importer les questions
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-8 h-5 pl-2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                    </svg>
                </a>
            </div>
            <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
                <div class="">
                    @php
                        $i = ($questionPhasePagnation->currentPage() - 1) * $questionPhasePagnation->perPage() + 1;
                    @endphp
                    @foreach ($questionPhasePagnation as $item)
                        <div class="w-full">
                            <div
                                class="mb-3 py-1 rounded-md border bg-white drop-shadow-xl dark:bg-gray-800 dark:border-gray-800">
                                <div class="flex justify-between pl-3 relative">
                                    <div>
                                        <div class="flex items-center flex-wrap">
                                            <h3
                                                class="text-sm font-bold text-gray-900 dark:text-white capitalize dark:text-gray-300 flex-1 overflow-hidden">
                                                Question {{ $i++ }} : {!! nl2br(e($item->question->question)) !!}
                                            </h3>
                                            <div class="ml-14 flex-shrink-0">
                                            </div>
                                        </div>

                                        <h3 class="text-sm text-gray-900 dark:text-gray-200">
                                            Pondération: {{ $item->ponderation }}
                                        </h3>
                                        <div class="flex items-center space-x-4">
                                            <h3 class="text-sm text-gray-900 whitespace-nowrap dark:text-gray-300">
                                                Nombre assertions :
                                            </h3>
                                        </div>
                                    </div>

                                    <div class="pr-2 absolute right-0">
                                        <a href="{{ route('question.phase', ['id' => $item->question->id, 'phase_id' => $phase_id]) }}"
                                            class="py-1 px-2 mb-2 text-center font-medium text-center flex items-center text-white bg-gray-700 rounded-md hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-gray-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="size-4">
                                                <path
                                                    d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                <path
                                                    d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                            </svg>
                                        </a>
                                        <a href=""
                                            onclick="supprimer(event, '{{ route('questions.destroy', $item->question->id) }}')"
                                            data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                            class="py-1 px-2 font-medium text-center flex items-center text-white bg-gray-700 rounded-md hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-gray-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                fill="currentColor" class="size-4">
                                                <path fill-rule="evenodd"
                                                    d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach
                </div>
                <div class="p-2">
                    {{ $questionPhasePagnation->appends(['question_page' => $questionPhasePagnation->currentPage()])->links() }}
                </div>
            </div>
        </div>
    </div>

    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <form action="{{ route('close.phase') }}" method="post" class="relative p-4 w-full max-w-2xl max-h-full">
            @csrf
            @method('post')
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Passage à la phase suivante
                    </h3>
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="mb-5 m-5">
                    <label for="nbr_max" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                        Pourcentage (%) minimum à retenir</label>
                    <input type="number" name="nbr_retenu" id="nbr_max"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="" required />
                </div>
                <input type="hidden" name="phase_id" value="{{ $phase_id }}">
                <!-- Modal footer -->
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="default-modal" type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Envoyer
                        à la phase suivante</button>
                    <button data-modal-hide="default-modal" type="button"
                        class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Decline</button>
                </div>
            </div>
        </form>



    </div>
    <x-delete :message="__('Voulez-vous vraiment supprimer?')" />
    <x-phases.status />
    <x-intervenants.create />
    <x-intervenants.edit />
    <x-questions.create />
    <x-passations.pass />
    <x-mails.send />
    <x-candidats.edit />
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>
    <script>
        //script pour modifier l'ordre de question
        $(function() {
            $("#sortable").sortable();
        });
    </script>
    <script>
        //script pour ajouter le champ de saisie dynamiquement
        function Chbx() {
            Fields = document.getElementById("InputFields");
            N = document.getElementById("N").value;
            while (Fields.hasChildNodes()) {
                Fields.removeChild(Fields.lastChild);
            }
            for (i = 0; i < N; i++) {
                Fields.appendChild(document.createTextNode("Assertion " + (i + 1) + " "));
                var inputAssertion = document.createElement("input");
                inputAssertion.type = "text";
                inputAssertion.name = `assertions[${i}][name]`;
                inputAssertion.required = true;
                inputAssertion.placeholder = "Assertion"
                inputAssertion.className =
                    "bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
                inputAssertion.id = "k" + i;

                var inputPonderation = document.createElement("input");
                inputPonderation.type = "number";
                inputPonderation.name = `assertions[${i}][ponderation]`;
                // inputPonderation.required = true;
                inputPonderation.placeholder = "Ponderation de l'assertion";
                inputPonderation.value = 0; //valeur par defaut
                inputPonderation.min = 0;
                inputPonderation.max = 1;
                inputPonderation.step = 1;
                inputPonderation.className =
                    "hidden bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500";
                inputPonderation.id = "k" + i;

                var radioPonderationcheck = document.createElement("input");
                radioPonderationcheck.type = "radio";
                radioPonderationcheck.name = `bonneReponse`;
                radioPonderationcheck.className =
                    "m-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"
                radioPonderationcheck.value = `${i}`;

                var divAssetionPonde = document.createElement("div");
                divAssetionPonde.className = "flex items-center rounded dark:border-gray-700";
                divAssetionPonde.appendChild(inputAssertion)
                divAssetionPonde.appendChild(radioPonderationcheck)
                divAssetionPonde.appendChild(inputPonderation)

                Fields.appendChild(divAssetionPonde);

                // Fields.appendChild(inputAssertion);
                // Fields.appendChild(radioPonderationcheck);
                // Fields.appendChild(inputPonderation);
                document.getElementById("k" + i).value = "";
                Fields.appendChild(document.createElement("br"));

            }
        }
        Chbx();
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet"
        href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <script>
        //suppression de question
        function supprimer_q(event) {
            event.preventDefault()
            var route = event.target.getAttribute('href');
            alert(route)
            var form = document.querySelector('#popup-modal #form_q_delete')
            form.setAttribute('action', route)
        }
    </script>
    <script type="text/javascript">
        //script autocomplete de question
        // CSRF Token
        CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function() {

            $("#employee_search").autocomplete({
                source: function(request, response) {
                    // Fetch data
                    $.ajax({
                        url: "{{ route('auto-question-get') }}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: CSRF_TOKEN,
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    // Set selection
                    $('#employee_search')
                        .val(ui.item.label)
                        .addClass('bg-gray-200 text-gray-800 font-bold'); // display the selected text
                    $('#employeeid').val(ui.item.value); // save selected id to input
                    return false;
                }
            });

        });

        function inserer(event, url, phaseId) {
            event.preventDefault();
            const form = document.querySelector('#create-modal-interv form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#create-modal-interv form #phaseId')
            inputPhaseId.setAttribute('value', phaseId);

            const divImport = document.querySelector('#create-modal-interv form div #divImporter')
            const divManuel = document.querySelector('#create-modal-interv form div #divManuel')

            const importerCheck = document.querySelector('#create-modal-interv form div #importer')
            const manuelCheck = document.querySelector('#create-modal-interv form div #manuel')

            importerCheck.checked = false;
            manuelCheck.checked = false;

            divImport.style.display = 'none';
            divManuel.style.display = 'none';
        }

        function insererQuestion(event, url, phaseId) {
            event.preventDefault();
            const form = document.querySelector('#create-modal-question form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#create-modal-question form #phaseId')
            inputPhaseId.setAttribute('value', phaseId);
        }

        function sendMail(event, phaseId) {
            event.preventDefault();
            const form = document.querySelector('#mail-modal-candidat form');
            form.setAttribute('action', `{{ route('sendMailMany') }}`);

            const phase = document.querySelector('#mail-modal-candidat form div #phaseId');
            phase.setAttribute('value', phaseId);

            const candFirstSelect = document.querySelector('#mail-modal-candidat form div #candFirst');
            const candLastSelect = document.querySelector('#mail-modal-candidat form div #candLast');

            candFirstSelect.innerHTML = '';
            candLastSelect.innerHTML = '';

            const intervenants = @json($intervenantsMails);

            function populateCandLastSelect(intervenants, selectedId) {
                candLastSelect.innerHTML = '';

                const firstIndex = intervenants.findIndex(intervenant => intervenant.id === selectedId);
                const lastIntervenants = intervenants.slice(firstIndex);

                lastIntervenants.forEach(intervenant => {
                    const option = document.createElement('option');
                    option.value = intervenant.id;
                    option.text = intervenant.noms;
                    candLastSelect.appendChild(option);
                });

                countSelectedIntervenants();
            }

            intervenants.forEach((intervenant, index) => {
                const option = document.createElement('option');
                option.value = intervenant.id;
                option.text = intervenant.noms;
                candFirstSelect.appendChild(option);
            });

            if (intervenants.length > 0) {
                candFirstSelect.value = intervenants[0].id;
                populateCandLastSelect(intervenants, intervenants[0].id);
            }

            candFirstSelect.addEventListener('change', (event) => {
                const selectedId = parseInt(event.target.value, 10);
                populateCandLastSelect(intervenants, selectedId);
            });

            candLastSelect.addEventListener('change', countSelectedIntervenants);
            countSelectedIntervenants();
        }

        //design ajout 

        function supprimer(event, url) {
            event.preventDefault();
            const form = document.querySelector('#delete-modal form')
            form.setAttribute('action', url);
        }

        setTimeout(function() {
            let alerts = document.querySelectorAll('[role="alert"]');
            alerts.forEach(function(alert) {
                alert.style.transition = "opacity 0.5s ease";
                alert.style.opacity = "0";
                setTimeout(function() {
                    alert.remove();
                }, 500);
            });
        }, 5000);

        //FrontEnd design
        window.onload = function() {
            initial("{{ $status_phase }}");
            let pageCandidat = localStorage.getItem('page-candidat-evaluation');
            const divView = document.querySelector('a[data-target="view-content"]')
            const divCandidat = document.querySelector('a[data-target="candidat-content"]')

            if (pageCandidat) {
                divView.removeAttribute('aria-current');
                divCandidat.setAttribute('aria-current', 'page');
            }
            pagination()
        };

        function initial(status_phase) {
            const enCoursStatut = document.getElementById('enCours');
            const fermerStatut = document.getElementById('fermer');
            const closeVote = document.getElementById('closeVote');
            const dropdownLeftButtonStatus = document.getElementById('dropdownLeftButtonStatus');
            if (status_phase == 'En cours' || status_phase == 'en cours') {
                enCoursStatut.hidden = true;
                fermerStatut.hidden = false;
                closeVote.style.display = 'flex';
                dropdownLeftButtonStatus.style.display = 'none';
            } else if (status_phase == 'Fermer' || status_phase == 'fermer') {
                enCoursStatut.hidden = false;
                fermerStatut.hidden = true;
                closeVote.style.display = 'none';
                dropdownLeftButtonStatus.style.display = 'none';
            } else if (status_phase == 'en attente') {
                enCoursStatut.hidden = false;
                fermerStatut.hidden = false;
                closeVote.style.display = 'none';
                dropdownLeftButtonStatus.style.display = 'flex';
            } else {
                closeVote.style.display = 'none';
                dropdownLeftButtonStatus.style.display = 'none';
            }
        }

        function status(event, message, url) {
            event.preventDefault();
            const form = document.querySelector('#status-modal form')
            form.setAttribute('action', url);

            const messageH3 = document.querySelector('#status-modal h3')
            messageH3.textContent = message
        }

        document.addEventListener('DOMContentLoaded', function() {

            let pagination = localStorage.getItem('pagination_evaluation')
            if (pagination !== null) {
                localStorage.setItem('page-candidat-evaluation', pagination);
                localStorage.removeItem('pagination_evaluation');
            } else {
                localStorage.removeItem('page-candidat-evaluation');
            }


            document.querySelectorAll('#pagination a').forEach(function(link) {
                link.addEventListener('click', function() {
                    localStorage.setItem('pagination_evaluation', '1');
                });
            });
        });

        document.querySelectorAll('#tabs ul li a').forEach(tab => {
            tab.addEventListener('click', function(event) {
                event.preventDefault();

                document.querySelectorAll('#tabs ul li a').forEach(tab => {
                    tab.classList.remove('text-[#ff7900]', 'border-[#ff7900]',
                        'dark:text-[#ff7900]', 'dark:border-[#ff7900]');
                    tab.classList.add('border-transparent');

                    const icon = tab.querySelector('svg');
                    if (icon) {
                        icon.classList.remove('text-[#ff7900]', 'dark:text-[#ff7900]');
                        icon.classList.add('text-gray-400', 'dark:text-gray-500');
                    }
                });

                document.querySelectorAll('[id$="-content"]').forEach(content => {
                    content.classList.add('hidden');
                });

                this.classList.add('text-[#ff7900]', 'border-[#ff7900]', 'dark:text-[#ff7900]',
                    'dark:border-[#ff7900]');

                const icon = this.querySelector('svg');
                if (icon) {
                    icon.classList.add('text-[#ff7900]', 'dark:text-[#ff7900]');
                    icon.classList.remove('text-gray-400', 'dark:text-gray-500');
                }

                const contentId = this.getAttribute('data-target');
                document.getElementById(contentId).classList.remove('hidden');
            });
        });

        function pagination() {
            document.querySelector('#tabs ul li a[aria-current="page"]').click();
        }

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('[id^="genre-"]').forEach(function(element) {
                let genre = element.getAttribute('data-genre').toLowerCase();
                if (genre === 'f') {
                    element.textContent = 'Féminin';
                } else if (genre === 'm') {
                    element.textContent = 'Masculin';
                } else {
                    element.textContent = 'Non spécifié';
                }
            });

            const searchInput = document.getElementById('search');
            const items = document.querySelectorAll('#recherche');
            const divPagination = document.getElementById('divPagination');
            const divRecherche = document.getElementById('divRecherche');

            searchInput.addEventListener('input', function() {
                const query = searchInput.value.toLowerCase();

                let visibiite = false;
                if (query === '') {
                    divRecherche.classList.add(
                        'hidden');
                    items.forEach(item => {
                        item.style.display = 'block';
                    });
                    divPagination.classList.remove(
                        'hidden');
                } else {
                    divRecherche.classList.remove(
                        'hidden');
                    items.forEach(item => {
                        const nameElement = item.querySelector('#h3Nom');
                        if (nameElement) {
                            const name = nameElement.textContent.toLowerCase();
                            if (name.includes(query)) {
                                item.style.display = 'block';
                                visibiite = true;
                            } else {
                                item.style.display = 'none';
                            }
                        }
                    });

                    if (visibiite) {
                        divPagination.classList.add(
                            'hidden');
                    } else {
                        divPagination.classList.remove('hidden');
                    }
                }
            });
        });

        function editer(event, url, noms, email, image, phaseId, telephone, genre) {
            event.preventDefault();
            const form = document.querySelector('#intervEdit-modal div form')
            form.setAttribute('action', url);

            const inputPhase = document.querySelector('#intervEdit-modal div form #phaseId')
            inputPhase.setAttribute('value', phaseId);


            const inputNom = document.querySelector('#intervEdit-modal div form div #name')
            inputNom.setAttribute('value', noms);

            const inputEmail = document.querySelector('#intervEdit-modal div form div #email')
            inputEmail.setAttribute('value', email);

            const inputTelephone = document.querySelector('#intervEdit-modal div form div #telephone')
            inputTelephone.setAttribute('value', telephone);

            const selectGenre = document.querySelector('#intervEdit-modal div form div #genre')

        }

        function passation(event, url, phaseId, typePhase, passPourcent) {
            event.preventDefault();
            const form = document.querySelector('#pass-modal form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#pass-modal form #phaseId')
            inputPhaseId.setAttribute('value', phaseId);

            const inputType = document.querySelector('#pass-modal form #typePhase')
            inputType.setAttribute('value', typePhase);

            const passPourcentCheck = document.querySelector('#pass-modal form #passPourcent')
            const getNombPass = document.querySelector('#pass-modal form #getNombPass');
            const buttonValider = document.querySelector('#pass-modal form #validPass');
            const annulerValider = document.querySelector('#pass-modal form #annuler');
            const modifierValider = document.querySelector('#pass-modal form #modifier');
            const pourcent_candidat = document.querySelector('#pass-modal form #pourcent_candidat');
            const pourcentDiv = document.querySelector('#pass-modal form #pourcentDiv');
            const insertPass = document.querySelector('#pass-modal #insertPass');
            const editPass = document.querySelector('#pass-modal #editPass');
            const ajoutPass = document.querySelector('#pass-modal #ajoutPass');
            ajoutPass.style.display = 'none';
            passPourcentCheck.checked = false;

            console.log(passPourcent)
            if (passPourcent != null) {
                passPourcentCheck.style.display = 'none';
                pourcent_candidat.style.display = 'none';
                pourcent_candidat.setAttribute('value', passPourcent);
                getNombPass.textContent = passPourcent;
                buttonValider.style.display = 'none';
                pourcentDiv.style.display = 'none';
                modifierValider.style.display = 'flex';
                annulerValider.style.display = 'none';
                insertPass.style.display = 'flex';
                editPass.style.display = 'none';
            } else {
                passPourcentCheck.checked = true;
                passPourcentCheck.style.display = 'flex';
                pourcent_candidat.style.display = 'flex';
                pourcent_candidat.setAttribute('value', 50);
                pourcentDiv.style.display = 'block';
                buttonValider.style.display = 'flex';
                modifierValider.style.display = 'none';
                annulerValider.style.display = 'none';
                insertPass.style.display = 'flex';
                editPass.style.display = 'none';
            }
        }
    </script>
</x-app-layout>
