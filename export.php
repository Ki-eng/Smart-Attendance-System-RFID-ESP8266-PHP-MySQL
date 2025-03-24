<?php

$conn = mysqli_connect("localhost", "root" , "" , "nodemcu_rfidrc522_mysql") or die ("connection failed"); 
$sql = "SELECT *from table_nodemcu_rfidrc522_mysql";
$result = mysqli_query($conn, $sql) or die ("query failed");

$html = "<table><tr><td>Name</td><td>ID</td><td>Gender</td><td>Email</td><td>Mobile</td></tr>";

while($row = mysqli_fetch_assoc($result)){
    $html .= '<tr><td>'.$row['name'].'</td><td>'.$row['id'].'</td><td>'.$row['gender'].'</td><td>'.$row['email'].'</td><td>'.$row['mobile'].'</td></tr>';

}
$html .= "</table>";
header('Content-Type:application/doc');
header('Content-Disposition:attachment;filename=Wednesday.doc');
echo $html;
?>