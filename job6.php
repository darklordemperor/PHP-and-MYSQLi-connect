<?php include 'banner.html';
$t_Picture=@$_POST['Picture'];
$t_Namepicture=@$_POST['Namepicture'];
$t_Types=@$_POST['Types'];
$t_Price=@$_POST['Price'];
?>

<title>Insert</title>
 <br>
 <table align="center" style="width:20%">
 
 <tr style="background-color:#ffffff;"><th><center>เพิ่ม รายการสินค้า
</center><br>
 <form action = "job6.php" method = "post">
 <label for="Picture"> ชื่อรูปภาพ : </label>
 <input type="text" id="Picture" name="Picture"><br><br>
 <label for="Picture"> ชื่อสินค้า : </label>
 <input type="text" id="NamePicture" name="NamePicture"><br><br>
 <label for="Picture"> ลักษณะของสินค้า : </label>
 <input type="text" id = "Types" name = "Types"><br><br>
 <label for="Picture"> ราคา : </label>
 <input type="text" id="Price" name = "Price">
 <center><br><input type = "submit" value = "เพิ่มข้อมูล"></center>
 </form>
 </th></tr></table>
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apirat";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}
if(strlen($t_Namepicture)>0){
 $sql = "INSERT INTO picture VALUES ('','$t_Picture', '$t_Namepicture' , '$t_Types' ,
 '$t_Price')";
 echo $sql.strlen($t_Namepicture);
 $result = mysqli_query($conn, $sql);
}
$sql = "SELECT * FROM picture Order by ID DESC ";
$result = mysqli_query($conn, $sql);
"<br>";
echo "<table border = '1'width ='600'>";
echo "<tr><th>ID</th> <th>Picture</th>";
echo "<th>NamePicture</th> <th>Types</th>";
echo "<th>Price</th></tr>";
if (mysqli_num_rows($result) > 0) {
 echo"<br>";
 while($row = mysqli_fetch_assoc($result)) {
   echo "<td>" . $row["ID"] . "</td>";
   $pic = $row['Picture'];
   echo "<td><img src = $pic width=250>";"</td>";
   echo "<td>" . $row["Namepicture"]."</td>";
   echo "<td>" . $row["Types"]."</td>";
   echo "<td>" . $row["Price"]."</td></tr>";
 }
} else {
 echo "0 results";
}
echo "</table>";
mysqli_close($conn);
include ('footer.html');
?>