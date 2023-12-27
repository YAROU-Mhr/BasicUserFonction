<?php
#Page de traitement d'btn_connexion


if(isset($_POST['btn_connexion'])){
    #J'appel la connexion à la base de donné
    require('bdd.php');

#Si le click est fait sur le boutton se connecter
# je récupère les variable
    $email = htmlspecialchars($_POST['f_email']);
    $mdp = htmlspecialchars($_POST['f_mdp']);
#fin de la récupération "htmlspecialchars" est une fonction pour empêcher l'insertion de code html via le formulaire
#mdp = mot de pass 
#$_POST['f_xxx'] sont les donné provenant du formulaire 

#je vérifie si l'utilisateur existe déjà dans ma base de donné

    $select = "SELECT * FROM users WHERE email = ?";
    $stmt = $bdd->prepare($select);
    $stmt->execute([$email]);

    
    if($stmt->rowCount() >0){
        #c'est bon il existe  on peut le connecter
        #je récupère tout les information du compte lié a cet email
        $user_info = $stmt->fetch();
        #maintenant que j'ai toute ces info dans " $user_info" je vais cérifier si le mot de passe renseigné est correcte
        # "$user_info['mdp']" proviens des info récupéré de la base de donné(on précise le champs que l'on veut dans les griffes)

        if( password_verify($mdp,$user_info['mdp'])){
            #mot de pass correct
            #on démmare la session et on passe son ID dans la variable global grâce à $user_info et on pécide le champs id de la base de donné
            session_start();
            $_SESSION['id_user']= $user_info['id'];
            #on le redirige en suite
            echo"<script>alert('Bienvenus ')</script>";
            header("refresh:0.1; url=../tboard.php");
        }else{
            #Mot de passe incorrect
            echo"<script>alert('Le mot de passe renseigné est incorrecte')</script>";
            header("refresh:0.1; url=../login.php");
        }

    }else{
        #si la requête envoie aucun résultat alors ce mail(donc l'utilisateur puique c'est le mail qui le represente) n'existe pas dans notre base de donné
        echo"<script>alert('Cet mail n\'est pas reconnus')</script>";
        header("refresh:0.1; url=../login.php");
    }



}else{
#si non je le redirige vers la page de connexion. c'est manière de sécurisé cette page pour éviter des accès directe vers ce fichiers en cas d'attaque je sors du dossier php et je vais à login
    header("location:../login.php");
}