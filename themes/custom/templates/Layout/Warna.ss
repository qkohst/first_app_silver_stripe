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
            <div class="card-header pb-0 p-3">
                <div class="row">
                    <div class="col-6 d-flex align-items-center">
                        <h6 class="mb-0">Data $siteParent</h6>
                    </div>
                    <div class="col-6 text-end">
                        <a class="btn bg-gradient-primary mb-0" data-bs-toggle="modal" data-bs-target="#modalTambah"><i
                                class="icofont-plus"></i>&nbsp;&nbsp;Tambah</a>
                    </div>

                    <!-- Modal Tambah-->
                    <div class="modal fade" id="modalTambah" tabindex="-1" aria-labelledby="modalTambahLabel"
                        aria-hidden="true">
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
                                                    <label for="example-text-input" class="form-control-label">Nama
                                                        Warna</label>
                                                    <input type="text" class="form-control" name="NamaWarna" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger mb-0"
                                            data-bs-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-success mb-0">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive p-0">
                    <table id="tableWarna" class="table align-items-center mb-0">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="75%">Warna</th>
                                <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" width="20%">Status</th>
                                <th class="text-secondary opacity-7" width="5%"></th>
                            </tr>
                        </thead>
                        <tbody>

                            <!-- <% if $CountData == 0 %>

                            <tr>
                                <td class="align-middle text-center" colspan="3">
                                    <p class="text-xs font-weight-bold mb-0"">Data tidak ditemukan</p>
                                    </td>
                                </tr>

                            <% else %>
                           
                            <% loop $Data %>
                                <tr>
                                    <td class=" align-middle px-4">
                                        <p class="text-xs font-weight-bold mb-0"">{$NamaWarna}</p>
                                    </td>
                                    <td class=" align-middle text-center text-sm">
                                            <% if $Status == 1 %>
                                            <span class="badge badge-sm bg-gradient-success">Aktif</span>
                                            <% else %>
                                            <span class="badge badge-sm bg-gradient-danger">Non Aktif</span>
                                            <% end_if %>
                                </td>
                                <td class="align-middle">
                                    <a href="javascript:;" class="btn btn-link text-secondary mb-0"
                                        id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                        <i class="icofont-options"></i>
                                    </a>
                                    <ul class="dropdown-menu  dropdown-menu-end  px-2 pt-3 pb-0"
                                        aria-labelledby="dropdownMenuButton">
                                        <li>
                                            <a class="dropdown-item border-radius-md"
                                                href="{$BaseHref}Warna/edit/{$ID}">
                                                <i class="icofont-ui-edit mx-2"></i> Edit
                                            </a>
                                            <a href="#" class="dropdown-item border-radius-md btn-delete"
                                                data-id="{$ID}">
                                                <i class="icofont-ui-delete mx-2"></i> Hapus
                                            </a>
                                            <form action="{$BaseHref}Warna/doDelete/{$ID}" method="post"
                                                id="delete{$ID}">
                                            </form>
                                        </li>
                                    </ul>
                                </td>
                            </tr>
                            <% end_loop %>

                            <% end_if %> -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
