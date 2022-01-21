<?php
/**
 * @author : Colin PALLIER & Adrien PESTEL
 * Classe permettant de créer un HTML
 * https://github.com/Adzerty/php-tp-1
 */

class HTMLmaker
{
    public function __construct(){}

    public static function getDebutHTML():string{
        $retour = "<!DOCTYPE html>\n";
        $retour .= "<html lang=\"fr\" dir=\"lt\">\n";
        $retour .= "\t<head>\n";
        $retour .= "\t\t<meta charset=\"utf-8\">";
        $retour .= "\t\t<link rel=\"stylesheet\" href=\"../style/style.css\" />";
        $retour .= "\t\t<title>Quantik</title>";
        $retour .= "\t</head>";
        $retour .= "\t<body>";
        $retour .= "<div class='logo'><img src='../img/logo.png' alt='Quantik'></div>";

      return $retour;
    }

    public static function getFinHTML():string{
        $retour = "\t</body>\n";
        $retour .= "</html>";
        return $retour;
    }

    public static function getPageDebut():string{
        $retour = "<div class='panelDebut'>";
        $retour .= "<h2>Parametre de jeu</h2>";
        $retour .= "<h3>Quel joueur commence ?</h3>";
        $retour .= "<form method='GET' action='quantik.php'>";
        $retour .= "<input type='hidden' name='action' value='choisirJoueur'>\n";
        $retour .= "<p><input type='radio'  name='joueur' value='blanc' checked>";
        $retour .= "<label>Blanc</label></p>";
        $retour .= "<p><input type='radio'  name='joueur' value='noir'>";
        $retour .= "<label>Noir</label></p>";
        $retour .= "<p><input type='radio'  name='joueur' value='alea'>";
        $retour .= "<label>Aleatoire</label></p>";
        $retour .= "<input type='submit' class='button' value='Jouer'>";
        $retour .= "</from>";
        $retour .= "</div>";

        return $retour;
    }

    public static function getDivPiecePrise(PieceQuantik $piece):string{
        $retour = "<div class='piecePrise' action='quantik.php'>\n";
        $retour .= "<img src='../img/".$piece->getCouleur()."_".$piece->getForme().".png'/>";
        $retour .= "<form action = 'quantik.php'>\n";
        $retour .= "<input type='hidden' name='action' value='annulerChoix'>\n";
        $retour .= "<input type='submit' value='Changer de piece'>\n";
        $retour .= "</form>\n";
        $retour .= "</div>\n";

        return $retour;
    }


    public static function getDivPiecesDisponibles(ArrayPieceQuantik $array):string{

        $indiceFirstRealPiece = 0;
        while($indiceFirstRealPiece<$array->getTaille() && $array->getPieceQuantik($indiceFirstRealPiece)->getForme() == 0)
            $indiceFirstRealPiece++;


        if ($array->getPieceQuantik($indiceFirstRealPiece)->getCouleur() == 0){
            $retour = "<div class='pieceDispos' id=\"piecesBlanche\">\n";
            $retour .= "<h3>Pieces Blanches</h3>";
        }else{
            $retour = "<div class='pieceDispos' id=\"piecesNoir\">\n";
            $retour .= "<h3>Pieces Noires</h3>";
        }

        for($i = 0; $i<$array->getTaille(); $i++){
            $retour.="\t<button type='submit' name='active' disabled > <img src='../img/".$array->getPieceQuantik($i)->getCouleur()."_".$array->getPieceQuantik($i)->getForme().".png'>"."</button>\n";
        }
        $retour .= "</div>\n";

        return $retour;
    }

    public static function getFormSelectionPiece(ArrayPieceQuantik $arrayPieceQuantik):string{

        $indiceFirstRealPiece = 0;
        while($indiceFirstRealPiece<$arrayPieceQuantik->getTaille() && $arrayPieceQuantik->getPieceQuantik($indiceFirstRealPiece)->getForme()==0)
            $indiceFirstRealPiece++;

        if ($arrayPieceQuantik->getPieceQuantik($indiceFirstRealPiece)->getCouleur() == 0){
            $retour = "<div class='pieceDispos' id=\"piecesBlanche\">\n";
            $retour .= "<h3>Pieces Blanches</h3>";
        }else{
            $retour = "<div class='pieceDispos' id=\"piecesNoir\">\n";
            $retour .= "<h3>Pieces Noires</h3>";
        }
        $retour .= "<form method=\"GET\" action=\"quantik.php\">\n";
        $retour .= "<input type='hidden' name='action' value='choisirPiece'>\n";


        for($i = 0; $i<$arrayPieceQuantik->getTaille(); $i++){
            $retour.="\t<button type='submit' name='piece' value='".$i."'".($arrayPieceQuantik->getPieceQuantik($i)->getForme() == 0 ? "disabled":"")."> <img src='../img/".$arrayPieceQuantik->getPieceQuantik($i)->getCouleur()."_".$arrayPieceQuantik->getPieceQuantik($i)->getForme().".png'>"."</button>\n";
        }

        $retour .= "</form>\n";
        $retour .= "</div>";


        return $retour;
    }

    public static function getDivPlateauQuantik(PlateauQuantik $plateau):string{
        $retour = "<div class='plateau'>\n";
        $retour .= "\t".$plateau."\n";
        $retour .= "</div>\n";

        return $retour;
    }

    public static function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece):string{
        $retour  = "<div class=\"plateau\">";

        $retour .= "<form class='form-plateau' action='quantik.php'>\n";
        $retour .= "<input type='hidden' name='action' value='poserPiece'>\n";
        $retour .= "<input type='hidden' name='piece' value='".$_GET['piece']."'>\n";

        /*
        if ($piece->getCouleur() == 0){
            $retour .= "<form class='form-plateau' action=\"pagePieceNoire.php\">\n"; // doit envoyer vers un choix de piece noire
        }else{
            $retour .= "<form class='form-plateau' action=\"pagePieceBlanche.php\">\n"; //doit envoyer vers un choix de piece blanche
        }
        */


        $retour .= "\t<table>\n";

        $head = "<thead><th></th>";
        for($i = 0; $i<PlateauQuantik::NBCOLS; $i++){
            $head.="<th>$i</th>";
        }
        $head .= "</thead>";
        $retour.=$head;

        $action = new ActionQuantik($plateau);

        for($i = 0; $i<PlateauQuantik::NBROWS; $i++){
            $retour .= "\t\t<tr><th>$i</th>\n";

            for($j = 0; $j<PlateauQuantik::NBCOLS; $j++){
                if($action->isValidatePose($i, $j, $piece)){
                    $retour .= "\t\t\t<td style='border: 2px solid #000; width: 75px; height:75px'>
                            <button class='form-plateau-btn-enabled' type='submit' name='coord' value='$i-$j' >"."<img src='../img/".$plateau->getPiece($i,$j) ->getCouleur()."_".$plateau->getPiece($i,$j) ->getForme().".png'>"."</button></td>\n";
                }else{
                    $retour .= "\t\t\t<td style='border: 2px solid #000; width: 75px; height:75px'>
                            <button class='form-plateau-btn-disabled' disabled>"."<img src='../img/".$plateau->getPiece($i,$j) ->getCouleur()."_".$plateau->getPiece($i,$j) ->getForme().".png'>"."</button></td>\n";
                }
            }
            $retour .= "\t\t</tr>\n";
        }
        $retour .= "</table>";
        $retour .= "</form>";
        $retour .= "</div>";
        return $retour;
    }

    public static function getDivFinPartie():string{
        $retour  = "<form class='fin' >\n";
        $retour  .= "\t<p> Bravo joueur <b>".($_SESSION['couleurActive'] == PieceQuantik::WHITE ? "blanc ":"noir ")."</b></p>\n";
        $retour  .= "\t<p> Tu as gagné en : <b>".$_SESSION['coups']." coups</b></p>\n";
        $retour .= "<input type='submit' name='reset' value='recommencer' ></form>\n";
        return $retour;
    }
}