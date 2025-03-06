<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex flex-col justify-center items-center">
    <h1 class="text-4xl font-bold text-gray-600">WELCOME TO E-STORE</h1>
    <p class="mt-4 text-lg text-gray-700">FIND OTHER PRODUCT QUALITY IN HERE.</p>
    <nav class="bg-white shadow-md fixed top-0 left-0 w-full z-50">
        <div class="container mx-auto px-6 py-4 flex justify-between items-center">
            <!--navbar-->
            <nav class="bg-blue-100 shadow-md fixed top-0 left-0 w-full z-50">
                <div class="container mx-auto px-6 py-4 flex justify-between items-center">
                    <div class="hidden md:flex space-x-6 items-center">
                        <a href="/" class="text-gray-700 hover:text-blue-500 transition">Home</a>
        
                        <!-- Dropdown Products -->
                        <div class="relative group">
                            <button class="text-gray-700 hover:text-blue-500 transition flex items-center">
                                Products
                                <svg class="ml-1 w-4 h-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                            <div class="absolute hidden group-hover:block bg-white shadow-lg rounded-lg mt-2 w-48 border border-gray-200 transition-all duration-300 opacity-0 group-hover:opacity-100">
                                <a href="/category/food-beverage" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Food & Beverage</a>
                                <a href="/category/beauty-health" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Beauty & Health</a>
                                <a href="/category/home-care" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Home Care</a>
                                <a href="/category/baby-kid" class="block px-4 py-2 text-gray-700 hover:bg-blue-100">Baby & Kid</a>
                            </div>
                        </div>
                        <a href="/sales" class="text-gray-700 hover:text-blue-500 transition">Sales</a>
                        <a href="/user/1/name/Erik" class="text-gray-700 hover:text-blue-500 transition">Profile</a>
                    </div>
</body>
</html>