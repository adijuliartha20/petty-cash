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
              <label for="">Jumlah</label>
              <input class="form-control" name="jumlah" data-error="Jumlah wajib diisi"  placeholder="Masukkan jumlah" required="required" value="<?php echo (isset($dt['jumlah'])? $dt['jumlah']:''); ?>" type="number">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label for="">Sumber</label>
              <input class="form-control" name="sumber" data-error="Sumber wajib diisi"  placeholder="Masukkan sumber" required="required" value="<?php echo (isset($dt['sumber'])? $dt['sumber']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>                     
            <?php               
            if(isset($dt['id_kas'])): ?>
              <input type="hidden" name="id" value="<?php echo $dt['id_kas']; ?>">
            <?php endif;?>
            <button type="submit" id="trigger-submit" class="invisible-btn">Simpan</button>
          </form>
          <form id="my-great-dropzone" class="dropzone" action="<?php echo $upload;?>" enctype="multipart/form-data">
            <div class="preview"></div>
            <input type="hidden" id="id" name="id_kas" value="<?php echo $dt['id_kas']; ?>">
            
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