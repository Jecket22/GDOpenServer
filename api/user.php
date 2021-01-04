<?php
class userAPI {
    function Select() {
        require_once "../incl/lib/exploitPatch.php";
        $ep = new exploitPatch();
        if (isset($_GET["userID"])) {
            $response = $_GET["userID"];
        } elseif (!empty($_POST["userID"])) {
            $response = $_POST["userID"];
        }
        $user = array();
        $userID = $ep->remove($response);
        $data = $db->prepare("SELECT * FROM users WHERE userID = :userID");
        $data->execute(['userID' => $userID]);
        while ($OutputData = $data->fetch(PDO::FETCH_ASSOC)) {
            $user = array(
                'userName' => $OutputData['userName'],
                'accountID' => $OutputData['extID'],
                'userID' => $OutputData['userID'],
                'stars' => $OutputData['stars'],
                'demons' => $OutputData['demons'],
                'secretCoins' => $OutputData['coins'],
                'userCoins' => $OutputData['userCoins'],
                'cp' => $OutputData['creatorPoints'],
                'diamonds' => $OutputData['diamonds'],
                'cube' => $OutputData['accIcon'], 
                'ship' => $OutputData['accShip'],
                'ball' => $OutputData['accBall'],
                'ufo' => $OutputData['accBird'],
                'wave' => $OutputData['accDart'],
                'robot' => $OutputData['accRobot'],
                'spider' => $OutputData['accSpider'],
                'glow' => $OutputData['accGlow'],
                'starLeaderboardBanned' => $OutputData['isBanned'], 
                'creatorLeaderboardBanned' => $OutputData['isCreatorBanned'], 
                'commentBanned' => $OutputData['isCommentBanned'], 
                'commentBanReason' => $OutputData['commentBanReason']
            );
        }
        return json_encode($user);
    }
}

$API = new userAPI;
header('Content-Type: Application/json');
echo $API->Select();
?>
