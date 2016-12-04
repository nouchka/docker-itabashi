<html>
<head>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.0/jquery.min.js"></script>
<meta charset=utf-8 />
<title>Itabashi</title>
</head>
<body>
<table>
<?php
$path = "input/";
$blacklist = array();
$files = scandir($path);
foreach ($files as $entry) {
	if ($entry == "." || $entry == ".." || $entry == ".svn" || $entry == "notes.txt") continue;
	$file =  $path.$entry;
?>
<tr>
	<td><img src="<?php echo $file;?>" name="<?php echo str_replace('.jpg','',basename($file));?>" class="box"/></td>
	<td><p class="position"></p><input type="button" name="end" value="finish" class="end"/></td>
</tr>
<tr><td colspan="2"><hr/></td></tr>
<?php
}
?>
</table>

<script>
$(document).ready(function() {
  var myCars=new Array();
  var i = 0;
  var j = 1;
  $('.box').click(function(e) {
	   var parentOffset = $(this).parent().offset(); 
	   var relX = e.pageX - parentOffset.left;
	   var relY = e.pageY - parentOffset.top;
	    myCars[i]=relX;
	    i++;
	    myCars[i]=relY;
	    i++;
	    console.log(myCars);
	    if(i==4){
	    	$.get('generate.php?j='+j+'&name='+$(this).attr('name')+'&x1='+myCars[0]+'&y1='+myCars[1]+'&x2='+myCars[2]+'&y2='+myCars[3], function(data) {
	    		$('.position:first').html(data);
	    		});
	        myCars=new Array();
	        i=0;
	        j++;
	    }
	  });
  $('.box2').click(function(e) {
	    var offset = $(this).offset();
	    $('.position:first').text((e.clientX - offset.left) + ", " + (e.clientY - offset.top));
	    myCars[i]=e.clientX - offset.left;
	    i++;
	    myCars[i]=e.clientY - offset.top;
	    i++;
	    console.log(myCars);
	    if(i==6){
	    	$.get('gen.php?j='+j+'&name='+$(this).attr('name')+'&x1='+myCars[0]+'&y1='+myCars[1]+'&x2='+myCars[2]+'&y2='+myCars[3]+'&x3='+myCars[4]+'&y3='+myCars[5], function(data) {
	    		$('.position:first').html(data);
	    		});
	        myCars=new Array();
	        i=0;
	        j++;
	    }
	  });
  $('.end').click(function(e) {
	  $('tr:first').remove();
	  j=1;
  });
});
</script>
</body>
</html>