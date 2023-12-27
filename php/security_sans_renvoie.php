<?php
#On va sécuriser la page de sorte a ce qu'il ne puisse pas accéder sans être connecté 
#Pour cela on démmare encore la session et on vérifie si $_SESSION['id_agent] qu'on a déclaré lors de la connexion existe(isset) et n'est pas vide (!empty)
# NB: Si on le démarre pas la session 'session_start()' on aura pas accès a la variable ' $_SESSION['id_agent]' (On parle de variable super global)

require 'php/bdd.php';//appel à la base de donné pour usage de '$bdd'

session_start();

 //vérification pour l'empêcher d'atteindre la page étant connecté
 // isset($_SESSION['id_user']) veut dire que la session existe
 // !empty($_SESSION['id_user'] veut dire que la session n'est pas vide
if(isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])){
    #on fait une requête pour récupérer les info de l'utilisateur connecté selon son id ($_SESSION['id_user'])
    $id_user = $_SESSION['id_user'];

    $select = "SELECT * FROM users WHERE id = ? ";
    $stmt = $bdd->prepare($select);
    $stmt->execute([$id_user]);
    if($stmt->rowCount() === 1){
        #si on récupère l'tilisateur re trouvé
        #grâce à ça sur toute la page(en dessous de ce bout de c_ode) on a les info de l'utilisateur connecté
        $user = $stmt->fetch();
        
    }else{
        #si on a pas récupéré l'utilisateur on le renvoie à la connexion parceque les informations liées à lo'd récupéré n'existe pas dans notre base de donné
        echo"<script>alert('vous n\'avez pas été identifié')</script>";
        header("refresh:0.1; url=login.php");
    }
}

#au cas où la sécutité inclus pluisieurs fichier pour éviter de réécrire pluisieur fois le même code il suffit d'importé un fichier de sécutité où tun as déjà écris le code de la manière suivante:
// require 'php/security.php';
#NB adapte le chemain du fichier à ton projet


?>