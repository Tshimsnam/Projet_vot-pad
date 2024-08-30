<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight ">
                {{ __('Phase') }}
            </h2>
            
        </div>
    </x-slot>
    

    <div class="py-12">
       
                        
                        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead
                                class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-2">N°</th>
                                    <th scope="col" class="py-2">Question</th>
                                    <th scope="col" class="py-2">Ponderation à la phase</th>
                                    <th scope="col" class="py-2">Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questionPhasePagnation as $key => $item)
                                    <tr
                                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                                        <td class="px-6 py-2">{{$key+1}}</td>
                                        <th scope="row"
                                            class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ $item->question->question }}
                                        </th>
                                        <td class="px-6 py-2">{{$item->ponderation}}</td>
                                        <td class="px-6 py-2">
                                            <a href="{{route('question.phase',['id'=>$item->question_id,'phase_id'=>$item->phase_id])}}"
                                                class="text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2  dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                                    class="size-4">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z"
                                                        clip-rule="evenodd"/>
                                                </svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="p-2">
                            {{$questionPhasePagnation->links()}}
                        </div>
    </div>
    <x-intervenants.create />
    <x-questions.create />
   
</x-app-layout>
