@extends('layouts.template')
@section('content')
   <section>
        <h1 class="mt-2  text-3xl font-bold">{{$phaseAndSpeaker->nom}}</h1>
         <p class="mb-5 font-extralight text-gray-500  text-justify sm:w-3/4">Vous trouverez ici la liste des candidats participant à cette phase spécifique de la compétition. Chaque candidat est présenté avec une brève description. vous avez la possibilité de sélectionner un candidat pour exprimer votre vote pour soutenir votre candidat favori. Faites votre choix et participez activement à la décision finale de cette compétition!</p>
        <div class="">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">N°</th>
                        <th scope="col" class="px-6 py-3">Email</th>
                        <th scope="col" class="px-6 py-3">Groupe</th>
                        <th scope="col" class="px-6 py-3">Cotes</th>
                        <th scope="col" class="px-6 py-3">action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($phaseAndSpeaker->intervenants as $i => $item)
                        <tr
                            class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                            <td class="px-6 py-4">{{ $item->id }}</td>
                            <td class="px-6 py-4">{{ $item->email }}</td>
                            <td class="px-6 py-4">
                                @if ($item->groupe_id ==0)
                                <span class="inline-flex items-center rounded-md bg-pink-50 px-2 py-1 text-xs font-medium text-pink-700 ring-1 ring-inset ring-pink-700/10">Seul(e)</span>
                                @else
                                <span class="inline-flex items-center rounded-md bg-green-50 px-2 py-1 text-xs font-medium text-green-700 ring-1 ring-inset ring-green-600/20">Team</span>
                                @endif
                            </td>
                            <td class="px-6 py-4">0</td>
                            <td class="px-4">
                                <a href="{{route('showIntervenant',$item->id)}}"
                                    class="px-3 text-sm  gap-3 font-medium text-center inline-flex items-center text-white bg-gray-700 hover:bg-gray-800 focus:ring-4 focus:ring-gray-300 focus:font-medium rounded-lg focus:text-sm focus:px-5 py-2.5 me-2  dark:bg-gray-600 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                                    <span class="text-md">Voter</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                        class="size-4">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 1 0 0-16 8 8 0 0 0 0 16ZM6.75 9.25a.75.75 0 0 0 0 1.5h4.59l-2.1 1.95a.75.75 0 0 0 1.02 1.1l3.5-3.25a.75.75 0 0 0 0-1.1l-3.5-3.25a.75.75 0 1 0-1.02 1.1l2.1 1.95H6.75Z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
   </section>
@endsection