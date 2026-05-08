<?php $isAdmin = str_contains($_SERVER['REQUEST_URI'], 'admin'); ?>

<nav class="navbar navbar-expand-lg navbar-principale">
    <div class="container-fluid">

        <?php if ($isAdmin): ?>
            <a class="navbar-brand d-flex align-items-center" href="../index_.php?page=accueil.php">
                <img src="assets/images/logo.jpg" alt="Logo">
                <span class="navbar-brand-text">VCP</span>
            </a>
        <?php else: ?>
            <a class="navbar-brand d-flex align-items-center" href="index_.php?page=accueil.php">
                <img src="admin/assets/images/logo.jpg" alt="Logo">
                <span class="navbar-brand-text">VCP</span>
            </a>
        <?php endif; ?>

        <?php if ($isAdmin): ?>
        <form class="d-flex flex-grow-1 mx-3" role="search" action="../index_.php" method="get">
            <?php else: ?>
            <form class="d-flex flex-grow-1 mx-3" role="search" action="index_.php" method="get">
                <?php endif; ?>
                <input type="hidden" name="page" value="boutique.php">
                <input class="form-control" type="search" name="recherche" placeholder="Commencez une recherche ..">
            </form>

            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 d-flex flex-row gap-3">
                <?php if (isset($_SESSION['admin'])): ?>
                    <li class="nav-item text-center">
                        <?php if ($isAdmin): ?>
                        <a class="nav-link" href="index_.php?page=mon_compte.php">
                            <?php else: ?>
                            <a class="nav-link" href="admin/index_.php?page=mon_compte.php">
                                <?php endif; ?>
                                <i class="fa-solid fa-user fa-lg"></i><br>
                                <small>Admin</small>
                            </a>
                    </li>
                <?php elseif (isset($_SESSION['client'])): ?>
                    <li class="nav-item text-center">
                        <?php if ($isAdmin): ?>
                        <a class="nav-link" href="../index_.php?page=mon_compte.php">
                            <?php else: ?>
                            <a class="nav-link" href="index_.php?page=mon_compte.php">
                                <?php endif; ?>
                                <i class="fa-solid fa-user fa-lg"></i><br>
                                <small><?= $_SESSION['client']->prenom_client ?></small>
                            </a>
                    </li>
                <?php else: ?>
                    <li class="nav-item text-center">
                        <?php if ($isAdmin): ?>
                        <a class="nav-link" href="../index_.php?page=login_client.php">
                            <?php else: ?>
                            <a class="nav-link" href="index_.php?page=login_client.php">
                                <?php endif; ?>
                                <i class="fa-solid fa-user fa-lg"></i><br>
                                <small>S'identifier</small>
                            </a>
                    </li>
                <?php endif; ?>
                <li class="nav-item text-center">
                    <?php if ($isAdmin): ?>
                    <a class="nav-link" href="../index_.php?page=panier.php">
                        <?php else: ?>
                        <a class="nav-link" href="index_.php?page=panier.php">
                            <?php endif; ?>
                            <i class="fa-solid fa-basket-shopping fa-lg"></i><br>
                            <small>Panier</small>
                        </a>
                </li>
            </ul>
    </div>
</nav>