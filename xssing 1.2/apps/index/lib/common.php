<?php
/*
 * 项目共同文件   配置   函数 
 * 
 */
 
 



 
 /*
* 后台系统提示函数
*/ 
function cpmsg($message,$type="success",$url="-1",$time=666,$title="系统信息"){
 
	
$color= ($type == 'success') ? "green" : "red";
$message="<font color=$color > $message </font>";
if($url == "-1"){
	
	$jsaction= "history.go(-1);";
	$url="javascript:history.go(-1);"; 
	}
	else{
		
		
		$jsaction="window.location.href ='$url';" ;
		
	}

    $style=PUBLIC_STYLE_URL."oa.css";
print<<<END
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="{$style}" />
<table cellspacing="2" cellpadding="3" border="0"  align="center" class="admintable1" style="margin-top:20px;width:33%;">
 <tbody>  <tr> <td align="left" class="admintitle">{$title}</td>
 </tr> <tr> <td height="80" bgcolor="#FFFFFF" style="height:75px;line-height:22px;" align="center" valign="middle">
  <a href="$url"> <strong> $message </strong>  (跳转中...)</a><script> setTimeout("$jsaction",$time); </script>
  </td> </tr></tbody></table>
END;
 
 
	
	
}


