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

        @php
        $messages = App\Models\Message::all();
        @endphp

        {{-- <div class="card">--}}
        {{-- <p> {{ $messages }}</p>--}}
        {{-- </div>--}}

        @foreach ($messages as $message)
        <div class="flex-1 card">
            <div class="flex justify-between items-center">
                <div>
                    <span class="text-gray-800">{{ $message->user }}</span>
                    <small class="ml-2 text-sm text-gray-600">{{ $message->created_at->format('j M Y, g:i a') }}</small>
                    <form method="POST" action="{{ route('messages.destroy', $message) }}">
                        @csrf
                        @method('delete')
                        <x-dropdown-link :href="route('messages.destroy', $message)" onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Delete') }}
                        </x-dropdown-link>
                    </form>
                    @unless ($message->created_at->eq($message->updated_at))
                        <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                        @endunless
                    <x-dropdown>
                        <!-- <x-slot name="trigger">
                            <button>
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            </button>
                        </x-slot> -->
                        <x-slot name="content">
                            <a :href="route('messages.edit', $message)">
                                {{ __('Edit') }}
                            </a>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
            <p class="mt-4 text-lg text-gray-900">{{ $message->message }}</p>
        </div>
        @endforeach

        <form method="POST" action="{{ route('messages.store') }}">
            @csrf
            <textarea name="message" placeholder="Add a comment"></textarea>
            <button type="submit">Send</button>
        </form>

    </main>
</body>

</html>