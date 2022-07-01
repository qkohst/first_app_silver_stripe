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
                      <a class="btn bg-gradient-primary mb-0" href="{$BaseHref}Product/addData"><i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah</a>
                    </div>
                  </div>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                  <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Product</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                   <% if $CountData == 0 %>

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
                              <img src="$ThemeDir/assets/GambarProduct/{$gambar.AbsoluteURL()}" class="avatar avatar-sm me-3" alt="user6">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm">{$gambar.fileName}</h6>
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
                          <a class="btn btn-link text-primary px-2 mb-0" href="{$BaseHref}Product/detail/{$ID}">Detail</a>
                          <a class="btn btn-link text-warning px-2 mb-0" href="{$BaseHref}Product/edit/{$ID}">Edit</a>
                          <a href="#" class="btn btn-link text-danger px-2 mb-0 btn-delete" title="Hapus" data-id="{$ID}">Hapus</a>
                          <form action="{$BaseHref}Product/doDelete/{$ID}" method="post" id="delete{$ID}">
                          </form>
                        </td>
                      </tr>
                    
                    <% end_loop %>

                    <% end_if %>

                  </tbody>
                </table>
              </div>
                </div>
              </div>
    </div>
</div>