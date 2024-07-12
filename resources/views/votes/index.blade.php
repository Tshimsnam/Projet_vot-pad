@extends('layouts.template')
@section('content')
<div class="p-0 m-0">
    <h1 class="mt-2 text-3xl font-bold dark:text-white">Toutes les phases</h1>
    <p class="mb-5 font-extralight text-gray-500  text-justify dark:text-white sm:w-3/4">Bienvenue sur la page dédiée aux différentes phases de nos compétitions. Ici, vous pouvez explorer chaque étape du concours, de la présélection initiale aux finales palpitantes. Chaque phase est décrite en détail pour vous permettre de comprendre les critères, les objectifs et les dates clés. Suivez l'évolution des participants à travers les différentes étapes et découvrez les moments forts de la compétition.</p>
    @foreach ($phases as $phase)
    <section class="sm:mx-auto md:w-3/4 space-y-5">
      <div x-data="{status: '{{$phase->statut}}'}">
        <a
        :href="status != 'active' ? 'javascript:void(0)' : '{{route('show',$phase->slug)}}'"
        :class="status != 'active' ? 'bg-gray-500 text-gray-300 cursor-not-allowed' : ''"
        class="block mb-4 border-0 hover:border border-orange-400 rounded "
        >
            <section class="border rounded p-2 bg-neutral-200 flex gap-6 items-center dark:bg-white">
                <div class="text-gray-600 ">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-8 mx-2">
                    <path d="M11.644 1.59a.75.75 0 0 1 .712 0l9.75 5.25a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.712 0l-9.75-5.25a.75.75 0 0 1 0-1.32l9.75-5.25Z" />
                    <path d="m3.265 10.602 7.668 4.129a2.25 2.25 0 0 0 2.134 0l7.668-4.13 1.37.739a.75.75 0 0 1 0 1.32l-9.75 5.25a.75.75 0 0 1-.71 0l-9.75-5.25a.75.75 0 0 1 0-1.32l1.37-.738Z" />
                    <path d="m10.933 19.231-7.668-4.13-1.37.739a.75.75 0 0 0 0 1.32l9.75 5.25c.221.12.489.12.71 0l9.75-5.25a.75.75 0 0 0 0-1.32l-1.37-.738-7.668 4.13a2.25 2.25 0 0 1-2.134-.001Z" />
                    </svg>
                </div>
                <div class="flex w-full flex-col xs:flex-col xs:gap-0 sm:flex-row sm:gap-4 sm:justify-between">
                    <div class="">
                        <h2 class="font-semibold text-lg capitalize sm:text-2xl">
                            {{$phase->nom}}
                        </h2>
                        <p>{{$phase->description}}</p>
                    </div>
                    <div class="">
                        <span class="text-gray-600 text-xs">
                            {{ date('d-m-y', strtotime($phase->date_debut))}} - {{ date('d-m-y', strtotime($phase->date_fin))}}
                        </span>
                    </div>
                </div>
            </section>
           </a>
      </div>
    </section>
    @endforeach
</div>
@endsection