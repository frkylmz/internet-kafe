<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php
if (isset($_POST["RandevuAl"])) {
  date_default_timezone_set('Europe/Istanbul');
  $adsoyad = $_POST['adsoyad'];
  $telefon = $_POST['telefon'];
  $hizmet = $_POST['hizmet']; 
  $randevu_tarihi = $_POST['randevu_tarihi'];
  $randevu_saati = $_POST['randevu_saati'];
  $aciklama = $_POST['aciklama'];
  $yoneticicevap = 'Yeni';
  $durum = '1';
  $createdAt = date('Y-m-d H:i:s');
  $gonder = $conn->prepare("INSERT INTO randevular SET adsoyad='$adsoyad', telefon='$telefon', hizmet='$hizmet', randevu_tarihi='$randevu_tarihi', randevu_saati='$randevu_saati', aciklama='$aciklama', yoneticicevap='$yoneticicevap', durum='$durum', createdAt='$createdAt'");
  $gonder->execute();
  if($gonder){
    $mesaj = '<div class="alert alert-dismissible alert-success">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Randevu başarı ile oluşturuldu.</strong>
    </div>';
  }else{
    $mesaj = '<div class="alert alert-dismissible alert-danger">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>Talep başarısız !</strong>
    </div>';
  }
}
?>
<?php 
$vericek = $conn -> prepare("SELECT * FROM ayarlar where id = 1");
$vericek->bindParam(1, $_GET['id']);
$vericek-> execute();
$veriyigoster = $vericek -> fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BBF INTERNET KAFE</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="urunler.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="shortcut icon" type="image/jpg" href="img/logo.png"/>

</head>

<div class="container-fluid height">
    <div class="row height">
      <div class="col height">

        <nav class="navbar bg-light navbar-expand-lg navbar-light border-0">
            <div class="container-fluid m-0 p-0">
                <a class="navbar-brand ps-3" href="index.php">BBF INTERNET KAFE
                <a>

                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                      <li class="nav-item">
                            
                        <a class="nav-link active" aria-current="page" href="index.php">
                          <i class="fas fa-home" style="padding-left: 20px;"></i>Anasayfa</a>
                      </li>
                      <li class="nav-item"> 
                            
                        <a class="nav-link" href="urunler.php">
                          <i class="fas fa-desktop" style="padding-left: 20px;"></i>Ürünler</a>
                      </li>
                      <li class="nav-item">
                            
                        <a class="nav-link active" aria-current="page" href="iletisim.php">
                          <i class="fas fa-address-book" style="padding-left: 20px;"></i>İletişim</a>
                      </li>

                      <li class="nav-item">
                            
                        <a class="nav-link active" aria-current="page" href="hakkimizda.php">
                          <i class="fas fa-address-card" style="padding-left: 20px;"></i>Hakkımızda</a>
                      </li>

                    </ul>
                  </div>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
            </div>
        </nav>
   

        <hr>

        <div class="form-group mt-4" style="padding-left: 120px;">
            <label class="col-3 col-form-label">Ad Soyad</label>
            <div class="col-9">
              <input type="text" name="adsoyad" class="form-control" placeholder="Adınızı ve Soyadınızı Giriniz" autocapitalize="off" required>
            </div>
        </div>   
            
        <div class="form-group mt-4" style="padding-left: 120px;">
            <label class="col-3 col-form-label">Telefon</label>
            <div class="col-9">
              <input type="text" name="telefon" class="form-control" placeholder="05__ ___ ____" autocapitalize="off" required>
            </div>
          </div>

          <div class="form-group mt-4" style="padding-left: 120px;">
            <label class="col-3 col-form-label">Hizmet</label>
            <div class="col-9">
              <select id="select" class="form-control" onchange="run()" required>
                <option>Hizmet Seçiniz</option>
                <?php
                foreach($conn->query("SELECT * FROM hizmetler") as $cikti) {
                echo "<option id='".$cikti['urunfiyat']."' >".$cikti['urunbaslik']."</option>";
                }
                ?>                                     
                <input type='hidden' name='fiyat' id='fiyat' />
                <input type='hidden' name='hizmet' id="hizmet">
              </select>
            </div>
          </div>

          <div class="form-group mt-4" style="padding-left: 120px;">
            <label for="example-date-input" class="col-3 col-form-label">Tarih</label>
            <div class="col-9">
              <input class="form-control" name="randevu_tarihi" type="date" value="<?php echo date("Y-m-d"); ?>" id="example-date-input" required>
            </div>
          </div>

          <div class="form-group mt-4" style="padding-left: 120px;">
            <label class="col-3 col-form-label">Saat</label>
            <div class="col-9">
              <select class="form-control" name="randevu_saati" id="exampleFormControlSelect1">
                <option value="8:00">08:00</option>
                <option value="9:00">09:00</option>
                <option value="10:00">10:00</option>
                <option value="11:00">11:00</option>
                <option value="12:00">12:00</option>
                <option value="13:00">13:00</option>
                <option value="14:00">14:00</option>
                <option value="15:00">15:00</option>
                <option value="16:00">16:00</option>
                <option value="17:00">17:00</option>
                <option value="18:00">18:00</option>
                <option value="19:00">19:00</option>
                <option value="20:00">20:00</option>
                <option value="21:00">21:00</option>
                <option value="22:00">22:00</option>
                <option value="23:00">23:00</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <button id="RandevuAl" type="submit" name="RandevuAl" class="col-12 mt-5 btn btn-success btn-round" style="background-color: #555E6B; color: #fff;">
              Randevu Oluştur
            </button>
          </div>    

        </div>
      <div class="col bg-light height">
        <img class="image" src="img/logo.png" alt="">
      </div>
    </div>
</div>
