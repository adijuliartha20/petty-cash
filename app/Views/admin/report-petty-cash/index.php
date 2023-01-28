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
            <form class="form-inline">
              <input type="date" name="mulai" class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="First Name">
              <label class="sr-only"> First Name</label>
              <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="First Name" type="text">
              <label class="sr-only"> Last Name</label>
              <input class="form-control mb-2 mr-sm-2 mb-sm-0" placeholder="Last Name" type="text">
              <label class="sr-only"> Username</label>
              <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                <div class="input-group-prepend">
                  <div class="input-group-text">
                    @
                  </div>
                </div>
                <input class="form-control" placeholder="Username" type="text">
              </div>
              <button class="btn btn-primary" type="submit"> Submit</button>
            </form>
          </div>
        </div>

      </div>
    </div>  
  </div>
</div>  

<?= $this->endSection();  ?>          