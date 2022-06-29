<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Director;

class WarnaController extends PageController
{
    private static $allowed_actions = [
        'doSave',
        'edit',
        'doUpdate',
        'doDelete'
    ];

    public function index(HTTPRequest $request)
    {
        $warna = Warna::get()->where('Deleted = 0');
        $data = [
            "siteParent" => "Warna",
            "site" => "Warna",
            'Data' => $warna
        ];

        return $this->customise($data)->renderWith((array(
            'Warna', 'Page',
        )));
    }

    public function doSave(HTTPRequest $request)
    {
        $warna = Warna::create();
        $warna->NamaWarna = $_REQUEST['NamaWarna'];
        $warna->Status = 1;
        $warna->write();

        return $this->redirect(Director::absoluteBaseURL() . "Warna");
    }

    public function edit(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $warna = Warna::get()->byID($id);
        $data = [
            "siteParent" => "Edit Warna",
            "site" => "Warna",
            "Data" => $warna
        ];

        return $this->customise($data)->renderWith((array(
            'WarnaEdit', 'Page',
        )));
    }

    public function doUpdate(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $warna = Warna::get()->byID($id);

        $warna->update([
            'NamaWarna' => $_REQUEST['NamaWarna'],
            'Status' => $_REQUEST['Status']
        ]);
        $warna->write();

        return $this->redirect(Director::absoluteBaseURL() . "Warna");
    }

    public function doDelete(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $warna = Warna::get()->byID($id);

        $warna->update([
            'Deleted' => 1
        ]);
        $warna->write();

        return $this->redirect(Director::absoluteBaseURL() . "Warna");
    }
}
