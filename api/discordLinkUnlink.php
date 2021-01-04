<?php
require "../incl/lib/connection.php";
require "../config/discord.php";
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();
if ($discordEnabled != 1) {
	exit("Discord integration is disabled.");
}
$discordID = $_GET["discordID"];
$message = "You're not linked to an account.";
$query = $db->prepare("UPDATE accounts SET discordID = 0 WHERE discordID = :discordID");	
$query->execute([':discordID' => $discordID]);
if ($query->rowCount() != 0) {
	$message = "Your GDPS account has been unlinked.";
}
$query = $db->prepare("UPDATE accounts SET discordLinkReq = 0 WHERE discordLinkReq = :discordID");	
$query->execute([':discordID' => $discordID]);
if ($query->rowCount() != 0) {
	$message = "Your link request has been cancelled.";
}
echo $message;
?>