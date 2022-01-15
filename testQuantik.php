<?php
include_once("PieceQuantik.php");
include_once("ArrayPieceQuantik.php");
include_once("PlateauQuantik.php");

echo "Création d'une pièce noire cubique : ";
$piece_cube_noir = PieceQuantik::initBlackCube();

echo $piece_cube_noir;
echo "<br>";

echo "Création d'une pièce blanche sphérique : ";
$piece_sphere_blanche = PieceQuantik::initWhiteSphere();

echo $piece_sphere_blanche;
echo "<br>";

echo "Création d'un set de pièces noires : ";
$set_noir = ArrayPieceQuantik::initPiecesNoires();

echo $set_noir;

echo "Création d'un plateau de jeu : ";
$plateau = new PlateauQuantik();

echo $plateau;