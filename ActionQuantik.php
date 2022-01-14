<?php

class ActionQuantik
{
protected PlateauQuantik $plateau;

public function __construct( PlateauQuantik $plateau){
    $this -> plateau = $plateau;
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
    return true;
}


public function isColWin(int $numCol):bool
{
    return true;
}

public function isCornerWin(int $dir):bool
{
    return true;
}

public function isValidatePose(int $rowNum,int $colNum,PieceQuantik $piece):bool
{
    return true;
}

public function posePiece(int $rowNum,int $colNum,PieceQuantik $piece)
{

}

public function __toString()
{
   return "coucou";
}

private static function isComboWin(Array $pieces):bool
{

    return true;
}

private static function isPieceValidate(Array $pieces,PieceQuantik $p ):bool
{

    return true;
}



}