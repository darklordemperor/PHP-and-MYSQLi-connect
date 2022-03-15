
<?php include 'banner.html' ;?>

<hr>
<h1> สูตรคูณ แม่ 90 </h1>
<?php
$mom = 90;
$i=1;
while($i<=12){
    $mux = $mom*$i;
    echo "$mom x $i = ". $mux;
    echo str_repeat('l',$mux/2);
    echo "<br>";
    $i++;
}
echo $mom;
?>
<hr>
<?php include 'footer.html' ;?>
</body>
</html>