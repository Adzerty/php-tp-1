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

$set_noir = ArrayPieceQuantik::initPiecesNoires();
echo $html->getDivPiecesDisponibles($set_noir);

echo $html->getFormSelectionPiece($set_blanc);

$plateau = new PlateauQuantik();
echo $html->getDivPlateauQuantik($plateau);

$plateau->setPiece(1,2, PieceQuantik::initBlackCube());

echo $html->getFormPlateauQuantik($plateau, $set_blanc->getPieceQuantik(0));

echo $html->getFinHTML();


