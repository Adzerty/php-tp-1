<?php

class PieceQuantik{
    public static int $WHITE = 0;
    public static int $BLACK = 1;

    public static int $VOID = 0;
    public static int $CUBE = 1;
    public static int $CONE = 2;
    public static int $CYLINDRE = 3;
    public static int $SPHERE = 4;

    protected int $forme;
    protected int $couleur;

    private function __construct(int $forme = 0, int $couleur = 0){}

    public function getForme(): int{
        return $this->forme;
    }

    public function getCouleur(): int{
        return $this->couleur;
    }

    public function __toString(): string{
        $formePiece = "";
        switch($this->forme){
            case 0: $formePiece = "cubique"; break;
            case 1: $formePiece = "conique"; break;
            case 2: $formePiece = "cylindrique"; break;
            case 3: $formePiece = "sphérique"; break;
        }
        return "Piece ".$this->couleur==0?"blanche":"noire"." de forme ".$formePiece;
    }


    public function initVoid(): PieceQuantik{
        return new PieceQuantik();
    }

    public function initWhiteCube(): PieceQuantik{
        return new PieceQuantik(1);
    }
    public function initWhiteCone(): PieceQuantik{
        return new PieceQuantik(2);
    }
    public function initWhiteCylindre(): PieceQuantik{
        return new PieceQuantik(3);
    }
    public function initWhiteSphere(): PieceQuantik{
        return new PieceQuantik(4);
    }

    public function initBlackCube(): PieceQuantik{
        return new PieceQuantik(1, 1);
    }
    public function initBlackCone(): PieceQuantik{
        return new PieceQuantik(2, 1);
    }
    public function initBlackCylindre(): PieceQuantik{
        return new PieceQuantik(3, 1);
    }
    public function initBlackSphere(): PieceQuantik{
        return new PieceQuantik(4, 1);
    }
}

?>
