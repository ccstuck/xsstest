<?php  define('LOG_SIZE','1000'); define('DEBUG_MODE',1); define("DB_HOST",'localhost'); define("DB_USER",'root'); define("DB_NAME",'xing'); define("DB_PASS",''); define("DB_PORT",'3306'); define("DB_PRE",'xg_'); define('STATIC_PATH',ROOT_PATH."static/"); define('STATIC_JS_PATH',STATIC_PATH."js/"); define('CONFIG_PATH',ROOT_PATH."config/"); define('RUNNING_PATH',ROOT_PATH."running/"); define('CACHE_PATH',RUNNING_PATH."cache/"); define('LOG_PATH',RUNNING_PATH."log/"); define('SITE_HOST',$_SERVER['HTTP_HOST']); define('SITE_ROOT',"http://w/epp/xing/"); define('STATIC_URL',SITE_ROOT."static/"); define('STATIC_JS_URL',STATIC_URL."js/"); define('STATIC_STYLE_URL',STATIC_URL."style/"); define('APP_PATH',ROOT_PATH."/apps/".APP_NAME."/"); define('TEMPLATE_PATH',APP_PATH."view/"); define('PUBLIC_PATH',TEMPLATE_PATH."public/"); define('APP_LIB_PATH',APP_PATH."lib/"); define('APP_URL',SITE_ROOT."apps/".APP_NAME."/"); define('TEMPLATE_URL',APP_URL."view/"); define('PUBLIC_URL',TEMPLATE_URL."public/"); define('PUBLIC_JS_URL',PUBLIC_URL."js/"); define('PUBLIC_STYLE_URL',PUBLIC_URL."style/"); abstract class Mysql{ private $conn; private $dbname; private $dbpre; public $dbtable; function __construct($dbtable){ } public function connect($host,$user,$pass,$port,$dbname,$dbpre){ $this->dbname=$dbname; $this->dbpre =$dbpre; $conn =mysql_connect($host.":".$port, $user,$pass); if (!$conn) { die('Could not connect: '. mysql_error()); } $this->conn=$conn; if (!mysql_select_db($this->dbname, $this->conn)) { exit("db  error"); } mysql_query("SET NAMES utf8",$this->conn); } public function query($sql){ $result = mysql_query($sql, $this->conn); if(DEBUG_MODE) Log::record($sql); return $result ? $result : false; } public function fetch_all($filed="*",$case=array(),$order=null){ $where =self::assign($case); if($where){ $where="WHERE  $where "; } if($order){ $where.="ORDER BY ".$order; } $rows=array(); $query=self::query("SELECT $filed  FROM `".$this->dbpre.$this->dbtable."`   $where "); while($row=mysql_fetch_array($query)){ $rows[]=$row; } return $rows; } public function fetch__by_limit($filed="*",$case=""){ $query=self::query("SELECT $filed  FROM `".$this->dbpre.$this->dbtable."`    $case  "); while($row=mysql_fetch_array($query)){ $rows[]=$row; } return $rows; } public function fetch_first($filed="*",$case=array(),$append=null){ $where =self::assign($case); if($where){ $where="WHERE  $where "; } $result=self::query("SELECT  $filed  FROM `".$this->dbpre.$this->dbtable."`   $where "); if($result){ $row=mysql_fetch_array($result); } return $row; } public function update($data=array(),$case=array()){ $update=self::iassign($data); $where =self::assign($case); return $this->query("UPDATE `".$this->dbpre.$this->dbtable."`   SET  $update  WHERE  $where "); } public function insert($data){ $insert=self::iassign($data); $this->query("INSERT  INTO `".$this->dbpre.$this->dbtable."` SET  $insert"); return mysql_insert_id(); } public function delete($case=array()){ $where=self::assign($case); return self::query("DELETE FROM `".$this->dbpre.$this->dbtable."`  WHERE  $where "); } public function count($case=null){ $where= is_null($case) ? "" : " WHERE ".$case; $count=$this->query("select  count(*)  FROM  ".$this->dbpre.$this->dbtable.$where); $res=0; if($count){ $res=mysql_fetch_array($count); } return $res['count(*)']; } private function assign($array) { $str=""; foreach($array as $key=> $item){ $str.=" `$key`='".$item."' and"; } return substr($str,0,strlen($str)-3); } private function iassign($array) { $str=""; foreach($array as $key=> $item){ $str.=" `$key`='".$item."' ,"; } return substr($str,0,strlen($str)-1); } } abstract class Model extends Mysql{ function __construct(){ $this->dbtable=strtolower($this->get_name()); $this->connect(DB_HOST,DB_USER,DB_PASS,DB_PORT,DB_NAME,DB_PRE); $this->init(); } protected function get_name() { return substr(get_class($this),0,-5); } public function init(){} function __call($method,$args) { if(1>2){ }elseif(strtolower(substr($method,0,6))=='getby_') { $field = substr($method,6); return $this->fetch_first("*",array($field=>$args[0])); } } } abstract class Action{ public $name =null; function __construct(){ $this->name=$this->get_name(); $this->init(); } public function init(){} protected function get_name() { return substr(get_class($this),0,-6); } protected function view($name=null){ $file=is_null($name) ? ACTION_NAME : $name; include(TEMPLATE_PATH.MODULE_NAME."/".$file.'.tpl.php'); } } class LOG{ const SQL='SQL'; static $log = array(); public static function record($msg,$level='SQL'){ $date= date('Y-m-d H:i:s',time()); self::$log[] = "[".$date."] | ".$_SERVER['REQUEST_URI']." | {$level}: {$msg}\r\n"; } public static function show(){ $msg=''; foreach(self::$log as $log){ $msg.=$log."<br>"; } echo <<<EOF
  	<div id="debug-bar" style="background:#F5F5F5;color:#888;margin:6px;font-size:14px;border:1px dashed silver;padding:8px">
    <div style="color:gray;font-weight:bold"><span>DEBUG-Bar </span>
    <span onclick="this.parentNode.parentNode.style.display='none'" style="cursor:pointer;float:right;width:10px;background:#500;border:1px solid #555;color:white">X</span></div>
    <div style="overflow:auto;height:100px;text-align:left;">
    $msg </div> </div>
EOF;
 } public static function save(){ } public static function run(){ if(!DEBUG_MODE) self::save(); } } class Uauc { public static function run(){ $action=!empty($_REQUEST['a']) ? strip_tags(strtolower($_REQUEST['a'])) : 'index'; $module=!empty($_REQUEST['m']) ? strip_tags(strtolower($_REQUEST['m'])) : 'index'; define('ACTION_NAME',$action); define('MODULE_NAME',$module); $module=A(ucfirst($module)); set_error_handler(array('Uauc','appError')); set_exception_handler(array('Uauc','appException')); spl_autoload_register(array('Uauc', 'autoload')); Log::run(); call_user_func(array(&$module,$action)); } public static function autoload($class) { if(substr($class,-5)=='Model'){ require_once APP_PATH."model/".substr($class,0,-5).".Model.php"; }elseif(substr($class,-6)=='Action'){ require_once APP_PATH."action/".substr($class,0,-6).".Action.php"; } } static public function appException($e) { } static public function appError($errno, $errstr, $errfile, $errline) { } } function P($var, $echo=true, $label=null, $strict=true) { $label = ($label === null) ? '' : rtrim($label) . ' '; if (!$strict) { if (ini_get('html_errors')) { $output = print_r($var, true); $output = "<font color='green'><pre>" . $label . htmlspecialchars($output, ENT_QUOTES) ."</font></pre>"; } else { $output = $label . print_r($var, true); } } else { ob_start(); var_dump($var); $output = ob_get_clean(); if (!extension_loaded('xdebug')) { $output = preg_replace("/\]\=\>\n(\s+)/m", "] =>", $output); $output = '<font color="green"><pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</font></pre>'; } } if ($echo) { echo($output); return null; }else return $output; } function M($model,$module=null){ $path=is_null($module) ? APP_PATH."model/" : ROOT_PATH."model/".$module."/model/"; if(file_exists($path.$model.".Model.php")){ require_once($path.$model.".Model.php"); $class=$model."Model"; return new $class(); }else{ return null; } } function A($action,$module=null){ $path=is_null($module) ? APP_PATH."action/" : ROOT_PATH."moudle/".$module."/action/"; require_once($path.$action.".Action.php"); $class=$action."Action"; return new $class($action); } function view_file($name=null){ $file=is_null($name) ? ACTION_NAME : $name; return TEMPLATE_PATH.MODULE_NAME."/".$file.'.tpl.php'; } function get_client_ip() { if (isset($_SERVER['HTTP_X_FORWARDED_FOR'])) { $arr = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']); $pos = array_search('unknown',$arr); if(false !== $pos) unset($arr[$pos]); $ip = trim($arr[0]); }elseif (isset($_SERVER['HTTP_CLIENT_IP'])) { $ip = $_SERVER['HTTP_CLIENT_IP']; }elseif (isset($_SERVER['REMOTE_ADDR'])) { $ip = $_SERVER['REMOTE_ADDR']; } $ip = (false !== ip2long($ip)) ? $ip : '0.0.0.0'; return $ip; } function J($url=""){ header("Location:".$url); } function show_404(){ header("HTTP/1.0 404 Not Found"); header("Status: 404 Not Found"); exit; } function load_lib($lib,$app=null){ $file= is_null($app) ? APP_LIB_PATH.$lib : ROOT_PATH."apps/".$app."/lib/".$lib; require_once $file.".class.php"; } function load_func($lib,$app=null){ $file= is_null($app) ? APP_LIB_PATH.$lib : ROOT_PATH."apps/".$app."/lib/".$lib; require_once $file.".func.php"; } function load_action(){ } function load_model(){ } function cpmsg($message,$type="success",$url="-1",$time=666,$title="系统信息"){ $color= ($type == 'success') ? "green" : "red"; $message="<font color=$color > $message </font>"; if($url == "-1"){ $jsaction= "history.go(-1);"; $url="javascript:history.go(-1);"; } else{ $jsaction="window.location.href ='$url';" ; } $style=PUBLIC_STYLE_URL."oa.css"; print<<<EOF
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="{$style}" />
<table cellspacing="2" cellpadding="3" border="0"  align="center" class="admintable1" style="margin-top:20px;width:33%;">
 <tbody>  <tr> <td align="left" class="admintitle">{$title}</td>
 </tr> <tr> <td height="80" bgcolor="#FFFFFF" style="height:75px;line-height:22px;" align="center" valign="middle">
  <a href="$url"> <strong> $message </strong>  (跳转中...)</a><script> setTimeout("$jsaction",$time); </script>
  </td> </tr></tbody></table>
EOF;
 } class AppAction extends Action{ function init(){ include APP_PATH."model/User.Model.php"; $user=new UserModel(); if(!$user->login($_COOKIE['xing_name'], $_COOKIE['xing_pass'])){ header("Location:?m=user&a=login"); } } }