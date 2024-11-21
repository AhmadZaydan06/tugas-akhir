<?php
class Siswa { //Modul 5 OOP I
    private $stack = [];

    public function tambahSiswa($nama) {
        array_push($this->stack, $nama); //Modul 7 Stack
    }

    public function getSemuaSiswa() {
        return $this->stack; 
    }
}
?>
