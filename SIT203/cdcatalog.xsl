<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Edited with XML Spy v4.2 -->
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" />

<xsl:template match="/">
<!-- output html fragment only instead of a new page
  <html>
  <body>
  -->
  <h2>My CD Collection</h2>
    <table border="1">
      <tr bgcolor="#9acd32">
        <th align="left">Title</th>
        <th align="left">Artist</th>
		<th align="left">Price</th>
      </tr>
      <xsl:for-each select="catalog/cd">
      <tr>
        <td>
			<a href="cdcatalogDetail.php?id={id}"><xsl:value-of select="title"/></a>
			<br />
			<a href="cart.php?action=add&amp;id={id}">Add to cart</a>
			<form method="get" action="cart.php">
				<input type="hidden" name="action" value="add" />
				<input type="hidden" name="id" value="{id}" />
				<input type="submit" value="Add to cart" />
			</form>
		
		</td>
        <td><xsl:value-of select="artist"/></td>
		<td><xsl:value-of select="price"/></td>
      </tr>
      </xsl:for-each>
    </table>
	<!--
  </body>
  </html>
  -->
</xsl:template>
</xsl:stylesheet>