<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
        <% if $Status == "success" %>
        <div class="alert alert-success alert-message fade show" role="alert">
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
            <form class="form-edit" action="{$BaseHref}Product/doSave" method="post" enctype="multipart/form-data">
                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Product</label>
                                <input class="form-control" type="text" name="NamaProduct" required>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Deskripsi Product</label>
                                <textarea class="form-control" name="DeskripsiProduct" rows="3" required></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Gambar Product</label>
                                <input type="file" class="form-control" name="GambarProduct[]" accept="image/*" multiple
                                    required>
                            </div>
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
                                <% loop $Warna %>
                                <div class="col-md-3 my-1">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input checkbox-harga" type="checkbox"
                                            name="WarnaProduct[]" id="WarnaProduct{$ID}" value="{$ID}" data-id="{$ID}">
                                        <label class="form-check-label mt-1"
                                            for="WarnaProduct{$ID}">{$NamaWarna}</label>
                                    </div>
                                </div>
                                <div class="col-md-2 my-1">
                                    <input class="form-control" id="JumlahProduct{$ID}" type="number" name="Jumlah[]"
                                        disabled required>
                                </div>
                                <div class="col-md-7 my-1">
                                    <div class="input-group">
                                        <span class="input-group-text text-body">Rp.</span>
                                        <input type="text" id="HargaProduct{$ID}" class="form-control uang"
                                            name="Harga[]" disabled required>
                                    </div>
                                </div>
                                <% end_loop %>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer pt-2 pb-2">
                    <button type="submit" class="btn bg-gradient-success btn-sm ms-auto">Simpan</button>
                    <a href="{$BaseHref}Product" class="btn btn-outline-danger btn-sm ms-auto">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>
