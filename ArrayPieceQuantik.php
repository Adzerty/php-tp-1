<?php
include("PlateauQuantik.php");
include("ActionQuantik.php");
include("PieceQuantik.php");

class ArrayPieceQuantik{
    protected array $piecesQuantik;
    protected int $taille;

    public function __construct(){
        $this->piecesQuantik = array();
        $this->taille = 0;
    }

    public function __toString():string{
        $sRet = "|";

        for($i = 0; $i<$this->taille; $i++){
            $sRet .= $this->piecesQuantik[$i]." |";
        }

        return $sRet.'\n';
    }

    /**
     * @param int $pos
     * @return PieceQuantik
     */
    public function getPieceQuantik(int $pos): PieceQuantik
    {
        return $this->piecesQuantik[$pos];
    }


    public function setPieceQuantik(int $pos, PieceQuantik $piece)
    {
        $this->piecesQuantik[$pos] = $piece;
    }

    public function addPieceQuantik(PieceQuantik $piece){
        if(count($this->piecesQuantik) < $this->taille) {
            $this->piecesQuantik[] = $piece;
        }
    }

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
