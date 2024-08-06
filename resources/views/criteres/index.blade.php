<x-app-layout>
    <x-slot name="header">
        <div class="">
            <div class="float-right">
                <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="bottom"
                    type="button"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path
                            d="M8 2a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM8 6.5a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM9.5 12.5a1.5 1.5 0 1 0-3 0 1.5 1.5 0 0 0 3 0Z" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownLeft"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-15 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-1 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
                        <li style="margin-right: 0.2rem; margin-left: 0.2rem;">
                            <a href="{{ route('phases.edit', $phase_id) }}"
                                class="block px-3 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white rounded-md ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        </li>
                        <li style="margin-right: 0.2rem; margin-left: 0.2rem;">
                            <a onclick="supprimer(event, '{{ route('phases.destroy', $phase_id) }}')"
                                data-modal-target="delete-modal" data-modal-toggle="delete-modal" href="#"
                                class="block px-3 py-2 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white rounded-md ">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-5">
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
                @foreach ($phases as $phase)
                    {{ $phase->decrip_phase }}
                @endforeach
            </p>
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
            <div class="float-right">
                <?php $message = 'Voulez-vous clôturer cette phase?'; ?>
                <a id="closeVote" href="#" data-modal-target="status-modal" data-modal-toggle="status-modal"
                    onclick="status(event, '{{ $message }}' , '{{ route('phases.status', ['status' => 'Cloturer', 'id' => $phase_id]) }}')"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
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
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
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

    <div class=" relative overflow-x-auto shadow-md" style="padding-top: 10px;">

        @if (session('successStatus'))
            <div id="alert-3-jury-modif"
                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                role="alert">
                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                    fill="currentColor" viewBox="0 0 20 20">
                    <path
                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                </svg>
                <span class="sr-only">Info</span>
                <div class="ms-3 text-sm font-medium">
                    {{ session('successStatus') }}
                </div>
                <button type="button"
                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                    data-dismiss-target="#alert-3-jury-modif" aria-label="Close">
                    <span class="sr-only">Close</span>
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                    </svg>
                </button>
            </div>
        @endif

        <div id="accordion-open-jury" data-accordion="open">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight "
                id="accordion-open-jury-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-b border-gray-200  focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                    data-accordion-target="#accordion-open-jury-body-1" aria-expanded="false"
                    aria-controls="accordion-open-jury-body-1">
                    <span class="flex items-center">Détails des jurys</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-open-jury-body-1" class="hidden" aria-labelledby="accordion-open-jury-heading-1">
                <div class="p-2 border border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                    <div class="relative overflow-x-auto shadow-md" style="padding-top: 10px;">
                        <div class="bg-white dark:bg-gray-800 shadow">
                            <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight"
                                        style="text-transform: uppercase">
                                        {{ $type_vote }}
                                    </h3>
                                    <a onclick="ajouter(event, '{{ route('jurys.store') }}', '{{ $phase_id }}', '{{ $ponderation_public }}', '{{ $ponderation_prive }}', '{{ $type_vote }}')"
                                        data-modal-target="create-modal-jury" data-modal-toggle="create-modal-jury"
                                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
                        @if (session('successModifJury'))
                            <div id="alert-3-jury-modif"
                                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    {{ session('successModifJury') }}
                                </div>
                                <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-3-jury-modif" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @elseif (session('successInsertJury'))
                            <div id="alert-3-jury-insert"
                                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    {{ session('successInsertJury') }}
                                </div>
                                <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-3-jury-insert" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @elseif (session('successDeleteJury'))
                            <div id="alert-3-jury-delete"
                                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z" />
                                </svg>
                                <span class="sr-only">Info</span>
                                <div class="ms-3 text-sm font-medium">
                                    {{ session('successDeleteJury') }}
                                </div>
                                <button type="button"
                                    class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700"
                                    data-dismiss-target="#alert-3-jury-delete" aria-label="Close">
                                    <span class="sr-only">Close</span>
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                        <div id="printDiv" class="py-2 px-8 float-right">
                            <a id="showQrCodesButton"
                                onclick="print(event, '{{ $phase_id }}', '{{ $type_vote }}')"
                                data-modal-target="print-modal" data-modal-toggle="print-modal" href="#"
                                class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-4">
                                    <path fill-rule="evenodd"
                                        d="M4 5a2 2 0 0 0-2 2v3a2 2 0 0 0 1.51 1.94l-.315 1.896A1 1 0 0 0 4.18 15h7.639a1 1 0 0 0 .986-1.164l-.316-1.897A2 2 0 0 0 14 10V7a2 2 0 0 0-2-2V2a1 1 0 0 0-1-1H5a1 1 0 0 0-1 1v3Zm1.5 0V2.5h5V5h-5Zm5.23 5.5H5.27l-.5 3h6.459l-.5-3Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <p class="flex justify-inline items-center">Imprimer les QrCodes</p>
                            </a>
                        </div>
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-2">N°</th>
                                    <th scope="col" class="py-2">type</th>
                                    <th scope="col" class="py-2">coupon</th>
                                    <th scope="col" class="py-2">is_use</th>
                                    <th scope="col" class="py-2">QrCode</th>
                                    <th scope="col" class="py-2">action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    usort($jurys, function ($a, $b) {
                                        if ($a->type == $b->type) {
                                            return 0;
                                        }
                                        return $a->type == 'prive' ? -1 : 1;
                                    });
                                @endphp
                                @foreach ($jurys as $i => $item)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-2">{{ $juryPhases->firstItem() + $i }}</td>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->type }}
                                        </th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->coupon }}
                                        </th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->is_use }}
                                        </th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a type="button" data-modal-target="qrcode-modal{{ $item->id }}"
                                                data-modal-toggle="qrcode-modal{{ $item->id }}" href="#"
                                                class="py-2 px-2 text-xs font-medium text-center inline-flex items-center text-white bg-gray-700 rounded-lg hover:bg-gray-800 focus:ring-4 focus:outline-none focus:ring-gray-300 dark:bg-gray-600 dark:hover:bg-gray-700 dark:focus:ring-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="size-4">
                                                    <path d="M4.75 4.25a.5.5 0 1 0 0 1 .5.5 0 0 0 0-1Z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 3.5A1.5 1.5 0 0 1 3.5 2H6a1.5 1.5 0 0 1 1.5 1.5V6A1.5 1.5 0 0 1 6 7.5H3.5A1.5 1.5 0 0 1 2 6V3.5Zm1.5 0H6V6H3.5V3.5Z"
                                                        clip-rule="evenodd" />
                                                    <path d="M4.25 11.25a.5.5 0 1 1 1 0 .5.5 0 0 1-1 0Z" />
                                                    <path fill-rule="evenodd"
                                                        d="M2 10a1.5 1.5 0 0 1 1.5-1.5H6A1.5 1.5 0 0 1 7.5 10v2.5A1.5 1.5 0 0 1 6 14H3.5A1.5 1.5 0 0 1 2 12.5V10Zm1.5 2.5V10H6v2.5H3.5Z"
                                                        clip-rule="evenodd" />
                                                    <path d="M11.25 4.25a.5.5 0 1 0 0 1 .5.5 0 0 0 0-1Z" />
                                                    <path fill-rule="evenodd"
                                                        d="M10 2a1.5 1.5 0 0 0-1.5 1.5V6A1.5 1.5 0 0 0 10 7.5h2.5A1.5 1.5 0 0 0 14 6V3.5A1.5 1.5 0 0 0 12.5 2H10Zm2.5 1.5H10V6h2.5V3.5Z"
                                                        clip-rule="evenodd" />
                                                    <path
                                                        d="M8.5 9.417a.917.917 0 1 1 1.833 0 .917.917 0 0 1-1.833 0ZM8.5 13.083a.917.917 0 1 1 1.833 0 .917.917 0 0 1-1.833 0ZM13.083 8.5a.917.917 0 1 0 0 1.833.917.917 0 0 0 0-1.833ZM12.166 13.084a.917.917 0 1 1 1.833 0 .917.917 0 0 1-1.833 0ZM11.25 10.333a.917.917 0 1 0 0 1.833.917.917 0 0 0 0-1.833Z" />
                                                </svg>
                                            </a>
                                        </th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a onclick="supprimer(event, '{{ route('jury.destroy', ['jury' => $item->id, 'phaseId' => $phase_id]) }}');"
                                                data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                                href="#"
                                                class="py-2 px-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                        clip-rule="evenodd" />
                                                </svg>

                                            </a>
                                        </th>
                                    </tr>
                                    <div id="qrcode-modal{{ $item->id }}" tabindex="-1" aria-hidden="true"
                                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                        <div class="relative overflow-x-auto sm:rounded-lg bg-white rounded-lg shadow dark:bg-gray-800"
                                            style="width: 80%;">
                                            <div
                                                class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white"
                                                    style="display: flex; flex-direction: column; justify-content: center; align-items: center;">
                                                    Veuillez scanner le QrCode</h3>
                                                </h3>
                                                <button type="button"
                                                    class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                    data-modal-toggle="qrcode-modal{{ $item->id }}">
                                                    <svg class="w-3 h-3" aria-hidden="true"
                                                        xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 14 14">
                                                        <path stroke="currentColor" stroke-linecap="round"
                                                            stroke-linejoin="round" stroke-width="2"
                                                            d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                            </div>
                                            <div
                                                style="display: flex; flex-direction: column; justify-content: center; align-items: center; height: 90vh;">
                                                <h2 class="text-white" style="margin: 20px; font-size:50px">
                                                    @foreach ($phases as $phase)
                                                        {{ $phase->nom_event }}
                                                    @endforeach
                                                </h2>
                                                <div id="qrcodeUnique">
                                                    {{ $item->qr_code }}
                                                </div>
                                                <h2 id="couponH2" class="text-white"
                                                    style="margin-top: 20px; font-size:50px">
                                                    {{ $item->coupon }}
                                                </h2>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{ $juryPhases->withPath(request()->url())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class=" relative overflow-x-auto shadow-md" style="padding-top: 10px;">
        <div id="accordion-open" data-accordion="open">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight "
                id="accordion-open-heading-1">
                <button type="button"
                    class="flex items-center justify-between w-full p-3 font-medium rtl:text-right text-gray-500 border border-b border-gray-200  focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-800 dark:border-gray-700 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 gap-3"
                    data-accordion-target="#accordion-open-body-1" aria-expanded="false"
                    aria-controls="accordion-open-body-1">
                    <span class="flex items-center">Détails des candidats</span>
                    <svg data-accordion-icon class="w-3 h-3 rotate-180 shrink-0" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 5 5 1 1 5" />
                    </svg>
                </button>
            </h2>
            <div id="accordion-open-body-1" class="hidden" aria-labelledby="accordion-open-heading-1">
                <div class="p-2 border border-b border-gray-200 dark:border-gray-700 dark:bg-gray-900">
                    <div class="relative overflow-x-auto shadow-md" style="padding-top: 10px;">
                        <div class="bg-white dark:bg-gray-800 shadow">
                            <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8">
                                <div class="flex justify-between items-center">
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight ">
                                        {{ __('Insertion des candidats') }}
                                    </h3>
                                    <a onclick="inserer(event, '{{ route('intervenants.store') }}', '{{ $phase_id }}')"
                                        data-modal-target="create-modal-candidat"
                                        data-modal-toggle="create-modal-candidat"
                                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
                        @if (session('successCand'))
                            <div id="alert-3-cand"
                                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-2">N°</th>
                                    <th scope="col" class="py-2">Nom</th>
                                    <th scope="col" class="py-2">Email</th>
                                    <th scope="col" class="py-2">Image</th>
                                    <th scope="col" class="py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intervenants as $i => $item)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-2">{{ $intervenantPhases->firstItem() + $i }}</td>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->nom_groupe }}</th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->email }}</th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <img src="{{ $item->image ? asset($item->image) : asset('images/profil.jpg') }}"
                                                width="40" height="40" class="img img-responsive" />
                                        </th>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            <a onclick="supprimer(event, '{{ route('intervenant.destroy', ['intervenant' => $item->id, 'phaseId' => $phase_id]) }}');"
                                                data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                                href="#"
                                                class="py-2 px-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M5 3.25V4H2.75a.75.75 0 0 0 0 1.5h.3l.815 8.15A1.5 1.5 0 0 0 5.357 15h5.285a1.5 1.5 0 0 0 1.493-1.35l.815-8.15h.3a.75.75 0 0 0 0-1.5H11v-.75A2.25 2.25 0 0 0 8.75 1h-1.5A2.25 2.25 0 0 0 5 3.25Zm2.25-.75a.75.75 0 0 0-.75.75V4h3v-.75a.75.75 0 0 0-.75-.75h-1.5ZM6.05 6a.75.75 0 0 1 .787.713l.275 5.5a.75.75 0 0 1-1.498.075l-.275-5.5A.75.75 0 0 1 6.05 6Zm3.9 0a.75.75 0 0 1 .712.787l-.275 5.5a.75.75 0 0 1-1.498-.075l.275-5.5a.75.75 0 0 1 .786-.711Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </a>
                                            <a onclick="editer(event, '{{ route('intervenants.update', $item->id) }}', '{{ $item->nom_groupe }}', '{{ $item->email }}', '{{ asset($item->image) }}', '{{ $phase_id }}')"
                                                data-modal-target="edit-modal-candidat"
                                                data-modal-toggle="edit-modal-candidat" href="#"
                                                class="py-2 px-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16"
                                                    fill="currentColor" class="size-4">
                                                    <path
                                                        d="M13.488 2.513a1.75 1.75 0 0 0-2.475 0L6.75 6.774a2.75 2.75 0 0 0-.596.892l-.848 2.047a.75.75 0 0 0 .98.98l2.047-.848a2.75 2.75 0 0 0 .892-.596l4.261-4.262a1.75 1.75 0 0 0 0-2.474Z" />
                                                    <path
                                                        d="M4.75 3.5c-.69 0-1.25.56-1.25 1.25v6.5c0 .69.56 1.25 1.25 1.25h6.5c.69 0 1.25-.56 1.25-1.25V9A.75.75 0 0 1 14 9v2.25A2.75 2.75 0 0 1 11.25 14h-6.5A2.75 2.75 0 0 1 2 11.25v-6.5A2.75 2.75 0 0 1 4.75 2H7a.75.75 0 0 1 0 1.5H4.75Z" />
                                                </svg>


                                            </a>
                                        </th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{ $intervenantPhases->withPath(request()->url())->links() }}
                        </div>
                    </div>
                </div>
                <div class="relative overflow-x-auto shadow-md" style="padding-top: 10px;">
                    <div class="bg-white dark:bg-gray-800 shadow">
                        <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8">
                            <div class="flex justify-between items-center">
                                <a href="#"
                                    onclick="passation(event, '{{ route('passation') }}', '{{ $phase_id }}')"
                                    data-modal-target="pass-modal" data-modal-toggle="pass-modal"
                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    Regle de passation
                                </a>
                                <a href="{{ route('results', $phase_id) }}"
                                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                        class="size-4 mr-2">
                                        <path
                                            d="M2.995 1a.625.625 0 1 0 0 1.25h.38v2.125a.625.625 0 1 0 1.25 0v-2.75A.625.625 0 0 0 4 1H2.995ZM3.208 7.385a2.37 2.37 0 0 1 1.027-.124L2.573 8.923a.625.625 0 0 0 .439 1.067l1.987.011a.625.625 0 0 0 .006-1.25l-.49-.003.777-.776c.215-.215.335-.506.335-.809 0-.465-.297-.957-.842-1.078a3.636 3.636 0 0 0-1.993.121.625.625 0 1 0 .416 1.179ZM2.625 11a.625.625 0 1 0 0 1.25H4.25a.125.125 0 0 1 0 .25H3.5a.625.625 0 1 0 0 1.25h.75a.125.125 0 0 1 0 .25H2.625a.625.625 0 1 0 0 1.25H4.25a1.375 1.375 0 0 0 1.153-2.125A1.375 1.375 0 0 0 4.25 11H2.625ZM7.25 2a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6ZM7.25 7.25a.75.75 0 0 0 0 1.5h6a.75.75 0 0 0 0-1.5h-6ZM6.5 13.25a.75.75 0 0 1 .75-.75h6a.75.75 0 0 1 0 1.5h-6a.75.75 0 0 1-.75-.75Z" />
                                    </svg>
                                    Résultats des votes
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-x-auto shadow-md" style="padding-top: 10px;">
        <div class="bg-white dark:bg-gray-800 shadow">
            <div class="mx-auto py-2 px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center">
                    <h3 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                        {{ __('Détails des critères') }}
                    </h3>
                    <a onclick="creer(event, {{ $phase_id }})" data-modal-target="create-modal"
                        data-modal-toggle="create-modal"
                        class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
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
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <th scope="col" class="px-6 py-3">Num</th>
                    <th scope="col" class="px-6 py-3">Libellé</th>
                    <th scope="col" class="px-6 py-3">description</th>
                    <th scope="col" class="px-6 py-3">ponderation</th>
                    <th scope="col" class="px-6 py-3">action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($criteres as $i => $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-4">{{ $i + 1 }}</td>
                        <th scope="row"
                            class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->libelle }}</th>
                        <td class="px-6 py-4">{{ $item->description }}</td>
                        <td class="px-6 py-4">{{ $item->ponderation }}</td>
                        <td class="px-6 ">
                            <button id="dropdownMenuIconButton"
                                data-dropdown-toggle="dropdownDots{{ $i }}"
                                class="inline-flex items-center p-2 text-sm font-medium text-center text-gray-900 bg-white rounded-lg hover:bg-gray-100 focus:ring-4 focus:outline-none dark:text-white focus:ring-gray-50 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                                type="button">
                                <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                    fill="currentColor" viewBox="0 0 4 15">
                                    <path
                                        d="M3.5 1.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 6.041a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Zm0 5.959a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0Z" />
                                </svg>
                            </button>
                            <!-- Dropdown menu -->
                            <div id="dropdownDots{{ $i }}"
                                class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-15 dark:bg-gray-700 dark:divide-gray-600">
                                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
                                    aria-labelledby="dropdownMenuIconButton">
                                    <li>
                                        <a href=""
                                            class="block px-4 py-2 hover:bg-yellow-100 dark:hover:bg-yellow-300 dark:hover:text-white border-2 rounded-md border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m11.25 11.25.041-.02a.75.75 0 0 1 1.063.852l-.708 2.836a.75.75 0 0 0 1.063.853l.041-.021M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9-3.75h.008v.008H12V8.25Z" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="modifier(event, '{{ route('criteres.update', $item->id) }}', '{{ $item->libelle }}', '{{ $item->description }}', '{{ $item->ponderation }}')"
                                            data-modal-target="edit-modal" data-modal-toggle="edit-modal"
                                            href="#"
                                            class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white border-2 rounded-md border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                            </svg>
                                        </a>
                                    </li>
                                    <li>
                                        <a onclick="supprimer(event, '{{ route('criteres.destroy', $item->id) }}');"
                                            data-modal-target="delete-modal" data-modal-toggle="delete-modal"
                                            href="#"
                                            class="block px-4 py-2 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white border-2 rounded-md border-gray-700">
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                class="size-6">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                            </svg>
                                        </a>
                                    </li>
                            </div>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="p-2">
            {{ $phaseCriteres->links() }}
        </div>

    </div>

    <x-delete :message="__('Voulez-vous vraiment supprimer?')" />
    <x-phases.status />
    <x-candidats.create />
    <x-candidats.edit />
    <x-criteres.create />
    <x-jurys.create />
    <x-criteres.edit />
    <x-qrcodes.printcode />
    <x-passations.pass />


    <script>
        window.onload = function() {
            initial("{{ $status_phase }}");
            printCheck("{{ $type_vote }}");
        };

        function initial(status_phase) {
            if (status_phase == 'En cours' || status_phase == 'en cours') {
                document.getElementById('enCours').hidden = true;
                document.getElementById('fermer').hidden = false;
                document.getElementById('closeVote').style.display = 'flex';
                document.getElementById('dropdownLeftButtonStatus').style.display = 'none';
            } else if (status_phase == 'Fermer' || status_phase == 'fermer') {
                document.getElementById('enCours').hidden = false;
                document.getElementById('fermer').hidden = true;
                document.getElementById('closeVote').style.display = 'none';
            } else {
                document.getElementById('closeVote').style.display = 'none';
                document.getElementById('dropdownLeftButtonStatus').style.display = 'none';
            }
        }

        function printCheck(typeVote) {
            printDiv = document.getElementById('printDiv');
            if (typeVote == '') {
                printDiv.style.display = 'none';
            }
        }

        function supprimer(event, url) {
            event.preventDefault();
            const form = document.querySelector('#delete-modal form')
            form.setAttribute('action', url);
        }

        function status(event, message, url) {
            event.preventDefault();
            const form = document.querySelector('#status-modal form')
            form.setAttribute('action', url);

            const messageH3 = document.querySelector('#status-modal h3')
            messageH3.textContent = message
        }

        function passation(event, url, phaseId) {
            event.preventDefault();
            const form = document.querySelector('#pass-modal form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#pass-modal form #phaseId')
            inputPhaseId.setAttribute('value', phaseId);
        }

        function modifier(event, url, libelle, description, ponderation) {
            event.preventDefault();
            const form = document.querySelector('#edit-modal form')
            form.setAttribute('action', url);

            const inputlibelle = document.querySelector('#edit-modal form div div #libelle')
            inputlibelle.setAttribute('value', libelle);

            const textdescription = document.querySelector('#edit-modal form div div #description')
            textdescription.textContent = description;

            const inputponderation = document.querySelector('#edit-modal form div div #ponderation')
            inputponderation.setAttribute('value', ponderation);
        }

        function creer(event, $phase_id) {
            event.preventDefault();
            const phaseSelect = document.querySelector('#create-modal form div div #phase');
            phaseSelect.setAttribute('value', $phase_id);
        }

        function inserer(event, url, phaseId) {
            event.preventDefault();
            const form = document.querySelector('#create-modal-candidat form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#create-modal-candidat form #phaseId')
            inputPhaseId.setAttribute('value', phaseId);
        }

        function ajouter(event, url, phaseId, ponderation_public, ponderation_prive, type_vote) {
            event.preventDefault();
            const form = document.querySelector('#create-modal-jury form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#create-modal-jury form #phaseId')
            inputPhaseId.setAttribute('value', phaseId);

            const inputPrive = document.querySelector('#create-modal-jury form #ponderation_prive');
            inputPrive.setAttribute('value', ponderation_prive);

            const inputPublic = document.querySelector('#create-modal-jury form #ponderation_public');
            inputPublic.setAttribute('value', ponderation_public);

            const ponderationPrive = document.querySelector('#create-modal-jury form #priveDiv');
            const ponderationPublic = document.querySelector('#create-modal-jury form #publicDiv');
            const typeDiv = document.querySelector('#create-modal-jury form #typeDiv');

            const numberPrive = document.querySelector('#create-modal-jury form #nombre_prive');
            const numberPriveInput = document.querySelector('#create-modal-jury form #nombre_prive_input');
            const selectType = document.querySelector('#create-modal-jury form #type');

            const ajoutPriveCheckbox = document.querySelector('#create-modal-jury form #ajoutPrive');
            const ajoutPublicCheckbox = document.querySelector('#create-modal-jury form #ajoutPublic')

            const ajoutDiv = document.querySelector('#create-modal-jury form #ajout');
            const ponderationPriveH2 = document.querySelector('#create-modal-jury form #getPondprive');
            const ponderationPublicH2 = document.querySelector('#create-modal-jury form #getPondpublic');

            const titreType = document.querySelector('#create-modal-jury form #titreType');
            const labelPrive1 = document.querySelector('#create-modal-jury form #label_prive');
            const labelPrive2 = document.querySelector('#create-modal-jury form #label_prive2');

            const labelPublic1 = document.querySelector('#create-modal-jury form #label_public');
            const labelPublic2 = document.querySelector('#create-modal-jury form #label_public2');

            const buttonEdit = document.querySelector('#create-modal-jury form #edit');
            const buttonAnnul = document.querySelector('#create-modal-jury form #annul');
            const infoPublic = document.querySelector('#create-modal-jury form #infoPublic');

            infoPublic.style.display = 'none';

            for (const option of selectType.options) {
                if (option.value === type_vote) {
                    option.selected = true;

                    const selectedType = type_vote;

                    if (selectedType === 'prive et public') {
                        ponderationPrive.style.display = 'none';
                        ponderationPublic.style.display = 'none';
                        typeDiv.style.display = 'none';
                        infoPublic.style.display = 'none';
                        ajoutDiv.style.display = 'block';
                        numberPrive.style.display = 'none';
                        numberPriveInput.setAttribute('value', 0);

                        inputPrive.disabled = true;
                        inputPublic.disabled = true;
                        selectType.disabled = true;

                        ajoutPublicCheckbox.checked = false;
                        ajoutPriveCheckbox.checked = false;

                        ponderationPriveH2.textContent = "P: " + ponderation_prive;
                        ponderationPublicH2.textContent = "P: " + ponderation_public;

                        buttonEdit.style.display = 'flex';
                        buttonAnnul.style.display = 'none';

                        titreType.style.display = 'flex';
                        const svgElement = titreType.querySelector('svg');
                        titreType.innerHTML = '';
                        titreType.appendChild(svgElement.cloneNode(true));
                        titreType.insertAdjacentHTML('beforeend', type_vote.toUpperCase());

                    } else if (selectedType === 'prive') {
                        ponderationPrive.style.display = 'block';
                        infoPublic.style.display = 'none';
                        ponderationPublic.style.display = 'none';
                        inputPrive.style.display = 'none';
                        typeDiv.style.display = 'none';
                        inputPrive.required = false;
                        inputPrive.disabled = true;
                        inputPublic.required = false;
                        selectType.disabled = true;
                        numberPriveInput.setAttribute('value', 1);
                        labelPrive1.style.display = 'none';
                        labelPrive2.style.display = 'none';

                        titreType.style.display = 'flex';
                        const svgElement = titreType.querySelector('svg');
                        titreType.innerHTML = '';
                        titreType.appendChild(svgElement.cloneNode(true));
                        titreType.insertAdjacentHTML('beforeend', type_vote.toUpperCase());

                        ajoutDiv.style.display = 'none';
                        ajoutPublicCheckbox.checked = false;
                        ajoutPriveCheckbox.checked = true;
                        buttonEdit.style.display = 'none';
                        buttonAnnul.style.display = 'none';

                    } else if (selectedType === 'public') {
                        ponderationPrive.style.display = 'none';
                        ponderationPublic.style.display = 'none';
                        typeDiv.style.display = 'none';
                        infoPublic.style.display = 'block';
                        inputPrive.required = false;
                        inputPublic.required = false;
                        inputPublic.disabled = true;
                        selectType.disabled = true;

                        labelPublic1.style.display = 'none';
                        labelPublic2.style.display = 'none';
                        titreType.style.display = 'flex';
                        const svgElement = titreType.querySelector('svg');
                        titreType.innerHTML = '';
                        titreType.appendChild(svgElement.cloneNode(true));
                        titreType.insertAdjacentHTML('beforeend', type_vote.toUpperCase());

                        ajoutDiv.style.display = 'none';
                        ajoutPublicCheckbox.checked = true;
                        ajoutPriveCheckbox.checked = false;
                        buttonEdit.style.display = 'none';
                        buttonAnnul.style.display = 'none';
                    }
                    break;
                } else {
                    ajoutPublicCheckbox.checked = true;
                    ajoutPriveCheckbox.checked = true;
                    ajoutDiv.style.display = 'none';
                    ajoutPublicCheckbox.value = 1;
                    numberPriveInput.setAttribute('value', 1);
                    titreType.style.display = 'none';
                    buttonEdit.style.display = 'none';
                    buttonAnnul.style.display = 'none';
                }
            }
        }

        // section candidats

        function editer(event, url, nomGroupe, email, image, phaseId) {
            event.preventDefault();
            const form = document.querySelector('#edit-modal-candidat div form')
            form.setAttribute('action', url);

            const inputPhase = document.querySelector('#edit-modal-candidat div form #phaseId')
            inputPhase.setAttribute('value', phaseId);


            const inputNom = document.querySelector('#edit-modal-candidat div form div #name')
            inputNom.setAttribute('value', nomGroupe);

            const inputEmail = document.querySelector('#edit-modal-candidat div form div #email')
            inputEmail.setAttribute('value', email);

        }



        function print(event, phaseId, type) {

            event.preventDefault();
            const phase = document.querySelector('#print-modal #idPhase')
            phase.setAttribute('value', phaseId);

            const nombreInp = document.querySelector('#print-modal #nombrePublic');
            const numPrive = document.querySelector('#print-modal #numPrive');

            nombreInp.setAttribute('value', 0)
            numPrive.setAttribute('value', 0);

            const printPriveCheckbox = document.querySelector('#print-modal #printPrive');
            const printPublicCheckbox = document.querySelector('#print-modal #printPublic');
            const numberDiv = document.querySelector('#print-modal #numberDiv');
            const checkDiv = document.querySelector('#print-modal #ajout');
            const typeVote = document.querySelector('#print-modal #typeVote');
            const infoPrive = document.querySelector('#print-modal #infoPrive');

            typeVote.setAttribute('value', type);

            if (type === 'prive et public') {
                numberDiv.style.display = 'none';
                infoPrive.style.display = 'none';
                printPriveCheckbox.checked = false;
                printPublicCheckbox.checked = false;

            } else if (type === 'prive') {

                numberDiv.style.display = 'none';
                checkDiv.style.display = 'none';
                numPrive.setAttribute('value', 1);
                printPriveCheckbox.checked = true;
                printPublicCheckbox.checked = false;
            } else if (type === 'public') {
                numberDiv.style.display = 'block';
                infoPrive.style.display = 'none';
                checkDiv.style.display = 'none';
                nombreInp.setAttribute('value', 1)
                printPriveCheckbox.checked = false;
                printPublicCheckbox.checked = true;
            }

        }
    </script>
</x-app-layout>
