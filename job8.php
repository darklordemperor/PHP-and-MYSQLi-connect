<?php
include('banner.html');

include('connect.html');

$t_id=0;
$t_id=@$_GET['link_ID'];

echo "คำที่รับมาจากการกดลิ้งแก้ไข = " .$t_id;


$tup_id=0;
$tup_id=@$_POST['f_id'];
$t_pic=@$_POST['f_pic'];
$t_name=@$_POST['f_name'];
$t_types=@$_POST['f_types'];
$t_price=@$_POST['f_price'];

echo "<br>คำค้นที่รับมาจากฟอร์ม = " .$tup_id. " / " .$t_pic. " /" .$t_name. " /" .$t_types. " /" .$t_price. " ";

if($tup_id>0){
    $sql = "UPDATE pictureshop SET Picture='$t_pic',
                               Picturename='$t_name',
                               Types='$t_types',
                               Price='$t_price',
            WHERE ID=$tup_id ";

    echo"<br>ตรวจสอบ SQL ที่ได้ = $sql";

    $result = mysqli_query($conn, $sql);
}

if($t_id>0){
  $sql = "SELECT * FROM pictureshop WHERE ID=$t_id";
  echo "<br>ตรวจสอบ SQL ที่ได้ = ";
  echo $sql;
  $result = mysqli_query($conn, $sql);

  $row = mysqli_fetch_assoc($result);

  $tbl_pic = $row["Picture"];
  $tbl_name = $row["Picturename"];
  $tbl_types = $row["Types"];
  $tbl_price = $row["Price"];

?>

<h1> แก้ไขข้อมูลสินค้า </h1>
<table border =1><tr><td><br>

<form action="job8.php" method="post">
    <label for="f_id">ID :_________</label>
    <input type="text" id="f_id" name="f_id" size="5"  value="<?php echo $t_id; ?>" readonly> <br>

    <label for="f_pic">ชื่อรูป :___________ </label>
    <input type="text" id="f_pic" name="f_pic" size="50" value="<?php echo $tbl_pic; ?>"> <br>

    <label for="f_name">ชื่อรูปภาพ :__________ </label>
    <input type="text" id="f_name" name="f_name" size="50" value="<?php echo $tbl_name; ?>"> <br>

    <label for="f_types">ลักษณะ :___________ </label>
    <input type="text" id="f_types" name="f_types" size="50" value="<?php echo $tbl_types; ?>"> <br>

    <label for="f_price">ราคา :___________</label>
    <input type="text" id="f_price" name="f_price" size="15" value="<?php echo $tbl_price; ?>"> <br>

    <input type="submit" value="บันทึกการแก้ไข">
</form>

</td></tr></table>

<?php

}
?>

<?php

if($t_id==0){

  $sql = "SELECT * FROM pictureshop Order by ID DESC";

  $result = mysqli_query($conn, $sql);

  echo "<h1>แก้ไข<br>รายการสินค้ารูปภาพ</h1>";
  echo "<table border='1' width='800'>";
  echo "<tr><th>ID</th> <th>Picture</th>";
  echo "<th>Picturename</th> <th>Types</th>";
  echo "<th>Price</th> <th>คำสั่ง</th></tr>";

  if (mysqli_num_rows($result) > 0) {
    
    while($row = mysqli_fetch_assoc($result)) {
      echo "<tr><td align='center'>"  . $row["ID"]. "</td>";
      $tbl_id=$row["ID"];
      $pic = $row['Picture'];
      echo "<td><img src = $pic width=250>";"</td>";
      echo "<td>" . $row["Picturename"]. "</td>";
      echo "<td>" . $row["Types"]. "</td>";
      echo "<td align='right'>" . $row["Price"]. "</td>"; ?>
      <td align='center'>
        <a href="job8.php?link_ID=<?php echo $tbl_id; ?>">แก้ไข</a>
    </td>></tr>
    <?php
    }
  } else {
     echo "<br>ผลการค้นหา 0 results";
  }
  echo "</table>";
}
mysqli_close($conn);
include('footer.html');
?>