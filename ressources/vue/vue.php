<?php

/* A enlever pas bon */


class Vue{

function demandePseudo(){

header("Content-type: text/html; charset = utf-8");

?>

<html>
  <head>
    <meta charset="utf-8">
    <title> Authentification du Joueur </title>
  </head>
  <body>

    <h1> Connexion </h1>

    <form class="" action="index.php" method="post">

      Entrez Votre Pseudo: <input type="text" name="pseudo"> <br> <br>
      Entrez Votre Mot de Passe: <input type="password" name="mdp">
      <br>
      <br>
      <input type="submit" name="" value="Connexion au Jeu">
    </form>

    <br>


  </body>
</html>

<?php
  }


  function demandeJoueur(){

?>

  <!DOCTYPE html>
  <html lang="fr" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title> Pseudo </title>
    </head>
    <body>

      <h1> Entre Un Pseudo</h1>

      <form class="" action="index.php" method="post">

        => <input type="text" name="nomjoueur" value="Pseudo"> <br><br>
          <input type="submit" name="envoie" value="Valider!">
      </form>

    </body>
  </html>

<?php


  }


  /**

    Lancerlejeu permet d'afficher la page du jeu bridge 
  */

  function lancerlejeu(){
  $pseudo="kirikou";
  ?>

  <!DOCTYPE html>
  <html lang="fr" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>BRIDGE</title>
    </head>
    <body>
      <H1> Le Jeu Bridge </H1>
      <h2> Bienvenue <?php echo $pseudo; ?> sur le BRIDGE-GAME</h2>
    </br>

  <form action="" method="post">
  <button name="demarrer" type="submit">Commencer</button>
  <button>Recommencer</button>
  </br></br>

</form>

  <button style="border-radius:50%; padding:20px; border: 2px solid #4CAF50;">Recommencer</button>

</br>
</br>
</br>
</br>
</br>
<button>Deconnexion</button>
</br>
</br>
</br>
</br>
</br>
  </body>

  <footer>
    Maxime Guigourez
  </br>
    Hugo Bourniche
  </footer>

</html>





<br />


<?php
}


function commencer(){

?>

  <!DOCTYPE html>
  <html lang="fr" dir="ltr">
    <head>
      <meta charset="utf-8">
      <title>BRIDGE</title>
      <link rel="stylesheet"  href="style.css">
    </head>
    <body>
      <h1 align ="center"> Le Jeu Bridge </h1>
      <h2 align="center"> Par Maxime Guigourez / Hugo Bourniche</h2>

    <div>
    <img src="IUT_de_Nantes.gif" alt="Logo de l'IUT_de_Nantes" class="center";>
    </div>

    <hr>

  <form  align="center" action="" method="post">
  <button name="demarrer" type="submit">Commencer</button>

  
  <button style="border-radius:50%; padding:20px; border: 2px solid #F52D03;">Recommencer</button>
  </br></br>
</form>

<div>

  <table border="4" width="40%">

      <tr>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
      </tr>

      <tr>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
      </tr>

      <tr>
          <td>  </td>
          <td>  </td>
          <td>  </td>
          <td>  </td>
      </tr>


  </table>




</div>


<script>
  
var c = document.getElementById("puzzlecanvas");
var ctx = c.getContext("2d");
ctx.beginPath()
ctx.rect(0, 0, 192, 192);
ctx.fillStyle = "#a9b6cc";
ctx.fill();



</script>



</br>
</br>
</br>
</br>
</br>
<button>Deconnexion</button>
</br>
</br>
</br>
</br>
</br>
  </body>

  <footer>
    Maxime Guigourez

    Hugo Bourniche
  </footer>

</html>

<?php

}
}

?>






