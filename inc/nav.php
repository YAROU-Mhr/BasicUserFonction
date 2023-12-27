<nav class="navbar navbar-expand-lg bg-dark navbar-dark px-5">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="index.php">Acceuil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="liste.php">Listes utilisateurs</a>
                </li>

                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                        #si auth_user existe(utilisateur connecté grace a sécurité alors on affiche son nom si non on est affiche comprte)
                        if (isset($auth_user) && !empty($auth_user)) {
                            print('Bienvenus ' . $auth_user['nom']);
                        } else {
                            print('Compte utilisateur');
                        }
                        ?>

                    </a>

                    <ul class="dropdown-menu">
                        <li>
                            <a href="tboard.php" class="dropdown-item">Tableau de bord</a>
                        </li>
                        <?php
                        if (isset($auth_user) && !empty($auth_user)) {
                        ?>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="php/logout.php">Déconnection</a></li>

                        <?php
                        } else {
                        ?>
                            <li>
                                <a href="login.php" class="dropdown-item ">Login</a>
                            </li>
                        <?php
                        }
                        ?>
                    </ul>
                </li>

            </ul>
        </div>
    </div>
</nav>