<?xml version="1.0"?>
<xsl:stylesheet version="1.0"
xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
  <html>
  <body>
  <h1>Grandma White's Cookies</h1>
    <h2>1 package</h2>
  <table>
  <tr bgcolor ="pink">
  <th style ="text-align:left">calories</th>
  <th style ="text=align:left">fat</th>
  <th style ="text=align:left">cholesterol</th>
  <th style ="text=align:left">sodium</th>
   <th style ="text=align:left">carbohydrates</th>
    <th style ="text=align:left">protein</th>
  
  </tr>

    
	<xsl:for-each select="catalog/cd">
	  <tr bgcolor ="yellow">
      <td><xsl:value-of select="calories"/></td>
      <td><xsl:value-of select="fat"/></td>
	   <td><xsl:value-of select="cholesterol"/></td>
	    <td><xsl:value-of select="sodium"/></td>
		 <td><xsl:value-of select="carbohydrates"/></td>
		  <td><xsl:value-of select="protein"/></td>
    </tr>
</xsl:for-each>
    
 </table>
  
</body>
</html>
</xsl:template>
</xsl:stylesheet>
