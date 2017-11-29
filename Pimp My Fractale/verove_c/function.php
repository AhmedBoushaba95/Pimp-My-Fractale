<?php
//if($_POST['nbr_iterations'])
//$_POST['nbr_degres'];
/*ini_set("display_errors", 1);
ini_set("track_errors", 1);
ini_set("html_errors", 1);
error_reporting(E_ALL);*/
$min_x=-2;
$max_x=1;
$min_y=-1;
$max_y=1;
$n=8;
//taille image
$dim_x=1100;
$dim_y=900;
//creation image
$im = @imagecreate($dim_x, $dim_y)
  or die("Impossible de charger la blibliothèque gd");
header("Content-Type: image/png");
//couleur
$black_color=imagecolorallocate($im, 0, 0, 0);

if($_POST['noir'])
{
	$color = imagecolorallocate($im, 0, 0, 0);
}
else if($_POST['bleu'])
{
	$color = imagecolorallocate($im, 53, 122, 183);
}
else if($_POST['vert'])
{
	$color = imagecolorallocate($im, 31, 160, 85);
}
else if($_POST['rouge'])
{
	$color = imagecolorallocate($im, 233, 56, 63);
}

for($x=0;$x<=$dim_x;$x++) {
  //mise a lechelle par rapport a limage en y
  for($y=0;$y<=$dim_y;$y++) {
  //mise a lechelle par rapport a limage en x
    //echelle
    $c1=$min_x+($max_x-$min_x)/$dim_x*$x;
    $c2=$min_y+($max_y-$min_y)/$dim_y*$y;
    //$z1 partie reelle
    //$z2 partie imaginaire
    $z_r=0;
    $z_i=0;

    for($i=0;$i<100;$i++) {
      $new1=pow(($z_r*$z_r+$z_i*$z_i),($n/2))*cos($n*atan2($z_i,$z_r))+$c1; //xtmp=(x*x+y*y)^(n/2)*cos(n*atan2(y,x)) + a
      $new2=pow(($z_r*$z_r+$z_i*$z_i),($n/2))*sin($n*atan2($z_i,$z_r))+$c2;
      /*$new1=$z_r*$z_r-$z_i*$z_i+$c1; //xtmp=(x*x+y*y)^(n/2)*cos(n*atan2(y,x)) + a
      $new2=2*$z_r*$z_i+$c2;*/
      $z_r=$new1;
      $z_i=$new2;

      if($new1*$new1+$new2*$new2>=2) {//calcul de r carré du module
        break; //on arrete la boucle
      }
    }
    if($i<20) { //ramification k
      imagesetpixel ($im, $x, $y, $color);//on pose un pixel aux coordonnées x ety
    }
    /*if($x=($dim_x/2)){
    imagesetpixel ($im, $x, 0, $color);
  }*/
  }
  /*if($y=($dim_y/2))
  {
  imagesetpixel ($im, 0, $y, $color);
}*/
}

imagepng($im);
imagedestroy($im);
/*  $new1=pow((($z1*$z1)+($z2*$z2)),(($n/2)))*cos($n*atan2($z1,$z2))+$c1; //xtmp=(x*x+y*y)^(n/2)*cos(n*atan2(y,x)) + a
  $new2=pow((($z1*$z1)+($z2*$z2)),(($n/2)))*sin($n*atan2($z1,$z2))+$c2;*/
