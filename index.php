<?php session_start(); ob_start(); ?>
<?php include_once 'baglantilar/database.php'; ?>
<?php include_once 'baglantilar/fonksiyonlar.php';?>

<!DOCTYPE html>
<html lang="tr">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title><?php echo $ayarlargoster['site_title']; ?></title>
	<link rel="shortcut icon" type="image/png" href="/admin/assets/resim/favicon/logo.png"/>
	<meta name="description" content="<?php echo $ayarlargoster['site_description']; ?>">
	<meta name="keywords" content="<?php echo $ayarlargoster['site_keywords']; ?>">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.1/css/all.min.css">
	<link rel="stylesheet" href="/admin/assets/css/sb-admin.css">
	<link rel="stylesheet" href="/admin/assets/css/custom.css">
	<?php echo $ayarlargoster['site_analytics']; ?>
	<link rel="stylesheet" href="/admin/assets/css/datepicker.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="https://bootswatch.com/4/lumen/bootstrap.css">
	<link rel="shortcut icon" type="image/png" href="img/logo.png"/>
</head>
<body id="page-top" class="theme-purple">

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
		<a href="?sayfa=anasayfa" class="navbar-brand" title="Site Slogan">
			<?php echo $ayarlargoster['site_slogan']; ?>
		</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarNavDropdown">
			<ul class="navbar-nav">
				<li class="nav-item active">
					<a href="?sayfa=anasayfa" class="nav-link" title="Ana Sayfa"><i class="fa fa-home"></i> Anasayfa <span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item active">
					<a href="urunler.php" class="nav-link" title="Ürünler"><i class="fas fa-desktop"></i> Ürünler <span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item active">
					<a href="iletisim.php" class="nav-link" title="Ürünler"><i class="fas fa-address-book"></i> İletişim <span class="sr-only">(current)</span></a>
				</li>

				<li class="nav-item active">
					<a href="hakkimizda.php" class="nav-link" title="Ürünler"><i class="fas fa-address-card"></i> Hakkımızda <span class="sr-only">(current)</span></a>
				</li>

			</ul>
		</div>
	</nav>

	<br /><br /><br />

	<div class="container">

			<div class="col" style="margin-top: 75px;">
				<?php Duyuru(); ?>
			</div>

			<div class="row container">

				<label class="col-4 mt-2">
					<img class="image" style="height: 325px;" src="img/logo.png" alt="">
				</label>

				<label class="col-8 h-100 mt-5">
					<?php SayfaGetir(); ?>
				</label>

			</div>

	</div>

		<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
		<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
		<script src="/admin/assets/js/sb-admin.min.js"></script>
		<script src="/admin/assets/js/custom.js"></script>
		<script src="/admin/assets/js/datepicker.js"></script>
		<script>
			$('.datepicker').datepicker({
				todayBtn: "linked",
				clearBtn: true,
				language: "tr"
			});


			function run() {
				document.getElementById("fiyat").value = document.getElementById("select").value;
				document.getElementById("hizmet").value = document.getElementById("select").value;
			}

			function run() {
				var select = document.getElementById("select"),
				option = select.options[select.selectedIndex];
				document.getElementById("fiyat").value = option.id;
				document.getElementById("hizmet").value = option.innerHTML;
			}

		</script>


	</body>
	</html>