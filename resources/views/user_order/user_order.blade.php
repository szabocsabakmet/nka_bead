<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Saját Rendelések') }}
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
                            <th class="border border-black ...">{{__('Rendelés áttekintése')}}</th>
                            <th class="border border-black ...">{{__('Szerkesztés')}}</th>
                            <th class="border border-black ...">{{__('Törlés')}}</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($orders as $order)
                            <tr>
                                <td class="border border-black ...">{{$order->customer->name}}</td>
                                <td class="border border-black ...">{{date_format($order->order_date, 'Y-M-d')}}</td>
                                <td class="border border-black ...">
                                    @if(!is_null($order->products_with_quantity))
                                        @foreach ($order->products_with_quantity as $product)
                                            @foreach($product as $key => $value)
                                                <ul>
                                                    <li><strong>{{$key}}: </strong>{{$value}}</li>
                                                </ul>
                                            @endforeach
                                        @endforeach
                                    @endif
                                </td>
                                <td class="border border-black ...">{{$order->state}}</td>
                                <td class="border border-black ...">@if(!is_null($order->shipment)) {{$order->shipment->shipment_date}} @endif</td>
                                <td class="border border-black ..."><a
                                        href="{{route('userorders_show', $order->getKey())}}">{{__('Rendelés áttekintése')}}</a>
                                </td>
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
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
