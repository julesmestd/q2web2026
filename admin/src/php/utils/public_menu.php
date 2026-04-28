<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=accueil.php">Accueil</a>
                </li>
                <?php if (isset($_SESSION['admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index_.php?page=accueil.php">Administration</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index_.php?page=disconnect.php">Déconnexion admin</a>
                    </li>
                <?php elseif (isset($_SESSION['client'])): ?>
                    <li class="nav-item">
                        <span class="nav-link">Bonjour <?= $_SESSION['client']->prenom_client ?></span>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=disconnect.php">Déconnexion</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=login_client.php">Connexion</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=compte.php">Inscription</a>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"/>
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>