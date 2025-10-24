<?php
spl_autoload_register(function ($class){
  require_once $class . '.php';
});

// create object
$mhs = new Mahasiswa; // obj dibuat, constructor dijalankan

// berikan nilai atribut/property
$mhs->nama = "Askara";
$mhs->nim = "210030012";

// jalankan method
$mhs->sayHello();
