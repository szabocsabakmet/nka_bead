<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategória Létrehozás') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('categories.store')}}" method="POST">
                        @csrf
                        <label for="name">{{__('Kategória név:')}}</label>
                        <input type="text" id="name" name="name"> <br>
                        <button type="submit">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
