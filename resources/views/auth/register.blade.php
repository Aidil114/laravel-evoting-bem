<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Register - Sistem Voting Online Kampus</title>
    <script src="https://cdn.tailwindcss.com"></script>
  </head>
  <body class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-4 py-8">
    <div class="max-w-lg w-full space-y-8">
      <div class="text-center">
        <div class="mx-auto h-16 w-16 bg-blue-600 rounded-full flex items-center justify-center mb-4">
          <svg class="h-8 w-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
          </svg>
        </div>
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Voting Kampus Online</h1>
        <p class="text-gray-600">Buat akun baru untuk mulai voting</p>
      </div>

      <div class="bg-white rounded-xl shadow-lg p-8">
        <form method="POST" action="{{ route('register') }}" class="space-y-6">
          @csrf
          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="fullname" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap</label>
              <input type="text" name="fullname" id="fullname" value="{{ old('fullname') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Nama lengkap" required>
              @error('fullname')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="nim" class="block text-sm font-medium text-gray-700 mb-2">NIM</label>
              <input type="text" name="nim" id="nim" value="{{ old('nim') }}"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Nomor Induk Mahasiswa" required>
              @error('nim')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}"
              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
              placeholder="email@mahasiswa.ac.id" required>
            @error('email')
              <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
            @enderror
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="faculty" class="block text-sm font-medium text-gray-700 mb-2">Fakultas</label>
              <select name="faculty" id="faculty"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">Pilih Fakultas</option>
                <option value="FT">FT</option>
                <option value="FEB">FEB</option>
                <option value="FH">FH</option>
                <option value="FK">FK</option>
                <option value="FMIPA">FMIPA</option>
                <option value="FISIP">FISIP</option>
                <option value="FAPERTA">FAPERTA</option>
                <option value="FAPERIKA">FAPERIKA</option>
              </select>
              @error('faculty')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="major" class="block text-sm font-medium text-gray-700 mb-2">Jurusan</label>
              <select name="major" id="major"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500" required>
                <option value="">Pilih Jurusan</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Teknik Elektro">Teknik Elektro</option>
                <option value="Teknik Mesin">Teknik Mesin</option>
                <option value="Teknik Sipil">Teknik Sipil</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
              </select>
              @error('major')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>
          </div>

          <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
              <input type="password" name="password" id="password"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Minimal 8 karakter" required>
              @error('password')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
              @enderror
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password</label>
              <input type="password" name="password_confirmation" id="password_confirmation"
                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500"
                placeholder="Ulangi password" required>
            </div>
          </div>

          <button type="submit"
            class="w-full bg-blue-600 text-white py-3 rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500">
            Daftar Akun
          </button>

          <div class="text-center">
            <span class="text-gray-600">Sudah punya akun?</span>
            <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-500 font-medium">Masuk sekarang</a>
          </div>
        </form>
      </div>

      <div class="text-center">
        <p class="text-sm text-gray-500">© 2024 Sistem Voting Online Kampus. All rights reserved.</p>
      </div>
    </div>
  </body>
</html>
