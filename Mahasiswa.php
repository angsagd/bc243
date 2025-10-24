<?php
class Mahasiswa extends User {
  // atribut
  public $nama;
  public $nim;

  // constructor
  public function __construct()
  {
    echo "Object dibuat\n";
  }

  // destructor
  public function __destruct()
  {
    echo "\nObject dihancurkan\n";
  }

  // method
  public function sayHello() {
    echo "Halo, saya $this->nama, dengan NIM $this->nim\n";
  }




}