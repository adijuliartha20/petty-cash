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
              <label for="">Data Klaim</label>
              <select class="form-control" name="id_klaim">
                <?php 
                  $id_klaim = '';
                  if(isset($dt['id_klaim'])) $id_klaim = $dt['id_klaim'];
                ?>
                <?php foreach ($klaim as $k):?>
                  <option <?php echo ($k['id_klaim']==$id_klaim? 'selected':'') ?>  value="<?php echo $k['id_klaim']; ?>">
                    <?php echo '['.date('d M Y',strtotime($k['tanggal'])).'] - '.$k['site'].' - '.$k['type'].' - '.$k['nama'].' - '.number_format(($k['total']-$k['bayar']), 0, '', '.'); ?>
                  </option>
                <?php endforeach; ?> 
              </select>
            </div>
            <div class="form-group">
              <label for="">Jumlah</label>
              <input class="form-control" name="jumlah" data-error="Jumlah wajib diisi"  placeholder="Masukkan jumlah" required="required" value="<?php echo (isset($dt['jumlah'])? $dt['jumlah']:''); ?>" type="number">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div>
              <label for="">Bukti</label>
            </div>
            <?php 
              
            if(isset($dt['id_reimburse'])): ?>
              <input type="hidden" name="id" value="<?php echo $dt['id_reimburse']; ?>">
            <?php endif;?>
            <button type="submit" id="trigger-submit" class="invisible-btn">Simpan</button>
          </form>

          <form id="my-great-dropzone" class="dropzone" action="<?php echo $upload;?>" enctype="multipart/form-data">
            <div class="preview"></div>
            <input type="hidden" id="id" name="id_data" value="<?php echo $dt['id_reimburse']; ?>">
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

          <?php if(session()->getFlashdata('pesanError')) : ?>
          <div class="alert alert-success" role="alert">
              <?php echo session()->getFlashdata('pesanError');?>
          </div>
          <?php  endif; ?>
      </div>
    </div>
  </div>    
</div>
<?= $this->endSection();  ?>          