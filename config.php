<?php
define('SITE_URL', 'http://localhost:81/teroject');
define('THEME','/app/theme/version1/');
define('ASSETS','/teroject/app/theme/version1/');
define('ASSETS_HOME','/teroject/app/theme/home/');





date_default_timezone_set('Asia/Tehran');



function header_date_compare ($date){

  $dt=explode(' ', $date);
          $date=explode('-', $dt[0]);
          $time=$dt[1];
          $y=$date[0];
          $m=$date[1];
          $d=$date[2];
          $time = explode(':',$time);
          $ho=$time[0];
          $mi=$time[1];
          $se=$time[2];


$date1=date_create("$y-$m-$d");
$date2=date_create(date('Y-m-d'));
$diff=date_diff($date1,$date2);

return $diff;

}
function email ($maghsad,$onvan,$matn){

$to = "$maghsad";
$subject = "$onvan";

$message = "
<html>
<head>
<meta charset='UTF-8'>
<title>$onvan</title>
<style>*{direction:rtl; font-family:tahoma; font-size:14px;}</style>
</head>
<body>
<p>$matn</p>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <no-reply@teroject.com>' . "\r\n";

mail($to,$subject,$message,$headers);

}
function sms($maghsad,$matn){
  ini_set("soap.wsdl_cache_enabled", "0");
  try {
    $user = "9364961262";
    $pass = "teroject123";
  
    
    $client = new SoapClient("http://87.107.121.52/post/send.asmx?wsdl");
    
    $getcredit_parameters = array(
        "username"=>$user,
        "password"=>$pass
    );

    
    $encoding = "UTF-8";
    $textMessage = iconv($encoding, 'UTF-8//TRANSLIT',"$matn\nTeroject.Com");
    
  
    $sendsms_parameters = array(
        'username' => $user,
        'password' => $pass,
        'from' => "50001333337375",
        'to' => array($maghsad),
        'text' => $textMessage,
        'isflash' => false,
        'udh' => "",
        'recId' => array(0),
        'status' => 0
    );
    
    $status = $client->SendSms($sendsms_parameters)->SendSmsResult;
}
 catch (SoapFault $ex) {
    echo $ex->faultstring;
}
        }
    

//to change date from gregorian to jalali with only one parameter.
//this doesn't affect time!
function to_jalali($date){
  //jalali date + time
          $dt=explode(' ', $date);
          $date=explode('-', $dt[0]);
          if(count($dt)==2){
          $time=$dt[1];
            }
            else {
              $time=" ";
            }
          $y=$date[0];
          $m=$date[1];
          $d=$date[2];
          $date=gregorian_to_jalali($y,$m,$d);

         
          return $date[0]."/".$date[1]."/".$date[2]."   ".$time;
}

function getshamsi ($date,$format){

$split_date_time = explode(' ', $date);
list($year, $month, $day) = explode('-', $split_date_time[0]);
list($hour, $minute, $second) = explode(':', $split_date_time[1]);
$timestamp = mktime($hour, $minute, $second, $month, $day, $year);
return jdate($format , $timestamp ,'' ,'','en');

}

function getmiladi ($year,$month,$day,$hour,$minute,$second){

$timestamp = jmktime($hour, $minute, $second, $month, $day, $year);
 return date('Y/m/d H:i:s', $timestamp);


}

function getmiladi_bisaat ($year,$month,$day){

$timestamp = jmktime(0,0,0, $month, $day, $year);
 return date('Y/m/d', $timestamp);


}

function clear($var)
{
    $var = strip_tags($var);
    $var = htmlentities($var);
    $var = stripslashes($var);
    return $var;
}

function rs($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function rn() {
    $characters = '123456789';
        return $characters[rand(0,8)];
}

function terocode_creator($id){
  $id=(string)$id;
  $terocode="";
  $length=strlen($id);
  for($i=0;$i<$length;$i++){
    if($i%2==0){
      $terocode.=rn();
    }
    $terocode.=$id[$i];
  }
  if(rand(0,1)==1){
   // $terocode.=rn();
  }
  return (int)$terocode;
}

class Database 
{
	private static $dbName = 'blog' ; 
	private static $dbHost = 'localhost' ;
	private static $dbUsername = 'root';
	private static $dbUserPassword = '';
	
	private static $cont  = null;
	
	public function __construct() {
		exit('Init function is not allowed');
	}
	
	public static function connect()
	{
	   // One connection through whole application
       if ( null == self::$cont )
       {      
        try 
        {
          self::$cont =  new PDO( "mysql:host=".self::$dbHost.";"."dbname=".self::$dbName, self::$dbUsername, self::$dbUserPassword,array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")); 
          
        }
        catch(PDOException $e) 
        {
          die($e->getMessage());  
        }
       } 
       return self::$cont;
	}
	
	public static function disconnect()
	{
		self::$cont = null;
	}
}

  
?>