<?php
chdir(__DIR__);
echo "Please wait...<br>";
ob_flush();
flush();
set_time_limit(0);
$cplog = "";
$people = array();
$nocpppl = "";
require "../../incl/lib/connection.php";
require "../../config/levels.php";
$query = $db->prepare("SELECT userID, userName FROM users");
$query->execute();
$result = $query->fetchAll();
//getting users
foreach ($result as $user) {
	$userID = $user["userID"];
	//getting starred lvls count
	$query2 = $db->prepare("SELECT count(*) FROM levels WHERE userID = :userID AND starStars != 0 AND isCPShared = 0");
	$query2->execute([':userID' => $userID]);
	$creatorpoints = $query2->fetchColumn();
	$creatorpoints = $creatorpoints * $starCP;
	$cplog .= $user["userName"] . " - " . $creatorpoints . "\r\n";
	//getting featured lvls count
	$query3 = $db->prepare("SELECT count(*) FROM levels WHERE userID = :userID AND starFeatured != 0 AND isCPShared = 0");
	$query3->execute([':userID' => $userID]);
	$cpgain = $query3->fetchColumn();
	$cpgain = $cpgain * $featureCP;
	$creatorpoints = $creatorpoints + $cpgain;
	$cplog .= $user["userName"] . " - " . $creatorpoints . "\r\n";
	//getting epic lvls count
	$query3 = $db->prepare("SELECT count(*) FROM levels WHERE userID = :userID AND starEpic != 0 AND isCPShared = 0");
	$query3->execute([':userID' => $userID]);
	$cpgain = $query3->fetchColumn();
	$cpgain = $cpgain * $epicCP;
	$creatorpoints = $creatorpoints + $cpgain;
	$cplog .= $user["userName"] . " - " . $creatorpoints . "\r\n";
	//getting magic lvls count if its manual
	if ($isMagicSectionManual == 1) {
		$query3 = $db->prepare("SELECT count(*) FROM levels WHERE userID = :userID AND starMagic != 0 AND isCPShared = 0");
		$query3->execute([':userID' => $userID]);
		$cpgain = $query3->fetchColumn();
		$cpgain = $cpgain * $magicCP;
		$creatorpoints = $creatorpoints + $cpgain;
		$cplog .= $user["userName"] . " - " . $creatorpoints . "\r\n";
	}
	//inserting cp value
	if ($creatorpoints != 0) {
		$people[$userID] = $creatorpoints;
	} else {
		$nocpppl .= $userID . ",";
	}
}
/*
	CP SHARING
*/
$query = $db->prepare("SELECT levelID, userID, starStars, starFeatured, starEpic, starMagic FROM levels WHERE isCPShared = 1");
$query->execute();
$result = $query->fetchAll();
foreach ($result as $level) {
	$deservedcp = 0;
	if ($level["starStars"] != 0) {
		$deservedcp += $starCP;
	}
	if ($level["starFeatured"] != 0) {
		$deservedcp += $featureCP;
	}
	if ($level["starEpic"] != 0) {
		$deservedcp += $epicCP;
	}
	if ($isMagicSectionManual == 1 AND $level["starMagic"] != 0) {
		$deservedcp += $magicCP;
	}
	$query = $db->prepare("SELECT userID FROM cpshares WHERE levelID = :levelID");
	$query->execute([':levelID' => $level["levelID"]]);
	$sharecount = $query->rowCount() + 1;
	if ($CPSharedWhole == 1) {
		$addcp = $deservedcp;
	} else {
		$addcp = $deservedcp / $sharecount;
	}
	$shares = $query->fetchAll();
	foreach ($shares as &$share) {
		$people[$share["userID"]] += $addcp;
	}
	$people[$level["userID"]] += $addcp;
}
/*
	NOW to update GAUNTLETS CP
*/
$query = $db->prepare("SELECT level1, level2, level3, level4, level5 FROM gauntlets");
$query->execute();
$result = $query->fetchAll();
//getting gauntlets
foreach ($result as $gauntlet) {
	//getting lvls
	for ($x = 1; $x < 6; $x++) {
		$query = $db->prepare("SELECT userID, levelID FROM levels WHERE levelID = :levelID");
		$query->execute([':levelID' => $gauntlet["level".$x]]);
		$result = $query->fetch();
		//getting users
		if ($result["userID"] != "") {
			$cplog .= $result["userID"] . " - +1\r\n";
			$people[$result["userID"]] += 1;
		}
	}
}
/*
	NOW to update DAILY CP
*/
$query = $db->prepare("SELECT levelID FROM dailyfeatures WHERE timestamp < :time");
$query->execute([':time' => time()]);
$result = $query->fetchAll();
foreach ($result as $daily) {
	//getting lvls
	$query = $db->prepare("SELECT userID, levelID FROM levels WHERE levelID = :levelID");
	$query->execute([':levelID' => $daily["levelID"]]);
	$result = $query->fetch();
	//getting users
	if ($result["userID"] != "") {
		$people[$result["userID"]] += 1;
		$cplog .= $result["userID"] . " - +1\r\n";
	}
}
/*
	DONE
*/
$nocpppl = substr($nocpppl, 0, -1);
if ($nocpppl != "") {
	$query4 = $db->prepare("UPDATE users SET creatorPoints = 0 WHERE userID IN ($nocpppl)");
	$query4->execute();
	echo "Reset CP of $nocpppl <br>";
}
foreach ($people as $user => $cp) {
	$newcp = round($cp);
	$query4 = $db->prepare("UPDATE users SET creatorPoints = :creatorpoints WHERE userID = :userID");
	$query4->execute([':userID' => $user, ':creatorpoints' => $newcp]);
	echo "$user now has $newcp creator points... <br>";
	ob_flush();
	flush();
}
echo "<hr>done";
touch("../logs/cplog.txt");
file_put_contents("../logs/cplog.txt", $cplog);
?>
