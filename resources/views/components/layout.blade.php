<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite(['resources/js/app.ts'])

         <title>{{ $heading ?? 'E-Commerce' }}</title>
    </head>
    <body>
        
            
        
        @auth
        @if (! request()->is('success'))
            <x-nav></x-nav>
            @endif
        @endauth
        
       {{ $slot }}

    
       
 
 
    </body>
</html>
