<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Pemilih</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Selamat datang, {{ Auth::user()->fullname }}</h1>
    <p>Anda login sebagai <span class="font-semibold">Pemilih</span>.</p>
    <p class="mt-2 text-gray-600">Silakan pilih menu voting di sebelah kiri.</p>
  </div>
</body>
</html>
