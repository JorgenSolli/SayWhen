<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>SayWhen</title>

        @include('parts.meta')
    </head>
    <body>
        <div id="app" class="app-content">
            <dju-hav-it></dju-hav-it>
        </div>

        <script src="{{ mix('/js/app.js') }}"></script>
    </body>
</html>
