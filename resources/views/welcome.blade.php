<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>nka_shop</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

</head>
<body class="antialiased">
<div
    class="float-right">
    @if (Route::has('login'))
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            @auth
                <a href="{{ url('/dashboard') }}" class="btn btn-blue">Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn btn-blue">Log in</a>

                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="btn btn-blue">Register</a>
                @endif
            @endauth
        </div>
    @endif
</div>
<h1>Ajánlott, új termékek (5db kategóriánként)</h1>
<table class="table col-10">
    <thead>
    <tr>
        <th class="border border-black ...">{{__('Név')}}</th>
        <th class="border border-black ...">{{__('Ár')}}</th>
        <th class="border border-black ...">{{__('Leírás')}}</th>
        <th class="border border-black ...">{{__('Jellemzők')}}</th>
        <th class="border border-black ...">{{__('Kategória')}}</th>
    </tr>
    </thead>
     <tbody>
                @foreach($recommendedProducts as $product)
                    <tr>
                        <td class="border border-black ...">{{$product->name}}</td>
                        <td class="border border-black ...">{{$product->price}}</td>
                        <td class="border border-black ...">{{$product->description}}</td>
                        <td class="border border-black ...">
                            @if(!is_null((array)json_decode($product->attributes)))
                                @foreach ((array)json_decode($product->attributes) as $key => $value)
                                    <ul>
                                        <li><strong>{{$key}}: </strong>{{$value}}</li>
                                    </ul>
                                @endforeach
                            @endif
                        </td>
                        <td class="border border-black ...">{{$product->category_name}}</td>
                    </tr>

                @endforeach
                </tbody>
            </table>

</body>
</html>
