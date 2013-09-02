<?php header("Content-Type:text/html;charset=utf-8"); ?>
<?php require_once('360_safe3.php'); ?>


<?php 
function convertSpace($string)
 {
 return str_replace("http://yoo.hk", "", $string);
 }
echo filter_var($string, FILTER_CALLBACK,
array("options"=>"convertSpace"));
?>		
		
<?php
$newurl = $_POST["newURL"];
$choose = $_POST["choose"];
$url = $newurl;
$guestip = $HTTP_SERVER_VARS['REMOTE_ADDR'];
$format="%H:%M:%S";
$strf=strftime($format);
$guestother = $_SERVER['REMOTE_HOST'].'-'.$_SERVER['REMOTE_PORT'];
$today = date("Y-m-d");

function urlShort($url){
	$url= crc32($url);
	$result= sprintf("%u", $url);
	$sUrl= '';
	while($result>0){
		$s= $result%62;
		if($s>35){
			$s= chr($s+61);
		} elseif($s>9 && $s<=35){
			$s= chr($s+ 55);
		}
		$sUrl.= $s;
		$result= floor($result/62);
	}
	return $sUrl;
}


if(!filter_var($url, FILTER_VALIDATE_URL))
{
	echo "您输入的网址有误，请务必在网址前加传输协议头，譬如http://或FTP://或SFTP://等等";
	}
	else
	{
	$sUrl = '/'.urlShort($url);

	$con = mysql_connect("localhost","yoo","xxxxxx");
	if (!$con)
	{
	die('Could not connect: ' . mysql_error());
	}
	mysql_select_db("mzbsmkqv_test", $con);
	if($choose==0){
	$countuse = mysql_query("SELECT COUNT(*) FROM `surl` WHERE ip = '$guestip' AND today = '$today'");
	if($countrow = mysql_fetch_array($countuse)){
	$countall = $countrow['COUNT(*)'];
	}
	if($countall<=100){
	$inserturl = mysql_query("INSERT INTO `surl`(`shortURL`, `toURL`,`ip`,`today`,`other`) VALUES ('$sUrl','$url','$guestip','$today','$guestother')");

	echo '今日您还可创建'.(100-$countall).'个短网址！'.'<br />';
	echo '原网址：'.$url.'<br />';
	echo '短网址：http://yoo.hk'.$sUrl.'<br />';

	}else{
	echo '今日您已经创建了100个短网址，明日继续吧...'.'<br />';
	}
}else {
	$stolurl = $url;
	convertSpace($stolurl);
	$shorttourl = filter_var($stolurl, FILTER_CALLBACK,array("options"=>"convertSpace"));
	$stol =  mysql_query("SELECT * FROM `surl` WHERE shortURL = '$shorttourl'");
	if($countrow2 = mysql_fetch_array($stol)){
	$countall2 = $countrow2['toURL'];
	}
	echo '原网址：'.$countall2.'<br />';
	}
	mysql_close($con);
	}
?>