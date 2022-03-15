<?php
include('banner.html');

include('connect.html');

$f_pictureshop=@$_POST['f_pictureshop'];
$t_customername=@$_POST['f_customername'];
$t_location=@$_POST['f_location'];
$t_transfer=@$_POST['f_transfer'];
$t_cost=@$_POST['f_cost'];

echo "<br>คำค้นที่รับมาจากฟอร์ม = " .$f_pictureshop. " / " .$t_customername. " /" .$t_location. " /" .$t_transfer. " /" .$t_cost. " ";

if($f_pictureshop>0){
    echo "<br> save in deliveryservice";
    $sql = "INSERT INTO deliveryservice
    VALUES ('',$f_pictureshop', '$t_customername' , '$t_location' , '$t_transfer' ,$t_cost)";
    echo "<br>ตรวจสอบ SQL ที่ได้ = $sql";
    $result = mysqli_query($conn, $sql);
}

 $sql = "SELECT  ID,Picturename,Types,Price FROM pictureshop";
 echo "<br>ตรวจสอบ SQL ที่ได้ = " .$sql;
 $result = mysqli_query($conn, $sql);

 if (mysqli_num_rows($result) > 0) {
     ?>
     <h1>บันทึกข้อมูลลูกค้าที่สั่งรูปภาพ</h1>
     <table border=1><tr><td><br>
    <form action="job9.php" method="post">
    <label for="f_pictureshop"> เลือกสินค้ารูปภาพ> </label>
    <select name="f_pictureshop" id="f_pictureshop">
        <option value="0"> --คลิกเลือกสินค้ารูปภาพ-- </option>
    <?php
    
    while($row = mysqli_fetch_assoc($result)) {
          $t_ID = $row["ID"];
          $t_Picturename = $row["Picturename"];
          $t_Types = $row["Types"];
          $t_Price = $row["Price"];

?>
          <option value="<?php echo $t_ID; ?>">
           <?php echo $t_ID."_".$t_Picturename."_".$t_Types."_".$t_Price; ?>
        </option>
<?php

}
} else {
    echo "<br>ผลการค้นหา 0 results";
}
?>
    </select>
    <br>
    <label for="f_customername">ชื่อลูกค้า : </label>
    <input type="text" id="f_customername" name="f_customername" size="80" > <br>

    <label for="f_location"> ที่อยู่ลูกค้า : </label>
    <input type="text" id="f_location" name="f_location" size="80" > <br>

    <label for="f_transfer"> รูปแบบการขนส่ง : </label>
    <input type="text" id="f_transfer" name="f_transfer" size="80" > <br>

    <label for="f_cost"> ค่าใช้จ่าย : </label>
    <input type="text" id="f_cost" name="f_cost" size="15" > <br><br>

    <input type="submit" value="บันทึกการจัดส่งสินค้า">

</form>
</td></tr></table>

<?php

$sql = "SELECT * FROM deliveryservice INNER JOIN pictureshop
                   ON deliveryservice.pictureID = pictureshop.ID
                   Order by customerID DESC";

$result = mysqli_query($conn, $sql);

echo "<h2> รายการสินค้ารูปภาพที่จะส่งไปหาลูกค้า </h2>";
echo "<table border='1' width='800'>";
echo "<tr><th>ลำดับที่</th> <th>ชื่อรูปภาพ</th>";
echo "<th>ชื่อลูกค้า</th> <th>ที่อยู่</th>";
echo "<th>รูปแบบการขนส่ง</th> <th>ค่าใฃ้จ่ายโดยรวม</th></tr>";

if (mysqli_num_rows($result) > 0) {

    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr><td align'center'>" . $row["customerID"]. "</td>";
        echo "<td>" . $row["Picturename"]. "</td>";
        echo "<td>" . $row["customername"]. "</td>";
        echo "<td>" . $row["location"]. "</td>";
        echo "<td>" . $row["transfer"]. "</td>";

        echo "<td align='right'>" . number_format($row["cost"]). " บาท</td></tr>"; ?>
        <?php
    }
} else {
    echo "<br>ผลการค้นหา 0 results";
}

echo "</table>";

mysqli_close($conn);
include('footer.html');
?>