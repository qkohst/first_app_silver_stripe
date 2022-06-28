<?php

use SilverStripe\ORM\DataObject;

class Warna extends DataObject
{
    private static $db = [
        'NamaWarna' => 'Varchar(20)'
    ];

    private static $has_many = [
        'WarnaProduct' => WarnaProduct::class,
    ];
}
