<?php

session_start();
include_once '../inc/registration.php';
include_once '../inc/addAnekdot.php';
include_once '../inc/login.php';
include_once '../blocks/doctype.php';
?>




<body class="add__page">

   <?php
   include_once '../blocks/header.php';
   ?>


   <section class="box">
      <div class="vtipadd">
         <h2 class="new__vtiptitle">Přidat nový vtip</h2>

         <form class="vtip__form" method="post" action="../inc/addAnekdot.php">
            <div class="choose__categori">


               <label for="kategories_naw"></label>
               <select name="kategories_naw" id="kategories_naw" required="required">
                  <option selected disabled hidden label=" "></option>
                  <option value="Černý_humor">Černý humor</option>
                  <option value="Židovské_vtipy_a_anekdoty">Židovské vtipy a anekdoty</option>
                  <option value="Vtipy_o_blondýnkách">Vtipy o blondýnkách</option>
                  <option value="Vtipy_o_škole">Vtipy o škole</option>
                  <option value="Vtipy_o_manželství">Vtipy o manželství</option>
                  <option value="Vtipy_o_tchyních">Vtipy o tchyních</option>
                  <option value="Vtipy_o_alkoholu">Vtipy o alkoholu</option>
                  <option value="Vtipy_o_zvířátkách">Vtipy o zvířátkách</option>
                  <option value="Vtipy_o_divokém_západě">Vtipy o divokém západě</option>
                  <option value="Doktoři_pacienti_a_nemoci">Doktoři, pacienti a nemoci</option>
                  <option value="Vtipy_o_vědě_a_technice">Vtipy o vědě a technice</option>
                  <option value="Chuck_Norris">Chuck Norris</option>
               </select>
            </div>

            <div>
               <label for="anekdot"></label><?php
                                             if (isset($_SESSION['anekdot_error'])) {

                                                echo  '<p class="error__anekdot">' . $_SESSION['anekdot_error'] . '</p>';
                                             }
                                             unset($_SESSION['anekdot_error']);
                                             ?>
               <textarea class="add-text" name="anekdot" id="anekdot" cols="53" rows="15" placeholder="Napiš sem vtip"></textarea>

            </div>

            <div>
               <label for="addAnekdot"></label>
               <button type="submit" name="addAnekdot" id="addAnekdot" class=" odeslat" value="Odeslat">Odeslat</button>
            </div>

         </form>


      </div>


      <?php
      include_once '../blocks/kategories.php';
      ?>
   </section>

   <?php
   include_once '../blocks/footer.php';


   ?>


   <script defer src="../js/validation.js"></script>

</body>


</html>