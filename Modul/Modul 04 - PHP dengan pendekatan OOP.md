# **Modul Praktikum PHP OOP (Lanjutan)**

_**Nama Kelas:** sesuaikan dengan kelas masing-masing: `ba243`, `bb243`, atau `bc243`_

---

## **0. Tujuan Pembelajaran**

Setelah menyelesaikan modul ini, mahasiswa diharapkan mampu:

1. Mengimplementasikan OOP untuk membangun aplikasi PHP yang modular.
2. Menggunakan constructor, method, dan visibility secara benar.
3. Menggunakan `autoload` untuk memanggil class secara otomatis.
4. Menerapkan konsep **inheritance**, **polymorphism**, dan **encapsulation** pada studi kasus sederhana.
5. Menjalankan aplikasi PHP dengan struktur direktori yang terorganisasi.

---

## **1. Struktur Folder Proyek**

Buat folder baru untuk proyek lanjutan ini.

```dir
oop-lanjutan-{{KELAS}}/
├─ public/
│  └─ index.php
├─ src/
│  ├─ Student.php
│  ├─ Dosen.php
│  ├─ Kelas.php
│  └─ Autoload.php
└─ README.md
```

Keterangan:

* Folder `public/` berisi file utama (dijalankan di browser).
* Folder `src/` berisi semua class program.
* File `Autoload.php` digunakan agar class dimuat otomatis.

---

## **2. Menjalankan Server PHP Built-in**

Jalankan di terminal:

```bash
cd oop-lanjutan-{{KELAS}}
php -S localhost:8000 -t public
```

Akses di browser:
`http://localhost:8000`

---

## **3. Autoloader Manual**

Buat file `src/Autoload.php`:

```php
<?php
spl_autoload_register(function ($className) {
    $path = __DIR__ . '/' . $className . '.php';
    if (file_exists($path)) {
        require_once $path;
    }
});
```

Dengan ini, semua class di folder `src/` bisa dipanggil otomatis tanpa `require`.

---

## **4. Class Student**

Buat file `src/Student.php`:

```php
<?php
class Student {
    private $nim;
    private $nama;
    private $jurusan;

    public function __construct($nim, $nama, $jurusan) {
        $this->nim = $nim;
        $this->nama = $nama;
        $this->jurusan = $jurusan;
    }

    public function getInfo() {
        return "{$this->nama} ({$this->nim}) - {$this->jurusan}";
    }

    public function getNim() {
        return $this->nim;
    }
}
```

---

## **5. Class Dosen (Inheritance)**

Buat file `src/Dosen.php`:

```php
<?php
class Dosen {
    protected $nama;
    protected $mataKuliah;

    public function __construct($nama, $mataKuliah) {
        $this->nama = $nama;
        $this->mataKuliah = $mataKuliah;
    }

    public function getInfo() {
        return "Dosen {$this->nama} mengajar {$this->mataKuliah}";
    }
}
```

---

## **6. Class Kelas (Menggunakan Objek Student dan Dosen)**

Buat file `src/Kelas.php`:

```php
<?php
require_once __DIR__ . '/Student.php';
require_once __DIR__ . '/Dosen.php';

class Kelas {
    private $kode;
    private $dosen;
    private $daftarMahasiswa = [];

    public function __construct($kode, Dosen $dosen) {
        $this->kode = $kode;
        $this->dosen = $dosen;
    }

    public function tambahMahasiswa(Student $mhs) {
        $this->daftarMahasiswa[] = $mhs;
    }

    public function tampilkanInfo() {
        echo "<h3>Kelas {$this->kode}</h3>";
        echo $this->dosen->getInfo() . "<br><br>";
        echo "<strong>Daftar Mahasiswa:</strong><br>";
        foreach ($this->daftarMahasiswa as $m) {
            echo "- " . $m->getInfo() . "<br>";
        }
    }
}
```

---

## **7. File Utama – `public/index.php`**

```php
<?php
require_once __DIR__ . '/../src/Autoload.php';

$dosen = new Dosen("I Made", "Pemrograman Backend");
$kelas = new Kelas("BA243", $dosen);

$mhs1 = new Student("BA243001", "Ayu", "Teknologi Informasi");
$mhs2 = new Student("BA243002", "Budi", "Teknologi Informasi");
$mhs3 = new Student("BA243003", "Citra", "Teknologi Informasi");

$kelas->tambahMahasiswa($mhs1);
$kelas->tambahMahasiswa($mhs2);
$kelas->tambahMahasiswa($mhs3);

$kelas->tampilkanInfo();
```

**Output di browser:**

```cli
Kelas BA243
Dosen I Made mengajar Pemrograman Backend

Daftar Mahasiswa:
- Ayu (BA243001) - Teknologi Informasi
- Budi (BA243002) - Teknologi Informasi
- Citra (BA243003) - Teknologi Informasi
```

---

## **8. Latihan Praktikum**

1. Tambahkan method `hapusMahasiswa($nim)` di class `Kelas` untuk menghapus mahasiswa berdasarkan NIM.
2. Tambahkan class `MahasiswaAktif` yang **mewarisi** `Student`, dan tambahkan method `setStatus($status)` serta `getStatus()`.
3. Modifikasi `tampilkanInfo()` agar menampilkan status mahasiswa aktif/non-aktif.
4. Tambahkan class `ProgramStudi` yang memiliki beberapa objek `Kelas`.

   * Method: `tambahKelas(Kelas $kelas)` dan `tampilkanSemuaKelas()`.

---

## **9. Catatan Teknis Tambahan**

* Gunakan `declare(strict_types=1);` di setiap file untuk tipe data ketat.
* Setiap class disimpan dalam file terpisah dengan nama yang sama.
* Setiap file class diatur dalam struktur folder yang rapi.
* Untuk proyek yang lebih besar, autoload dapat diganti dengan standar **PSR-4** menggunakan Composer.
* Gunakan namespace (`namespace App\...;`) bila modul sudah lebih kompleks.
