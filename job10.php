<?php
include('banner.html');
include('connect.html');

$sql = "SELECT sum(cost) as topcost
        FROM deliveryservice
            Group by pictureID
            Order by topcost DESC
            Limit 1";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
$topcost=$row["topcost"];

$sql = "SELECT Picturename,
                count(customerID) as total,
                sum(cost) as summary,
                max(cost) as topcost
        FROM deliveryservice INNER JOIN pictureshop
                    ON deliveryservice.pictureID = pictureshop.ID
                    Group by pictureshop.ID
                    Order by summary DESC";

$result = mysqli_query($conn, $sql);

echo "<h2>ความคืบหน้าในการขนส่งสินค้าไปยังลูกค้า</h2>";
echo "<table border='1' >";
echo "<tr><th width='60' align='center'>      ลำดับที่</th>";
echo "<th width='200'>                        ชื่อรูปภาพ</th>";
echo "<th width='60' align='center'>          จำนวน</th>";
echo "<th width='120' align='right'>          รวบค่าจัดส่ง</th>";
echo "<th width='400' align='left'>           </th></tr>";

$i=1;
if (mysqli_num_rows($result) > 0) {
    while($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td align='center'>" . $i. "</td>";
    echo "<td>" . $row["Picturename"]. "</td>";
    echo "<td align='center'>" . $row["total"]. "</td>";
    echo "<td align='right'>" . number_format($row["summary"]) . " บาท</td>";
    $t_sum=$row["summary"] * 400 / $topcost;
    $t_percent=11.11;
    $t_percent=round($row["summary"] * 100 / $topcost);
    echo "<td>";
    ?>
    <table border="1" bgcolor="green" width="<?php echo $t_sum; ?>">
          <tr><td><?php echo "&nbsp" .$t_percent. "%"; ?></td></tr></table>
          <?php
          echo "</td></tr>";
          $i++;
            }
} else {
    echo "<br>ผลการค้นหา 0 results";
}
echo "</table>";
mysqli_close($conn);
include('footer.html');
?>

