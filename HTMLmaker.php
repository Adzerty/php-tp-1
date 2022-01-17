<?php

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
}