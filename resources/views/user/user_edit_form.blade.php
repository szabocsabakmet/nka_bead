<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Felhasználó Szerkesztés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('users.update', $user->getKey())}}" method="POST">
                        @method('put')
                        @csrf
                        <label for="balance">{{__('Egyenleg:')}}</label>
                        <input type="text" id="balance" name="balance" value="{{$user->balance}}"> <br>
                        <button type="submit">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
