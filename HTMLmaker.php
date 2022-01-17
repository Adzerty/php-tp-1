<?php
/**
 * @author : Colin PALLIER & Adrien PESTEL
 * Classe permettant de créer un HTML
 * https://github.com/Adzerty/php-tp-1
 */
class HTMLmaker
{
    public function __construct(){

    }

    public function getDebutHTML():string{
        $retour = "<!DOCTYPE html>\n";
        $retour .= "<html lang=\"en\" dir=\"lt\">\n";
        $retour .= "\t<head>\n";
        $retour .= "\t\t<meta charset=\"utf-8\">";
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
            $retour.="\t<button type='submit' name='active' disabled >".$array->getPieceQuantik($i)."</button>\n";
        }
        $retour .= "</div>\n";

        return $retour;
    }

    public function getFormSelectionPiece(ArrayPieceQuantik $arrayPieceQuantik):string{
        $retour = "<form method=\"GET\">\n";
        $retour .= "\t<select name=\"choixPiece\">";

        for($i=0;$i<$arrayPieceQuantik->getTaille();$i++){
            $retour .= "<option>".$i."  ".$arrayPieceQuantik->getPieceQuantik($i)."</option>";
        }

        $retour .= "\t</select>";
        $retour .= "<input type=\"submit\" name=\"valider\" >";
        $retour .= "<form>";

        return $retour;
    }

    public function getDivPlateauQuantik(PlateauQuantik $plateau):string{
        $retour = "<div class='plateau'>\n";
        $retour .= "\t".$plateau."\n";
        $retour .= "</div>\n";

        return $retour;
    }
}