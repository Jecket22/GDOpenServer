<?php
chdir(__DIR__);
require "../lib/connection.php";
require_once "../lib/exploitPatch.php";
$ep = new exploitPatch();
require_once "../lib/mainLib.php";
$gs = new mainLib();
if (empty($_POST["songID"])) {
	exit("-1");
}
$songID = $ep->remove($_POST["songID"]);
$query3 = $db->prepare("SELECT ID, name, authorID, authorName, size, isDisabled, download FROM songs WHERE ID = :songid LIMIT 1");
$query3->execute([':songid' => $songID]);
if ($query3->rowCount() == 0) {
	if ($songID > 9000000) exit("-1"); // Generally speaking, you don't wanna check for non-existing songs or else it will load indefinitely
	// Fixed by WOSHIZHAZHA120
	$url = 'http://www.boomlings.com/database/getGJSongInfo.php';
	$data = array('songID' => $songID, 'secret' => 'Wmfd2893gb7');
	$options = array(
		'http' => array(
			'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
			'method'  => 'POST',
			'content' => http_build_query($data),
		),
	);
	$context = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
	if ($result == "-2" OR $result == "-1" OR $result == "") {
		$url = 'http://www.boomlings.com/database/getGJLevels21.php';
		$data = array(
			'gameVersion' => '21',
			'binaryVersion' => '33',
			'gdw' => '0',
			'type' => '2',
			'str' => '',
			'diff' => '-',
			'len' => '-',
			'page' => '0',
			'total' => '9999',
			'uncompleted' => '0',
			'onlyCompleted' => '0',
			'featured' => '0',
			'original' => '0',
			'twoPlayer' => '0',
			'coins' => '0',
			'epic' => '0',
			'song' => $songID,
			'customSong' => '1',
			'secret' => 'Wmfd2893gb7'
		);

		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		$result = curl_exec($ch);
		curl_close($ch);
		if (substr_count($result, "1~|~" . $songID . "~|~2") != 0) {
			$result = explode('#', $result)[2];
		} else {
			$ch = curl_init(); 
			curl_setopt($ch, CURLOPT_URL, "https://www.newgrounds.com/audio/listen/" . $songID); 
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
			$songinfo = curl_exec($ch);
			curl_close($ch);
			if (empty(explode('"url":"', $songinfo)[1])) {
				exit("-1");
			}
			$songurl = explode('","', explode('"url":"', $songinfo)[1])[0];
			$songauthor = explode('","', explode('artist":"', $songinfo)[1])[0];
			$songurl = str_replace("\/", "/", $songurl);
			$songname = explode("<title>", explode("</title>", $songinfo)[0])[1];
			if ($songurl == "") {
				exit("-1");
			}
			$size = $gs->getFileSize($songurl);
			$result = "1~|~" . $songID . "~|~2~|~" . $songname . "~|~3~|~1234~|~4~|~" . $songauthor . "~|~5~|~" . $size . "~|~6~|~~|~10~|~" . $songurl . "~|~7~|~~|~8~|~1";
		}
	}
	$resultfixed = str_replace("~", "", $result);
	$resultarray = explode('|', $resultfixed);
	$query = $db->prepare("INSERT INTO songs (ID, name, authorID, authorName, size, download) VALUES (:id, :name, :authorID, :authorName, :size, :download)");
	$query->execute([':id' => $resultarray[1], ':name' => $resultarray[3], ':authorID' => $resultarray[5], ':authorName' => $resultarray[7], ':size' => $resultarray[9], ':download' => $resultarray[13]]);
	echo $result;
} else {
	$result4 = $query3->fetch();
	if ($result4["isDisabled"] == 1) {
		exit("-2");
	}
	$dl = $result4["download"];
	if (strpos($dl, ':') !== false) {
		$dl = urlencode($dl);
	}
	echo "1~|~" . $result4["ID"] . "~|~2~|~" . $result4["name"] . "~|~3~|~" . $result4["authorID"] . "~|~4~|~" . $result4["authorName"] . "~|~5~|~".$result4["size"] . "~|~6~|~~|~10~|~" . $dl . "~|~7~|~~|~8~|~0";
}
?>
