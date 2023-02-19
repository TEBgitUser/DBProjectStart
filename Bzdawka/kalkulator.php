<?php
$css = file_get_contents('styl.css');
echo "<style>".$css."</style>";
$sata=786432;
$predkosc=0;
$czas_przesylu=0;
$pojemnosc = $_GET['pojemnosc'];
$pattern = "^\s*[0-9]+(\.[0-9]+)?\s*(KiB|MiB|GiB)\s*$^";
$suwak_wartosc=$_GET['speed_range'];
if (preg_match($pattern, $pojemnosc) == 1){
    $pojemnosc=str_replace(' ','',$pojemnosc);
    $pojemnosc_wartosc=substr($pojemnosc,0, -3);
    settype($pojemnosc_wartosc, "float");
    if(substr($pojemnosc, -3)=='KiB'){
        $jednostka="KiB";
        $pojemnosc_wartosc=$pojemnosc_wartosc*1.024;
    }
    else if(substr($pojemnosc, -3)=='MiB'){
        $jednostka='MiB';
        $pojemnosc_wartosc=$pojemnosc_wartosc*1048.576;
    }
    else{
        $jednostka='GiB';
        $pojemnosc_wartosc=$pojemnosc_wartosc*1073741.82;
    }
    if (isset($_GET['option'])){
        $medium = $_GET['option'];
        if ($medium=='LAN'){
            if(isset($_GET['select1'])){
                $typ_ethernetu=$_GET['select1'];
                if($typ_ethernetu=="Ethernet"){
                    $czas_przesylu=$pojemnosc_wartosc/1250;
                    $czas_przesylu=round($czas_przesylu);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white><legend>Wyniki:</legend>Rozmiar pliku: ".$pojemnosc."<br> Wybrałeś medium: ".$medium."<br> Wybrałeś prędkość: ".$typ_ethernetu."<br>
                    Czas przesyłu pliku wynosi: ".$czas_przesylu . "s.</fieldset></div>";
                }
                else if($typ_ethernetu=="FastEthernet"){
                    $czas_przesylu=$pojemnosc_wartosc/12500;
                    $czas_przesylu=round($czas_przesylu);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white><legend>Wyniki:</legend>Rozmiar pliku: ".$pojemnosc."<br> Wybrałeś medium: ".$medium."<br> Wybrałeś prędkość: ".$typ_ethernetu."<br>
                    Czas przesyłu pliku wynosi: ".$czas_przesylu . "s.</fieldset></div>";
                }
                else if($typ_ethernetu=="GigabitEthernet"){
                    $czas_przesylu=$pojemnosc_wartosc/125000;
                    $czas_przesylu=round($czas_przesylu);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white><legend>Wyniki:</legend>Rozmiar pliku: ".$pojemnosc."<br> Wybrałeś medium: ".$medium."<br> Wybrałeś prędkość: ".$typ_ethernetu."<br>
                    Czas przesyłu pliku wynosi: ".$czas_przesylu . "s.</fieldset></div>";
                }
            }
        }
        else if ($medium=='ODD'){
            if(isset($_GET['select2'])){
                $typ_plyty=$_GET['select2'];
                if($typ_plyty=="CD"){
                    $predkosc=150*$suwak_wartosc;
                    $czas_przesylu=$pojemnosc_wartosc/$predkosc;
                    $czas_przesylu=round($czas_przesylu);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white><legend>Wyniki:</legend>Rozmiar pliku: ".$pojemnosc."<br> Wybrałeś medium: ".$medium."<br> Wybrałeś płytę: ".$typ_plyty."<br>
                    Czas przesyłu pliku wynosi: ".$czas_przesylu . "s.</fieldset></div><div class='space'><br></div>";
                    $wynik=($predkosc/$sata)*100;
                    $wynik=round($wynik);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white>0%<input type='range' disabled='true' value='$wynik'>100%<br>
                    Stopień wykorzystania kanału SATA3 to: $wynik%</fieldset></div>";
                }
                else if($typ_plyty=="DVD"){
                    $predkosc=1350*$suwak_wartosc;
                    $czas_przesylu=$pojemnosc_wartosc/$predkosc;
                    $czas_przesylu=round($czas_przesylu);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white><legend>Wyniki:</legend>Rozmiar pliku: ".$pojemnosc."<br> Wybrałeś medium: ".$medium."<br> Wybrałeś płytę: ".$typ_plyty."<br>
                    Czas przesyłu pliku wynosi: ".$czas_przesylu . "s.</fieldset></div><div class='space'><br></div>";
                    $wynik=($predkosc/$sata)*100;
                    $wynik=round($wynik);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white>0%<input type='range' disabled='true' value='$wynik'>100%<br>
                    Stopień wykorzystania kanału SATA3 to: $wynik%</fieldset></div>";
                }
                else if($typ_plyty=="Blu"){
                    $predkosc=4500*$suwak_wartosc;
                    $czas_przesylu=$pojemnosc_wartosc/$predkosc;
                    $czas_przesylu=round($czas_przesylu);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white><legend>Wyniki:</legend>Rozmiar pliku: ".$pojemnosc."<br> Wybrałeś medium: ".$medium."<br> Wybrałeś płytę: Blu-ray<br>
                    Czas przesyłu pliku wynosi: ".$czas_przesylu . "s.</fieldset></div><div class='space'><br></div>";
                    $wynik=($predkosc/$sata)*100;
                    $wynik=round($wynik);
                    echo "<div id='prostokat' class='shadow'><fieldset style=color:white>0%<input type='range' disabled='true' value='$wynik'>100%<br>
                    Stopień wykorzystania kanału SATA3 to: $wynik%</fieldset></div>";
                }
            }
        }
    }
                else{
                    echo "Nie wybrałeś medium";
}
}
else{
    echo "Błędne dane";
}
?>