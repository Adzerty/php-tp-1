<?php


class ActionQuantik
{
    protected PlateauQuantik $plateau;

    public function __construct( PlateauQuantik $plateau){
        $this->plateau = $plateau;
    }

    /**
     * @return PlateauQuantik
     */
    public function getPlateau(): PlateauQuantik
    {
        return $this->plateau;
    }

    public function isRowWin(int $numRow):bool
    {
        return self::isComboWin($this->plateau->getRow($numRow));
    }

    public function isColWin(int $numCol):bool
    {
        return self::isComboWin($this->plateau->getCol($numCol));
    }

    public function isCornerWin(int $dir):bool
    {
        return self::isComboWin($this->plateau->getCorner($dir));
    }

    public function isValidatePose(int $rowNum,int $colNum,PieceQuantik $piece):bool
    {
        return  self::isPieceValidate($this->plateau->getRow($rowNum), $piece) &&
                self::isPieceValidate($this->plateau->getCol($colNum), $piece) &&
                self::isPieceValidate($this->plateau->getCorner(
                            PlateauQuantik::getCornerFromCoord($rowNum, $colNum)), $piece);
    }

    public function posePiece(int $rowNum,int $colNum,PieceQuantik $piece)
    {}

    /**
     * @return string
     */
    public function __toString():string
    {
        return "coucou";
    }

    /**
     * @param ArrayPieceQuantik $pieces
     * @return bool
     * Pour qu'un ArrayPieceQuantik soit valide il faut que toutes les pièces soient non VOID
     * et d'une forme différentes les unes par rapport aux autres
     * +
     * Toutes les pieces doivent être de la même couleur
     *
     * Soit n notre numéro de forme
     * On va donc additionner chaque 2^n entre eux et vérifier que la somme soit egale au resultat attendu
     * (soit : 2 + 4 + 8 + 16 = 30)
     */
    private static function isComboWin(ArrayPieceQuantik $pieces):bool
    {
        if($pieces->getTaille() != 4) return false;

        $isValid = (2^$pieces->getPieceQuantik(0)->getForme() +
            2^$pieces->getPieceQuantik(1)->getForme() +
            2^$pieces->getPieceQuantik(2)->getForme() +
            2^$pieces->getPieceQuantik(3)->getForme() ==
            2  +  4  +  8  + 16); // 2^1 + 2^2 + 2^3 + 2^4

        if(! $isValid) return false;

        for($i = 1; $i<$pieces->getTaille(); $i++){
            $isValid = $isValid &&
                ($pieces->getPieceQuantik(0)->getCouleur() == $pieces->getPieceQuantik(1)->getCouleur());
        }

        return $isValid;
    }

    /**
     * @param ArrayPieceQuantik $pieces
     * @param PieceQuantik $p
     * @return bool
     *
     * Pour vérifier qu'une pièce est valide, on vérifie qu'aucune autre pièce de la même forme
     * et de la couleur adverse soit présent
     */
    private static function isPieceValidate(ArrayPieceQuantik $pieces, PieceQuantik $p ):bool
    {
        $boolTmp = true;
        for($i = 0; $i < $pieces->getTaille(); $i++){
            $p2 = $pieces->getPieceQuantik($i);
            if($p2->getForme() == $p->getForme()){
                if($p2->getCouleur() != $p->getCouleur()){
                    $boolTmp = false;
                }
            }
        }
        return $boolTmp;
    }


}