<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rendelések') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    @foreach($orders as $key => $orderGroup)
                        @if(!empty($orderGroup))
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

                                @foreach($orderGroup as $order)
                                    <h1>{{$key}}</h1>
                                    <tr>
                                        <td class="border border-black ...">{{$order->customer_name}}</td>
                                        <td class="border border-black ...">{{$order->order_date}}</td>
                                        <td class="border border-black ...">
                                            @if(!is_null((array)json_decode($order->products_with_quantity)))
                                                @foreach ((array)json_decode($order->products_with_quantity) as $product)
                                                    @foreach($product as $key => $value)
                                                        <ul>
                                                            <li><strong>{{$key}}: </strong>{{$value}}</li>
                                                        </ul>
                                                    @endforeach
                                                @endforeach
                                            @endif
                                        </td>
                                        <td class="border border-black ...">{{$order->state}}</td>
                                        <td class="border border-black ...">{{$order->shipment_date}}</td>
                                        <td class="border border-black ..."><a
                                                href="{{route('orders.show', $order->order_id)}}">{{__('Rendelés áttekintése')}}</a>
                                        </td>
                                        <td class="border border-black ..."><a
                                                href="{{route('orders.edit', $order->order_id)}}">{{__('Szerkesztés')}}</a>
                                        </td>
                                        <td class="border border-black ...">
                                            <form action="{{route('orders.destroy', $order->order_id)}}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit">{{__('Törlés')}}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
