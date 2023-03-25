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
		<form method="post" action="../inc/login.php">
			<h3 class="center">Přihlášení</h3>
			<?php
			if (isset($_SESSION['message'])) {
				echo '<p class="msg">' . $_SESSION['message'] . '</p>';
			}
			unset($_SESSION['message']);
			unset($_SESSION['hello']);
			?>
			<div class="group">
				<label for="email">Email</label>
				<input type="text" name="email" tabindex="1" value="<?= isset($email) ? $email : '' ?>" id="emailAut" required>
			</div>
			<div class="group">
				<label for="psw">Heslo</label>
				<input type="password" name="psw" tabindex="2" id="pswAut" required>
			</div>
			<a href="../index.php#registration-row" class="nova">
				<p>Nova registrace</p>
			</a>
			<div class="last">
				<button class="create-account" name="login" type="submit">Přihlásit se</button>
			</div>
		</form>
	</div>
</div>



<header>

	<div class="conteiner">
		<div class="randa" id="randa">
			<div class="randa__row">
				<?php if (isset($_SESSION['username'])) {
					echo '<a class="autbatton"  href="../inc/logout.php">Odhlásit</a>';
				} else {
					echo '<a href="#autorization-row" class=" autbatton">Přihlásit se</a>';
				}
				?>

			</div>
			<div class="instr">
				<?php if (isset($_SESSION['username'])) {
					echo '<p class="akk">' . $_SESSION['username'] . '
					<img  src="../img/akk.png" alt=""></p>';
				}
				?>
				<button class="printer" onclick="javascript:window.print()">
					<img src="../img/printer40.png" alt="">
				</button>
			</div>
		</div>


		<div class="logo">
			<img src="../img/Untitled5.png" alt="">
		</div>
		<nav class="navigation">
			<a class="menuitems" href="../index.php">Domů</a>
			<?php if (isset($_SESSION['username'])) {
				echo '<a class="menuitems add"  href="../menu/add.php">Přidat vtip</a>';
			}
			?>
			<a class="menuitems" href="../menu/new.php">Nové vtipy</a>
			<a class="menuitems" href="../menu/best.php">Nejlepší vtipy</a>
			<a class="menuitems" href="../menu/shuffle.php">Náhodník</a>
		</nav>
	</div>

</header>