<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Jekyll v4.1.1">
    <title><?= $title; ?></title>

    <!-- Bootstrap core CSS -->
<link href="<?= base_url('/assets/'); ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?= base_url('/assets/'); ?>css/dashboard.css" rel="stylesheet">
<link href="<?= base_url('/assets/'); ?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet">

    <!-- Favicons -->
<link rel="apple-touch-icon" href="/docs/4.5/assets/img/favicons/apple-touch-icon.png" sizes="180x180">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-32x32.png" sizes="32x32" type="image/png">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon-16x16.png" sizes="16x16" type="image/png">
<link rel="manifest" href="/docs/4.5/assets/img/favicons/manifest.json">
<link rel="mask-icon" href="/docs/4.5/assets/img/favicons/safari-pinned-tab.svg" color="#563d7c">
<link rel="icon" href="/docs/4.5/assets/img/favicons/favicon.ico">
<meta name="msapplication-config" content="/docs/4.5/assets/img/favicons/browserconfig.xml">
<meta name="theme-color" content="#563d7c">


    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
      .footer {
        position: fixed;
        left: 0;
        bottom: 0;
        background-color: white;
        width: 100%;
        text-align: center;
      }
    </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
  </head>
  <body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
      <h3><a class="navbar-brand" href="<?= base_url('admin/dashboard'); ?>">SPP SEKOLAH DASAR</a></h3>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Master
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="<?= base_url('admin/users'); ?>">User</a>
              <a class="dropdown-item" href="<?= base_url('admin/guru'); ?>">Guru</a>
              <a class="dropdown-item" href="<?= base_url('admin/wali'); ?>">Wali</a>
              <a class="dropdown-item" href="<?= base_url('admin/siswa'); ?>">Siswa</a>
              <a class="dropdown-item" href="<?= base_url('admin/transaksi'); ?>">Transaksi</a>
            </div>
          </li>
          <li class="nav-item active">
          <a class="nav-link <?= $this->uri->segment(2) == 'laporan' ? ' active' : '' ?>" href="<?= base_url('admin/laporan'); ?>">
            Laporan
            </a>
          </li>
          <li class="nav-item active">
          <a class="nav-link" href="<?= base_url('auth/logout'); ?> ">
            Log Out
          </a>
          </li>
        </ul>
      </div>
    </div>
  </nav>