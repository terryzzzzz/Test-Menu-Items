<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
</head>

<body class="antialiased">
    <div class="w-screen h-screen bg-blue-800 flex justify-center items-center">
        <ul>
            @if(count($items) > 0)
            @foreach ($items as $item)
            <li>{{ $item->label }}</li>
            <ul class="ml-5">
                @if(count($item->childitems))
                @foreach ($item->childitems as $subitems)
                @include('sub_items', ['sub_items' => $subitems])
                @endforeach
                @endif
            </ul>
            @endforeach
            @endif
        </ul>
    </div>
</body>

</html>