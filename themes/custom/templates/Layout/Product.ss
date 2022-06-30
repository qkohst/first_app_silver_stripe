<div class="row">
    <div class="col-md-12 mb-lg-0 mb-4">
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
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Author</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Function</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Employed</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                  
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="$ThemeDir/assets/img/team-4.jpg" class="avatar avatar-sm me-3" alt="user6">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">Miriam Eric</h6>
                            <p class="text-xs text-secondary mb-0">miriam@creative-tim.com</p>
                          </div>
                        </div>
                      </td>
                      <td>
                        <p class="text-xs font-weight-bold mb-0">Programtor</p>
                        <p class="text-xs text-secondary mb-0">Developer</p>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-secondary">Offline</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold">14/09/20</span>
                      </td>
                      <td class="align-middle">
                        <a class="btn btn-link text-primary px-2 mb-0" href="{$BaseHref}Product/detail/{$ID}">Detail</a>
                        <a class="btn btn-link text-warning px-2 mb-0" href="{$BaseHref}Product/edit/{$ID}">Edit</a>
                        <a href="#" class="btn btn-link text-danger px-2 mb-0 btn-delete" title="Hapus" data-id="{$ID}">Hapus</a>
                        <form action="{$BaseHref}Product/doDelete/{$ID}" method="post" id="delete{$ID}">
                        </form>
                      </td>
                    </tr>

                  </tbody>
                </table>
              </div>
                </div>
              </div>
    </div>
</div>