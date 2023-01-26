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
              <label for=""> Nama Area</label>
              <input class="form-control" name="area" data-error="Nama area wajib diisi"  placeholder="Masukkan nama area" required="required" value="<?php echo (isset($dt['area'])? $dt['area']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label for="">Kota</label>
              <select class="form-control" name="id_kota">
                <?php 
                  $id_kota = '';
                  if(isset($dt['id_kota'])) $id_kota = $dt['id_kota'];
                ?>
                

                <?php foreach ($kota as $k):?>
                  <option <?php echo ($k['id_kota']==$id_kota? 'selected':'') ?>  value="<?php echo $k['id_kota']; ?>">
                    <?php echo $k['kota']; ?>
                  </option>
                <?php endforeach; ?> 
              </select>
            </div>
            <div class="form-buttons-w">
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <?php if(isset($dt['id_area'])): ?>
              <input type="hidden" name="id" value="<?php echo $dt['id_area']; ?>">
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