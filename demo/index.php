<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HACK BY Yaseng</title>

<style>
body {
	color: #0F0;
	background: #000
}

.STYLE1 {
	font-size: 24px;
	font-weight: bold;
	color: #F00;
	text-align: center;
	line-height: 40px;
}

#say form {
	font-size: 16px;
	font-weight: bold;
	color: #F00;
	margin: 20px;
	padding: 0px;
}
</style>
</head>
<body>
<div align="center">
<center>
<p align="center"><br> <br> <br> <font face="Verdana" size="6"><b>HACK
BY Yaseng</b></font> <br />

</center>
</div>
<script language="Javascript"> 
<!-- 
var x = 0 
var speed = 90 
var text = "Just  Fuck  You  Mother" 
var course =76 
var text2 = text 

function Scroll() { 
window.status = text2.substring(0, text2.length) 
if (course < text2.length) { 
setTimeout("Scroll2()", speed) 
} 
else { 
text2 = " " + text2 
setTimeout("Scroll()", speed); 
} 
} 
function Scroll2() { 
window.status = text2.substring(x, text2.length) 
if (text2.length - x == text.length) {  
text2 = text 
x = 0 
setTimeout("Scroll()", speed); 
} 
else { 
x++ 
setTimeout("Scroll2()", speed); 
} 
} 
Scroll() 
//--> 
</script>
</body>
</body>
</html>
<?php
date_default_timezone_set('PRC');
error_reporting(0);

if($_GET['a']=='add'){
	$say = $_POST['textarea'];
	$name = $_POST['name'];
   file_put_contents("data.txt", $name."|".time()."|".$say."\r\n",FILE_APPEND);
 
}

$data=file("data.txt");

 
 
foreach ($data as $item) {

	 
	$book=explode("|",$item);
	$time=date("Y-m-d H:i:s",$book[1]);
	 
	echo  '<div style="margin:2px;background-color:#353E3A;padding:2px;"><p style="color:#EEE;border-bottom:#999 dotted 1px">'.' @ '.$time.' </p><p><pre style="'.$style.'"><strong>'.$book[0].'</strong>  :<br />'.$book[2].'</pre></p></div>';
	 
	 
	 
}

?>
<center>What would you like to say 请留言之！！！
<div id="say">
<form action="index.php?a=add" method="post">Name: <input type="text"
	name="name" /> <br />
<textarea id="aokosay" class="aokosay" rows="5" id="what"
	style="font-family: Times New Roman; font-size: 14pt;" cols="80"
	name="textarea"
	style="font-size: 14px; font-family: Arial; color:#FF0; background-color: rgb(53, 62, 58); border: 1px dotted rgb(204, 204, 204);">
      </textarea> <br />
<input type="submit" name="提交" value="提交"
	style="width: 120px; height: 64px;"></form>
</div>
</center>
