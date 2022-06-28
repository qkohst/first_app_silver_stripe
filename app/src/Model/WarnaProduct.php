<?php

use SilverStripe\ORM\DataObject;

class WarnaProduct extends DataObject
{
    private static $db = [
        'Harga' => 'Double'
    ];

    private static $has_one = [
        'Warna' => Warna::class,
        'Product' => Product::class,
    ];
}
