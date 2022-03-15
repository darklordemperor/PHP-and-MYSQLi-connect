<?php include 'banner.html';?>
>


<br>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apirat";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}
$sql = "SELECT * FROM picture ";
$result = mysqli_query($conn, $sql);
"<br>";
echo "<table style = width:100%>";
echo "<table border = '1'>";
echo "<tr style = background-color:#ffffff;>"."<td><center>
รหัส ID</td></center>
 <td><center>รูป ภาพสินค้า</td></center>
 <td><center>ชื่อ สินค้า</td></center>
 <td><center>ลักษณะสินค้า</td></center>
 <td><center>ราคา</td></tr></center>";
if (mysqli_num_rows($result) > 0) {
 echo"<br>";
 while($row = mysqli_fetch_assoc($result)) {
 echo"<tr style = background-color:#ffffff;>";
 echo "<td><center>".$row["ID"]."</td></center>";
 $pic=$row['Picture'];
 echo "<td><center>"."<img src=$pic width=250>";"</td></center>";
 echo "<td><center>".$row["Namepicture"]."</td></center>";
 echo "<td>".$row["Types"]."</td>";
 echo "<td><center>".$row["Price"]."</td></center>";
 echo "</tr>";
 }
} else {
 echo "0 results";
}
echo "</table>";
mysqli_close($conn);
?>
<?php include 'footer.html';?>