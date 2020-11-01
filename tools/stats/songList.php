<table border="1"><tr><th>ID</th><th>Name</th></tr>
<h2>Saved Newgrounds Songs</h2>
<?php
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT ID, name FROM songs WHERE ID < 100000000 ORDER BY ID DESC");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$song){
	echo "<tr><td>".$song["ID"]."</td><td>".htmlspecialchars($song["name"], ENT_QUOTES)."</td></tr>";
}
?>
</table>
<h2>Reuploaded Songs</h2>
<table border="1"><tr><th>ID</th><th>Name</th></tr>
<?php
include "../../incl/lib/connection.php";
$query = $db->prepare("SELECT ID, name FROM songs WHERE ID >= 100000000 ORDER BY ID DESC");
$query->execute();
$result = $query->fetchAll();
foreach($result as &$song){
	echo "<tr><td>".$song["ID"]."</td><td>".htmlspecialchars($song["name"], ENT_QUOTES)."</td></tr>";
}
?>
</table>