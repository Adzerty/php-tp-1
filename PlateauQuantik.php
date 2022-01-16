<?php

/**
 * @author : Colin PALLIER & Adrien PESTEL
 * Classe permettant de simuler un plateau de jeu
 * https://github.com/Adzerty/php-tp-1
 */
class PlateauQuantik
{
    //Definit la taille du plateau de jeu
    public const NBROWS = 4;
    public const NBCOLS = 4;


    //Permet d'identifier un coin selon un numero
    public const NW = 0;
    public const NE = 1;
    public const SW = 2;
    public const SE = 3;

    //Tableau d'ArrayPieceQuantik permettant de simuler le plateau de jeu
    protected array $cases;

    /**
     * Permet d'instancier un PlateauQuantik
     */
    public function __construct()
    {
        $this->cases = array();

        for($i=0;$i<self::NBROWS;$i++){
            $this->cases[$i] = new ArrayPieceQuantik();
            $this->cases[$i]->setTaille(self::NBCOLS);

            for($j = 0; $j<self::NBCOLS; $j++){
                $this->cases[$i]->setPieceQuantik($j, PieceQuantik::initVoid());
            }
        }
    }

    /**
     * @param int $numRow
     * @param int $colNum
     * @return PieceQuantik
     */
    public function getPiece(int $numRow, int $colNum):PieceQuantik
    {
        return $this->cases[$numRow]->getPieceQuantik($colNum);
    }

    /**
     * @param int $rowNum
     * @param int $colNum
     * @param PieceQuantik $p
     * @return void
     */
    public function setPiece(int $rowNum,int $colNum, PieceQuantik $p)
    {
        $this->cases[$rowNum]->setPieceQuantik($colNum,$p);

    }

    /**
     * @param int $numRow
     * @return ArrayPieceQuantik
     */
    public function getRow(int $numRow): ArrayPieceQuantik
    {
        return $this->cases[$numRow];

    }

    /**
     * @param int $numCol
     * @return ArrayPieceQuantik
     */
    public function getCol(int $numCol): ArrayPieceQuantik
    {
        $retour = new ArrayPieceQuantik();
        $retour->setTaille(self::NBROWS);

        for ($i = 0;$i<self::NBROWS;$i++){
            $retour->addPieceQuantik($this->cases[$i]->getPieceQuantik($numCol));
        }
        return $retour;
    }

    /**
     * @param int $dir
     * @return ArrayPieceQuantik
     *
     * retourne une liste de pieceQuantik en fonction de la zone selectionnée
     */
    public function getCorner(int $dir): ArrayPieceQuantik
    {
        $retour = new ArrayPieceQuantik();
        $retour->setTaille((self::NBROWS/2)+(self::NBCOLS/2));

        switch ($dir){
            case self::NW:
                for($i=0;$i<self::NBROWS/2;$i++){
                    for($j=0;$j<self::NBCOLS/2;$j++){
                        $retour->addPieceQuantik($this->cases[$i]->getPieceQuantik($j));
                    }
                }
                break;
            case self::NE:
                for($i=0;$i<self::NBROWS/2;$i++){
                    for($j=self::NBCOLS/2;$j<self::NBCOLS;$j++){
                        $retour->addPieceQuantik($this->cases[$i]->getPieceQuantik($j));
                    }
                }
                break;
            case self::SW:
                for($i=self::NBROWS/2;$i<self::NBROWS;$i++){
                    for($j=0;$j<self::NBCOLS/2;$j++){
                        $retour->addPieceQuantik($this->cases[$i]->getPieceQuantik($j));
                    }
                }
                break;
            default:
                for($i=self::NBROWS/2;$i<self::NBROWS;$i++) {
                    for ($j=self::NBCOLS/2;$j<self::NBCOLS;$j++) {
                        $retour->addPieceQuantik($this->cases[$i]->getPieceQuantik($j));
                    }
                }
        }

        return $retour;

    }

    /**
     * @return string
     */
    public function __toString():string
    {
        $retour = "<table style='border: 2px solid #000'>\n\t";
        $head = "<thead><th></th>";
        for($i = 0; $i<self::NBCOLS; $i++){
            $head.="<th>$i</th>";
        }
        $head .= "</thead>";
        $retour.=$head;


        for ($i=0;$i<self::NBROWS;$i++){
            $retour.="<tr><th>$i</th>";
            for ($j=0;$j<self::NBCOLS;$j++){
                $retour .= "\n\t\t<td style='border: 2px solid #000; width: 75px; height:75px'>".$this->cases[$i]->getPieceQuantik($j)."</td>";
            }
            $retour.="\n\t</tr>\n\t";
        }

        return $retour."</table>";
    }

    /**
     * @param int $rowNum
     * @param int $colNum
     * @return int
     *
     * retourne la zone à laquelle appartient la coordonnée selectionnée
     */
    public static function getCornerFromCoord(int $rowNum, int $colNum):int
    {
        if ($rowNum < 2 ) {
            if ($colNum < 2) {
                return self::NW;
            } else {
                return self::NE;
            }
        }else{
            if ($colNum < 2) {
                return self::SW;
            } else {
                return self::SE;
            }
        }
    }

}