<main role="main" class="col-md-12 ml-sm-auto">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title; ?></h1>
  </div>
  <div class="row mb-2">
    <div class="col-md-6">
      <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#formModalWali">
        <i class="fas fa-plus"></i> Tambah Data Wali Kelas
      </button>
      <?php if(validation_errors()) : ?>
        <div class="alert alert-danger" role="alert"><?= validation_errors(); ?></div>
      <?php endif; ?>
      <?= $this->session->flashdata('pesan'); ?>
    </div>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          
          <?= form_open('admin/wali/ubahDataWali'); ?>
          <input type="hidden" name="kelas" id="kelas" value="<?= $guruWali['kelas']; ?>">
          <div class="form-group">
            <label for="kelas">Kelas</label>
            <input type="text" name="kelas" id="kelas" class="form-control" value="<?= $guruWali['kelas']; ?>" readonly>
            <small class="muted text-danger"><?= form_error('kelas'); ?></small>
          </div>
          <div class="form-group">
            <label for="nama">Nama Guru</label>
            <select name="nama" id="nama" class="form-control">
              <option value="">-- Pilih Guru --</option>
              <?php foreach($guru as $g) : ?>
                <?php if($g['id_guru'] == $guruWali['id_guru']) : ?>
                <option value="<?= $g['id_guru']; ?>" selected><?= $g['nama_guru']; ?></option>
                <?php else : ?>
                  <option value="<?= $g['id_guru']; ?>"><?= $g['nama_guru']; ?></option>
                <?php endif; ?>
              <?php endforeach; ?>
            </select>
            <small class="muted text-danger"><?= form_error('nama'); ?></small>
          </div>
          <div class="form-group">
            <a href="<?= base_url('admin/wali'); ?>" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</main>

<!-- Modal -->
<div class="modal fade" id="formModalWali" tabindex="-1" aria-labelledby="formModalLabelWali" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="formModalLabelWali">Tambah Data Wali Kelas</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body"></div>
    </div>
  </div>
</div>