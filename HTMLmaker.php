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
}