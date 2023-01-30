<?= $this->extend('layout/admin');  ?>          

<?= $this->section('content');  ?>

<div class="content-i">
  <div class="content-box">
    <div class="row">
      <div class="col-sm-12">
        
        <div class="element-wrapper">
          <div class="element-box">
            <h5 class="form-header">
              Laporan Petty Cash
            </h5>
            <div class="form-desc">
              
            </div>
            <form class="form-inline form-report">
                <div class="form-group">
                  <label for="">Mulai&nbsp;&nbsp;</label>
                  <div class="date-input">
                    <input class="single-daterange form-control" placeholder="Silahkan pilih tanggal mulai" type="text" id="mulai">
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Akhir&nbsp;&nbsp;</label>
                  <div class="date-input">
                    <input class="single-daterange form-control" placeholder="Silahkan pilih tanggal akhir" type="text" id="akhir">
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary" type="button" onClick="findReport()">Cari</button>
                </div>
                <input type="hidden" id="getReport" value="<?php echo $actGetReport; ?>">
            </form>

            <div class="table-responsive">
              <!--------------------
              START - Basic Table
              -------------------->
              <table id="tableReport" class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Tanggal</th>
                    <th>Site</th>
                    <th>Petty Cash Group</th>
                    <th>Oleh</th>
                    <th class="text-center">Debit</th>
                    <th class="text-center">Kredit</th>
                    <th class="text-right">Saldo</th>
                  </tr>
                </thead>
                <tbody>
                  <tr id="defaultRow">
                    <td colspan="7" class="text-center">
                      Tidak ada data yang ditampilkan
                    </td>
                  </tr>
                  <!--<tr>
                    <td>01/04/2023</td>
                    <td class="text-center" colspan="3">Kas Masuk</td>
                    <td>5.000.000</td>
                    <td></td>                    
                    <td></td>
                  </tr>
                  <tr>
                    <td>02/04/2023</td>
                    <td>Pondok Lensa Bali</td>
                    <td>ATK</td>
                    <td>Adi Juliartha</td>
                    <td></td>
                    <td>700.000</td>
                    <td>4.300.000</td>
                  </tr>
                  <tr>
                    <td>03/04/2023</td>
                    <td>Pondok Lensa Bandung</td>
                    <td>Rapat Luar Kota</td>
                    <td>Adi Juliartha</td>
                    <td></td>
                    <td>500.000</td>
                    <td>3.800.000</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4"><h6>Total</h6></th>
                    <th><h6>5.000.000</h6></th>
                    <td><h6>1.200.000</h6></td>
                    <th><h6>3.800.000</h6></th>
                  </tr>-->
                </tfoot>
              </table>
              <!--------------------
              END - Basic Table
              -------------------->
            </div>
          </div>
        </div>

      </div>
    </div>  
  </div>
</div>  

<?= $this->endSection();  ?>          