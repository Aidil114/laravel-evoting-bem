🗳️ Sistem E-Voting BEM

Aplikasi e-voting berbasis Laravel untuk pemilihan Ketua BEM universitas.
Proyek ini memiliki 2 role: Admin dan Pemilih (Mahasiswa), dilengkapi fitur manajemen kandidat, pemilih, voting, hasil voting, dan pengaturan periode pemilihan.

📚 Daftar Isi

1.Fitur Utama
2.Role & Hak Akses
3.Instalasi
4.Konfigurasi Database
5.Menjalankan Aplikasi
6.Seeder (Data Admin & User)
7.Teknologi
8.Lisensi

✨ Fitur Utama
👨‍💼 Admin

Login admin dashboard

Manajemen kandidat (CRUD)

Manajemen pemilih (CRUD)

Manajemen admin (CRUD)

Melihat hasil voting secara realtime

Menentukan periode voting

Validasi agar voting hanya aktif saat periode berjalan

👨‍🎓 Mahasiswa (User)

Register & login

Dashboard statistik pemilihan

Melihat daftar kandidat

Voting satu kali saja

Melihat hasil voting setelah memilih atau setelah voting selesai

🔐 Role & Hak Akses
Role Hak Akses
Admin Kelola kandidat, pemilih, periode, hasil voting, dashboard admin
User Voting 1x, lihat hasil, akses dashboard mahasiswa
Guest Tidak bisa voting / melihat kandidat
⚙️ Instalasi
1️⃣ Clone Repository
git clone https://github.com/Aidil114/evoting-bem.git
cd evoting-bem

2️⃣ Checkout ke Branch Development
git checkout dev

🗄️ Konfigurasi Database

1. Copy file env
   cp .env.example .env

Windows:

copy .env.example .env

2. Setup koneksi database di .env
   DB_DATABASE=evoting_bem
   DB_USERNAME=root
   DB_PASSWORD=

3. Generate key aplikasi
   php artisan key:generate

▶️ Menjalankan Aplikasi
Install dependency composer:
composer install

Install dependency NPM:
npm install
npm run dev

Migrasi database:
php artisan migrate

Jalankan seeder (data default admin & user):
php artisan db:seed

Jalankan server:
php artisan serve

🌱 Seeder (Data Admin & User)
Admin Login Default
Email: admin@example.com
Password: password

User Login Default
Email: user@example.com
Password: password

Seeder terdapat di:

database/seeders/AdminSeeder.php
database/seeders/UserSeeder.php

🛠️ Teknologi

Laravel 10 / 11

TailwindCSS

MySQL

Blade Template

Laravel Breeze Authentication

📄 Lisensi

Proyek ini dibuat untuk keperluan tugas dan pendidikan. Bebas digunakan sesuai kebutuhan.

🚀 Selesai!
