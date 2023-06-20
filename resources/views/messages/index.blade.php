<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Interactive comments section</title>
    @vite('resources/css/style.css')
</head>

<body>
<main>
    <div class="card">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum diam sed tellus iaculis.</p>
    </div>

    <div class="card">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum diam sed tellus iaculis.</p>
    </div>

    <div class="card">
        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed fermentum diam sed tellus iaculis.</p>
    </div>

    <form method="POST" action="{{ route('messages.store') }}">
        @csrf
        <textarea placeholder="Add a comment"></textarea>
        <button>Send</button>
    </form>

    @foreach ($messages as $message)

            <div class="flex-1">
                <div class="flex justify-between items-center">
                    <div>
{{--                        <span class="text-gray-800">{{ $message->user->name }}</span>--}}
                        <small class="ml-2 text-sm text-gray-600">{{ $message->created_at->format('j M Y, g:i a') }}</small>
                    </div>
                </div>
                <p class="mt-4 text-lg text-gray-900">{{ $message->message }}</p>
            </div>
    @endforeach

</main>
</body>
</html>
