@extends('layouts.template')
@section('content')
<section class="">
    <h1 class="mt-2  text-3xl font-bold">Vote</h1>
    <p class="mb-5 font-extralight text-gray-500  text-justify sm:w-3/4">Vous trouverez ici la liste des critères lié à cette phase spécifique de la compétition. Chaque candidat est évaluer a l'aide des ces cri-ères.</p>
    <section class="mx-auto w-1/2 space-y-5">
        <div class="px-5 w-full space-y-2">
             <div class="px-5 py-3 bg-white flex justify-between items-center rounded-xl border drop-shadow-xl">
                 <h1 class="text-xl font-bold">1 Critères</h1>
                 <span class="text-sm font-thin">Ponderation : 30</span>
             </div>
             <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
                <div class=""> 
                     <h2 class="text-md font-bold mb-1">Déscription</h2>
                     <p class="text-sm font-thin pb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In aliquid eligendi amet dolore  dolor sit, amet consectetur adipisi ab nam explicabo.</p>
                 </div>
                 <div class="relative">
                     <label for="labels-range-input" class="sr-only">Labels range</label>
                     <input id="medium-range" type="range" value="0" min="50" max="100" class="w-full h-2  bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                 </div>
                 <div class="flex justify-between items-center">
                     <h1 class="text-md font-bold">Mention</h1>
                     <span class="text-sm font-thin">Score : 0.0</span>
                 </div>
             </div>
        </div>
        <div class="px-5 w-full space-y-2">
            <div class="px-5 py-3 bg-white flex justify-between items-center rounded-xl border drop-shadow-xl">
                <h1 class="text-xl font-bold">2 Critères</h1>
                <span class="text-sm font-thin">Ponderation : 30</span>
            </div>
            <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
               <div class=""> 
                    <h2 class="text-md font-bold mb-1">Déscription</h2>
                    <p class="text-sm font-thin pb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In aliquid eligendi amet dolore  dolor sit, amet consectetur adipisi ab nam explicabo.</p>
                </div>
                <div class="relative">
                    <label for="labels-range-input" class="sr-only">Labels range</label>
                    <input id="medium-range" type="range" value="0" min="50" max="100" class="w-full h-2  bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                </div>
                <div class="flex justify-between items-center">
                    <h1 class="text-md font-bold">Mention</h1>
                    <span class="text-sm font-thin">Score : 0.0</span>
                </div>
            </div>
       </div>
       <div class="px-5 w-full space-y-2">
        <div class="px-5 py-3 bg-white flex justify-between items-center rounded-xl border drop-shadow-xl">
            <h1 class="text-xl font-bold">3 Critères</h1>
            <span class="text-sm font-thin">Ponderation : 30</span>
        </div>
        <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
           <div class=""> 
                <h2 class="text-md font-bold mb-1">Déscription</h2>
                <p class="text-sm font-thin pb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In aliquid eligendi amet dolore  dolor sit, amet consectetur adipisi ab nam explicabo.</p>
            </div>
            <div class="relative">
                <label for="labels-range-input" class="sr-only">Labels range</label>
                <input id="medium-range" type="range" value="0" min="50" max="100" class="w-full h-2  bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
            </div>
            <div class="flex justify-between items-center">
                <h1 class="text-md font-bold">Mention</h1>
                <span class="text-sm font-thin">Score : 0.0</span>
            </div>
        </div>
   </div>
   <div class="px-5 w-full space-y-2">
    <div class="px-5 py-3 bg-white flex justify-between items-center rounded-xl border drop-shadow-xl">
        <h1 class="text-xl font-bold">4 Critères</h1>
        <span class="text-sm font-thin">Ponderation : 30</span>
    </div>
    <div class="px-5 py-3 rounded-xl border bg-white space-y-3 drop-shadow-xl">
       <div class=""> 
            <h2 class="text-md font-bold mb-1">Déscription</h2>
            <p class="text-sm font-thin pb-2">Lorem ipsum dolor sit, amet consectetur adipisicing elit. In aliquid eligendi amet dolore  dolor sit, amet consectetur adipisi ab nam explicabo.</p>
        </div>
        <div class="relative">
            <label for="labels-range-input" class="sr-only">Labels range</label>
            <input id="medium-range" type="range" value="0" min="50" max="100" class="w-full h-2  bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
        </div>
        <div class="flex justify-between items-center">
            <h1 class="text-md font-bold">Mention</h1>
            <span class="text-sm font-thin">Score : 0.0</span>
        </div>
    </div>
</div>
     </section>
</section>
   
@endsection