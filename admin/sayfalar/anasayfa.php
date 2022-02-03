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

<div class="container-fluid">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active"><a href="?sayfa=anasayfa">Ana Sayfa</a></li>
  </ol>
  <div class="row">    
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-warning o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-shopping-cart"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM randevular");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet toplam randevu talebi !';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=randevular">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-success o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-box-open"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM hizmetler");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet hizmet mevcut';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=hizmetler">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-3">
      <div class="card text-white bg-danger o-hidden h-100">
        <div class="card-body">
          <div class="card-body-icon">
            <i class="fas fa-fw fa-bullhorn"></i>
          </div>
          <div class="mr-5">
            <?php
            $sorgu = $conn->prepare("SELECT COUNT(*) FROM duyurular");
            $sorgu->execute();
            $say = $sorgu->fetchColumn();
            echo '<b>'.$say.'</b> adet duyuru mevcut';
            ?>
          </div>
        </div>
        <a class="card-footer text-white clearfix small z-1" href="?sayfa=duyurular">
          <span class="float-left">Detaylar</span>
          <span class="float-right">
            <i class="fas fa-angle-right"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card mb-3">
        <div class="card-header"><i class="fas fa-fw fa-shopping-cart"></i> Randevular</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Durum</th>
                <th>Randevu</th>
                <th>Telefon</th>
                <th class="text-right">#</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $sorgu = $conn->prepare("SELECT * FROM randevular order by ID desc limit 5");
              $sorgu->execute();
              while ($randevu = $sorgu -> fetch(PDO::FETCH_ASSOC)){
                if($randevu["yoneticicevap"]=='Yeni') {
                  echo '<tr><td><span class="badge badge-success">'.$randevu['yoneticicevap'].'</span></td><td>' . $randevu["adsoyad"] . '</td><td>' . $randevu["telefon"] . '</td><td class="text-right"><a href="?sayfa=randevugoruntule&id='.$randevu['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($randevu["yoneticicevap"]=='Onaylı') {
                  echo '<tr><td><span class="badge badge-warning">'.$randevu['yoneticicevap'].'</span></td><td>' . $randevu["adsoyad"] . '</td><td>' . $randevu["telefon"] . '</td><td class="text-right"><a href="?sayfa=randevugoruntule&id='.$randevu['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($randevu["yoneticicevap"]=='Tamamlanmış') {
                  echo '<tr><td><span class="badge badge-dark">'.$randevu['yoneticicevap'].'</span></td><td>' . $randevu["adsoyad"] . '</td><td>' . $randevu["telefon"] . '</td><td class="text-right"><a href="?sayfa=randevugoruntule&id='.$randevu['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                if($randevu["yoneticicevap"]=='İptal') {
                  echo '<tr><td><span class="badge badge-secondary">'.$randevu['yoneticicevap'].'</span></td><td>' . $randevu["adsoyad"] . '</td><td>' . $randevu["telefon"] . '</td><td class="text-right"><a href="?sayfa=randevugoruntule&id='.$randevu['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer small text-muted">İlk 5 Randevu Listelenir.</div>
      </div>
    </div>
    <div class="col-xl-6 col-sm-6 mb-3">
      <div class="card mb-3">
        <div class="card-header"><i class="fas fa-fw fa-box-open"></i> Hizmetler</div>
        <div class="table-responsive">
          <table class="table">
            <thead>
              <tr>
                <th>Hizmet</th>                
                <th class="text-right">#</th>
              </tr>
            </thead>
            <tbody>
              <?php
              try {
                $sorgu = $conn->prepare("SELECT * FROM hizmetler order by ID desc limit 5");
                $sorgu->execute();
                while ($veri = $sorgu->fetch()) {
                  $goster .= '<tr>
                  <td>
                  <span data-toggle="tooltip" data-html="true">' . $veri["urunbaslik"] . '</span>
                  </td>
                  <td class="text-right"><a href="?sayfa=hizmetduzenle&id='.$veri['id'].'" class="btn btn-primary btn-sm"><i class="fas fa-fw fa-eye"></i></td></tr>';
                }
                echo $goster;
              } catch (PDOException $e) {
                die($e->getMessage());
              }
              ?>
            </tbody>
          </table>
        </div>
        <div class="card-footer small text-muted">Son 5 Hizmet Listelenir.</div>
      </div>
    </div>
  </div>
</div>