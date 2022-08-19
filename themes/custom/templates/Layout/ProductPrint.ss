  <section>
      <!-- title row -->
      <div style="text-align: center;">
          <h2>
              DATA PRODUCT
          </h2>
      </div>

      <!-- Table row -->
      <div>
          <div>
              <table>
                  <thead>
                      <tr>
                          <th style="text-align: center;">NAMA PRODUCT</th>
                          <th style="text-align: center;">STATUS</th>
                          <th style="text-align: center;">WARNA</th>
                          <th style="text-align: center;">STOK</th>
                      </tr>
                  </thead>
                  <tbody>

                      <% loop $Data %>
                      <tr>
                          <td style="text-align: left;">{$NamaProduct}</td>
                          <td style="text-align: center;">
                              <% if $Status == 1 %>
                              Aktif
                              <% else %>
                              Non Aktif
                              <% end_if %>
                          </td>
                          <td style="text-align: center;">{$WarnaProduct.count}</td>
                          <td style="text-align: center;">{$WarnaProduct.Sum(Stok)}</td>
                      </tr>
                      <% end_loop %>
                  </tbody>
              </table>
          </div>
          <!-- /.col -->
      </div>
      <!-- /.row -->
  </section>

