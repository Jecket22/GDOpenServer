<?php
$query = $db->prepare("SELECT count(*) FROM dailyfeatures WHERE levelID = :level AND type = 1");
$query->execute([':level' => $levelID]);
if ($query->fetchColumn() != 0) {
	exit("temp_0_Error: This level was a daily level before.");
}
$query = $db->prepare("SELECT timestamp FROM dailyfeatures WHERE timestamp >= :tomorrow AND type = 1 ORDER BY timestamp DESC LIMIT 1");
$query->execute([':tomorrow' => strtotime("next " . $gs->getWeekStartingDay())]);
if ($query->rowCount() == 0) {
	$timestamp = strtotime("next " . $gs->getWeekStartingDay());
} else {
	$timestamp = $query->fetchColumn() + 604800;
}
$query = $db->prepare("INSERT INTO dailyfeatures (levelID, timestamp, type) VALUES (:levelID, :uploadDate, 1)");
$query->execute([':levelID' => $levelID, ':uploadDate' => $timestamp]);
$query = $db->prepare("SELECT isCPShared FROM levels WHERE levelID = :levelID");
$query->execute([':levelID' => $levelID]);
$result = $query->fetch();
if ($result["isCPShared"] == 1 AND $dailyWeeklyCPShared == 1) {
	$query3 = $db->prepare("SELECT userID FROM cpshares WHERE levelID = :levelID");
	$query3->execute([':levelID' => $levelID]);
	if ($CPSharedWhole == 1) {
		$addCP = $starCP;
	} else {
		$sharecount = $query3->rowCount() + 1;
		$addCP = round($starCP / $sharecount);
	}
	$shares = $query->fetchAll();
	foreach ($shares as &$share) {
		$CPShare = round($addCP);
		$query4 = $db->prepare("UPDATE users SET creatorPoints = creatorPoints + :CPShare WHERE userID = :userID");
		$query4->execute([':userID' => $share["userID"], ':CPShare' => $CPShare]);
	}
} else {
	$query4 = $db->prepare("UPDATE users SET creatorPoints = creatorPoints + :creatorpoints WHERE extID = :extID");
	$query4->execute([':extID' => $targetExtID, ':creatorpoints' => $starCP]);
}
$query = $db->prepare("INSERT INTO modactions (type, value, value3, timestamp, account, value2, value4) VALUES (5, 1, :levelID, :timestamp, :id, :dailytime, 1)");
$query->execute([':timestamp' => $uploadDate, ':id' => $accountID, ':levelID' => $levelID, ':dailytime' => $timestamp]);
exit("temp_0_Weekly set for " . date("d/m/Y", $timestamp) . ".");
?>