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