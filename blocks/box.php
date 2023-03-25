<section class="box">

   <div class="anekdot__items">


      <div class="this">
         <div class="this__title"><?php echo $_SESSION['kategories'] ?></div>
         <form id="sortform" class="this__form" method="get">
            <label for="sort"></label>
            <select name="sort" id="sort" required="required">
               <option selected disabled hidden label=" "></option>
               <option value="time">Podle času</option>
               <option value="mark">Podle hodnoceni</option>
            </select>
            <button type="submit" id="reset" class="this__button" value="yes" name="sort_btn">Řadit</button>
         </form>
      </div>

      <?php for ($i = $page * $count; $i < ($page + 1) * $count; $i++) : ?>
         <?php if (isset($kategori[$i]['anekdot'])) : ?>


            <div class="anekdoty__item">
               <div class="conteiner">

                  <div class="hodnoceni">






                     <?php


                     $data = file_get_contents(__DIR__ . '/../DB/anekdots.json');

                     $res = json_decode($data, true);
                     $data2 = file_get_contents(__DIR__ . '/../DB/notes.json');

                     $res2 = json_decode($data2, true);

                     for ($j = 0; $j < count($res); $j++) {
                        if ($kategori[$i]['id'] == $res[$j]['id']) {

                           if (isset($_POST['add_ratting' . $res[$j]['id']])) {
                              if (!empty($_POST['stars'])) {
                                 array_push($res[$j]['stars'], $_POST['stars']);
                                 $sum = 0;
                                 $count = 0;
                                 foreach ($res[$j]['stars'] as $item) {
                                    $sum = $sum + $item;
                                    $count++;
                                 }
                                 $hodnoceni = round($sum / $count, 2);

                                 $res[$j]['hodnota'] = $hodnoceni;

                                 $width = $hodnoceni * 40.2;
                                 $res[$j]['width'] = $width;
                                 $timec = 365 * 24 * 60 * 60;
                                 if (isset($_SESSION['id'])) {
                                    array_push($res[$j]['volil'], $_SESSION['id']);
                                 } else {
                                    array_push($res[$j]['volil'], 0);
                                 }

                                 if (!isset($_SESSION['id'])) {
                                    setcookie($res[$j]['id'], ' ', time() + $timec);
                                 }

                                 for ($k = 0; $k < count($res2); $k++) {
                                    if (isset($_SESSION['id'])) {
                                       if ($_SESSION['id'] == $res2[$k]['id']) {
                                          array_push($res2[$k]['volil'], $res[$j]['id']);
                                          $newJsonString2 = json_encode($res2);
                                          file_put_contents(__DIR__ . '/../DB/notes.json', $newJsonString2);
                                       }
                                    } else {
                                       array_push($res2[$k]['volil'], 0);
                                    }
                                 }
                                 $newJsonString = json_encode($res);
                                 file_put_contents(__DIR__ . '/../DB/anekdots.json', $newJsonString);
                                 header("Refresh: 0");
                              } else {
                              }
                           }
                        }
                     }



                     ?>








                     <div class="conteiner__point">
                        <div><img class="point" src="../img/stars12.png" alt="" width=<?php echo round($kategori[$i]['width']) ?>>
                           <div class="point__row"><img src="../img/stars12.png" alt=""></div>
                        </div>


                     </div>




                     <?php if (isset($_SESSION['id'])) {
                        if (!in_array($_SESSION['id'], $kategori[$i]['volil'])) {
                           echo '<form class="anekdoty__rang" method="POST">
									<label for="stars' . $kategori[$i]['id'] . '"></label>
									<select id="stars' . $kategori[$i]['id'] . '" name="stars" required="required">
                           <option selected disabled  hidden label=" "></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
									<button type="submit" name="add_ratting' . $kategori[$i]['id'] . '" class="hodn__button">Tady</button>
								</form>';
                        } else {
                           echo '<p class="volil">Děkujeme za Váš hlas.</p>';
                        }
                     } else {
                        if (!isset($_COOKIE[$kategori[$i]['id']])) {
                           echo '<form class="anekdoty__rang" method="POST">
									<label for="stars' . $kategori[$i]['id'] . '"></label>
									<select id="stars' . $kategori[$i]['id'] . '" name="stars" required="required">
                           <option selected disabled  hidden label=" "></option>
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
										<option value="5">5</option>
									</select>
									<button type="submit" name="add_ratting' . $kategori[$i]['id'] . '" class="hodn__button">Tady</button>
								</form>';
                        } else {
                           echo '<p class="volil">Děkujeme za Váš hlas.</p>';
                        }
                     }
                     ?>







                  </div>


                  <p class="rang__sum">
                     Hodnocení: <?php echo $kategori[$i]['hodnota'] ?> (hlasů: <?php echo $id = count($kategori[$i]['stars']); ?>)
                  </p>
                  <p class="anekdoty__text">
                     <?php echo $kategori[$i]['anekdot']; ?>
                  </p>
                  <div class="anekdoty__info">
                     <p class="anekdoty__name">
                        Přidal: <?php echo $kategori[$i]['name']; ?> <br> <br> <?php echo $kategori[$i]['time'] ?>
                     </p>
                     <a class="anekdoty__category" href="../kategories/<?php echo $kategori[$i]['kategories_naw']; ?>.php"><?php echo $kategori[$i]['kategories_naw']; ?>
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