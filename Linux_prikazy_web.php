<?php
/*
#===================================================================
# Názov: Web interface pre vykonávanie príkazov pomocou linux systému
# Autor: KillerXCoder (Peter Federl)
# E-Mail: peter.federl@gmail.com
#===================================================================
*/
$servername = 'localhost';
$username = '';
$password = '';
$dbname = '';
$conn = new mysqli($servername, $username, $password, $dbname);
$conn -> set_charset("utf8");
$sql = "SELECT * FROM antibot ORDER BY id DESC";
$result = $conn->query($sql);


echo '<style>

.padd th, .padd td { padding: 10px 10px; vertical-align: middle }
.lh { line-height: 24px; }

.color tr:nth-child(even) { background: #ebebeb; }
.color tr:nth-child(odd) { background: #FFF; border: none;}

.mnu th { padding: 0; color: white; transition: 0.25s ease-out; background: #2A2A2A; border: none;  vertical-align: middle }
.mnu th:first-child { border-right: 1px solid rgba(255, 255, 255, 0.1); }
.mnu th:hover { background: #E64946 }
.mnu a, .mnu a:hover { padding: 10px 10px; color: white; text-decoration: none; display: block; height: 100% width: 100%; }

</style>';
echo '
<style>
.pagination {

}

.pagination a {
  color: black;
  float: left;
  padding: 8px 16px;
  text-decoration: none;
  transition: background-color .3s;
  border: 1px solid #ddd;
}

.pagination a.active {
  background-color: #4CAF50;
  color: white;
  border: 1px solid #4CAF50;
 }
.hladat{
  width: 20%;
  padding: 10px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  border-radius: 4px;
  box-sizing: border-box;
}
.potvrdit{
  width: 10%;
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
}
.pravidla{

  width: 10%;
  background-color: #303030;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  color:white !IMPORTANT;
  text-decoration:none !IMPORTANT;
}
.pravidla:hover{

  width: 10%;
  background-color: #ff0000;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  color:white !IMPORTANT;
  text-decoration:none !IMPORTANT;
}

@media all and (max-width: 694px) {
	.pravidla{

	display:block;
	margin:0px;
	width: 90%;
	}
	
	.pravidla:hover{

	background-color: #ff0000;
	display:block;
	margin:0px;
	width: 90%;

	}
}

</style>';
echo "<h1 style='text-align:center;'>AntiBot výnimky</h1><br>";
echo "<h2 style='text-align:center; font-weight:bold;color:red;'> !! Výnimku vlož iba vtedy ak vieš že Bungeecord beží / neplánuje sa reštartovať najbližších 5 minút !!</h2></p>";
echo '<br>
<form style="text-align:center" method="get">
  <input type="search" class="hladat" placeholder="Nick…" value="" name="nick" style="float:center">
  <input type="search" class="hladat" placeholder="IP…" value="" name="ip" style="float:center">
  <br>
  <input type="submit" class="potvrdit" value="Vložiť" style="float:center">
  </form>';
  
  
  
if (isset($_GET['nick']) and isset($_GET['ip'])) {
	$sql2 = "INSERT INTO antibot (prikaz) VALUES ('abd whitelist add ". $_GET['nick'] ." " . $_GET['ip'] ."')";
	$conn->query($sql2);
	header("Location: https://midascraft.sk/administracia-serveru-crossout/antibot/");
}

echo '<br><br>';
echo '<div style="overflow-x:auto !IMPORTANT;">';
echo '<table class="widefat color padd"><tbody>';
echo '<tr><th width=80% style="text-align: center">Príkaz</th><th width=20% style="text-align: center">Vykonané</th></tr>';

if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		
		echo '<tr><td align="center">'. $row['prikaz'] .'</td>';
		
		if($row['vykonane'] == 0){
			echo '<td align="center" style="background-color:red;">NIE</td>';
		}
		else{
			echo '<td align="center" style="background-color:green;">ÁNO</td>';
		}
		
		echo'</tr>';
	}
} 
else
{
	echo "prazdna tabulka";
}
echo '</tbody></table>';
echo '</div>';
$conn->close();
?>