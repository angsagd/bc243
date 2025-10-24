# **Modul Praktikum PHP OOP (Tingkat Lanjut)**

_**Nama Kelas:** sesuaikan dengan kelas masing-masing: `ba243`, `bb243`, atau `bc243`_

---

## **0. Tujuan Pembelajaran**

Setelah mengikuti modul ini, mahasiswa mampu:

1. Menggunakan **exception handling** untuk menangani kesalahan secara terstruktur.
2. Menerapkan **interface** dan **abstract class** untuk membuat kontrak antar class.
3. Menggunakan **trait** untuk berbagi perilaku antar class tanpa pewarisan.
4. Mengorganisir class menggunakan **namespace** agar struktur proyek lebih rapi.
5. Mempersiapkan proyek OOP untuk integrasi database pada modul selanjutnya.

---

## **1. Struktur Folder Proyek**

Buat folder baru untuk modul ini:

```dir
oop-tingkat-lanjut-{{KELAS}}/
├─ public/
│  └─ index.php
├─ src/
│  ├─ Domain/
│  │  ├─ Student.php
│  │  ├─ Dosen.php
│  │  ├─ Contracts/
│  │  │  └─ RepositoryInterface.php
│  │  ├─ Exceptions/
│  │  │  └─ ValidationException.php
│  │  └─ Traits/
│  │     └─ LoggerTrait.php
│  ├─ Repository/
│  │  └─ StudentMemoryRepository.php
│  └─ Support/
│     └─ Autoload.php
└─ README.md
```

---

## **2. Autoloader**

Gunakan autoloader sederhana di `src/Support/Autoload.php`:

```php
<?php
spl_autoload_register(function ($class) {
    $baseDir = __DIR__ . '/../';
    $file = $baseDir . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) require $file;
});
```

---

## **3. Namespace**

Gunakan `namespace` untuk menghindari bentrok nama class antar folder.

Contoh:

```php
<?php
namespace App\Domain;

class Student {
    // ...
}
```

Untuk memanggil class ini dari luar, gunakan `use`:

```php
use App\Domain\Student;
```

---

## **4. Exception Handling**

Exception digunakan untuk menangani kesalahan dengan cara elegan tanpa menghentikan program secara mendadak.

### **Contoh 1: Membuat Exception Sendiri**

Buat `src/Domain/Exceptions/ValidationException.php`:

```php
<?php
namespace App\Domain\Exceptions;

class ValidationException extends \Exception {}
```

### **Contoh 2: Menggunakan Exception**

```php
<?php
namespace App\Domain;

use App\Domain\Exceptions\ValidationException;

class Student {
    private string $nim;
    private string $nama;

    public function __construct(string $nim, string $nama) {
        if (strlen($nim) < 5) {
            throw new ValidationException("NIM terlalu pendek!");
        }
        $this->nim = $nim;
        $this->nama = $nama;
    }

    public function info(): string {
        return "{$this->nama} ({$this->nim})";
    }
}
```

**Latihan 1:**
Tambahkan validasi agar nama tidak boleh kosong, dan tampilkan pesan error di browser menggunakan `try...catch`.

---

## **5. Interface**

Interface mendefinisikan **kontrak** yang wajib diikuti oleh class lain.

### **Contoh 3: Interface Repository**

Buat `src/Domain/Contracts/RepositoryInterface.php`:

```php
<?php
namespace App\Domain\Contracts;

interface RepositoryInterface {
    public function save($entity): void;
    public function findById(string $id);
    public function all(): array;
}
```

Class yang mengimplementasikan interface wajib menulis semua method yang didefinisikan.

---

## **6. Implementasi Interface**

Buat repository penyimpanan sederhana di memori:
`src/Repository/StudentMemoryRepository.php`:

```php
<?php
namespace App\Repository;

use App\Domain\Contracts\RepositoryInterface;
use App\Domain\Student;

class StudentMemoryRepository implements RepositoryInterface {
    private array $data = [];

    public function save($entity): void {
        if (!$entity instanceof Student) {
            throw new \InvalidArgumentException("Objek bukan Student");
        }
        $this->data[$entity->getNim()] = $entity;
    }

    public function findById(string $id) {
        return $this->data[$id] ?? null;
    }

    public function all(): array {
        return array_values($this->data);
    }
}
```

**Latihan 2:**
Tambahkan method `delete(string $id)` dan `count()` ke dalam interface dan implementasinya.

---

## **7. Trait**

`Trait` digunakan untuk **menyisipkan perilaku bersama** ke beberapa class tanpa menggunakan inheritance.

### **Contoh 4: LoggerTrait**

`src/Domain/Traits/LoggerTrait.php`:

```php
<?php
namespace App\Domain\Traits;

trait LoggerTrait {
    protected function log(string $message): void {
        $path = __DIR__ . '/../../../var/log.txt';
        file_put_contents($path, "[" . date('c') . "] $message\n", FILE_APPEND);
    }
}
```

Gunakan trait ini di class `Student`:

```php
use App\Domain\Traits\LoggerTrait;

class Student {
    use LoggerTrait;
    // ...
    public function save(): void {
        $this->log("Data mahasiswa {$this->nama} disimpan.");
    }
}
```

**Latihan 3:**
Gunakan trait `LoggerTrait` juga di `StudentMemoryRepository` untuk mencatat setiap kali `save()` dipanggil.

---

## **8. Abstract Class**

Abstract class berfungsi sebagai **template** bagi class turunan.
Tidak dapat dibuat objek langsung, tetapi mewariskan struktur dan perilaku.

### **Contoh 5: Abstract Repository**

```php
<?php
namespace App\Repository;

use App\Domain\Contracts\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface {
    protected array $data = [];

    public function all(): array {
        return array_values($this->data);
    }

    abstract public function save($entity): void;
    abstract public function findById(string $id);
}
```

`StudentMemoryRepository` bisa **mewarisi** abstract class ini agar tidak menulis ulang method `all()`.

**Latihan 4:**
Ubah `StudentMemoryRepository` agar mewarisi `AbstractRepository`.

---

## **9. File Utama – `public/index.php`**

```php
<?php
require_once __DIR__ . '/../src/Support/Autoload.php';

use App\Domain\Student;
use App\Repository\StudentMemoryRepository;
use App\Domain\Exceptions\ValidationException;

$repo = new StudentMemoryRepository();

try {
    $m1 = new Student("BA24301", "Ayu");
    $m2 = new Student("BA24302", "Budi");

    $repo->save($m1);
    $repo->save($m2);

    echo "<h3>Daftar Mahasiswa:</h3>";
    foreach ($repo->all() as $s) {
        echo $s->info() . "<br>";
    }

} catch (ValidationException $e) {
    echo "<b>Error:</b> " . $e->getMessage();
} catch (Throwable $e) {
    echo "<b>Kesalahan Umum:</b> " . $e->getMessage();
}
```

**Output:**

```cli
Daftar Mahasiswa:
Ayu (BA24301)
Budi (BA24302)
```

---

## **10. Latihan Mandiri**

1. Tambahkan class `Dosen` yang menggunakan `LoggerTrait` dan simpan ke repository yang sama.
2. Buat class `FileRepository` (turunan `AbstractRepository`) yang menyimpan data ke file JSON.
3. Tambahkan exception `FileNotWritableException` dan tangani di `try...catch`.
4. Ubah autoloader agar mendukung subfolder (`Domain/`, `Repository/`, `Support/`).
5. Buat halaman HTML sederhana di `public/index.php` untuk menambah mahasiswa melalui form.

---

## **11. Catatan Teknis**

* Namespace digunakan dengan pola `App\<Folder>\<NamaClass>`.
* Gunakan `declare(strict_types=1);` di setiap file.
* Exception membantu debugging tanpa mematikan aplikasi.
* Interface digunakan untuk **kontrak**, trait untuk **perilaku bersama**, dan abstract class untuk **kerangka dasar**.
* Struktur folder penting untuk maintainability.
