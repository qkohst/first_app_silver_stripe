<?php

use SilverStripe\ORM\DataObject;

class JumlahProduct extends DataObject
{
    private static $db = [
        'Type' => 'Boolean',
        'Jumlah' => 'Int'
    ];

    // Type 
    // 1 = Plus 
    // 0 = Minus 

    private static $has_one = [
        'WarnaProduct' => WarnaProduct::class,
    ];
}
