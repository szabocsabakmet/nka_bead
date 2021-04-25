<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rendelés áttekintés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <table class="border-separate border border-black ...">
                        <thead>
                        <tr>
                            <th class="border border-black ...">{{__('Vásárló')}}</th>
                            <th class="border border-black ...">{{__('Rendelés napja')}}</th>
                            <th class="border border-black ...">{{__('Termékek')}}</th>
                            <th class="border border-black ...">{{__('Állapot')}}</th>
                            <th class="border border-black ...">{{__('Kiszállítás')}}</th>
                            <th class="border border-black ...">{{__('Szerkesztés')}}</th>
                            <th class="border border-black ...">{{__('Törlés')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="border border-black ...">{{$order->customer->name}}</td>
                            <td class="border border-black ...">{{date_format($order->order_date, 'Y-M-d')}}</td>
                            <td class="border border-black ...">
                                @if($products->isNotEmpty())
                                    <table class="border-separate border border-black ...">
                                        <thead>
                                        <tr>
                                            <th class="border border-black ...">{{__('Termék név')}}</th>
                                            <th class="border border-black ...">{{__('Ár')}}</th>
                                            <th class="border border-black ...">{{__('Kategória')}}</th>
                                            <th class="border border-black ...">{{__('Mennyiség')}}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td class="border border-black ...">{{$product->name}}</td>
                                                <td class="border border-black ...">{{$product->price}}</td>
                                                <td class="border border-black ...">{{$product->category->name}}</td>
                                                <td class="border border-black ...">{{$quantities[$product->getKey()]}}</td>
                                        @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </td>
                            <td class="border border-black ...">{{$order->state}}</td>
                            <td class="border border-black ...">@if(!is_null($order->shipment)) {{$order->shipment->shipment_date}} @endif</td>
                            <td class="border border-black ..."><a
                                    href="{{route('orders.edit', $order->getKey())}}">{{__('Szerkesztés')}}</a>
                            </td>
                            <td class="border border-black ...">
                                <form action="{{route('orders.destroy', $order->getKey())}}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit">{{__('Törlés')}}</button>
                                </form>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
