<?php
/**
 * @author : Colin PALLIER & Adrien PESTEL
 * Classe permettant de créer un HTML
 * https://github.com/Adzerty/php-tp-1
 */
class HTMLmaker
{
    public function __construct(){}

    public function getDebutHTML():string{
        $retour = "<!DOCTYPE html>\n";
        $retour .= "<html lang=\"fr\" dir=\"lt\">\n";
        $retour .= "\t<head>\n";
        $retour .= "\t\t<meta charset=\"utf-8\">";
        $retour .= "\t\t<link rel='stylesheet' href='../style/style.css'>";
        $retour .= "\t\t<title>Quantik</title>";
        $retour .= "\t</head>";
        $retour .= "\t<body>";

      return $retour;
    }

    public function getFinHTML():string{
        $retour = "\t</body>\n";
        $retour .= "</html>";
        return $retour;
    }


    public function getDivPiecesDisponibles(ArrayPieceQuantik $array):string{
        $retour = "<div class='pieceDispos'>\n";
        for($i = 0; $i<$array->getTaille(); $i++){
            $retour.="\t<button type='submit' name='active' disabled > <img src='../img/".$array->getPieceQuantik($i)->getCouleur()."_".$array->getPieceQuantik($i)->getForme().".png'>"."</button>\n";
        }
        $retour .= "</div>\n";

        return $retour;
    }

    public function getFormSelectionPiece(ArrayPieceQuantik $arrayPieceQuantik):string{
        $retour = "<div class=\"pieceDispos\">";
        $retour .= "<form method=\"GET\" action=\"pagePosePieceBlanche.php\">\n";

        for($i = 0; $i<$arrayPieceQuantik->getTaille(); $i++){
            $retour.="\t<button type='submit' name='joue' value='".$i."'> <img src='../img/".$arrayPieceQuantik->getPieceQuantik($i)->getCouleur()."_".$arrayPieceQuantik->getPieceQuantik($i)->getForme().".png'>"."</button>\n";
        }

        $retour .= "</form>\n";
        $retour .= "</div>";


        return $retour;
    }

    public function getDivPlateauQuantik(PlateauQuantik $plateau):string{
        $retour = "<div class='plateau'>\n";
        $retour .= "\t".$plateau."\n";
        $retour .= "</div>\n";

        return $retour;
    }

    public function getFormPlateauQuantik(PlateauQuantik $plateau, PieceQuantik $piece):string{
        $retour  = "<div class=\"plateau\">";
        $retour .= "<form class='form-plateau' >\n";
        $retour .= "\t<table style='border: 2px solid #000'>\n";

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
                                    <button class='form-plateau-btn-enabled' type='submit' name='active' >".$plateau->getPiece($i,$j)."</button></td>\n";
                }else{
                    $retour .= "\t\t\t<td style='border: 2px solid #000; width: 75px; height:75px'>
                                    <button class='form-plateau-btn-disabled' type='submit' name='active' disabled>".$plateau->getPiece($i,$j)."</button></td>\n";
                }
            }
            $retour .= "\t\t</tr>\n";
        }
        $retour .= "</table>";
        $retour .= "</form>";
        $retour .= "</div>";
        return $retour;
    }
}