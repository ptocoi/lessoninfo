<?php 
$Us="./main/index.html";
$Ds=(strpos($Us,"?"))?"&":"?";
$Qs=$_SERVER["QUERY_STRING"];
$Qs=(strlen($Qs)>0)? $Ds.$Qs:"";
$Us=$Us.$Qs;
header("Location: ".$Us);
//header("Location: ./main/main.html");
?>