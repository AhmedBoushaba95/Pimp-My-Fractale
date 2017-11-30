<?php
$x1 = -2.1;
$x2 = 0.6;
$y1 = -1.2;
$y2 = 1.2;
$zoom = 100;
if(empty($_POST['nbr_iterations']))
{
$iterations_max =2;
}else
{
$iterations_max = $_POST['nbr_iterations'];
}
if(empty($_POST['nbr_degres']))
{
$n=50;
}else
{
$n=$_POST['nbr_degres'];
}

$image_x = ($x2 - $x1)*$zoom;
$image_y = ($y2 - $y1)*$zoom;
//couleur
$black_color=imagecolorallocate($im, 0, 0, 0);

if(!empty($_POST['bleu']))
{
 $color = imagecolorallocate($image, 53, 122, 183);
}
else if(!empty($_POST['vert']))
{
  $color = imagecolorallocate($image, 31, 160, 85);
}
else if(!empty($_POST['rouge']))
{
     $color = imagecolorallocate($image, 233, 56, 63);
}
else
{
$color=imagecolorallocate($image, 255, 255, 255);
}

$image = imagecreatetruecolor($image_x, $image_y);
$white = imagecolorallocate($image, 255, 255, 255);
$noir  = imagecolorallocate($image, 0, 0, 0);
imagefill($image, 0 ,0 , $white);

$debut = microtime(true);
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
while($z_r*$z_r + $z_i*$z_i < 4 AND $i < $iterations_max);
        if($i == $iterations_max)
	            imagesetpixel($image, $x, $y, $noir);
		        }
			}

$temps = round(microtime(true) - $debut, 3);

imagestring($image, 3, 1, 1, $temps, $noir);

header('Content-type: image/png');
imagepng($image);