# **Modul Praktikum: Pemrograman Berorientasi Objek (OOP) dengan PHP**

_**Nama Kelas:** sesuaikan dengan kelas masing-masing: `ba243`, `bb243`, atau `bc243`_

---

## **0. Pendahuluan**

Mahasiswa telah mempelajari pemrograman terstruktur menggunakan PHP: variabel, fungsi, percabangan, dan perulangan.
Pada modul ini, konsep berpikir berpindah dari **“kode yang menjalankan instruksi”** menjadi **“objek yang berinteraksi”**.
Pendekatan ini disebut **Object-Oriented Programming (OOP)** — paradigma yang digunakan hampir di semua bahasa modern seperti Java, Python, dan C#.

---

## **1. Apa itu Object-Oriented Programming (OOP)?**

**OOP** adalah cara menulis program dengan memodelkan dunia nyata sebagai **objek** yang memiliki **atribut (data)** dan **perilaku (aksi)**.

Contoh di dunia nyata:

* **Objek:** Mahasiswa
* **Atribut:** NIM, Nama, Jurusan
* **Perilaku:** mendaftar(), belajar(), mengerjakanTugas()

Dalam PHP, objek tersebut direpresentasikan melalui **class** dan **object**.

---

## **2. Konsep Dasar: Class dan Object**

### **2.1 Class**

`Class` adalah cetak biru atau blueprint dari sebuah objek.
Berisi definisi **property (data)** dan **method (fungsi/aksi)**.

### **2.2 Object**

`Object` adalah hasil nyata dari sebuah `class`.
Satu class dapat menghasilkan banyak object.

### **Contoh 1: Membuat Class dan Object**

Buat file `student.php`:

```php
<?php
// Deklarasi class
class Student {
    // Property (atribut)
    public $name;
    public $nim;

    // Method (perilaku)
    public function sayHello() {
        echo "Halo, nama saya $this->name dengan NIM $this->nim";
    }
}

// Membuat object
$mahasiswa1 = new Student();
$mahasiswa1->name = "Ayu";
$mahasiswa1->nim = "BA243001";

// Memanggil method
$mahasiswa1->sayHello();
```

**Output:**

```cli
Halo, nama saya Ayu dengan NIM BA243001
```

**Latihan 1:**
Buat class `Dosen` dengan property `nama` dan `mataKuliah`, serta method `perkenalan()` yang menampilkan teks seperti

> "Saya Pak Made, dosen mata kuliah Pengembangan Sistem Backend."

---

## **3. Property dan Method**

### **Property**

Adalah **variabel milik class**.

Contoh:

```php
public $name;
```

### **Method**

Adalah **fungsi milik class**, yang menjelaskan perilaku dari objek.

Contoh:

```php
public function sayHello() {
    echo "Halo, nama saya " . $this->name;
}
```

### **$this**

Kata kunci `$this` digunakan untuk mengakses property atau method di dalam objek itu sendiri.

---

## **4. Visibility (Aksesibilitas Property dan Method)**

Visibility mengatur **siapa yang boleh mengakses property/method**:

| Modifier    | Akses dari dalam class | Akses dari luar class | Akses oleh class turunan |
| ----------- | ---------------------- | --------------------- | ------------------------ |
| `public`    | Ya                     | Ya                    | Ya                       |
| `protected` | Ya                     | Tidak                 | Ya                       |
| `private`   | Ya                     | Tidak                 | Tidak                    |

### **Contoh 2: Visibility**

```php
class Student {
    public $name;          // bisa diakses dari mana saja
    private $age;          // hanya diakses dari dalam class

    public function setAge($age) {
        if ($age > 0) $this->age = $age;
    }

    public function getAge() {
        return $this->age;
    }
}

$s = new Student();
$s->name = "Ayu";          // boleh
$s->setAge(20);            // boleh
echo $s->getAge();         // boleh
// echo $s->age;           // error, karena private
```

**Latihan 2:**
Tambahkan property `alamat` dengan visibility `protected`.
Buat method `setAlamat()` dan `getAlamat()` untuk mengatur nilainya.

---

## **5. Constructor dan Destructor**

### **Constructor**

Method khusus yang **otomatis dijalankan saat object dibuat**.

### **Destructor**

Method khusus yang **otomatis dijalankan saat object dihancurkan** (biasanya di akhir eksekusi script).

### **Contoh 3: Constructor & Destructor**

```php
class Student {
    public $name;

    public function __construct($name) {
        $this->name = $name;
        echo "Objek Student untuk $name dibuat.<br>";
    }

    public function __destruct() {
        echo "Objek Student untuk {$this->name} dihapus.<br>";
    }
}

$s1 = new Student("Ayu");
```

**Output:**

```cli
Objek Student untuk Ayu dibuat.
Objek Student untuk Ayu dihapus.
```

**Latihan 3:**
Tambahkan parameter `$nim` pada constructor, dan tampilkan pesan

> “Mahasiswa Ayu dengan NIM BA243001 telah dibuat.”

---

## **6. Static Property dan Static Method**

Static property/method **milik class**, bukan milik object.
Dapat diakses tanpa membuat object menggunakan `NamaClass::property`.

### **Contoh 4: Static Member**

```php
class Counter {
    public static $count = 0;

    public function __construct() {
        self::$count++;
    }

    public static function getCount() {
        return self::$count;
    }
}

$a = new Counter();
$b = new Counter();
echo Counter::getCount(); // Output: 2
```

**Latihan 4:**
Buat class `Kalkulator` dengan method statik `tambah($a, $b)` dan `kali($a, $b)`.

---

## **7. Inheritance (Pewarisan)**

Class baru dapat **mewarisi property dan method** dari class lain menggunakan `extends`.

### **Contoh 5: Inheritance**

```php
class Person {
    public $name;
    public function greet() {
        echo "Halo, saya $this->name";
    }
}

class Student extends Person {
    public $nim;
}

$s = new Student();
$s->name = "Ayu";
$s->nim = "BA243001";
$s->greet();
```

**Output:**

```cli
Halo, saya Ayu
```

**Latihan 5:**
Buat class `Dosen` yang mewarisi `Person`, dan tambahkan property `mataKuliah` serta method `ajar()`.

---

## **8. Enkapsulasi**

Enkapsulasi berarti **menyembunyikan data internal** agar hanya bisa diakses melalui method tertentu.
Tujuannya melindungi data dari perubahan langsung.

### **Contoh 6: Enkapsulasi**

```php
class BankAccount {
    private $saldo = 0;

    public function deposit($jumlah) {
        if ($jumlah > 0) $this->saldo += $jumlah;
    }

    public function getSaldo() {
        return $this->saldo;
    }
}

$akun = new BankAccount();
$akun->deposit(100000);
echo $akun->getSaldo(); // 100000
```

**Latihan 6:**
Buat class `KartuPerpustakaan` dengan property `bukuDipinjam` (array).
Tambahkan method `pinjamBuku($judul)` dan `lihatDaftarPinjaman()`.

---

## **9. Autoloading (Pengenalan)**

Ketika proyek mulai besar, file PHP bisa banyak.
Agar tidak `require` satu per satu, PHP menyediakan **autoload** untuk memuat class otomatis.

**Contoh sederhana:**

```php
spl_autoload_register(function($className) {
    require_once $className . '.php';
});
```

Dengan ini, saat `new Student()`, PHP otomatis mencari file `Student.php`.

**Latihan 7:**
Pisahkan class `Student` dan `Dosen` ke file terpisah (`Student.php`, `Dosen.php`) dan gunakan autoload untuk memuatnya otomatis.

---

## **10. Studi Kasus Akhir: Mini Sistem Mahasiswa**

Gabungkan semua konsep yang telah dipelajari:

**Struktur folder:**

```dir
oop-{{KELAS}}/
├─ Student.php
├─ Dosen.php
└─ index.php
```

**`Student.php`**

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
}
```

**`Dosen.php`**

```php
<?php
class Dosen {
    public $nama;
    public $mataKuliah;

    public function __construct($nama, $mataKuliah) {
        $this->nama = $nama;
        $this->mataKuliah = $mataKuliah;
    }

    public function getInfo() {
        return "Dosen {$this->nama} mengajar {$this->mataKuliah}";
    }
}
```

**`index.php`**

```php
<?php
spl_autoload_register(function($class){
    require_once $class . '.php';
});

$mhs = new Student("BA243001", "Ayu", "Teknologi Informasi");
$dsn = new Dosen("I Made", "Pengembangan Sistem Backend");

echo $mhs->getInfo() . "<br>";
echo $dsn->getInfo();
```

**Output:**

```cli
Ayu (BA243001) - Teknologi Informasi
Dosen I Made mengajar Pengembangan Sistem Backend
```

**Latihan Akhir:**
Tambahkan class `Kelas` dengan property `kode` dan `daftarMahasiswa` (array).
Buat method `tambahMahasiswa(Student $mhs)` dan `tampilkanMahasiswa()`.
