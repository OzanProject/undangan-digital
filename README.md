## 🌟 Tentang Proyek: Undangan Khitan Digital

**Undangan Khitan Digital** adalah solusi *web-based* yang dikembangkan menggunakan **Laravel Framework** untuk memodernisasi proses pembuatan dan distribusi undangan acara Khitanan. Aplikasi ini menyediakan antarmuka administrasi yang *powerful* untuk mengelola detail acara, daftar tamu, dan kustomisasi tampilan, memberikan pengalaman yang **efisien** dan **estetis** bagi penyelenggara.

---

## ✨ Fitur Utama (Core Features)

Aplikasi ini mencakup modul-modul berikut untuk pengelolaan acara yang komprehensif:

* **Manajemen Tamu (Guest Management):** Implementasi **CRUD** (Create, Read, Update, Delete) penuh untuk pendaftaran tamu, *tracking* konfirmasi kehadiran (RSVP), dan manajemen data kontak.
* **Kustomisasi Tampilan:** Sistem *templating* dinamis yang memungkinkan administrator untuk mengaplikasikan berbagai **tema**, mengunggah **aset visual**, dan menyematkan **musik latar** (MP3/WAV).
* **Pengelolaan Aset Media:** Integrasi **Laravel Storage** untuk penanganan *file upload* dan *serving* aset digital secara aman dan terorganisir.
* **Panel Administrasi:** Antarmuka *backend* yang intuitif untuk **konfigurasi acara** (tanggal, waktu, lokasi) dan pemantauan data.
* **Ekspor Data Profesional:** Kemampuan untuk menghasilkan laporan daftar tamu dalam format **PDF** (didukung oleh `barryvdh/laravel-dompdf`) dan **Excel** untuk kebutuhan dokumentasi *offline*.
* **Respons Tamu (RSVP):** Implementasi formulir RSVP sederhana untuk memfasilitasi konfirmasi kehadiran tamu secara *real-time*.

---

## ⚙️ Persyaratan Sistem & Instalasi

Proyek ini memerlukan lingkungan *runtime* berikut:

| Kategori | Persyaratan |
| :--- | :--- |
| **Backend** | **PHP 8.1** atau lebih tinggi |
| **Framework** | Laravel 10.x atau 11.x |
| **Database** | MySQL, MariaDB, PostgreSQL, atau SQLite |
| **Dependensi** | Composer |
| **Frontend** | Node.js (untuk kompilasi *asset* menggunakan Vite/Mix) |

### Langkah Instalasi (Local Development)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di lingkungan lokal Anda:

1.  **Kloning Repositori:**
    ```bash
    git clone [https://github.com/ozanproj/undangan-khitan.git](https://github.com/ozanproj/undangan-khitan.git)
    cd undangan-khitan
    ```
2.  **Instal Dependensi PHP & JS:**
    ```bash
    composer install
    npm install
    npm run dev # Untuk kompilasi aset frontend
    ```
3.  **Konfigurasi Lingkungan:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Atur Database:**
    Edit file `.env` untuk mengatur koneksi database (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).
5.  **Migrasi & Seeding:**
    ```bash
    php artisan migrate --seed
    ```
    (Perintah `--seed` menjalankan *seeder* database untuk data awal, termasuk data admin.)
6.  **Buat Symlink Storage:**
    ```bash
    php artisan storage:link
    ```
    (Langkah ini **wajib** jika Anda mengunggah dan menampilkan file media melalui *disk* `public` Laravel.)

---

## 🤝 Kontribusi & Dukungan

Kontribusi dari komunitas sangat kami hargai. Jika Anda menemukan *bug* atau memiliki saran fitur, silakan ajukan **Issue** atau buat **Pull Request** ke repositori ini.

| Kategori | Detail Kontak |
| :--- | :--- |
| **Pengembang Utama** | **Ozan Project** |
| **Email Kontak** | ardiansyahdzan@gmail.com |
| **Dukungan** | Silakan ajukan Issue di GitHub |
| **Apresiasi (Traktir Ngopi)** | https://saweria.co/ozanproject |

## ⚖️ Lisensi Proyek

Kode sumber proyek **Undangan Khitan Digital** dilisensikan di bawah **MIT License**.

[Link ke MIT License](https://opensource.org/licenses/MIT)