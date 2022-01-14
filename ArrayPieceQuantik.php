<?php
class ArrayPieceQuantik{
    protected $piecesQuantik;
    protected int $taille;

    public function __construct(){
        $this->piecesQuantik = array();
        $this->taille = 0;
    }

    public function __toString():string{
        return "tableau";
    }

    /**
     * @return array
     */
    public function getPieceQuantik(int $pos): array
    {
        return $this->piecesQuantik[$pos];
    }

    /**
     * @param array $piecesQuantik
     */
    public function setPieceQuantik(int $pos, PieceQuantik $piece)
    {
        $this->piecesQuantik[$pos] = $piece;
    }

    public function addPieceQuantik(PieceQuantik $piece){
        $this->piecesQuantik[] = $piece;
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

        $arrayTmp.add(PieceQuantik::initBlackCube());
        $arrayTmp.add(PieceQuantik::initBlackCone());
        $arrayTmp.add(PieceQuantik::initBlackCylindre());
        $arrayTmp.add(PieceQuantik::initBlackSphere());

        return $arrayTmp;
    }

    public static function initPiecesBlanches():ArrayPieceQuantik{
        $arrayTmp = new ArrayPieceQuantik();

        $arrayTmp.add(PieceQuantik::initWhiteCube());
        $arrayTmp.add(PieceQuantik::initWhiteCone());
        $arrayTmp.add(PieceQuantik::initWhiteCylindre());
        $arrayTmp.add(PieceQuantik::initWhiteSphere());

        return $arrayTmp;
    }
}
?>
