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
echo ("<br><img src=http://www.deakin.edu.au/~shang/SIT203/plant_pics/".$fg8."><br>");
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