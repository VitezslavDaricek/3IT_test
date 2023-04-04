<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Test</title>
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.tabs.min.css" rel="stylesheet" type="text/css">
<script src="jQueryAssets/jquery-1.11.1.min.js"></script>
<script src="jQueryAssets/jquery.ui-1.10.4.tabs.min.js"></script>
</head>

<body>
	
<div id="Tabs1">
  <ul>
    <li><a href="#tabs-1">Seznam</a></li>
    <li><a href="#tabs-2">Datový soubor</a></li>
  </ul>
  <div id="tabs-1">
	  <!-- Zobrazení stažených záznamů, seřazené chronologicky  -->
    <?php
require_once ('./config.php'); 
$result = $mysqli->query("SELECT * FROM data ORDER BY prijmeni ASC ");
echo $mysqli->error;
while ($myrow = $result->fetch_array()) {							
//exit;														
$jmeno = $myrow['jmeno'];
$prijmeni = $myrow['prijmeni'];
$date = $myrow['date'];
		
echo '<table width="500" border="0"><tbody><tr><td width="200">';
echo '<input type="checkbox" onclick="checkBoxColorRow(this);"/>';
echo $prijmeni;
echo '</td><td width="200">';
echo $jmeno;
echo '</td><td width="100">';
echo $date;
	
echo '</td></tr></tbody></table>';	
	
}
?>
  </div>
	
   <!-- Stažení dat z datového souboru -->
  <div id="tabs-2">
	<form method="post" enctype="multipart/form-data">
   		<div align="center">  
    		<input type="file" name="file" />
    		<br /><br />
    		<input type="submit" name="submit" value="Import" class="btn btn-info" />
   		</div>
  	</form>
	  
	<?php  
include('./config.php');  
	  
if(isset($_POST["submit"]))
{
if($_FILES['file']['name'])
{
  $filename = explode(".", $_FILES['file']['name']);
  if($filename[1] == 'csv')
  {
   $handle = fopen($_FILES['file']['tmp_name'], "r");
   while($data = fgetcsv($handle))
   {
    	$item1 = mysqli_real_escape_string($mysqli, $data[0]);  
        $item2 = mysqli_real_escape_string($mysqli, $data[1]);
        $item3 = mysqli_real_escape_string($mysqli,$data[2]);
	   	$item4 = mysqli_real_escape_string($mysqli,$data[3]);
	   	$query = "INSERT into data(id,jmeno,prijmeni,date) values('$item1','$item2','$item3','$item4')";
	   		echo $query;
            mysqli_query($mysqli, $query);
   }
   fclose($handle);
   echo "<script>alert('Import done');</script>";
  }
}
}
?>
  </div>
</div>
<script type="text/javascript">
$(function() {
	$( "#Tabs1" ).tabs(); 
});
	
// Přidání funkce pro označení řádků, které mají být podbarveny	
function checkBoxColorRow(result)
{
	if(result.checked)
	{
		result.parentNode.parentNode.style.backgroundColor="lightgreen";
		result.parentNode.parentNode.style.color="black";
	}
	else 
	{
		result.parentNode.parentNode.style.backgroundColor="";
		result.parentNode.parentNode.style.color="";
	}
}
</script>
</body>
</html>

