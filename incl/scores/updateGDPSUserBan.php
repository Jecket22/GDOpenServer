<?php
echo "1";
/* require "../lib/connection.php";
require_once "../lib/GJPCheck.php";
$GJPCheck = new GJPCheck();
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
if (isset($_POST["userID"]) AND isset($_POST["accountID"]) AND isset($_POST["gjp"])) {
	$userID = $ep->remove($_POST["userID"]);
	$accountID = $ep->remove($_POST["accountID"]);
	$gjp = $ep->remove($_POST["gjp"]);
	if ($GJPCheck->check($gjp, $id) == 1) {
		$query = $db->prepare("SELECT accountID FROM accounts WHERE userName = :userName");	
		$query->execute([':userName' => $userName]);
		$accountID = $query->fetchColumn();
		if ($gs->checkPermission($accountID, "toolLeaderboardsban")) {
			exit("1");
			if(!is_numeric($userID)){
				exit("Invalid userID");
			}
			$query = $db->prepare("UPDATE users SET isBanned = 1 WHERE userID = :id");
			$query->execute([':id' => $userID]);
			if($query->rowCount() != 0){
				echo "Banned succesfully.";
			}else{
				echo "Ban failed.";
			}
			$query = $db->prepare("INSERT INTO modactions (type, value, value2, timestamp, account) VALUES (15, :userID, 1, :timestamp, :account)");
			$query->execute([':userID' => $userID, ':timestamp' => time(), ':account' => $accountID]);
		} else {
			echo "-1";
		}
	} else {
		echo "-1";
	}
} else {
	echo "-1";
} */
?>