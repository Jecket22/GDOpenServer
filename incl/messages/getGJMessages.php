<?php
chdir(__DIR__);
require "../lib/connection.php";
require_once "../lib/GJPCheck.php";
$GJPCheck = new GJPCheck();
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
require "../../config/misc.php";
$msgstring = "";
//code begins
$toAccountID = $ep->remove($_POST["accountID"]);
$gjp = $ep->remove($_POST["gjp"]);
$gjpresult = $GJPCheck->check($gjp, $toAccountID);
if ($gjpresult != 1) {
	exit("-1");
}
$page = $ep->remove($_POST["page"]);
$offset = $page * 10;
if (!isset($_POST["getSent"]) OR $_POST["getSent"] != 1) {
	$query = "SELECT * FROM messages WHERE toAccountID = :toAccountID ORDER BY messageID DESC LIMIT 10 OFFSET $offset";
	$countquery = "SELECT count(*) FROM messages WHERE toAccountID = :toAccountID";
	$getSent = 0;
} else {
	$query = "SELECT * FROM messages WHERE accID = :toAccountID ORDER BY messageID DESC LIMIT 10 OFFSET $offset";
	$countquery = "SELECT count(*) FROM messages WHERE accID = :toAccountID";
	$getSent = 1;
}
$query = $db->prepare($query);
$query->execute([':toAccountID' => $toAccountID]);
$result = $query->fetchAll();
$countquery = $db->prepare($countquery);
$countquery->execute([':toAccountID' => $toAccountID]);
$msgcount = $countquery->fetchColumn();
if ($msgcount == 0) {
	exit("-2");
}
foreach ($result as &$message1) {
	if ($message1["messageID"] != "") {
		if ($timestampType == 0) {
			$uploadDate = $gs->makeTime($message1["timestamp"]);
		} else {
			$uploadDate = date("d/m/Y G.i", $message1["timestamp"]);
		}
		if ($getSent == 1) {
			$accountID = $message1["toAccountID"];
		} else {
			$accountID = $message1["accID"];
		}
		$query = $db->prepare("SELECT * FROM users WHERE extID = :accountID");
		$query->execute([':accountID' => $accountID]);
		$result12 = $query->fetchAll()[0];
		$msgstring .= "6:" . $result12["userName"] . ":3:" . $result12["userID"] . ":2:" . $result12["extID"] . ":1:" . $message1["messageID"] . ":4:" . $message1["subject"] . ":8:" . $message1["isNew"] . ":9:" . $getSent . ":7:" . $uploadDate . "|";
	}
}
$msgstring = substr($msgstring, 0, -1);
echo $msgstring . "#" . $msgcount . ":" . $offset . ":10";
?>