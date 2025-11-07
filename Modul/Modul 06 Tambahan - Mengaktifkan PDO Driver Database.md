## Mengaktifkan Ekstensi PDO di PHP 8.4 (Windows)

Agar aplikasi CRUD dapat terhubung ke database menggunakan PDO, ekstensi driver PDO untuk database yang digunakan (misalnya MySQL) harus dalam keadaan aktif. Pada instalasi PHP 8.4 di Windows yang diunduh langsung dari php.net, file konfigurasi `php.ini` sering belum tersedia secara langsung, melainkan hanya disediakan dalam bentuk template. Oleh karena itu, perlu dilakukan beberapa langkah penyiapan sebagai berikut.

### 1. Menyiapkan File `php.ini` dari Template

Di direktori instalasi PHP (misalnya `C:\php` atau sesuai lokasi masing-masing), biasanya terdapat dua file template konfigurasi:

```text
php.ini-development
php.ini-production
```

File `php.ini` belum ada. Untuk keperluan pengembangan lokal, gunakan file `php.ini-development` sebagai dasar konfigurasi:

1. Buka File Explorer dan masuk ke folder instalasi PHP.

2. Ubah nama (rename) file berikut:

   ```text
   dari: php.ini-development
   menjadi: php.ini
   ```

3. Setelah di-rename, buka file `php.ini` tersebut menggunakan Visual Studio Code (atau editor teks lain yang nyaman digunakan).

### 2. Mengaktifkan `extension_dir`

PHP perlu mengetahui lokasi folder tempat file ekstensi (`.dll`) disimpan. Informasi ini ditentukan oleh direktori ekstensi (`extension_dir`) di dalam `php.ini`.

1. Di Visual Studio Code, gunakan fitur pencarian (Ctrl+F), lalu cari teks:

   ```text
   extension_dir
   ```

2. Temukan baris konfigurasi yang semula kurang lebih seperti berikut (diawali titik-koma `;` yang berarti nonaktif):

   ```ini
   ; extension_dir = "ext"
   ```

3. Aktifkan baris tersebut dengan menghilangkan tanda titik-koma (`;`) di depannya, sehingga menjadi:

   ```ini
   extension_dir = "ext"
   ```

Jika PHP diinstal di lokasi yang berbeda dan folder ekstensi tidak berada di subfolder `ext` yang sama, sesuaikan path ini dengan direktori ekstensi yang benar, misalnya:

```ini
extension_dir = "C:\php\ext"
```

### 3. Mengaktifkan Ekstensi PDO untuk MySQL

Berikutnya, aktifkan driver PDO untuk database yang digunakan. Bila menggunakan MySQL/MariaDB, maka ekstensi yang diperlukan adalah `php_pdo_mysql.dll`.

1. Masih di dalam file `php.ini`, cari baris berikut dengan fitur pencarian (Ctrl+F), misalnya dengan kata kunci `pdo_mysql`:

   ```text
   ;extension=php_pdo_mysql.dll
   ```

2. Baris tersebut diawali titik-koma (`;`) yang berarti belum aktif. Aktifkan ekstensi dengan menghilangkan tanda titik-koma di depannya, sehingga menjadi:

   ```ini
   extension=php_pdo_mysql.dll
   ```

3. Jika diperlukan, pastikan juga ekstensi PDO utamanya aktif (pada beberapa distribusi sudah aktif secara default). Contohnya:

   ```ini
   ;extension=php_pdo.dll
   ```

   Jika baris ini ada dan masih diberi titik-koma, hilangkan titik-koma:

   ```ini
   extension=php_pdo.dll
   ```

Tidak semua paket PHP memerlukan baris ini secara eksplisit, bergantung distribusi; jika tidak ada, cukup pastikan `php_pdo_mysql.dll` aktif.

### 4. Menyimpan Perubahan dan Menjalankan Ulang Server PHP

Setelah melakukan perubahan:

1. Simpan file `php.ini` di Visual Studio Code (`Ctrl+S`).

2. Jika sebelumnya sudah menjalankan server PHP built-in, hentikan terlebih dahulu dengan menekan `Ctrl + C` di jendela Command Prompt/Terminal tempat server berjalan.

3. Jalankan kembali server PHP dari direktori proyek (misalnya folder aplikasi CRUD):

   ```bash
   php -S localhost:8000
   ```

4. Akses aplikasi melalui browser di alamat:

   ```text
   http://localhost:8000
   ```

Jika konfigurasi sudah benar, aplikasi berbasis PDO akan dapat terkoneksi ke database tanpa error berkaitan dengan driver PDO, seperti “could not find driver”.

