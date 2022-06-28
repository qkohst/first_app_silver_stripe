<?php

use SilverStripe\ORM\DataObject;

class Product extends DataObject
{
    private static $db = [
        'NamaProduct' => 'Varchar(100)',
        'JumlahProduct' => 'Int'
    ];

    private static $has_many = [
        'WarnaProduct' => WarnaProduct::class,
        'Gambar' => Gambar::class,
    ];
}
