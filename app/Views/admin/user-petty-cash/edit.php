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
              <label for="">Nama</label>
              <input class="form-control" name="nama" data-error="Nama wajib diisi"  placeholder="Masukkan nama" required="required" value="<?php echo (isset($dt['nama'])? $dt['nama']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label for="">KTP</label>
              <input class="form-control" name="ktp" data-error="KTP wajib diisi"  placeholder="Masukkan No KTP" required="required" value="<?php echo (isset($dt['ktp'])? $dt['ktp']:''); ?>" type="number">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label for="">No Telpon</label>
              <input class="form-control" name="telpon" data-error="Telpon wajib diisi"  placeholder="Masukkan No Telpon" required="required" value="<?php echo (isset($dt['telpon'])? $dt['telpon']:''); ?>" type="number">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label for=""> Email</label><input class="form-control" data-error="Your email address is invalid" placeholder="Enter email" required="required" type="email" name="email" value="<?php echo (isset($dt['email'])? $dt['email']:''); ?>">
              <div class="help-block form-text with-errors form-control-feedback"></div>
            </div>
            <div class="form-group">
              <label> Alamat</label>
              <textarea class="form-control" rows="3" name="alamat"><?php echo (isset($dt['alamat'])? $dt['alamat']:''); ?></textarea>
            </div>
            <div class="form-group">
              <label for="">Group User</label>
              <select class="form-control" name="id_group_user">
                <?php 
                  $id_group_user = '';
                  if(isset($dt['id_group_user'])) $id_group_user = $dt['id_group_user'];
                ?>
                <?php foreach ($group as $g):?>
                  <option <?php echo ($g['id_group_user']==$id_group_user? 'selected':'') ?>  value="<?php echo $g['id_group_user']; ?>">
                    <?php echo $g['group_user']; ?>
                  </option>
                <?php endforeach; ?> 
              </select>
            </div>
            <div class="form-buttons-w">
              <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
            <?php 
              
            if(isset($dt['id_user_petty_cash'])): ?>
              <input type="hidden" name="id" value="<?php echo $dt['id_user_petty_cash']; ?>">
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