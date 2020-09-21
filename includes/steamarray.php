<?php
  include ("SteamFunctions.php"); 

  $steamids = ('76561198225680140');


  $steam_key = '481337BCC21BE09405C2D08CC1A8EA8E';
  
  $steamAPI = new SteamAPI($steam_key);
  $handler = $steamAPI->GetPlayerBans($steamids);
  
  print_r($handler)
?>

