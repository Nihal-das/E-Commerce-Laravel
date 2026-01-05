<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />

    <!-- Mobile-first viewport (already good, keep it) -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    @vite(['resources/js/app.ts'])

    <!-- Tailwind (CDN only if you're prototyping) -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindplus/elements@1" type="module"></script>

    <title>{{ $heading ?? 'E-commerce' }}</title>
</head>

<body
    class="min-h-screen bg-gray-900 text-gray-100
           antialiased overflow-x-hidden">

    @auth
        @if (!request()->is('success'))
            <x-nav />
        @endif
    @endauth

    <!-- Page content -->
    <main class="relative">
        {{ $slot }}
    </main>

</body>
</html>


 {{-- use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Carbon;

class ImageUpload extends Model
{
    protected $fillable = ['file_name', 'file_path', 'user_id'];

    // Accessor for created_at
    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->format('d M Y, h:i A')
        );
    }

    // Optional: accessor for updated_at
    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Carbon::parse($value)->diffForHumans()
        );
    }
}
 --}}
