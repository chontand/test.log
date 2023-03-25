<?php

session_start();
unset($_SESSION['kategories']);
$_SESSION['kategories'] = 'Chuck Norris';
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


if (isset($_POST['sort'])) {
	if ($_POST['sort'] == 'Podle času') {
		sortTimeNew($res);
	}
	if ($_POST['sort'] == 'Podle hodnoceni') {
		sortBest($res);
	}
	echo ("<meta http-equiv='refresh' content='0'>");
}

for ($i = 0; $i < count($res); $i++) {
	if ($res[$i]['kategories_naw'] == 'Chuck_Norris')
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
	?>


	<script src="../js/validation.js"></script>




</body>


</html>