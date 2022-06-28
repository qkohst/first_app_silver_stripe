<?php

use SilverStripe\ORM\DataObject;

class Product extends DataObject
{
    private static $db = [
        'NamaProduct' => 'Varchar(100)',
    ];

    private static $has_many = [
        'WarnaProduct' => WarnaProduct::class,
        'Gambar' => Gambar::class,
        'HargaProduct' => HargaProduct::class,
        'JumlahProduct' => JumlahProduct::class,
    ];
}
