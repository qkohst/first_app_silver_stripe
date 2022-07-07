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
        'addData',
        'doSave',
        'detail',
        'edit',
        'doUpdate',
        'doDelete',
        'editStokHarga',
        'doUpdateStokHarga'
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

        // if (isset($_REQUEST['search'])) {
        //     $search = $_REQUEST['search'];
        //     $filter = 'NamaProduct' . ' LIKE \'%' . $_REQUEST['search'] . '%\'';
        //     $dataProduct = Product::get()->where('Deleted = 0 AND ' . $filter);
        // } else {
        //     $search = null;
        //     $dataProduct = Product::get()->where('Deleted = 0');
        // }

        $dataProduct = Product::get()->where('Deleted = 0');

        $data = [
            "siteParent" => "Product",
            "site" => "Product",
            // "search" => $search,
            "Data" => $dataProduct,
            "CountData" => count($dataProduct),
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
            if ($_SESSION['savedata_status'] == "error") {
                $status = "error";
                $msg = $_SESSION['msg'];
            } elseif ($_SESSION['savedata_status'] == "success") {
                $status = "success";
                $msg = $_SESSION['msg'];
            }
            unset($_SESSION['savedata_status']);
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
            if ($_SESSION['savedata_status'] == "error") {
                $status = "error";
                $msg = $_SESSION['msg'];
            } elseif ($_SESSION['savedata_status'] == "warning") {
                $status = "warning";
                $msg = $_SESSION['msg'];
            }
            unset($_SESSION['savedata_status']);
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
