<?php
ob_start();

session_start();
unset($_SESSION['kategories']);
$_SESSION['kategories'] = 'Vtipy o tchyních';
include_once '../inc/registration.php';
include_once '../inc/login.php';
include_once '../inc/addAnekdot.php';
include_once '../blocks/doctype.php';
include_once '../inc/sort.php';

$data = file_get_contents(__DIR__ . '/../DB/anekdots.json');

$res = json_decode($data, true);
$page = isset($_GET['page']) ? $_GET['page'] : 0;

$count = 5;

$kategori = [];


if (isset($_GET['sort_btn'])) {
	if ($_GET['sort_btn'] == 'yes') {
		if ($_GET['sort'] == 'time') {
			sortTimeNew($res);
			header("location: ?sort=time");
			$_GET['sort_btn'] = 'Hello';
		}
		if ($_GET['sort'] == 'mark') {
			sortBest($res);
			header("location: ?sort=mark");
		}
	}
}


for ($i = 0; $i < count($res); $i++) {
	if ($res[$i]['kategories_naw'] == 'Černý_humor')
		array_push($kategori, $res[$i]);
}


$size = count($kategori) - 1;
$page__count = floor($size / $count);
?>







<body class="home__page">

	<?php

	include_once '../blocks/header.php';

	include_once '../blocks/box.php';
	?>



	<div class="page__list">
		<?php for ($p = 0; $p <= $page__count; $p++) : ?>
			<a class="page__button" href="?page=<?php echo $p; ?>">
				<p <?php echo ($page == $p) ? "class='active'" : ""; ?>><?php echo $p + 1; ?></p>
			</a>
		<?php endfor ?>
	</div>

	<?php
	include_once '../blocks/footer.php';
	ob_end_flush();
	?>


	<script src="../js/validation.js"></script>




</body>


</html>