<?php
include_once("../HTMLmaker.php");
include_once("../PieceQuantik.php");
include_once("../ArrayPieceQuantik.php");
include_once("../PlateauQuantik.php");
include_once("../ActionQuantik.php");

$html = new HTMLmaker();
$set_blanc = ArrayPieceQuantik::initPiecesBlanches();
$set_noir = ArrayPieceQuantik::initPiecesNoires();
$plateau = new PlateauQuantik();

echo $html->getDebutHTML();

echo "<div class=\"containerPieces\">";
echo $html->getDivPiecesDisponibles($set_blanc);
echo $html->getDivPiecesDisponibles($set_noir);
echo "</div>";

echo $html->getDivPlateauQuantik($plateau);


echo $html -> getFinHTML();