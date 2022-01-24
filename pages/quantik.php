<?php
/**
 * @author Dominique Fournier
 * @date janvier 2021
 */

require_once("../PieceQuantik.php");
require_once("../PlateauQuantik.php");
require_once("../ActionQuantik.php");
require_once("../ArrayPieceQuantik.php");
require_once("../QuantikException.php");
require_once("../HTMLmaker.php");

session_start();

if (isset($_GET['reset'])){
    session_unset();
}


if (empty($_SESSION)) { // initialisation des variables de session
    $_SESSION['set_blanc'] = ArrayPieceQuantik::initPiecesBlanches();
    $_SESSION['set_noir'] = ArrayPieceQuantik::initPiecesNoires();
    $_SESSION['plateau'] = new PlateauQuantik();
    $_SESSION['etat'] = 'choixJoueur';

    $_SESSION['message'] = "";
    $_SESSION['coups'] = 0;
}

$pageHTML = "";

$aq = new ActionQuantik($_SESSION['plateau']);

// on réalise les actions correspondant à l'action en cours :
try {
    if (isset($_GET['action'])) {
        switch ($_GET['action']) {
            case 'choisirJoueur':
                if($_GET['joueur']=="blanc"){
                    $_SESSION['couleurActive'] = PieceQuantik::WHITE;
                }elseif ($_GET['joueur']=="noir"){
                    $_SESSION['couleurActive'] = PieceQuantik::BLACK;
                }else{
                    if (rand(0,1)==1){
                        $_SESSION['couleurActive'] = PieceQuantik::WHITE;
                    }else{
                        $_SESSION['couleurActive'] = PieceQuantik::BLACK;
                    }
                }
                $_SESSION['etat'] = 'choixPiece';
                break;
            case 'choisirPiece':
                $_SESSION['etat'] = 'posePiece';

                break;
            case 'poserPiece':
                if($_SESSION['etat']!='choixPiece'){
                    ($_SESSION['couleurActive'] == PieceQuantik::WHITE ? $set_actif = &$_SESSION['set_blanc'] : $set_actif = &$_SESSION['set_noir']);

                    $aq->posePiece(substr($_GET['coord'], 0, 1),substr($_GET['coord'], 2, 1), $set_actif->getPieceQuantik($_GET['piece']));
                    $set_actif->removePieceQuantik($_GET['piece']);
                    $_SESSION['coups']++;

                    if(checkWin($aq)) // Tester la victoire
                    {

                        $_SESSION['etat'] = 'victoire';
                    }
                    else {

                        $_SESSION['couleurActive'] = ($_SESSION['couleurActive'] + 1) % 2;
                        $_SESSION['etat'] = 'choixPiece';
                    }
                }
                break;
            case 'annulerChoix':
                $_SESSION['etat'] = 'choixPiece';
                break;
            default:
                throw new \quantik\QuantikException("Action non valide");
        }
    }
} catch (\quantik\QuantikException $exception) {
    $_SESSION['etat'] = 'bug';
    $_SESSION['message'] = $exception->__toString();
}

switch($_SESSION['etat']) {
    case 'choixPiece':

        if(ActionQuantik::canPoserPiece($_SESSION['couleurActive'] == PieceQuantik::BLACK ? $_SESSION['set_noir'] : $_SESSION['set_blanc'])){
            $_SESSION['couleurActive'] == PieceQuantik::WHITE ? pagePieceBlanche() : pagePieceNoire();
        }else{
            pageFin();
        }

        break;
    case 'posePiece':
        $_SESSION['couleurActive'] == PieceQuantik::WHITE ? pagePosePieceBlanche() : pagePosePieceNoire();
        break;
    case 'choixJoueur':
        pageDebut();
        break;
    case 'victoire':
        pageFin();
        break;
    default: // sans doute etape=bug
        echo QuantikUIGenerator::getPageErreur($_SESSION['message']);
        exit(1);
}

function pagePieceBlanche(){
    echo HTMLmaker::getDebutHTML();

    echo "<div class=\"containerPieces\">";
    echo HTMLmaker::getFormSelectionPiece($_SESSION['set_blanc']);
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_noir']);
    echo "</div>";

    echo HTMLmaker::getDivPlateauQuantik($_SESSION['plateau']);



    echo HTMLmaker::getFinHTML();
}

function pagePieceNoire(){
    echo HTMLmaker::getDebutHTML();

    echo "<div class=\"containerPieces\">";
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_blanc']);
    echo HTMLmaker::getFormSelectionPiece($_SESSION['set_noir']);
    echo "</div>";

    echo HTMLmaker::getDivPlateauQuantik($_SESSION['plateau']);



    echo HTMLmaker::getFinHTML();
}

function pagePosePieceBlanche(){
    echo HTMLmaker::getDebutHTML();

    echo "<div class=\"containerPieces\">";
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_blanc']);
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_noir']);
    echo "</div>";

    echo HTMLmaker::getDivPiecePrise($_SESSION['set_blanc']->getPieceQuantik($_GET['piece']));

    echo HTMLmaker::getFormPlateauQuantik($_SESSION['plateau'], $_SESSION['set_blanc']->getPieceQuantik($_GET['piece']));



    echo HTMLmaker::getFinHTML();
}

function pagePosePieceNoire(){
    echo HTMLmaker::getDebutHTML();

    echo "<div class=\"containerPieces\">";
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_blanc']);
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_noir']);
    echo "</div>";

    echo HTMLmaker::getDivPiecePrise($_SESSION['set_noir']->getPieceQuantik($_GET['piece']));

    echo HTMLmaker::getFormPlateauQuantik($_SESSION['plateau'], $_SESSION['set_noir']->getPieceQuantik($_GET['piece']));



    echo HTMLmaker::getFinHTML();

}

function pageFin(){
    echo HTMLmaker::getDebutHTML();

    echo HTMLmaker::getDivFinPartie();

    echo "<div class=\"containerPieces\">";
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_blanc']);
    echo HTMLmaker::getDivPiecesDisponibles($_SESSION['set_noir']);
    echo "</div>";

    echo HTMLmaker::getDivPlateauQuantik($_SESSION['plateau']);


    echo HTMLmaker::getFinHTML();
}

function pageDebut(){

    echo HTMLmaker::getDebutHTML();
    echo HTMLmaker::getPageDebut();
    echo HTMLmaker::getFinHTML();

}

function checkWin(ActionQuantik $aq){
    $win = false;
    $i = 0;
    while( (! $win) && $i<PlateauQuantik::NBCOLS){
        $win = $aq->isColWin($i) || $aq->isRowWin($i) || $aq->isCornerWin($i);
        $i++;
    }
    return $win;
}