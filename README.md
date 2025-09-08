# Sistem Informasi Kependudukan

Aplikasi ini adalah sistem informasi berbasis web yang dikembangkan dengan framework Laravel untuk membantu administrasi desa dalam mengelola data kependudukan, surat-menyurat, dan pelayanan publik secara digital.

## Fitur Utama

-   **Dashboard Interaktif**: Menampilkan ringkasan statistik penting seperti total penduduk, jumlah surat, dan pelayanan terbaru secara _real-time_.
-   **Visualisasi Data Geografis**: Menggunakan Leaflet.js dan data GeoJSON untuk memvisualisasikan data demografi penduduk per kabupaten/kota di Jawa Barat, termasuk:
    -   Jumlah total penduduk.
    -   Distribusi penduduk berdasarkan jenis kelamin, agama, pekerjaan, kesehatan, pendidikan, dan industri.
-   **Manajemen Data Penduduk**: Mengelola data penduduk, termasuk NIK, nama, tempat/tanggal lahir, jenis kelamin, alamat, dan status.
-   **Manajemen Dokumen**: Mencatat dan melacak pembuatan surat-surat administrasi.
-   **Manajemen Pelayanan**: Mengelola permohonan pelayanan dari penduduk.
-   **Manajemen Data Pegawai**: Mendata informasi pegawai dukcapil.

## Teknologi yang Digunakan

Aplikasi ini dibangun menggunakan teknologi berikut:

-   **Backend**:
    -   [Laravel](https://laravel.com/) (PHP Framework)
-   **Frontend**:
    -   HTML, CSS, JavaScript
    -   [Bootstrap 5](https://getbootstrap.com/) (untuk tata letak dan komponen UI)
    -   [Chart.js](https://www.chartjs.org/) (untuk visualisasi data grafik)
    -   [Leaflet.js](https://leafletjs.com/) (untuk visualisasi peta interaktif)
-   **Database**:
    -   MySQL / MariaDB
-   **Seeder**:
    -   [Faker](https://fakerphp.github.io/) (untuk membuat data dummy penduduk di Jawa Barat)

## Persyaratan Sistem

Pastikan sistem Anda memenuhi persyaratan berikut untuk menjalankan aplikasi:

-   PHP >= 8.2
-   MySQL / MariaDB
-   Composer
-   Node.js & npm (untuk aset frontend, opsional jika tidak ada perubahan pada aset)

## Instalasi

Ikuti langkah-langkah berikut untuk menginstal dan menjalankan aplikasi secara lokal:

1.  **Klon repositori:**

    ```bash
    git clone https://github.com/naufalonely/wargaku.git
    cd nama-proyek
    ```

2.  **Instal dependensi Composer:**

    ```bash
    composer install
    ```

3.  **Salin file `.env` dan atur kunci aplikasi:**

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Konfigurasi database:**
    Buka file `.env` dan sesuaikan pengaturan database Anda (`DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD`).

5.  **Jalankan migrasi dan seeder database:**

    ```bash
    php artisan migrate:fresh --seed
    ```

    Perintah ini akan membuat tabel-tabel yang diperlukan dan mengisi data dummy untuk pengembangan.

6.  **Jalankan server pengembangan:**
    ```bash
    php artisan serve
    ```

Aplikasi sekarang dapat diakses di `http://127.0.0.1:8000`.

## Kontribusi

Kami sangat menyambut kontribusi Anda. Jika Anda menemukan bug atau memiliki ide fitur, silakan buat _issue_ atau kirimkan _pull request_.
