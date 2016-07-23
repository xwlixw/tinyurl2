<?php 

ob_start(); //start output buffering.

include("config.php"); 

$tinyurl = $_GET["tinyurl"];//short chars
$q = "SELECT url, unique_chars FROM `urls` WHERE unique_chars = '".$tinyurl."'";
$r = mysql_query($q, $link);

if(mysql_num_rows($r)>0){
	$info = mysql_fetch_array($r);
	$url = $info['url'];
	header("Location: http://$url"); //redirect to the desired url
}else{
	echo "Sorry, link not found!";
}

mysql_close(); 
ob_end_flush();

?>
