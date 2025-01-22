@extends('layouts.template')

@section('content')
    <section id="voteUser" class="select-none">
        @if (!session('debut'))
            <div class="containe">
                <div class="flex justify-center items-center h-screen  ml-4 mr-4 md:ml-20 md:mr-20">
                    <div class="shadow-md rounded-lg bg-gray-200 dark:bg-slate-900 w-[100%] mb-3 pb-3 md:pt-3 md:pb-6">
                        <div class="questionnaire ">
                            <div id="step-instru" class="px-2 md:px-10">
                                <div class="mt-2 flex ">
                                    <ol
                                        class="flex justify-center items-center w-full p-3 space-x-4 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse overflow-hidden">
                                        <li class="flex items-center text-blue-600 dark:text-blue-500 truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                                1
                                            </span>
                                            Instruction
                                            <svg class="w-3 h-3 ms-1 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                            </svg>
                                        </li>
                                        <li class="flex items-center truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                2
                                            </span>
                                            Confirmation
                                            <svg class="w-3 h-3 ms-1 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                            </svg>
                                        </li>
                                        <li class="flex items-center truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                3
                                            </span>
                                            Validation
                                        </li>
                                    </ol>

                                </div>
                                <div class="relative overflow-x-auto sm:rounded-lg" style="padding-top: 10px;">
                                    <div
                                        class=" rounded-lg bg-gray-200 dark:bg-slate-900 w-[100%] max-h-64 md:max-h-80 overflow-y-auto">
                                        {{-- <h2 class="text-xl text-center mt-2 font-extrabold dark:text-white">
                                            INSTRUCTION</h2> --}}
                                        <p class="text-sm text-gray-500 dark:text-gray-400 pt-8 pb-6">
                                            {!! nl2br(e($phase->description)) !!}
                                        </p>
                                    </div>
                                    <button type="submit"
                                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40 hidden">
                                        Suivant
                                    </button>

                                    <button type="button" onclick="step('event')"
                                        class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                                        Suivant
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                            class="size-5">
                                            <path fill-rule="evenodd"
                                                d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                clip-rule="evenodd" />
                                        </svg>
                                    </button>
                                </div>
                            </div>

                            <div id="step-event" class=" px-2 md:px-10" style="display: none">
                                <div class="mt-2 flex ">
                                    <ol
                                        class="flex justify-center items-center w-full p-3 space-x-4 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse overflow-hidden">
                                        <li class="flex items-center text-gray-800 dark:text-gray-100 truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs text-blue-600 dark:text-blue-500 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            Instruction
                                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                            </svg>
                                        </li>
                                        <li class="flex items-center text-blue-600 dark:text-blue-500 truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                                2
                                            </span>
                                            Confirmation
                                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                    stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                            </svg>
                                        </li>
                                        <li class="flex items-center truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                                                3
                                            </span>
                                            Validation
                                        </li>
                                    </ol>

                                </div>
                                <div class="relative overflow-x-auto sm:rounded-lg" style="padding-top: 10px;">

                                    <div>
                                        <p
                                            class="mb-3 mt-3 flex items-center justify-center font-bold text-gray-500 dark:text-gray-400">
                                            Avis Important avant de commencer l'évaluation
                                        </p>
                                        <p class="mb-3 text-gray-500 dark:text-gray-400">
                                            Veuillez vous assurer que :
                                        </p>
                                        <ol class="space-y-2 text-gray-500 list-decimal list-inside dark:text-gray-400">
                                            <li>
                                                <span class="font-semibold text-gray-900 dark:text-white">Vous disposez de
                                                    suffisamment de temps pour compléter l'évaluation.</span>
                                            </li>
                                            <li>
                                                <span class="font-semibold text-gray-900 dark:text-white">Vous êtes connecté
                                                    à une connexion Internet stable.</span>
                                            </li>
                                            <li>
                                                <span class="font-semibold text-gray-900 dark:text-white">Vous êtes prêt et
                                                    disponible pour effectuer l'évaluation sans interruption.<span>
                                            </li>
                                        </ol>

                                        <p class="mb-3 mt-6 font-medium text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold text-gray-900 dark:text-white">Nota: </span>
                                            Une fois l'évaluation commencée, le temps imparti sera automatiquement pris en
                                            compte, et la fin de l'évaluation sera enregistrée.
                                        </p>

                                        <p class="mb-3 mt-3 flex items-center font-medium text-gray-500 dark:text-gray-400">
                                            Merci de votre compréhension et bonne chance !
                                        </p>
                                    </div>

                                    <div class="flex justify-between mt-5">
                                        <button type="submit"
                                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40 hidden">
                                            Suivant
                                        </button>

                                        <button type="button" onclick="step('instru')"
                                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd"
                                                    d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Précedent
                                        </button>

                                        <button type="button" onclick="step('phase')"
                                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                                            Suivant
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd"
                                                    d="M8.22 5.22a.75.75 0 0 1 1.06 0l4.25 4.25a.75.75 0 0 1 0 1.06l-4.25 4.25a.75.75 0 0 1-1.06-1.06L11.94 10 8.22 6.28a.75.75 0 0 1 0-1.06Z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <div id="step-phase" style="display: none" class=" px-2 md:px-10 mt-3">
                                <div class="">
                                    <ol
                                        class="flex justify-center items-center w-full p-3 space-x-4 text-sm font-medium text-center text-gray-500 bg-white border border-gray-200 rounded-lg shadow-sm dark:text-gray-400 sm:text-base dark:bg-gray-800 dark:border-gray-700 sm:p-4 sm:space-x-4 rtl:space-x-reverse overflow-hidden">
                                        <li class="flex items-center text-gray-800 dark:text-gray-100 truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs text-blue-600 dark:text-blue-500 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            Instruction
                                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                            </svg>
                                        </li>
                                        <li class="flex items-center text-gray-800 dark:text-gray-100 truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs text-blue-600 dark:text-blue-500 border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                    fill="currentColor" class="size-5">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                            </span>
                                            Confirmation
                                            <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true"
                                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                                                <path stroke="currentColor" stroke-linecap="round"
                                                    stroke-linejoin="round" stroke-width="2"
                                                    d="m7 9 4-4-4-4M1 9l4-4-4-4" />
                                            </svg>
                                        </li>
                                        <li class="flex items-center text-blue-600 dark:text-blue-500 truncate">
                                            <span
                                                class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                                                2
                                            </span>
                                            Validation
                                        </li>
                                    </ol>

                                </div>
                                <div class="relative overflow-x-auto sm:rounded-lg" style="padding-top: 30px;">
                                    <div
                                        class="justify-center items-center text-center grid gap-1 sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-2">
                                        <div class="">
                                            <div class="md:pl-10">
                                                <div class="flex justify-center mt-3">
                                                    <h2
                                                        class="mb-4 text-4xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white ">
                                                        <img class="w-10 h-10" src="{{ asset('img/momekano.png') }}"
                                                            alt="logo">
                                                        omekano
                                                    </h2>
                                                </div>
                                                <h5
                                                    class="px-6 mb-2 text-sm md:text-[15px] font-normal text-gray-500 dark:text-gray-400">
                                                    Rassurez-vous
                                                    d'avoir
                                                    répondu et soumis vos réponses avant de quitter la page d'évaluation.
                                                    <br>
                                                    N'oubliez pas que l'évaluation termine si votre temps expire
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="flex justify-center">
                                            <div class="rounded-lg relative">
                                                <form action="{{ route('phasequestion') }}" method="get"
                                                    class="bg-transparent text-white py-2 rounded-md">
                                                    @csrf
                                                    @method('get')
                                                    <input type="text" name="phase_id" id="getPhaseId" class="hidden"
                                                        value="{{ Session::get('phase_id') }}">
                                                    <input type="text" name="intervenant_id" id="getIntervenantId"
                                                        class="hidden" value="{{ Session::get('intervenant_id') }}">
                                                    <button type="submit"
                                                        class="w-full text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-xl md:text-xl px-5 py-2.5 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40  mb-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                            fill="currentColor" class="size-7 mr-2">
                                                            <path fill-rule="evenodd"
                                                                d="M10 2a.75.75 0 0 1 .75.75v7.5a.75.75 0 0 1-1.5 0v-7.5A.75.75 0 0 1 10 2ZM5.404 4.343a.75.75 0 0 1 0 1.06 6.5 6.5 0 1 0 9.192 0 .75.75 0 1 1 1.06-1.06 8 8 0 1 1-11.313 0 .75.75 0 0 1 1.06 0Z"
                                                                clip-rule="evenodd" />
                                                        </svg>
                                                        DEMARRER
                                                    </button>
                                                    {{-- <button type="submit" class="py-2 rounded-lg">
                                                <img src="{{ asset('img/button_demarer.png') }}" alt=""
                                                    class="rounded-lg w-[300px] h-[50px] md:w-[300px] md:h-[80px]">
                                            </button> --}}
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="flex justify-between mt-5">
                                        <button type="button" onclick="step('event')"
                                            class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-[#FF7900] hover:bg-[#FF7900]/80 focus:ring-4 focus:outline-none focus:ring-[#FF7900]/50 font-medium rounded-lg text-sm px-4 py-2 text-center inline-flex items-center dark:hover:bg-[#FF7900]/80 dark:focus:ring-[#FF7900]/40">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                                                fill="currentColor" class="size-5">
                                                <path fill-rule="evenodd"
                                                    d="M11.78 5.22a.75.75 0 0 1 0 1.06L8.06 10l3.72 3.72a.75.75 0 1 1-1.06 1.06l-4.25-4.25a.75.75 0 0 1 0-1.06l4.25-4.25a.75.75 0 0 1 1.06 0Z"
                                                    clip-rule="evenodd" />
                                            </svg>

                                            Précedent
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        @else
            <div class="py-3 px-3  md:px-16">

                <div
                    class=" mb-2 text-left justify-center items-center rounded-lg bg-gray-200 bg-opacity-95 border border-gray-300 border-opacity-90 rounded-lg shadow dark:bg-slate-900 dark:border-slate-900 dark:bg-opacity-95">

                    <div class="md:py-2 grid gap-1 sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-2">
                        <div class="mt-2 md:mt-5">
                            <p class="text-left dark:text-white pl-3 md:pl-10" id="place_question"></p>
                        </div>
                        <div class="pl-3 md:text-right">
                            <p id="heure_actuel" class="pr-12 dark:text-white"></p>
                            <p id="end-time" class="pr-12 mb-2 text-2xl dark:text-white"></p>
                        </div>
                    </div>
                </div>

                <div
                    class="text-left justify-center items-center rounded-lg bg-gray-200 bg-opacity-95 border border-gray-300 border-opacity-90 rounded-lg shadow py-4 sm:p-4 dark:bg-slate-900 dark:border-slate-900 dark:bg-opacity-95">
                    <div>
                        @if (session('success'))
                            <div id="alert-3"
                                class="flex items-center mt-3  p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 ml-3 mr-3 md:ml-10 md:mr-10"
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
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                        fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                            stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                    </svg>
                                </button>
                            </div>
                        @endif
                    </div>

                    <form action="{{ route('reponses.store') }}" method="post" id="fini_evaluation" class="">
                        @csrf
                        @method('post')
                        <input type="text" name="phase_id" id="" class="hidden"
                            value="{{ session()->get('phaseId') }}">
                        <input type="text" name="intervenant_id" id="" class="hidden"
                            value="{{ session()->get('intervenantId') }}">
                        @php
                            $tab = session('questionAssetionTab');
                            shuffle($tab);
                        @endphp

                        @foreach ($tab as $key => $value)
                            <div id="{{ $value['question']['question'] }}" value="{{ $value['question']['question'] }}"
                                class="hidden">
                                {{-- <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                class="size-8">
                                <path fill-rule="evenodd"
                                    d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-1.033.566-1.033 1.29v.25a.75.75 0 1 0 1.5 0v-.115a2.5 2.5 0 1 0-2.518-4.153.75.75 0 1 0 1.061 1.06Z"
                                    clip-rule="evenodd" />
                            </svg> --}}
                                <label class="flex gap-4 dark:text-white">
                                    <h5 class="hidden text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                        {!! nl2br(e($value['question']['question'])) !!}</h5>
                                    <h3 class="text-lg font-bold dark:text-white">
                                        {!! nl2br(e($value['question']['question'])) !!}</h3>
                                </label>

                                @php
                                    $assertions_tab = $value['assertion'];
                                    shuffle($assertions_tab);
                                @endphp
                                @foreach ($assertions_tab as $key1 => $assertions)
                                    @php
                                        $assertions_tab1 = $assertions->shuffle();
                                    @endphp

                                    @foreach ($assertions_tab1 as $i => $var)
                                        <div
                                            class="items-center ps-4 my-4 flex bg-gray-700 border border-gray-700 rounded-md dark:border-gray-300 dark:bg-gray-300 opacity-100">
                                            <input id="{{ $var->id }}" type="radio" value="{{ $var->id }}"
                                                name="id_collection_keyQuestion_valAssertion[{{ $value['question']['id'] }}]"
                                                onclick="handleAssertionChecked(this, '{{ $var->question_id }}');"
                                                class="assertion_cocher w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="{{ $var->id }}"
                                                class="w-full py-4 ms-2 text-sm font-medium text-gray-100 dark:text-black">{!! nl2br(e($var->assertion)) !!}</label>
                                        </div>
                                    @endforeach
                                @endforeach
                            </div>
                        @endforeach
                        <div class="inline-flex items-center gap-20 mb-3">
                            <!-- Buttons -->
                            <div id="precedent"
                                class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                                <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4" />
                                </svg>
                                Précédent
                            </div>
                            <div id="suivant"
                                onclick="sendResponse({{ session()->get('phaseId') }}, {{ session()->get('intervenantId') }})"
                                class="flex items-center justify-center px-4 h-10 ml-3 md:ml-6 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ">
                                Suivant
                                <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                                </svg>
                            </div>
                            <button type="submit" onclick="cleanstorage()" id="envoi_reponse"
                                class="hidden items-center justify-center p-8 px-4 h-10 text-base font-medium text-white bg-green-800 border-0 border-s border-green-700 rounded-e hover:bg-green-900 dark:bg-green-800 dark:border-green-700 dark:text-green-400 dark:hover:bg-green-700 dark:hover:text-white">
                                Terminer
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                    class="size-6 pl-2">
                                    <path fill-rule="evenodd"
                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16Zm3.857-9.809a.75.75 0 0 0-1.214-.882l-3.483 4.79-1.88-1.88a.75.75 0 1 0-1.06 1.061l2.5 2.5a.75.75 0 0 0 1.137-.089l4-5.5Z"
                                        clip-rule="evenodd" />
                                </svg>

                            </button>
                        </div>
                    </form>
                </div>

            </div>
        @endif

        {{-- modal d'alert  --}}

        <div id="detect-modal" tabindex="-1"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Attention, <br> Ne changez
                            pas de page ou réduisez la fenêtre. Cela pourrait annuler votre évaluation, et seules vos
                            réponses actuelles seront prises en compte.</h3>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400" id="nombreTente"></h3>
                        <button data-modal-hide="detect-modal" type="button" onclick="closeModalDetect()"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-[#FF7900] rounded-lg border border-[#FF7900]-200 hover:bg-[#FF7900]-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-[#FF7900]-100 dark:focus:ring-[#FF7900]-700 dark:bg-[#FF7900]-800 dark:text-[#FF7900]-400 dark:border-[#FF7900] dark:hover:text-white dark:hover:bg-[#FF7900]">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <div id="tenta-modal" tabindex="-1"
            class="hidden fixed inset-0 z-50 flex justify-center items-center bg-black bg-opacity-50">
            <div class="relative p-4 w-full max-w-md max-h-full">
                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                    <div class="p-4 md:p-5 text-center">
                        <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">
                            Votre évaluation a pris fin.<br>Nous comprenons que vous souhaitiez continuer, mais le temps
                            imparti ou les conditions de l'évaluation sont arrivés à leur terme.<br>Merci pour votre
                            compréhension.
                        </h3>
                        <button data-modal-hide="tenta-modal" type="button" onclick="closeModalTenta()"
                            class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-[#FF7900] rounded-lg border border-[#FF7900]-200 hover:bg-[#FF7900]-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-[#FF7900]-100 dark:focus:ring-[#FF7900]-700 dark:bg-[#FF7900]-800 dark:text-[#FF7900]-400 dark:border-[#FF7900] dark:hover:text-white dark:hover:bg-[#FF7900]">OK</button>
                    </div>
                </div>
            </div>
        </div>

        <input type="text" id="valuePhaseId" class="hidden" value="{{ session()->get('phaseId') }}">
        <input type="text" id="valueIntervenantId" class="hidden" value="{{ session()->get('intervenantId') }}">

    </section>
    <script>
        function getDarkMode() {
            return window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
        }

        // Applique le style en fonction du mode du navigateur
        function applyDarkMode() {
            const voteUser = document.getElementById('voteUser');
            if (getDarkMode()) {
                voteUser.classList.remove('light');
                voteUser.classList.add('dark');
            } else {
                voteUser.classList.remove('dark');
                voteUser.classList.add('light');
            }
        }

        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', applyDarkMode);
        applyDarkMode();

        //confirmation message 
        panelEvent = document.getElementById('step-event');
        panelPhase = document.getElementById('step-phase');
        panelInstru = document.getElementById('step-instru');


        function step(action) {
            panelInstru.style.transition = 'opacity 0.5s ease';
            panelEvent.style.transition = 'opacity 0.5s ease';
            panelPhase.style.transition = 'opacity 0.5s ease';
            if (action == 'instru') {
                panelEvent.style.opacity = '0';
                panelPhase.style.opacity = '0';
                setTimeout(() => {
                    panelInstru.style.display = 'block';
                    panelPhase.style.display = 'none';
                    panelEvent.style.display = 'none';
                    requestAnimationFrame(() => {
                        panelInstru.style.opacity = '1';
                    });
                }, 500);
            } else if (action == 'phase') {
                panelEvent.style.opacity = '0';
                setTimeout(() => {
                    panelInstru.style.display = 'none';
                    panelEvent.style.display = 'none';
                    panelPhase.style.display = 'block';
                    requestAnimationFrame(() => {
                        panelPhase.style.opacity = '1';
                    });
                }, 500);

            } else if (action == 'event') {
                panelPhase.style.opacity = '0';
                panelInstru.style.opacity = '0';
                setTimeout(() => {
                    panelInstru.style.display = 'none';
                    panelPhase.style.display = 'none';
                    panelEvent.style.display = 'block';
                    requestAnimationFrame(() => {
                        panelEvent.style.opacity = '1';
                    });
                }, 500);
            }
        }

        //script local storage
        const onStart = () => {
            const localData = JSON.parse(localStorage.getItem("COTES"))
            // console.log("localData", localData)
            let savedChoices = localData
            if (!localData) {
                savedChoices = {}
            }

            for (const [key, value] of Object.entries(savedChoices)) {
                //console.log(`${key}: ${value}`);
                //console.log(`[name="id_collection_keyQuestion_valAssertion${key}"]`)
                const inputs = document.querySelectorAll(`[name="id_collection_keyQuestion_valAssertion[${key}]"]`)
                for (input of inputs) {
                    const inputId = input.id

                    if (inputId == value) {
                        // console.log("input",input, inputId)
                        radiobtn = document.getElementById(inputId);
                        radiobtn.checked = true;
                    }
                }

            }
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

        document.addEventListener('DOMContentLoaded', function() {
            onStart()
        }, false);

        let questionSend = 0;
        const handleAssertionChecked = (input, questionId) => {
            // console.log(input.value, typeof input, questionId);

            const localData = JSON.parse(localStorage.getItem("COTES"))
            // console.log("localData", localData)
            let savedChoices = localData
            if (!localData) {
                savedChoices = {}
            }
            questionSend = questionId;
            savedChoices[questionId] = input.value
            localStorage.setItem("COTES", JSON.stringify(savedChoices))
        }

        function sendResponse(phaseId, intervenantId) {

            let dataSend = JSON.parse(localStorage.getItem("COTES")) || {};
            let responseSend = JSON.parse(localStorage.getItem("responseSend")) || {};

            if (typeof questionSend !== 'undefined' && questionSend !== 0) {
                const changes = {};
                for (const key in dataSend) {
                    if (dataSend[key] !== responseSend[key]) {
                        changes[key] = dataSend[key];
                    }
                }

                if (Object.keys(changes).length > 0) {
                    
                    const [
                        [questionId, assertionId]
                    ] = Object.entries(changes);


                    localStorage.setItem("responseSend", JSON.stringify(dataSend));

                    // Envoyer la requête fetch
                    fetch('/api/reponse-by-intervenant', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute(
                                    'content')
                            },
                            body: JSON.stringify({
                                questionId, // Envoyer la clé comme questionId
                                assertionId, // Envoyer la valeur comme assertionId
                                phaseId,
                                intervenantId
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log('Server response:', data);

                            let bloquer = data.bloquer;

                            if (bloquer === true) {
                                console.log("L'accès est bloqué.");
                                showModalTenta()
                            }
                        })
                        .catch((error) => {
                            console.error('Erreur lors de la requête:', error);
                        });

                } else {
                    console.log("No change detected");
                }
            }
        }


        const cleanstorage = () => {
            localStorage.clear();
        }

        //second script

        const data = JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`);

        if (data) {

            // const data =JSON.parse(data1);
            const tableauJSON = JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`);


            function afficherElement(index, hidden, precedent_item) {

                Fields = document.getElementById("InputFields");
                const tableauJSON = JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`);
                const item = tableauJSON[index];
                // console.log("Question :");
                // console.log(item.question.question)

                if (precedent_item == null) {
                    var question_actu = item.question.question;
                    var question_visible = document.getElementById(item.question.question);
                    var question_vue_form = question_visible.getAttribute('value');
                    question_visible.className = hidden;
                } else {
                    const item2 = tableauJSON[precedent_item]
                    var question_actu_pre = item2.question.question;
                    var question_visible_pre = document.getElementById(item2.question.question);
                    var question_vue_form_prev = question_visible_pre.getAttribute('value');
                    question_visible_pre.className = "hidden";

                    var question_actu = item.question.question;
                    var question_visible = document.getElementById(item.question.question);
                    var question_vue_form = question_visible.getAttribute('value');
                    question_visible.className = hidden;
                }

                // console.log("Assertions :");

                item.assertion.forEach(assertionGroup => {
                    assertionGroup.forEach(assertion => {
                        // console.log(`- Assertion ${assertion.id}: ${assertion.assertion}`);
                    });

                });
                // console.log("---");
            }
            let currentIndex = 0; // Indice de l'élément actu au chargement
            let hideClass = "p-3 md:p-6"
            //classe au chargement
            let element_precedent = null; //au chargement
            const buttonPrecedent = document.getElementById('precedent');
            const buttonSuivant = document.getElementById('suivant');
            const buttonTerminer = document.getElementById('envoi_reponse');
            const placeQuestion = document.getElementById('place_question');
            if (currentIndex <= 0) {
                buttonPrecedent.className = 'hidden';
                buttonTerminer.className = "hidden";
                placeQuestion.innerHTML = "Question: 1 / " + tableauJSON.length;
            }

            afficherElement(currentIndex, hideClass, element_precedent); // Afficher le premier élément au démarrage

            // Bouton Suivant
            document.getElementById("suivant").addEventListener("click", () => {

                if (currentIndex == tableauJSON.length - 1) {
                    buttonSuivant.className = "hidden";
                    placeQuestion.innerHTML = "Question: " + tableauJSON.length + " / " + tableauJSON.length;
                    buttonTerminer.className =
                        "flex items-center justify-center ml-3 md:ml-6 px-4 h-10 text-base font-medium text-white bg-green-800 border-0 border-s border-green-700 rounded-e hover:bg-green-900 dark:bg-green-800 dark:border-green-700 dark:text-green-400 dark:hover:bg-green-700 dark:hover:text-white"

                    console.log('fin, derniere question')

                } else {
                    currentIndex = (currentIndex + 1);
                    placeQuestion.innerHTML = "Question: " + (currentIndex + 1) + " / " + tableauJSON.length;
                    buttonTerminer.className = "hidden"
                    buttonPrecedent.className =
                        "flex items-center justify-center ml-3 md:ml-6 px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    element_precedent = currentIndex - 1;
                    afficherElement(currentIndex, hideClass, element_precedent)
                }
            });

            // Bouton Précédent
            document.getElementById("precedent").addEventListener("click", () => {
                if (currentIndex == 0) {
                    buttonPrecedent.className = "hidden"
                    buttonTerminer.className = "hidden"
                    placeQuestion.innerHTML = "Question: " + 1 + " / " + tableauJSON.length;
                    buttonSuivant.className =
                        "flex items-center justify-center ml-3 md:ml-6 px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    console.log('premiere qustion')
                } else {
                    currentIndex = (currentIndex - 1);
                    placeQuestion.innerHTML = "Question: " + (currentIndex + 1) + " / " + tableauJSON.length;
                    buttonTerminer.className = "hidden"
                    buttonSuivant.className =
                        "flex items-center justify-center ml-3 md:ml-6 px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    element_precedent = currentIndex + 1;
                    afficherElement(currentIndex, hideClass, element_precedent)
                }
            });

        } else {
            console.log('Cliquer sur demarrer pour charger les question')
            // La variable n'est pas définie
        }

        //3e script

        //script pour le chrono duree evaluation
        function paddedFormat(num) {
            return num < 10 ? '0' + num : num;
        }

        //compte à rebours
        function startCountDown(duration, element) {
            let secondsRemaining = duration;
            let min = 0;
            let sec = 0;

            let countInterval = setInterval(function() {
                min = parseInt(secondsRemaining / 60);
                sec = parseInt(secondsRemaining % 60);

                let textColor = 'black';

                if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                    textColor = 'white';
                }

                if (min < 10) {
                    textColor = 'red';
                }

                element.innerHTML =
                    `Il vous reste <span style="color: ${textColor};">${paddedFormat(min)}:${paddedFormat(sec)} min</span>`;

                const form = document.getElementById('fini_evaluation');
                if (`${paddedFormat(min)}` == 0 && `${paddedFormat(sec)}` == 0) {
                    form.submit();
                    cleanstorage();
                } else {
                    // console.log(`pas fini encore ${paddedFormat(min)} min - ${paddedFormat(sec)} sec`)
                }

                secondsRemaining = secondsRemaining - 1;
                if (secondsRemaining < 0) {
                    clearInterval(countInterval);
                }
            }, 1000);
        }


        // temps restant
        window.onload = function() {

            const dataTime = JSON.parse(`{!! addslashes(json_encode(session('duree_evaluation'))) !!}`);
            const starTime = JSON.parse(`{!! addslashes(json_encode(session('debut_evaluation_enreg'))) !!}`);


            if (dataTime != null) {
                var tabHeure = dataTime.split(":");
                const dureeHeure = tabHeure[0];
                const dureeMinute = tabHeure[1];
                const dureeSeconde = tabHeure[2];

                const date = new Date();
                const heure = date.getHours();
                const min = date.getMinutes();
                heure_actu = document.querySelector('#heure_actuel');
                heure_actu.textContent = "Date: " + starTime;

                let time_heure = dureeHeure; // Value in hours
                let time_minutes = parseInt(dureeMinute) + parseInt(dureeHeure * 60); // Value in minutes
                let time_seconds = parseInt(dureeSeconde); // Value in seconds
                let duration = time_minutes * 60 + time_seconds;

                element = document.querySelector('#end-time');
                element.textContent = `Il vous reste ${paddedFormat(time_minutes)}:${paddedFormat(time_seconds)} min`;
                startCountDown(--duration, element);
            }
        };

        //detetion de l'onglet
        document.addEventListener("visibilitychange", () => {
            const intervenantId = document.getElementById("valueIntervenantId").value;
            const phaseId = document.getElementById("valuePhaseId").value;
            const nombreTente = document.getElementById("nombreTente");
            let nombreTentation = 5;

            if (document.hidden) {
                console.log("Vous avez changé d'onglet ou réduit la fenêtre !");
            } else {
                let attempts = localStorage.getItem(`attempts${intervenantId}Ph${phaseId}`);

                if (attempts === null) {
                    attempts = 0;
                } else {
                    attempts = parseInt(attempts);
                }

                attempts++;

                localStorage.setItem(`attempts${intervenantId}Ph${phaseId}`, attempts);
                nombreTente.textContent = "Attention, il vous reste " + (nombreTentation - attempts) +
                    " tentative(s)";

                if (attempts > nombreTentation) {
                    console.log("Vous avez atteint le nombre maximum de tentatives !");
                    localStorage.removeItem(`attempts${intervenantId}Ph${phaseId}`);
                    const url = '/bloquerEvaluation'; // Adjust the URL as necessary
                    fetch(url, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .getAttribute(
                                        'content')
                            },
                            body: JSON.stringify({
                                intervenantId,
                                phaseId
                            })
                        })
                        .then((response) => response.json())
                        .then((data) => {
                            console.log('Server response:', data);
                            showModalTenta();

                        })
                        .catch((error) => {
                            console.error('Error sending data:', error);
                        });

                } else {
                    showModalDetect();
                }
            }
        });


        function showModalDetect() {
            const modal = document.getElementById('detect-modal');
            modal.classList.remove('hidden');
        }

        function closeModalDetect() {
            const modal = document.getElementById('detect-modal');
            modal.classList.add('hidden');
        }

        function showModalTenta() {
            const modal = document.getElementById('tenta-modal');
            modal.classList.remove('hidden');
        }

        function closeModalTenta() {
            const modal = document.getElementById('tenta-modal');
            modal.classList.add('hidden');
            cleanstorage()
            window.location.href = '/intervenant-logout';
            localStorage.removeItem(`attempts${intervenantId}Ph${phaseId}`);
        }
    </script>
@endsection
