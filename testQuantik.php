<?php
include_once("PieceQuantik.php");
include_once("ArrayPieceQuantik.php");
include_once("PlateauQuantik.php");

echo "Création d'une pièce noire cubique : ";
$piece_cube_noir = PieceQuantik::initBlackCube();

echo $piece_cube_noir."\n";
echo "<br>\n";

echo "Création d'une pièce blanche sphérique : ";
$piece_sphere_blanche = PieceQuantik::initWhiteSphere();

echo $piece_sphere_blanche."\n";
echo "<br>\n";

echo "Création d'un set de pièces noires : \n";
$set_noir = ArrayPieceQuantik::initPiecesNoires();

echo $set_noir."\n";

echo "Création d'un plateau de jeu : \n";
$plateau = new PlateauQuantik();


echo $plateau."\n";

