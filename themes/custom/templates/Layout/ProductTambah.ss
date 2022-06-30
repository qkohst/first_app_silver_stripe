<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
      <div class="card">
            <div class="card-header pb-0">
                <h6 class="text-uppercase">{$siteParent}</h6>
            </div>
            <form class="form-edit" action="{$BaseHref}Product/doSave" method="post">
                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Product</label>
                                <input class="form-control" type="text" name="NamaProduct" required>
                            </div>
                        </div>  
                    </div>
                </div>

                <div class="card-footer pt-0 pb-2">
                    <button type="submit" class="btn bg-gradient-primary btn-sm ms-auto">Simpan</button>
                    <a href="{$BaseHref}Warna" class="btn btn-outline-primary btn-sm ms-auto">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>