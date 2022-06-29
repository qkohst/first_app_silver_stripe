<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Data $siteParent</h6>
                    </div>
                   <div class="col-6 text-end">
                        <a class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#modalTambah"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah $siteParent</a>
                    </div>

                    <!-- Modal Tambah-->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTambahLabel">Tambah {$siteParent}</h5>
                            </div>
                            <form action="{$BaseHref}Warna/doSave" method="post">
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="example-text-input" class="form-control-label">Nama Warna</label>
                                            <input type="text" class="form-control" name="NamaWarna" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                            </form>
                        </div>
                    </div>
                    </div>

                  </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                    <table class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Warna</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                            <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <% loop $Data %>
                                <tr>
                                    <td class="align-middle px-4">
                                        <p class="text-xs font-weight-bold mb-0"">{$NamaWarna}</p>
                                    </td>
                                    <td class="align-middle text-center text-sm">
                                        <% if $Status == 1 %>
                                        <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                        <% else %>
                                        <span class="badge badge-sm bg-gradient-danger">Non Aktif</span>
                                        <% end_if %>
                                    </td>
                                    <td class="align-middle ms-auto text-center">
                                        <a class="btn btn-link text-warning px-2 mb-0" href="{$BaseHref}Warna/edit/{$ID}">Edit</a>
                                        <a href="#" class="btn btn-link text-danger px-2 mb-0 btn-delete" title="Hapus" data-id="{$ID}">Hapus</a>
                                        <form action="{$BaseHref}Warna/doDelete/{$ID}" method="post" id="delete{$ID}">
                                        </form>
                                    </td>
                                </tr>
                            <% end_loop %>
                        </tbody>
                    </table>
                </div>
              </div>
    </div>
</div>