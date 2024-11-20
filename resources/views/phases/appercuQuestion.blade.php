<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __("Resultats detaillés de l'intervenant ") }}
            </h2>
        </div>
    </x-slot>


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
        
        

        <nav class="bg-white border-gray-200 dark:border-gray-600 dark:bg-gray-900">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl p-4">
                <a href="https://flowbite.com" class="flex items-center space-x-3 rtl:space-x-reverse">
                    
                    <span class="self-center text-2xl font-semibold whitespace-nowrap dark:text-white">Question details</span>
                </a>
                <button data-collapse-toggle="mega-menu-full" type="button" class="inline-flex items-center p-2 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600" aria-controls="mega-menu-full" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 17 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h15M1 7h15M1 13h15"/>
                    </svg>
                </button>
                <div id="mega-menu-full" class="items-center justify-between font-medium hidden w-full md:flex md:w-auto md:order-1">
                    <ul class="flex flex-col p-4 md:p-0 mt-4 border border-gray-100 rounded-lg bg-gray-50 md:space-x-8 rtl:space-x-reverse md:flex-row md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                        
                        <li>
                            <button id="mega-edite-full-dropdown-button" data-collapse-toggle="mega-edite-full-dropdown" class="flex items-center justify-between w-full py-2 px-3 text-gray-900 rounded md:w-auto hover:bg-gray-100 md:hover:bg-transparent md:border-0 md:hover:text-blue-600 md:p-0 dark:text-white md:dark:hover:text-blue-500 dark:hover:bg-gray-700 dark:hover:text-blue-500 md:dark:hover:bg-transparent dark:border-gray-700">Editer <svg class="w-2.5 h-2.5 ms-2.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                                </svg>
                            </button>
                        </li>

                    </ul>
                </div>
            </div>
            <div>
            <div id="" class="mt-1  shadow-sm bg-gray-50 md:bg-white  dark:bg-gray-800">
                <div class="grid max-w-screen-xl px-4 py-5 mx-auto text-gray-900 dark:text-white sm:grid-cols-2 md:px-6 ">
                    <ul class="border-b border-gray-300 sm:border-b-0">
                        <li>
                            <label class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                <div class="font-semibold">{{$question->question->question}}</div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">Ponderation de la phase [ {{$question->ponderation}} ]</span>
                            </label>
                        </li>
                        
                    </ul>
                    <ul>
                        @foreach ($question->question->assertion as $v )
                        <li>
                            <label class="block p-3 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700">
                                <div class="font-semibold">{{$v->assertion}}</div>
                                <span class="text-sm text-gray-500 dark:text-gray-400">
                                    @if($v->ponderation > 0)
                                        Bonne reponse [ {{$v->ponderation }} ]
                                    @else
                                        Mauvaise reponse
                                    @endif
                                </span>
                            </label>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </nav>
        <div id="mega-edite-full-dropdown" class="mt-1 shadow-sm bg-gray-50 md:bg-white  dark:bg-gray-800 ">
            <form action="{{route('question.update')}}" method="post"  class="grid gap-4 max-w-screen-xl px-4 py-5 mx-auto text-gray-900 dark:text-white sm:grid-cols-2 md:px-6">
                @csrf
                @method('post')
                <div class="border-b  border-gray-300 sm:border-b-0">
                    <div class="block items-center rounded dark:border-gray-700">
                        <input type="text" name="question[{{$question->question->id}}]" value="{{$question->question->question}}"  class=" my-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        <input type="number" name="ponderation[{{$question->id}}]" value="{{$question->ponderation}}"  class="my-6 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                    </div>
                </div>
                <div class="assertion">
                    @foreach ($question->question->assertion as $v )
                        <label for="">Assertion</label>
                        <div class="flex items-center rounded dark:border-gray-700">
                            <input type="text" name="assertions[{{$v->id}}]" value="{{$v->assertion}}"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            <input type="radio" name="bonneReponse" value="{{$v->id}}" class="m-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600" />
                        </div>
                    @endforeach

                    @for($i=1; $i<=5-count($question->question->assertion);$i++)
                    <label for="">Nouvelle Assertion {{$i}}</label>
                    <div class="flex items-center rounded dark:border-gray-700">
                            <input type="text" name="newAssertions[{{$i}}]"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" />
                            <input type="radio" name="bonneReponse" value="newAssertion{{$i}}" class="m-4 w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600"/>
                        </div>
                    @endfor
                    
                </div>
                <button type="submit" class=" bg-blue-600 rounded-md">Enregistrer</button>
            </form>
        </div>

</x-app-layout>
