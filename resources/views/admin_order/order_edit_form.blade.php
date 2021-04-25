<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Rendelés Szerkesztés') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form action="{{route('orders.update', $order->getKey())}}" method="POST">
                        @method('put')
                        @csrf
                        <h1>{{__('Állapot:')}}</h1>
                        <input type="radio" id="not_paid" name="state" value="not_paid">
                        <label for="not_paid">Nincs fizetve</label><br>
                        <input type="radio" id="paid" name="state" value="paid">
                        <label for="paid">Fizetve</label><br>
                        <input type="radio" id="delivered" name="state" value="delivered">
                        <label for="delivered">Kiszállítva</label><br>



                        <label for="shipment_date">{{__('Kiszállítás:')}}</label>
                        <input type="date" id="shipment_date" name="shipment_date" @if(!is_null($order->shipment)) value=" {{$order->shipment->shipment_date}} " @endif> <br>


                        <button type="submit">Mentés</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
