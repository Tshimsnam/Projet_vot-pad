@extends('layouts.template')
@section('content')
    <section class="dark:bg-gray-900">
        <div class="flex flex-col items-center justify-center px-6 py-8 mx-auto md:h-screen lg:py-0">
            <a href="#" class="flex items-center mb-6 text-2xl font-semibold text-gray-900 dark:text-white">
                <img class="w-8 h-8 mr-2"
                    src="https://upload.wikimedia.org/wikipedia/commons/a/ac/Eo_circle_orange_letter-v.svg" alt="logo">
                VotePad2
            </a>
            <div
                class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
                <p class="mb-4 text-sm font-normal text-gray-500 dark:text-gray-400">
                    Merci pour votre participation
                </p>
            </div>
        </div>
    </section>
@endsection
