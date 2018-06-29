<?php

namespace App\Services\Utilities;

class ProfileTitle
{
    /*
    *  A list of titles
    */
    protected static $titles = [
      'MD' => "MD",
      'Ass. Prof.' => "Ass. Prof",
      'Assoc. Prof.' => "Assoc. Prof.",
      'Prof.' => "Prof.",
    ];


    /**
     * All titles
     *
     * @return arry
     */
    public static function all()
    {
        return static::$titles;
    }

    /**
     * Create an array of title keys for validation purpose
     *
     * @return array
     */
    public static function getArray() {

      $titles = array_keys(static::$titles);

      $titlesArray = implode(',', $titles);

      return $titlesArray;
    }
}