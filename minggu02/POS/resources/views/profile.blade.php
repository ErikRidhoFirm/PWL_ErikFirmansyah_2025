<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pengguna</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen flex flex-col justify-center items-center">
    <div class="bg-white rounded-lg p-8 max-w-lg text-center">

        <h1 class="text-3xl font-bold text-gray-800 mt-4">Profil Pengguna</h1>
            <p class="text-gray-700"><strong>ID:</strong> {{ $id }}</p>
            <p class="text-gray-700"><strong>Nama:</strong> {{ $name }}</p>
        </div>

        <!-- Tombol Kembali ke Home -->
        <a href="/" class="mt-4 inline-block bg-green-500 text-white px-6 py-2 rounded-lg shadow-md">
            Kembali ke Home
        </a
    </div>
</body>
</html>
