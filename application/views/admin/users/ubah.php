<main role="main" class="col-md-12 ml-sm-auto">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title; ?></h1>
  </div>
  <div class="card">
    <div class="card-body">
      <div class="row">
        <div class="col-md">
          <?= form_open(''); ?>
          <input type="hidden" name="id_user" value="<?= $users['id_user']; ?>">
          <div class="form-group">
            <label for="nama">Nama Lengkap</label>
            <input type="text" name="nama" id="nama" class="form-control" value="<?= $users['nama_lengkap']; ?>">
            <small class="muted text-danger"><?= form_error('nama'); ?></small>
          </div>
          <div class="form-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" class="form-control" value="<?= $users['username']; ?>">
            <small class="muted text-danger"><?= form_error('username'); ?></small>
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control">
            <small class="muted text-danger"><?= form_error('password'); ?></small>
          </div>
          <div class="form-group">
            <a href="<?= base_url('admin/users'); ?>" class="btn btn-secondary" data-dismiss="modal">Kembali</a>
            <button type="submit" class="btn btn-primary">Ubah</button>
          </div>
          <?= form_close(); ?>
        </div>
      </div>
    </div>
  </div>
</main>

