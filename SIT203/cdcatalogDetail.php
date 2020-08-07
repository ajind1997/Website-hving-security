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

<?php
//get paramesters
$id = $_GET["id"];

// load xml file
$xml = new DOMDocument();
$xml->load("cdcatalog.xml");

//load xsl file
$xsl = new DOMDocument();
$xsl->load("cdcatalogDetail.xsl");

// start proc
$proc = new XSLTProcessor();

$proc->importStylesheet( $xsl );

$proc->setParameter(null, "id", $id);
echo $proc->transformToXML( $xml );
//echo $proc->transformToDoc( $xml );

?>

</body>
</html> 