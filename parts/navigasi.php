<?php
    $_username = isset($_SESSION["user_name"]) ? $_SESSION["user_name"] : 'Username';
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">Logo</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=wisata">Wisata</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=user">User</a>
                </li>
                <!-- Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                        <?php echo $_username;?>
                    </a>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="index.php?page=user-profile">Profile</a>
                        <a class="dropdown-item" href="index.php?page=logout">Logout</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=help">Help</a>
                </li>
            </ul>
        </div>
    </div>
</nav>