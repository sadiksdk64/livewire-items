<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('assets/styles/dashboard.css') }}" />
        <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
        @livewireStyles
        
    </head>
    <body>
        <script src="{{ mix('assets/scripts/admin.js') }}"></script>
        <script src="{{ mix('js/app.js') }}"></script>
        @livewireScripts
       

            <div class="card border">
                <div class="card-body">
            
                @livewire('items')

                </div>
            </div>
        
    </body>
</html>
