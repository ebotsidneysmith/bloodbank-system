<!Doctype html>
<html>
<link rel="stylesheet" type="text/css" href="style.css"/>
<body>
<?php
include "connection.php";
$inCity=$_POST["t4"];
$inBloodgroup=$_POST["t5"];
$sql="select * from register where (t4='".$inCity."' && t5='".$inBloodgroup."')";

$result=$conn->query($sql);
if($result->num_rows>0){
while($row=$result->fetch_assoc()){
echo " Email: ".$row["t1"]."-Name: ".$row["t2"]."-Phone number: ".$row["t3"]."-City: ".$row["t4"]."-Blood Group: ".$row["t5"]."<br>";}
}
else
{
echo "0 results";
}
mysqli_close($conn);
?>
</body>
</html>