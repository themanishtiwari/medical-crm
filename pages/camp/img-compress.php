
<?php 

if($width<1800 && $height<1800){							  							  
	$image = imagecreatefromstring(file_get_contents($file));
	ob_start();
	imagejpeg($image,NULL,100);
	$cont = ob_get_contents();
	ob_end_clean();
	imagedestroy($image);
	$content = imagecreatefromstring($cont);
	$upload= imagewebp($content,$output);
	imagedestroy($content);
   //  echo '<h4>WEBP Image Converted Successfully</h4>';

}

elseif($width<3000 && $height<3000){
$nwidth=$width/1.8 | 0;
$nheight=$height/1.8| 0;
$newimage=imagecreatetruecolor($nwidth,$nheight);
if($type=='image/jpeg'){
$source=imagecreatefromjpeg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
	ob_end_clean();
	imagedestroy($newimage);
	$content = imagecreatefromstring($cont);
	$upload= imagewebp($content,$output);
	imagedestroy($content);
}elseif($type=='image/png'){
$source=imagecreatefrompng($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
	ob_end_clean();
	imagedestroy($newimage);
	$content = imagecreatefromstring($cont);
	$upload= imagewebp($content,$output);
	imagedestroy($content);
}elseif($type=='image/jpg'){
$source=imagecreatefromjpg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
	ob_end_clean();
	imagedestroy($newimage);
	$content = imagecreatefromstring($cont);
	$upload= imagewebp($content,$output);
	imagedestroy($content);
}

}

elseif($width<4000 && $height<4000){
$nwidth=$width/2.6 | 0;
$nheight=$height/2.6 | 0;
$newimage=imagecreatetruecolor($nwidth,$nheight);
if($type=='image/jpeg'){
$source=imagecreatefromjpeg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/png'){
$source=imagecreatefrompng($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/jpg'){
$source=imagecreatefromjpg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}

}
elseif($width<5000 && $height<5000){
$nwidth=$width/3.4 | 0;
$nheight=$height/3.4 | 0;
$newimage=imagecreatetruecolor($nwidth,$nheight);
if($type=='image/jpeg'){
$source=imagecreatefromjpeg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/png'){
$source=imagecreatefrompng($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/jpg'){
$source=imagecreatefromjpg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}

}

elseif($width<6000 && $height<6000){
$nwidth=$width/4.2 | 0;
$nheight=$height/4.2 | 0;
$newimage=imagecreatetruecolor($nwidth,$nheight);
if($type=='image/jpeg'){
$source=imagecreatefromjpeg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/png'){
$source=imagecreatefrompng($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/jpg'){
$source=imagecreatefromjpg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}

}

elseif($width<8000 && $height<8000){
$nwidth=$width/5.5 | 0;
$nheight=$height/5.5 | 0;
$newimage=imagecreatetruecolor($nwidth,$nheight);
if($type=='image/jpeg'){
$source=imagecreatefromjpeg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/png'){
$source=imagecreatefrompng($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}elseif($type=='image/jpg'){
$source=imagecreatefromjpg($file);
imagecopyresized($newimage,$source,0,0,0,0,$nwidth,$nheight,$width,$height);
$file_name=time().'.webp';
ob_start();
imagejpeg($newimage,NULL,100);
$cont = ob_get_contents();
ob_end_clean();
imagedestroy($newimage);
$content = imagecreatefromstring($cont);
$upload= imagewebp($content,$output);
imagedestroy($content);
}
}
else{
echo "<h4 style='color: red'>Selected image size (hight & width) is too large</h4>";
}

    ?>