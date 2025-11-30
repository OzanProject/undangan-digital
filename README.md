<p align="center">
    <img src="https://via.placeholder.com/400x150?text=LOGO+UNDANGAN+KHITAN" width="400" alt="Logo Undangan Khitan">
</p>

<p align="center">
    <a href="https://github.com/ozanproj/undangan-khitan/actions"><img src="https://github.com/ozanproj/undangan-khitan/workflows/tests/badge.svg" alt="Build Status"></a>
    <a href="https://github.com/ozanproj/undangan-khitan/releases"><img src="https://img.shields.io/github/v/release/ozanproj/undangan-khitan" alt="Latest Stable Version"></a>
    <a href="https://github.com/ozanproj/undangan-khitan/stargazers"><img src="https://img.shields.io/github/stars/ozanproj/undangan-khitan" alt="Stars"></a>
</p>

## 💌 Tentang Proyek: Undangan Khitan Digital

Proyek **Undangan Khitan Digital** adalah sebuah platform berbasis web yang dikembangkan menggunakan framework Laravel. Tujuannya adalah untuk memudahkan pembuatan, pengelolaan, dan penyebaran undangan digital khusus acara Khitanan. Aplikasi ini dirancang untuk memberikan pengalaman yang elegan dan mudah digunakan bagi pengelola acara dan tamu undangan.

### Fitur Utama Proyek

Berikut adalah beberapa fitur utama yang ditawarkan oleh aplikasi ini:

-   **Manajemen Tamu (Guest Management):** Fitur CRUD (Create, Read, Update, Delete) lengkap untuk mengelola daftar tamu undangan, termasuk nama, alamat, dan status konfirmasi kehadiran.
-   **Templating Undangan:** Sistem *view* yang memungkinkan kustomisasi tampilan undangan (tema, foto, musik latar).
-   **Manajemen File:** Integrasi dengan sistem *storage* Laravel untuk mengunggah dan mengelola aset media (foto, audio MP3).
-   **Konfigurasi Acara:** Pengaturan detail acara (tanggal, waktu, lokasi) melalui panel admin.
-   **Ekspor Data:** Kemampuan untuk mengekspor data tamu undangan ke format PDF atau Excel.
-   **Notifikasi & Konfirmasi:** Formulir RSVP (Konfirmasi Kehadiran) sederhana.

## 🚀 Persyaratan Sistem & Instalasi

Proyek ini dibangun di atas Laravel dan membutuhkan lingkungan sebagai berikut:

-   **PHP:** Versi 8.1 atau yang lebih baru.
-   **Database:** MySQL/MariaDB (atau PostgreSQL, SQLite).
-   **Server:** Composer, Git, dan Node.js/NPM (untuk *frontend assets*).

### Langkah Instalasi

1.  **Kloning Repositori:**
    ```bash
    git clone [https://github.com/ozanproj/undangan-khitan.git](https://github.com/ozanproj/undangan-khitan.git)
    cd undangan-khitan
    ```
2.  **Instal Dependensi:**
    ```bash
    composer install
    npm install && npm run dev
    ```
3.  **Konfigurasi Lingkungan:**
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```
4.  **Atur Database:**
    Edit file `.env` untuk mengatur kredensial database Anda.
5.  **Migrasi Database:**
    ```bash
    php artisan migrate --seed
    ```
    (Gunakan `--seed` jika ada data *dummy* awal yang disertakan.)
6.  **Buat Symlink Storage (Hanya jika deployment mendukung symlink):**
    ```bash
    php artisan storage:link
    ```

## 📧 Kontak dan Dukungan

Jika Anda memiliki pertanyaan, umpan balik, atau menemukan *bug*, silakan hubungi pengembang proyek:

-   **Pengembang:** Ozan Project
-   **Email:** ardiansyahdzan@gmail.com
-   **GitHub:** [Link ke Profil GitHub Anda]

## 📜 Lisensi

Proyek ini adalah *software* sumber terbuka di bawah lisensi [MIT License](https://opensource.org/licenses/MIT).