<?php
class mainLib {
	public function getAudioTrack($id) {
		switch ($id) {
			case 0:
				return "Stereo Madness by ForeverBound";
				break;
			case 1:
				return "Back on Track by DJVI";
				break;
			case 2:
				return "Polargeist by Step";
				break;
			case 3:
				return "Dry Out by DJVI";
				break;
			case 4:
				return "Base after Base by DJVI";
				break;
			case 5:
				return "Can't Let Go by DJVI";
				break;
			case 6:
				return "Jumper by Waterflame";
				break;
			case 7:
				return "Time Machine by Waterflame";
				break;
			case 8:
				return "Cycles by DJVI";
				break;
			case 9:
				return "xStep by DJVI";
				break;
			case 10:
				return "Clutterfunk by Waterflame";
				break;
			case 11:
				return "Theory of Everything by DJ Nate";
				break;
			case 12:
				return "Electroman Adventures by Waterflame";
				break;
			case 13:
				return "Club Step by DJ Nate";
				break;
			case 14:
				return "Electrodynamix by DJ Nate";
				break;
			case 15:
				return "Hexagon Force by Waterflame";
				break;
			case 16:
				return "Blast Processing by Waterflame";
				break;
			case 17:
				return "Theory of Everything 2 by DJ Nate";
				break;
			case 18:
				return "Geometrical Dominator by Waterflame";
				break;
			case 19:
				return "Deadlocked by F-777";
				break;
			case 20:
				return "Fingerbang by MDK";
				break;
			case 21:
				return "The Seven Seas by F-777";
				break;
			case 22:
				return "Viking Arena by F-777";
				break;
			case 23:
				return "Airborne Robots by F-777";
				break;
			case 24:
				return "Secret by RobTopGames";
				break;
			case 25:
				return "Payload by Dex Arson";
				break;
			case 26:
				return "Beast Mode by Dex Arson";
				break;
			case 27:
				return "Machina by Dex Arson";
				break;
			case 28:
				return "Years by Dex Arson";
				break;
			case 29:
				return "Frontlines by Dex Arson";
				break;
			case 30:
				return "Space Pirates by Waterflame";
				break;
			case 31:
				return "Striker by Waterflame";
				break;
			case 32:
				return "Embers by Dex Arson";
				break;
			case 33:
				return "Round 1 by Dex Arson";
				break;
			case 34:
				return "Monster Dance Off by F-777";
				break;
			default:
				return "Unknown by DJVI";
				break;
			
		}
	}
	public function getDifficulty($diff, $auto, $demon) {
		if ($auto != 0) {
			return "Auto";
		} elseif ($demon != 0) {
			return "Demon";
		} else {
			switch ($diff) {
				case 0:
					return "N/A";
					break;
				case 10:
					return "Easy";
					break;
				case 20:
					return "Normal";
					break;
				case 30:
					return "Hard";
					break;
				case 40:
					return "Harder";
					break;
				case 50:
					return "Insane";
					break;
				default:
					return "Unknown";
					break;
			}
		}
	}
	public function getDiffFromStars($stars) {
		$auto = 0;
		$demon = 0;
		switch ($stars) {
			case 1:
				$diffname = "Auto";
				$diff = 50;
				$auto = 1;
				break;
			case 2:
				$diffname = "Easy";
				$diff = 10;
				break;
			case 3:
				$diffname = "Normal";
				$diff = 20;
				break;
			case 4:
			case 5:
				$diffname = "Hard";
				$diff = 30;
				break;
			case 6:
			case 7:
				$diffname = "Harder";
				$diff = 40;
				break;
			case 8:
			case 9:
				$diffname = "Insane";
				$diff = 50;
				break;
			case 10:
				$diffname = "Demon";
				$diff = 50;
				$demon = 1;
				break;
			default:
				$diffname = "N/A: " . $stars;
				$diff = 0;
				$demon = 0;
				break;
		}
		return array('diff' => $diff, 'auto' => $auto, 'demon' => $demon, 'name' => $diffname);
	}
	public function getLength($length) {
		switch ($length) {
			case 0:
				return "Tiny";
				break;
			case 1:
				return "Short";
				break;
			case 2:
				return "Medium";
				break;
			case 3:
				return "Long";
				break;
			case 4:
				return "XL";
				break;
			default:
				return "Unknown";
				break;
		}
	}
	public function getGameVersion($version) {
		if ($version > 17) {
			return $version / 10;
		} else {
			$version--;
			return "1.$version";
		}
	}
	public function getDemonDiff($dmn) {
		switch ($dmn) {
			case 3:
				return "Easy";
				break;
			case 4:
				return "Medium";
				break;
			case 0:
			case 1:
			case 2:
				return "Hard";
				break;
			case 5:
				return "Insane";
				break;
			case 6:
				return "Extreme";
				break;
		}
	}
	public function getDiffFromName($name) {
		$name = strtolower($name);
		$starAuto = 0;
		$starDemon = 0;
		$starDifficulty = 0;
		switch ($name) {
			case "na":
				$starDifficulty = 0;
				break;
			case "easy":
				$starDifficulty = 10;
				break;
			case "normal":
				$starDifficulty = 20;
				break;
			case "hard":
				$starDifficulty = 30;
				break;
			case "harder":
				$starDifficulty = 40;
				break;
			case "insane":
				$starDifficulty = 50;
				break;
			case "auto":
				$starDifficulty = 50;
				$starAuto = 1;
				break;
			case "demon":
				$starDifficulty = 50;
				$starDemon = 1;
				break;
		}
		return array($starDifficulty, $starDemon, $starAuto);
	}
	public function getGauntletName($id) {
		switch ($id) {
			case 1:
				$gauntletname = "Fire";
				break;
			case 2:
				$gauntletname = "Ice";
				break;
			case 3:
				$gauntletname = "Poison";
				break;
			case 4:
				$gauntletname = "Shadow";
				break;
			case 5:
				$gauntletname = "Lava";
				break;
			case 6:
				$gauntletname = "Bonus";
				break;
			case 7:
				$gauntletname = "Chaos";
				break;
			case 8:
				$gauntletname = "Demon";
				break;
			case 9:
				$gauntletname = "Time";
				break;
			case 10:
				$gauntletname = "Crystal";
				break;
			case 11:
				$gauntletname = "Magic";
				break;
			case 12:
				$gauntletname = "Spike";
				break;
			case 13:
				$gauntletname = "Monster";
				break;
			case 14:
				$gauntletname = "Doom";
				break;
			case 15:
				$gauntletname = "Death";
				break;
			default:
				$gauntletname = "Unknown";
				break;
		}
		return $gauntletname;
	}

	public function makeTime($time) {
		$time = time() - $time; // to get the time since that moment
		$time = ($time < 1) ? 1 : $time;
		$tokens = array (31536000 => 'year', 2592000 => 'month', 604800 => 'week', 86400 => 'day', 3600 => 'hour', 60 => 'minute', 1 => 'second');
		foreach ($tokens as $unit => $text) {
			if ($time < $unit) continue;
			$numberOfUnits = floor($time / $unit);
			return $numberOfUnits . ' ' . $text . (($numberOfUnits > 1) ? 's' : '');
		}
	}

	public function getUserID($ID, $userName = "Player") {
		require __DIR__ . "/connection.php";
		if (is_numeric($ID)) {
			$register = 1;
		} else {
			$register = 0;
		}
		$query = $db->prepare("SELECT userID FROM users WHERE extID = :id");
		$query->execute([':id' => $ID]);
		$result = $query->fetch();
		if ($query->rowCount() > 0) {
			$userID = $result["userID"];
		} else {
			if ($register == 1) {
				$query = $db->prepare("INSERT INTO users (isRegistered, extID, userName, lastPlayed) VALUES (1, :id, :userName, :lastPlayed)");
				$query->execute([':id' => $ID, ':register' => $register, ':userName' => $this->getAccountName($ID), ':lastPlayed' => time()]);
				$userID = $db->lastInsertId();
			} else {
				$query = $db->prepare("INSERT INTO users (isRegistered, extID, userName, lastPlayed) VALUES (0, :id, :userName, :lastPlayed)");
				$query->execute([':id' => $ID, ':register' => $register, ':userName' => $userName, ':lastPlayed' => time()]);
				$userID = $db->lastInsertId();
			}
		}
		return $userID;
	}
	public function getAccountName($accountID) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT userName FROM accounts WHERE accountID = :id");
		$query->execute([':id' => $accountID]);
		if ($query->rowCount() > 0) {
			$userName = $query->fetchColumn();
		} else {
			$userName = false;
		}
		return $userName;
	}
	public function getUserName($userID) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT userName FROM users WHERE userID = :id");
		$query->execute([':id' => $userID]);
		if ($query->rowCount() > 0) {
			$userName = $query->fetchColumn();
		} else {
			$userName = false;
		}
		return $userName;
	}
	public function getAccountIDFromName($userName) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT accountID FROM accounts WHERE userName LIKE :userName");
		$query->execute([':userName' => $userName]);
		if ($query->rowCount() > 0) {
			$accountID = $query->fetchColumn();
		} else {
			$accountID = 0;
		}
		return $accountID;
	}
	public function getExtID($userID) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT extID FROM users WHERE userID = :id");
		$query->execute([':id' => $userID]);
		if ($query->rowCount() > 0) {
			return $query->fetchColumn();
		} else {
			return 0;
		}
	}
	public function getUserString($userID) {
		require __DIR__ . "/connection.php";
		if ($userID == 0) return "0:Unknown:0";
		$query = $db->prepare("SELECT userName, extID FROM users WHERE userID = :id");
		$query->execute([':id' => $userID]);
		$userdata = $query->fetch();
		if (is_numeric($userdata["extID"])) {
			$extID = $userdata["extID"];
		} else {
			$extID = 0;
		}
		return $userID . ":" . $userdata["userName"] . ":" . $extID;
	}
	public function getSongString($songID) {
		require __DIR__ . "/connection.php";
		$query3 = $db->prepare("SELECT ID, name, authorID, authorName, size, isDisabled, download FROM songs WHERE ID = :songid LIMIT 1");
		$query3->execute([':songid' => $songID]);
		if ($query3->rowCount() == 0) {
			return false;
		}
		$result4 = $query3->fetch();
		if ($result4["isDisabled"] == 1) {
			return false;
		}
		$dl = $result4["download"];
		if (strpos($dl, ':') !== false) {
			$dl = urlencode($dl);
		}
		return "1~|~" . $result4["ID"] . "~|~2~|~" . str_replace("#", "", $result4["name"]) . "~|~3~|~" . $result4["authorID"] . "~|~4~|~" . $result4["authorName"] . "~|~5~|~" . $result4["size"] . "~|~6~|~~|~10~|~" . $dl . "~|~7~|~~|~8~|~1";
	}
	public function sendDiscordPM($receiver, $message) {
		require __DIR__ . "/../../config/discord.php";
		if ($discordEnabled != 1) {
			return false;
		}
		//findind the channel id
		$data = array("recipient_id" => $receiver);																	
		$data_string = json_encode($data);
		$url = "https://discordapp.com/api/v6/users/@me/channels";
		$crl = curl_init($url);
		$headr = array();
		$headr['User-Agent'] = 'CvoltonGDPS (http://pi.michaelbrabec.cz:9010, 1.0)';
		curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "POST");																	 
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data_string);
		$headr[] = 'Content-type: application/json';
		$headr[] = 'Authorization: Bot ' . $bottoken;
		curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1); 
		$response = curl_exec($crl);
		curl_close($crl);
		$responseDecode = json_decode($response, true);
		$channelID = $responseDecode["id"];
		//sending the msg
		$data = array("content" => $message);																	
		$data_string = json_encode($data);
		$url = "https://discordapp.com/api/v6/channels/" . $channelID . "/messages";
		$crl = curl_init($url);
		$headr = array();
		$headr['User-Agent'] = 'CvoltonGDPS (http://pi.michaelbrabec.cz:9010, 1.0)';
		curl_setopt($crl, CURLOPT_CUSTOMREQUEST, "POST");																	 
		curl_setopt($crl, CURLOPT_POSTFIELDS, $data_string);
		$headr[] = 'Content-type: application/json';
		$headr[] = 'Authorization: Bot ' . $bottoken;
		curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1); 
		$response = curl_exec($crl);
		curl_close($crl);
		return $response;
	}
	public function getDiscordAcc($discordID) {
		require __DIR__ . "/../../config/discord.php";
		//getting discord acc info
		$url = "https://discordapp.com/api/v6/users/" . $discordID;
		$crl = curl_init($url);
		$headr = array();
		$headr['User-Agent'] = 'CvoltonGDPS (http://pi.michaelbrabec.cz:9010, 1.0)';
		$headr[] = 'Content-type: application/json';
		$headr[] = 'Authorization: Bot ' . $bottoken;
		curl_setopt($crl, CURLOPT_HTTPHEADER, $headr);
		curl_setopt($crl, CURLOPT_RETURNTRANSFER, 1); 
		$response = curl_exec($crl);
		curl_close($crl);
		$userinfo = json_decode($response, true);
		return $userinfo["username"] . "#" . $userinfo["discriminator"];
	}
	public function randomString($length = 6) {
		$randomString = openssl_random_pseudo_bytes($length);
		if ($randomString == false) {
			$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
			$charactersLength = strlen($characters);
			$randomString = '';
			for ($i = 0; $i < $length; $i++) {
				$randomString .= $characters[rand(0, $charactersLength - 1)];
			}
			return $randomString;
		}
		$randomString = bin2hex($randomString);
		return $randomString;
	}
	public function getAccountsWithPermission($permission) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT roleID FROM roles WHERE $permission = 1 ORDER BY priority DESC");
		$query->execute();
		$result = $query->fetchAll();
		$accountlist = array();
		foreach ($result as &$role) {
			$query = $db->prepare("SELECT accountID FROM roleassign WHERE roleID = :roleID");
			$query->execute([':roleID' => $role["roleID"]]);
			$accounts = $query->fetchAll();
			foreach ($accounts as &$user) {
				$accountlist[] = $user["accountID"];
			}
		}
		return $accountlist;
	}
	public function checkPermission($accountID, $permission) {
		require __DIR__ . "/connection.php";
		//isAdmin check
		$query = $db->prepare("SELECT isAdmin FROM accounts WHERE accountID = :accountID");
		$query->execute([':accountID' => $accountID]);
		$isAdmin = $query->fetchColumn();
		if($isAdmin == 1){
			return true;
		}
		
		$query = $db->prepare("SELECT roleID FROM roleassign WHERE accountID = :accountID");
		$query->execute([':accountID' => $accountID]);
		$roleIDarray = $query->fetchAll();
		$roleIDlist = "";
		foreach($roleIDarray as &$roleIDobject) {
			$roleIDlist .= $roleIDobject["roleID"] . ",";
		}
		$roleIDlist = substr($roleIDlist, 0, -1);
		if ($roleIDlist != "") {
			$query = $db->prepare("SELECT $permission FROM roles WHERE roleID IN ($roleIDlist) ORDER BY priority DESC");
			$query->execute();
			$roles = $query->fetchAll();
			foreach($roles as &$role) {
				if ($role[$permission] == 1) {
					return true;
				} else {
					return false;
				}
			}
		}
		$query = $db->prepare("SELECT $permission FROM roles WHERE isDefault = 1");
		$query->execute();
		$permState = $query->fetchColumn();
		if ($permState == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function isCloudFlareIP($ip) {
		$cf_ips = array(
			'173.245.48.0/20',
			'103.21.244.0/22',
			'103.22.200.0/22',
			'103.31.4.0/22',
			'141.101.64.0/18',
			'108.162.192.0/18',
			'190.93.240.0/20',
			'188.114.96.0/20',
			'197.234.240.0/22',
			'198.41.128.0/17',
			'162.158.0.0/15',
			'104.16.0.0/12',
			'172.64.0.0/13',
			'131.0.72.0/22'
		);
		foreach ($cf_ips as $cf_ip) {
			if (ip_in_range($ip, $cf_ip)) {
				return true;
			}
		}
		return false;
	}
	public function getIP() {
		require __DIR__ . "/../../config/security.php";
		if ($IPChecking == 0) {
			if (isset($_SESSION["accountID"])) {
				return $_SESSION["accountID"];
			} elseif (isset($_POST["accountID"])) {
				return $_POST["accountID"];
			}
		}
		if (isset($_SERVER["HTTP_CF_CONNECTING_IP"]) AND $this->isCloudFlareIP($_SERVER['REMOTE_ADDR'])) {
  			return $_SERVER["HTTP_CF_CONNECTING_IP"];
		}
		return $_SERVER['REMOTE_ADDR'];
	}
	public function checkModIPPermission($permission) {
		require __DIR__ . "/connection.php";
		$ip = $this->getIP();
		$query = $db->prepare("SELECT modipCategory FROM modips WHERE IP = :ip");
		$query->execute([':ip' => $ip]);
		$categoryID = $query->fetchColumn();
		
		$query = $db->prepare("SELECT $permission FROM modipperms WHERE categoryID = :id");
		$query->execute([':id' => $categoryID]);
		$permState = $query->fetchColumn();
		
		if ($permState == 1) {
			return true;
		} else {
			return false;
		}
	}
	public function getFriends($accountID) {
		require __DIR__ . "/connection.php";
		$friendsarray = array();
		//selecting friendships
		$query = $db->prepare("SELECT person1, person2 FROM friendships WHERE person1 = :accountID OR person2 = :accountID");
		$query->execute([':accountID' => $accountID]);
		$result = $query->fetchAll(); //getting friends
		if ($query->rowCount() == 0) {
			return array();
		} else { //oh so you actually have some friends kden
			foreach ($result as &$friendship) {
				$person = $friendship["person1"];
				if ($friendship["person1"] == $accountID) {
					$person = $friendship["person2"];
				}
				$friendsarray[] = $person;
			}
		}
		return $friendsarray;
	}
	public function getMaxValuePermission($accountID, $permission) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT isAdmin FROM accounts WHERE accountID = :accountID");
		$query->execute([':accountID' => $accountID]);
		$isAdmin = $query->fetchColumn();
		if ($isAdmin == 1) {
			return 1;
		}
		$maxvalue = 0;
		$query = $db->prepare("SELECT roleID FROM roleassign WHERE accountID = :accountID");
		$query->execute([':accountID' => $accountID]);
		$roleIDarray = $query->fetchAll();
		$roleIDlist = "";
		foreach ($roleIDarray as &$roleIDobject) {
			$roleIDlist .= $roleIDobject["roleID"] . ",";
		}
		$roleIDlist = substr($roleIDlist, 0, -1);
		if ($roleIDlist != "") {
			$query = $db->prepare("SELECT $permission FROM roles WHERE roleID IN ($roleIDlist) ORDER BY priority DESC");
			$query->execute();
			$roles = $query->fetchAll();
			foreach ($roles as &$role) { 
				if ($role[$permission] > $maxvalue) {
					$maxvalue = $role[$permission];
				}
			}
		}
		return $maxvalue;
	}
	public function getAccountCommentColor($accountID) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("SELECT roleID FROM roleassign WHERE accountID = :accountID");
		$query->execute([':accountID' => $accountID]);
		$roleIDarray = $query->fetchAll();
		$roleIDlist = "";
		foreach ($roleIDarray as &$roleIDobject) {
			$roleIDlist .= $roleIDobject["roleID"] . ",";
		}
		$roleIDlist = substr($roleIDlist, 0, -1);
		if ($roleIDlist != "") {
			$query = $db->prepare("SELECT commentColor FROM roles WHERE roleID IN ($roleIDlist) ORDER BY priority DESC");
			$query->execute();
			$roles = $query->fetchAll();
			foreach ($roles as &$role) {
				if ($role["commentColor"] != "000,000,000") {
					return $role["commentColor"];
				} else {
					return "255,255,255";
				}
			}
		}
		$query = $db->prepare("SELECT commentColor FROM roles WHERE isDefault = 1");
		$query->execute();
		if ($query->rowCount() == 0) {
			return "255,255,255";
		}
		$role = $query->fetch();
		return $role["commentColor"];
	}
	public function rateLevel($accountID, $levelID, $stars, $difficulty, $auto, $demon) {
		require __DIR__ . "/connection.php";
		//lets assume the perms check is done properly before
		$query = $db->prepare("UPDATE levels SET starDemon = :demon, starAuto = :auto, starDifficulty = :diff, starStars = :stars, rateDate = :now WHERE levelID = :levelID");	
		$query->execute([':demon' => $demon, ':auto' => $auto, ':diff' => $difficulty, ':stars' => $stars, ':levelID' => $levelID, ':now' => time()]);
		$query = $db->prepare("INSERT INTO modactions (type, value, value2, value3, timestamp, account) VALUES (1, :value, :value2, :levelID, :timestamp, :id)");
		$query->execute([':value' => $this->getDiffFromStars($stars)["name"], ':timestamp' => time(), ':id' => $accountID, ':value2' => $stars, ':levelID' => $levelID]);
	}
	public function featureLevel($accountID, $levelID, $feature) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("UPDATE levels SET starFeatured = :feature, rateDate = :now WHERE levelID = :levelID");	
		$query->execute([':feature' => $feature, ':levelID' => $levelID, ':now' => time()]);
		$query = $db->prepare("INSERT INTO modactions (type, value, value3, timestamp, account) VALUES (2, :value, :levelID, :timestamp, :id)");
		$query->execute([':value' => $feature, ':timestamp' => time(), ':id' => $accountID, ':levelID' => $levelID]);
	}
	public function verifyCoinsLevel($accountID, $levelID, $coins) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("UPDATE levels SET starCoins = :coins WHERE levelID = :levelID");	
		$query->execute([':coins' => $coins, ':levelID' => $levelID]);
		$query = $db->prepare("INSERT INTO modactions (type, value, value3, timestamp, account) VALUES (3, :value, :levelID, :timestamp, :id)");
		$query->execute([':value' => $coins, ':timestamp' => time(), ':id' => $accountID, ':levelID' => $levelID]);
	}
	public function songReupload($accountID, $url) {
		require __DIR__ . "/connection.php";
		require __DIR__ . "/../../config/reupload.php";
		require_once __DIR__ . "/exploitPatch.php";
		$ep = new exploitPatch();
		if ($songReupload == -1) {
			exit("-3");
		}
		$song = str_replace("www.dropbox.com", "dl.dropboxusercontent.com", $url);
		if (filter_var($song, FILTER_VALIDATE_URL) == true) {
			if (strpos($song, 'soundcloud.com') !== false) {
				$songinfo = file_get_contents("https://api.soundcloud.com/resolve.json?url=" . $song . "&client_id=" . $soundcloudAPIKey);
				$array = json_decode($songinfo);
				if ($array->downloadable == true) {
					$song = trim($array->download_url . "?client_id=" . $soundcloudAPIKey);
					$name = $ep->remove($array->title);
					$author = $array->user->username;
					$author = preg_replace("/[^A-Za-z0-9 ]/", '', $author);
				} else {
					if (!$array->id) {
						return "-4";
					}
					$song = trim("https://api.soundcloud.com/tracks/" . $array->id . "/stream?client_id=" . $soundcloudAPIKey);
					$name = $ep->remove($array->title);
					$author = $array->user->username;
					$author = preg_replace("/[^A-Za-z0-9 ]/", '', $author);
				}
			} else {
				$song = str_replace(["?dl=0", "?dl=1"], "", $song);
				$song = trim($song);
				$name = $ep->remove(urldecode(str_replace([".mp3", ".webm", ".mp4", ".wav"], "", basename($song))));
				$author = "Reupload";
			}
			$size = $this->getFileSize($song);
			$size = round($size / 1024 / 1024, 2);
			$query = $db->prepare("SELECT count(*) FROM songs WHERE download = :download");
			$query->execute([':download' => $song]);	
			$count = $query->fetchColumn();
			if ($count != 0) {
				return "-3";
			}
			if ($songReupload != 0) {
				//checking the amount of reuploads
				if ($isSongReuploadLimitDaily == 1) {
					$dailyTime = strtotime("-1 days", strtotime("00:00:00"));
					$query = $db->prepare("SELECT value2 FROM actions WHERE type = 18 AND value = :accountID AND timestamp > :timestamp");
					$query->execute([':accountID' => $accountID, ':timestamp' => $dailyTime]);
				} else {
					$query = $db->prepare("SELECT value2 FROM actions WHERE type = 18 AND value = :accountID");
					$query->execute([':accountID' => $accountID]);
				}
				
				if ($query->rowCount() == 0) {
					$query = $db->prepare("INSERT INTO actions (type, value, value2, timestamp) VALUES (18, :accountID, 1, :timestamp)");
					$query->execute([':accountID' => $accountID, ':timestamp' => time()]);
					$reuploads = 1;
				} else {
					$reuploads = $query->fetchColumn();
					if ($isSongReuploadLimitDaily == 1) {
						$query = $db->prepare("UPDATE actions SET value2 = " . ($reuploads + 1) . " WHERE type = 18 AND value = :accountID AND timestamp > :timestamp");
						$query->execute([':accountID' => $accountID, ':timestamp' => $dailyTime]);
					} else {
						$query = $db->prepare("UPDATE actions SET value2 = " . ($reuploads + 1) . " WHERE type = 18 AND value = :accountID");
						$query->execute([':accountID' => $accountID]);
					}
				}
			} else {
				$reuploads = -2;
			}
				
			if ($reuploads < $songReupload) {
				$query = $db->prepare("INSERT INTO songs (name, authorID, authorName, size, download) VALUES (:name, 9, :author, :size, :download)");
				$query->execute([':name' => $name, ':download' => $song, ':author' => $author, ':size' => $size]);
				$response = $db->lastInsertId();
				if ($response > 999999) {
					$queryd = $db->prepare("INSERT INTO levels (levelName, gameVersion, binaryVersion, userName, levelDesc, levelVersion, levelLength, audioTrack, auto, password, original, twoPlayer, songID, objects, coins, requestedStars, extraString, levelString, levelInfo, uploadDate, userID, extID, updateDate, unlisted, hostname, isLDM) VALUES (:levelName, 19, 19, :userName, 'QXV0by1HZW5lcmF0ZWQgU29uZyBMZXZlbA==', 1, 0, 0, 0, 0, 0, 0, :songID, 1, 0, 0, '29_29_29_40_29_29_29_29_29_29_29_29_29_29_29_29', '', 0, :uploadDate, :userID, :id, :uploadDate, 1, '127.0.0.1', 0)");
					$queryd->execute([':levelName' => "Song ID ".$db->lastInsertId(), ':userName' => $this->getAccountName($botAID), ':songID' => $db->lastInsertId(), ':uploadDate' => time(), ':userID' => $botUID, ':id' => $botAID]);
					$levelID = $db->lastInsertId();
					file_put_contents("../../data/levels/$levelID", "H4sIAAAAAAAAC6WQ0Q3CMAxEFwqSz4nbVHx1hg5wA3QFhgfn4K8VRfzci-34Kcq-1V7AZnTCg5UeQUBwQc3GGzgRZsaZICKj09iJBzgU5tcU-F-xHCryjhYuSZy5fyTK3_iI7JsmTjX2y2umE03ZV9RiiRAmoZVX6jyr80ZPbHUZlY-UYAzWNlJTmIBi9yfXQXYGDwIAAA==");
					$response .= "Level ID for download: $levelID";
				}
				return $response;
			} else {
				return "-3";
			}
		} else {
			return "-2";
		}
	}
	public function getFileSize($url) {
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		curl_exec($ch);
		$size = curl_getinfo($ch, CURLINFO_CONTENT_LENGTH_DOWNLOAD);
		curl_close($ch);
		return $size;
	}
	public function suggestLevel($accountID, $levelID, $difficulty, $stars, $feat, $auto, $demon) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("INSERT INTO suggest (suggestBy, suggestLevelId, suggestDifficulty, suggestStars, suggestFeatured, suggestAuto, suggestDemon, timestamp) VALUES (:account, :level, :diff, :stars, :feat, :auto, :demon, :timestamp)");
		$query->execute([':account' => $accountID, ':level' => $levelID, ':diff' => $difficulty, ':stars' => $stars, ':feat' => $feat, ':auto' => $auto, ':demon' => $demon, ':timestamp' => time()]);
	}
	public function checkUserBan($ID, $type = 1) {
		require __DIR__ . "/connection.php";
		require __DIR__ . "/../../config/security.php";
		require __DIR__ . "/../../config/users.php";
		switch ($type) {
			case 2:
				$banType = "isLeaderboardBanned";
				$banTime = "leaderboardBanTime";
				$banReason = "leaderboardBanReason";
				break;
			case 3:
				$banType = "isCreatorBanned";
				$banTime = "creatorBanTime";
				$banReason = "creatorBanTime";
				break;
			default:
				$type = 1; 
				$banType = "isBanned";
				$banTime = "banTime";
				$banReason = "banReason";
				break;
		}
		// todo: move acc verification to a different function
		$query = $db->prepare("SELECT $banType, $banTime FROM users WHERE userID = :ID");
		$query->execute([':ID' => $ID]);
		if ($query->rowCount() == 0) {
			return -1;
		}
		$result = $query->fetch();
		if ($result[$banType] == 1) {
			if (($result[$banTime] - time()) <= 0 AND $result[$banTime] != 0) {
				$banExpired = $db->prepare("UPDATE users SET $banType = 0, $banTime = '', $banReason = '' WHERE userID = :userID");
				$banExpired->execute([':userID' => $ID]);
				$query = $db->prepare("INSERT INTO modactions (type, value, value2, value3, value4, timestamp, account) VALUES (15, :type, :value, 0, 'Auto-unban: Ban expired', :timestamp, :id)");
				$query->execute([':type' => $type, ':value' => $userName, ':timestamp' => $uploadDate, ':id' => $this->getBotAccountID]);
				return -1;
			} else {
				return 1;
			}
		} else {
			return -1;
		}
	}
	public function checkAccountBan($accountID, $type = 1) {
		return $this->checkUserBan($this->getUserID($accountID), $type);
	}
	public function checkIPBan() {
		require __DIR__ . "/connection.php";
	}
	public function getBotAccountID() {
		require "../../config/users.php";
		if ($botAID != 0) {
			return $botAID;
		} elseif ($botUID != 0) {
			return $this->getExtID($botUID);
		} else {
			return 0;
		}
	}
	public function getBotUserID() {
		require "../../config/users.php";
		if ($botUID != 0) {
			return $botUID;
		} elseif ($botAID != 0) {
			return $this->getUserID($botAID);
		} else {
			return 0;
		}
	}
	public function getBotUserName() {
		$userName = $this->getAccountName($this->getBotAccountID());
		if ($userName != false) {
			return $userName;
		} else {
			require "../../config/metadata.php";
			return $gdpsName . " Bot";
		}
	}
	public function updateUserLastPlayed($userID) {
		require __DIR__ . "/connection.php";
		$query = $db->prepare("UPDATE users SET lastPlayed = :lastPlayed WHERE userID = :userID");
		$query->execute([':lastPlayed' => time(), ':userID' => $userID]);
	}
	public function updateAccountLastPlayed($accountID) {
		$this->updateUserLastPlayed($this->getUserID($accountID));
	}
	public function checkAccountVerification($ID, $isAccountID = 0) {
		
	}
	public function getWeekStartingDay() {
		require "../../config/server.php";
		switch ($weekStartingDay) {
			case 1:
				$day = "monday";
				break;
			case 2:
				$day = "tuesday";
				break;
			case 3:
				$day = "wednesday";
				break;
			case 4:
				$day = "thursday";
				break;
			case 5:
				$day = "friday";
				break;
			case 6:
				$day = "saturday";
				break;
			case 7:
				$day = "sunday";
				break;
			default:
				$day = "monday"
				break;
		}
		return $day;
	}
}