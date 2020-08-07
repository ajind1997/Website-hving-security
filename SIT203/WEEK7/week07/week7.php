<html>
<head>

<link rel="stylesheet" type="text/css" href="access.css">
</head>

<body>
<h1 class="green">PHP and Oracle databases</h1>
<h4>Table: <em>Plants</em></h4>
<div align="center">
<table width="850" border="0" bgcolor="#339933" cellpadding="5" cellspacing="1">
<tr bgcolor="#006633">
<td width="75" style="color:#ffff99">Drainage</td>
<td width="75" style="color:#ffff99">Aspect</td>
<td width="100" style="color:#ffff99">Temperature</td>
<td width="75" style="color:#ffff99">Height</td>
<td width="75" style="color:#ffff99">Foliage</td>
<td width="200" style="color:#ffff99">Common Name</td>
<td width="250" style="color:#ffff99">Species Name</td>

<?php

/* Set oracle user login and password info */
$dbuser = "ajind"; /* your deakin login */
$dbpass = "ANOOP"; /* your oracle access password */
$db = "SSID";
$connect = oci_connect($dbuser, $dbpass, $db);

if (!$connect) {
echo "An error occurred connecting to the database";
exit;
}

/* build sql statement using form data */
$query = "SELECT * FROM Plants";

/* check the sql statement for errors and if errors report them */
$stmt = oci_parse($connect, $query);
//echo "SQL: $query<br>";
if(!$stmt) {
echo "An error occurred in parsing the sql string.\n";
exit;
}
oci_execute($stmt);

/* Set oracle user login and password info */
$dbuser = "ajind"; /* your deakin login */
$dbpass = "ANOOP"; /* your oracle access password */
$db = "SSID";
$connect = oci_connect($dbuser, $dbpass, $db);

if (!$connect) {
echo "An error occurred connecting to the database";
exit;
}

/* build sql statement using form data */
$query = "SELECT * FROM Plants";

/* check the sql statement for errors and if errors report them */
$stmt = oci_parse($connect, $query);
//echo "SQL: $query<br>";
if(!$stmt) {
echo "An error occurred in parsing the sql string.\n";
exit;
}
oci_execute($stmt);

?>

<?php

// Display all the values in the retrieved records, one record per row, in a loop
while(oci_fetch_array($stmt)) {
// Start a row for each record
echo("<tr valign=top bgcolor=#ccffcc>");
// Output fields, one per column
// Drainage value in column one
$fg1 = oci_result($stmt,"DRAINAGE"); //"Drainage";
echo("<td width=75>");
echo ($fg1);
echo("</td>");
// Aspect value in column two
$fg2 = oci_result($stmt,"ASPECT");//"Aspect";
echo("<td width=75>");
echo ($fg2);
echo("</td>");
// Temperature value in column three
$fg3 = oci_result($stmt,"TEMPERATURE");//"Temperature";
echo("<td width=75>");
echo ($fg3);
echo("</td>");
// Height value in column four
$fg4 = oci_result($stmt,"HEIGHT");//"Height";
echo("<td width=75>");
echo ($fg4);
echo("</td>");
// Foliage value in column five
$fg5 = oci_result($stmt,"FOLIAGE");//"Foliage";
echo("<td width=75>");
echo ($fg5);
echo("</td>");
// Common Name and Photo in column six
$fg6 = oci_result($stmt,"COMMONNAME");//"CommonName";
echo("<td width=250>");
echo ($fg6);
$fg8 = oci_result($stmt,"PHOTO");//"Photo";
// Pictures are in a 'plants' sub-directory elsewhere on the server, so use the full URL
echo ("<br><img src=http://www.deakin.edu.au/~ajind/SIT203/WEEK7/plant_pics/".$fg8."><br>");
echo("</td>");
// Sepcies Name in column seven
$fg7 = oci_result($stmt,"SPECIESNAME");//"SpeciesName";
echo("<td width=250><em>");
echo ($fg7);
echo("</em></td>");

// End the row
echo("</tr>");
}
// Close the connection
oci_close($connect);
?>
</table>
</div>

</body>


</html>