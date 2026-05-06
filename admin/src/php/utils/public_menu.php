<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=accueil.php">Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=panier.php">Panier</a>
                </li>
                <?php if (isset($_SESSION['admin'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="admin/index_.php?page=mon_compte.php">Admin</a>
                    </li>
                <?php elseif (isset($_SESSION['client'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=mon_compte.php"><?= $_SESSION['client']->prenom_client ?></a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="index_.php?page=mon_compte.php">Mon compte</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
<nav class="navbar navbar-expand-lg bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=boutique.php&type=carte individuelle">Cartes individuelles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=boutique.php&type=display">Displays</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=boutique.php&type=bundle">Bundles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=boutique.php&type=pack">Packs</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index_.php?page=boutique.php&type=booster">Boosters</a>
                </li>
            </ul>
        </div>
    </div>
</nav>