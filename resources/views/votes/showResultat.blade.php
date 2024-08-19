<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Résultat des votes') }}
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
                    <th id="priveTh" scope="col" class="py-2">
                        Cote privé (Pond : {{ $ponderationJuryPrive }})
                    </th>
                    <th id="publicTh" scope="col" class="py-2">
                        Cote public (Pond : {{ $ponderationJuryPublic }})
                    </th>
                    <th scope="col" class="py-2">Cote total</th>
                    <th scope="col" class="py-2">Pourcentage</th>
                    <th scope="col" class="py-2">Nombre jury</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($intervenants as $i => $item)
                    <tr
                        class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                        <td class="px-6 py-2">{{ $i + 1 }}</td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nom_groupe }}
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->email }}
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            <img src="{{ $item->image ? asset($item->image) : asset('images/profil.jpg') }}"
                                width="40" height="40" class="img img-responsive" />
                        </td>
                        <td id="priveTb{{ $i }}"
                            class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->votePrive }}
                        </td>
                        <td id="publicTb{{ $i }}"
                            class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->votePublic }}
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->cote }}
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->pourcentage }}%
                        </td>
                        <td class="py-2 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ $item->nombreJury }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        window.onload = function() {
            initial("{{ $typeVote }}");
        };

        function initial(typeVote) {
            const priveTh = document.getElementById("priveTh");
            const publicTh = document.getElementById("publicTh");

            // Hide all td elements with id starting with "priveTb" or "publicTb"
            document.querySelectorAll('[id^="priveTb"]').forEach(el => el.style.display = "none");
            document.querySelectorAll('[id^="publicTb"]').forEach(el => el.style.display = "none");

            // Hide the headers based on typeVote
            if (typeVote !== 'prive et public') {
                priveTh.style.display = "none";
                publicTh.style.display = "none";
            } else {
                // If 'prive et public', show the relevant elements
                document.querySelectorAll('[id^="priveTb"]').forEach(el => el.style.display = "");
                document.querySelectorAll('[id^="publicTb"]').forEach(el => el.style.display = "");
                priveTh.style.display = "";
                publicTh.style.display = "";
            }
        }
    </script>

</x-app-layout>
