<?php
//ici on a pas les informations de l'utilisateur
require 'php/security_avec_renvoie.php'; //fichier qui vérifie si il est connecté et nous donne des information 
//ici on a pas les informations de l'utilisateur car maintenant on a requie php/security_avec_renvoie.php

//la connection a la base de doné est délà faite dans 'php/security_avec_renvoie.php on répète plus  
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <!--  inclusion du contennus du head sui se trouve dans le dossier inc-->
    <?php require "inc/head.php"; ?>
    <title>Liste des Utilisateurs</title>

</head>

<body style="width:100vw; overflow-x:hidden;" class="bg-light">

    <div class="container-fluid p-0 m-0">
        <!-- 
        la nav est une partie casiment identique dans toute la page alors il suffit d'isoler le code et de l'inclure à chaque fois les liens dans la nav sont par rapport à la page dans laquel elle est incluse et non par rapport au dossier 'inc'
        pour aller vers login on aura dans le fichier nav.php
        <a href="login.php" >Login</a>
        et non
        <a href="../login.php" >Login</a>
    -->
        <?php require('inc/nav.php') ?>
    </div>
    <div class="container">
        <h2>Liste des Utilisateurs</h2>

        <div class="row">
            <div class="col-md-6">
                <!-- Champ de recherche -->
                <div class="form-group mb-3">
                    <label for="searchInput">Rechercher par nom avec js:</label>
                    <input type="text" class="form-control" id="searchInput" placeholder="Entrez le nom de l'utilisateur">
                </div>
            </div>
            <div class="col-md-6">
                <form method="post" action="">
                    <label for="searchInput">Rechercher par Email avec php:</label>
                    <div class="input-group mb-3">
                        <input type="text" required class="form-control" id="searchInput" name="searchTerm" placeholder="Entrez l'email de l'utilisateur">
                        <button type="submit" class="btn btn-primary">Rechercher</button>
                    </div>
                </form>
            </div>
        </div>

        <?php
        // Si lutilisateur en clence une recherche avec le bouttopn donc est initiaiser
        //alors pour vérifier si une recherche a été initialiser isset($_POST['searchTerm'] car "searchTerm" est le nom de l'input qui contient la recherche
        if (isset($_POST['searchTerm'])) {
        ?>
            <!-- div qui apparait lorsqu'on fait de la recherche -->
            <div class="bg-white border shadow rounded p-2 mb-5" id="Resultsdiv">
                <h2 class="float-start ">Résultat par rapport à : <span class="fs-5 text-info"><?= $_POST['searchTerm'] ?></span> </h2>

                <!-- Bouton pour masquer les résultats -->
                <button type="button" class="btn btn-danger  float-end mb-2" id="hideResultsBtn">Masquer les résultats de la recherche</button>

                <!-- Tableau des utilisateurs -->
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Email</th>
                            <th>Téléphone</th>
                            <th>Adresse</th>
                            <th>Role</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        $searchTerm = '%' . $_POST['searchTerm'] . '%';

                        $sql = "SELECT * FROM users WHERE email LIKE :searchTerm";
                        $result = $bdd->prepare($sql);
                        $result->execute(['searchTerm' => $searchTerm]);

                        if ($result->rowCount() > 0) {
                            $users = $result->fetchAll();

                            foreach ($users as $user) {
                                echo "<tr>";
                                echo "<td>{$user['nom']}</td>";
                                echo "<td>{$user['prenom']}</td>";
                                echo "<td>{$user['email']}</td>";
                                echo "<td>{$user['telephone']}</td>";
                                echo "<td>{$user['adresse']}</td>";

                                // Ajouter la logique pour afficher le rôle en fonction de sa valeur
                                $roleText = "";
                                switch ($user['role']) {
                                    case 0:
                                        $roleText = "Utilisateur";
                                        break;
                                    case 1:
                                        $roleText = "Admin";
                                        break;
                                    case 2:
                                        $roleText = "Éditeur";
                                        break;
                                    default:
                                        $roleText = "Inconnu";
                                }

                                echo "<td>{$roleText}</td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>Aucun résultat trouvé</td></tr>";
                        }

                        ?>
                    </tbody>
                </table>
            </div>

        <?php
        }
        ?>



        <!-- div que l'on voit sur la page elle est recharcgé avec ajax(js)  -->
        <div class="bg-white border shadow rounded p-2">
            <?php

            #si utlisateur connecté admin alors on vois le boutton ajouter
            if ($auth_user['role'] == '1') {
            ?>
                <a href="form_add_user.php" class="btn btn-sm btn-primary float-end mb-2">Ajouter utilisateur</a>
            <?php
            }
            ?>

            <!-- pour les showMessage dans js -->
            <div id="messageContainer" class="mt-5"></div>

            <!-- Tableau des utilisateurs -->
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Email</th>
                        <th>Téléphone</th>
                        <th>Adresse</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="liste_all_users">
                    <!-- Les données de l'utilisateur seront générées dynamiquement ici grâce à id="liste_all_users" voir dans le code js en dessous-->
                </tbody>
            </table>
        </div>
    </div>


    <!-- Ajoutez le lien vers la bibliothèque Bootstrap JS et jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="assets/bootstrap/js/script.js"></script>
    <script src="assets/icon/js/script.js"></script>

    <!-- Script JavaScript pour gérer la recherche d'utilisateur -->
    <script>
        $(document).ready(function() {


            function getUsersFromServer(callback) {
                $.ajax({
                    url: 'php/get_users.php', // Chemin vers le fichier PHP
                    method: 'GET',
                    success: function(users) {
                        callback(users);
                    },
                    error: function(error) {
                        console.error('Erreur lors de la récupération des utilisateurs:', error);
                    }
                });
            }

            // Fonction pour afficher les utilisateurs dans le tableau
            function displayUsers(searchTerm) {
                var tbody = $("#liste_all_users");
                tbody.empty(); // Efface le contenu actuel du tableau

                // Appeler la fonction pour récupérer les utilisateurs depuis le serveur PHP
                getUsersFromServer(function(users) {
                    // Filtrer les utilisateurs en fonction du terme de recherche
                    var filteredUsers = users.filter(function(user) {
                        return user.nom.toLowerCase().includes(searchTerm.toLowerCase());
                    });

                    // Remplir le tableau avec les utilisateurs filtrés
                    filteredUsers.forEach(function(user) {

                        //récupérer id de l'utilisateur connecté l'information existe egrace au fichier de securité en haut
                        var authUserId = '<?= $auth_user['id']; ?>'
                        console.log(authUserId);
                        // Ajouter une vérification pour exclure l'utilisateur connecté
                        if (user.id !== authUserId) {

                            var row = $("<tr>");
                            row.append($("<td>").text(user.nom));
                            row.append($("<td>").text(user.prenom));
                            row.append($("<td>").text(user.email));
                            row.append($("<td>").text(user.telephone));
                            row.append($("<td>").text(user.adresse));

                            // Ajoutez une logique conditionnelle pour afficher le rôle en fonction de sa valeur
                            var roleText = "";
                            var roleClass = ""; // Nouvelle variable pour stocker la classe Bootstrap en fonction du rôle

                            switch (user.role) {
                                case 0:
                                    roleText = "Utilisateur";
                                    roleClass = "btn btn-sm btn-info"; // Exemple de classe pour le rôle Utilisateur
                                    break;
                                case 1:
                                    roleText = "Admin";
                                    roleClass = "btn btn-sm btn-danger"; // Exemple de classe pour le rôle Admin
                                    break;
                                case 2:
                                    roleText = "Éditeur";
                                    roleClass = "btn btn-sm btn-warning"; // Exemple de classe pour le rôle Éditeur
                                    break;
                                default:
                                    roleText = "Inconnu";
                                    roleClass = "btn btn-sm btn-secondary"; // Exemple de classe pour les autres rôles
                            }

                            // Ajoutez la classe Bootstrap à la colonne du rôle
                            row.append($("<td>").append($("<button>").text(roleText).addClass(roleClass)));

                            // Ajouter des boutons de suppression et de modification
                            row.append($("<td>").append(
                                $("<a>").attr("href", "view_user.php?id=" + user.id)
                                .addClass("btn btn-sm btn-info mx-1 text-white")
                                .text("Voir"),

                                $("<a>").attr("href", "form_update_user.php?id=" + user.id)
                                .addClass("btn btn-sm btn-primary mx-1")
                                .text("Modifier"),

                                $("<button>").text("Supprimer").addClass("btn btn-sm btn-danger").on("click", function() {
                                    // Afficher une boîte de confirmation avant la suppression
                                    if (confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur?")) {
                                        // Appeler la fonction de suppression avec AJAX
                                        $.ajax({
                                            url: 'php/supprimer_utilisateur.php',
                                            method: 'POST',
                                            data: {
                                                id: user.id
                                            },
                                            success: function(response) {
                                                // Afficher le message d'erreur
                                                showMessage('success', 'Suppression de l\'utilisateur éffectué.');
                                                // Mettre à jour l'affichage après la suppression
                                                displayUsers($("#searchInput").val());
                                            },
                                            error: function(error) {
                                                // Afficher le message d'erreur
                                                showMessage('danger', 'Erreur lors de la suppression de l\'utilisateur.');
                                                //affiche l'eerur dans la console lorsquon inspecte le navogateur
                                                console.error('Erreur lors de la suppression de l\'utilisateur:', error);

                                            }
                                        });
                                    }
                                })

                            ));


                            tbody.append(row);
                        }
                    });
                });
            }

            // Gérer l'événement de changement de saisie dans le champ de recherche
            $("#searchInput").on("input", function() {
                var searchTerm = $(this).val();
                displayUsers(searchTerm);
            });

            // Afficher tous les utilisateurs au chargement de la page
            displayUsers("");


            // Gérer le clic sur le bouton pour masquer les résultats
            $("#hideResultsBtn").click(function() {
                // Cacher les résultats
                $("#Resultsdiv").hide();
                // Cacher le bouton
                $(this).hide();
            });


            // Fonction pour afficher les messages
            function showMessage(type, message) {
                // Créer l'élément de message
                var alert = $("<div>").addClass("alert alert-" + type + " alert-dismissible fade show")
                    .attr("role", "alert")
                    .text(message);

                // Ajouter le bouton de fermeture
                alert.append($("<button>").addClass("btn-close").attr("data-bs-dismiss", "alert").attr("aria-label", "Close"));

                // Vider le contenu de la div de message et ajouter le nouveau message
                $("#messageContainer").empty().append(alert);

                // Cacher le message après quelques secondes (facultatif)
                setTimeout(function() {
                    $("#messageContainer").empty();
                }, 5000); // Masquer après 5 secondes (ajustez selon vos besoins)
            }


        });
    </script>

</body>



</html>