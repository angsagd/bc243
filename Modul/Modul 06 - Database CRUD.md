# Dasar-dasar Pengelolaan Basisdata dengan PHP

**_PHP OOP PDO CRUD_**

---

## I. Ketentuan Umum

> **Tujuan Pembelajaran:**
>
> 1. Memahami lingkungan kerja yang digunakan untuk menjalankan proyek PHP.
> 2. Mengetahui struktur direktori utama yang akan digunakan sepanjang modul.
> 3. Mampu menjalankan proyek menggunakan web server bawaan PHP.
> 4. Mengetahui konvensi penamaan file, class, method, dan variabel yang digunakan agar kode mudah dibaca dan konsisten.

### A. Penamaan dan Konvensi Kode

Agar semua file dan kode konsisten, proyek ini mengikuti aturan sederhana berikut:

1. Penamaan File

    Nama file PHP menggunakan **huruf kecil semua** dengan pemisah tanda hubung (`-`) jika lebih dari satu kata. Contoh: `authenticate.php`, `save.php`, `update.php`.

2. Penamaan Class

    Nama class menggunakan **huruf besar di awal setiap kata** (PascalCase). Contoh: `Database`, `User`, `Utility`.

3. Penamaan Method dan Variabel

    Nama method dan variabel menggunakan **huruf kecil di awal** dan **huruf besar di setiap kata berikutnya** (camelCase). Contoh: `setById()`, `getPassword()`, `$createdAt`, `$fullName`.

4. Konvensi Folder

    Folder utama menggunakan huruf kecil (`class`, `css`, `inc`). Tidak ada spasi dalam nama folder atau file.

### B. Mode Pengembangan

Agar mahasiswa dapat melihat kesalahan dengan mudah, mode pengembangan disarankan untuk **menampilkan error**.

Tambahkan pengaturan berikut di awal file `config.php` jika belum ada:

```php
error_reporting(E_ALL);
ini_set('display_errors', 1);
```

Mode ini **hanya untuk latihan lokal**. Saat aplikasi sudah siap produksi, pengaturan ini harus dimatikan atau dihapus untuk mencegah kebocoran informasi.

### C. Pemahaman Dasar yang Perlu Dikuasai Sebelumnya

Sebelum memulai modul ini, mahasiswa diharapkan sudah menguasai dasar-dasar berikut:

* **Sintaks dasar PHP**: variabel, operator, array, dan percabangan.
* **HTML dasar**: struktur form dan tabel.
* **Konsep OOP dasar**: class, objek, atribut, dan method.

Bagi yang belum familiar dengan OOP, pengenalan akan dilakukan secara bertahap dalam modul ini, dimulai dari contoh sederhana.

---

## II. Inisialisasi Proyek

> **Tujuan Pembelajaran:**
>
> 1. Memahami gambaran umum aplikasi CRUD berbasis PHP OOP yang akan dibangun.
> 2. Mengetahui fungsi setiap folder dan file di dalam proyek.
> 3. Dapat menyiapkan database `users` untuk menyimpan data pengguna.
> 4. Dapat menjalankan proyek secara lokal menggunakan web server bawaan PHP.

### A. Gambaran Umum Proyek

Proyek yang akan dibangun adalah **aplikasi manajemen data pengguna (User Management)** dengan fitur **CRUD**:

| Operasi | Singkatan | Fungsi                                |
| ------- | :-------: | ------------------------------------- |
| Create  |   **C**   | Menambahkan user baru ke database     |
| Read    |   **R**   | Menampilkan daftar user dari database |
| Update  |   **U**   | Mengubah data user yang sudah ada     |
| Delete  |   **D**   | Menghapus user dari database          |

Selain operasi CRUD, aplikasi ini juga memiliki **fitur login dan proteksi sesi**, sehingga hanya pengguna yang sudah login yang dapat menambah, mengubah, atau menghapus data. Semua kode akan ditulis menggunakan **PHP dengan pendekatan OOP (Object-Oriented Programming)**, dan database yang digunakan adalah **MySQL** dengan koneksi melalui **PDO (PHP Data Objects)**.

### B. Struktur Folder dan File

Struktur proyek ini sudah disiapkan agar mahasiswa fokus pada penulisan kode di bagian yang tepat.

```text
user-crud/
│
├── class/
│   ├── Database.php
│   ├── User.php
│   └── Utility.php
│
├── css/
│   └── style.css
│
├── inc/
│   └── config.php
│
├── index.php
├── members.php
├── create.php
├── edit.php
├── login.php
├── logout.php
├── authenticate.php
├── save.php
├── update.php
└── delete.php
```

**Penjelasan Folder dan File:**

| Folder/File                  | Fungsi                                                                                                           |
| ---------------------------- | ---------------------------------------------------------------------------------------------------------------- |
| `/class`                     | Menyimpan semua kelas PHP, yaitu `Database`, `User`, dan `Utility`.                                              |
| `/css`                       | Menyimpan file gaya tampilan (CSS). Mahasiswa tidak perlu mengubah file ini.                                     |
| `/inc/config.php`            | File konfigurasi utama yang akan digunakan di semua halaman (session, autoload, konfigurasi database, navigasi). |
| `index.php`                  | Halaman utama (Home).                                                                                            |
| `members.php`                | Menampilkan daftar user (Read).                                                                                  |
| `create.php`                 | Formulir untuk menambah user baru (Create).                                                                      |
| `edit.php`                   | Formulir untuk mengubah data user (Update).                                                                      |
| `delete.php`                 | Proses untuk menghapus user (Delete).                                                                            |
| `login.php` dan `logout.php` | Halaman login dan proses logout.                                                                                 |
| `authenticate.php`           | Proses autentikasi user saat login.                                                                              |
| `save.php` dan `update.php`  | File proses penyimpanan dan pembaruan data user.                                                                 |

Semua file tersebut sudah disiapkan dalam keadaan kosong agar mahasiswa dapat menuliskan kodenya secara bertahap sesuai modul.

### C. Menyiapkan Lingkungan Kerja

Aplikasi ini tidak membutuhkan instalasi XAMPP atau software tambahan lain. Cukup gunakan **PHP bawaan** dan **Command Prompt/Terminal**.

**Langkah Menjalankan Server:**

1. Buka Command Prompt (Windows) atau Terminal (macOS/Linux).
2. Arahkan ke folder proyek, misalnya:

    ```bash
    cd C:\Users\<nama>\Documents\user-crud
    ```

3. Jalankan web server bawaan PHP:

    ```bash
    php -S localhost:8000
    ```

4. Buka browser, lalu akses:

    ```text
    http://localhost:8000
    ```

Jika halaman `index.php` tampil (walaupun masih kosong), berarti proyek siap dijalankan. Gunakan `Ctrl + C` di terminal untuk menghentikan server bila sudah tidak diperlukan.

### D. Menyiapkan Database

Aplikasi akan menggunakan satu tabel bernama **`users`**. Database ini dapat dibuat melalui **phpMyAdmin**, **MySQL Workbench**, **DBeaver**, **Adminer**, atau **MySQL Command Line**.

**Langkah Membuat Database:**

1. Masuk ke MySQL.
2. Buat database baru (nama database dapat disesuaikan, misalnya `crud_oop`):

    ```sql
    CREATE DATABASE crud_oop;
    ```

3. Gunakan database tersebut:

    ```sql
    USE crud_oop;
    ```

4. Buat tabel `users`:

    ```sql
    CREATE TABLE users (
      id INT AUTO_INCREMENT PRIMARY KEY,
      username VARCHAR(50) UNIQUE NOT NULL,
      password VARCHAR(255) NOT NULL,
      fullname VARCHAR(100) NOT NULL,
      city VARCHAR(50) NOT NULL,
      created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

5. (Opsional) Tambahkan data awal untuk pengujian:

    ```sql
    INSERT INTO users (username, password, fullname, city)
    VALUES
      ('admin', '$2y$10$examplehashforadmin', 'Administrator', 'Denpasar'),
      ('budi', '$2y$10$examplehashforbudi', 'Budi Santoso', 'Surabaya');
    ```

    Nilai password akan di-hash menggunakan fungsi `password_hash()` di modul-modul berikutnya. Sementara ini, gunakan hash tools online untuk menghasilkan hash password.

### E. Peran File Konfigurasi (`config.php`)

Dalam proyek yang memiliki banyak file, akan merepotkan jika setiap file harus menuliskan ulang:

* Pengaturan koneksi database,
* Inisialisasi session,
* Pemanggilan class,
* Dan konfigurasi lain seperti daftar menu navigasi.

Karena itu, semua pengaturan umum akan diletakkan dalam satu file khusus bernama **`config.php`**, yang berada di dalam folder **`/inc`**.

File ini akan:

* **Memulai session PHP**, agar data login dapat disimpan antar halaman.
* **Menentukan konfigurasi database**, seperti host, nama database, username, dan password.
* **Menyiapkan autoloader**, supaya file class dapat dimuat otomatis tanpa perlu `require` satu per satu.
* **Mendefinisikan variabel global** yang mungkin diperlukan di banyak halaman (misalnya daftar menu navigasi).

Setiap halaman yang membutuhkan fitur backend (seperti login, membaca data user, menyimpan data baru, atau lainnya) cukup menambahkan satu baris pemanggilan di bagian paling atas file tersebut.

Tambahkan kode berikut di setiap file PHP yang memerlukan:

```php
// require necessary files
require_once 'inc/config.php';
```

Setelah itu, seluruh pengaturan sudah aktif.

### F. Pengujian Awal Proyek

Setelah database dibuat dan server berjalan:

1. Pastikan file `index.php` dapat diakses dari browser.
2. Pastikan tidak ada error pada tampilan halaman.
3. Cek struktur database di MySQL — tabel `users` sudah muncul.

---

## III. Autoload dan Menu Navigasi

> **Tujuan Pembelajaran:**
>
> 1. Memahami konsep **autoload** untuk memuat class secara otomatis di PHP.
> 2. Memahami cara menyiapkan menu navigasi yang konsisten di seluruh halaman aplikasi.
> 3. Memahami penggunaan **konstanta** dan **method static** dalam PHP.
> 4. Dapat menampilkan menu navigasi di semua halaman utama (`index`, `members`, `create`, dan `edit`).

### A. Autoload: Memuat Class Secara Otomatis

Dalam pendekatan OOP, setiap class biasanya disimpan di file terpisah. Contohnya:

* `class Database` disimpan di `Database.php`,
* `class User` disimpan di `User.php`,
* `class Utility` disimpan di `Utility.php`.

Jika tanpa autoload, maka di setiap file PHP kita harus menulis:

```php
require 'class/Database.php';
require 'class/User.php';
require 'class/Utility.php';
```

Hal ini tidak efisien dan mudah menimbulkan error jika lupa satu baris saja. Untuk mengatasinya, PHP memiliki fitur **autoload**, yang memungkinkan sistem secara otomatis mencari dan memuat file class sesuai nama class yang dipanggil.

Dengan autoload, cukup satu kali pengaturan di `config.php`, dan selanjutnya PHP akan otomatis mencari file class di folder `/class` setiap kali kita membuat objek baru seperti:

```php
$user = new User();
```

Tambahkan kode autoload berikut di `inc/config.php`:

```php
// simple autoload
spl_autoload_register(function ($class_name) {
    include 'class/' . $class_name . '.php';
});
```

### B. Mengapa Menu Navigasi Dibutuhkan

Menu navigasi berfungsi sebagai **panduan utama bagi pengguna** untuk berpindah antarhalaman aplikasi. Tanpa navigasi, pengguna akan kesulitan mencari halaman login, daftar user, atau halaman untuk membuat data baru.

Agar lebih mudah dirawat, navigasi disimpan dalam satu tempat yaitu di **file konfigurasi `config.php`**, dan ditampilkan ke halaman melalui method khusus di **kelas `Utility`**. Dengan pendekatan ini, jika nanti ingin menambah atau mengubah menu, cukup ubah **satu bagian saja**, tanpa perlu menyunting banyak file HTML.

### C. Menyiapkan Daftar Menu di `config.php`

File `config.php` merupakan pusat konfigurasi aplikasi. Di dalamnya akan ditambahkan **daftar menu** yang disebut `NAV_PAGES`.

Konstanta `NAV_PAGES` berisi daftar halaman dalam bentuk array asosiatif. Tambahkan kode berikut di `inc/config.php`:

```php
// navigasi config
const NAV_PAGES = [
    ['title' => 'Home',    'url' => 'index.php'],
    ['title' => 'Members', 'url' => 'members.php'],
    ['title' => 'New',     'url' => 'create.php'],
    ['title' => 'Logout',  'url' => 'logout.php']
];
```

**Penjelasan:**

* `title` adalah teks yang akan muncul pada menu.
* `url` adalah alamat file yang akan dituju.
* Daftar ini akan dibaca oleh **Utility::showNav()** untuk ditampilkan ke halaman.

Nama `NAV_PAGES` ditulis dalam huruf besar karena bersifat **konstanta**, yaitu nilai tetap yang tidak berubah selama program berjalan.

### D. Mengenal Static Method dalam PHP

Sebelum melanjutkan ke kode Utility, pahami dulu konsep **method static**.

* Method biasa dipanggil melalui objek, misalnya:

  ```php
  $obj = new Utility();
  $obj->showNav();
  ```

* Sedangkan **method static** dapat dipanggil langsung tanpa membuat objek:

  ```php
  Utility::showNav();
  ```

Keuntungan static method:

1. Tidak perlu membuat objek baru.
2. Cocok untuk fungsi bantu (utility function) yang **tidak bergantung pada data internal**.
3. Kode menjadi lebih ringkas dan mudah dipanggil dari halaman manapun.

Pada modul ini, method `showNav()` akan dibuat **static**, karena tugasnya hanya menampilkan daftar menu tanpa perlu menyimpan data atau status apapun.

### E. Membuat Method `showNav()` di `Utility.php`

Kelas `Utility` digunakan untuk menyimpan berbagai fungsi bantu umum yang akan digunakan oleh halaman-halaman aplikasi.

Tambahkan method berikut di dalam file `class/Utility.php`:

```php
// Display navigation menu
public static function showNav($pages = NAV_PAGES)
{
    echo '<nav><ul>';
    foreach ($pages as $item) {
        $title = htmlspecialchars($item['title'] ?? '', ENT_QUOTES, 'UTF-8');
        $url   = htmlspecialchars($item['url'] ?? '', ENT_QUOTES, 'UTF-8');
        echo "<li><a href='$url'>$title</a></li>";
    }
    echo '</ul></nav>';
}
```

**Penjelasan konsep:**

* Method bersifat **static**, sehingga dapat dipanggil tanpa membuat objek.
* Parameter `$pages` diisi otomatis dengan nilai `NAV_PAGES`.
* Fungsi `htmlspecialchars()` digunakan agar teks HTML tidak disalahgunakan oleh input berbahaya.
* Hasil akhirnya berupa elemen `<nav>` berisi daftar tautan halaman.

### F. Menampilkan Navigasi di Halaman Utama

Setelah method `showNav()` tersedia, langkah berikutnya adalah **memanggilnya** di setiap halaman utama aplikasi.

Tambahkan baris berikut di dalam `<body>`, diantara `<header>` dan `<main>` pada file **`index.php`**, **`members.php`**, **`create.php`**, dan **`edit.php`**:

```php
</header>
<?php Utility::showNav(); ?>
<main>
```

Letakkan baris tersebut **setelah pemanggilan `config.php`** dan **sebelum konten utama halaman**.

Struktur umum setiap halaman menjadi seperti ini:

```php
<?php require __DIR__ . '/inc/config.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Judul Aplikasi</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <header>
    <h1>Judul Halaman</h1>
  </header>
  <?php Utility::showNav(); ?>
  <main>
    <!-- Konten halaman -->
  </main>
</body>
</html>
```

Mahasiswa tidak perlu menulis ulang tag CSS untuk navigasi, karena gaya tampilannya sudah diatur dalam file `style.css`.

### G. Struktur HTML dan CSS yang Sudah Disediakan

File `style.css` yang telah disiapkan di folder `/css` berisi aturan tampilan navigasi seperti berikut:

```css
nav ul {
  list-style: none;
  padding: 10px 0;
  margin: 0;
  display: flex;
  justify-content: center;
  background-color: #234;
}
nav ul li {
  margin: 0 15px;
}
nav ul li a {
  color: #fff;
  text-decoration: none;
}
nav ul li a:hover {
  color: #f63;
}
```

Dengan gaya ini, menu akan tampil **di bagian atas halaman**, berwarna gelap, dan tautannya akan berubah warna saat disorot.

### H. Uji Coba

1. Jalankan kembali server PHP:

    ```bash
    php -S localhost:8000
    ```

2. Akses halaman `http://localhost:8000/index.php`. Menu navigasi seharusnya muncul di bagian atas.
3. Klik setiap tautan (`Members`, `New`, `Logout`) untuk memastikan semua berpindah halaman.
4. Periksa tampilan halaman `members.php`, `create.php`, dan `edit.php` — navigasi harus tampil seragam di semua halaman tersebut.

---

## IV. Menyediakan Penanganan Database

> **Tujuan Pembelajaran:**
>
> 1. Memahami bagaimana aplikasi terhubung ke MySQL melalui PDO.
> 2. Memahami peran kelas `Database` sebagai penyedia koneksi tunggal untuk seluruh aplikasi.
> 3. Mampu menjelaskan alur kerja method `connect()`, `disconnect()`, dan `query()` beserta kapan digunakan.
> 4. Mengetahui pola penggunaan koneksi (`$conn`) pada kelas lain (khususnya `User`).

### A. Peran Lapisan Database

Aplikasi memerlukan satu tempat terpusat untuk “berbicara” dengan MySQL. Tempat ini adalah **kelas `Database`**. Seluruh halaman dan kelas lain (misalnya `User`) **tidak membuat koneksi sendiri-sendiri**, tetapi meminjam koneksi dari `Database`. Tujuannya:

* Menghindari pembuatan koneksi berulang (lebih efisien).
* Menyeragamkan cara menjalankan perintah SQL.
* Memudahkan penanganan error.

### B. Sumber Konfigurasi Koneksi

Konfigurasi database disimpan di `inc/config.php` dalam bentuk **konstanta** (misalnya `DB_HOST`, `DB_USER`, `DB_PASS`, `DB_NAME`). Kelas `Database` akan membaca konstanta ini saat membuat koneksi.

Tambahkan kode berikut di `inc/config.php`:

```php
// database config
const DB_HOST = 'localhost';
const DB_USER = 'root';       // sesuaikan dengan user MySQL Anda
const DB_PASS = 'P@5$w0Rd';   // sesuaikan dengan password MySQL Anda
const DB_NAME = 'crud_oop';   // sesuaikan dengan nama database yang sudah dibuat
```

Sesuaikan `DB_USER`, `DB_PASS`, dan `DB_NAME` dengan kredensial MySQL yang sudah dibuat sebelumnya.

**Kesepakatan penting:**

* Tidak ada kredensial yang ditulis ulang di file lain.
* Jika perlu mengubah host, nama database, atau password, cukup ubah di `config.php`.

### C. Desain Kelas `Database` (yang akan diikuti)

Kelas `Database` bekerja dengan rancangan berikut:

1. Atribut publik `$conn`

    * Menyimpan objek koneksi PDO yang aktif.
    * Dapat diakses oleh kelas lain (misalnya `User`) untuk menyiapkan dan mengeksekusi pernyataan SQL (prepared statement).

    Tambahkan baris kode berikut di dalam file `class/Database.php`:

    ```php
    // Database connection property
    public $conn;
    ```

2. Method `connect()`

    * Menyusun DSN dari konstanta di `config.php`.
    * Mengatur opsi dasar PDO (mode error menggunakan exception, fetch mode asosiatif, dan prepared statement asli).
    * Jika berhasil, `$conn` siap dipakai; jika gagal, lempar exception agar mudah dilacak saat pengembangan.

    Tambahkan baris kode berikut di dalam file `class/Database.php`:

    ```php
    // Establish database connection
    public function connect() {
        try {
            $this->conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
        return $this->conn;
    }
    ```

3. Constructor

    * Dipanggil saat objek `Database` dibuat.
    * Tugas: memanggil `connect()` dan menyimpan koneksi ke `$conn`.
    * Jika koneksi gagal, akan muncul exception (ditangani dengan pesan yang ramah bagi pengembang).

    Tambahkan baris kode berikut di dalam file `class/Database.php`:

    ```php
    // Constructor to initialize the database connection
    public function __construct() {
        $this->connect();
    }
    ```

4. Method `disconnect()`

    * Menutup koneksi database dengan cara mengosongkan `$conn`.
    * Biasanya tidak wajib dipanggil (karena koneksi akan ditutup otomatis saat skrip selesai), namun disediakan untuk latihan dan kasus khusus.

    Tambahkan baris kode berikut di dalam file `class/Database.php`:

    ```php
    // Disconnect from the database
    public function disconnect() {
        $this->conn = null;
    }
    ```

5. Method `query($sql, $params)`

    * Menjalankan perintah SQL **dengan prepared statement**.
    * Mengembalikan **true** bila eksekusi berhasil, **false** bila gagal.
    * Cocok untuk perintah **tulis** (`INSERT`/`UPDATE`/`DELETE`) yang hanya butuh status berhasil/gagal.
    * Untuk **baca data** (`SELECT`), lebih baik **menyiapkan statement** menggunakan `$conn`, mengeksekusinya, lalu mengambil hasil (lihat bagian “Pola Pemakaian” di bawah).

    Tambahkan baris kode berikut di dalam file `class/Database.php`:

    ```php
    // Execute a query with optional parameters
    public function query($sql, $params = []) {
        // Prepare and execute statement, return false for failed query
        $stmt = $this->conn->prepare($sql);
        if ($stmt->execute($params)) {
            return $stmt;
        }
        return false;
    }
    ```

Catatan: Desain ini menjaga kesederhanaan bagi pemula. Mahasiswa akan belajar bahwa operasi “tulis” dan “baca” dipisahkan: `query()` untuk status sukses/gagal, sedangkan pembacaan hasil `SELECT` dilakukan melalui pemanggilan langsung ke `$conn`.

### D. Alur Kerja (Ringkas)

1. Halaman backend memanggil `require 'inc/config.php';` agar konstanta dan autoload aktif.
2. Kelas lain (misal `User`) membuat **objek `Database`**.
3. Constructor `Database` memanggil `connect()` → `$conn` terisi objek PDO aktif.
4. Untuk **`INSERT`/`UPDATE`/`DELETE`**: panggil `query()` → terima **true/false**.
5. Untuk **`SELECT`**: siapkan pernyataan melalui `$db->conn`, eksekusi, lalu **fetch** hasilnya.
6. Jika dibutuhkan, panggil `disconnect()` untuk menutup koneksi lebih awal (opsional).

### E. Pola Pemakaian di Kelas Lain

Agar jelas, berikut pola penggunaan koneksi di kelas lain (misalnya `User`), tanpa menuliskan kode asli:

* Operasi baca (`SELECT`)

  * Siapkan pernyataan menggunakan `$db->conn->prepare("SELECT …")`.
  * Ikat parameter yang diperlukan.
  * Jalankan pernyataan (`execute`).
  * Ambil hasil dengan `fetch()` atau `fetchAll()` dan **isi atribut model** dari hasil tersebut.

* Operasi tulis (`INSERT`/`UPDATE`/`DELETE`)

  * Panggil `query("…", $params)` dari objek `Database`.
  * Periksa hasil **true/false** untuk menentukan logika lanjutan (misalnya set flash message “berhasil”/“gagal”).

Dengan pola ini, mahasiswa melihat perbedaan kebutuhan antara membaca data (perlu hasil) dan menulis data (cukup status berhasil/gagal).

### F. Praktik Baik Keamanan (Level Pemula)

* **Selalu gunakan prepared statement** untuk semua SQL (termasuk `SELECT`), agar input pengguna tidak dieksekusi mentah-mentah (mencegah SQL Injection).
* **Jangan tampilkan detail koneksi** (host, user, password) saat terjadi error. Saat pengembangan, tampilkan pesan singkat yang membantu, dan arahkan detail teknis ke log jika diperlukan.
* **Escape output** saat menampilkan data ke halaman (akan dipraktikkan di modul lain).

### G. Skenario Uji yang Disarankan

Sebelum kelas `User` menggunakan koneksi ini, lakukan uji dasar berikut pada kelas `Database` di file `testing.php`:

1. Uji koneksi berhasil

   * Pastikan kredensial di `config.php` benar.
   * Buat objek `Database` dan perhatikan tidak ada error.

2. Uji koneksi gagal

   * Ubah sementara nama database ke yang salah.
   * Pastikan exception muncul, lalu kembalikan seperti semula.

3. Uji operasi tulis (query → true/false)

   * Coba perintah `INSERT` sederhana terhadap tabel `users`.
   * Pastikan hasil `true`, kemudian cek baris benar-benar bertambah di database.

4. Uji operasi baca (`SELECT` via `$conn`)

   * Siapkan statement untuk mengambil data dari `users`.
   * Eksekusi dan ambil hasil, pastikan data sesuai.

5. Uji disconnect()

   * Panggil `disconnect()` dan pastikan operasi berikutnya memerlukan koneksi baru atau gagal sesuai harapan (untuk memahami efek penutupan koneksi).

### H. Kesalahan Umum dan Cara Menghindarinya

* **Lupa memanggil `config.php`** di halaman → autoload dan konstanta DB tidak tersedia. Solusi: Pastikan setiap halaman backend memanggil `require 'inc/config.php';` di **baris pertama**.

* **Menjalankan `SELECT` melalui `query()` dan berharap hasil data** → `query()` hanya mengembalikan **true/false**. Solusi: Untuk `SELECT`, gunakan `$conn` (siapkan statement, eksekusi, lalu fetch hasil).

* **Tidak menggunakan prepared statement** → rawan SQL Injection. Solusi: Ikuti pola bind parameter untuk setiap nilai input.

* **Mengubah kredensial di banyak tempat** → rawan tidak sinkron. Solusi: Hanya ubah di `config.php`.

---

## V. Membuat Model User

> **Tujuan Pembelajaran:**
>
> 1. Memahami konsep **model** sebagai representasi data dari tabel `users` di database.
> 2. Memahami cara kerja atribut publik dan terproteksi dalam OOP.
> 3. Mengetahui bagaimana `User` memanfaatkan kelas `Database` untuk membaca data.
> 4. Dapat menjelaskan fungsi `getId()`, `getPassword()`, `setById()`, dan `getAll()`.
> 5. Dapat melakukan pengujian model menggunakan skrip sederhana di terminal.

### A. Apa itu Model

Dalam arsitektur aplikasi, **model** adalah bagian yang berhubungan langsung dengan **data**. Model bertugas:

* Membaca data dari database.
* Menyimpan hasilnya dalam atribut objek.
* Menyediakan metode (method) untuk mengakses, mengubah, atau menampilkan data tersebut.

Pada proyek ini, model utama adalah **kelas `User`**, yang mewakili **satu baris data** dari tabel `users`.

### B. Hubungan Antara User dan Database

Kelas `User` tidak membuat koneksi sendiri. Sebaliknya, ia **memanggil kelas `Database`** yang telah dibuat sebelumnya untuk:

* Membuka koneksi ke database, dan
* Menjalankan perintah SQL.

Dengan demikian, jika ada perubahan pada konfigurasi koneksi, mahasiswa tidak perlu mengubah kode di `User`. Kelas ini hanya perlu mengetahui cara **menggunakan koneksi** yang sudah disediakan.

### C. Struktur Atribut pada Kelas User

1. Atribut Publik

    Atribut publik digunakan untuk menyimpan data yang **boleh diakses langsung** dari luar kelas, misalnya untuk ditampilkan di halaman web.

    * `$username` – nama pengguna.
    * `$fullname` – nama lengkap.
    * `$city` – kota tempat tinggal.
    * `$created_at` – waktu pembuatan data.

    Tambahkan baris kode berikut di dalam file `class/User.php`:

    ```php
    // public properties
    public $username;
    public $fullname;
    public $city;
    public $created_at;
    ```

    Contoh pemakaian: Objek `User` dapat menampilkan data seperti `$user->fullname` langsung di tampilan (misalnya di tabel `members.php`).

2. Atribut Terproteksi

    Atribut terproteksi (`protected`) digunakan untuk data **yang tidak boleh diubah langsung dari luar kelas**, karena bersifat sensitif atau internal.

    * `$id` – identitas unik user (primary key).
    * `$password` – menyimpan hash password (bukan teks asli).
    * `$db` – menyimpan koneksi database (objek dari kelas `Database`).

    Tambahkan baris kode berikut di dalam file `class/User.php`:

    ```php
    // protected properties
    protected $id;
    protected $password;
    protected $db;
    ```

    Tujuannya: menjaga keamanan dan integritas data. Kelas `User` menyediakan method khusus untuk membaca (`getId()`, `getPassword()`) tanpa membuka akses langsung terhadap atribut sensitif ini.

### D. Constructor dan Koneksi Database

Constructor pada kelas `User` akan:

1. Membuat objek `Database`.
2. Menyimpan koneksi dari `Database` ke dalam atribut `$db`.

Tambahkan baris kode constructor berikut di dalam file `class/User.php`:

```php
// constructor
public function __construct() {
  $this->db = new Database();
}
```

Dengan cara ini, setiap kali `User` dibuat, ia otomatis siap berkomunikasi dengan database tanpa perlu memanggil koneksi manual.

**Konsep penting:** “Objek `User` adalah representasi data pengguna sekaligus tahu bagaimana cara berbicara dengan database.”

### E. Method Akses Dasar

Atribut `id` dan `password` bersifat `protected`, sehingga tidak bisa diakses langsung dari luar kelas. Untuk itu, akan dibuatkan method getter dan setter agar data ini dapat diambil atau diubah dengan aman. Method `getId()` dan `getPassword()` yang akan dibuat termasuk **getter**, sedangkan method `setPassword()` termasuk **setter**.

1. `getId()`

    Mengembalikan nilai `id` milik objek `User`. Digunakan oleh bagian lain aplikasi yang butuh mengetahui identitas unik pengguna, misalnya saat proses update atau delete.

    Tambahkan baris kode berikut di dalam file `class/User.php`:

    ```php
    // Get ID
    public function getId() {
      return $this->id;
    }
    ```

2. `getPassword()`

    Mengembalikan nilai `password` (yang sudah dalam bentuk hash). Digunakan secara internal pada proses login (`authenticate`) untuk verifikasi kata sandi, tanpa menampilkan nilai hash ke halaman.

    Tambahkan baris kode berikut di dalam file `class/User.php`:

    ```php
    // Get password
    public function getPassword() {
      return $this->password;
    }
    ```

3. `setPassword($password)`

    Method ini dapat digunakan untuk mengubah nilai password (misalnya saat membuat user baru atau mengubah password). Password yang diterima akan di-hash sebelum disimpan ke atribut.

    Tambahkan baris kode berikut di dalam file `class/User.php`:

    ```php
    // Set password (hashed)
    public function setPassword($password) {
      $this->password = password_hash($password, PASSWORD_DEFAULT);
    }
    ```

### F. Membuat Objek User Berdasarkan ID (Method `setById`)

Method `setById()` berfungsi **memuat data dari database ke dalam objek** berdasarkan nilai `id`.

Alur logika metode ini:

1. Terima parameter `$id`.
2. Jalankan perintah `SELECT * FROM users WHERE id = ?`.
3. Jika data ditemukan, isi atribut objek (`username`, `fullname`, `city`, `created_at`, dan lain-lain) dengan nilai hasil query.
4. Jika data tidak ditemukan, kembalikan nilai `false`.

Tambahkan baris kode berikut di dalam file `class/User.php`:

```php
// Set user properties by ID
public function setById($id) {
  $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
  $stmt = $this->db->query($sql, ['id' => $id]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user) {
    $this->id = $user['id'];
    $this->username = $user['username'];
    $this->fullname = $user['fullname'];
    $this->city = $user['city'];
    $this->created_at = $user['created_at'];
    $this->password = $user['password'];
    return true;
  }
  return false;
}
```

Setelah `setById()` dijalankan, objek `User` siap digunakan karena telah “berisi” data dari database.

Contoh konsep: “Saya membuat objek `User`, lalu saya isi datanya dari database dengan ID = 5.”

### G. Mengambil Semua Data User (Method `getAll()`)

Method ini bertujuan untuk membaca **semua baris** dalam tabel `users`.

Alur kerja:

1. Membuat koneksi database sementara (karena tidak terikat ke satu objek tertentu).
2. Menjalankan `SELECT * FROM users ORDER BY id`.
3. Mengambil semua hasil dan mengembalikannya dalam bentuk **array asosiatif**.

Tambahkan baris kode berikut di dalam file `class/User.php`:

```php
// Get all users
public function getAll() {
  $sql = "SELECT * FROM users ORDER BY id ASC";
  $stmt = $this->db->query($sql);
  return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
```

Hasil dari `getAll()` akan digunakan di halaman `members.php` untuk menampilkan daftar semua pengguna dalam bentuk tabel.

### H. Pola Penggunaan di Aplikasi

| Tujuan                             | Pemanggilan                | Keterangan                                              |
| ---------------------------------- | -------------------------- | ------------------------------------------------------- |
| Mengambil semua user               | `User->getAll()`           | Dipakai di `members.php` untuk menampilkan tabel.       |
| Mengambil satu user berdasarkan id | `$user->setById($id)`      | Dipakai di `edit.php` untuk menampilkan form edit.      |
| Mengakses id user                  | `$user->getId()`           | Dipakai di proses update/hapus data.                    |
| Mengambil password (hash)          | `$user->getPassword()`     | Dipakai internal saat login/autentikasi.                |
| Mengubah password user             | `$user->setPassword($pwd)` | Dipakai saat membuat user baru atau mengubah password.  |

### I. Pengujian Melalui Command Line

Sebelum digunakan di halaman web, mahasiswa disarankan **menguji kelas `User` di terminal** menggunakan file `testing.php` yang sudah disiapkan.

1. Uji Ambil Semua Data

    Tambahkan kode uji sederhana di `testing.php`:

    ```php
    require 'inc/config.php';
    $all = User->getAll();
    print_r($all);
    ```

    Jalankan:

    ```bash
    php testing.php
    ```

    Jika koneksi dan query berhasil, hasilnya akan menampilkan seluruh data user dalam bentuk array.

2. Uji Ambil Satu Data

    Tambahkan uji kedua:

    ```php
    require 'inc/config.php';
    $user = new User();
    $user->setById(1);
    print_r($user);
    ```

    Hasilnya akan menampilkan satu objek `User` dengan atribut yang sudah terisi data dari database.

### J. Analisis Keamanan Dasar

Meskipun tahap ini masih dasar, penting bagi mahasiswa untuk memahami:

1. Password **tidak pernah disimpan atau ditampilkan dalam teks asli**.
2. Atribut `protected` (`$password`, `$db`, `$id`) melindungi data sensitif dari manipulasi langsung.
3. Saat nanti pengguna login, pembandingan password dilakukan dengan `password_verify()`, bukan dengan pencocokan string biasa.

---

## VI. Menampilkan Daftar User di Halaman Members

> **Tujuan Pembelajaran:**
>
> 1. Memahami cara mengambil data dari database menggunakan model `User`.
> 2. Menampilkan data hasil query dalam bentuk tabel HTML.
> 3. Menjalankan halaman dinamis pertama (`members.php`) yang menampilkan data dari tabel `users`.
> 4. Melakukan pengujian tampilan dan memastikan data tampil sesuai isi database.

### A. Gambaran Umum

Sampai tahap ini:

* Koneksi database (`Database.php`) sudah berfungsi.
* Model `User` sudah dapat membaca data pengguna dari tabel `users`.
* Navigasi (`Utility::showNav()`) sudah tampil di setiap halaman.

Langkah berikutnya adalah **menampilkan daftar user dari database** ke halaman web `members.php`. Halaman ini akan menjadi bukti pertama bahwa aplikasi PHP OOP yang dibuat benar-benar berinteraksi dengan data nyata dari MySQL.

### B. Alur Logika Halaman `members.php`

Sebelum menulis kode, pahami dulu alur kerja halamannya:

1. File `members.php` memanggil `config.php` agar session, autoload, dan koneksi database aktif.
2. Obyek dari kelas `User` dibuat, lalu menjalankan method `getAll()` untuk mengambil semua data dari tabel `users`.
3. Hasil query (berupa array daftar user) dikirim ke bagian tampilan HTML.
4. Data ditampilkan dalam bentuk tabel.

Setiap baris tabel mewakili satu pengguna, menampilkan kolom seperti:

* Username
* Fullname
* City
* Created At

Pada modul-modul berikutnya, tabel ini akan ditambahkan tombol **Edit** dan **Delete** di setiap baris. Namun, untuk tahap ini, fokusnya hanya pada **menampilkan data**.

### C. Menyiapkan Data Awal (Seed Data)

Agar tabel `members` tidak kosong saat diuji, pastikan tabel `users` sudah berisi beberapa data. Jika belum, masukkan beberapa baris contoh melalui phpMyAdmin atau MySQL CLI.

```sql
INSERT INTO users (username, password, fullname, city)
VALUES
('admin', '$2y$10$QEjvG8WGyfhashhashhash', 'Administrator', 'Denpasar'),
('budi',  '$2y$10$HSyDoYPGn8hashhashhash', 'Budi Santoso', 'Surabaya'),
('citra', '$2y$10$hP1jsh8E7rhashhashhash', 'Citra Dewi', 'Jakarta');
```

Password pada contoh di atas sudah dalam bentuk hash (tidak perlu login dulu). Nilai hash-nya tidak penting untuk uji tampilan.

### D. Menyiapkan Halaman `members.php`

File `members.php` sudah ada di proyek dalam keadaan kosong.
Struktur umumnya mengikuti pola berikut:

1. Memanggil `config.php` di baris pertama.
2. Memanggil navigasi (`Utility::showNav()`).
3. Mengambil data user dengan `User->getAll()`.
4. Menampilkan hasil dalam tabel HTML.

Secara konseptual, inilah langkah-langkah yang dilakukan oleh kode di file tersebut:

* Buat variabel `$members` untuk menampung semua hasil dari `User->getAll()`.
* Periksa apakah hasilnya berisi data atau kosong.
* Jika berisi, tampilkan dalam tabel.
* Jika kosong, tampilkan pesan sederhana seperti _“Belum ada data user.”_

Tambahkan kode berikut di dalam file `members.php`:

```php
// load all members
$user = new User();
$members = $user->getAll();
```

### E. Menampilkan Data Member dalam Tabel HTML

* Bagian `<table>` digunakan untuk menampilkan data dalam format baris dan kolom.
* Setiap user ditampilkan dalam `<tr>` (table row).
* Data user diambil dari hasil array yang dikembalikan `User->getAll()`.

Contoh struktur konseptual:

```html
<table>
  <thead>
    <tr>
      <th>No</th>
      <th>Username</th>
      <th>Fullname</th>
      <th>City</th>
      <th>Created</th>
    </tr>
  </thead>
  <tbody>
    <!-- data member ditampilkan di sini -->
  </tbody>
</table>
```

Baris `<tbody>` akan diisi secara dinamis menggunakan PHP berdasarkan hasil query dari `User->getAll()`. Untuk melakukan iterasi terhadap `$members` dan menampilkan setiap atribut user, letakkan kode PHP berikut di dalam tag `<tbody>` pada file `members.php`:

```php
<!-- Show members data -->
<?php
if (empty($members)) {
    echo '<tr><td colspan="6">Belum ada data user.</td></tr>';
}
foreach ($members as $member) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($member['id']) . '</td>';
    echo '<td>' . htmlspecialchars($member['username']) . '</td>';
    echo '<td>' . htmlspecialchars($member['fullname']) . '</td>';
    echo '<td>' . htmlspecialchars($member['city']) . '</td>';
    echo '<td>' . htmlspecialchars($member['created_at']) . '</td>';
    echo '<td>&nbsp;</td>';
    echo '</tr>';
}
?>
```

### F. Menjalankan Proyek dan Melihat Hasil

Setelah semua siap:

1. Jalankan server PHP dari folder proyek:

   ```bash
   php -S localhost:8000
   ```

2. Akses halaman:

   ```text
   http://localhost:8000/members.php
   ```

3. Pastikan tampilan berikut muncul:

   * Menu navigasi di bagian atas.
   * Tabel berisi daftar user dari database.
   * Jika database kosong, tampil pesan “Belum ada data user”.

Jika muncul error seperti _“Call to undefined method”_ atau _“class not found”_, pastikan autoload di `config.php` sudah benar dan file `User.php` berada di folder `/class`.

### G. Validasi Hasil dan Troubleshooting

| Situasi                      | Kemungkinan Penyebab             | Solusi                                                                            |
| ---------------------------- | -------------------------------- | --------------------------------------------------------------------------------- |
| Halaman kosong tanpa error   | Error reporting dimatikan        | Tambahkan `error_reporting(E_ALL); ini_set('display_errors', 1);` di `config.php` |
| Pesan “class User not found” | Autoload belum aktif             | Pastikan `spl_autoload_register()` sudah ada di `config.php`                      |
| Tabel tampil tapi kosong     | Database tidak berisi data       | Lakukan `INSERT` data contoh terlebih dahulu                                      |
| Data tidak tampil semua      | Query `getAll()` membatasi hasil | Periksa method `getAll()` di `User.php` agar menampilkan semua baris              |

### H. Hubungan dengan Modul Sebelumnya dan Selanjutnya

* Modul ini menggunakan hasil dari Bagian **IV** (Database) dan Bagian **V** (User).
* Data yang ditampilkan di `members.php` akan menjadi dasar untuk fitur berikut:

  * Login & Proteksi sesi (Bagian **VII**).
  * Tambah data (Bagian **IX**).
  * Edit data (Bagian **X**).
  * Hapus data (Bagian **XI**).

Dengan demikian, `members.php` adalah halaman pertama yang benar-benar **menampilkan interaksi data nyata dari database ke tampilan web**.

---

## VII. Autentikasi dan Proteksi Sesi

> **Tujuan Pembelajaran:**
>
> 1. Memahami konsep dasar autentikasi (login dan logout).
> 2. Menambahkan method `authenticate()` pada kelas `User` untuk memverifikasi login.
> 3. Menggunakan session untuk menjaga status login pengguna.
> 4. Melindungi halaman-halaman agar hanya bisa diakses setelah login.
> 5. Mengimplementasikan logout agar pengguna dapat keluar dengan aman.

### A. Konsep Autentikasi

Autentikasi adalah proses **memastikan identitas pengguna**. Pada aplikasi ini, autentikasi dilakukan dengan cara:

1. Pengguna memasukkan `username` dan `password` di form login.
2. Sistem memeriksa apakah `username` tersebut ada di database.
3. Jika ada, sistem **memverifikasi password** dengan membandingkan nilai yang dimasukkan dengan hash di database menggunakan `password_verify()`.
4. Jika cocok, sistem menyimpan informasi login ke dalam **session**.
5. Jika tidak cocok, pengguna dikembalikan ke halaman login dengan pesan error.

### B. Peran Session dalam Login

**Session** digunakan untuk mengingat siapa yang sedang login. Ketika login berhasil, informasi pengguna (misalnya `id`, `username`, `fullname`) disimpan ke dalam `$_SESSION`, sehingga:

* Pengguna tidak perlu login ulang setiap kali berpindah halaman.
* Halaman lain dapat memeriksa session untuk menentukan apakah pengguna sudah login.
* Saat logout, session akan dihapus untuk mengakhiri akses.

Tambahkan kode memulai session berikut di `inc/config.php` jika belum ada:

```php
// Start session
session_start();
```

Semua session sudah otomatis aktif, karena file `config.php` memanggil `session_start()` di awal aplikasi.

### C. Menambahkan Method `authenticate()` pada Kelas `User`

Method ini bertugas **memverifikasi data login pengguna**. Alur kerjanya sebagai berikut:

1. Menerima dua parameter: `$username` dan `$password`.
2. Menjalankan query ke tabel `users` untuk mencari pengguna dengan username tersebut.
3. Jika tidak ditemukan → login gagal.
4. Jika ditemukan → gunakan `password_verify()` untuk membandingkan hash di database dengan input pengguna.
5. Jika cocok → simpan atribut objek (`id`, `fullname`, `city`, dsb.) dan kembalikan nilai **true**.
6. Jika tidak cocok → kembalikan **false**.

Tambahkan kode untuk autentikasi berikut di dalam file `class/User.php`:

```php
// Authenticate user credentials
public function authenticate($username, $password) {
  $sql = "SELECT * FROM users WHERE username = :username LIMIT 1";
  $stmt = $this->db->query($sql, ['username' => $username]);
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  if ($user && password_verify($password, $user['password'])) {
    // set SESSION user login
    $_SESSION['user']['id'] = $user['id'];
    $_SESSION['user']['username'] = $user['username'];
    $_SESSION['user']['fullname'] = $user['fullname'];
    $_SESSION['user']['city'] = $user['city'];
    $_SESSION['user']['created_at'] = $user['created_at'];
    $_SESSION['user']['last_login'] = date('Y-m-d H:i:s');
    return true;
  }
  return false;
}
```

Dengan begitu, pemanggil (halaman `authenticate.php`) cukup memanggil:

```php
$user = new User();
if ($user->authenticate($username, $password)) {
   // login sukses
} else {
   // login gagal
}
```

### D. Membuat Halaman Login

File `login.php` sudah disediakan dalam proyek. Halaman ini berisi form sederhana dengan dua field: `username` dan `password`. Form akan dikirimkan ke `authenticate.php` menggunakan metode `POST`.

Contoh struktur form:

```html
<form id="form-login" method="post" action="authenticate.php">
  <label>Username</label>
  <input type="text" name="username" required>

  <label>Password</label>
  <input type="password" name="password" required>

  <button type="submit">Login</button>
</form>
```

Gaya tampilan sudah diatur di `style.css`, sehingga mahasiswa tidak perlu menambahkan CSS lagi.

### E. Membuat Proses Autentikasi (`authenticate.php`)

Halaman `authenticate.php` bertugas menerima data dari form login, memanggil method `authenticate()` dari `User`, dan menentukan hasilnya.

Langkah-langkahnya:

1. Ambil `username` dan `password` dari `$_POST`.
2. Buat objek `User`.
3. Panggil `$user->authenticate($username, $password)`.
4. Jika hasilnya **true**:

   * Simpan data penting ke session, misalnya:

     ```php
     $_SESSION['user'] = [
       'id' => $user->getId(),
       'username' => $user->username,
       'fullname' => $user->fullname
     ];
     ```

   * Arahkan ke halaman `index.php` atau `members.php`.
5. Jika hasilnya **false**:

   * Simpan pesan kesalahan ke flash message (akan dibuat pada modul berikutnya).
   * Kembalikan pengguna ke halaman `login.php`.

Tambahkan baris-baris kode berikut di dalam file `authenticate.php`:

```php
// process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User();
    if ($user->authenticate($username, $password)) {
        // redirect to members page on success
        header('Location: members.php');
        exit;
    }
}
// redirect back to login on failure
header('Location: login.php');
exit;
```

### F. Menambahkan Method Bantu di Kelas `Utility`

Agar autentikasi lebih mudah digunakan di seluruh aplikasi, beberapa fungsi tambahan disiapkan di `Utility.php`:

1. `redirect($target)`

    Mengarahkan halaman ke URL lain menggunakan perintah header (redirect sederhana). Method ini nantinya juga bisa menerima parameter opsional untuk flash message dan prefill data (akan dibahas di modul berikutnya).

    Namun sebelumnya, terkadang folder proyek dijalankan di subfolder, bukan di root, sehingga perlu penyesuaian URL. Hal ini dapat diatasi dengan mendefinisikan base URL terlebih dahulu pada file `inc/config.php`:

    ```php
    // Define base URL
    const BASE_URL = 'http://localhost:8000/<folder_proyek_jika_ada>/'; // sesuaikan dengan nama folder
    ```

    Setelah itu, tambahkan kode berikut di dalam file `class/Utility.php`:

    ```php
    // Redirect to a different page with an optional message and prefill data
    public static function redirect($url, $msg = '', $prefill = []) {
        // You can extend this method later to handle flash messages and prefill data

        header("Location: " . BASE_URL . $url);
        exit();
    }
    ```

2. `checkLogin()`

    Digunakan untuk memeriksa apakah pengguna sudah login.

    * Jika belum login, pengguna akan diarahkan ke `login.php`.
    * Jika sudah login, halaman akan dilanjutkan seperti biasa, kecuali halaman `login.php` yang akan diarahkan ke `members.php`.

    Tambahkan kode berikut di dalam file `class/Utility.php`:

    ```php
    // Check user login status
    public static function checkLogin($login=true) {
        if ($login && !isset($_SESSION['user'])) {
            self::redirect('login.php', "Please log in to access this page.");
        } elseif (!$login && isset($_SESSION['user'])) {
            self::redirect('index.php');
        }
    }
    ```

    Penggunaan parameter `$login` memungkinkan pengecekan dua arah:
    * Jika `$login` bernilai **true** (default), maka halaman hanya boleh diakses jika sudah login.
    * Jika `$login` bernilai **false**, maka halaman hanya boleh diakses jika belum login (misalnya halaman `login.php`).

3. `logout()`

    Menghapus seluruh data session, sehingga pengguna dianggap sudah keluar.

    Tambahkan kode berikut di dalam file `class/Utility.php`:

    ```php
    // Logout user
    public static function logout() {
        unset($_SESSION['user']);
        self::redirect('login.php');
    }
    ```

Dengan ketiga method ini, aplikasi bisa memeriksa dan melindungi halaman secara sederhana, tanpa menulis ulang kode di tiap file.

### G. Menambahkan Proteksi Sesi ke Halaman Privat

Beberapa halaman **hanya boleh diakses jika pengguna sudah login**, yaitu:

* `index.php`
* `members.php`
* `create.php`
* `save.php`
* `edit.php`
* `update.php`
* `delete.php`

Untuk melindungi halaman-halaman tersebut, tambahkan baris berikut di bagian atas setelah `require_once config.php`:

```php
// check if user is logged in
Utility::checkLogin();
```

Jika pengguna mencoba mengakses halaman tersebut tanpa login, maka otomatis diarahkan ke halaman `login.php`.

Halaman `authenticate.php` dan `logout.php` tidak perlu diproteksi, karena digunakan untuk masuk dan keluar. Sementara halaman `login.php` justru harus diproteksi agar tidak bisa diakses jika sudah login.

Tambahkan baris berikut di bagian atas file `login.php` setelah `require_once config.php`:

```php
// check if user is logged in
Utility::checkLogin(false);
```

### H. Membuat Logout

Logout dilakukan dengan memanggil `Utility::logout()`, kemudian mengarahkan pengguna ke halaman `login.php`.

Hal ini sudah diatur pada file `logout.php`:

1. Memanggil `config.php` agar session aktif.
2. Memanggil `Utility::logout()` untuk menghapus session.
3. Melakukan redirect ke `login.php`.

Tambahkan kode berikut di dalam file `logout.php`:

```php
// logout user
Utility::logout();
```

### I. Uji Coba Autentikasi

Sebelum melakukan uji coba, tambahkan kode untuk menampilkan data session pengguna yang login di halaman `index.php`. Modifikasi file `index.php` untuk menampilkan informasi user yang sedang login, menjadi seperti berikut:

```php
<ul>
  <li>ID: <?php echo $_SESSION['user']['id']; ?></li>
  <li>Username: <?php echo $_SESSION['user']['username']; ?></li>
  <li>Name: <?php echo $_SESSION['user']['fullname']; ?></li>
  <li>City: <?php echo $_SESSION['user']['city']; ?></li>
  <li>Join Date: <?php echo $_SESSION['user']['created_at']; ?></li>
  <li>Last Login: <?php echo $_SESSION['user']['last_login']; ?></li>
</ul>
```

Modifikasi juga kode file `authenticate.php` sebagai berikut untuk menggunakan method `Utility::redirect()`:

```php
// process login form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $user = new User();
    if ($user->authenticate($username, $password)) {
        // redirect to index page on success
        Utility::redirect('index.php');
    } else {
        // redirect back to login on failure with message
        Utility::redirect('login.php', 'Invalid username or password.', ['username' => $username]);
    }
}
// redirect back to login when accessed directly
Utility::redirect('login.php');
```

Setelah itu, lakukan langkah-langkah berikut untuk memastikan sistem login berjalan dengan baik:

**Uji Login Berhasil:**

1. Jalankan server:

    ```bash
    php -S localhost:8000
    ```

2. Akses halaman `login.php`.
3. Masukkan username dan password yang sesuai dengan data di tabel `users`.
4. Jika benar, halaman akan berpindah ke `index.php` atau `members.php`.
5. Coba buka `members.php` tanpa login — seharusnya berhasil karena session masih aktif.

**Uji Login Gagal:**

1. Masukkan username yang tidak ada di database, atau password salah.
2. Aplikasi akan tetap berada di halaman login.

**Uji Logout:**

1. Klik menu **Logout** di navigasi.
2. Session akan dihapus, dan halaman kembali ke `login.php`.
3. Coba akses `members.php` — seharusnya dialihkan ke halaman login kembali.

### J. Hubungan dengan Modul Sebelumnya

| Modul Sebelumnya | Hubungan dengan Autentikasi                                                 |
| ---------------- | --------------------------------------------------------------------------- |
| Database         | Menyediakan koneksi untuk membaca data login dari tabel `users`.            |
| User             | Menyediakan method `authenticate()` yang digunakan oleh `authenticate.php`. |
| Utility          | Menyediakan method pendukung (redirect, checkLogin, logout).                |
| Members          | Sekarang diproteksi dengan `checkLogin()`.                                  |

---

## VIII. Fitur Flash Message dan Prefill Form

> **Tujuan Pembelajaran:**
>
> 1. Memahami konsep **flash message** untuk menampilkan pesan sementara (sekali tampil).
> 2. Memahami konsep **prefill form** agar data isian pengguna tetap muncul setelah terjadi kesalahan.
> 3. Mengetahui cara memanfaatkan method static pada kelas `Utility` untuk menerapkan dua fitur tersebut.
> 4. Menerapkan flash dan prefill di halaman login serta halaman pembuatan user baru.

### A. Mengapa Fitur Ini Penting

Sebuah aplikasi yang baik tidak hanya berfungsi dengan benar, tetapi juga **memberikan umpan balik yang jelas kepada pengguna**.

Ada dua jenis umpan balik yang penting:

1. **Pesan sementara (flash)** — muncul setelah suatu aksi dilakukan (misalnya login gagal, data berhasil disimpan).
2. **Prefill form** — membantu pengguna dengan mengisi ulang data yang sebelumnya telah diketik, sehingga tidak perlu menulis ulang saat terjadi kesalahan input.

Tanpa dua fitur ini, pengalaman pengguna akan terasa membingungkan, terutama jika terjadi kesalahan saat login atau menyimpan data.

### B. Konsep Flash Message

**Flash message** adalah pesan singkat yang dibuat **di halaman pertama**, disimpan di session, kemudian hanya ditampilkan **sekali di halaman kedua**. Setelah ditampilkan, pesan tersebut akan otomatis dihapus.

Contoh penggunaan:

* “Login gagal, periksa kembali username dan password.”
* “User baru berhasil ditambahkan.”
* “Data berhasil diperbarui.”

Kelebihan flash message:

* Pesan tetap tersimpan saat terjadi redirect ke halaman lain.
* Pengguna mendapat konfirmasi langsung atas tindakannya.

### C. Implementasi Flash Message

Alur kerja flash message adalah sebagai berikut: _Dibuat &rarr; Redirect &rarr; Ditampilkan &rarr; Dihapus_. Semua proses tersebut akan dilakukan oleh kelas `Utility` melalui dua method static, yaitu `redirect()` dan `showFlash()`.

1. Membuat Pesan Flash

    Flash message selalu dibuat sebelum redirect, sehingga proses ini bisa disisipkan di method `Utility::redirect()` dengan menambahkan parameter pesan setelah parameter tujuan, namun sifatnya opsional.

    Modifikasi method `redirect()` dalam file `class/Utility.php` hingga menjadi seperti berikut:

    ```php
    // Redirect to a different page with an optional message and prefill data
    public static function redirect($url, $msg = '', $prefill = []) {
        // You can extend this method later to handle prefill data

        // set flash message if provided
        if ($msg) {
            $_SESSION['flash']['message'] = $msg;
        }

        // perform redirect
        header("Location: " . BASE_URL . $url);
        exit();
    }
    ```

2. Menampilkan Pesan Flash

    Untuk menampilkan isi pesan (jika ada) dan **menghapusnya dari session** setelah ditampilkan, dapat menggunakan method `Utility::showFlash()`. Biasanya diletakkan di bagian atas halaman (tepat sebelum form atau tabel).

    Tambahkan kode untuk method berikut di dalam file `class/Utility.php`:

    ```php
    // Show flash message
    public static function showFlash() {
        if (isset($_SESSION['flash'])) {
            echo '<p class="flash-message">' . $_SESSION['flash']['message'] . '</p>';
            unset($_SESSION['flash']);
        }
    }
    ```

3. Contoh Alur Kerja

    Di `authenticate.php`, jika login gagal:

    ```php
    Utility::redirect('login.php', 'Username atau password salah.');
    ```

    Modifikasi file `login.php`, dengan menambahkan method untuk menampilkan flash message di atas form control `username` dan `password`, seperti berikut:

    ```php
    <form action="authenticate.php" method="POST" id="form-login">
      <div class="row"><?php Utility::showFlash(); ?></div>
      <div class="row">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" value="" autofocus required>
      </div>
      <div class="row">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <div class="row">
        <button type="submit">Login</button>
      </div>
    </form>
    ```

    Pesan akan muncul sekali, dan hilang saat halaman direfresh.

Flash message sebaiknya memiliki tipe, misalnya `success`, `warning`, `error`, `info` atau lainnya, agar bisa ditampilkan dengan gaya berbeda (warna hijau untuk sukses, kuning untuk peringatan, merah untuk error, biru untuk informasi, dan lain-lain). Namun untuk pemula, pada modul ini tipe diabaikan dan hanya menggunakan satu gaya standar.

### D. Konsep Prefill Form

**Prefill** berfungsi untuk **menyimpan sementara data yang sudah diisi pengguna** ke dalam session, sehingga bisa muncul kembali di form jika terjadi kesalahan.

Misalnya, saat form pembuatan user baru gagal karena kolom belum diisi lengkap:

* Form tidak dikosongkan.
* Nilai yang sudah diketik sebelumnya akan muncul kembali di field masing-masing.

Tujuannya:

* Menghemat waktu pengguna.
* Menghindari frustrasi karena kehilangan data yang sudah diketik.

### E. Implementasi Prefill Form

1. Menyimpan Data Prefill

    Penyimpanan data prefill dilakukan sebelum redirect, mirip dengan flash message. Proses ini juga bisa disisipkan di method `Utility::redirect()` dengan menambahkan parameter data prefill setelah parameter pesan, namun sifatnya opsional. Sehingga method `redirect()` bisa menerima tiga parameter: tujuan, pesan flash, dan data prefill.

    Modifikasi method `redirect()` dalam file `class/Utility.php` hingga menjadi seperti berikut:

    ```php
    // Redirect to a different page with an optional message and prefill data
    public static function redirect($url, $msg = '', $prefill = []) {
        // set prefill data if provided
        if (!empty($prefill)) {
            $_SESSION['prefill'] = $prefill;
        }

        // set flash message if provided
        if ($msg) {
            $_SESSION['flash']['message'] = $msg;
        }

        // perform redirect
        header("Location: " . BASE_URL . $url);
        exit();
    }
    ```

2. Mengambil Data Prefill

    `Utility::getPrefill($arrayKey)` dipanggil di file tampilan (misalnya `login.php` atau `create.php`) untuk mengisi ulang nilai input. Jika data prefill ada, akan ditampilkan; jika tidak ada, akan menggunakan nilai default (biasanya kosong).

    Tambahkan kode berikut di dalam file `class/Utility.php`:

    ```php
    // Get prefill data for specified keys
    public static function getPrefill($keys = []) {
        $data = [];
        foreach ($keys as $key) {
            $data[$key] = $_SESSION['prefill'][$key] ?? '';
        }
        return $data;
    }
    ```

3. Menghapus Data Prefill

    Setelah data prefill digunakan, biasanya data tersebut dihapus dari session agar tidak muncul lagi di kunjungan berikutnya. Proses ini bisa dilakukan melalui method `Utility::clearPrefill()`, dan dipanggil saat data sudah tidak diperlukan lagi (misalnya setelah proses berhasil).

    Tambahkan kode berikut di dalam file `class/Utility.php`:

    ```php
    // Clear prefill data
    public static function clearPrefill() {
        if (isset($_SESSION['prefill'])) {
            unset($_SESSION['prefill']);
        }
    }
    ```

### F. Penerapan di Halaman Login

Form login (`login.php`) adalah tempat pertama untuk mencoba fitur flash dan prefill.

**Langkah-langkah:**

1. Modifikasi file `authenticate.php` dengan menambahkan prefill data saat login gagal dan menghapus prefill saat login berhasil.

    Jika login gagal, simpan pesan flash dan data form, seperti kode berikut:

    ```php
    // redirect back to login on failure with message
    Utility::redirect('login.php', 'Invalid username or password.', ['username' => $username]);
    ```

    Jika login berhasil, hapus data prefill (jika ada) agar tidak muncul lagi, seperti kode berikut:

    ```php
    // redirect to index page on success
    Utility::clearPrefill();
    Utility::redirect('index.php');
    ```

2. Modifikasi file `login.php` untuk mengisi ulang nilai input dari prefill.

    Ambil data prefill jika ada:

    ```php
    // get prefill data
    $prefill = Utility::getPrefill(['username']);
    ```

    Isi ulang nilai username di input menggunakan prefill:

    ```php
    <input type="text" id="username" name="username" value="<?= $prefill['username'] ?>" autofocus required>
    ```

    Password tidak perlu di-prefill untuk alasan keamanan.

### G. Uji Coba Fitur

Lakukan uji flash message dan prefill form pada halaman login untuk memastikan fitur berjalan dengan benar:

* Masukkan username yang salah atau password acak di form login untuk memicu kegagalan.
* Setelah gagal, periksa apakah kolom username tetap terisi otomatis.
* Periksa apakah pesan error muncul di atas form.

Flash message dan prefill form nanti akan diterapkan juga pada halaman pembuatan user baru dan halaman edit user.

---

## IX. Proses Menambahkan User Baru

> **Tujuan Pembelajaran:**
>
> 1. Memahami cara menambahkan data baru ke tabel `users` melalui form HTML.
> 2. Mengetahui peran method `save()` dalam kelas `User` sebagai penyimpan data (insert dan update).
> 3. Menggunakan prepared statement agar proses penyimpanan aman.
> 4. Menggunakan flash message dan prefill untuk meningkatkan pengalaman pengguna.
> 5. Melakukan pengujian fitur tambah user di browser.

### A. Konsep Fitur Tambah User

Fitur **Create User** memungkinkan pengguna yang sudah login untuk menambahkan data pengguna baru. Alur dasarnya sebagai berikut:

1. Pengguna membuka halaman `create.php`.
2. Form isian tampil untuk mengisi username, password, fullname, dan city.
3. Setelah form dikirim, file `save.php` akan memproses data tersebut.
4. Kelas `User` menjalankan method `save()` untuk menyimpan data ke database.
5. Jika berhasil → pengguna diarahkan ke halaman `members.php` dengan pesan sukses.
6. Jika gagal → pengguna diarahkan kembali ke `create.php` dengan pesan error dan form terisi kembali (prefill).

### B. Struktur File yang Terlibat

| File          | Fungsi                                                  |
| ------------- | ------------------------------------------------------- |
| `create.php`  | Menampilkan form untuk membuat user baru.               |
| `save.php`    | Menerima data form dan memanggil `User::save()`.        |
| `User.php`    | Berisi method `save()` yang menangani penyimpanan data. |
| `Utility.php` | Digunakan untuk flash message, prefill, dan redirect.   |

### C. Desain Form di `create.php`

Form pembuatan user baru sudah disiapkan pada file `create.php`, dan sebelumnya sudah dilindungi dengan proteksi login. Isinya meliputi field:

* Username
* Password
* Fullname
* City

Semua field bersifat wajib diisi.

Cek dan lakukan modifikasi file `create.php` bila perlu (seperti pada modul-modul sebelumnya), untuk memastikan fitur dasar sudah lengkap:

* Memanggil `config.php` dan `Utility::checkLogin()`.
* Menampilkan navigasi dengan `Utility::showNav()`.
* Menampilkan flash message di atas form menggunakan `Utility::showFlash()`.
* Mengambil data prefill (jika ada) dengan `Utility::getPrefill()`.
* Menampilkan form dengan nilai input diisi dari prefill.

### D. Method `save()` dalam Kelas User

Method `save()` berfungsi **menyimpan data ke database**, baik **insert** (user baru) maupun **update** (user yang sudah ada).

Alur logika method ini:

1. Periksa apakah atribut `$id` sudah berisi nilai.

   * Jika **belum ada** → lakukan **INSERT**.
   * Jika **sudah ada** → lakukan **UPDATE**.
2. Gunakan prepared statement untuk mencegah SQL Injection.
3. Untuk password:

   * Jika password baru diisi → hash menggunakan `password_hash()`.
   * Jika kosong saat update → gunakan password lama.
4. Jalankan perintah SQL menggunakan koneksi dari `$this->db->conn`.
5. Jika berhasil → kembalikan `true`, jika gagal → `false`.

Tambahkan kode berikut di dalam file `class/User.php`:

```php
// Save user (insert or update)
public function save() {
  // return false if query fails
  if (isset($this->id)) {
    // update existing user (next module)

    return false;
  } else {
    // create new user
    $sql = "INSERT INTO users (username, password, fullname, city, created_at) VALUES (:username, :password, :fullname, :city, NOW())";
    $params = [
      'username' => $this->username,
      'password' => $this->password,
      'fullname' => $this->fullname,
      'city' => $this->city
    ];
    $stmt = $this->db->query($sql, $params);
    if ($stmt !== false) {
      $this->id = $this->db->conn->lastInsertId();
      return true;
    }
    return false;
  }
}
```

Dalam tahap ini mahasiswa fokus pada proses **insert data baru**, karena update akan dijelaskan di modul selanjutnya.

### E. Validasi Dasar Sebelum Simpan

Sebelum data dikirim ke database, program akan memeriksa hal-hal berikut:

* Semua field wajib isi (`username`, `password`, `fullname`, `city`).
* Username belum pernah digunakan sebelumnya.
* Password dan konfirmasi password harus sama.

Jika salah satu tidak terpenuhi, proses dibatalkan dan flash message “Gagal menambahkan user.” akan dikirim ke halaman form.

### F. Proses Simpan di `save.php`

File `save.php` menerima data dari form `create.php` melalui metode POST.

Langkah-langkah konseptual:

1. Memanggil `config.php` dan `Utility::checkLogin()` agar halaman aman.
2. Membuat objek `User` baru.
3. Mengisi atribut objek `User` dari data `$_POST`.
4. Memanggil `$user->save()` untuk menyimpan data.
5. Jika berhasil →

   * Buat flash message (`User baru berhasil ditambahkan.`)
   * Hapus prefill jika ada (`Utility::clearPrefill()`)
   * Redirect ke `members.php`.
6. Jika gagal →

   * Buat flash message (`Gagal menambahkan user.`)
   * Simpan prefill (`$_POST`)
   * Redirect kembali ke `create.php`.

Tambahkan kode berikut di dalam file `save.php`:

```php
// handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $city = $_POST['city'] ?? '';

    // prepare prefill data
    $prefill = [
        'username' => $username,
        'fullname' => $fullname,
        'city' => $city
    ];

    // Validate and save the data
    if ($password === $confirm) {
        $user = new User();
        $user->username = $username;
        $user->setPassword($password);
        $user->fullname = $fullname;
        $user->city = $city;
        if ($user->save()) {
            Utility::clearPrefill();
            Utility::redirect('members.php', 'User created successfully.');
        } else {
            Utility::redirect('create.php', 'Error saving user. Please try again.', $prefill);
        }
    } else {
        Utility::redirect('create.php', 'Passwords do not match.', $prefill);
    }
}
```

Dengan alur ini, pengguna mendapat informasi yang jelas dan form tetap terisi jika terjadi kesalahan.

### G. Menampilkan Pesan di Halaman Members

Setelah penyimpanan berhasil, halaman `members.php` akan menampilkan pesan sukses di atas tabel menggunakan:

```php
<div class="row"><?php Utility::showFlash(); ?></div>
```

Hal ini membantu pengguna mengetahui bahwa data telah tersimpan dengan benar.

### H. Pengujian Fitur Tambah User

Langkah pengujian dilakukan dari browser:

**Uji Tambah User Berhasil:**

1. Jalankan server:

    ```bash
    php -S localhost:8000
    ```

2. Login ke aplikasi.
3. Buka halaman `create.php`.
4. Isi semua field dengan data baru yang belum ada.
5. Klik tombol **Save**.
6. Perhatikan hasil:

   * Dialihkan ke `members.php`.
   * Pesan “User baru berhasil ditambahkan.” tampil di atas tabel.
   * Data baru muncul di tabel.

**Uji Tambah User Gagal:**

1. Coba tambahkan user dengan username yang sudah ada.
2. Pesan flash “Gagal menambahkan user.” muncul.
3. Data yang diketik (fullname, city) tetap muncul karena prefill aktif.

### I. Penjelasan Keamanan Dasar

* Password **tidak disimpan sebagai teks biasa**, tetapi di-hash dengan `password_hash()`.
* Semua input pengguna dimasukkan melalui **prepared statement**, bukan string langsung di SQL.
* Session memastikan hanya pengguna yang sudah login dapat mengakses halaman `create` dan `save`.

---

## X. Proses Edit dan Update Data User

> **Tujuan Pembelajaran:**
>
> 1. Memahami alur kerja proses edit dan update data user.
> 2. Menggunakan method `setById()` untuk menampilkan data user yang akan diedit.
> 3. Menggunakan method `save()` pada kelas `User` untuk memperbarui data.
> 4. Memahami perbedaan antara proses _insert_ dan _update_ di dalam method yang sama.
> 5. Melakukan pengujian fitur edit secara end-to-end.

### A. Konsep Fitur Edit dan Update

Setelah fitur tambah user (create) berfungsi, langkah berikutnya adalah **memperbarui data pengguna yang sudah ada**.
Proses update memungkinkan admin memperbaiki nama, kota, atau bahkan mengganti password pengguna tertentu.

Secara umum, alurnya terdiri dari dua bagian:

1. **Menampilkan data lama** pada form (di `edit.php`).
2. **Menyimpan perubahan** ke database (melalui `update.php`).

### B. Menambahkan Link Edit di Halaman Members

Agar fitur edit dapat diakses, tambahkan tautan “Edit” di setiap baris tabel di `members.php`.

Konsepnya:

* Pada saat menampilkan daftar user, tambahkan kolom aksi dengan tautan:

  ```html
  <a href="edit.php?id=<?= $user['id'] ?>">Edit</a>
  ```

  Sehingga kode tabel di dalam `tbody` pada file `members.php` menjadi seperti berikut:

  ```php
  <!-- Show members data -->
  <?php
  if (empty($members)) {
      echo '<tr><td colspan="6">Belum ada data user.</td></tr>';
  }
  foreach ($members as $member) {
      echo '<tr>';
      echo '<td>' . htmlspecialchars($member['id']) . '</td>';
      echo '<td>' . htmlspecialchars($member['username']) . '</td>';
      echo '<td>' . htmlspecialchars($member['fullname']) . '</td>';
      echo '<td>' . htmlspecialchars($member['city']) . '</td>';
      echo '<td>' . htmlspecialchars($member['created_at']) . '</td>';
      echo '<td><a href="edit.php?id=' . urlencode($member['id']) . '">Edit</a></td>';
      echo '</tr>';
  }
  ?>
  ```

* Nantinya di modul berikut (hapus user), di kolom yang sama juga akan ditambahkan link **Delete**.

Dengan tambahan kolom ini, halaman `members.php` menjadi pusat pengelolaan data user.

### C. Alur Logika Fitur Edit

1. Pengguna yang sudah login membuka halaman `members.php`.
2. Klik tombol **Edit** di salah satu baris user.
3. Aplikasi membuka `edit.php?id=<id_user>`.
4. File `edit.php` memanggil `User::setById($id)` untuk memuat data user tersebut.
5. Data lama muncul di form, siap untuk diubah.
6. Setelah pengguna mengubah data dan menekan **Update**, form dikirim ke `update.php`.
7. `update.php` memanggil `$user->save()`, kali ini dalam mode **update** karena `$id` sudah terisi.
8. Jika berhasil → tampil pesan sukses di halaman `members.php`.
9. Jika gagal → tampil pesan error dan form tetap terisi dengan prefill.

### D. Peran Method `setById()` dan `save()`

1. `setById($id)`

    Sudah dibuat di modul sebelumnya. Digunakan untuk **mengambil data satu pengguna dari database** berdasarkan ID. Data hasil query disimpan ke atribut objek (`username`, `fullname`, `city`, dan `created_at`), sehingga siap ditampilkan ke form.

2. `save()`

    Sudah digunakan untuk proses _insert_ pada modul sebelumnya. Kali ini, method yang sama akan mendeteksi bahwa `$id` sudah terisi, sehingga secara otomatis melakukan **UPDATE**.

    Modifikasi kode di dalam method `save()` pada file `class/User.php` menjadi seperti berikut:

    ```php
    // Save user (insert or update)
    public function save() {
      // return false if query fails
      if (isset($this->id)) {
        // update existing user
        $sql = "UPDATE users SET username = :username, password = :password, fullname = :fullname, city = :city WHERE id = :id";
        $params = [
          'username' => $this->username,
          'password' => $this->password,
          'fullname' => $this->fullname,
          'city' => $this->city,
          'id' => $this->id
        ];
        $stmt = $this->db->query($sql, $params);
        return $stmt !== false;
      } else {
        // create new user
        $sql = "INSERT INTO users (username, password, fullname, city, created_at) VALUES (:username, :password, :fullname, :city, NOW())";
        $params = [
          'username' => $this->username,
          'password' => $this->password,
          'fullname' => $this->fullname,
          'city' => $this->city
        ];
        $stmt = $this->db->query($sql, $params);
        if ($stmt !== false) {
          $this->id = $this->db->conn->lastInsertId();
          return true;
        }
        return false;
      }
    }
    ```

Perbedaan logika antara _insert_ dan _update_ di method `save()`:

| Kondisi            | Aksi yang Dilakukan                            |
| ------------------ | ---------------------------------------------- |
| `$this->id` kosong | Jalankan **INSERT INTO users (…)**             |
| `$this->id` terisi | Jalankan **UPDATE users SET … WHERE id = :id** |

### E. Membuat Form Edit di `edit.php`

Halaman `edit.php` hampir sama dengan `create.php`, namun:

* Form-nya diisi otomatis dengan data user yang diambil dari database.
* Password bersifat opsional (jika dikosongkan, tidak diubah).
* Tombol submit diarahkan ke `update.php`.

Alur konseptual:

1. Ambil parameter `id` dari URL (`$_GET['id']`).
2. Buat objek `User`, lalu panggil `$user->setById($id)`.
3. Isi nilai field form dengan data dari objek user.
4. Terdapat input tersembunyi untuk menyimpan `id` user.
5. Jika user tidak ditemukan → redirect ke `members.php` dengan pesan error.

Tambahkan baris berikut di dalam file `edit.php`:

```php
// get user ID from query parameter
$id = $_GET['id'] ?? 0;

// load user
$user = new User();
if (!$user->setById($id)) {
    Utility::redirect('members.php', 'User not found.');
}
```

Cek dan lakukan modifikasi file `edit.php` bila perlu, untuk memastikan fitur dasar sudah lengkap:

* Memanggil `config.php` dan `Utility::checkLogin()`.
* Menampilkan navigasi dengan `Utility::showNav()`.
* Menampilkan flash message di atas form menggunakan `Utility::showFlash()`.
* Menampilkan form dengan nilai input diisi dari data user.
* Menambahkan input tersembunyi untuk `id`, seperti berikut:

```php
<input type="hidden" name="id" value="<?= $id ?>">
```

### F. Memproses Update di `update.php`

File `update.php` akan menangani penyimpanan perubahan data user.

Langkah-langkahnya:

1. Memanggil `config.php` dan `Utility::checkLogin()`.
2. Buat objek `User` baru.
3. Isi atribut `$id`, `$username`, `$fullname`, `$city`, dan `$password` dari data `$_POST`.
4. Jalankan `$user->save()`.
5. Jika berhasil →

   * Set flash message sukses (`Data user berhasil diperbarui.`)
   * Redirect ke `members.php`.
6. Jika gagal →

   * Set flash message error (`Gagal memperbarui data user.`)
   * Simpan prefill dan redirect kembali ke `edit.php?id=<id>`.

Tambahkan kode berikut di dalam file `update.php`:

```php
// handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? 0;
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm = $_POST['confirm'] ?? '';
    $fullname = $_POST['fullname'] ?? '';
    $city = $_POST['city'] ?? '';

    $user = new User();
    if ($user->setById($id)) {
        // Update user details
        $user->username = $username;
        $user->fullname = $fullname;
        $user->city = $city;

        // Update password only if provided
        if (!empty($password)) {
            if ($password === $confirm) {
                $user->setPassword($password);
            } else {
                Utility::redirect("edit.php?id=$id", 'Passwords do not match.');
            }
        }

        if ($user->save()) {
            // Set flash message success
            Utility::redirect('members.php', 'User updated successfully.');
        } else {
            // Set flash message error
            Utility::redirect("edit.php?id=$id", 'Error updating user. Please try again.');
        }
    } else {
        // User not found
        Utility::redirect('members.php', 'User not found.');
    }
}
// redirect back to members if accessed directly
Utility::redirect('members.php');
```

### G. Skenario Uji

Setelah semua file siap, lakukan uji coba berikut:

**Uji Menampilkan Data Lama:**

1. Jalankan server:

    ```bash
    php -S localhost:8000
    ```

2. Akses `members.php`.
3. Klik **Edit** pada salah satu user.
4. Pastikan halaman `edit.php` muncul dengan form yang sudah terisi data lama dari database.

**Uji Update Data Berhasil:**

1. Ubah salah satu field (misalnya `city`).
2. Klik **Update**.
3. Setelah diarahkan ke `members.php`, periksa tabel: data harus berubah sesuai isian.
4. Pesan “Data user berhasil diperbarui.” muncul di atas tabel.

**Uji Update Data Gagal:**

1. Kosongkan field wajib (misalnya `fullname`).
2. Klik **Update**.
3. Pesan error muncul, form tetap terisi dengan prefill.

**Uji Ubah Password:**

1. Isi password baru saat edit.
2. Klik **Update**.
3. Pastikan hash password di database berubah.
4. Login menggunakan password baru (uji validasi login).

### H. Analisis dan Pembelajaran

* Proses **update** memanfaatkan method `save()` yang sama dengan **insert**, namun dibedakan oleh nilai `$id`.
* **Reusability (pemakaian ulang)** adalah prinsip penting dalam OOP: satu method dapat menangani dua jenis operasi dengan logika internal berbeda.
* **Prepared statement** memastikan keamanan dari SQL Injection.
* Fitur **flash** dan **prefill** meningkatkan interaksi pengguna.

---

## XI. Proses Menghapus Data User

> **Tujuan Pembelajaran:**
>
> 1. Memahami cara menghapus data dari database menggunakan model `User`.
> 2. Menambahkan method `remove()` pada kelas `User`.
> 3. Menghubungkan aksi “Delete” dari tabel `members.php` ke proses `delete.php`.
> 4. Mencegah pengguna menghapus akun miliknya sendiri.
> 5. Menguji fitur delete agar bekerja aman dan sesuai harapan.

### A. Pengenalan Fitur Delete

Setelah fitur **Create** dan **Update** selesai, kini tiba saatnya melengkapi fitur CRUD terakhir yaitu **Delete**. Tujuannya adalah memungkinkan admin menghapus data pengguna yang sudah tidak diperlukan.

Namun, untuk menjaga keamanan:

* Hanya pengguna yang sudah login dapat melakukan penghapusan.
* Aplikasi tidak boleh mengizinkan seorang pengguna **menghapus dirinya sendiri** saat sedang login.

### B. Alur Logika Penghapusan

1. Pengguna yang sudah login membuka halaman `members.php`.
2. Klik tombol **Delete** di salah satu baris user.
3. Browser akan meminta **konfirmasi sederhana** (misalnya “Apakah Anda yakin ingin menghapus user ini?”).
4. Jika dikonfirmasi, browser akan membuka `delete.php?id=<id_user>`.
5. File `delete.php`:

   * Memanggil `config.php` dan memeriksa login.
   * Membuat objek `User` baru.
   * Memanggil `$user->remove($id)` untuk menghapus data.
   * Menampilkan pesan sukses atau gagal melalui flash message.
   * Redirect kembali ke `members.php`.

### C. Method `remove()` dalam Kelas User

**Fungsi:**

Menghapus satu baris data dari tabel `users` berdasarkan `id` yang diberikan.

**Alur logika:**

1. Terima parameter `$id`.
2. Periksa apakah `$id` valid dan ada di database.
3. Jalankan query:

   ```sql
   DELETE FROM users WHERE id = :id
   ```

4. Jika perintah berhasil → kembalikan `true`.
5. Jika gagal → kembalikan `false`.

**Pencegahan Self-Delete:**

Sebelum eksekusi, tambahkan pengecekan:

* Jika `$id` sama dengan `$_SESSION['user']['id']`, batalkan proses dan kembalikan pesan error: “_Tidak dapat menghapus akun yang sedang digunakan._”

Dengan logika ini, aplikasi aman dari penghapusan diri sendiri secara tidak sengaja.

Tambahkan kode berikut di dalam file `class/User.php`:

```php
// Remove user
public function remove() {
  // check delete user is logged in user
  if (isset($this->id) && $this->id == ($_SESSION['user']['id'] ?? 0)) {
    return false; // cannot delete logged in user
  }

  if (isset($this->id)) {
    $sql = "DELETE FROM users WHERE id = :id";
    $params = ['id' => $this->id];
    $stmt = $this->db->query($sql, $params);
    return $stmt !== false;
  }
  return false;
}
```

### D. Menambahkan Tombol Delete di `members.php`

Agar fitur ini dapat digunakan, tambahkan kolom **Aksi** di tabel daftar user (jika belum ada).
Di setiap baris, tampilkan dua tautan:

* **Edit**
* **Delete**

Contoh konseptual struktur baris tabel:

```html
<td>
  <a href="edit.php?id=<?= $user['id'] ?>">Edit</a> |
  <a href="delete.php?id=<?= $user['id'] ?>" 
     onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">
     Delete
  </a>
</td>
```

Dengan tambahan ini pada halaman `members.php`, kode tabel di dalam `tbody` menjadi seperti berikut:

```php
<!-- Show members data -->
<?php
foreach ($members as $member) {
    echo '<tr>';
    echo '<td>' . htmlspecialchars($member['id']) . '</td>';
    echo '<td>' . htmlspecialchars($member['username']) . '</td>';
    echo '<td>' . htmlspecialchars($member['fullname']) . '</td>';
    echo '<td>' . htmlspecialchars($member['city']) . '</td>';
    echo '<td>' . htmlspecialchars($member['created_at']) . '</td>';
    echo '<td style="text-align: right;"><a href="edit.php?id=' . urlencode($member['id']) . '">Edit</a> | ';
    echo '<a href="delete.php?id=' . urlencode($member['id']) . '" onclick="return confirm(\'Are you sure?\')">Delete</a></td>';
    echo '</tr>';
}
?>
```

Fungsi JavaScript `confirm()` akan menampilkan dialog konfirmasi bawaan browser. Jika pengguna menekan **Cancel**, halaman tidak akan berlanjut ke `delete.php`.

### E. Menyiapkan File `delete.php`

File ini adalah _controller_ sederhana yang menangani permintaan penghapusan.

Langkah-langkah umum di `delete.php`:

1. Panggil `require 'inc/config.php';`
2. Jalankan `Utility::checkLogin();` agar hanya pengguna yang sudah login dapat melanjutkan.
3. Ambil parameter `id` dari `$_GET['id']`.
4. Buat objek `User`.
5. Jalankan `$user->remove($id)`.
6. Jika berhasil → tampilkan pesan flash sukses dan redirect ke `members.php`.
7. Jika gagal → tampilkan pesan flash error dan redirect ke `members.php`.

Tambahkan kode berikut di dalam file `delete.php`:

```php
// get user ID from query parameter
$id = $_GET['id'] ?? 0;

// load user
$user = new User();
if (!$user->setById($id)) {
    Utility::redirect('members.php', 'User not found.');
}

// attempt to remove user
if ($user->remove()) {
    Utility::redirect('members.php', 'User deleted successfully.');
} else {
    Utility::redirect('members.php', 'Error deleting user. Please try again.');
}
```

### F. Pesan dan Umpan Balik

Gunakan flash message agar pengguna mengetahui hasil operasi:

* Jika berhasil: “_User berhasil dihapus._”
* Jika gagal (termasuk self-delete): “_Gagal menghapus user._”

### G. Uji Coba Fitur Delete

Lakukan uji bertahap untuk memastikan semua logika berjalan dengan benar.

**Uji Delete Berhasil:**

1. Jalankan server lokal:

   ```bash
   php -S localhost:8000
   ```

2. Login sebagai admin.
3. Buka halaman `members.php`.
4. Klik **Delete** pada salah satu user (bukan akun admin).
5. Klik “OK” saat konfirmasi muncul.
6. Halaman `members.php` terbuka kembali dengan pesan: “_User berhasil dihapus._” dan user tersebut hilang dari tabel.

**Uji Cegah Self-Delete:**

1. Login sebagai user tertentu.
2. Coba hapus akun sendiri.
3. Aplikasi menolak dan menampilkan pesan: “_Tidak dapat menghapus akun yang sedang digunakan._”

**Uji Delete Gagal (ID Tidak Valid):**

1. Buka manual URL `delete.php?id=9999` (ID yang tidak ada).
2. Pesan “_Gagal menghapus user._” muncul, dan tidak ada perubahan di database.

### H. Analisis Keamanan dan Praktik Baik

* **Konfirmasi manual (`confirm()`)** membantu mencegah penghapusan tidak sengaja.
* **Proteksi sesi** memastikan hanya pengguna terautentikasi yang dapat menghapus data.
* **Validasi ID** di server menjaga agar hanya data valid yang dihapus.
* **Cegah self-delete** melindungi akun aktif agar tidak terhapus saat digunakan.

---

## XII. Ide Pengembangan Lanjutan untuk Proyek CRUD PHP OOP

> **Tujuan Pembelajaran:**
>
> 1. Dapat mengidentifikasi berbagai aspek yang masih bisa dikembangkan dari proyek CRUD ini.
> 2. Memahami pentingnya keamanan, validasi, dan efisiensi pada sistem berbasis web.
> 3. Mampu merancang ide pengembangan lanjutan sesuai kebutuhan nyata.
> 4. Menyadari bahwa sistem CRUD sederhana dapat menjadi pondasi berbagai aplikasi yang lebih kompleks.

### A. Refleksi dari Hasil Belajar

Seluruh modul sebelumnya telah membimbing mahasiswa dari **tahap dasar hingga mampu membangun aplikasi CRUD berbasis PHP OOP**. Seluruh komponen utama telah dipraktikkan:

* **Koneksi database** melalui PDO.
* **Model User** sebagai representasi tabel data.
* **Navigasi dan tampilan dinamis** di browser.
* **Autentikasi dan proteksi sesi**.
* **Fitur flash dan prefill** untuk pengalaman pengguna.
* **Proses lengkap Create, Read, Update, Delete**.

Dengan struktur yang rapi, mahasiswa telah memahami bagaimana konsep OOP diterapkan di aplikasi nyata secara bertahap. Namun, dunia pengembangan web tidak berhenti di sini. Aplikasi sederhana seperti ini bisa menjadi dasar untuk sistem yang jauh lebih besar dan aman.

### B. Arah Pengembangan Teknis

1. Validasi dan Sanitasi Data

    Saat ini, validasi dilakukan secara dasar (misalnya field wajib diisi). Pengembangan berikutnya dapat meliputi:

    * Menambahkan **validasi format** (email, panjang karakter, dsb).
    * Menolak input yang mengandung karakter berbahaya.
    * Menyediakan pesan kesalahan yang lebih detail.
    * Memisahkan lapisan validasi dari logika utama (menggunakan _Validation class_).

    Tujuannya adalah mencegah kesalahan input sekaligus melindungi sistem dari serangan seperti **SQL Injection** dan **XSS (Cross-Site Scripting)**.

2. Pagination dan Pencarian Data

    Jika jumlah user semakin banyak, menampilkan seluruh data sekaligus tidak efisien. Solusi:

    * Menambahkan **pagination (halaman data)** di `members.php` menggunakan parameter `?page=1`, `?page=2`, dst.
    * Menambahkan **fitur pencarian** berdasarkan username atau kota.
    * Menggunakan query dengan LIMIT dan OFFSET untuk menampilkan data per halaman.

    Ini merupakan langkah awal menuju aplikasi yang siap menangani data dalam jumlah besar.

3. Role-Based Access Control (RBAC)

    Saat ini semua pengguna memiliki hak akses yang sama. Pada pengembangan selanjutnya, dapat ditambahkan sistem peran, misalnya:

    * **Admin** – dapat menambah, mengubah, menghapus user.
    * **Member biasa** – hanya dapat melihat data atau mengubah profil sendiri.

    Struktur tabel baru seperti `roles` dapat ditambahkan, dan relasi antara user dan role diatur untuk mengontrol hak akses.

4. Logging Aktivitas

    Setiap tindakan penting seperti login, tambah user, ubah data, dan hapus user sebaiknya dicatat dalam tabel `logs`. Kolom log dapat berisi:

    * ID pengguna.
    * Jenis aktivitas.
    * Waktu dan tanggal.
    * Alamat IP (opsional).

    Log ini membantu administrator memantau aktivitas sistem dan menjadi dasar audit keamanan.

5. Peningkatan Keamanan

    Beberapa praktik keamanan lanjutan yang dapat diterapkan:

    * **CSRF Token (Cross-Site Request Forgery):** Tambahkan token rahasia di setiap form untuk memastikan bahwa permintaan berasal dari halaman yang sah.
    * **Password Policy:** Terapkan aturan panjang minimal, kombinasi huruf dan angka, serta pengecekan kekuatan password.
    * **Rate Limiting pada Login:** Batasi percobaan login berulang agar tidak mudah diserang brute force.
    * **Penggunaan HTTPS (SSL):** Gunakan protokol aman saat aplikasi dijalankan di server publik.
      Gunakan protokol aman saat aplikasi dijalankan di server publik.

6. Peningkatan Struktur dan Skalabilitas

    Struktur proyek dapat dikembangkan menjadi arsitektur yang lebih profesional, misalnya:

    * Memisahkan direktori **controller**, **model**, dan **view** (pola MVC).
    * Menggunakan **autoload berbasis namespace** agar lebih terorganisir.
    * Menambahkan file `.env` untuk menyimpan konfigurasi sensitif (database, secret key) dengan aman.
    * Mengadopsi framework seperti **Laravel**, **CodeIgniter**, atau **SlimPHP** agar kode lebih terstandarisasi.

### C. Integrasi dengan Teknologi Lain

Setelah memahami CRUD dasar, aplikasi dapat diperluas dengan berbagai integrasi modern:

* **REST API** — Menyediakan endpoint `/api/users` agar data dapat diakses dari aplikasi lain (misalnya mobile).
* **Frontend Framework** — Menggunakan Vue.js, React, atau Angular untuk tampilan interaktif berbasis SPA (Single Page Application).
* **JSON Web Token (JWT)** — Untuk autentikasi lintas platform (terutama pada API).
* **Integrasi Email atau WhatsApp** — Mengirim notifikasi otomatis ketika data baru ditambahkan.
* **Penyimpanan File** — Menambahkan fitur unggah foto profil dengan direktori penyimpanan khusus.

### D. Pengelolaan Database Lanjutan

Sistem database dapat dikembangkan lebih jauh:

* Menambahkan **backup otomatis**.
* Menggunakan **migration script** untuk versi struktur tabel.
* Mengoptimalkan query dengan **indexing**.
* Menambahkan tabel tambahan seperti `logs`, `settings`, atau `permissions`.

### E. Antarmuka dan Pengalaman Pengguna (UI/UX)

Tampilan saat ini sudah sederhana namun masih dapat ditingkatkan:

* Menambahkan **pemberitahuan visual (alert box)** untuk flash message.
* Menggunakan **ikon dan warna** berbeda untuk pesan sukses, gagal, dan peringatan.
* Membuat layout konsisten dengan header dan footer tetap.
* Menambahkan **pagination bar** dan **form pencarian** yang menarik.

### F. Dokumentasi dan Deployment

Langkah terakhir dalam pengembangan sistem adalah menyiapkan dokumentasi dan cara deployment.

1. Dokumentasi

   * Deskripsi singkat setiap file dan fungsinya.
   * Penjelasan konfigurasi server dan database.
   * Instruksi instalasi untuk pengguna baru.

2. Deployment

   * Siapkan server hosting atau VPS dengan PHP dan MySQL.
   * Ubah koneksi database di `config.php` sesuai konfigurasi server.
   * Pastikan direktori memiliki izin tulis yang aman.
   * Gunakan HTTPS jika sistem diakses publik.

### G. Potensi Proyek Turunan

Dari sistem CRUD sederhana ini, berbagai proyek lanjutan dapat dikembangkan, antara lain:

* **Sistem manajemen keanggotaan** (membership system).
* **Sistem login multi-role untuk e-learning**.
* **Aplikasi pengelolaan data pegawai, pelanggan, atau mahasiswa**.
* **Dashboard administrasi** untuk memantau data instansi atau organisasi.
* **Prototipe API Backend** yang mengelola data untuk aplikasi mobile.

Dengan sedikit modifikasi, proyek ini dapat menjadi pondasi nyata untuk sistem akademik, bisnis, maupun pemerintahan skala kecil.

### H. Penutup

Dengan menyelesaikan seluruh modul ini, mahasiswa telah melewati seluruh siklus pengembangan sistem CRUD berbasis PHP OOP:

1. Inisialisasi proyek dan struktur direktori.
2. Koneksi ke database.
3. Pembuatan model data (User).
4. Tampilan dinamis dan navigasi.
5. Autentikasi dan proteksi sesi.
6. Penggunaan flash message dan prefill.
7. Proses CRUD lengkap.

Lebih dari sekadar menulis kode, mahasiswa kini memahami:

* Alur kerja sistem web modern berbasis server.
* Prinsip desain berorientasi objek dalam PHP.
* Pentingnya keamanan dan pengalaman pengguna.

Langkah berikutnya adalah **bereksperimen**, **meningkatkan kualitas kode**, dan **membawa proyek ini ke tingkat yang lebih profesional**.

### I. Rekomendasi Tahap Lanjut

* Pelajari **Laravel** untuk memahami framework PHP modern.
* Pelajari **REST API dan JSON** untuk komunikasi lintas aplikasi.
* Pelajari **Keamanan Web** (OWASP Top 10).
* Gunakan **GitHub** untuk manajemen versi proyek.
* Terapkan **Docker atau XAMPP portable** untuk deployment fleksibel.

Dengan demikian, Modul **Dasar-dasar Pengelolaan Basisdata dengan PHP** berbasis OOP dan PDO ini selesai dengan hasil akhir berupa aplikasi sederhana namun lengkap, siap dikembangkan menjadi proyek yang lebih kompleks.

Selamat belajar dan bereksperimen!
