<?php

class HTMLmaker
{
    public function __construct(){

    }

    public function getDebutHTML():string{
        $retour = "<html>";
        $retour .= "\t";

      return $retour;
    }

    public function getFinHTML():string{
        $retour = "\t</body>\n";
        $retour .= "</html>";
        return $retour;
    }

    public function getDivPiecesDisponibles(ArrayPieceQuantik $array):string{
        $retour = "<div>";
        for($i = 0; $i<$array->getTaille(); $i++){
            $retour.="\t<button type='submit' name='active' disabled >".$array->getPieceQuantik($i)."</button>\n";
        }
        $retour = "</div>";

        return $retour;
    }
}