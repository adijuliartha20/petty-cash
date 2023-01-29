<?= $this->extend('layout/admin');  ?>          

<?= $this->section('content');  ?>          
<div class="content-i">
  <div class="content-box">
    <div class="row">
      <div class="col-sm-12">
        <div class="element-wrapper">
          <div class="element-box">
          <form id="formValidate" action="<?php echo $action; ?>" method="post">
            <?php echo csrf_field(); ?>
            <h5 class="form-header">
              Form <?php echo $title; ?>
            </h5>
            <div class="form-desc"></div>
            <div class="form-group">
              <label for="">Tanggal</label>
              <input class="single-daterange form-control" placeholder="Tanggal Masuk Kas" type="text" value="<?php echo (isset($dt['tanggal'])? date('d/m/Y',strtotime($dt['tanggal'])):'01/01/2023'); ?>" required="required" name="tanggal">
            </div>

            <div class="form-group">
              <label for="">Site</label>
              <select class="form-control" name="id_site">
                <?php 
                  $id_site = '';
                  if(isset($dt['id_site'])) $id_site = $dt['id_site'];
                ?>
                <?php foreach ($sites as $s):?>
                  <option <?php echo ($s['id_site']==$id_site? 'selected':'') ?>  value="<?php echo $s['id_site']; ?>">
                    <?php echo $s['site']; ?>
                  </option>
                <?php endforeach; ?> 
              </select>
            </div>

            <div class="form-group">
              <label for="">Petty Cash Group</label>
              <select class="form-control" name="id_petty_cash_group">
                <?php 
                  $id_petty_cash_group = '';
                  if(isset($dt['id_petty_cash_group'])) $id_petty_cash_group = $dt['id_petty_cash_group'];
                ?>
                <?php foreach ($pettyCashGroup as $pcg):?>
                  <option <?php echo ($pcg['id_petty_cash_group']==$id_petty_cash_group? 'selected':'') ?>  value="<?php echo $pcg['id_petty_cash_group']; ?>">
                    <?php echo $pcg['petty_cash_group']; ?>
                  </option>
                <?php endforeach; ?> 
              </select>
            </div>

            <div class="form-group">
              <label for="">Pengaju</label>
              <select class="form-control" name="id_user_petty_cash">
                <?php 
                  $id_user_petty_cash = '';
                  if(isset($dt['id_user_petty_cash'])) $id_user_petty_cash = $dt['id_user_petty_cash'];
                ?>
                <?php foreach ($userPettyCash as $upc):?>
                  <option <?php echo ($upc['id_user_petty_cash']==$id_user_petty_cash? 'selected':'') ?>  value="<?php echo $upc['id_user_petty_cash']; ?>">
                    <?php echo $upc['nama']; ?>
                  </option>
                <?php endforeach; ?> 
              </select>
            </div>

            <!--START DETAIL-->
            <div class="form-group">
              <h5 class="form-header">Detail Data Barang</h5>
              <div class="form-inline form-tambah-data-barang">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Nama Barang" type="text" id="iNama">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Harga" type="number" id="iHarga">
                <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Jumlah" type="number" id="iJumlah">
                <input type="hidden" id="rowEdit">
                <button type="button" class="mr-2 mb-2 btn btn-lg btn-outline-info plus-detail" onClick="addData()">+</button>
              </div>
              <table id="tblDetail" class="table table-striped table-bordered table-detail-barang">
                <thead>
                  <tr>
                    <th>Nama</th>
                    <th class="text-center">Harga</th>
                    <th class="text-center">Jumlah</th>
                    <th class="text-right">Sub Total</th>
                    <th class="row-actions">Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php if(empty($dataKlaim)): ?>
                  <tr id="defaultRow">
                    <td class="text-center" colspan="5">Belum ada data...</td>
                  </tr>
                  <?php else: ?>
                    <?php
                    foreach ($dataKlaim as $key => $dk) {
                      ?>
                      <tr id="trDetail<?php echo $key; ?>">
                        <td>
                          <input id="nama<?php echo $key; ?>" type="text" name="nama[]" value="<?php echo $dk['nama'];?>" class="plain-input" readonly="true"> 
                        </td>
                        <td class="text-center">
                          <input type="numeric" id="harga<?php echo $key;?>" name="harga[]" value="<?php echo $dk['harga']; ?>" class="plain-input" readonly="true"> 
                        </td>
                        <td class="text-center">
                          <input type="numeric" id="jumlah<?php echo $key;?>" name="jumlah[]" value="<?php echo $dk['jumlah']; ?>" class="plain-input" readonly="true">
                        </td>
                        <td class="text-right" id="subTotal<?php echo $key; ?>">
                          <?php echo ($dk['harga'] * $dk['jumlah']) ?>
                        </td>
                        <td class="row-actions">
                          <button class="" type="button" onClick="editRowViewHTML(<?php echo $key; ?>)"><i class="os-icon os-icon-ui-49"></i></button>
                          <button class="danger" type="button" onClick="deleteRowHTML(<?php echo $key; ?>)"><i class="os-icon os-icon-ui-15"></i></button>
                        </td>
                        
                      </tr>
                      <?php
                    }
                    ?>
                  <?php endif;?>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="3">Total</th>
                    <th class="text-right">
                      <input type="numeric" id="total" name="total" readonly="true" value="<?php echo $dt['total']; ?>" class="plain-input total-barang">
                    </th>
                    <th></th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div>
              <label for="">Bukti</label>
            </div>
            <?php 
              
            if(isset($dt['id_klaim'])): ?>
              <input type="hidden" name="id" value="<?php echo $dt['id_klaim']; ?>">
            <?php endif;?>
            <button type="submit" id="trigger-submit" class="invisible-btn">Simpan</button>
          </form>

          <form id="my-great-dropzone" class="dropzone" action="<?php echo $upload;?>" enctype="multipart/form-data">
            <div class="preview"></div>
            <input type="hidden" id="id" name="id_data" value="<?php echo $dt['id_klaim']; ?>">
          </form>
          <div class="form-buttons-w">
            <button class="btn btn-primary" type="button" onClick="submit_form()">Simpan</button>
          </div>
          <input type="hidden" id="actDeleteFile" value="<?php echo $deleteFile; ?>">
          <input type="hidden" id="actGetFile" value="<?php echo $actGetFile; ?>">
          <input type="hidden" id="assetLink" value="<?php echo $assetLink; ?>">
          <input type="hidden" id="typeAsset" value="<?php echo $typeAsset; ?>">
          <p></p>
          <?php if(session()->getFlashdata('pesan')) : ?>
          <div class="alert alert-success" role="alert">
              <?php echo session()->getFlashdata('pesan');?>
          </div>
          <?php  endif; ?>
      </div>
    </div>
  </div>    
</div>
<?= $this->endSection();  ?>          