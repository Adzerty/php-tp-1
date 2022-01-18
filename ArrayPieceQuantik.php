<?php
/**
 * @author : Colin PALLIER & Adrien PESTEL
 * Classe permettant de simuler un tableau de pièces
 * https://github.com/Adzerty/php-tp-1
 */
class ArrayPieceQuantik{
    protected array $piecesQuantik; //Tableau de pieces quantiks
    protected int $taille;          //On suppose que taille correspond à la taille maximale d'une ArrayPieceQuantik


    /**
     * Permet d'instancier un ArrayPieceQuantik vide
     */
    public function __construct(){
        $this->piecesQuantik = array();
        $this->taille = 0;
    }

    /**
     * Permet de retourner la liste des pieces quantik de cet ArrayPieceQuantik
     * @return string
     */
    public function __toString():string{
        $sRet = "<ul>\n";

        for($i = 0; $i<$this->taille; $i++){
            $sRet .= "<li>".$this->piecesQuantik[$i]."</li>\n";
        }

        return $sRet."</ul>";
    }

    /**
     * @param int $pos
     * @return PieceQuantik|null
     */
    public function getPieceQuantik(int $pos): ?PieceQuantik
    {
        if(isset($this->piecesQuantik[$pos]))
            return $this->piecesQuantik[$pos];
        else
            return PieceQuantik::initVoid();
    }

    /**
     * @param int $pos
     * @param PieceQuantik $piece
     * @return void
     */
    public function setPieceQuantik(int $pos, PieceQuantik $piece)
    {
        $this->piecesQuantik[$pos] = $piece;
    }

    /**
     * @param PieceQuantik $piece
     * @return void
     */
    public function addPieceQuantik(PieceQuantik $piece){
        if(count($this->piecesQuantik) < $this->taille) {
            $this->piecesQuantik[] = $piece;
        }
    }

    /**
     * @param int $pos
     * @return void
     */
    public function removePieceQuantik(int $pos){
        unset($this->piecesQuantik[$pos]);
    }

    /**
     * @return int
     */
    public function getTaille(): int
    {
        return $this->taille;
    }

    /**
     * @param int $taille
     */
    public function setTaille(int $taille): void
    {
        $this->taille = $taille;
    }

    /**
     * Permet de générer le set de pieces noires
     * @return ArrayPieceQuantik
     */
    public static function initPiecesNoires():ArrayPieceQuantik{
        $arrayTmp = new ArrayPieceQuantik();
        $arrayTmp->setTaille(8);

        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackCube();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackCone();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackCylindre();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackSphere();

        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackCube();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackCone();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackCylindre();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initBlackSphere();

        return $arrayTmp;
    }

    /**
     * Permet de générer le set de pièces blanches
     * @return ArrayPieceQuantik
     */
    public static function initPiecesBlanches():ArrayPieceQuantik{
        $arrayTmp = new ArrayPieceQuantik();
        $arrayTmp->setTaille(8);

        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteCube();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteCone();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteCylindre();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteSphere();

        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteCube();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteCone();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteCylindre();
        $arrayTmp->piecesQuantik[] = PieceQuantik::initWhiteSphere();

        return $arrayTmp;
    }
}
