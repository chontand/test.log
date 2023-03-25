<?php

ob_start();
session_start();


include_once 'inc/registration.php';
include_once 'inc/login.php';
include_once 'inc/addAnekdot.php';
include_once 'inc/connect.php';
include_once 'inc/sort.php';


$data = file_get_contents(__DIR__ . '/DB/anekdots.json');

$res = json_decode($data, true);


sortTime($res);



$page = isset($_GET['page']) ? $_GET['page'] : 0;

$size = count($res) - 1;

$count = 5;
$page__count = floor($size / $count);


?>
<!DOCTYPE html>
<html lang="cs">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="css/style.css">
	<title>Hahaland</title>
</head>






<body class="home__page">





	<div class="registration-row" id="registration-row">
		<div class="registration">
			<a class="btn-registration" href="#"></a>
			<form id="form" class="form__body" name="form" action=<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '#registration-row'); ?> method="post">
				<h2 class="text-center">Registrace</h2>
				<div class="form-group">
					<label for="name">Jméno a příjmeni*</label>
					<div class="div__error"> <input type="text" name="name" value="<?php echo isset($_POST['name']) ?  htmlspecialchars($_POST['name']) : ''; ?>" tabindex="1" id="name" class="form__input surname" pattern="^[a-zA-Z]{2,20}\s+[a-zA-Z]{2,20}$" required>
						<?php echo isset($_SESSION['name']) ? $_SESSION['name'] : ''; ?>
					</div>
				</div>
				<div class="form-group">
					<label for="email">Email*</label>
					<div class="div__error"><input type="email" placeholder="Email slouží jako login" value="<?php echo isset($_POST['email']) ?  htmlspecialchars($_POST['email']) : ''; ?>" name="email" id="email" class="form__input email" tabindex="2" pattern="^[-\w.]+@([A-z0-9][-A-z0-9]+\.)+[A-z]{2,4}$" required>
						<?php echo isset($err['email']) ? $err['email'] : ''; ?>
					</div>
				</div>
				<div class="form-group">
					<label for="psw">Heslo*</label>
					<div class="div__error"><input type="password" placeholder="Minimálně 8 znaků" tabindex="3" name="pswHash" id="psw" class="form__input  password" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
						<?php echo isset($err['pswHash']) ? $err['pswHash'] : ''; ?>
					</div>
				</div>
				<div class="form-group">
					<label for="psw_repeat">Potvrzení hesla*</label>
					<div class="div__error"> <input type="password" name="psw_repeat" tabindex="4" id="psw_repeat" class="form__input password__repeat" pattern="(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$" required>
						<?php echo isset($err['psw_repeat']) ? $err['psw_repeat'] : ''; ?>
					</div>
				</div>
				<div class="form-group">
					<label for="phone">Telefon*</label>
					<div class="div__error"><input type="tel" id="phone" value="<?php echo isset($_POST['phone']) ?  htmlspecialchars($_POST['phone']) : ''; ?>" name="phone" tabindex="5" placeholder="123456789" class="form__input phone" pattern="^([0-9]){9}$" required>
						<?php echo isset($err['phone']) ? $err['phone'] : ''; ?>
					</div>
				</div>
				<div class="form-last">
					<button class="create-account" type="submit" name="addNote">Uložit</button>
				</div>
			</form>
		</div>

	</div>

	<div class="autorization-row" id="autorization-row">
		<div class="autorization">
			<a class="btn-autorization" href="#"></a>
			<form method="post" action="inc/login.php">
				<h3 class="center">Přihlášení</h3>
				<?php
				if (isset($_SESSION['message'])) {
					echo '<p class="msg">' . $_SESSION['message'] . '</p>';
				}
				unset($_SESSION['message']);

				?>
				<div class="group">
					<label for="email">Email</label>
					<input type="text" name="email" tabindex="1" value="<?= isset($email) ? $email : '' ?>" id="emailAut" required>
				</div>
				<div class="group">
					<label for="psw">Heslo</label>
					<input type="password" name="psw" tabindex="2" id="pswAut" required>
				</div>
				<a href="index.php#registration-row" class="nova">
					<p>Nova registrace</p>
				</a>
				<div class="last">
					<button class="create-account" name="login" type="submit">Přihlásit se</button>
				</div>
			</form>
		</div>
	</div>



	<header>

		<a href="inc/info.php">INFO</a>

		<form action="inc/new.php" method="post">
			<input type="text">
			<input type="submit">
		</form>

		<div class="conteiner">
			<div class="randa" id="randa">
				<div class="randa__row">
					<?php if (isset($_SESSION['username'])) {
						echo '<a class="autbatton"  href="inc/logout.php">Odhlásit</a>';
					} else {
						echo '<a href="#autorization-row" class=" autbatton">Přihlásit se</a>';
					}
					?>

				</div>
				<div class="instr">
					<?php if (isset($_SESSION['username'])) {
						echo '<p class="akk">' . $_SESSION['username'] . '
					<img  src="img/akk.png" alt=""></p>';
					}
					?>
					<button class="printer" onclick="javascript:window.print()">
						<img src="img/printer40.png" alt="">
					</button>
				</div>
			</div>


			<div class="logo">
				<img src="img/Untitled5.png" alt="">
			</div>
			<nav class="navigation">
				<a class="menuitems" href="index.php?page=0">Domů</a>
				<?php if (isset($_SESSION['username'])) {
					echo '<a class="menuitems add"  href="menu/add.php">Přidat vtip</a>';
				}
				?>
				<a class="menuitems" href="menu/new.php">Nové vtipy</a>
				<a class="menuitems" href="menu/best.php">Nejlepší vtipy</a>
				<a class="menuitems" href="menu/shuffle.php">Náhodník</a>
			</nav>
		</div>










	</header>

	<section class="box">
		<div class="anekdot__items print">





			<?php for ($i = $page * $count; $i < ($page + 1) * $count; $i++) : ?>
				<?php if (isset($res[$i]['anekdot'])) : ?>


					<div class="anekdoty__item">
						<div class="conteiner">




							<div class="hodnoceni">














								<?php


								$data = file_get_contents(__DIR__ . '/DB/anekdots.json');

								$res = json_decode($data, true);
								$data2 = file_get_contents(__DIR__ . '/DB/notes.json');

								$res2 = json_decode($data2, true);

								if (isset($_POST['add_ratting' . $res[$i]['id']])) {
									if (!empty($_POST['stars'])) {
										array_push($res[$i]['stars'], $_POST['stars']);
										$sum = 0;
										$count = 0;
										foreach ($res[$i]['stars'] as $item) {
											$sum = $sum + $item;
											$count++;
										}
										$hodnoceni = round($sum / $count, 2);

										$res[$i]['hodnota'] = $hodnoceni;

										$width = $hodnoceni * 40.2;
										$res[$i]['width'] = $width;
										$timec = 365 * 24 * 60 * 60;
										if (isset($_SESSION['id'])) {
											array_push($res[$i]['volil'], $_SESSION['id']);
										} else {
											array_push($res[$i]['volil'], 0);
										}
										if (!isset($_SESSION['id'])) {
											setcookie($res[$i]['id'], ' ', time() + $timec);
										}


										for ($j = 0; $j < count($res2); $j++) {
											if (isset($_SESSION['id'])) {
												if ($_SESSION['id'] == $res2[$j]['id']) {
													array_push($res2[$j]['volil'], $res[$i]['id']);
													$newJsonString2 = json_encode($res2);
													file_put_contents(__DIR__ . '/DB/notes.json', $newJsonString2);
												}
											} else {
												array_push($res2[$j]['volil'], 0);
											}
										}
										$newJsonString = json_encode($res);
										file_put_contents(__DIR__ . '/DB/anekdots.json', $newJsonString);
										header("Refresh: 0");
									} else {
									}
								}
								?>

								<div class="conteiner__point">
									<div>
										<img class="point" src="img/stars12.jpg" alt="" width=<?php echo round($res[$i]['width']) ?>>
										<div class="point__row"><img src="img/stars12.png" alt=""></div>
									</div>


								</div>




								<?php if (isset($_SESSION['id'])) {
									if (!in_array($_SESSION['id'], $res[$i]['volil'])) {
										echo '<form class="anekdoty__rang" method="POST">
									<label for="stars' . $res[$i]['id'] . '" ></label>
									<select id="stars' . $res[$i]['id'] . ' " name="stars"  required="required">
                           <option selected disabled  hidden label=" "></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option> 
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
									<button type="submit" name="add_ratting' . $res[$i]['id'] . '" class="hodn__button">Tady</button>
								</form>';
									} else {
										echo '<p class="volil">Děkujeme za Váš hlas.</p>';
									}
								} else {
									if (!isset($_COOKIE[$res[$i]['id']])) {
										echo '<form class="anekdoty__rang" method="POST">
									<label for="stars' . $res[$i]['id'] . '" ></label>
									<select id="stars' . $res[$i]['id'] . ' " name="stars"  required="required">
                           <option selected disabled hidden label=" "></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
									<button type="submit" name="add_ratting' . $res[$i]['id'] . '" class="hodn__button">Tady</button>
								</form>';
									} else {
										echo '<p class="volil">Děkujeme za Váš hlas.</p>';
									}
								}
								?>








							</div>


							<p class="rang__sum">
								Hodnocení: <?php echo $res[$i]['hodnota'] ?> (hlasů: <?php echo $id = count($res[$i]['stars']); ?>)
							</p>
							<p class="anekdoty__text">
								<?php echo $res[$i]['anekdot']; ?>
							</p>
							<div class="anekdoty__info">
								<p class="anekdoty__name">
									Přidal: <?php echo $res[$i]['name']; ?> <br> <br> <?php echo $res[$i]['time'] ?>
								</p>
								<a class="anekdoty__category" href="kategories/<?php echo $res[$i]['kategories_naw']; ?>.php"><?php echo $res[$i]['kategories_naw']; ?>
								</a>
							</div>

						</div>
					</div>

				<?php endif; ?>
			<?php endfor; ?>




		</div>

		<div class="barside">
			<div class="conteiner">
				<h2>Kategories</h2>
				<nav class="page__list">
					<ul>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Černý_humor.php" id="kategories/cerny_humor">Černý humor</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Židovské_vtipy_a_anekdoty.php">Židovské vtipy a anekdoty</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_blondýnkách.php">Vtipy o blondýnkách</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_škole.php">Vtipy o škole</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_manželství.php">Vtipy o manželství</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_tchyních.php">Vtipy o tchyních</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_alkoholu.php">Vtipy o alkoholu</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_zvířátkách.php">Vtipy o zvířátkách</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_divokém_západě.php">Vtipy o divokém západě</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Doktoři_pacienti_a_nemoci.php">Doktoři, pacienti a nemoci</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Vtipy_o_vědě_a_technice.php">Vtipy o vědě a technice</a>
						</li>

						<li>
							<hr>
							<a class="kategorii" href="kategories/Chuck_Norris.php">Chuck Norris</a>
						</li>
					</ul>
				</nav>
			</div>
		</div>
	</section>

	<div class="page__list">
		<?php for ($p = 0; $p <= $page__count; $p++) : ?>
			<a class="page__button" href="?page=<?php echo $p; ?>">
				<p <?php echo ($page == $p) ? "class='active'" : ""; ?>><?php echo $p + 1; ?></p>
			</a>
		<?php endfor ?>
	</div>

	<?php
	include_once 'blocks/footer.php';

	ob_end_flush();

	?>


	<script src="js/validation.js"></script>




</body>


</html>