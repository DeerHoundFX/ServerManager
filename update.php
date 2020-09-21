<?php
    (include_once "includes/header.php");
    include ("includes/SteamFunctions.php");    
    $ranks = array("N/A","PCSO","PPC", "PC", "SPC", "SGT", "Inspector", "Chief Inspector","CMDR", "Superintendent", "Chief Superintendent", "Assistant Commissioner", "Deputy Commissioner", "Commissioner");
    $staff = array("N/A","Support","Moderator","Admin","Staff Lead","Management");
    $MedRanks = array("N/A","Student","Paramedic","Doctor","Surgeon","Medical Director");
    $Banned = array("Not Banned","Currently Banned");
    $steam_key = '481337BCC21BE09405C2D08CC1A8EA8E';
?>

<?php


?>

<?php
include_once 'includes/dbconfig.php';
if(count($_POST)>0) {
mysqli_query($conn,"UPDATE players set adminlevel='" . $_POST['adminlevel'] . "'");
$message = "Player Modified Successfully";
}
$result = mysqli_query($conn,"SELECT * FROM players WHERE pid='" . $_GET['pid'] . "'");
$row= mysqli_fetch_array($result);
?>

<?php



   $steamids = $row ['pid'];

   $steamAPI = new SteamAPI($steam_key);
   $handlerInfo = $steamAPI->GetPlayerInfo($steamids);
   $handlerBans = $steamAPI->GetPlayerBans($steamids);

?>


<html>
<body>
<section class="container">
<div><?php if(isset($message)) { echo $message; } ?>
</div>

<section class='profileoverview'>

<div>
<img class="steam-image" src="<?php echo($handlerInfo[0]['avatar']); ?>" alt="SteamAva">
</div>

<table class="ovitable">
    <tr>
        <td>Steam Name: </td>
        <td><b><?php echo($handlerInfo[0]['personaname']); ?></b><td>
    </tr>

    <tr>
        <td>Steam 64ID: </td>
        <td><b><?php echo($handlerInfo[0]['steamid']); ?></b></td>
    </tr>

    <tr>
        <td>Creation Date: </td>
        <td><b><?php echo($handlerInfo[0]['timecreated']); ?></b></td>
    </tr>

    <tr>
        <td>Last Connected: </td>
        <td><b><?php echo $row['last_seen']; ?></b></td>
    </tr>
    <tr>
        <td><input type="submit" value="Ban Player" class="banbutton"></td>
        <td><input type="submit" value="Kick Player" class="kickbutton"></td>
        <td><input type="submit" value="Wipe Inventory" class="utilitybutton"></td>       
        <td><input type="submit" value="Wipe Data" class="utilitybutton"</td>
    

    </tr>
</table>

<table class="secondovitable">
    <tr>
        <td>Cop Rank: </td>
        <td><b><?php echo $ranks[$row['coplevel']] ?></b><td>
    </tr>

    <tr>
        <td>Medic Rank: </td>
        <td><b><?php echo $MedRanks[$row['mediclevel']]; ?></b></td>
    </tr>

    <tr>
        <td>OpFor Rank: </td>
        <td><b>N/A</b></td>
    </tr>

    <tr>
        <td>Admin Rank: </td>
        <td><b><?php echo $staff[$row['adminlevel']]; ?></b></td>
    </tr>
</table>


</section>

<section class="roster">
    <table>
        <tr class="first">
            <td>Community Bans</td>
            <td>Is VAC Banned</td>
            <td>VAC Bans</td>
            <td>Game Bans</td>            
        </tr>
        <tr>
            <td><?php echo $Banned[($handlerBans[0]['CommunityBanned'])];?></td>
            <td><?php echo $Banned[($handlerBans[0]['VACBanned'])]; ?></td>
            <td><?php echo ($handlerBans[0]['NumberOfVACBans']); ?></td>
            <td><?php echo ($handlerBans[0]['NumberOfGameBans']); ?></td>            
        </tr>
    <table>
</section>

<form class="wrapper" name="frmUser" method="post" action="">
<div class="formgroup">
<label class="formlable" for="adminlevel">Change Admin Rank:</label>

<select name="adminlevel" id="adminlevel">
    
    <option value="0">N/A</option>
    <option value="1">Support</option>
    <option value="2">Moderator</option>
    <option value="3">Admin</option>
    <option value="4">Staff Lead</option>
    <option value="5">Management</option>  
</select>
<input type="submit" value="Submit" class="formbutton">
</div>
</form>
</section>
</body>
</html>