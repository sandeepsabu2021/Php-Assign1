<nav class="navbar navbar-expand-lg navbar-light" style="background-color: #e3f2fd">
    <a class="navbar-brand mb-0 h1 text-danger" href="?page=home">Spark EduTech</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav mx-auto">
            <a class="nav-item nav-link mr-3" href="?page=home">Home</a>
            <a class="nav-item nav-link" href="?page=changepass">Change Password</a>
        </div>
        <span class="navbar-text">
            Welcome: <?php echo "$name"; ?> <a class="mx-3" href="logout.php">Logout</a>
        </span>
    </div>
</nav>