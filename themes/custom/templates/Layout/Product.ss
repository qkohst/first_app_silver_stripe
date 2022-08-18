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
              <div class="card mt-4">
                <div class="card-header pb-0 p-3">
                  <div class="row">
                    <div class="col-6 d-flex align-items-center">
                      <h6 class="mb-0">Data $siteParent </h6>
                    </div>
                    <div class="col-6 text-end">
                      <a class="btn btn-sm bg-gradient-info" href="{$BaseHref}Product/print" target="_blank"><i class="icofont-print"></i>&nbsp;&nbsp;Print</a>
                      <a class="btn btn-sm bg-gradient-primary" href="{$BaseHref}Product/download"><i class="icofont-download"></i>&nbsp;&nbsp;Download</a>
                      <a class="btn btn-sm bg-gradient-success" href="{$BaseHref}Product/addData"><i class="icofont-plus"></i>&nbsp;&nbsp;Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card-body p-3">
                  <div class="table-responsive p-0">
                    <table id="tableProduct" class="table align-items-center mb-0">
                      <thead>
                        <tr>
                          <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                          <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                          <th class="text-secondary opacity-7"></th>
                        </tr>
                      </thead>
                      <tbody>
                        <%-- <% if $CountData == 0 %>

                          <tr>
                              <td class="align-middle text-center" colspan="3">
                                  <p class="text-xs font-weight-bold mb-0"">Data tidak ditemukan</p>
                              </td>
                          </tr>

                        <% else %>
                        
                        <% loop $Data %>
                          
                          <tr>
                            <td>
                              <div class="d-flex px-2 py-1">
                                <div>
                                  <img src="{$BaseHref}/public/assets/GambarProduct/{$Gambar.last.NamaGambar}" class="avatar avatar-sm me-2" alt="Img">
                                </div>
                                <div class="d-flex flex-column justify-content-center">
                                  <h6 class="mb-0 text-sm">{$NamaProduct}</h6>
                                </div>
                              </div>
                            </td>
                            <td class="align-middle text-center text-sm">
                              <% if $Status == 1 %>
                                <span class="badge badge-sm bg-gradient-success">Aktif</span>
                              <% else %>
                                <span class="badge badge-sm bg-gradient-danger">Non Aktif</span>
                              <% end_if %>
                            </td>
                            <td class="align-middle">
                                <a href="javascript:;" class="btn btn-link text-secondary mb-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont-options"></i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end  px-2 pt-3 pb-0" aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="{$BaseHref}Product/detail/{$ID}">
                                            <i class="icofont-eye-alt mx-2"></i> Detail
                                        </a>
                                        <a class="dropdown-item border-radius-md" href="{$BaseHref}Product/edit/{$ID}">
                                            <i class="icofont-ui-edit mx-2"></i> Edit
                                        </a>
                                        <a href="#" class="dropdown-item border-radius-md btn-delete" data-id="{$ID}">
                                            <i class="icofont-ui-delete mx-2"></i> Hapus
                                        </a>
                                        <form action="{$BaseHref}Product/doDelete/{$ID}" method="post" id="delete{$ID}">
                                        </form>
                                    </li>
                                </ul>
                            </td>
                          </tr>
                        
                        <% end_loop %>

                        <% end_if %> --%>

                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
    </div>
</div>