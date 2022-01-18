<?php
require_once("../HTMLmaker.php");
require_once("../PieceQuantik.php");
require_once("../ArrayPieceQuantik.php");
require_once("../PlateauQuantik.php");
require_once("../ActionQuantik.php");

session_start();


$html = new HTMLmaker();

$set_blanc = &$_SESSION['set_blanc'];
$set_noir = &$_SESSION['set_noir'];
$plateau = &$_SESSION['plateau'];
$couleur = &$_SESSION['couleur'];


