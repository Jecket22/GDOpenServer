<?php
function hall($uploadDate, $accountID, $levelID) {
    include dirname(__FILE__)."/../../lib/connection.php";
    $query = $db->prepare("UPDATE levels SET starHall='1' WHERE levelID=:levelID");
	$query->execute([':levelID' => $levelID]);
	$query = $db->prepare("INSERT INTO modactions (type, value, value3, timestamp, account) VALUES ('4', '2', :levelID, :timestamp, :id)");
	$query->execute([':timestamp' => $uploadDate, ':id' => $accountID, ':levelID' => $levelID]);
	return true;
}
?>