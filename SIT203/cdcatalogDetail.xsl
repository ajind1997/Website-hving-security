<?xml version="1.0" encoding="ISO-8859-1"?>
<!-- Edited with XML Spy v4.2 -->
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:output method="html" />

<xsl:param name="id"/>

<xsl:template match="/">
<!-- output html fragment only instead of a new page
  <html>
  <body>
  -->
  
  <!--  
	<cd>
		<id>1</id>
		<title>Empire Burlesque</title>
		<artist>Bob Dylan</artist>
		<country>USA</country>
		<company>Columbia</company>
		<price>10.90</price>
		<year>1985</year>
	</cd>
	-->
  
  <h2>CD Detail</h2>
    <table border="1">
      <tr bgcolor="#9acd32">
        <th align="left">Name</th>
        <th align="left">Product</th>
		<th align="left">Price</th>       
      </tr>
      <xsl:for-each select="catalog/cd[id = $id]">

	  
      <tr>
        <td>
			<xsl:value-of select="title"/><br />
			<a href="cart.php?action=add&amp;id={id}">Add to cart</a> <br /> 			
			or <br />
			<form method="get" action="cart.php"> 			
				<input type="hidden" name="action" value="add" />
				<input type="hidden" name="id" value="{id}" />
				<input type="submit" value="Add to cart" />
			</form>
		</td>
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