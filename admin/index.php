<?php session_start(); ob_start(); ?>
<?php include 'baglantilar/database.php'; ?>
<?php include 'baglantilar/fonksiyonlar.php'; ?>
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
function SayfaGetir(){
	if(isset($_GET['sayfa'])){
		switch ($_GET['sayfa']) {
			case 'anasayfa': include('sayfalar/anasayfa.php'); break;

			case 'randevular': include('sayfalar/randevular.php'); break;
			case 'randevugoruntule': include('sayfalar/randevugoruntule.php'); break;
			case 'randevuyeni': include('sayfalar/randevuyeni.php'); break;
			case 'randevuonayli': include('sayfalar/randevuonayli.php'); break;
			case 'randevuteslim': include('sayfalar/randevuteslim.php'); break;
			case 'randevuiptal': include('sayfalar/randevuiptal.php'); break;
			
			case 'duyurular': include('sayfalar/duyurular.php'); break;
			case 'duyuruekle': include('sayfalar/duyuruekle.php'); break;
			case 'duyurugoruntule': include('sayfalar/duyuruduzenle.php'); break;
			case 'hizmetler': include('sayfalar/hizmetler.php'); break;
			case 'hizmetekle': include('sayfalar/hizmetekle.php'); break;
			case 'hizmetduzenle': include('sayfalar/hizmetduzenle.php'); break;
			case 'ayarlar': include('sayfalar/siteayarlari.php'); break;
			default: include('sayfalar/404.php'); break;
		}
	}else{
		include('sayfalar/anasayfa.php');
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
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $veriyigoster['site_title']; ?> | Yönetim Paneli</title>
	<link rel="shortcut icon" type="image/jpg" href="img/logo.png"/>
	<link rel="shortcut icon" type="image/png" href="/admin/assets/resim/favicon/logo.png"/>
	
	<meta name="description" content="<?php echo $veriyigoster['site_description']; ?>">
	<meta name="keywords" content="<?php echo $veriyigoster['site_keywords']; ?>">
	<link href="assets/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<link href="assets/vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

	<link href="assets/css/sb-admin.css" rel="stylesheet">
	<link href="assets/css/custom.css" rel="stylesheet">
	

</head>

<body id="page-top" class="sidebar-toggled">
	<nav class="navbar navbar-expand navbar-dark bg-dark static-top ">
		<a class="navbar-brand mr-1" href="?sayfa=anasayfa">BBF Yönetim Paneli</a>
		<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
			<i class="fas fa-bars"></i>
		</button>
		<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
			<div class="input-group">
				<div class="input-group-append">
				</div>
			</div>
		</form>
		<ul class="navbar-nav ml-auto ml-md-0 float-right">

			<li class="nav-item dropdown no-arrow mx-1">
				<a class="nav-link dropdown-toggle" href="#" id="randevular" data-toggle="dropdown">
					<i class="fas fa-bell fa-fw"></i>
					<?php
					$sor = $conn -> prepare("SELECT COUNT(*) FROM randevular WHERE yoneticicevap='yeni'");
					$sor -> execute();
					$say = $sor -> fetchColumn();
					if ($say == 0) {
					} else {
						echo '<span class="badge badge-success">'.$say.'</span>';
					}
					?>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="randevular">
					<span class="dropdown-header">Yeni Randevular</span>
					<div class="dropdown-divider"></div>
					<div class="dropdown-item">
						<div class="list-group">
							<?php
							$randevular = $conn->prepare("SELECT * FROM randevular WHERE yoneticicevap='yeni'");
							$randevular->execute();
							while ($randevu = $randevular -> fetch(PDO::FETCH_ASSOC)){
								if($randevu["yoneticicevap"]=='Yeni') {
									echo '<a href="?sayfa=randevugoruntule&id='.$randevu['id'].'" class="list-group-item list-group-item-action flex-column align-items-start">
									<div class="d-flex w-100 justify-content-between">
									<h5 class="mb-1 badge badge-success">'.$randevu['yoneticicevap'].'</h5>
									<small>' . $randevu["randevu_tarihi"] . '</small>
									</div>
									<p class="mb-1">' . $randevu["adsoyad"] . ' - ' . $randevu["telefon"] . '</p>
									<small>' . $randevu["aciklama"] . '</small>
									</a>';
								}
							}
							?>
						</div>
					</div>
					<div class="dropdown-divider"></div>
				</div>
			</li>
			<li class="nav-item dropdown no-arrow mx-1">
				<a class="nav-link dropdown-toggle" href="../index.php">
					<i class="fas fa-eye fa-fw"></i>
				</a>
			</li>
			<li class="nav-item dropdown no-arrow">
				<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-user-circle fa-fw"></i>
				</a>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
					
					<div class="dropdown-divider"></div>				
					<a class="dropdown-item" href="#" data-toggle="modal" data-target="#cikisModal">Çıkış Yap</a>
				</div>
			</li>
		</ul>
	</nav>
	<div id="wrapper">
		<ul class="sidebar navbar-nav toggled">
			<li class="nav-item active">
				<a class="nav-link" href="?sayfa=anasayfa">
					<i class="fas fa-fw fa-home"></i>
					<span>Ana Sayfa</span>
				</a>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-calendar"></i>
					<span>Randevular</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=randevular">Tüm Randevular</a>
					<a class="dropdown-item" href="?sayfa=randevuyeni">Yeni Randevular</a>
					<a class="dropdown-item" href="?sayfa=randevuonayli">Onaylı Randevular</a>
					<a class="dropdown-item" href="?sayfa=randevuteslim">Tamamlanmış Randevular</a>
					<a class="dropdown-item" href="?sayfa=randevuiptal">İptal Edilen Randevular</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-box-open"></i>
					<span>Hizmetler</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=hizmetler">Hizmet Listesi</a>
					<a class="dropdown-item" href="?sayfa=hizmetekle">Hizmet Ekle</a>
				</div>
			</li>
			<li class="nav-item dropdown">
				<a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-fw fa-bullhorn"></i>
					<span>Duyurular</span>
				</a>
				<div class="dropdown-menu" aria-labelledby="pagesDropdown">
					<a class="dropdown-item" href="?sayfa=duyurular">Duyuru Listesi</a>
					<a class="dropdown-item" href="?sayfa=duyuruekle">Duyuru Ekle</a>
				</div>
			</li>				
			<li class="nav-item">
				<a class="nav-link" href="?sayfa=ayarlar">
					<i class="fas fa-fw fa-cog"></i>
					<span>Site Ayarları</span>
				</a>
			</li>
		</ul>
		<div id="content-wrapper">
			<?php SayfaGetir(); ?>
			<footer class="sticky-footer">
				<div class="container my-auto">
					<div class="copyright text-center my-auto">
						<span><?php echo $veriyigoster['site_copright']; ?></span>
					</div>
					<div class="copyright text-center my-auto d-none">
						<span>Copyright © 2021 </span>
					</div>
				</div>
			</footer>
		</div>
	</div>
	<a class="scroll-to-top rounded" href="#page-top">
		<i class="fas fa-angle-up"></i>
	</a>
	<div class="modal fade" id="cikisModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Çıkış Yap?</h5>
					<button class="close" type="button" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">×</span>
					</button>
				</div>
				<div class="modal-body">Mevcut oturumunuzu sonlandırmaya hazırsanız, aşağıdaki "Oturumu Kapat" ı seçin.</div>
				<div class="modal-footer">
					<button class="btn btn-secondary" type="button" data-dismiss="modal">İptal Et</button>
					<a class="btn btn-primary" href="cikis.php">Oturumu Kapat</a>
				</div>
			</div>
		</div>
	</div>
	<script src="assets/vendor/jquery/jquery.min.js"></script>
	<script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
	<script src="assets/vendor/jquery-easing/jquery.easing.min.js"></script>

	<script src="assets/js/sb-admin.min.js"></script>
	<script src="assets/js/custom.js"></script>
	<script src="assets/vendor/datatables/jquery.dataTables.min.js" crossorigin="anonymous"></script>
	<script src="assets/vendor/datatables/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
	<script src="assets/js/demo/datatables-demo.js"></script>
	<script>
		$(document).ready( function() {
			$(document).on('change', '.btn-file :file', function() {
				var input = $(this),
				label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
				input.trigger('fileselect', [label]);
			});

			$('.btn-file :file').on('fileselect', function(event, label) {

				var input = $(this).parents('.input-group').find(':text'),
				log = label;

				if( input.length ) {
					input.val(log);
				} else {
					if( log ) alert(log);
				}

			});
			function readURL(input) {
				if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function (e) {
						$('#img-upload').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				}
			}

			$("#imgInp").change(function(){
				readURL(this);
			});   
		});


	</script>
</body>
</html>
