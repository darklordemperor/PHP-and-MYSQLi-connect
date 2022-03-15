<?php include 'banner.html';?>
<?php $rest=@$_POST['Namepicture'];?>

<form action="job5.php" method="post">
    <label for="Namepicture"> โปรดป้อนข้อความ :</label>
    <input type="text" id="Namepicture" name="Namepicture" value="<?php echo $rest; ?>">
     <input type="submit" value="ค้นหา">
</form>

<?php
echo "คำค้นหาที่รับจากฟอร์ม =" .$rest;
$rest="%" .$rest. "%";
echo "<br>คำค้นที่ใส่ wild card % หน้าหลัง = ".$rest;

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "apirat";

$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
 die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM picture where Namepicture LIKE '$rest' or Types LIKE '$rest' ";

echo "<br>ตรวจสอบ sql ที่ได้ = ";
echo $sql;

$result = mysqli_query($conn, $sql);
"<br>";
echo "<table border = '1'width ='600'>";
echo "<tr><th>ID</th> <th>Picture</th>";
echo "<th>NamePicture</th> <th>Types</th>";
echo "<th>Price</th></tr>";
if (mysqli_num_rows($result) > 0) {
  
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
?>
<?php include 'footer.html';?>