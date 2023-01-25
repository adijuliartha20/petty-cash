<?= $this->extend('layout/admin');  ?>          

<?= $this->section('content');  ?>          

          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper">
                
                <div class="element-box">
                  <h5 class="form-header">
                    Master <?php echo $title;?>
                  </h5>
                  <div class="form-desc"></div>
                  <div class="table-responsive">
                    <table id="dataTable1" width="100%" class="table table-striped table-lightfont">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Dibuat</th>
                          <th>Diubah</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Nama</th>
                          <th>Dibuat</th>
                          <th>Diubah</th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php 
                            $i=1;
                            foreach($kota as $k) :?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $k['kota'] ?></td>
                            <td><?php echo $k['created_at'] ?></td>
                            <td><?php echo $k['updated_at'] ?></td>
                            <td>
                              <a href="<?php echo base_url().'/kota/edit/'.$k['id_kota']; ?>"><i class="os-icon os-icon-ui-49"></i></a>
                              <a class="danger" href="#"><i class="os-icon os-icon-ui-15"></i></a>
                            </td>
                          </tr>
                          <?php endforeach; ?>                          
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
<?= $this->endSection();  ?>          