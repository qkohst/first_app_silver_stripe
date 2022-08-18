 <div class="row mt-4">
     <div class="col-12">
         <% if $Status == "success" %>
         <div class="alert alert-success alert-message fade show" role="alert">
             <strong>$msg</strong>
         </div>
         <% else_if $Status == "error" %>
         <div class="alert alert-danger alert-message fade show" role="alert">
             <strong>$msg</strong>
         </div>
         <% end_if %>
     </div>
     <div class="col-lg-5">
         <div class="card card-carousel overflow-hidden h-100 p-0">
             <div id="carouselExampleCaptions" class="carousel slide h-100" data-bs-ride="carousel">
                 <div class="carousel-inner border-radius-lg h-100">
                     <div class="carousel-item h-100 active"
                         style="background-image: url('{$BaseHref}public/assets/GambarProduct/{$Data.Gambar.last.NamaGambar}'); background-size: cover;">
                     </div>
                 </div>
                 <button class="carousel-control-prev w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                     data-bs-slide="prev">
                     <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                     <span class="visually-hidden">Previous</span>
                 </button>
                 <button class="carousel-control-next w-5 me-3" type="button" data-bs-target="#carouselExampleCaptions"
                     data-bs-slide="next">
                     <span class="carousel-control-next-icon" aria-hidden="true"></span>
                     <span class="visually-hidden">Next</span>
                 </button>
             </div>
         </div>
     </div>
     <div class="col-lg-7 mb-lg-0 mb-4">
         <div class="card z-index-2 h-100">
             <div class="card-header pb-0 pt-3 bg-transparent">
                 <div class="row">
                     <div class="col-6 d-flex align-items-center">
                         <h6 class="mb-0">Pilihan Warna </h6>
                     </div>
                 </div>
             </div>
             <div class="card-body pt-0">
                 <div class="table-responsive p-0">
                     <table class="table align-items-center mb-0">
                         <thead>
                             <tr>
                                 <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Warna
                                 </th>
                                 <th
                                     class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                     Stok</th>
                                 <th
                                     class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                     Harga</th>
                                 <th class="text-secondary opacity-7"></th>
                             </tr>
                         </thead>
                         <tbody>
                             <% loop $Data.Warnaproduct %>

                             <tr>
                                 <td>
                                     <div class="d-flex px-2 py-1">
                                         <div class="d-flex flex-column justify-content-center">
                                             <h6 class="mb-0 text-sm text-dark">{$Warna.NamaWarna}</h6>
                                         </div>
                                 </td>
                                 <td class="align-middle text-center text-sm">
                                     <span class="badge badge-sm bg-gradient-info">{$Stok}</span>
                                 </td>
                                 <td class="align-middle text-center text-sm">
                                     <span class="badge badge-sm bg-gradient-info">Rp. <span
                                             class="uang">{$HargaProduct.last.Harga}</span></span>
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
                                                 href="{$BaseHref}Product/editStokHarga/{$ID}">
                                                 <i class="icofont-ui-edit mx-2"></i> Edit Stok & Harga
                                             </a>
                                             <%-- <a href="#" class="dropdown-item border-radius-md btn-delete" data-id="{$ID}">
                                                <i class="icofont-ui-delete mx-2"></i> Hapus
                                            </a>
                                            <form action="{$BaseHref}Product/doDelete/{$ID}" method="post" id="delete{$ID}">
                                            </form> --%>
                                         </li>
                                     </ul>
                                 </td>
                             </tr>

                             <% end_loop %>
                         </tbody>
                     </table>
                 </div>
             </div>
         </div>
     </div>
 </div>

 <div class="row">
     <div class="col-md-12">
         <%-- Deskripsi --%>
         <div class="card mt-4">
             <div class="card-header pb-0">
                 <div class="row">
                     <div class="col-12 d-flex align-items-center">
                         <h5 class="mb-0">{$Data.NamaProduct}</h5>
                     </div>
                 </div>
             </div>
             <div class="card-body pt-0 pb-2">
                 <hr class="horizontal dark">
                 <div class="row">
                     <div class="col-md-12">
                         <p>{$Data.DeskripsiProduct.raw}</p>
                     </div>
                 </div>
             </div>
         </div>
     </div>
 </div>
