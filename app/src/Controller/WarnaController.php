<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Director;
use SilverStripe\Core\Convert;

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
        $status = "";
        $msg = "";
        if (isset($_SESSION['savedata_status'])) {
            if ($_SESSION['savedata_status'] == "error") {
                $status = "error";
                $msg = $_SESSION['msg'];
            } elseif ($_SESSION['savedata_status'] == "success") {
                $status = "success";
                $msg = $_SESSION['msg'];
            }
            unset($_SESSION['savedata_status']);
        } elseif (isset($_SESSION['deletedata_status'])) {
            if ($_SESSION['deletedata_status'] == "error") {
                $status = "error";
                $msg = $_SESSION['msg'];
            } elseif ($_SESSION['deletedata_status'] == "success") {
                $status = "success";
                $msg = $_SESSION['msg'];
            }
            unset($_SESSION['deletedata_status']);
        }

        if (isset($_REQUEST['search'])) {
            $search = Convert::raw2sql($_REQUEST['search']);
            $filter = 'NamaWarna' . ' LIKE \'%' . $search . '%\'';
            $dataWarna = Warna::get()->where('Deleted = 0 AND ' . $filter)->sort('NamaWarna');
        } else {
            $search = null;
            $dataWarna = Warna::get()->where('Deleted = 0')->sort('NamaWarna');
        }

        $data = [
            "siteParent" => "Warna",
            "site" => "Warna",
            "search" => $search,
            "Data" => $dataWarna,
            "CountData" => count($dataWarna),
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'Warna', 'Page',
        )));
    }

    public function doSave(HTTPRequest $request)
    {
        if (trim($_REQUEST['NamaWarna']) == null) {
            $_SESSION['savedata_status'] = "error";
            $_SESSION['msg'] = "Nama Warna tidak boleh kosong";
            return $this->redirectBack();
        } else {
            // unique validation 
            $check_warna = Warna::get()->where('Deleted = 0')->filter([
                'NamaWarna' => Convert::raw2sql($_REQUEST['NamaWarna'])
            ]);
            if (count($check_warna) == 0) {
                $warna = Warna::create();
                $warna->NamaWarna = Convert::raw2sql($_REQUEST['NamaWarna']);
                $warna->Status = 1;
                $warna->write();

                $_SESSION['savedata_status'] = "success";
                $_SESSION['msg'] = "Berhasil disimpan";
                return $this->redirect(Director::absoluteBaseURL() . "Warna");
            } else {
                $_SESSION['savedata_status'] = "error";
                $_SESSION['msg'] = "Nama Warna sudah ada";
                return $this->redirectBack();
            }
        }
    }

    public function edit(HTTPRequest $request)
    {
        $status = "";
        $msg = "";
        if (isset($_SESSION['savedata_status'])) {
            if ($_SESSION['savedata_status'] == "error") {
                $status = "error";
                $msg = $_SESSION['msg'];
            } elseif ($_SESSION['savedata_status'] == "success") {
                $status = "success";
                $msg = $_SESSION['msg'];
            }
            unset($_SESSION['savedata_status']);
        }

        $id = $request->params()["ID"];
        $warna = Warna::get()->byID($id);
        $data = [
            "siteParent" => "Edit Warna",
            "site" => "Warna",
            "Data" => $warna,
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'WarnaEdit', 'Page',
        )));
    }

    public function doUpdate(HTTPRequest $request)
    {
        if (trim($_REQUEST['NamaWarna']) == null) {
            $_SESSION['savedata_status'] = "error";
            $_SESSION['msg'] = "Nama Warna tidak boleh kosong";
            return $this->redirectBack();
        } else {
            $id = $request->params()["ID"];
            $warna = Warna::get()->byID($id);

            // unique validation 
            $check_warna = Warna::get()->where('Deleted = 0 AND ID != ' . $id)->filter([
                'NamaWarna' => Convert::raw2sql($_REQUEST['NamaWarna'])
            ]);

            if (count($check_warna) == 0) {
                $warna->update([
                    'NamaWarna' => Convert::raw2sql($_REQUEST['NamaWarna']),
                    'Status' => Convert::raw2sql($_REQUEST['Status'])
                ]);
                $warna->write();

                $_SESSION['savedata_status'] = "success";
                $_SESSION['msg'] = "Berhasil diedit";

                return $this->redirect(Director::absoluteBaseURL() . "Warna");
            } else {
                $_SESSION['savedata_status'] = "error";
                $_SESSION['msg'] = "Nama Warna sudah ada";
                return $this->redirectBack();
            }
        }
    }

    public function doDelete(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $warna = Warna::get()->byID($id);

        $warna->update([
            'Deleted' => 1
        ]);
        $warna->write();

        $_SESSION['deletedata_status'] = "success";
        $_SESSION['msg'] = "Berhasil dihapus";
        return $this->redirect(Director::absoluteBaseURL() . "Warna");
    }
}
