<?php include('banner.html');

$t_id=@$_GET['link_id'];
?>

<?php


$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apirat";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}
if($t_id>0){
     $sql = "DELETE FROM picture WHERE ID=$t_id";
     echo "<br> ตรวจสอบ SQL ที่ได้ = ";
     echo $sql;
     $result = mysqli_query($conn, $sql);
}

$sql = "SELECT * FROM picture Order by ID DESC";

$result = mysqli_query($conn,$sql);

echo "<table border = '1'width ='600'>";
echo "<tr><th>ID</th> <th>Picture</th>";
echo "<th>NamePicture</th> <th>Types</th>";
echo "<th>Price</th></tr>";
if (mysqli_num_rows($result) > 0) {
 echo"<br>";
 while($row = mysqli_fetch_assoc($result)) {
   echo "<tr><td align='center'>" . $row["ID"]. "</td>";
   $del_id = $row['ID'];
   $pic = $row['Picture'];
   echo "<td><img src = $pic width=250>";"</td>";
   echo "<td>" . $row["Namepicture"]."</td>";
   echo "<td>" . $row["Types"]."</td>";
   echo "<td align='right'>" . $row["Price"]."</td>"; ?>
   <td align='center'><a href="job7.php?=<?php echo $del_id; ?>"
   onclick ="return confirm('คุุณต้องการลบ ID = <?php echo $del_id; ?> หรือไม่');">ลบ</a>
 </td></tr>
 <?php
 }
} else {
     echo "<br>ผลการค้นหา 0 results";
}

echo "</table>";
mysqli_close($conn);
include ('footer.html');
?>