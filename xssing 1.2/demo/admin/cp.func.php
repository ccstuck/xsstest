<?php


/*
* 后台系统提示函数
*/ 
function cpmsg($message,$type="success",$url="-1",$time=666,$title="系统信息"){
 
 $time = PP_DEBUG ? 22222 : $time;  //当为调试模式时 延长跳转时间
 
$color= ($type == 'success') ? "green" : "red";
$message="<font color=$color > $message </font>";
if($url == "-1"){
	
	$jsaction= "history.go(-1);";
	$url="javascript:history.go(-1);"; 
	}
	else{
		
		
		$jsaction="window.location.href ='$url';" ;
		
	}



print<<<END
<table height="144" cellspacing="0" cellpadding="0" border="0" width="30%" class="line_table" align="center">
  <tbody>
    <tr>
      <td height="27" background="../static/images/news-title-bg.gif" width="7%"><img height="27" width="2" src="../static/images/news-title-bg.gif"></td>
      <td background="../static/images/news-title-bg.gif" width="93%" class="left_bt2">$title</td>
    </tr>
    <tr height="25">
    </tr>
    <tr>
      <td height="77" valign="top">&nbsp;</td>
      <td height="77" valign="top" align="center" valign="middle">
<a href="$url"> <strong> $message </strong>  (跳转中...)</a><script> setTimeout("$jsaction",$time); </script>
       </td>
    </tr>
    <tr>
      <td height="5" colspan="2">&nbsp;</td>
    </tr>
  </tbody>
</table>

END;
 
 
	
	
}











?>