<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
        <% if $Status == "warning" %>
        <div class="alert alert-warning alert-message fade show" role="alert">
            <strong>$msg</strong>
        </div>
        <% else_if $Status == "error" %>
        <div class="alert alert-danger alert-message fade show" role="alert">
            <strong>$msg</strong>
        </div>
        <% end_if %>

        <div class="card">
            <div class="card-header pb-0">
                <h6 class="text-uppercase">{$siteParent}</h6>
            </div>
            <form class="form-edit" action="{$BaseHref}Product/doUpdateStokHarga/{$Data.ID}" method="post">
                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="example-text-input" class="form-control-label">Nama Product</label>
                            <p>{$Data.Product.NamaProduct}</p>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-3">
                                    <label for="example-text-input" class="form-control-label">Warna</label>
                                </div>
                                <div class="col-md-2">
                                    <label for="example-text-input" class="form-control-label">Jumlah Stok</label>
                                </div>
                                <div class="col-md-7">
                                    <label for="example-text-input" class="form-control-label">Harga Satuan</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3 my-1">
                                    <label class="form-check-label mt-1">{$Data.Warna.NamaWarna}</label>
                                </div>
                                <div class="col-md-2 my-1">
                                    <input class="form-control" type="number" name="Jumlah"
                                        value="{$Data.JumlahProduct.last.Jumlah}" required>
                                </div>
                                <div class="col-md-7 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text text-body">Rp.</span>
                                        <input type="text" class="form-control uang" name="Harga"
                                            value="{$Data.HargaProduct.last.Harga}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer pt-2 pb-2">
                    <button type="submit" class="btn bg-gradient-success btn-sm ms-auto">Simpan</button>
                    <a href="{$BaseHref}{$Previous}" class="btn btn-outline-danger btn-sm ms-auto">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
