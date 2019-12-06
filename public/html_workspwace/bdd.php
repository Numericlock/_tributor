<?php
	//$bdd = new PDO('mysql:host=dorachu123.dip.jp/phpmyadmin;dbname=_tributor;charset=utf8', 'distributor', 'distE4C21028');
try
{
	$bdd = new PDO('mysql:host=localhost;dbname=_tributor;charset=utf8', 'root', '');
}
catch(Exception $e)
{
        die('Erreur : '.$e->getMessage());
}
