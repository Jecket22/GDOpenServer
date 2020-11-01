<<hr>
<?php
include "../../incl/lib/connection.php";
echo "Initializing auto-ban";
ob_flush();
flush();
$query = $db->prepare("SELECT starStars, coins, starDemon, starCoins FROM levels");
$query->execute();
$levelstuff = $query->fetchAll();
//counting stars
$stars = 0;
$demons = 0;
$coins = 0;
foreach($levelstuff as $level){
	$stars += $level["starStars"];
	if($level["starCoins"] != 0){
		$coins += $level["coins"];
	}
	$demons += $level["starDemon"];
}
// mappack stars
$query = $db->prepare("SELECT stars FROM mappacks");
$query->execute();
$result = $query->fetchAll();
foreach($result as $pack){
	$stars += $pack["stars"];
}
// gauntlet stars
$query = $db->prepare("SELECT level1, level2, level3, level4, level5 FROM gauntlets");
$query->execute();
$result = $query->fetchAll();
foreach($result as $gauntlet){
	foreach($gauntlet as $level){
		$query = $db->prepare("SELECT starStars, starDemon, coins, starCoins FROM levels WHERE levelID = :levelid");
		$query->execute([':levelid' => $level]);
		$result = $query->fetch();
		$stars += $result["starStars"];
		$demons += $result["starDemon"];
		if($result["starCoins"] != 0){
			$coins += $result["coins"];
		}
	}
}
/* daily and weekly stars and demons
$query = $db->prepare("SELECT levelID FROM dailyfeatures WHERE timestamp < :time");
$query->execute([':time' => time()]);
$result = $query->fetchAll();
foreach($result as $daily){
	//getting lvls
	$query = $db->prepare("SELECT starStars, starDemon, coins, starCoins FROM levels WHERE levelID = :levelID");
	$query->execute([':levelID' => $daily["levelID"]]);
	$result = $query->fetch();
	$stars += $result["starStars"];
	$demons += $result["starDemon"];
	if($result["starCoins"] != 0){
		$coins += $result["coins"];
	}
} */
//counting stars
$quarter = floor($stars / 4);
$stars = $stars + 200 + $quarter;
$query = $db->prepare("SELECT userID, userName FROM users WHERE stars > :stars");
$query->execute([':stars' => $stars]);
$result = $query->fetchAll();
echo "<h3>Stars based bans</h3>";
ob_flush();
flush();
//banning ppl
foreach($result as $user){
	$query = $db->prepare("UPDATE users SET isBanned = 1 WHERE userID = :id");
	$query->execute([':id' => $user["userID"]]);
	echo "Banned ".htmlspecialchars($user["userName"], ENT_QUOTES)." - ".$user["userID"]."<br>";
}
//counting coins
echo "<h3>User coins based bans</h3>";
$quarter = floor($coins / 4);
$coins = $coins + 10 + $quarter;
$query = $db->prepare("SELECT userID, userName FROM users WHERE userCoins > :coins");
$query->execute([':coins' => $coins]);
$result = $query->fetchAll();
//counting coins
echo "<h3>User coins based bans</h3>";
ob_flush();
flush();
//banning ppl
foreach($result as $user){
	$query = $db->prepare("UPDATE users SET isBanned = 1 WHERE userID = :id");
	$query->execute([':id' => $user["userID"]]);
	echo "Banned ".htmlspecialchars($user["userName"], ENT_QUOTES)." - ".$user["userID"]."<br>";
}
$quarter = floor($demons / 16);
$demons = $demons + 3 + $quarter;
$query = $db->prepare("SELECT userID, userName FROM users WHERE demons > :demons");
$query->execute([':demons' => $demons]);
$result = $query->fetchAll();
//counting demons
echo "<h3>Demons based bans</h3>";
ob_flush();
flush();
//banning ppl
foreach($result as $user){
	$query = $db->prepare("UPDATE users SET isBanned = 1 WHERE userID = :id");
	$query->execute([':id' => $user["userID"]]);
	echo "Banned ".htmlspecialchars($user["userName"], ENT_QUOTES)." - ".$user["userID"]."<br>";
}
//banips
$query = $db->prepare("SELECT IP FROM bannedips");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$ip){
	if ($ip != "127.0.0.1") {
		$query = $db->prepare("UPDATE users SET isBanned = 1 WHERE IP LIKE CONCAT(:ip, '%')");
		$query->execute([':ip' => $ip["IP"]]);
	}
}
echo "<hr>Auto-ban finished";
ob_flush();
flush();
echo "<hr>Banned everyone with over $stars stars and over $coins user coins and over $demons demons.<hr>";
?>
<hr>