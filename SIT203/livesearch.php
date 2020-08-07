<?php
/* xml example
<pages>
	<link>
		<title>HTML DOM alt Property</title>
		<url>http://www.w3schools.com/htmldom/prop_img_alt.asp</url>
	</link>
	...
</pages>
*/
$xmlDoc=new DOMDocument();
$xmlDoc->load("links.xml");

$x=$xmlDoc->getElementsByTagName('link');

//get the q parameter from URL
$q=$_GET["q"];

//lookup all links from the xml file if length of q>0
//count($anArray) is used to get the size of an array
if (strlen($q)>0)
{
$hint="";
for($i=0; $i<($x->length); $i++)
  {
  $y=$x->item($i)->getElementsByTagName('title');
 $z=$x->item($i)->getElementsByTagName('url');
  //$z=$x->item($i)->getElementsByTagName('id');
  if ($y->item(0)->nodeType==1)
    {
    
	//https://www.w3schools.com/php/func_string_stristr.asp
	//The stristr() function searches for the first occurrence of a string inside another string.
	//This function is case-insensitive. For a case-sensitive search, use strstr() function.
	//
	/*
	stristr(string,search,before_search) //deakin web server php doesn't support "before_search" due to its lower version 5.2.6(?)
	Parameter 		Description
	string 			Required. Specifies the string to search
	search 			Required. Specifies the string to search for. If this parameter is a number, 
					it will search for the character matching the ASCII value of the number
	before_search 	Optional. A boolean value whose default is "false". If set to "true", 
					it returns the part of the string before the first occurrence of the search parameter.
	Return Value: 	Returns the rest of the string (from the matching point), or FALSE, 
					if the string to search for is not found.
	*/
 if (stristr($y->item(0)->childNodes->item(0)->nodeValue,$q))
      {
	  
      if ($hint=="")
        {		
        $hint="<a href='" .
        $z->item(0)->childNodes->item(0)->nodeValue .
        "' target='_blank'>" .
        $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      else
        {
        $hint=$hint . "<br /><a href='" .
        $z->item(0)->childNodes->item(0)->nodeValue .
        "' target='_blank'>" .
        $y->item(0)->childNodes->item(0)->nodeValue . "</a>";
        }
      }
    }
  }
}

// Set output to "no suggestion" if no hint were found
// or to the correct values
if ($hint=="")
  {
  $response="no suggestion";
  }
else
  {
  $response=$hint;
  }

//output the response
echo $response;
?> 