<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>nka_shop</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

</head>
<body class="antialiased">
<div
    class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="text-sm text-gray-700 underline">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="text-sm text-gray-700 underline">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="ml-4 text-sm text-gray-700 underline">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>


@foreach($recommendedProducts as $category)
        @if($category->products->isNotEmpty())
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
                @foreach($category->products as $product)
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
                        <td class="border border-black ..."><a
                                href="{{route('products.edit', $product->getKey())}}">{{__('Szerkesztés')}}</a></td>
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
        @endif

    @endforeach

</body>
</html>
