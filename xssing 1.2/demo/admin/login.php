<?php

error_reporting(0);

if($_GET['a']=='login'){

	require_once("common.php");


	 if($_POST['name']==$user && $_POST['password']==$pass){
	 	
	 	setcookie('xss_user',$user,time()+3600);
	 	setcookie('xss_pass',$pass,time()+3600);
	 	cpmsg("登陆成功","success","index.php");
	 	
	 }else{
	 	
	 	cpmsg("用户名或密码错误");
	 	
	 }
  

 	}else{


 	?>

 <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
				<head>
					<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
					<link href="../static/css/login.css" rel="stylesheet" type="text/css" />
					<title>施工重地-闲人勿扰</title>
						<script>
							function focusEle(id){try{document.getElementById(id).focus();}catch(e){}}
						</script>
					</head>
					<body>
						<div id="outterWrapper">
							<div id="container">
								<div id="content">
									<div id="main">
										<div id="sideMain">
											<div id="loginFrame">
												<form  method="post" action="login.php?a=login">
													<ul>
														<li>
															<div class="f1">大 名</div>
															<div class="f2">
																<input type="text" class="text" name="name" maxlength="100" />
															</div>
														</li>
														<li>
															<div class="f1">口 令</div>
															<div class="f2">
																<input type="password" class="text" name="password" maxlength="100" />
															</div>
														</li>

													</ul>
													<div class="login">
														<div class="checkbox">
															<input type="checkbox" name="ispersis" id="ispersis" value="1" />
														记住我</div>
														<input type="image"  src="../static/images/btn_login.gif"  name="login" width="88" height="39" />
													</div>
												</form>
												<script>focusEle('username');</script>
											</div>
										</div>
										<div class="clear"></div>
									</div>
								</div>
								<div id="footer">
									<div class="copyright">© <a href="http://www.90sec.org" target="_blank">90 Sec</a> , All Rights Reserved. <a href="../">首页</a></div>
								</div>
							</div>
						</div>
					</body>
				</html>
			<?php   }   ?>
