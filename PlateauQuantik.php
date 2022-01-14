<?php

class PlateauQuantik
{
public const NBROWS = 4;
public const NBCOLS = 4;
public const NW = 0;
public const NE = 1;
public const SW = 2;
public const SE = 3;

protected Array $cases;

public function __construct()
{

}

public function getPiece(int $numRow, int $colNum):PieceQuantik
{

}
public function setPiece(int $rowNum,int $colNum, PieceQuantik $p)
{

}
public function getRow(int $numRow):Array
{

}
public function getCol(int $numCol):Array
{

}

public function getCorner(int $dir):Array
{

}

public function __toString()
{
    // TODO: Implement __toString() method.
}

public static function getCornerFromCoord(int $rowNum, int $colNum):int
{
    if ($rowNum = 0 || $rowNum = 1 ) {
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