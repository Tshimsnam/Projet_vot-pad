<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('img/orange.png') }}" type="image/x-icon">

    <title>{{ $title ?? 'VotePad2' }}</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Flowbite -->
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>

<body id="voteUser" class="">
    @if (!session('debut'))
        <div class="containe">

            {{-- <div class="flex  mb-10">
            <div>
                <img src="{{ asset('img/orange.png') }}" width="50">
            </div>
            <h1 class="text-3xl font-bold mb-4 dark:text-gray-300 ">Évaluation</h1>
        </div> --}}

            <div class="flex justify-center items-center h-screen ml-20 mr-20">
                <div class="shadow-md rounded-lg bg-slate-900 pt-8 pr-16 pb-8">
                    {{-- <p id="heure_actuel" class="  text-end dark:text-white"></p>
                <p id="end-time" class=" text-end dark:text-white"></p>

                <div>
                    @if (session('success'))
                        <div id="alert-3"
                            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 ml-6 mr-6"
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
                </div> --}}
                    <div class="questionnaire ">

                        <div
                            class="justify-center items-center px-16 py-16 text-center grid gap-1 sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-2">
                            <div class="h-160 w-290 ">

                                <div class="w-full">
                                    {{-- <div class="flex items-center p-1 gap-2 text-center justify-center m-2">
                                    <svg fill="#ff600a" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="80px" height="80px"
                                        viewBox="0 0 208 256" enable-background="new 0 0 208 256" xml:space="preserve"
                                        stroke="#ff600a">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                            stroke="#f5f4f4" stroke-width="9.984">
                                            <path
                                                d="M2,34c0,0,0,185.486,0,187c0,17.87,14.416,32.192,32.084,32.899V254H205.82v-9.288c-13.226,0-23.928-10.702-23.928-23.928 s10.702-23.928,23.928-23.928v-0.202V2H35.8C17.526,2,2,15.726,2,34z M172.603,220.683c0,9.389,4.038,17.87,10.298,23.928H35.397 c-13.226,0.101-24.029-10.702-24.029-23.928c0-12.519,9.793-22.817,22.111-23.726l149.726-0.303 C176.743,202.712,172.603,211.192,172.603,220.683z M57.083,68.051l12.596-3.231l-3.56-12.486c-0.986-3.614,2.41-6.955,5.969-5.969 l12.486,3.56l3.231-12.596c0.876-3.614,5.586-4.819,8.105-2.136l9.036,9.31l9.036-9.31c2.574-2.738,7.229-1.424,8.105,2.136 l3.231,12.596l12.486-3.56c3.614-0.986,6.955,2.41,5.969,5.969l-3.56,12.486l12.596,3.231c3.614,0.876,4.874,5.476,2.136,8.105 l-9.255,9.036l9.2,9.036c2.738,2.629,1.479,7.229-2.136,8.105l-12.596,3.231l3.56,12.486c0.986,3.614-2.41,6.955-5.969,5.969 l-12.267-3.505l17.524,34.884l-14.622-4.162l-4.052,13.526L104.946,126.1L85.56,164.762l-4.052-13.526l-14.622,4.162l17.524-34.884 l-12.267,3.505c-3.614,0.986-6.955-2.41-5.969-5.969l3.56-12.486l-12.596-3.231c-3.614-0.876-4.874-5.476-2.136-8.105l9.2-9.036 l-9.255-9.036C52.209,73.527,53.469,68.927,57.083,68.051z M106.041,115.53c16.758,0,30.284-13.581,30.284-30.339 c0-16.757-13.636-30.284-30.284-30.284c-16.758,0-30.284,13.581-30.284,30.339C75.757,102.004,89.283,115.53,106.041,115.53z M89.283,82.563c1.643-1.479,4.107-1.424,5.696,0.164l6.736,7.283l15.005-20.7c1.314-1.753,3.779-2.245,5.64-0.931 c1.753,1.259,2.19,3.833,0.876,5.586l-20.81,28.751L89.119,88.259C87.641,86.616,87.695,84.151,89.283,82.563z" />
                                        </g>

                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M2,34c0,0,0,185.486,0,187c0,17.87,14.416,32.192,32.084,32.899V254H205.82v-9.288c-13.226,0-23.928-10.702-23.928-23.928 s10.702-23.928,23.928-23.928v-0.202V2H35.8C17.526,2,2,15.726,2,34z M172.603,220.683c0,9.389,4.038,17.87,10.298,23.928H35.397 c-13.226,0.101-24.029-10.702-24.029-23.928c0-12.519,9.793-22.817,22.111-23.726l149.726-0.303 C176.743,202.712,172.603,211.192,172.603,220.683z M57.083,68.051l12.596-3.231l-3.56-12.486c-0.986-3.614,2.41-6.955,5.969-5.969 l12.486,3.56l3.231-12.596c0.876-3.614,5.586-4.819,8.105-2.136l9.036,9.31l9.036-9.31c2.574-2.738,7.229-1.424,8.105,2.136 l3.231,12.596l12.486-3.56c3.614-0.986,6.955,2.41,5.969,5.969l-3.56,12.486l12.596,3.231c3.614,0.876,4.874,5.476,2.136,8.105 l-9.255,9.036l9.2,9.036c2.738,2.629,1.479,7.229-2.136,8.105l-12.596,3.231l3.56,12.486c0.986,3.614-2.41,6.955-5.969,5.969 l-12.267-3.505l17.524,34.884l-14.622-4.162l-4.052,13.526L104.946,126.1L85.56,164.762l-4.052-13.526l-14.622,4.162l17.524-34.884 l-12.267,3.505c-3.614,0.986-6.955-2.41-5.969-5.969l3.56-12.486l-12.596-3.231c-3.614-0.876-4.874-5.476-2.136-8.105l9.2-9.036 l-9.255-9.036C52.209,73.527,53.469,68.927,57.083,68.051z M106.041,115.53c16.758,0,30.284-13.581,30.284-30.339 c0-16.757-13.636-30.284-30.284-30.284c-16.758,0-30.284,13.581-30.284,30.339C75.757,102.004,89.283,115.53,106.041,115.53z M89.283,82.563c1.643-1.479,4.107-1.424,5.696,0.164l6.736,7.283l15.005-20.7c1.314-1.753,3.779-2.245,5.64-0.931 c1.753,1.259,2.19,3.833,0.876,5.586l-20.81,28.751L89.119,88.259C87.641,86.616,87.695,84.151,89.283,82.563z" />
                                        </g>

                                    </svg>
                                    <svg fill="#ef5806" version="1.1" id="earth" xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="0px" height="80px"
                                        viewBox="-7.68 -7.68 271.36 271.36" enable-background="new 0 0 256 202"
                                        xml:space="preserve" stroke="#ef5806" transform="matrix(-1, 0, 0, 1, 0, 0)"
                                        stroke-width="0.00256">
                                        <g id="SVGRepo_bgCarrier" stroke-width="0" />

                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"
                                            stroke="#f8f7f7" stroke-width="4.096">
                                            <path
                                                d="M189.103,2.162c-35.842,0-64.897,29.055-64.897,64.897c0,35.841,29.055,64.897,64.897,64.897S254,102.9,254,67.059 C254,31.217,224.945,2.162,189.103,2.162z M189.457,111.449c-5.808,0-10.551-4.743-10.551-10.551 c0-5.842,4.743-10.551,10.551-10.551c5.808,0,10.551,4.743,10.551,10.551C200.008,106.706,195.265,111.449,189.457,111.449z M214.854,60.998c-1.512,2.234-4.158,4.88-8.317,7.904l-4.158,3.024c-2.199,1.856-3.712,3.712-4.502,6.014 c-0.447,1.512-0.79,3.78-0.79,6.805h-15.431c0.344-6.392,0.722-10.894,1.856-13.197c0.722-2.303,3.368-5.327,7.492-8.317 l3.815-3.368c1.512-1.065,2.577-2.234,3.368-3.368c1.512-1.924,2.302-4.158,2.302-6.805c0-3.024-1.134-5.602-2.646-7.904 c-1.512-2.234-4.537-3.368-9.039-3.368c-4.502,0-7.526,1.478-9.382,4.502c-1.512,2.234-2.646,5.258-2.646,7.904 c0,0.447,0,0.447,0,0.79c-0.447,4.158-3.815,7.492-8.317,7.492c-4.502,0-7.973-3.368-8.317-7.526c0,0,0-1.856,0-2.646 c1.134-9.451,4.949-16.187,11.306-20.345c4.537-2.646,10.207-4.158,16.565-4.158c8.626,0,15.774,1.856,21.445,6.014 c5.602,4.158,8.626,10.173,9.21,18.146C218.669,53.472,217.501,57.63,214.854,60.998z M229.382,148.01l-59.641,13.668 c-0.414,2.899-1.657,6.006-3.52,8.491c-3.52,5.384-8.905,9.319-15.117,10.976c-6.213,1.45-12.839,0.414-18.224-3.313l-51.358-32.72 c-2.485-1.45-2.899-4.349-1.45-6.627c1.45-2.278,4.349-2.899,6.42-1.45l51.565,32.72c6.834,4.142,15.739,2.278,20.087-4.349 c4.349-6.627,2.278-15.739-4.349-20.087l-64.197-40.589c-10.561-6.627-22.78-11.804-34.376-6.006L2,128.958l0.207,58.813 l37.897-26.3c6.006-1.45,12.632-0.207,18.224,3.313l44.731,28.164c10.976,6.834,24.436,8.491,36.033,5.384l96.917-22.158 c7.662-1.657,12.839-9.319,10.976-17.602C244.913,151.117,237.251,146.354,229.382,148.01z" />
                                        </g>

                                        <g id="SVGRepo_iconCarrier">
                                            <path
                                                d="M189.103,2.162c-35.842,0-64.897,29.055-64.897,64.897c0,35.841,29.055,64.897,64.897,64.897S254,102.9,254,67.059 C254,31.217,224.945,2.162,189.103,2.162z M189.457,111.449c-5.808,0-10.551-4.743-10.551-10.551 c0-5.842,4.743-10.551,10.551-10.551c5.808,0,10.551,4.743,10.551,10.551C200.008,106.706,195.265,111.449,189.457,111.449z M214.854,60.998c-1.512,2.234-4.158,4.88-8.317,7.904l-4.158,3.024c-2.199,1.856-3.712,3.712-4.502,6.014 c-0.447,1.512-0.79,3.78-0.79,6.805h-15.431c0.344-6.392,0.722-10.894,1.856-13.197c0.722-2.303,3.368-5.327,7.492-8.317 l3.815-3.368c1.512-1.065,2.577-2.234,3.368-3.368c1.512-1.924,2.302-4.158,2.302-6.805c0-3.024-1.134-5.602-2.646-7.904 c-1.512-2.234-4.537-3.368-9.039-3.368c-4.502,0-7.526,1.478-9.382,4.502c-1.512,2.234-2.646,5.258-2.646,7.904 c0,0.447,0,0.447,0,0.79c-0.447,4.158-3.815,7.492-8.317,7.492c-4.502,0-7.973-3.368-8.317-7.526c0,0,0-1.856,0-2.646 c1.134-9.451,4.949-16.187,11.306-20.345c4.537-2.646,10.207-4.158,16.565-4.158c8.626,0,15.774,1.856,21.445,6.014 c5.602,4.158,8.626,10.173,9.21,18.146C218.669,53.472,217.501,57.63,214.854,60.998z M229.382,148.01l-59.641,13.668 c-0.414,2.899-1.657,6.006-3.52,8.491c-3.52,5.384-8.905,9.319-15.117,10.976c-6.213,1.45-12.839,0.414-18.224-3.313l-51.358-32.72 c-2.485-1.45-2.899-4.349-1.45-6.627c1.45-2.278,4.349-2.899,6.42-1.45l51.565,32.72c6.834,4.142,15.739,2.278,20.087-4.349 c4.349-6.627,2.278-15.739-4.349-20.087l-64.197-40.589c-10.561-6.627-22.78-11.804-34.376-6.006L2,128.958l0.207,58.813 l37.897-26.3c6.006-1.45,12.632-0.207,18.224,3.313l44.731,28.164c10.976,6.834,24.436,8.491,36.033,5.384l96.917-22.158 c7.662-1.657,12.839-9.319,10.976-17.602C244.913,151.117,237.251,146.354,229.382,148.01z" />
                                        </g>

                                    </svg>
                                </div> --}}
                                    {{-- <p>
                                <h5 class="mb-2 text-5xl font-bold tracking-tight text-gray-900 dark:text-white">QUIZ
                                    TIME</h5>
                                </p> --}}
                                    <div class="flex justify-center">
                                        <h2
                                            class=" text-3xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white">
                                            <img class="w-10 h-10"
                                                src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                                                alt="logo">
                                            otePad2
                                        </h2>
                                    </div>
                                    {{-- <p
                                    class="mb-3  font-semibold text-4xl tracking-tight text-orange-500 dark:text-orange ">
                                    Cliquez sur START pour commencer
                                </p> --}}
                                    <h5 class="text-xl font-normal text-gray-500 dark:text-gray-400">Rassurez-vous
                                        d'avoir
                                        répondu et soumis vos réponses avant de quitter la page d'évaluation car vous
                                        avez
                                        droit à une connexion uniquement
                                    </h5>

                                </div>

                            </div>
                            <div class="flex justify-center">
                                <div
                                    class="rounded-full relative  bg-blue-500 w-46 h-36 border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700 flex justify-center items-center">

                                    <div
                                        class=" rounded-full w-full bg-white border border-gray-200 shadow dark:bg-gray-800 dark:border-gray-700">
                                        <img src="{{ asset('img/qst2.jpg') }}" alt=""
                                            class=" rounded-full w-46 h-36 animate-rotate-cw">
                                    </div>
                                    <form action="{{ route('phasequestion') }}" method="get"
                                        class="absolute  bg-transparent text-white py-2 rounded-md">
                                        @csrf
                                        @method('get')
                                        <input type="text" name="phase_id" id="getPhaseId" class="hidden"
                                            value="{{ Session::get('phase_id') }}">
                                        <input type="text" name="intervenant_id" id="getIntervenantId" class="hidden"
                                            value="{{ Session::get('intervenant_id') }}">
                                        <button type="submit"
                                            class=" py-2 text-4xl font-medium text-center text-[#ff7900] shadow">DEMARRER</button>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-5  px-16">
            <div class=" pt-5 flex justify-center">
                <h2
                    class="mb-4 text-2xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white">
                    <img class="w-8 h-8"
                        src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                        alt="logo">
                    otePad2
                </h2>
            </div>

            <div
                class="text-left justify-center items-center rounded-lg bg-gray-200 bg-opacity-95 border border-gray-300 border-opacity-90 rounded-lg shadow sm:p-4 dark:bg-slate-900 dark:border-slate-900 dark:bg-opacity-95">

                <div class="flex justify-between">
                    <div class="text-left">
                        <p class="text-end dark:text-white p-10" id="place_question"></p>
                    </div>
                    <div class="text-right">
                        <p id="heure_actuel" class="pr-12 dark:text-white"></p>
                        <p id="end-time" class="pr-12 mb-6 text-2xl dark:text-white"></p>
                    </div>
                </div>


                <div>
                    @if (session('success'))
                        <div id="alert-3"
                            class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 ml-10 mr-10"
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
                    @foreach (session('questionAssetionTab') as $key => $value)
                        <div id="{{ $value['question']['question'] }}" value="{{ $value['question']['question'] }}"
                            class="hidden">
                            <label class="flex items-center gap-4 dark:text-white">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" fill="currentColor"
                                    class="size-8">
                                    <path fill-rule="evenodd"
                                        d="M15 8A7 7 0 1 1 1 8a7 7 0 0 1 14 0Zm-6 3.5a1 1 0 1 1-2 0 1 1 0 0 1 2 0ZM7.293 5.293a1 1 0 1 1 .99 1.667c-.459.134-1.033.566-1.033 1.29v.25a.75.75 0 1 0 1.5 0v-.115a2.5 2.5 0 1 0-2.518-4.153.75.75 0 1 0 1.061 1.06Z"
                                        clip-rule="evenodd" />
                                </svg>

                                <h5 class="hidden text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">
                                    {{ $value['question']['question'] }}?</h5>
                                <h3 class="text-lg font-bold text-center dark:text-white">
                                    {{ $value['question']['question'] }}?</h3>
                            </label>


                            @foreach ($value['assertion'] as $key1 => $assertions)
                                @foreach ($assertions as $i => $var)
                                    <div
                                        class="items-center ps-4 my-4 flex border border-gray-200 rounded-md dark:border-gray-300 dark:bg-gray-300 opacity-100">
                                        <input id="{{ $var->id }}" type="radio" value="{{ $var->id }}"
                                            name="id_collection_keyQuestion_valAssertion[{{ $value['question']['id'] }}]"
                                            onclick="handleAssertionChecked(this, '{{ $var->question_id }}');"
                                            class="assertion_cocher w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="{{ $var->id }}"
                                            class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-black">{{ $var->assertion }}.</label>
                                    </div>
                                @endforeach
                            @endforeach
                        </div>
                    @endforeach

                    <div class="inline-flex items-center gap-20">
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
                            class="flex items-center justify-center px-4 h-10 ml-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white ">
                            Suivant
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </div>
                        <button type="submit" onclick="cleanstorage()" id="envoi_reponse"
                            class="hidden items-center justify-center p-8 px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                            Terminer
                            <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </div>
                </form>
            </div>

        </div>
    @endif

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


        const handleAssertionChecked = (input, questionId) => {
            // console.log(input.value, typeof input, questionId);

            const localData = JSON.parse(localStorage.getItem("COTES"))
            // console.log("localData", localData)
            let savedChoices = localData
            if (!localData) {
                savedChoices = {}
            }

            savedChoices[questionId] = input.value
            localStorage.setItem("COTES", JSON.stringify(savedChoices))
        }
        const cleanstorage = () => {
            localStorage.clear();
        }
    </script>
    <script>
        const data = JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`);

        if (data) {

            // const data =JSON.parse(data1);
            const tableauJSON = JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`);
            // console.log(tableauJSON);

            function afficherElement(index, hidden, precedent_item) {

                Fields = document.getElementById("InputFields");

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
            let hideClass = "p-6 my-5 mx-5"
            //classe au chargement
            let element_precedent = null; //au chargement
            const buttonPrecedent = document.getElementById('precedent');
            const buttonSuivant = document.getElementById('suivant');
            const buttonTerminer = document.getElementById('envoi_reponse');
            const placeQuestion = document.getElementById('place_question');
            if (currentIndex <= 0) {
                buttonPrecedent.className = 'hidden';
                buttonTerminer.className = "hidden";
                placeQuestion.innerHTML = "1 / " + tableauJSON.length;
            }

            afficherElement(currentIndex, hideClass, element_precedent); // Afficher le premier élément au démarrage

            // Bouton Suivant
            document.getElementById("suivant").addEventListener("click", () => {

                if (currentIndex == tableauJSON.length - 1) {
                    buttonSuivant.className = "hidden";
                    placeQuestion.innerHTML = tableauJSON.length + " / " + tableauJSON.length;
                    buttonTerminer.className =
                        "flex items-center justify-center ml-10 px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    console.log('fin, derniere question')

                } else {
                    currentIndex = (currentIndex + 1);
                    placeQuestion.innerHTML = (currentIndex + 1) + " / " + tableauJSON.length;
                    buttonTerminer.className = "hidden"
                    buttonPrecedent.className =
                        "flex items-center ml-10 justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    element_precedent = currentIndex - 1;
                    afficherElement(currentIndex, hideClass, element_precedent)
                }
            });

            // Bouton Précédent
            document.getElementById("precedent").addEventListener("click", () => {
                if (currentIndex == 0) {
                    buttonPrecedent.className = "hidden"
                    buttonTerminer.className = "hidden"
                    placeQuestion.innerHTML = 1 + " / " + tableauJSON.length;
                    buttonSuivant.className =
                        "flex items-center justify-center ml-10 px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    console.log('premiere qustion')
                } else {
                    currentIndex = (currentIndex - 1);
                    placeQuestion.innerHTML = (currentIndex + 1) + " / " + tableauJSON.length;
                    buttonTerminer.className = "hidden"
                    buttonSuivant.className =
                        "flex items-center justify-center ml-10 px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                    element_precedent = currentIndex + 1;
                    afficherElement(currentIndex, hideClass, element_precedent)
                }
            });

        } else {
            console.log('Cliquer sur demarrer pour charger les question')
            // La variable n'est pas définie
        }
    </script>
    <script>
        //script pour le chrono duree evaluation
        function paddedFormat(num) {
            return num < 10 ? '0' + num : num;
        }

        function startCountDown(duration, element) {
            let secondsRemaining = duration;
            let min = 0;
            let sec = 0;

            element.style.color = 'white'; 

            let countInterval = setInterval(function() {
                min = parseInt(secondsRemaining / 60);
                sec = parseInt(secondsRemaining % 60);
                element.innerHTML =
                    `Il vous reste <span style="color: white;">${paddedFormat(min)}:${paddedFormat(sec)} min</span>`;

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


        window.onload = function() {

            const dataTime = JSON.parse(`{!! addslashes(json_encode(session('duree_evaluation'))) !!}`);
            const starTime = JSON.parse(`{!! addslashes(json_encode(session('debut_evaluation_enreg'))) !!}`);

            var tabHeure = dataTime.split(":");
            const dureeHeure = tabHeure[0];
            const dureeMinute = tabHeure[1];
            const dureeSeconde = tabHeure[2];

            const date = new Date();
            const heure = date.getHours();
            const min = date.getMinutes();
            heure_actu = document.querySelector('#heure_actuel');
            heure_actu.textContent = "Date de l'evaluation: le " + starTime;

            let time_heure = dureeHeure; // Value in hours
            let time_minutes = parseInt(dureeMinute) + parseInt(dureeHeure * 60); // Value in minutes
            let time_seconds = parseInt(dureeSeconde); // Value in seconds
            let duration = time_minutes * 60 + time_seconds;

            element = document.querySelector('#end-time');
            element.textContent = `Il vous reste ${paddedFormat(time_minutes)}:${paddedFormat(time_seconds)} min`;
            startCountDown(--duration, element);
        };
    </script>
</body>

</html>
