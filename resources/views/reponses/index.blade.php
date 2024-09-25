<!DOCTYPE html>
<html translate="no">

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

<body id="voteUser" class="select-none">
    @if (!session('debut'))
        <div class="containe">
            <div class="flex justify-center items-center mt-16 mb-3 ml-4 mr-4 md:ml-20 md:mr-20">
                <div class="shadow-md rounded-lg bg-gray-200 dark:bg-slate-900 max-h-64 md:max-h-80 overflow-y-auto">
                    <h2 class="text-xl text-center mt-2 font-extrabold dark:text-white">INSTRUCTION</h2>
                    <p class="text-sm text-gray-500 dark:text-gray-400 px-8 pt-8">
                        Les questions sont regroupées suivant ces quatre thématiques : <br>
                        A. Réseau informatique ;<br>
                        B. Systèmes d’exploitation ;<br>
                        C. Systèmes de gestion des bases des données (SGBD) ;<br>
                        D. Programmation informatique ou applications.<br><br>

                        Cette évaluation est faite dans la perspective de calibrer le contenu du module au niveau moyen
                        et identifier les axes sur lesquels insisté au cours de l’exécution de la formation. De plus,
                        ODC RDC se réserve le droit de faire usage de ces résultats à des fins internes.<br><br>

                        L’évaluation est composée de questions à choix multiple. A chacune de ces dernières est associé
                        une et une seule réponse. Le candidat dispose d’un maximum de 25 minutes pour y répondre. Passé
                        ce délai le questionnaire ne sera plus accessible et les réponses renseignées seront
                        automatiquement envoyées à ODC RDC pour traitement.<br><br>

                        ODC RDC s’engage à traiter les données qu’il collectera dans le cadre de cette évaluation
                        conformément au cadre légal congolais encadrant la protection des données à caractère
                        personnel.<br><br>
                    </p>
                </div>
            </div>
        </div>

        <div class="containe">
            <div class="flex justify-center items-center  ml-4 mr-4 md:ml-20 md:mr-20">
                <div class="shadow-md rounded-lg bg-gray-200 dark:bg-slate-900 mt-2 mb-3 pb-3 md:pt-3 md:pb-6">
                    <div class="questionnaire ">
                        <div
                            class="justify-center items-center text-center grid gap-1 sm:grid-cols-1 lg:grid-cols-2 md:grid-cols-2">
                            <div class="">
                                <div class="md:pl-10">
                                    <div class="flex justify-center mt-3">
                                        <h2
                                            class=" text-3xl font-extrabold leading-none tracking-tight flex items-center mb-3 text-2xl font-semibold dark:text-white">
                                            <img class="w-10 h-10"
                                                src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                                                alt="logo">
                                            otePad2
                                        </h2>
                                    </div>
                                    <h5
                                        class="px-6 mb-2 text-sm md:text-[15px] font-normal text-gray-500 dark:text-gray-400">
                                        Rassurez-vous
                                        d'avoir
                                        répondu et soumis vos réponses avant de quitter la page d'évaluation. <br>
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
                                        <input type="text" name="intervenant_id" id="getIntervenantId" class="hidden"
                                            value="{{ Session::get('intervenant_id') }}">
                                        <button type="submit" class="py-2 rounded-lg">
                                            <img src="{{ asset('img/button_demarer.png') }}" alt=""
                                                class="rounded-lg w-[300px] h-[50px] md:w-[300px] md:h-[80px]">
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="py-3 px-3  md:px-16">
            {{-- <div class=" pt-5 flex justify-center">
                <h2
                    class="mb-4 text-2xl font-extrabold leading-none tracking-tight flex items-center mb-6 text-2xl font-semibold dark:text-white">
                    <img class="w-8 h-8"
                        src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg"
                        alt="logo">
                    otePad2
                </h2>
            </div> --}}

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
            heure_actu.textContent = "Date: " + starTime;

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
