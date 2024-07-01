<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage | Filmyfy</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="../assets/style/style.css">
</head>
<body>

    <!-- Navbar Start -->
    <nav class="py-4 px-8 bg-slate-800 text-gray-200">
        <div class="container mx-auto">
            <div class="flex justify-between">
                <h1 class="italic font-extrabold">Filmyfy</h1>
                <a href="">Login</a>
            </div>
        </div>
    </nav>
    <!-- Navbar end -->

    <!-- Main Start-->
    <div class="container mx-auto p-4">
        <div class="relative w-full overflow-hidden h-96">
            <div class="absolute inset-0 flex flex-col items-center justify-center text-white z-10">
                <h1 class="text-5xl mb-4 text-black">"Pemesanan Tiket Mudah, <br>Keajaiban Film Tak Terbatas!"</h1>
                <h2 class="text-2xl">Pesan Tiket Mu Sekarang <br>Agar tidak Terlewat <br>Film Film Populer Saat ini!</h2>
                <div class="mt-4">
                    <button class="bg-blue-500 text-white px-4 py-2 rounded">Download</button>
                    <button class="bg-gray-500 text-white px-4 py-2 rounded ml-2">Download</button>
                </div>
            </div>
            <div class="flex transition-transform duration-500 ease-in-out" id="carousel-track">
                <div class="min-w-full bg-cover bg-center h-96" style="background-image: url('/path/to/your/image1.jpg');"></div>
                <div class="min-w-full bg-cover bg-center h-96" style="background-image: url('/path/to/your/image2.jpg');"></div>
                <div class="min-w-full bg-cover bg-center h-96" style="background-image: url('/path/to/your/image3.jpg');"></div>
            </div>
        </div>
    </div>
    <!-- Main end -->
    <!-- Scrip JS -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const track = document.querySelector('.carousel-track');
            const items = document.querySelectorAll('.carousel-item');
            let index = 0; 

            function showNextSlide() {
                index = (index + 1) % items.length;
                track.style.transform = `translateX(-${index * 100}%)`;
            }

            setInterval(showNextSlide, 3000); // Change slide every 3 seconds
        });
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
</body>
</html>