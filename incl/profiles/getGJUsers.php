<?php
chdir(__DIR__);
require "../lib/connection.php";
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
$str = $ep->remove($_POST["str"]);
$page = $ep->remove($_POST["page"]);
$userstring = "";
$usrpagea = $page * 10;
$query = $db->prepare("SELECT userName, userID, coins, userCoins, icon, color1, color2, iconType, special, extID, stars, creatorPoints, demons, isCreatorBanned FROM users WHERE userID = :str OR userName LIKE CONCAT('%', :str, '%') ORDER BY stars DESC LIMIT 10 OFFSET $usrpagea");
$query->execute([':str' => $str]);
$result = $query->fetchAll();
if (count($result) < 1) {
	exit("-1");
}
$countquery = $db->prepare("SELECT count(*) FROM users WHERE userName LIKE CONCAT('%', :str, '%')");
$countquery->execute([':str' => $str]);
$usercount = $countquery->fetchColumn();
foreach ($result as &$user) {
	if ($user["isCreatorBanned"] == 1) {
		$creatorPoints = 0;
	} else {
		$creatorPoints = round($user["creatorPoints"], PHP_ROUND_HALF_DOWN);
	}
	$userstring .= "1:" . $user["userName"] . ":2:" . $user["userID"] . ":13:" . $user["coins"] . ":17:" . $user["userCoins"] . ":9:" . $user["icon"] . ":10:" . $user["color1"] . ":11:" . $user["color2"] . ":14:" . $user["iconType"] . ":15:" . $user["special"] . ":16:" . $user["extID"] . ":3:" . $user["stars"] . ":8:" . $creatorPoints . ":4:" . $user["demons"] . "|";
}
$userstring = substr($userstring, 0, -1);
echo $userstring . "#" . $usercount . ":" . $usrpagea . ":10";
?>