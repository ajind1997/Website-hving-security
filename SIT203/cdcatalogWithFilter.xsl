<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Edited with XML Spy v4.2 -->
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" />

<xsl:param name="priceName"/>
<xsl:param name="productValue"/>


<xsl:template match="/">
<!-- output html fragment only instead of a new page
  <html>
  <body>
  -->
  <h2>My products</h2>
    <table border="1">
      <tr bgcolor="#9acd32">
        <th align="left">Name</th>
        <th align="left">Product</th>
		<th align="left">Price</th>
      </tr>
      <xsl:for-each select="catalogue/furniture[price = $priceName]">

	  <xsl:sort select="price" data-type="number" order="{$sortValue}" />
      <tr>
        <td><xsl:value-of select="name"/></td>
        <td><xsl:value-of select="product"/></td>
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