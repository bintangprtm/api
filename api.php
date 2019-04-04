<?php


function masuk($plat, $warna,$tipe,$lot,$masuk) {
$data=array("$plat,$warna,$tipe,$lot,$masuk,\n");
$filename='data.csv';
file_put_contents($filename, $data,FILE_APPEND);
$result=$data;
return json_encode($result);
}
function keluar($plat){
	  $f = fopen('data.csv', "r");
    $result = false;
    while ($row = fgetcsv($f)) {
        if ($row[0] == $plat) {
         if($row[2]== 'SUV'){
$pertama=25000;
$perjam=5000;
         }else{
$pertama=35000;
$perjam=7000;
         }
         $now=date('Y-m-d h:i');
         $hourdiff  = date_diff( date_create($row[4]), date_create($now));
$j= $hourdiff->h;
$c=$j-1;
if($c==0){
$bayar=$pertama;
}else{
    $bayar=$pertama+($c*$perjam);
}
      
;
        
    }
 $result=  array(
    "plat_nomor" => "$row[0]",
    "tanggal_masuk" => "$row[4]",
    "tanggal_keluar" => "$now",
    "jumlah_bayar" => "$bayar");
    
}
fclose($f);
    return json_encode($result);
}
function find_warna( $warna) {
    $f = fopen('data.csv', "r");
    $result = false;
    while ($row = fgetcsv($f)) {
        if ($row[1] == $warna) {
         $a[].=$row[0];
         $result=["plat_nomor" => $a];
        }
        
    }

    fclose($f);
    return json_encode($result);
}
function find_tipe($tipe) {
    $f = fopen('data.csv', "r");
    $result = 0;
    while ($row = fgetcsv($f)) {
        if ($row[2] == $tipe) {
         $result++;
        }
        
    }

    fclose($f);
    return $result;
}


$plat=$_POST["plat_nomor"];
$warna=$_POST["warna"];
$tipe=$_POST["tipe"];
if ($plat!=null && $warna!=null && $tipe!=null) {
	$masuk=date('Y-m-d h:i');
	$lot="A1";
	$a=masuk($plat,$warna,$tipe,$lot,$masuk);
echo $a;
}elseif ($plat!=null && $warna==null && $tipe==null) {
	$a=keluar($plat);
	echo $a;
}elseif ($plat==null && $warna==null && $tipe!=null) {
	$a=find_tipe($tipe);
	echo $a;
}elseif ($plat==null && $warna!=null && $tipe==null) {
	$a=find_warna($warna);
	echo $a;
}


?>