<?php

use SilverStripe\Control\HTTPRequest;

class ProductController extends PageController
{
    private static $allowed_actions = [
        'addData',
    ];

    public function index(HTTPRequest $request)
    {
        if (isset($_REQUEST['search'])) {
            $search = $_REQUEST['search'];
            $filter = 'NamaProduct' . ' LIKE \'%' . $_REQUEST['search'] . '%\'';
            $product = Product::get()->where('Deleted = 0 AND ' . $filter);
        } else {
            $search = null;
            $product = Product::get()->where('Deleted = 0');
        }

        $data = [
            "siteParent" => "Product",
            "site" => "Product",
            "search" => $search,
            "Data" => $product,
            "CountData" => count($product)
        ];

        return $this->customise($data)->renderWith((array(
            'Product', 'Page',
        )));
    }

    public function addData(HTTPRequest $request)
    {
        $warna = Warna::get()->where('Deleted = 0')->sort('NamaWarna');;

        $data = [
            "siteParent" => "Tambah Product",
            "site" => "Product",
            'Warna' => $warna,
        ];

        return $this->customise($data)->renderWith((array(
            'ProductTambah', 'Page',
        )));
    }
}
