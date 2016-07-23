<?php
include("config.php");

function generate_chars()
{
	$num_chars = 4; //max length of random chars
	$i = 0;
	$my_keys = "0123456789abcdefghijklmnopqrstuvwxyz"; //keys to be chosen from
	$keys_length = strlen($my_keys);
	$url  = "";
	while($i<$num_chars)
	{
		$rand_num = mt_rand(1, $keys_length-1);
		$url .= $my_keys[$rand_num];
		$i++;
	}
	return $url;
}

function is_used($chars)
{
	//check the uniqueness of the chars
	global $link;
	$q = "SELECT * FROM `urls` WHERE `unique_chars`='".$chars."'";
	$r = mysql_query($q, $link);
	if( mysql_num_rows($r)>0 ){
		return false;
	}else{ 
		return true;
	}
}

function is_exist($url)
{
	global $link;
	$q = "SELECT * FROM `urls` WHERE `url`='".$url."'";
	$r = mysql_query($q);
	if(mysql_num_rows($r)>0){
		return true;
	}else{
		return false;
	}
}

function create($url)
{
	global $link; //make the link variable in the config.php, global
	global $config; //make the $config array in the config.php, global

	//$url = $_GET["url_input"];//get the url
	$url = trim($url);//trim it to remove whitespace
	$url = mysql_real_escape_string($url);//sanitize data
	/* Now we check whether the url is already there in the database. */
	if(!is_exist($url))
	{
		//url is not in the database
		$chars = generate_chars();
		while( !is_used($chars) )
		{
			$chars = generate_chars();
		}

		$q = "INSERT INTO `urls` (url, unique_chars) VALUES ('".$url."', '".$chars."')";
		$r = mysql_query($q, $link); //insert into the database
		if(mysql_affected_rows()){
			//ok, inserted. now get the data
			$q = "SELECT * FROM `urls` WHERE `url`='".$url."'";
			$r = mysql_query($q);
			$row = mysql_fetch_row($r);
			echo $config["domain"]."/".$row[2]; //$row[2] is where the random chars are
		}else{
			//problem with the database
			echo "Sorry, some problem with the database. Please try again.";
		}
	}
	else
	{
		//url is already there. so no need to insert again. Just get the data from database
		$q = "SELECT * FROM `urls` WHERE `url` = '".$url."'";
		$r = mysql_query($q);
		$row = mysql_fetch_row($r);
		//echo $config["domain"]."/".$row[2];
		echo "<h2>$url ==> $row[2] </h2>", "<br/>";
	}
}


?>