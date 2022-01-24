<?php
/**
 * @author Dominique Fournier & Colin PALLIER & Adrien PESTEL
 * Classe maîtresse de l'application
 * gère la session, l'état de jeu etc.
 *
 * GIT : 
 * https://www-apps.univ-lehavre.fr/forge/pallierpestel/quantikphp
 * https://github.com/Adzerty/php-tp-1
 */

require_once("../PieceQuantik.php");
require_once("../PlateauQuantik.php");
require_once("../ActionQuantik.php");
require_once("../ArrayPieceQuantik.php");
require_once("../QuantikException.php");
require_once("../HTMLmaker.php");

session_start();

//Si get contient une variable reset on vide la session pour démarrer une nouvelle partie à vide
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

//Permet d'effectuer les actions sur le plateau
$aq = new ActionQuantik($_SESSION['plateau']);

// on réalise les actions correspondant à l'action en cours :
try {
    if(isset($_GET['action'])) {

        switch ($_GET['action']) {

            case 'choisirJoueur': //Si les joueurs ont décidé du joueur de départ
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
            case 'choisirPiece': //Si le joueur a choisi sa piece
                $_SESSION['etat'] = 'posePiece';

                break;
            case 'poserPiece': //Si le joueur a posé sa piece
                if($_SESSION['etat']!='choixPiece'){
                    ($_SESSION['couleurActive'] == PieceQuantik::WHITE ? $set_actif = &$_SESSION['set_blanc'] : $set_actif = &$_SESSION['set_noir']);

                    $aq->posePiece(substr($_GET['coord'], 0, 1),substr($_GET['coord'], 2, 1), $set_actif->getPieceQuantik($_GET['piece']));
                    $set_actif->removePieceQuantik($_GET['piece']);
                    $_SESSION['coups']++;

                    if($aq->checkWin()) // Test de la victoire
                    {
                        $_SESSION['etat'] = 'victoire';
                    }
                    else {

                        $_SESSION['couleurActive'] = ($_SESSION['couleurActive'] + 1) % 2;
                        $_SESSION['etat'] = 'choixPiece';
                    }
                }
                break;
            case 'annulerChoix': //Si le joueur a annulé son choix de piece
                $_SESSION['etat'] = 'choixPiece';
                break;
            default: //Action interdite
                throw new \quantik\QuantikException("Action non valide");
        }
    }
} catch (\quantik\QuantikException $exception) {
    $_SESSION['etat'] = 'bug';
    $_SESSION['message'] = $exception->__toString();
}

switch($_SESSION['etat']) { //Suivi de l'état du plateau
    case 'choixPiece': //Afficher la page permettant de choisir une piece
        if($aq->canPoserPiece($_SESSION['couleurActive'] == PieceQuantik::BLACK ? $_SESSION['set_noir'] : $_SESSION['set_blanc'])){
            $_SESSION['couleurActive'] == PieceQuantik::WHITE ? pagePieceBlanche() : pagePieceNoire();
        }else{
            pageNul();
        }

        break;
    case 'posePiece': //Afficher la page permettant de poser une piece
        $_SESSION['couleurActive'] == PieceQuantik::WHITE ? pagePosePieceBlanche() : pagePosePieceNoire();
        break;
    case 'choixJoueur': //Afficher la page permettant de choisir un le premier joueur
        pageDebut();
        break;
    case 'victoire': //Afficher la page permettant d'indiquer la victoire
        pageFin();
        break;
    default: // sans doute etape=bug
        pageErreur();
        exit(1);
}

function pageErreur(){
    echo HTMLmaker::getDebutHTML();
    echo HTMLmaker::pageErreur();
    echo HTMLmaker::getFinHTML();

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

function pageNul(){
    echo HTMLmaker::getDebutHTML();

    echo HTMLmaker::getDivNul();

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
