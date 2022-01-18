<?php
require_once("../HTMLmaker.php");
require_once("../PieceQuantik.php");
require_once("../ArrayPieceQuantik.php");
require_once("../PlateauQuantik.php");
require_once("../ActionQuantik.php");

session_start();

if(isset($_GET['reset'])){
    session_unset();
}

if(isset($_SESSION['set_blanc']) && isset($_SESSION['set_noir']) && isset($_SESSION['plateau']) && isset($_SESSION['couleur']) ){
    $set_blanc = &$_SESSION['set_blanc'];
    $set_noir = &$_SESSION['set_noir'];
    $plateau = &$_SESSION['plateau'];
    $couleur = &$_SESSION['couleur'];
}else{
    $_SESSION['set_blanc'] = ArrayPieceQuantik::initPiecesBlanches();
    $_SESSION['set_noir'] = ArrayPieceQuantik::initPiecesNoires();
    $_SESSION['plateau'] = new PlateauQuantik();
    $_SESSION['couleur'] = PieceQuantik::WHITE;

    $set_blanc = &$_SESSION['set_blanc'];
    $set_noir = &$_SESSION['set_noir'];
    $plateau = &$_SESSION['plateau'];
    $couleur = &$_SESSION['couleur'];
}

$actionQuantik = new ActionQuantik($plateau);
if(isset($_GET['coord']) && isset($_SESSION['piece'])){

    $actionQuantik->posePiece(substr($_GET['coord'], 0, 1),substr($_GET['coord'], 2, 1), $set_noir->getPieceQuantik($_SESSION['piece']));
    $set_noir->removePieceQuantik($_SESSION['piece']);
    $_SESSION['couleur'] = PieceQuantik::WHITE;
}

$html = new HTMLmaker();

