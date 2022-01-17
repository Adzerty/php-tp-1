<?php
include_once("HTMLmaker.php");
include_once("PieceQuantik.php");
include_once("ArrayPieceQuantik.php");
include_once("PlateauQuantik.php");
include_once("ActionQuantik.php");

$html = new HTMLmaker();

echo $html->getDebutHTML();

$set_blanc = ArrayPieceQuantik::initPiecesBlanches();
echo $html->getDivPiecesDisponibles($set_blanc);

echo $html->getFormSelectionPiece($set_blanc);

$plateau = new PlateauQuantik();
echo $html->getDivPlateauQuantik($plateau);

echo $html->getFinHTML();

