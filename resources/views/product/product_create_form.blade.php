<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Termék Létrehozás') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('products.store')}}" method="POST">
                        @csrf
                        <label for="name">{{__('Termék név:')}}</label>
                        <input type="text" id="name" name="name"> <br>
                        <label for="price">{{__('Termék ár:')}}</label>
                        <input type="number" id="price" name="price" > <br>
                        <label for="description">{{__('Termék Leírás:')}}</label>
                        <input type="text" id="description" name="description" > <br>
                        <label for="attributes">{{__('Termék jellemzők (kulcs érték párok vesszővel elválasztva példa: <jellemző név>=<jellemző érték>,<jellemző név>=<jellemző érték>):')}}</label>
                        <input type="text" id="attributes" name="attributes" > <br>
                        <label>{{__('Termék Kategória:')}}</label><br>
                        @foreach($categories as $category_id => $category)
                            <input type="radio" id="{{$category}}" name="category_id" value="{{$category_id}}" >
                            <label for="{{$category}}">{{$category}}</label><br>
                        @endforeach
                        <button type="submit">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
