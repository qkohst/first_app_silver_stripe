<?php

use SilverStripe\Control\HTTPRequest;


class DashboardController extends PageController
{
    public function index(HTTPRequest $request)
    {
        $countWarna = count(Warna::get()->where('Deleted = 0'));
        $contProduct = count(Product::get()->where('Deleted = 0'));

        // print_r($_SESSION);die;
        $data = [
            "siteParent" => "Dashboard",
            "site" => "Dashboard",
            'countWarna' => $countWarna,
            'contProduct' => $contProduct
        ];

        return $this->customise($data)->renderWith((array(
            'Dashboard', 'Page',
        )));
    }
}
