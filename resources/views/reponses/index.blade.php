<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Evaluation</title>
	
	<!-- Tailwind CSS -->
	<script src="https://cdn.tailwindcss.com"></script>
	
	<!-- Flowbite -->
	<link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
	<script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
</head>
<body class="bg-gray-800 justify-center items-center h-screen">
   
   
	<div class="grid grid-cols-1 md:grid-cols-2 gap-6 top-0 text-center">
	</div>
	<div class="container mx-auto my-8 px-4 ">
		<h1 class="text-3xl font-bold mb-4 dark:text-gray-300 ">Évaluation</h1>
		<div class="hadow-md rounded-lg px-10 py-16 mt-8 bg-slate-900 items-center ">
        <p id="heure_actuel" class="text-end dark:text-white">Heure de debut 00:00:00</p>
        <p id="end-time" class="text-end dark:text-white">Duree 00:00:00</p>
			<div class="flex text-center justify-center mb-10">
				<div>
					<img src="{{asset("img/orange.png")}}" width="70" >
				</div>
                
			</div>
            <div>
            @if (session('success'))
                    <div id="alert-3" class="flex items-center p-4 mb-4 text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert" >
                        <svg class="flex-shrink-0 w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                        </svg>
                        <span class="sr-only">Info</span>
                        <div class="ms-3 text-sm font-medium">
                            {{ session('success') }}
                        </div>
                        <button type="button" class="ms-auto -mx-1.5 -my-1.5 bg-green-50 text-green-500 rounded-lg focus:ring-2 focus:ring-green-400 p-1.5 hover:bg-green-200 inline-flex items-center justify-center h-8 w-8 dark:bg-gray-800 dark:text-green-400 dark:hover:bg-gray-700" data-dismiss-target="#alert-3" aria-label="Close">
                            <span class="sr-only">Close</span>
                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                            </svg>
                        </button>
                    </div>
                @endif 
            </div>
			<div class="questionnaire ">
            @if (!session('debut'))
                            
                <div class="flex justify-self-center items-center text-center">
                        <form action="{{route('phasequestion')}}" method="get" class="max-w-sm mx-auto  text-center justify-center mb-10">
                            @csrf
                            @method('get')
                            <input type="text" name="phase_id" id="getPhaseId" class="hidden" value="{{Session::get('phase_id')}}">
                            <input type="text" name="intervenant_id" id="getIntervenantId" class="hidden" value=" {{Session::get('intervenant_id')}}">
                            <button type="submit" class="px-3 py-2 text-xs font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Demarrer</button>
                        </form>
                       
                </div>
            @else
				<div class="text-left w-full">
					<form action="{{route('reponses.store')}}" method="post" class="max-w-sm mx-auto">
                        @csrf
                        @method('post')
                        <input type="text" name="phase_id" id="" class="hidden" value="{{ session()->get('phaseId')}}">
                        <input type="text" name="intervenant_id" id="" class="hidden" value="{{ session()->get('intervenantId')}}">
                        @foreach (session('questionAssetionTab') as $key=> $value )
                            <div id="{{$value['question']['question']}}" value="{{$value['question']['question']}}" class="hidden">
                                <label>
                                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e8eaed"><path d="M186.67-120q-27 0-46.84-19.83Q120-159.67 120-186.67v-168h66.67v168h168V-120h-168Zm586.66 0h-168v-66.67h168v-168H840v168q0 27-19.83 46.84Q800.33-120 773.33-120ZM120-773.33q0-27 19.83-46.84Q159.67-840 186.67-840h168v66.67h-168v168H120v-168Zm720 0v168h-66.67v-168h-168V-840h168q27 0 46.84 19.83Q840-800.33 840-773.33Zm-361.98 530q17.65 0 29.81-12.19Q520-267.7 520-285.35t-12.19-29.82q-12.18-12.16-29.83-12.16t-29.81 12.18Q436-302.96 436-285.31q0 17.64 12.19 29.81 12.18 12.17 29.83 12.17ZM444-393h62.33q0-30.67 9-50t35.34-45.67q33-33 45.83-57.16 12.83-24.17 12.83-53.22 0-52.28-36.74-84.95t-93.26-32.67q-50 0-86.66 24.34Q356-668 339.33-622l57.34 23.67q11.66-26 33.5-41.84Q452-656 479.35-656q30.5 0 48.91 16.5 18.41 16.5 18.41 42.5 0 20-10.5 38.17-10.5 18.16-35.5 41.16-33 31-44.84 56.34Q444-436 444-393Z"/></svg>
                                    <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">{{$value['question']['question']}}?</h5>
                                    <h3 class="hidden text-lg font-bold mb-2 text-center dark:text-white">{{$value['question']['question']}}?</h3>
                                </label>
                                
                                @foreach ($value['assertion'] as $key1=>$assertions )
                                    @foreach ( $assertions as $i=>$var)                                  
                                        <div class="items-center ps-4 my-4 rounded dark:border-gray-700">
                                            <input id="{{$var->id}}" type="radio" value="{{$var->id}}"  name="id_collection_keyQuestion_valAssertion[{{$value['question']['id']}}]"
                                            onclick="handleAssertionChecked(this, '{{$var->question_id}}');"
                                            class="assertion_cocher w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                            <label for="{{$var->id}}" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">{{$var->assertion}}.</label>
						                </div>
                                    @endforeach
                                @endforeach
                            </div>   
                        @endforeach

						<div class="inline-flex mt-2 xs:mt-0">
							    <!-- Buttons -->
							<div id="precedent" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
							        <svg class="w-3.5 h-3.5 me-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
							          <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5H1m0 0 4 4M1 5l4-4"/>
							        </svg>
							        Précédent
							</div>
							<div id="suivant" class="flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
							        Suivant
							        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
							        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
							      </svg>
                            </div>
							<button type="submit" onclick="cleanstorage()" id="envoi_reponse" class="hidden items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
							        Terminer
							        <svg class="w-3.5 h-3.5 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
							        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9"/>
							      </svg>
							</button>
						</div>						
					</form>
                    <p class="text-end dark:text-white" id="place_question">1/100</p>
				</div>
                @endif
			</div>
		</div>
	</div>
   
    <script>
        //script local storage
        const onStart=()=>{
            const localData = JSON.parse(localStorage.getItem("COTES"))
            // console.log("localData", localData)
            let savedChoices = localData
            if (!localData){
                savedChoices={}
            }
          
            for (const [key, value] of Object.entries(savedChoices)) {
                //console.log(`${key}: ${value}`);
                //console.log(`[name="id_collection_keyQuestion_valAssertion${key}"]`)
                const inputs=document.querySelectorAll(`[name="id_collection_keyQuestion_valAssertion[${key}]"]`)
                for (input of inputs) {
                    const inputId=input.id
                    
                    if(inputId==value){
                        // console.log("input",input, inputId)
                        radiobtn = document.getElementById(inputId);
                        radiobtn.checked = true;
                    }
                }
            
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            onStart()
        }, false);


        const handleAssertionChecked=(input, questionId)=>{
            console.log(input.value, typeof input, questionId);

            const localData=JSON.parse(localStorage.getItem("COTES"))
            console.log("localData", localData)
            let savedChoices=localData
            if (!localData){
                savedChoices={}
            }

            savedChoices[questionId]=input.value
            localStorage.setItem("COTES", JSON.stringify(savedChoices))
        }
        const cleanstorage = ()=>{
            localStorage.clear();
        }
    </script>
    <script>
        const data= JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`); 
   
        if (data) {
  
            // const data =JSON.parse(data1);
            const tableauJSON = JSON.parse(`{!! addslashes(json_encode(session('questionAssetionTab'))) !!}`); 
            console.log(tableauJSON);
        
            function afficherElement(index, hidden, precedent_item) {
                
                Fields=document.getElementById("InputFields");
                
                const item = tableauJSON[index];
                console.log("Question :");
                console.log(item.question.question)

                if(precedent_item==null){
                var question_actu = item.question.question;
                var question_visible = document.getElementById(item.question.question);
                    var question_vue_form = question_visible.getAttribute('value');
                        question_visible.className=hidden;
                }else{
                    const item2 = tableauJSON[precedent_item]
                    var question_actu_pre = item2.question.question;
                    var question_visible_pre = document.getElementById(item2.question.question);
                    var question_vue_form_prev = question_visible_pre.getAttribute('value');
                        question_visible_pre.className = "hidden";

                    var question_actu = item.question.question;
                    var question_visible = document.getElementById(item.question.question);
                    var question_vue_form = question_visible.getAttribute('value');
                        question_visible.className=hidden;
                }  
           
                console.log("Assertions :");

                    item.assertion.forEach(assertionGroup => {
                    assertionGroup.forEach(assertion => {
                        console.log(`- Assertion ${assertion.id}: ${assertion.assertion}`);
                    });
                    
                });
                console.log("---");
            }
            let currentIndex = 0; // Indice de l'élément actu au chargement
            let hideClass = "p-6 my-5 mx-5 rounded-lg shadow "
            //classe au chargement
            let element_precedent = null; //au chargement
            const buttonPrecedent = document.getElementById('precedent');
            const buttonSuivant = document.getElementById('suivant');
            const buttonTerminer =document.getElementById('envoi_reponse');
            const placeQuestion =document.getElementById('place_question');
            if(currentIndex <= 0){
                buttonPrecedent.className='hidden';
                buttonTerminer.className = "hidden";
                placeQuestion.innerHTML = "1 / "+tableauJSON.length;
            }
              
            afficherElement(currentIndex, hideClass, element_precedent);// Afficher le premier élément au démarrage
            
            // Bouton Suivant
            document.getElementById("suivant").addEventListener("click", () => {
            
            if(currentIndex==tableauJSON.length-1)
            {
                buttonSuivant.className  = "hidden";
                placeQuestion.innerHTML  = tableauJSON.length+" / "+tableauJSON.length;
                buttonTerminer.className = "flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                console.log('fin')

            }else {
                currentIndex = (currentIndex + 1);
                placeQuestion.innerHTML   = (currentIndex+1)+" / "+tableauJSON.length;
                buttonTerminer.className  = "hidden"
                buttonPrecedent.className = "flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 rounded-s hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                element_precedent = currentIndex - 1;
                afficherElement(currentIndex, hideClass, element_precedent)
            }
            });

            // Bouton Précédent
            document.getElementById("precedent").addEventListener("click", () => {
            if(currentIndex==0)
            {
                buttonPrecedent.className = "hidden"
                buttonTerminer.className = "hidden"
                placeQuestion.innerHTML   = 1+" / "+tableauJSON.length;
                buttonSuivant.className = "flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                console.log('premier')
            }else
            {
                currentIndex = (currentIndex - 1);
                placeQuestion.innerHTML   = (currentIndex+1)+" / "+tableauJSON.length;
                buttonTerminer.className = "hidden"
                buttonSuivant.className = "flex items-center justify-center px-4 h-10 text-base font-medium text-white bg-gray-800 border-0 border-s border-gray-700 rounded-e hover:bg-gray-900 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white"
                element_precedent =currentIndex + 1;
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

                element.textContent = `Il vous reste ${paddedFormat(min)}:${paddedFormat(sec)}`;
               
                secondsRemaining = secondsRemaining - 1;
                if (secondsRemaining < 0) {
                    clearInterval(countInterval)
                };
            }, 1000);
        }

        window.onload = function() {

            const dataTime= JSON.parse(`{!! addslashes(json_encode(session('phase'))) !!}`); 
            console.log(dataTime['duree'])

            var tabHeure= dataTime['duree'].split(":");
            const dureeHeure=tabHeure[0];
            const dureeMinute=tabHeure[1];
            const dureeSeconde=tabHeure[2];

            const date= new Date();
            const heure=date.getHours();
            const min=date.getMinutes();
            heure_actu = document.querySelector('#heure_actuel');
            heure_actu.textContent="Debut à "+heure+'h : '+min;

            let time_heure = dureeHeure;   // Value in hours
            let time_minutes = parseInt(dureeMinute) +parseInt(dureeHeure*60);// Value in minutes
            let time_seconds = parseInt(dureeSeconde);  // Value in seconds
            let duration = time_minutes * 60 + time_seconds;

            element = document.querySelector('#end-time');
            element.textContent =`Il vous reste ${paddedFormat(time_minutes)}:${paddedFormat(time_seconds)}`;
            startCountDown(--duration, element);
        };
    </script>
</body>
</html>