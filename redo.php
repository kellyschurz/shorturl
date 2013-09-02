<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<?php require_once('360_safe3.php'); ?>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			yoo.hk
		</title>
		<style>
			* { font-family: verdana; font-size: 10pt; COLOR: gray; }
			b { font-weight: bold; }
			table { height: 320px; border: 1px solid gray;}
			td { text-align: center; padding: 25;}
		</style>

	</head>
	<body>
		<center>
			<br><br><br><br>
			<table>
				<tr><td>传送中...<b>yoo.hk</b></td></tr>
				<tr><td>若您能看清此段文字，网速略慢哦！...</td></tr>
					<tr><td></td></tr>
					<tr><td style="font-size: 8pt">www.yoo.hk</td></tr>
				</table>
				<br><br>
			</center>
			<?php
			$home = "http://yoo.hk/";
			$abc = $_SERVER['REDIRECT_URL'];
			$con = mysql_connect("localhost","yoo","xxxxxx");
			if (!$con)
			{
				die('Could not connect: ' . mysql_error());
			}
			mysql_select_db("mzbsmkqv_test", $con);
			$result = mysql_query("SELECT * FROM surl where shortURL = '$abc' limit 0,1");
			?>
			<script language="javascript">
			document.location.href = "<?php if($row = mysql_fetch_array($result)){echo $row['toURL'];}else{echo $home;} ?>" ;
			</script>
			<?php mysql_close($con); ?>
		</body>
	</html>