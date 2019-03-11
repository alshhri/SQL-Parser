
<?php
include("sql.php");
if($_POST)
{
//$sql ="select `456`,filed  from table ";
$sql = $_POST['Text1'];
$oop = new select();
$oop->statment = $sql;
$oop->spliting();
$oop->first_cat();
$oop->printr2($oop->array);
echo"<br><br><br><br>";
}


?>
