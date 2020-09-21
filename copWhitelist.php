<?php
    (include_once "includes/header.php");    
?>

<?php
    include_once 'includes/dbconfig.php';
    $result = mysqli_query($conn,"SELECT * FROM players");
?>


<body>
<section class="roster">
<table class="stats-table">
<tr class="first">
    <td>Name </td>
    <td>UID</td>
    <td>Last Connected</td>
    <td>Admin Level</td>    
    <td>Options</td>
</tr>
<?php
$i=0;
while($row = mysqli_fetch_array($result)) {
if($i%2==0)
$classname="even";
else
$classname="odd";
?>
<tr class="<?php if(isset($classname)) echo $classname;?>">
    <td><?php echo $row["name"]; ?></td>
    <td><?php echo $row["pid"]; ?></td>
    <td><?php echo $row["last_seen"]; ?></td>
    <td><?php echo $row["adminlevel"]; ?></td>    
    <td class="formbutton"><a href="update.php?pid=<?php echo $row["pid"]; ?>">Manage</a></td>
</tr>
<?php
$i++;
}
?>
</table>
</body>
</html>