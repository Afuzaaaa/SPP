<main role="main" class="col-md-12 ml-sm-auto">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?= $title; ?></h1>
  </div>
  <div class="row mb-2">
    <div class="col-md-6">
      <?= $this->session->flashdata('pesan'); ?>
    </div>
  </div>
  <div class="card text-center">
    <div class="card-body">
      <div class="row">
        <div class="col-md-6 mx-auto">
          <div class="alert alert-info vertical-center-row" role="alert"><i class="fas fa-info"></i> Masukan NIS siswa yang sudah terdaftar untuk melihat pembayaran spp.</div>
          <?= form_open(''); ?>
          <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="NIS Siswa..." name="nis" autofocus="on">
            <div class="input-group-append">
              <button class="btn btn-outline-secondary" type="submit"><i class="fas fa-search"></i></button>
            </div>
          </div>
          <small class="muted text-danger"><?= form_error('nis'); ?></small>
          <?= form_close(); ?>
        </div>
      </div>

      <?php if($this->input->post('nis')) : ?>
      <!-- Biodata Siswa -->
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <h4 class="text-center">Biodata Siswa</h4>
          <table class="table">
            <tr>
              <th>NIS</th>
              <td>:</td>
              <td><?= $siswa['nis']; ?></td>
            </tr>
            <tr>
              <th>Nama Siswa</th>
              <td>:</td>
              <td><?= $siswa['nama_siswa']; ?></td>
            </tr>
            <tr>
              <th>Kelas</th>
              <td>:</td>
              <td><?= $siswa['kelas']; ?></td>
            </tr>
            <tr>
              <th>Tahun Ajaran</th>
              <td>:</td>
              <td><?= $siswa['tahun_ajaran']; ?></td>
            </tr>
          </table>
        </div>
      </div>
      <!-- /Biodata Siswa -->

      
      <!-- Spp Siswa -->
      <div class="row">
        <div class="col-md">
          <div class="table-responsive">
            <table class="table">
              <tr>
                <th>No</th>
                <th>Bulan</th>
                <th>Jatuh Tempo</th>
                <th>No.Bayar</th>
                <th>Tanggal Bayar</th>
                <th>Jumlah</th>
                <th>Keterangan</th>
                <th>Bayar</th>
              </tr>
              <?php $no = 1; foreach($spp as $s) : ?>
                 <tr>
                   <td><?= $no++; ?></td>
                   <td><?= $s['bulan']; ?></td>
                   <td><?= $s['jatuh_tempo']; ?></td>
                   <td><?= $s['no_bayar']; ?></td>
                   <td><?= $s['tgl_bayar']; ?></td>
                   <td><?= $s['jml']; ?></td>
                   <td><?= $s['ket']; ?></td>
                   <td>
                    <?php if($s['no_bayar'] == null) : ?>
                     <a href="<?= base_url('admin/transaksi/bayar/' . $siswa['nis'] . '/' . $s['id_spp']); ?>" class="btn btn-info">Bayar</a>
                     <?php else : ?>
                      <!-- <a href="<?= base_url('admin/transaksi/batal/' . $siswa['nis'] . '/' . $s['id_spp']); ?>" class="btn btn-danger btn-sm">Batal</a> -->
                      <a href="<?= base_url('admin/transaksi/cetak/' . $siswa['nis'] . '/' . $s['id_spp']); ?>" target="_blank" class="btn btn-primary">Cetak</a>
                    <?php endif; ?>
                   </td>
                 </tr>
              <?php endforeach; ?>
            </table>
          </div>
        </div>
      </div>
      <!-- /Spp Siswa -->
      <?php endif; ?>

    </div>
  </div>
</main>