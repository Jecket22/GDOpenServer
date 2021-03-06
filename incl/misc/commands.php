<?php
class Commands {
	private function ownCommand($comment, $command, $accountID, $targetExtID){
		chdir(__DIR__);
		require "../../config/commands.php";
		require_once "../../lib/mainLib.php";
		$gs = new mainLib();
		$commandInComment = strtolower($prefix.$command);
		$commandInPerms = ucfirst(strtolower($command));
		$commandlength = strlen($commandInComment);
		if (substr($comment, 0, $commandlength) == $commandInComment AND (($gs->checkPermission($accountID, "command" . $commandInPerms . "All") OR ($targetExtID == $accountID AND $gs->checkPermission($accountID, "command" . $commandInPerms . "Own"))))) {
			return true;
		}
		return false;
	}
	public function doCommands($accountID, $comment, $levelID) {
		chdir(__DIR__);
		require "../lib/connection.php";
		require "../../config/server.php";
		require "../../config/levels.php";
		require_once "../lib/exploitPatch.php";
		$ep = new exploitPatch();
		require_once "../lib/mainLib.php";
		$gs = new mainLib();
		require_once "../lib/spyc.php";
		if (!is_numeric($accountID) AND !is_numeric($levelID)) {
			exit("temp_0_Error: The level is either corrupted, or you are using hacks as a non-gold user.");
		}
		$query = $db->prepare("SELECT isBanned, banTime FROM users WHERE extID = :id");
		$query->execute([':id' => $accountID]);
		$result = $query->fetch();
		if ($result["isBanned"] == 1) {
			if (($result["banTime"] - $uploadDate) <= 0 AND $result["banTime"] != 0) {
				$banExpired = $db->prepare("UPDATE users SET isBanned = 0, banTime = '', banReason = '' WHERE userID = :userID");
				$banExpired->execute([':userID' => $userID]);
				$query = $db->prepare("INSERT INTO modactions (type, value, value2, value3, value4, timestamp, account) VALUES (15, 1, :value, 0, 'Auto-unban: Ban expired', :timestamp, :id)");
				$query->execute([':value' => $userName, ':timestamp' => $time, ':id' => $gs->getBotAccountID()]);
			} else {
				exit("temp_0_Error: You are banned, meaning you cannot take any moderational actions.");
			}
		}
		$prefixLen = strlen($prefix);
		$comment = strtolower($comment);
		if (substr($comment, 0, $prefixLen) == strtolower($prefix)) {
			$comment = substr_replace($comment, "", 0, $prefixLen);
		} else {
			return false;
		}
		$comment = $ep->remove($comment);
		$commentArray = explode(" ", $comment);
		$uploadDate = time();
		// Getting level owner's account ID
		$query2 = $db->prepare("SELECT extID FROM levels WHERE levelID = :id");
		$query2->execute([':id' => $levelID]);
		$targetExtID = $query2->fetchColumn();
		$aliases = spyc_load_file("cmd/config/commands.yaml");
		$permissions = spyc_load_file("cmd/config/permissions.yaml");
		if (file_exists("cmd/" . $commentArray[0] . ".php")) {
			if ($permissions[$commentArray[0]] == "admin" OR $permissions[$commentArray[0]] != "non-admin" OR !isset($permissions[$commentArray[0]])) {
				$commandFirstUpper = ucfirst(str_replace("un", "", $commentArray[0]));
				if ($gs->checkPermission($accountID, $commandFirstUpper)) {
					include "cmd/" . $commentArray[0] . ".php";
				} else {
					exit("temp_0_Error: You do not have proper permission to use this command.");
				}
			} else {
				$commandPerm = str_replace("un", "", $commentArray[0]);
				if ($this->ownCommand($comment, $commandPerm, $accountID, $targetExtID)) {
					include "cmd/" . $commentArray[0] . ".php";
				} else {
					exit("temp_0_Error: You do not have proper permission to use this command.");
				}
			}
		} else {
			foreach ($aliases as $command => $alias) {
				if (in_array($commentArray[0], $aliases[$command])) {
					if ($permissions[$command] == "admin" OR $permissions[$command] != "non-admin" OR !isset($permissions[$command])) {
						$commandFirstUpper = ucfirst(str_replace("un", "", $command));
						if ($gs->checkPermission($accountID, $commandFirstUpper)) {
							include "cmd/" . $command . ".php";
						} else {
							exit("temp_0_Error: You do not have proper permission to use this command.");
						}
					} else {
						$commandPerm = str_replace("un", "", $command);
						if ($this->ownCommand($comment, $commandPerm, $accountID, $targetExtID)) {
							include "cmd/" . $command . ".php";
						} else {
							exit("temp_0_Error: You do not have proper permission to use this command.");
						}
					}
				}
			}
			return false;
		}
	}
	public function doProfileCommands($accountID, $command) {
		require __DIR__ . "/../lib/connection.php";
		require "../../config/discord.php";
		require "../../config/server.php";
		require_once "../lib/exploitPatch.php";
		$ep = new exploitPatch();
		require_once "../lib/mainLib.php";
		$gs = new mainLib();
		$prefixLen = strlen($prefix);
		if ($discordEnabled == 1 AND substr($command, 0, 7 + $prefixLen) == $prefix . "discord") {
			$commentArray = explode($command, " ");
			switch ($commentArray[1]) {
				case "accept":
					require_once "cmd/discord/accept.php";
					return true;
				case "deny":
					require_once "cmd/discord/deny.php";
					return true;
				case "unlink":
					require_once "cmd/discord/unlink.php";
					return true;
				default:
					return false;
			}
		} else {
			return false;
		}
	}
}
?>
