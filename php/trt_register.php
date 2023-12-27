<?php
#Page de traitement d'btn_inscription



if(isset($_POST['btn_inscription'])){
#J'appel la connexion à la base de donné
require('bdd.php');

#Si le click est fait sur le boutton s'inscrire
# je récupère les variable
    $nom = htmlspecialchars($_POST['f_nom']);
    $prenom = htmlspecialchars($_POST['f_prenom']);
    $email = htmlspecialchars($_POST['f_email']);
    $mdp = htmlspecialchars($_POST['f_mdp']);
    $cmdp = htmlspecialchars($_POST['f_cmdp']);
#fin de la récupération "htmlspecialchars" est une fonction pour empêcher l'insertion de code html via le formulaire
#mdp = mot de pass && cmdp=cofirmation mot de passe
#$_POST['f_xxx'] sont les donné provenant du formulaire 

#je vérifie si l'utilisateur existe déjà dans ma base de donné

    $select = "SELECT * FROM users WHERE email = ?";
    $stmt = $bdd->prepare($select);
    $stmt->execute([$email]);

    if($stmt->rowCount() >0){
       #si la requête envoie un résultat alors ces renseignement existe déjà
        echo"<script>alert('Ces coordonnées sont déjà utilisé')</script>";
        header("refresh:0.1; url=../register.php");
    }else{
        #c'est bon il n'existe pas on peut l'ajouter
        #je véfifie si les mot de passe concorde 
        if($mdp == $cmdp){
            #je cript maintenant le mot de passe
            $mdp = password_hash($mdp, PASSWORD_DEFAULT);
            #requête d'insertion dans la parenthèse on a les champs dans la base de donné
            #Dans l'excute on passe maintenant les valeurs récupéré du formulaire
            #la variable "$bdd" provient de la connexion à la bade de donné
            $insert = "INSERT INTO users(nom,prenom,email,mdp) VALUES (?,?,?,?)";
            $stmt = $bdd->prepare($insert);
            $stmt->execute([$nom,$prenom,$email,$mdp]);
            
            if($stmt){
            #si la requête passe j'envoie un message je sors du dossier php et je vais à login
                echo"<script>alert('incription éffectué veuillez vous connecter')</script>";
                header("refresh:0.1; url=../login.php");
            }else{
                #si la requête ne passe pas je sors du dossier php et je vais à register
                echo"<script>alert('Echecs de la requête d\'incription')</script>";
                header("refresh:0.1; url=../register.php");
            }
    
        }else{
            #les mot de passe reseigné dans le formulaire ne concorde pas  je sors du dossier php et je vais à register
            echo"<script>alert('Les mot de passe ne sont pas identiques')</script>";
            header("refresh:0.1; url=../register.php");
        }
    }



}else{
#si non je le redirige vers la page d'inscription c'est manière de sécurisé cette page pour éviter des accès directe vers ce fichiers en cas d'attaque je sors du dossier php et je vais à register
    header("location:../register.php");
}