<?php
    include ("dbconfig.php")    
?>

<?php
// Data Wipe Query

$wipePlayer = "UPDATE players SET bankacc=250000 WHERE pid=$steamids";
$steamids = $row['pid'];

if (mysqli_query($conn, $wipePlayer)) {
 echo "Data Wipe Succesful";
} else {
 echo "Error Wiping Data: " . mysqli_error($conn);
}

?>

<?php
exec("ffmpeg -i $wipePlayer");
?>