<?php
$x1 = -2.1;
$x2 = 0.6;
$y1 = -1.2;
$y2 = 1.2;
$zoom = 100;
if(empty($_POST['nbr_iterations']))
{
$k =2;
}else
{
$k = $_POST['nbr_iterations'];
}
if(empty($_POST['nbr_degres']))
{
$n=50;
}else
{
$n=$_POST['nbr_degres'];
}

$image_x = ($x2 - $x1)*$zoom*1.5;
$image_y = ($y2 - $y1)*$zoom;

$image = imagecreatetruecolor($image_x, $image_y);
$white =imagecolorallocate($image, 255, 255, 255);
$noir  = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0 ,0 , $white);

for($x = 0; $x < $image_x; $x++){
    for($y = 0; $y < $image_y; $y++){
            $c_r = $x/$zoom+$x1;
            $c_i = $y/$zoom+$y1;
            $z_r = 0;
            $z_i = 0;
            $i   = 0;
        do{
  $mod = sqrt(($z_r * $z_r) + ($z_i * $z_i));
  $arg = atan2($z_i, $z_r);
  $z_r = pow($mod, $n) * cos($n * $arg) + $c_r;
  $z_i = pow($mod, $n) * sin($n * $arg) + $c_i;
  $i++;
        }
while(sqrt($z_r*$z_r + $z_i*$z_i) < 2 AND $i < $k);//r
{
if($i == $k)
	{
	  imagesetpixel($image, $x, $y, $color);
	 }
	  else
	     {
	     //degrader 
	       $degrade=255*$i/$k;
	       $new_color = imagecolorallocate($image, 0, 0, $degrade);
	       imagesetpixel($image, $x, $y, $new_color);
	       }
	   }
	}
 }
header('Content-type: image/png');
imagepng($image);