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
              <label for=""> Nama Kota</label>
              <input class="form-control" name="kota" data-error="Nama kota wajib diisi"  placeholder="Masukkan nama kota" required="required" value="<?php echo (isset($kota['kota'])? $kota['kota']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>            
            <div class="form-buttons-w">
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <?php if(isset($kota['id_kota'])): ?>
              <input type="hidden" name="id" value="<?php echo $kota['id_kota']; ?>">
            <?php endif;?>

          </form>
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