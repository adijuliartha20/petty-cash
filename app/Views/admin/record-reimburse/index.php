<?= $this->extend('layout/admin');  ?>          

<?= $this->section('content');  ?>   
          <?php helper('number'); ?>       

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
                          <th>Tanggal</th>
                          <th>ID Klaim</th>
                          <th>Jumlah</th>
                          <th>Oleh</th>
                          <th>Dibuat</th>
                          <th>Diubah</th>
                          <th></th>
                        </tr>
                      </thead>
                      <tfoot>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>ID Klaim</th>
                          <th>Jumlah</th>
                          <th>Oleh</th>
                          <th>Dibuat</th>
                          <th>Diubah</th>
                          <th></th>
                        </tr>
                      </tfoot>
                      <tbody>
                          <?php 
                            $i=1;
                            foreach($data as $dt) :?>
                          <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $dt['tanggal'] ?></td>
                            <td><?php echo $dt['id_klaim'] ?></td>
                            <td><?php echo number_to_currency((isset($dt['jumlah'])? $dt['jumlah']:0), 'IDR', 'id_ID', 0);?></td>
                            <td><?php echo $dt['id_user'] ?></td>
                            <td><?php echo $dt['created_at'] ?></td>
                            <td><?php echo $dt['updated_at'] ?></td>
                            <td class="row-actions">
                              <a href="<?php echo base_url().'/'.$app.'/edit/'.$dt['id_reimburse']; ?>"><i class="os-icon os-icon-ui-49"></i></a>
                              <form action="<?php echo base_url().'/'.$app.'/'.$dt['id_reimburse']; ?>" method="post" class="form-action-table">
                                <?php echo csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button class="no-style-btn danger" type="submit" onClick="return confirm('Apakah anda yakin menghapus data ini?')"><i class="os-icon os-icon-ui-15"></i></button>  
                              </form>
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