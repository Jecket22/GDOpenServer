<?php
chdir(__DIR__);
require "../lib/connection.php";
require_once "../lib/GJPCheck.php";
$GJPCheck = new GJPCheck();
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
//here im getting all the data
if (!empty($_POST["accountID"]) AND !empty($_POST["gjp"])) {
	$id = $ep->remove($_POST["accountID"]);
	$gjp = $ep->remove($_POST["gjp"]);
	$gjpresult = $GJPCheck->check($gjp, $id);
	if ($gjpresult != 1) {
		exit("-1");
	}
} elseif (isset($_POST["udid"]) AND !is_numeric($_POST["udid"])) {
	$id = $ep->remove($_POST["udid"]);
} else {
	exit("-1");
}
$levelDesc = $ep->remove($_POST["levelDesc"]);
if (!empty($_POST["levelID"]) AND is_numeric($_POST["levelID"])) {
	$levelID = $ep->remove($_POST["levelID"]);
} else {
	exit("-1");
}
$userID = $gs->getUserID($id, $userName);
//query
$query = $db->prepare("UPDATE levels SET levelDesc = :levelDesc WHERE levelID = :levelID AND userID = :userID");
$query->execute([':levelID' => $levelID, ':userID' => $userID, ':levelDesc' => $levelDesc]);
echo "1";
?>