<x-app-layout>
    <x-slot name="header">
        <div class="">
            <div class="float-right">
                <button id="dropdownLeftButton" data-dropdown-toggle="dropdownLeft" data-dropdown-placement="bottom"
                    type="button"
                    class="px-3 py-2 text-sm font-medium text-center inline-flex items-center text-white bg-[#FF9119] hover:bg-[#FF9119]/80 focus:ring-4 focus:outline-none focus:ring-[#FF9119]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF9119]/80 dark:focus:ring-[#FF9119]/40">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor" class="size-4">
                        <path fill-rule="evenodd"
                            d="M2 3.75A.75.75 0 0 1 2.75 3h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 3.75ZM2 8a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75A.75.75 0 0 1 2 8Zm0 4.25a.75.75 0 0 1 .75-.75h10.5a.75.75 0 0 1 0 1.5H2.75a.75.75 0 0 1-.75-.75Z"
                            clip-rule="evenodd" />
                    </svg>
                </button>
                <!-- Dropdown menu -->
                <div id="dropdownLeft"
                    class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-15 dark:bg-gray-700 dark:divide-gray-600">
                    <ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownLeftButton">
                        <li>
                            <a href="{{ route('phases.edit', $phase_id) }}"
                                class="block px-4 py-2 hover:bg-blue-100 dark:hover:bg-blue-600 dark:hover:text-white border-2 rounded-md border-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                </svg>
                            </a>
                        </li>
                        <li>
                            <a href=""
                                class="block px-4 py-2 hover:bg-red-100 dark:hover:bg-red-600 dark:hover:text-white border-2 rounded-md border-gray-700">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor" class="size-6">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                </svg>
                            </a>
                        </li>
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
        </div>
    </x-slot>

    <div class=" relative overflow-x-auto shadow-md" style="padding-top: 10px;">
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
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-200 leading-tight" style="text-transform: uppercase">
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

                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-2">N°</th>
                                    <th scope="col" class="py-2">type</th>
                                    <th scope="col" class="py-2">coupon</th>
                                    <th scope="col" class="py-2">is_use</th>
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
                    <span class="flex items-center">Détails des intervenants</span>
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
                                        data-modal-target="create-modal-interv"
                                        data-modal-toggle="create-modal-interv"
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
                        @if (session('success'))
                            <div id="alert-3"
                                class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400"
                                role="alert">
                                <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
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
                                    <th scope="col" class="py-2">Email</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($intervenants as $i => $item)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-2">{{ $intervenantPhases->firstItem() + $i }}</td>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->email }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{ $intervenantPhases->withPath(request()->url())->links() }}
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
    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
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
                <tr>
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
    <x-delete :message="__('Voulez-vous vraiment supprimer cet jury?')" />
    <x-intervenants.create />
    <x-criteres.create />
    <x-jurys.create />
    <x-criteres.edit />
    <script>
        function supprimer(event, url) {
            event.preventDefault();
            const form = document.querySelector('#delete-modal form')
            form.setAttribute('action', url);
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
            const form = document.querySelector('#create-modal-interv form')
            form.setAttribute('action', url);

            const inputPhaseId = document.querySelector('#create-modal-interv form #phaseId')
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

            for (const option of selectType.options) {
                if (option.value === type_vote) {
                    option.selected = true;

                    const selectedType = type_vote;

                    if (selectedType === 'prive et public') {
                        ponderationPrive.style.display = 'none';
                        ponderationPublic.style.display = 'none';
                        typeDiv.style.display = 'none';
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

                        titreType.style.display = 'flex';

                        const svgElement = titreType.querySelector('svg');
                        titreType.innerHTML = '';
                        titreType.appendChild(svgElement.cloneNode(true));
                        titreType.insertAdjacentHTML('beforeend', type_vote.toUpperCase());
                        buttonEdit.style.display = 'flex';
                        buttonAnnul.style.display = 'none';

                    } else if (selectedType === 'prive') {
                        ponderationPrive.style.display = 'block';
                        ponderationPublic.style.display = 'none';

                        typeDiv.style.display = 'none';
                        inputPrive.required = true;
                        inputPrive.disabled = true;
                        inputPublic.required = false;
                        selectType.disabled = true;
                        numberPriveInput.setAttribute('value', 1);
                        labelPrive1.style.display = 'none';
                        labelPrive2.style.display = 'block';

                        titreType.style.display = 'flex';
                        const svgElement = titreType.querySelector('svg');
                        titreType.innerHTML = '';
                        titreType.appendChild(svgElement.cloneNode(true));
                        titreType.insertAdjacentHTML('beforeend', type_vote.toUpperCase());

                        ajoutDiv.style.display = 'none';
                        ajoutPublicCheckbox.checked = false;
                        ajoutPriveCheckbox.checked = true;
                        buttonEdit.style.display = 'flex';
                        buttonAnnul.style.display = 'none';

                    } else if (selectedType === 'public') {
                        ponderationPrive.style.display = 'none';
                        ponderationPublic.style.display = 'block';
                        typeDiv.style.display = 'none';

                        inputPrive.required = false;
                        inputPublic.required = true;
                        inputPublic.disabled = true;
                        selectType.disabled = true;

                        labelPublic1.style.display = 'none';
                        labelPublic2.style.display = 'block';
                        titreType.style.display = 'flex';
                        const svgElement = titreType.querySelector('svg');
                        titreType.innerHTML = '';
                        titreType.appendChild(svgElement.cloneNode(true));
                        titreType.insertAdjacentHTML('beforeend', type_vote.toUpperCase());

                        ajoutDiv.style.display = 'none';
                        ajoutPublicCheckbox.checked = true;
                        ajoutPriveCheckbox.checked = false;
                        buttonEdit.style.display = 'flex';
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
    </script>
</x-app-layout>
