<?php

use SilverStripe\Control\HTTPRequest;

class ProductController extends PageController
{

    public function index(HTTPRequest $request)
    {
        $product = Product::get();
        $data = [
            "siteParent" => "Product",
            "site" => "Product",
            'Data' => $product
        ];

        return $this->customise($data)->renderWith((array(
            'Product', 'Page',
        )));
    }

    public function TambahProduct(HTTPRequest $request)
    {
        $data = [
            "siteParent" => "Tambah Product",
            "site" => "Product",
        ];

        return $this->customise($data)->renderWith((array(
            'TambahProduct', 'Page',
        )));
    }
}
