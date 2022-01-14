<?php

class PlateauQuantik
{
public const NBROWS = 4;
public const NBCOLS = 4;
public const NW = 0;
public const NE = 1;
public const SW = 2;
public const SE = 3;

protected $cases;

public function __construct()
{
    $this->cases = array(self::NBROWS);

    for($i=0;$i<self::NBROWS;$i++){
        $this->cases[$i] = new ArrayPieceQuantik();
        $this->cases[$i].setTaille(self::NBCOLS);
    }
}

public function getPiece(int $numRow, int $colNum):PieceQuantik
{

    return $this->cases[$numRow].getPieceQuantik($colNum);
}
public function setPiece(int $rowNum,int $colNum, PieceQuantik $p)
{
    $this->cases[$rowNum].setPieceQuantik($colNum,$p);

}
public function getRow(int $numRow):Array
{
    return $this->cases[$numRow];

}
public function getCol(int $numCol):Array
{
    $retour = new ArrayPieceQuantik();
    $retour.setTaille(self::NBROWS);

    for ($i = 0;i<self::NBROWS;$i++){
        $retour.addPieceQuantik($this->cases[$i].getPieceQuantik($numCol));
    }
    return $retour;
}

public function getCorner(int $dir):Array
{
    $retour = new ArrayPieceQuantik();
    $retour.setTaille((self::NBROWS/2)+(self::NBCOLS/2));

    switch ($dir){
        case self::NW:
            for($i=0;$i<self::NBROWS/2;$i++){
                for($j=0;$j<self::NBCOLS/2;$j++){
                    $retour.addPieceQuantik($this->cases[$i].getPieceQuantik($j));
                }
            }
            break;
        case self::NE:
            for($i=0;$i<self::NBROWS/2;$i++){
                for($j=self::NBCOLS/2;$j<self::NBCOLS;$j++){
                    $retour.addPieceQuantik($this->cases[$i].getPieceQuantik($j));
                }
            }
            break;
        case self::SW:
            for($i=self::NBROWS/2;$i<self::NBROWS;$i++){
                for($j=0;$j<self::NBCOLS/2;$j++){
                    $retour.addPieceQuantik($this->cases[$i].getPieceQuantik($j));
                }
            }
            break;
        default:
            for($i=self::NBROWS/2;$i<self::NBROWS;$i++) {
                for ($j=self::NBCOLS/2;$j<self::NBCOLS;$j++) {
                    $retour . addPieceQuantik($this->cases[$i].getPieceQuantik($j));
                }
            }
    }

    return $retour;

}

public function __toString():string
{
    $retour = "";
    for ($i=0;$i<self::NBROWS;$i++){
        for ($j=0;$j<self::NBCOLS;$j++){
            $retour = $retour.$this->cases[$i].getPieceQuantik($j).toString();
        }
    }

    return $retour;
}

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