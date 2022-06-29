<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
      <div class="card">
            <div class="card-header pb-0">
                <h6 class="text-uppercase">{$siteParent}</h6>
            </div>
            <form class="form-edit" action="{$BaseHref}Warna/doUpdate/{$Data.ID}" method="post">
                <div class="card-body pt-2">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Nama Warna</label>
                                <input class="form-control" type="text" name="NamaWarna" value="{$Data.NamaWarna}" required>
                            </div>
                        </div>
                       
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="example-text-input" class="form-control-label">Status</label>
                                <select class="form-select" aria-label="Default select example" name="Status" required>
                                    <option>-- Pilih Status --</option>
                                    <option value="1" <% if $Data.Status == 1 %> selected <% end_if %> >Aktif</option>
                                    <option value="0" <% if $Data.Status == 0 %> selected <% end_if %> >Non Aktif</option>                                
                                </select>
                            </div>
                        </div>
                        
                    </div>
                </div>

                <div class="card-footer pt-0 pb-2">
                    <a href="#" class="btn bg-gradient-primary btn-sm ms-auto btn-save">Simpan</a>
                    <a href="{$BaseHref}Warna" class="btn btn-outline-primary btn-sm ms-auto">Batal</a>
                </div>
            </form>
        </div>
    </div>
</div>