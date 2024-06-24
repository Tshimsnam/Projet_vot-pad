<x-app-layout>
    <x-slot name="header">
       
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('Reponses') }}
            </h2>
        </div>
        
    </x-slot>
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
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
                <div class="relative overflow-x-auto shadow-md sm:rounded-lg gap-2 p-4 grid grid-cols-1 lg:grid-cols-3">
                    <div class="p-6 w-full my-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700 grid grid-cols-1">
                        <svg xmlns="http://www.w3.org/2000/svg" class="justify-self-center items-center md:w-24 lg:w-28 lg:h-28 w-12"  viewBox="0 -960 960 960" fill="#5f6368"><path d="M107-67v-306h120v-160h200v-54H307v-306h346v306H533v54h200v160h120v306H507v-306h120v-54H333v54h120v306H107Zm306-626h134v-94H413v94ZM213-173h134v-94H213v94Zm400 0h134v-94H613v94ZM480-693ZM347-267Zm266 0Z"/></svg>
                        <label class="justify-self-center items-center">
                                <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Evaluation</h5>
                        </label>
                                     
                    </div>
                    <div class="p-6 w-full my-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e8eaed"><path d="M186.67-120q-27 0-46.84-19.83Q120-159.67 120-186.67v-168h66.67v168h168V-120h-168Zm586.66 0h-168v-66.67h168v-168H840v168q0 27-19.83 46.84Q800.33-120 773.33-120ZM120-773.33q0-27 19.83-46.84Q159.67-840 186.67-840h168v66.67h-168v168H120v-168Zm720 0v168h-66.67v-168h-168V-840h168q27 0 46.84 19.83Q840-800.33 840-773.33Zm-361.98 530q17.65 0 29.81-12.19Q520-267.7 520-285.35t-12.19-29.82q-12.18-12.16-29.83-12.16t-29.81 12.18Q436-302.96 436-285.31q0 17.64 12.19 29.81 12.18 12.17 29.83 12.17ZM444-393h62.33q0-30.67 9-50t35.34-45.67q33-33 45.83-57.16 12.83-24.17 12.83-53.22 0-52.28-36.74-84.95t-93.26-32.67q-50 0-86.66 24.34Q356-668 339.33-622l57.34 23.67q11.66-26 33.5-41.84Q452-656 479.35-656q30.5 0 48.91 16.5 18.41 16.5 18.41 42.5 0 20-10.5 38.17-10.5 18.16-35.5 41.16-33 31-44.84 56.34Q444-436 444-393Z"/></svg>
                        <label>
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Need a help in Claim?</h5>
                        </label>
                        <div class="flex items-center ps-4 my-1 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                    </div>
                    <div class="p-6 w-full my-5 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#e8eaed"><path d="M186.67-120q-27 0-46.84-19.83Q120-159.67 120-186.67v-168h66.67v168h168V-120h-168Zm586.66 0h-168v-66.67h168v-168H840v168q0 27-19.83 46.84Q800.33-120 773.33-120ZM120-773.33q0-27 19.83-46.84Q159.67-840 186.67-840h168v66.67h-168v168H120v-168Zm720 0v168h-66.67v-168h-168V-840h168q27 0 46.84 19.83Q840-800.33 840-773.33Zm-361.98 530q17.65 0 29.81-12.19Q520-267.7 520-285.35t-12.19-29.82q-12.18-12.16-29.83-12.16t-29.81 12.18Q436-302.96 436-285.31q0 17.64 12.19 29.81 12.18 12.17 29.83 12.17ZM444-393h62.33q0-30.67 9-50t35.34-45.67q33-33 45.83-57.16 12.83-24.17 12.83-53.22 0-52.28-36.74-84.95t-93.26-32.67q-50 0-86.66 24.34Q356-668 339.33-622l57.34 23.67q11.66-26 33.5-41.84Q452-656 479.35-656q30.5 0 48.91 16.5 18.41 16.5 18.41 42.5 0 20-10.5 38.17-10.5 18.16-35.5 41.16-33 31-44.84 56.34Q444-436 444-393Z"/></svg>
                        <label>
                            <h5 class="mb-2 text-2xl font-semibold tracking-tight text-gray-900 dark:text-white">Need a help in Claim?</h5>
                        </label>
                        <div class="flex items-center ps-4 my-1 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                        <div class="flex items-center ps-4 border border-gray-200 rounded dark:border-gray-700">
                            <input id="bordered-radio-1" type="radio" value="" name="assertion" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="bordered-radio-1" class="w-full py-4 ms-2 text-sm font-medium text-gray-900 dark:text-gray-300">Assertion</label>
                        </div>
                    </div>
                </div>
                
              {{$questionAssertion}}
            </div>
        </div>
    </div>
</x-app-layout>
