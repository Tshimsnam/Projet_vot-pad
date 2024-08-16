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
