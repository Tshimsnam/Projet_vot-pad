<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Resultat des votes') }}
            </h2>
        </div>
    </x-slot>


    <div class="relative overflow-x-auto shadow-md sm:rounded-lg" style="padding-top: 10px;">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-2">N°</th>
                    <th scope="col" class="py-2">Nom</th>
                    <th scope="col" class="py-2">Email</th>
                    <th scope="col" class="py-2">Image</th>
                    <th scope="col" class="py-2">Cote moyenne</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($intervenants as $i => $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-2">{{ $i + 1 }}</td>
                        <th scope="row" class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nom_groupe }}</th>
                        <th scope="row" class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->email }}</th>
                        <th scope="row" class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ $item->image ? asset($item->image) : asset('images/profil.jpg') }}"
                                width="40" height="40" class="img img-responsive" />
                        </th>
                        <th scope="row" class=" py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->cote }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</x-app-layout>
