<?php
chdir(__DIR__);
require "../lib/connection.php";
require_once "../lib/GJPCheck.php";
$GJPCheck = new GJPCheck();
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
if (!isset($_POST["gjp"]) OR !isset($_POST["accountID"]) OR !isset($_POST["rating"]) OR !isset($_POST["levelID"])) {
	exit("-1");
}
$gjp = $ep->remove($_POST["gjp"]);
$id = $ep->remove($_POST["accountID"]);
$gjpresult = $GJPCheck->check($gjp, $id);
if ($gjpresult != 1 OR $gs->checkPermission($id, "actionRateDemon") == false) {
	exit("-1");
}
$rating = $ep->remove($_POST["rating"]);
$levelID = $ep->remove($_POST["levelID"]);
switch ($rating) {
	case 1:
		$dmn = 3;
		$dmnname = "Easy";
		break;
	case 2:
		$dmn = 4;
		$dmnname = "Medium";
		break;
	case 3:
		$dmn = 0;
		$dmnname = "Hard";
		break;
	case 4:
		$dmn = 5;
		$dmnname = "Insane";
		break;
	case 5:
		$dmn = 6;
		$dmnname = "Extreme";
		break;
}
$query = $db->prepare("UPDATE levels SET starDemonDiff = :demon WHERE levelID = :levelID");	
$query->execute([':demon' => $dmn, ':levelID' => $levelID]);
$query = $db->prepare("INSERT INTO modactions (type, value, value3, timestamp, account) VALUES (10, :value, :levelID, :timestamp, :id)");
$query->execute([':value' => $dmnname, ':timestamp' => time(), ':id' => $id, ':levelID' => $levelID]);
echo $levelID;
?>