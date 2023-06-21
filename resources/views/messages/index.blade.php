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

        @php
            $messages = App\Models\Message::all();
        @endphp

        @if($messages->isNotEmpty())
            @foreach ($messages as $message)
                <div class="flex-1 card">
                    <div class="flex justify-between items-center">
                        <div>
                            <span class="text-gray-800">{{ $message->user }}</span>

                            <small class="ml-2 text-sm text-gray-600">{{ $message->created_at->format('j M Y, g:i a') }}</small>

                            @unless ($message->created_at->eq($message->updated_at))
                                <small class="text-sm text-gray-600"> &middot; {{ __('edited') }}</small>
                            @endunless

                            <div>
                                <span> Vote: {{$message->vote_count}}</span>
                                <button>+</button>
                                <button>-</button>
                            </div>

                            <form method="POST" action="{{ route('messages.destroy', $message) }}">
                                @csrf
                                @method('delete')
                                <x-dropdown-link :href="route('messages.destroy', $message)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Delete') }}
                                </x-dropdown-link>
                            </form>

                            <form method="GET" action="{{ route('messages.edit', $message) }}">
                                @csrf
                                @method('edit')
                                <x-dropdown-link :href="route('messages.edit', $message)" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Edit') }}
                                </x-dropdown-link>
                            </form>

{{--                            <x-dropdown>--}}
{{--                                <x-slot name="content">--}}
{{--                                    <a :href="route('messages.edit', $message)">--}}
{{--                                        {{ __('Edit') }}--}}
{{--                                    </a>--}}
{{--                                </x-slot>--}}
{{--                                <x-slot name="trigger">--}}
{{--                                    <a :href="route('messages.edit', $message)">--}}
{{--                                        {{ __('Edit') }}--}}
{{--                                    </a>--}}
{{--                                </x-slot>--}}
{{--                            </x-dropdown>--}}
                        </div>
                    </div>
                    <p class="mt-4 text-lg text-gray-900">{{ $message->message }}</p>
                </div>
            @endforeach
        @else
            <p>No messages found.</p>
        @endif

        <form method="POST" action="{{ route('messages.store') }}">
            @csrf
            <textarea name="message" placeholder="Add a comment"></textarea>
            <button type="submit">Send</button>
        </form>

    </main>
</body>

</html>
