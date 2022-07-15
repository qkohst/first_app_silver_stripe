<?php

use SilverStripe\Control\HTTPRequest;
use SilverStripe\Control\Director;
use SilverStripe\Core\Convert;
use SilverStripe\ORM\DB;
use SilverStripe\ORM\Queries\SQLSelect;
use SilverStripe\Assets\Upload;
use SilverStripe\Assets\File;

class ProductController extends PageController
{
    private static $allowed_actions = [
        'getDataProductColumn',
        'getDataProduct',
        'addData',
        'doSave',
        'detail',
        'edit',
        'doUpdate',
        'doDelete',
        'editStokHarga',
        'doUpdateStokHarga'
    ];

    public function getDataProductColumn($key)
    {
        $array = ['Created', 'ID', 'NamaProduct', 'Status'];
        return $array[$key];
    }

    public function getDataProduct()
    {
        $arr = array();
        $limit = $_REQUEST['length'];
        $offset = $_REQUEST['start'];
        $filter_record = (isset($_REQUEST['filter_record'])) ? $_REQUEST['filter_record'] : '';

        $parrams_array = array();
        parse_str($filter_record, $parrams_array);
        $columnsort = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order']['0']['column'] : 0;
        $typesort = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order']['0']['dir'] : 'DESC';
        $Dataall = Product::get()->where('Deleted = 0');

        $searchValue = str_replace(array("#", "'", ";"), '', $_REQUEST['search']['value']);

        $search = (isset($searchValue)) ? $searchValue : '';
        if ($search != '') {
            $Dataall = $Dataall->where("NamaProduct like '%{$search}%'");
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
        $Dataall = $Dataall->sort(self::getDataProductColumn($columnsort), $typesort);
        $total = $Dataall->count();
        $Dataall = $Dataall->limit($limit, $offset);

        foreach ($Dataall as $key => $value) {
            $temparr = array();

            $gambar = Gambar::get()->where('ProductID = ' . $value->ID)->last();
            $btnedit = '<a href="javascript:;" class="btn btn-link text-secondary mb-0"
                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="icofont-options"></i>
                        </a>
                        <ul class="dropdown-menu  dropdown-menu-end  px-2 pt-3 pb-0"
                            aria-labelledby="dropdownMenuButton">
                            <li>
                                <a class="dropdown-item border-radius-md" href="' . Director::absoluteBaseURL() . 'Product/detail/' . $value->ID . '">
                                    <i class="icofont-eye-alt mx-2"></i> Detail
                                </a>
                                <a class="dropdown-item border-radius-md"
                                    href="' . Director::absoluteBaseURL() . 'Product/edit/' . $value->ID . '">
                                    <i class="icofont-ui-edit mx-2"></i> Edit
                                </a>
                                <a href="#" class="dropdown-item border-radius-md btn-delete"
                                    data-id="' . $value->ID . '">
                                    <i class="icofont-ui-delete mx-2"></i> Hapus
                                </a>
                                <form action="' . Director::absoluteBaseURL() . 'Product/doDelete/' . $value->ID . '" method="post"
                                    id="delete' . $value->ID . '">
                                </form>
                            </li>
                        </ul>';
            $namaProduct = '<div class="d-flex px-2 py-1">
                                <div>
                                  <img src="' . Director::absoluteBaseURL() . '/public/assets/GambarProduct/' . $gambar->NamaGambar . '" class="avatar avatar-sm me-2" alt="Img">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">' . $value->NamaProduct . '</h6>
                                </div>
                            </div>';

            if ($value->Status == 1) {
                $status = '<span class="badge badge-sm bg-gradient-success">Aktif</span>';
            } else {
                $status = '<span class="badge badge-sm bg-gradient-danger">Tidak Aktif</span>';
            }

            $temparr[] = $namaProduct;
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
        //     $search = $_REQUEST['search'];
        //     $filter = 'NamaProduct' . ' LIKE \'%' . $_REQUEST['search'] . '%\'';
        //     $dataProduct = Product::get()->where('Deleted = 0 AND ' . $filter);
        // } else {
        //     $search = null;
        //     $dataProduct = Product::get()->where('Deleted = 0');
        // }

        // $dataProduct = Product::get()->where('Deleted = 0');

        $data = [
            "siteParent" => "Product",
            "site" => "Product",
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'Product', 'Page',
        )));
    }

    public function addData(HTTPRequest $request)
    {
        $status = "";
        $msg = "";
        if (isset($_SESSION['savedata_status'])) {
            $status = $_SESSION['savedata_status'];
            $msg = $_SESSION['msg'];

            unset($_SESSION['savedata_status']);
            unset($_SESSION['msg']);
        }

        $warna = Warna::get()->where('Deleted = 0 AND Status = 1')->sort('NamaWarna');;

        $data = [
            "siteParent" => "Tambah Product",
            "site" => "Product",
            "Warna" => $warna,
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'ProductTambah', 'Page',
        )));
    }

    public function doSave(HTTPRequest $request)
    {
        // Validation
        if (trim($_REQUEST['NamaProduct']) == null) {
            $_SESSION['savedata_status'] = "error";
            $_SESSION['msg'] = "Nama Product tidak boleh kosong";
            return $this->redirectBack();
        }

        if (trim($_REQUEST['DeskripsiProduct']) == null) {
            $_SESSION['savedata_status'] = "error";
            $_SESSION['msg'] = "Deskripsi Product tidak boleh kosong";
            return $this->redirectBack();
        }

        if (isset($_REQUEST['WarnaProduct'][0])) {
            $countWarna = count($_REQUEST['WarnaProduct']);
            if ($countWarna == 0) {
                $_SESSION['savedata_status'] = "error";
                $_SESSION['msg'] = "Silahkan pilih warna product kemudian isikan jumlah & harga.";
                return $this->redirectBack();
            }
        } else {
            $_SESSION['savedata_status'] = "error";
            $_SESSION['msg'] = "Silahkan pilih warna product kemudian isikan jumlah & harga.";
            return $this->redirectBack();
        }

        // Simpan Data Product 
        $product = Product::create();
        $product->NamaProduct = Convert::raw2sql($_REQUEST['NamaProduct']);
        $product->DeskripsiProduct = $_REQUEST['DeskripsiProduct'];
        $product->Status = 1;
        $product->write();

        // Save Gambar Product 
        $images = [];
        $file = $_FILES['GambarProduct'];
        for ($j = 0; $j < count($file['name']); $j++) {
            array_push($images, [
                'name' => $file['name'][$j],
                'type' => $file['type'][$j],
                'tmp_name' => $file['tmp_name'][$j],
                'error' => $file['error'][$j],
                'size' => $file['size'][$j],
            ]);
        }
        foreach ($images as $img => $file) {
            if ($file['name'] != '') {
                $name = $file['name'];
                $type = $file['type'];
                $type = explode('/', $type);
                $type = end($type);
                if ($type) {
                    $file['name'] = $product->ID . '-' . $img . '-' . date('Y-m-d-H-i-s') . '.' . $type;
                }

                $upload = new Upload();
                $gambarProduct = new Gambar();
                $gambarProduct->NamaGambar = $product->ID . '-' . $img . '-' . date('Y-m-d-H-i-s') . '.' . $type;
                $gambarProduct->ProductID = $product->ID;

                $upload->loadIntoFile($file, $gambarProduct, 'GambarProduct');
                $gambarProduct->write();
            }
        }

        // Save Warna Product, Jumlah Product, & Harga
        for ($i = 0; $i < count($_REQUEST['WarnaProduct']); $i++) {

            // Warna Product 
            $warnaProduct = WarnaProduct::create();
            $warnaProduct->WarnaID = Convert::raw2sql($_REQUEST['WarnaProduct'][$i]);
            $warnaProduct->ProductID = $product->ID;
            $warnaProduct->write();

            // Jumlah Product
            $jumlahProduct = JumlahProduct::create();
            $jumlahProduct->Jumlah = Convert::raw2sql($_REQUEST['Jumlah'][$i]);
            $jumlahProduct->WarnaProductID = $warnaProduct->ID;
            $jumlahProduct->write();

            // Harga Product
            $hargaProduct = HargaProduct::create();
            $hargaProduct->Harga = str_replace(".", "", Convert::raw2sql($_REQUEST['Harga'][$i]));
            $hargaProduct->WarnaProductID = $warnaProduct->ID;
            $hargaProduct->TglMulaiBerlaku = date('Y-m-d H:i:s');
            $hargaProduct->write();
        }

        $_SESSION['savedata_status'] = "success";
        $_SESSION['msg'] = "Berhasil disimpan";
        return $this->redirect(Director::absoluteBaseURL() . "Product");
    }

    public function detail(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $product = Product::get()->byID($id);
        $product->DeskripsiProduct = str_replace('<br />', '', $product->DeskripsiProduct);

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

        // $listGambar = [];
        // $no = 1;

        // foreach ($product->Gambar() as $gambar) {

        //     array_push($listGambar, [
        //         "No" => $no,
        //         "Gambar" => $gambar->getAbsoluteURL()
        //     ]);

        //     $no++;
        // }


        // print_r($listGambar);

        $data = [
            "siteParent" => "Detail Product",
            "site" => "Product",
            "Data" => $product,
            // 'DataGambar' => $listGambar,
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'ProductDetail', 'Page',
        )));
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
        $product = Product::get()->byID($id);

        $product->DeskripsiProduct = str_replace('<br />', '\n', $product->DeskripsiProduct);

        $data = [
            "siteParent" => "Edit Product",
            "site" => "Product",
            "Data" => $product,
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'ProductEdit', 'Page',
        )));
    }

    public function doUpdate(HTTPRequest $request)
    {
        if (trim($_REQUEST['DeskripsiProduct']) == null) {
            $_SESSION['savedata_status'] = "error";
            $_SESSION['msg'] = "Deskripsi product tidak boleh kosong";
            return $this->redirectBack();
        } else {
            $id = $request->params()["ID"];
            $product = Product::get()->byID($id);

            $product->update([
                'DeskripsiProduct' => $_REQUEST['DeskripsiProduct'],
                'Status' => Convert::raw2sql($_REQUEST['Status'])
            ]);
            $product->write();

            $_SESSION['savedata_status'] = "success";
            $_SESSION['msg'] = "Berhasil diedit";

            return $this->redirect(Director::absoluteBaseURL() . "Product");
        }
    }

    public function doDelete(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $product = Product::get()->byID($id);

        $product->update([
            'Deleted' => 1
        ]);
        $product->write();

        $_SESSION['deletedata_status'] = "success";
        $_SESSION['msg'] = "Berhasil dihapus";
        return $this->redirect(Director::absoluteBaseURL() . "Product");
    }

    public function editStokHarga(HTTPRequest $request)
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
        $warnaProduct = WarnaProduct::get()->byID($id);
        $data = [
            "siteParent" => "Edit Stok & Harga",
            "site" => "Stok & Harga Product",
            "Previous" => "Product/detail/" . $warnaProduct->ProductID,
            "Data" => $warnaProduct,
            "Status" => $status,
            "msg" => $msg
        ];

        return $this->customise($data)->renderWith((array(
            'ProductEditStokHarga', 'Page',
        )));
    }

    public function doUpdateStokHarga(HTTPRequest $request)
    {
        $id = $request->params()["ID"];
        $hargaTerakhir = HargaProduct::get()->where('WarnaProductID = ' . $id)->last();
        $jumlahterakhir = JumlahProduct::get()->where('WarnaProductID = ' . $id)->last();

        if ($hargaTerakhir->Harga == str_replace(".", "", Convert::raw2sql($_REQUEST['Harga'])) && $jumlahterakhir->Jumlah == Convert::raw2sql($_REQUEST['Jumlah'])) {
            $_SESSION['savedata_status'] = "warning";
            $_SESSION['msg'] = "Tidak ada perubahan data";
            return $this->redirectBack();
        } elseif ($hargaTerakhir->Harga != str_replace(".", "", Convert::raw2sql($_REQUEST['Harga'])) && $jumlahterakhir->Jumlah != Convert::raw2sql($_REQUEST['Jumlah'])) {

            $jumlahProduct = JumlahProduct::create();
            $jumlahProduct->Jumlah = Convert::raw2sql($_REQUEST['Jumlah']);
            $jumlahProduct->WarnaProductID = $id;
            $jumlahProduct->write();

            $hargaProduct = HargaProduct::create();
            $hargaProduct->Harga = str_replace(".", "", Convert::raw2sql($_REQUEST['Harga']));
            $hargaProduct->WarnaProductID = $id;
            $hargaProduct->write();

            $_SESSION['savedata_status'] = "success";
            $_SESSION['msg'] = "Harga & Jumlah Product Berhasil diedit";

            return $this->redirect(Director::absoluteBaseURL() . "Product/detail/" . $jumlahterakhir->WarnaProduct->ProductID);
        } elseif ($hargaTerakhir->Harga != str_replace(".", "", Convert::raw2sql($_REQUEST['Harga']))) {

            $hargaProduct = HargaProduct::create();
            $hargaProduct->Harga = str_replace(".", "", Convert::raw2sql($_REQUEST['Harga']));
            $hargaProduct->WarnaProductID = $id;
            $hargaProduct->write();

            $_SESSION['savedata_status'] = "success";
            $_SESSION['msg'] = "Jumlah Product Berhasil diedit";

            return $this->redirect(Director::absoluteBaseURL() . "Product/detail/" . $jumlahterakhir->WarnaProduct->ProductID);
        } elseif ($jumlahterakhir->Jumlah != Convert::raw2sql($_REQUEST['Jumlah'])) {

            $jumlahProduct = JumlahProduct::create();
            $jumlahProduct->Jumlah = Convert::raw2sql($_REQUEST['Jumlah']);
            $jumlahProduct->WarnaProductID = $id;
            $jumlahProduct->write();

            $_SESSION['savedata_status'] = "success";
            $_SESSION['msg'] = "Harga Product Berhasil diedit";

            return $this->redirect(Director::absoluteBaseURL() . "Product/detail/" . $jumlahterakhir->WarnaProduct->ProductID);
        }
    }
}
