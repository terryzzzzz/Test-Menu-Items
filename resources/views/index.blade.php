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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    <div class="w-screen h-screen flex justify-center items-center">
        <div class="container">
            <ul class="list-disc">
                @if(count($items) > 0)
                @foreach ($items as $item)
                <li class="flex items-center">
                    <span class="mr-2">-</span>
                    <input class="itemInput peer py-1 px-2 rounded-md border border-gray-300 border-opacity-0 focus:border-opacity-100 focus:outline-none transition" data-id={{ $item->id }} type="text" value="{{ $item->label }}">
                    <button class="itemSubmit block bg-green-600 py-1 px-2 text-white text-xs rounded-lg ml-2 focus:outline-none">Update</button>
                </li>
                <ul class="ml-5 list-disc">
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
    </div>
</body>

<script>
    $(document).ready(function() {
        $('button.itemSubmit').each(function() {
            $(this).click(function() {
                const label = $(this).siblings('input.itemInput').val();
                const id = $(this).siblings('input.itemInput').data('id');

                $.post('/api/edit', {
                        id: id,
                        label: label
                    },
                    function(data, status) {
                        if (status === 'success') {
                            alert("Data has been updated successfully.");
                        } else {
                            alert("Sorry but data failed to update.");
                        }
                        location.reload(true);
                    })
            })
        })

    })
</script>

</html>