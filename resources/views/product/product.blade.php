<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Termékek') }}
        </h2>
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <a href="{{route('products.create')}}">{{ __('Termék hozzáadása') }}</a>
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
                                <th class="border border-black ...">{{__('Ár')}}</th>
                                <th class="border border-black ...">{{__('Leírás')}}</th>
                                <th class="border border-black ...">{{__('Jellemzők')}}</th>
                                <th class="border border-black ...">{{__('Kategória')}}</th>
                                <th class="border border-black ...">{{__('Szerkesztés')}}</th>
                                <th class="border border-black ...">{{__('Törlés')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                                <tr>
                                    <td class="border border-black ...">{{$product->name}}</td>
                                    <td class="border border-black ...">{{$product->price}}</td>
                                    <td class="border border-black ...">{{$product->description}}</td>
                                    <td class="border border-black ...">
                                        @if(!is_null($product->attributes))
                                            @foreach ($product->attributes as $key => $value)
                                                <ul>
                                                    <li><strong>{{$key}}: </strong>{{$value}}</li>
                                                </ul>
                                            @endforeach
                                        @endif
                                    </td>
                                    <td class="border border-black ...">{{$product->category->name}}</td>
                                    <td class="border border-black ..."><a href="{{route('products.edit', $product->getKey())}}">{{__('Szerkesztés')}}</a></td>
                                    <td class="border border-black ...">
                                        <form action="{{route('products.destroy', $product->getKey())}}" method="POST">
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
