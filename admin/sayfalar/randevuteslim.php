<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php
if( isset($_SESSION['yonetici']) && !empty($_SESSION['yonetici']) ){
  $records = $conn->prepare('SELECT * FROM yoneticiler WHERE id = :id');
  $records->bindParam(':id', $_SESSION['yonetici']);
  $records->execute();
  $results = $records->fetch(PDO::FETCH_ASSOC);
  $user = NULL;
  if( count($results) > 0){
    $user = $results;
  }
}
else
{
  header("Location: giris.php");
  die();
}
?>
<?php 
$vericek = $conn -> prepare("SELECT * FROM randevular where id = :id");
$vericek->bindParam(':id', $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>
<?php
if (isset($_GET['id'])) {
  $numaras = $_GET['id']; 
  $sil = $conn -> prepare("DELETE FROM randevular where id = :id");
  $sil->bindParam(':id', $_GET['id']);
  $sil-> execute();
  if($sil){
    echo '<meta http-equiv="refresh" content="2;URL=?sayfa=randevular">
    <div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Ürün Başarı İle Silindi. 2 Saniye İçinde Yönlendiriliyorsunuz</strong>
    </div>';
  }else{
    echo '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Hata Oluştu !</strong>
    </div>';
  }  
} 
?> 

<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
    <li class="breadcrumb-item"><a href="?sayfa=randevular">Randevular</a></li>
    <li class="breadcrumb-item active">Tamamlanmış Randevular</li>
  </ol>
  <div class="row">
    <div class="col-xl-12 col-sm-6 mb-3">
      <div class="table-responsive">
        <table class="table table-bordered" id="dataTable">
          <thead>
            <tr>
              <th>Durum</th>
              <th>Adı Soyadı</th>
              <th>Telefon</th>
              <th>Hizmet</th>              
              <th>Randevu Tarihi</th>
              <th>Randevu Saati</th>
              <th>Açıklama</th>
              <th></th>
            </tr>
          </thead>
          <tbody>

            <?php
            $verial1 = $conn -> prepare("SELECT * FROM randevular");
            $verial1-> execute();
            while ($randevular = $verial1 -> fetch(PDO::FETCH_ASSOC)){
              if($randevular["yoneticicevap"]=='Tamamlanmış') {
                echo ' 
                <tr><td><span class="badge badge-dark">'.$randevular['yoneticicevap'].'</span></td>
                <td>'.$randevular['adsoyad'].'</td>
                <td>'.$randevular['telefon'].'</td>
                <td>'.$randevular['hizmet'].'</td> 
				<td>'.$randevular['randevu_tarihi'].'</td>
                <td>'.$randevular['randevu_saati'].'</td>
                <td>'.$randevular['aciklama'].'</td>
                <td><span style="float: right;"><a href="?sayfa=randevugoruntule&id='.$randevular['id'].'" class="btn-success btn-sm">Hemen Yönet</a>&nbsp; <a href="?sayfa=randevular&id='.$randevular['id'].'" class="btn-success btn-sm">Hemen Sil</a></td>
                </tr>';
              }
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>