<?php
session_start();

$pj= $_POST["pj"];



$Usuario = $_POST["Usuario"];
$Contrasena = md5($_POST["Contrasena"]);


$_SESSION["Usuario"] = $Usuario;
$_SESSION["Contrasena"] = $Contrasena;

mysql_connect("localhost", "root", "");
mysql_select_db("napstercito");

$query = "SELECT * FROM usuarios WHERE nickname = '$Usuario' AND password = '$Contrasena'";
$result = mysql_query($query);


$row = mysql_fetch_array($result);


if($row)
	header("location: principal.php");
	else
	header("location: index.php?error=1");
?>

<?php
mysql_connect("localhost", "root", "");
mysql_select_db("napstercito");

$nombres = $_POST["nombres"];
$sexo= $_POST["sexo"];
$email= $_POST["email"]; ;
$pass= md5($_POST["pass"]); 
$mensaje=$_POST["mensaje"];

$query = "INSERT INTO `napstercito`.`usuarios` (`id`, `nickname`, `password`, `sexo`, `e-mail`, `gustos_musicales`) VALUES (NULL, '$nombres', '$pass', '$sexo', '$email', '$mensaje');";


mysql_query($query);

header("location: principal.php");


?>