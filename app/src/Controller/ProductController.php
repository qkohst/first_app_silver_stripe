<?php

use SilverStripe\Control\HTTPRequest;

class ProductController extends PageController
{

    public function index(HTTPRequest $request)
    {
        $product = Product::get();
        $data = [
            "siteParent" => "Product",
            "mgeJS" => "product",
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
            "mgeJS" => "product",
        ];

        return $this->customise($data)->renderWith((array(
            'TambahProduct', 'Page',
        )));
    }
}
