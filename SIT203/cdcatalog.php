<?php
// Include database connection
require_once('inc/global-connect.inc.php');
// Include functions
require_once('inc/functions.inc.php');
//redirect to https, added by Shang 29/08/2011
//redirectToHTTPS();
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<head>
<script>
var xhttp;

function loadXMLDoc(filename)
{

if (window.ActiveXObject)
  {
  xhttp = new ActiveXObject("Msxml2.XMLHTTP");
  }
  
else
  {
  xhttp = new XMLHttpRequest();
  }
  
xhttp.open("GET", filename, false);
try {xhttp.responseType = "msxml-document"} catch(err) {} // Helping IE11
xhttp.send("");
return xhttp.responseXML;

}

function displayResult()
{

xml = loadXMLDoc("cdcatalog.xml");
xsl = loadXMLDoc("cdcatalog.xsl");
// code for IE
if (window.ActiveXObject || xhttp.responseType == "msxml-document")
  {  
  ex = xml.transformNode(xsl);
  document.getElementById("example").innerHTML = ex; 
  }
  
// code for Chrome, Firefox, Opera, etc.
else if (document.implementation && document.implementation.createDocument)
  {
  xsltProcessor = new XSLTProcessor();
  xsltProcessor.importStylesheet(xsl);
  resultDocument = xsltProcessor.transformToFragment(xml, document);
  document.getElementById("example").appendChild(resultDocument);
  }
  
}
</script>
</head>
<body onload="displayResult()">

<h1>passing parameters to url and transform xml in php</h1>

<div id="example" ></div>

<hr>

<h1>passing parameters to url and load db in php</h1>
<?php
function showcdcatalog() {
	global $db;
			
			$sql = "SELECT * FROM cdcatalog" ;
			
			// modified by Shang			
			$stmt = oci_parse($db, $sql); 
  
			if(!$stmt)  {
				echo "An error occurred in parsing the sql string.\n"; 
				exit; 
			  }
			oci_execute($stmt); 

			$output[] = "<table border='1'>
						  <tr bgcolor='#9acd32'>
							<th align='left'>Title</th>
							<th align='left'>Artist</th>							
							<th align='left'>Price</th>							  
						  </tr>";
						  
			while(oci_fetch_array($stmt)) {				

				$title= oci_result($stmt,"TITLE");
				$artist = oci_result($stmt,"ARTIST");
				//$country= oci_result($stmt,"COUNTRY");
				//$company = oci_result($stmt,"COMPANY");
				$price = oci_result($stmt,"PRICE");
				//$year= oci_result($stmt,"YEAR");
				$id = oci_result($stmt,"ID");
				
				$output[] = "<tr>";
				$output[] = "<td>$title <br /> <a href='cart.php?action=add&amp;id=$id'>Add to cart</a>";
				$output[] = "<form method='get' action='cart.php'> ".  			
								"<input type='hidden' name='action' value='add' />".
								"<input type='hidden' name='id' value='$id' /> ".
								"<input type='submit' value='Add to cart' />".
							"</form></td>";
				$output[] = "<td>$artist</td>";
				$output[] = "<td>$price</td>";			
				$output[] = "</tr>";					
			}
			$output[] = "</table>";		
 
	return join("",$output);
}
echo showcdcatalog();

?>

</body>
</html> 