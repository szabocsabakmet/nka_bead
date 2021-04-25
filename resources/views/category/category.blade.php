<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kategóriák') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('categories.create')}}">{{ __('Kategória hozzáadása') }}</a>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="border-separate border border-black ...">
                        <thead>
                        <tr>
                            <th class="border border-black ...">{{__('Név')}}</th>
                            <th class="border border-black ...">{{__('Szerkesztés')}}</th>
                            <th class="border border-black ...">{{__('Törlés')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $category)
                            <tr>
                                <td class="border border-black ...">{{$category->name}}</td>
                                <td class="border border-black ..."><a href="{{route('categories.edit', $category->getKey())}}">{{__('Szerkesztés')}}</a></td>
                                <td class="border border-black ...">
                                    <form action="{{route('categories.destroy', $category->getKey())}}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">{{__('Törlés')}}</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
