<?php
class NoweAuto {
    protected $model;
    protected $cena_w_euro;
    protected $kurs_euro;

    function __construct($model, $cena_w_euro, $kurs_euro) {
        $this->model = $model;
        $this->cena_w_euro = $cena_w_euro;
        $this->kurs_euro = $kurs_euro;
    }

    function obliczCene() {
        return $this->cena_w_euro * $this->kurs_euro;
    }
}

class AutoZDodatkami extends NoweAuto {
    private $alarm;
    private $radio;
    private $klimatyzacja;

    function __construct($model, $cena_w_euro, $kurs_euro, $alarm, $radio, $klimatyzacja) {
        parent::__construct($model, $cena_w_euro, $kurs_euro);
        $this->alarm = $alarm;
        $this->radio = $radio;
        $this->klimatyzacja = $klimatyzacja;
    }

    function obliczCene() {
        $cena_samochodu = parent::obliczCene();
        return $cena_samochodu + $this->alarm + $this->radio + $this->klimatyzacja;
    }
}

class Ubezpieczenie extends AutoZDodatkami {
    private $procentowa_wartosc_ubezpieczenia;
    private $liczba_lat;

    function __construct($model, $cena_w_euro, $kurs_euro, $alarm, $radio, $klimatyzacja, $procentowa_wartosc_ubezpieczenia, $liczba_lat) {
        parent::__construct($model, $cena_w_euro, $kurs_euro, $alarm, $radio, $klimatyzacja);
        $this->procentowa_wartosc_ubezpieczenia = $procentowa_wartosc_ubezpieczenia;
        $this->liczba_lat = $liczba_lat;
    }

    function obliczCene() {
        $wartosc_samochodu = parent::obliczCene();
        $wartosc_ubezpieczenia = $this->procentowa_wartosc_ubezpieczenia * ($wartosc_samochodu * ((100 - $this->liczba_lat) / 100));
        return $wartosc_ubezpieczenia;
    }
}