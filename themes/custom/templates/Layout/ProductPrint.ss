  <section>
      <!-- title row -->
      <div style="text-align: center;">
          <h2>
              $Title
          </h2>
      </div>

      <!-- Table row -->
      <div>
          <div>
              <table>
                  <thead>
                      <tr>
                          <th style="text-align: center;">Nama Product</th>
                          <th style="text-align: center;">Status</th>
                          <th style="text-align: center;">Warna</th>
                          <th style="text-align: center;">Stok</th>
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

