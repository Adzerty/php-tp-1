<?php
class PieceQuantik{
    public const WHITE = 0;
    public const BLACK = 1;

    public const VOID = 0;
    public const CUBE = 1;
    public const CONE = 2;
    public const CYLINDRE = 3;
    public const SPHERE = 4;

    protected int $forme;
    protected int $couleur;

    /**
     * @param $forme
     * @param $couleur
     */
    private function __construct($forme = 0, $couleur = 0){
        $this->forme=$forme;
        $this->couleur=$couleur;
    }

    /**
     * @return int
     */
    public function getForme(): int{
        return $this->forme;
    }

    /**
     * @return int
     */
    public function getCouleur(): int{
        return $this->couleur;
    }

    /**
     * @return string
     */
    public function __toString(): string{
        $formePiece = "";
        if($this->forme == 0)return "Piece <b>vide</b>";
        switch($this->forme){
            case 1: $formePiece = "cubique"; break;
            case 2: $formePiece = "conique"; break;
            case 3: $formePiece = "cylindrique"; break;
            case 4: $formePiece = "sphérique"; break;
        }
        return "Piece <b>" . ($this->couleur==0 ? "blanche" : "noire") . "</b> de forme <b>$formePiece </b>";
    }

    /**
     * @return PieceQuantik
     */
    public static function initVoid(): PieceQuantik{
        return new PieceQuantik();
    }

    /**
     * @return PieceQuantik
     */
    public static function initWhiteCube(): PieceQuantik{
        return new PieceQuantik(self::CUBE);
    }

    /**
     * @return PieceQuantik
     */
    public static function initWhiteCone(): PieceQuantik{
        return new PieceQuantik(self::CONE);
    }

    /**
     * @return PieceQuantik
     */
    public static function initWhiteCylindre(): PieceQuantik{
        return new PieceQuantik(self::CYLINDRE);
    }

    /**
     * @return PieceQuantik
     */
    public static function initWhiteSphere(): PieceQuantik{
        return new PieceQuantik(self::SPHERE);
    }

    /**
     * @return PieceQuantik
     */
    public static function initBlackCube(): PieceQuantik{
        return new PieceQuantik(self::CUBE, self::BLACK);
    }

    /**
     * @return PieceQuantik
     */
    public static function initBlackCone(): PieceQuantik{
        return new PieceQuantik(self::CONE, self::BLACK);
    }

    /**
     * @return PieceQuantik
     */
    public static function initBlackCylindre(): PieceQuantik{
        return new PieceQuantik(self::CYLINDRE, self::BLACK);
    }

    /**
     * @return PieceQuantik
     */
    public static function initBlackSphere(): PieceQuantik{
        return new PieceQuantik(self::SPHERE, self::BLACK);
    }
}
