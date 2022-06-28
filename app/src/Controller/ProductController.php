<?php

use SilverStripe\Control\HTTPRequest;

class ProductController extends PageController
{

    public function index(HTTPRequest $request)
    {
        $product = Product::get();
        // print_r ($product);
        $data = [
            "siteParent" => "Product",
            "mgeJS" => "product",
            'Data' => $product
        ];

        return $this->customise($data)->renderWith((array(
            'Product', 'Page',
        )));
    }
}
