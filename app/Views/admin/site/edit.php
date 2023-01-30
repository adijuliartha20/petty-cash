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
              <label for=""> Nama Site</label>
              <input class="form-control" name="site" data-error="Nama site wajib diisi"  placeholder="Masukkan nama site" required="required" value="<?php echo (isset($dt['site'])? $dt['site']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label for="">Kota</label>
              <select class="form-control" name="id_kota" required="required" onChange="getArea(event)">
                <option value="">Silahkan pilih kota</option>
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
            <div class="form-group">
              <label for="">Area</label>
              <select class="form-control" name="id_area" id="area">
                 <?php 
                  $id_area = '';
                    if(isset($dt['id_area'])) $id_area = $dt['id_area'];
                  ?>
                  <?php foreach ($area as $a):?>
                    <option <?php echo ($a['id_area']==$id_area? 'selected':'') ?>  value="<?php echo $a['id_area']; ?>">
                      <?php echo $a['area']; ?>
                    </option>
                  <?php endforeach; ?> 
              </select>
            </div>
            <div class="form-group">
              <label for=""> Alamat</label>
              <input class="form-control" name="alamat" data-error="Alamat wajib diisi"  placeholder="Masukkan alamat site" required="required" value="<?php echo (isset($dt['alamat'])? $dt['alamat']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-buttons-w">
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <input type="hidden" id="act" value="<?php echo $ajax; ?>">
            <?php if(isset($dt['id_site'])): ?>
              <input type="hidden" name="id" value="<?php echo $dt['id_site']; ?>">
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