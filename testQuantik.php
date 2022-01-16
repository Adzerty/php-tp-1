<?php
include_once("PieceQuantik.php");
include_once("ArrayPieceQuantik.php");
include_once("PlateauQuantik.php");
include_once("ActionQuantik.php");

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

echo "Ajout d'une pièce conique noire sur le plateau en position 1|1 : \n";
$action = new ActionQuantik($plateau);
$action->posePiece(1,1, PieceQuantik::initBlackCone());

echo $plateau."\n<br>";

echo "Ajout d'une pièce ronde blanche sur le plateau en position 1|2 : \n";
$action->posePiece(1,2, PieceQuantik::initWhiteSphere());

echo $plateau."\n<br>";

echo "Ajout d'une pièce cubique blanche sur le plateau en position 1|2 : \n";
$action->posePiece(1,2, PieceQuantik::initWhiteCube());

echo $plateau."\n<br>";

echo "Ajout d'une pièce conique blanche sur le plateau en position 3|1 : \n";
$action->posePiece(3,1, PieceQuantik::initWhiteCone());

echo $plateau."\n<br>";


echo "Ajout d'une pièce conique blanche sur le plateau en position 0|2 : \n";
$action->posePiece(0,2, PieceQuantik::initWhiteCone());
echo $plateau."\n<br>";

echo "Ajout d'une pièce cubique blanche sur le plateau en position 0|3 : \n";
$action->posePiece(0,3, PieceQuantik::initWhiteCube());
echo $plateau."\n<br>";

echo "Ajout d'une pièce cylindre blanche sur le plateau en position 1|3 : \n";
$action->posePiece(1,3, PieceQuantik::initWhiteCylindre());
echo $plateau."\n<br>";

echo "Verification de la victoire en NE : \n";
echo $action->isCornerWin(1);

echo $set_noir."\n";

echo "suppression du premier element d'une array de piece quantik";
$set_noir->removePieceQuantik(0);

echo $set_noir."\n";

echo $set_noir->getPieceQuantik(0);