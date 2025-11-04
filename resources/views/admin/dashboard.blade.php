<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
  <div class="p-6">
    <h1 class="text-2xl font-bold mb-4">Halo, {{ Auth::user()->fullname }}</h1>
    <p>Anda login sebagai <span class="font-semibold text-blue-600">Admin</span>.</p>
    <ul class="mt-4 space-y-2 text-blue-600">
      <li><a href="#">Kelola Kandidat</a></li>
      <li><a href="#">Kelola Pemilih</a></li>
      <li><a href="#">Lihat Hasil Voting</a></li>
      <li><a href="#">Atur Periode Voting</a></li>
    </ul>
  </div>
</body>
</html>
