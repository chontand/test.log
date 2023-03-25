<?php
ob_start();
session_start();
include_once '../inc/registration.php';
include_once '../inc/addAnekdot.php';
include_once '../inc/login.php';
include_once '../blocks/doctype.php';
include_once '../inc/sort.php';


$data = file_get_contents(__DIR__ . '/../DB/anekdots.json');

$res = json_decode($data, true);


$page = isset($_GET['page']) ? $_GET['page'] : 0;

$count = 5;
$size = count($res) - 1;
$page__count = floor($size / $count);

sortBest($res);





?>



<body class="add__page">

   <?php
   include_once '../blocks/header.php';
   ?>


   <section class="box">

      <div class="anekdot__items print">

         <div class="this__menu">Nejlepší vtipy</div>



         <?php for ($i = $page * $count; $i < ($page + 1) * $count; $i++) : ?>
            <?php if (isset($res[$i]['anekdot'])) : ?>


               <div class="anekdoty__item">
                  <div class="conteiner">

                     <div class="hodnoceni">














                        <?php


                        $data = file_get_contents(__DIR__ . '/../DB/anekdots.json');

                        $res = json_decode($data, true);
                        $data2 = file_get_contents(__DIR__ . '/../DB/notes.json');

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
                                       file_put_contents(__DIR__ . '/../DB/notes.json', $newJsonString2);
                                    }
                                 } else {
                                    array_push($res2[$j]['volil'], 0);
                                 }
                              }
                              $newJsonString = json_encode($res);
                              file_put_contents(__DIR__ . '/../DB/anekdots.json', $newJsonString);
                              header("Refresh: 0");
                           } else {
                           }
                        }
                        ?>

                        <div class="conteiner__point">
                           <div>
                              <img class="point" src="../img/stars12.png" alt="" width=<?php echo round($res[$i]['width']) ?>>
                              <div class="point__row"><img src="../img/stars12.png" alt=""></div>
                           </div>


                        </div>




                        <?php if (isset($_SESSION['id'])) {
                           if (!in_array($_SESSION['id'], $res[$i]['volil'])) {
                              echo '<form class="anekdoty__rang" method="POST">
            <label for="stars' . $res[$i]['id'] . '"></label>
            <select id="stars' . $res[$i]['id'] . '" name="stars" required="required">
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
            <label for="stars' . $res[$i]['id'] . '"></label>
            <select id="stars' . $res[$i]['id'] . '" name="stars"  required="required">
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
                        <a class="anekdoty__category" href="../kategories/<?php echo $res[$i]['kategories_naw']; ?>.php"><?php echo $res[$i]['kategories_naw']; ?>
                        </a>
                     </div>
                  </div>
               </div>

            <?php endif; ?>
         <?php endfor; ?>


      </div>

      <?php
      include_once '../blocks/kategories.php';
      ?>
   </section>


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


   <script defer src="../js/validation.js"></script>

</body>


</html>