<?php
$x1 = $_GET['x1'];
$x2 = $_GET['x2'];
$x3 = $_GET['x3'];
$y1 = $_GET['y1'];
$y2 = $_GET['y2'];
$y3 = $_GET['y3'];
$name=$_GET['name'];
$j=$_GET['j'];
$offsetX4 = $x2-$x1;
$offsetY4 = $y2-$y1;
$x4 = $x3+$offsetX4;
$y4 = $y3+$offsetY4;
//echo $x4.",".$y4;
$xc = $x1+($x4-$x1)/2;
$yc = $y3+($y2-$y3)/2;
//echo "#".$xc.",".$yc."#";
$minx=min($x1,$x2,$x3,$x4)-3;
$miny=min($y1,$y2,$y3,$y4)-3;
$maxx=max($x1,$x2,$x3,$x4)-$minx+3;
$maxy=max($y1,$y2,$y3,$y4)-$miny+3;
$output="";
$output = shell_exec("convert 'input/".$name.".jpg' -crop ".$maxx."x".$maxy."+".$minx."+".$miny." fileCrop-".$name.".jpg");
list($ggtx, $ggty, $type, $attr) = getimagesize("fileCrop-".$name.".jpg");
echo $x1." ".$minx." ".$ggtx." ";
echo $y1." ".$miny." ".$ggty." ";
$x=$x1-$minx-($ggtx/2);
$y=$y1-$miny-($ggty/2);
if($x > 0 && $y >= 0){
	$ggt=atan($y/$x);
}else if($x > 0 && $y < 0){
	$ggt=atan($y/$x)+2*pi();
}else if($x < 0){
	$ggt=atan($y/$x)+pi();
}
echo $x."x".$y." >>>> ".$ggt." >> ";

$op=sqrt(($x3-$x1)*($x3-$x1)+($y3-$y1)*($y3-$y1))/2;
$hy=sqrt(($xc-$x1)*($xc-$x1)+($yc-$y1)*($yc-$y1));
echo $angle=(asin($op/$hy))*57.29-90;//////////////////////////
$output = shell_exec("convert 'fileCrop-".$name.".jpg' -rotate ".$angle." fileRotate-".$name.".jpg");
////////shell_exec("rm fileCrop-".$name.".jpg");
list($maxx, $maxy, $type, $attr) = getimagesize("fileRotate-".$name.".jpg");
$width=ceil(sqrt(($x2-$x1)*($x2-$x1)+($y2-$y1)*($y2-$y1)));
$height=ceil(sqrt(($x3-$x1)*($x3-$x1)+($y3-$y1)*($y3-$y1)));
$x=($maxx-$width)/2;
$y=($maxy-$height)/2;
$output = shell_exec("convert 'fileRotate-".$name.".jpg' -crop ".$width."x".$height."+".round($x)."+".round($y)." output/".$name."-".$j.".jpg");
////////shell_exec("rm fileRotate-".$name.".jpg");
echo "<img src='output/".$name."-".$j.".jpg' style='max-width:250px;'/>";
?>