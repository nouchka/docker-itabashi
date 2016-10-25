<?php
$x1 = $_GET['x1'];
$x2 = $_GET['x2'];
$y1 = $_GET['y1'];
$y2 = $_GET['y2'];
$inc=$_GET['j'];
$name=$_GET['name'];
$output = shell_exec("convert 'input/".$name.".jpg' -crop ".($x2-$x1)."x".($y2-$y1)."+".$x1."+".$y1." +repage output/".$name."-".$inc.".jpg");
?>
<img src='output/<?php echo $name;?>-<?php echo $inc;?>.jpg' width='450'/>
