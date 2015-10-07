<?php

/* POVEZIVANJE SA BAZOM PODATAKA; PROJEKAT NA SERVERU */

if (!$db=mysql_connect("localhost", "jpdesig7_sime", "simenikola"))
{
die ("<b>Greška pri spajanju na server: </b>".mysql_error());
}
if (!mysql_select_db("jpdesig7_sime_test", $db))
{
die ("<b>Greška pri odabiru baze: </b>".mysql_error());
}

?>
