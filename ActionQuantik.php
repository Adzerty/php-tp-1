<?php

/**
 * @author : Colin PALLIER & Adrien PESTEL
 * Classe permettant de simuler les actions possibles
 * https://github.com/Adzerty/php-tp-1
 */
class ActionQuantik
{
    protected PlateauQuantik $plateau;

    /**
     * @param PlateauQuantik $plateau
     */
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

    /**
     * @param int $numRow
     * @return bool
     */
    public function isRowWin(int $numRow):bool
    {
        return self::isComboWin($this->plateau->getRow($numRow));
    }

    /**
     * @param int $numCol
     * @return bool
     */
    public function isColWin(int $numCol):bool
    {
        return self::isComboWin($this->plateau->getCol($numCol));
    }

    /**
     * @param int $dir
     * @return bool
     */
    public function isCornerWin(int $dir):bool
    {
        return self::isComboWin($this->plateau->getCorner($dir));
    }

    /**
     * @param int $rowNum
     * @param int $colNum
     * @param PieceQuantik $piece
     * @return bool
     */
    public function isValidatePose(int $rowNum,int $colNum,PieceQuantik $piece):bool
    {
        return  $this->plateau->getPiece($rowNum, $colNum)->getForme() == 0    && // emplacement vide
                self::isPieceValidate($this->plateau->getRow($rowNum), $piece) && // peut être placée sur la ligne
                self::isPieceValidate($this->plateau->getCol($colNum), $piece) && // peut être placée sur la colonne
                self::isPieceValidate($this->plateau->getCorner(
                            PlateauQuantik::getCornerFromCoord($rowNum, $colNum)), $piece); //peut être placée sur le coin
    }

    /**
     * @param ArrayPieceQuantik $setJoueur
     * @return bool
     */
    public function canPoserPiece(ArrayPieceQuantik $setJoueur):bool{
        $boolRet = false;
        for($indPiece = 0; $indPiece < $setJoueur->getTaille() && !$boolRet; $indPiece++){ //On parcourt les pieces du joueur
            $pieceTmp = $setJoueur->getPieceQuantik($indPiece);
            if($pieceTmp->getForme() != 0){

                //Pour chaque pièce on vérifie chaque case du plateau si on peut placer
                //si on trouve au moins une case où on peut placer on arrête d'itérer
                for($ligne = 0; $ligne < PlateauQuantik::NBROWS && !$boolRet; $ligne++){
                    for($col = 0; $col < PlateauQuantik::NBCOLS && !$boolRet; $col++){
                        $boolRet = $this->isValidatePose($ligne, $col, $pieceTmp);
                    }
                }
            }
        }

        return $boolRet;
    }

    /**
     * @param int $rowNum
     * @param int $colNum
     * @param PieceQuantik $piece
     * @return void
     */
    public function posePiece(int $rowNum,int $colNum,PieceQuantik $piece)
    {
        if($this->isValidatePose($rowNum, $colNum, $piece)){
            $this->plateau->setPiece($rowNum, $colNum, $piece);
        }
    }

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
     *
     * Soit n notre numéro de forme
     * On va donc additionner chaque 2^n entre eux et vérifier que la somme soit egale au resultat attendu
     * (soit : 2 + 4 + 8 + 16 = 30)
     */
    private static function isComboWin(ArrayPieceQuantik $pieces):bool
    {
        return ( (2**$pieces->getPieceQuantik(0)->getForme() +
            2**$pieces->getPieceQuantik(1)->getForme() +
            2**$pieces->getPieceQuantik(2)->getForme() +
            2**$pieces->getPieceQuantik(3)->getForme()) ==
            2  +  4  +  8  + 16); // 2^1 + 2^2 + 2^3 + 2^4
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