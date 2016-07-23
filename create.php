
<html>
<body>

<?php
include("functions.php"); //include functions.php where all the functions are defined.

create($_POST["url_input"]); 
?>


<br/>copy this short code, you will be redirected to: <?php echo $_POST['url_input']; ?><br />
<br />

<form action="redirect.php" method="get">
To validate: <input type="text" name="tinyurl"> 
<input type="submit" value="let's go!">
</form>

</body>
</html>
