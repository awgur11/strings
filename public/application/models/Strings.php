<?php

/**
* 
*/
class Strings extends Model
{
	public static function currentClass() {
        return __CLASS__;
    }
    protected $table = 'strings'; //имя таблицы
    
    protected $fillable = ['string']; //перечень столбцов таблицы
}