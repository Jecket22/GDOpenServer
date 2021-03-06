<?php
chdir(__DIR__);
require "../lib/connection.php";
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
require "../config/misc.php";
$commentstring = "";
$accountid = $ep->remove($_POST["accountID"]);
$page = $ep->remove($_POST["page"]);
$commentpage = $page * 10;
$userID = $gs->getUserID($accountid);
$query = "SELECT comment, userID, likes, isSpam, commentID, timestamp FROM acccomments WHERE userID = :userID ORDER BY timeStamp DESC LIMIT 10 OFFSET $commentpage";
$query = $db->prepare($query);
$query->execute([':userID' => $userID]);
$result = $query->fetchAll();
if ($query->rowCount() == 0) {
	exit("#0:0:0");
}
$countquery = $db->prepare("SELECT count(*) FROM acccomments WHERE userID = :userID");
$countquery->execute([':userID' => $userID]);
$commentcount = $countquery->fetchColumn();
foreach ($result as &$comment1) {
	if ($comment1["commentID"] != "") {
		if ($timestampType == 0) {
			$uploadDate = $gs->makeTime($comment1["timestamp"]);
		} else {
			$uploadDate = date("d/m/Y G:i", $comment1["timestamp"]);
		}
		$commentstring .= "2~" . $comment1["comment"] . "~3~" . $comment1["userID"] . "~4~" . $comment1["likes"] . "~5~0~7~".$comment1["isSpam"] . "~9~" . $uploadDate . "~6~" . $comment1["commentID"] . "|";
	}
}
$commentstring = substr($commentstring, 0, -1);
echo $commentstring . "#" . $commentcount . ":" . $commentpage . ":10";
?>