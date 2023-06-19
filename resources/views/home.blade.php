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

            <form>
                <input type="text" placeholder="Add a comment">
                <button>Send</button>
            </form>

        </main>
    </body>
</html>
