<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Director;
use SilverStripe\Core\Convert;

class WarnaController extends PageController
{
    private static $allowed_actions = [
        'getDataWarnaColumn',
        'getDataWarna',
        'doSave',
        'edit',
        'doUpdate',
        'doDelete'
    ];


    public function getDataWarnaColumn($key)
    {
        $array = ['Created', 'ID', 'NamaWarna', 'Status'];
        return $array[$key];
    }

    public function getDataWarna()
    {
        $arr = array();
        $limit = $_REQUEST['length'];
        $offset = $_REQUEST['start'];
        $filter_record = (isset($_REQUEST['filter_record'])) ? $_REQUEST['filter_record'] : '';

        $parrams_array = array();
        parse_str($filter_record, $parrams_array);
        $columnsort = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order']['0']['column'] : 0;
        $typesort = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order']['0']['dir'] : 'DESC';
        $Dataall = Warna::get()->where('Deleted = 0');

        $searchValue = str_replace(array("#", "'", ";"), '', $_REQUEST['search']['value']);

        $search = (isset($searchValue)) ? $searchValue : '';
        if ($search != '') {
            $Dataall = $Dataall->where("NamaWarna like '%{$search}%'");
        }

        if (!empty($parrams_array)) {
            foreach ($parrams_array as $key => $value) {
                if (strpos($key, 'ID') != FALSE && $value != '' && $value != 0) {
                    $Dataall = $Dataall->where("Upper(" . $key . ") = '" . strtoupper($value) . "'");
                } elseif ($value != '' && strpos($key, 'ID') != TRUE && $value != null) {
                    $Dataall = $Dataall->where("Upper(" . $key . ") like '%" . strtoupper($value) . "%'");
                }
            }
        }
        $Dataall = $Dataall->sort(self::getDataWarnaColumn($columnsort), $typesort);
        $total = $Dataall->count();
        $Dataall = $Dataall->limit($limit, $offset);

        foreach ($Dataall as $key => $value) {
            $temparr = array();

            $btnedit = '<a href="javascript:;" class="btn btn-link text-secondary mb-0"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icofont-options"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 pt-3 pb-0"
                            aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item border-radius-md"
                                    href="' . Director::absoluteBaseURL() . 'Warna/edit/' . $value->ID . '">
                                    <i class="icofont-ui-edit mx-2"></i> Edit
                                </a>
                                <a href="#" class="dropdown-item border-radius-md btn-delete"
                                    data-id="' . $value->ID . '">
                                    <i class="icofont-ui-delete mx-2"></i> Hapus
                                </a>
                                <form action="' . Director::absoluteBaseURL() . 'Warna/doDelete/' . $value->ID . '" method="post"
                                    id="delete' . $value->ID . '">
                                </form>
                            </li>
                        </ul>';

            if ($value->Status == 1) {
                $status = '<span class="badge badge-sm bg-gradient-success">Aktif</span>';
            } else {
                $status = '<span class="badge badge-sm bg-gradient-danger">Tidak Aktif</span>';
            }

            $temparr[] = $value->NamaWarna;
            $temparr[] = $status;
            $temparr[] = $btnedit;
            $arr[] = $temparr;
        }
        $result = array(
            'data' => $arr,
            'recordsTotal' => $total,
            'recordsFiltered' => $total
        );
        return json_encode($result);
    }

    public function index(HTTPRequest $request)
    {
        $status = "";
        $msg = "";
        if (isset($_SESSION['savedata_status'])) {
            $status = $_SESSION['savedata_status'];
            $msg = $_SESSION['msg'];

            unset($_SESSION['savedata_status']);
            unset($_SESSION['msg']);
        } elseif (isset($_SESSION['deletedata_status'])) {
            $status = $_SESSION['deletedata_status'];
            $msg = $_SESSION['msg'];

            unset($_SESSION['deletedata_status']);
            unset($_SESSION['msg']);
        }

        // if (isset($_REQUEST['search'])) {
        //     $search = Convert::raw2sql($_REQUEST['search']);
        //     $filter = 'NamaWarna' . ' LIKE \'%' . $search . '%\'';
        //     $dataWarna = Warna::get()->where('Deleted = 0 AND ' . $filter)->sort('NamaWarna');
        // } else {
        //     $search = null;
        //     $dataWarna = Warna::get()->where('Deleted = 0')->sort('NamaWarna');
        // }

        $data = [
            "siteParent" => "Warna",
            "site" => "Warna",
            "Status" => $status,
            "msg" => $msg,
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
            $status = $_SESSION['savedata_status'];
            $msg = $_SESSION['msg'];

            unset($_SESSION['savedata_status']);
            unset($_SESSION['msg']);
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
