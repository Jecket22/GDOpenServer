<?php
require "../incl/lib/connection.php";
require_once "../incl/lib/generatePass.php";
$gp = new generatePass();
require_once "../incl/lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../incl/lib/mainLib.php";
$gs = new mainLib();
if (isset($_POST["userName"]) AND isset($_POST["password"]) AND isset($_POST["userID"])) {
	$userName = $ep->remove($_POST["userName"]);
	$password = $ep->remove($_POST["password"]);
	$userID = $ep->remove($_POST["userID"]);
	$pass = $gp->isValidUsrname($userName, $password);
	if ($pass == 1) {
		$query = $db->prepare("SELECT accountID FROM accounts WHERE userName = :userName");	
		$query->execute([':userName' => $userName]);
		$accountID = $query->fetchColumn();
		if ($gs->checkPermission($accountID, "toolLeaderboardsban")) {
			if (!is_numeric($userID)) {
				exit("Invalid userID. <a href='leaderboardsBan.php'>Try again.</a>");
			}
			$query = $db->prepare("UPDATE users SET isLeaderboardBanned = 1 WHERE userID = :id");
			$query->execute([':id' => $userID]);
			if ($query->rowCount() != 0) {
				echo "Banned succesfully. <a href='index.php'> Go back to main tools page.</a>";
			} else {
				echo "Ban failed. <a href='leaderboardsBan.php'>Try again.</a>";
			}
			$query = $db->prepare("INSERT INTO modactions (type, value, value2, timestamp, account) VALUES (15, :userID, 1, :timestamp, :account)");
			$query->execute([':userID' => $userID, ':timestamp' => time(), ':account' => $accountID]);
		} else {
			exit("You do not have the permission to do this action. <a href='leaderboardsBan.php'>Try again.</a>");
		}
	}else{
		echo "Invalid password or non-existant account. <a href='leaderboardsBan.php'>Try again</a>";
	}
} else {
	echo '<form action="leaderboardsBan.php" method="post">
		Your Username: <input type="text" name="userName"><br>
		Your Password: <input type="password" name="password"><br>
		Target UserID: <input type="text" name="userID"><br>
		<input type="submit" value="Ban">
	</form>';
}
?>