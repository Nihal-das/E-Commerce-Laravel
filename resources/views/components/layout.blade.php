<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        @vite(['resources/js/app.ts'])
        {{-- <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
        <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script> --}}

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
