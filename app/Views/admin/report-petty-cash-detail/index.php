<?= $this->extend('layout/admin');  ?>          

<?= $this->section('content');  ?>

<div class="content-i">
	<div class="content-box">
		<div class="control-header">
			<div class="row align-items-center">
				<div class="col-8 col-lg-7">
					<form action="" class="form-inline form-inline-pcd">
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
				</div>
			</div>
		</div>

		<div class="element-wrapper" id="elementWrapper">

		</div><!-- ELEMENT WRAPPER -->
		    
	</div>
</div>
<?= $this->endSection();  ?>  