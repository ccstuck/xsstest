<?php
 require_once("admin.php");
 
 

    
  $data=file("../data.txt");
  
     $display="";
   
  foreach ($data as $item) {
  
  	
  	$book=explode("|",$item);
  	$book[1]=date("Y-m-d H:i:s",$book[1]);
  	
    $display.= '<tr> <td> '.$book[0].' </td> <td  >  '.$book[1].' </td> <td> '.$book['2'];
  	
  }

   

print<<<END
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="17" valign="top" background="../static/images/mail_leftbg.gif"><img src="../static/images/left-top-right.gif" width="17" height="29" /></td>
    <td valign="top" background="../static/images/content-bg.gif"><table width="100%" height="31" border="0" cellpadding="0" cellspacing="0" class="left_topbg" id="table2">
      <tr>
        <td height="31"><div class="titlebt">留言管理</div></td>
      </tr>
    </table></td>
    <td width="16" valign="top" background="../static/images/mail_rightbg.gif"><img src="../static/images/nav-right-bg.gif" width="16" height="29" /></td>
  </tr>
  <tr>
    <td valign="middle" background="../static/images/mail_leftbg.gif">&nbsp;</td>
    <td valign="top" bgcolor="#F7F8F9">
    <table class="toolbar" width="100%">
       
      </table>
    
    <table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td colspan="2" valign="top">&nbsp;</td>
        <td>&nbsp;</td>
        <td valign="top">
        <form name="adminForm" action="__URL__/delete" method="post">
        <table class="adminlist" cellpadding="1">
        <thead>
            <tr>
  
            <th style="width:25%">名称</th>
            <th style="width:15%">留言时间</th>
            <th style="width:60%">内容</th>
  
            </tr>
        </thead>
        <tbody>
     
             $display
    
        </tbody>
        <tfoot>
        <tr>
            <td colspan="10">
            <del class="container">
                <div class="pagination">
                    
                </div>
            </del>				
            </td>
        </tr>
        </tfoot>
        </table>
        </form>     	
        </td>        
      </tr>
    </table>
    </td>
    <td background="../static/images/mail_rightbg.gif">&nbsp;</td>
  </tr>
  <tr>
    <td valign="bottom" background="../static/images/mail_leftbg.gif"><img src="../static/images/buttom_left2.gif" width="17" height="17" /></td>
    <td background="../static/images/buttom_bgs.gif"><img src="../static/images/buttom_bgs.gif" width="17" height="17"></td>
    <td valign="bottom" background="../static/images/mail_rightbg.gif"><img src="../static/images/buttom_right2.gif" width="16" height="17" /></td>
  </tr>
</table>
END;
 
 


?>