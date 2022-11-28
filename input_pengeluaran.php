<?php
$host       = "localhost";
$user       = "root";
$pass       = "";
$db         = "project3";

$koneksi    = mysqli_connect($host, $user, $pass, $db);
if (!$koneksi) { //cek koneksi
    die("Tidak bisa terkoneksi ke database");
}

$id_pengeluaran = "";
$nama_barang    = "";
$tanggal        = "";
$stok           = "";
$total          = "";
$sukses          = "";
$error          = "";

if (isset($_GET['op'])) {
  $op = $_GET['op'];
} else {
  $op = "";
} 

// if($op == 'delete'){
//   $id         = $_GET['id'];
//   $sql1       = "delete from mahasiswa where id = '$id'";
//   $q1         = mysqli_query($koneksi,$sql1);
//   if($q1){
//       $sukses = "Berhasil hapus data";
//   }else{
//       $error  = "Gagal melakukan delete data";
//   }
// }
// if ($op == 'edit') {
//     $id_pengeluaran = $_GET['id_pengeluaran'];
//     $sql1           = "select * from pengeluaran where id_pengeluaran = '$id_pengeluaran'";
//     $q1             = mysqli_query($koneksi, $sql1);
//     $r1             = mysqli_fetch_array($q1);
//     $id_pengeluaran = $r1['id_pengeluaran'];
//     $nama_barang    = $r1['nama_barang'];
//     $tanggal        = $r1['tanggal'];
//     $stok           = $r1['stok'];
//     $total          = $r1['total'];

//     if ($id_pengeluaran == '') {
//         $error = "Data tidak ditemukan";
//     }
// }

if (isset($_POST['simpan'])) { //untuk create
$id_pengeluaran = $_POST['id_pengeluaran'];
$nama_barang    = $_POST['nama_barang'];
$tanggal        = $_POST['tanggal'];
$stok           = $_POST['stok'];
$total          = $_POST['total'];

  if ($id_pengeluaran && $nama_barang && $tanggal && $stok && $total) {
      if ($op == 'edit') { //untuk update
          $sql1       = "update pengeluaran set id_pengeluaran = '$id_pengeluaran',nama_barang='$nama_barang',tanggal = '$tanggal',stok='$stok', total=$total where id_pengeluaran = '$id_pengeluaran'";
          $q1         = mysqli_query($koneksi, $sql1);
          if ($q1) {
              $sukses = "Data berhasil diupdate";
          } else {
              $error  = "Data gagal diupdate";
          }
      } else { //untuk insert
          $sql1   = "insert into pengeluaran(id_pengeluaran,nama_barang,tanggal,stok,total) values ('$id_pengeluaran','$nama_barang','$tanggal','$stok','$total')";
          $q1     = mysqli_query($koneksi, $sql1);
          if ($q1) {
              $sukses     = "Berhasil memasukkan data baru";
          } else {
              $error      = "Gagal memasukkan data";
          }
      }
  } else {
      $error = "Silakan masukkan semua data";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="../assets/img/logoetalase.png">
  <title>
    Etalase Talisya Admin Shop
  </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <style>
    .mx-auto {
        width: 800px
    }

    .card {
        margin-top: 10px;
    }
    </style>
</head>

<body>
    <div class="mx-auto">

        <!-- untuk memasukkan data -->
        <div class="card">
            <div class="card-header">
                Create / Edit Data
            </div>
            <div class="card-body">
                <?php
                if ($error) {
                ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                </div>
                <?php
                    header("refresh:5;url=input_pengeluaran.php");//5 : detik
                }
                ?>
                <?php
                if ($sukses) {
                ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                </div>
                <?php
                    header("refresh:5;url=input_pengeluaran.php");
                }
                
                ?>

                <!-- untuk menambahkan data kedalam database -->
                <form action="" method="POST">
                    <div class="mb-3 row">
                        <label for="id_pengeluaran" class="col-sm-2 col-form-label">ID Pengeluaran</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id_pengeluaran" name="id_pengeluaran" value="<?php echo $id_pengeluaran ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="nama_barang" class="col-sm-2 col-form-label">Nama Barang</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="nama_barang" name="nama_barang" value="<?php echo $nama_barang ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="tanggal" class="col-sm-2 col-form-label">Tanggal</label>
                        <div class="col-sm-10">
                            <input type="datetime-local" class="form-control" id="tanggal" name="tanggal"
                                value="<?php echo $tanggal ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                    <label for="stok" class="col-sm-2 col-form-label">Stok</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="stok" name="stok"
                                value="<?php echo $stok ?>">
                        </div>
                        </div>
                    <div class="mb-3 row">
                    <label for="total" class="col-sm-2 col-form-label">Total</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="total" name="total"
                                value="<?php echo $total ?>">
                    </div>
                    <div class="col-12">
                        <input type="submit" name="simpan" value="Simpan Data" class="btn btn-primary" />
                    </div>
                </form>
            </div>
        </div>

        <!-- untuk mengeluarkan data --> 
        <!-- <div class="card">
            <div class="card-header text-white bg-secondary">
                Form Pengeluaran
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">id Pengeluaran</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Tanggal</th>
                            <th scope="col">Stok</th>
                            <th scope="col">Total</th>
                            <th scope="col">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <--<?php
                        $sql2   = "select * from pengeluaran order by id_pengeluaran desc";
                        $q2     = mysqli_query($koneksi, $sql2);
                        $urut   = 1;
                        while ($r2 = mysqli_fetch_array($q2)) {
                            $id_pengeluaran = $r2['id_pengeluaran'];
                            $nama_barang    = $r2['nama_barang'];
                            $tanggal        = $r2['tanggal'];
                            $stok           = $r2['stok'];
                            $total          = $r2['total'];

                        ?>-->
                        <!-- <tr>
                            <th scope="row"><?php echo $urut++ ?></th>
                            <td scope="row"><?php echo $id_pengeluaran ?></td>
                            <td scope="row"><?php echo $nama_barang ?></td>
                            <td scope="row"><?php echo $tanggal ?></td>
                            <td scope="row"><?php echo $stok ?></td>
                            <td scope="row"><?php echo $total ?></td>
                            <td scope="row">
                                <a href="input_pengeluaran.php?op=edit&id=<?php echo $id_pengeluaran ?>"><button type="button"
                                        class="btn btn-warning">Edit</button></a> -->
                                
                            <!-- </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>

                </table>
            </div>
        </div>
    </div>   -->
</body>

</html>