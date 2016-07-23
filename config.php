<?php
 error_reporting(E_ALL);// remove once complete
 $hostname = "localhost";
 $username = "root";
 $password = "";
 $dbname = "tinyurl2";
 $link = @mysql_connect($hostname, $username, $password);
 mysql_select_db($dbname) or die("Unknown database!");
 
 $config["domain"] = "http://127.0.0.1/tinyurl2";
?>