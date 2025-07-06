<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plantcare - Home</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        /* Custom Keyframes for Animations (jika tidak ada di Tailwind secara default) */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeInScale {
            from { opacity: 0; transform: scale(0.9); }
            to { opacity: 1; transform: scale(1); }
        }
        .animate-fadeInUp { animation: fadeInUp 0.8s ease-out forwards; }
        .animate-fadeInScale { animation: fadeInScale 0.7s ease-out forwards; }
        .font-playfair { font-family: 'Playfair Display', serif; }
        .font-poppins { font-family: 'Poppins', sans-serif; }

        /* Cloak for Alpine.js */
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-[#f0f7f0] font-poppins antialiased overflow-x-hidden">
    <div class="page-container">
        <x-navbaruser />
        <main>
            @yield('content')
        </main>

        <x-footer />
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const animatedElements = document.querySelectorAll('.animation-delay');
            animatedElements.forEach((el, index) => {
                el.style.animationDelay = `${index * 0.2}s`;
            });
        });
    </script>
    @yield('scripts')
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</body>
</html>
