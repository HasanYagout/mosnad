<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid bg-white shadow-sm">
        <a class="navbar-brand" href="#">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 w-100 justify-content-center">
                <li class="nav-item py-3"><a class="nav-link <?php echo $_SERVER['REQUEST_URI']=='/test/index' ? 'bg-primary text-secondary':'' ?> text-primary text-hover-secondary fs-5" href="/">Home</a></li>
                <li class="nav-item py-3"><a class="nav-link <?php echo $_SERVER['REQUEST_URI']=='/test/about'?  'bg-primary text-secondary':'' ?> text-primary text-hover-secondary fs-5" href="/about">About</a></li>
                <li class="nav-item py-3"><a class="nav-link  text-primary text-hover-secondary fs-5" href="news.php">News</a></li>
                <li class="nav-item py-3"><a class="nav-link text-primary text-hover-secondary fs-5" href="contact.php">Contact Us</a></li>
                <li class="nav-item py-3"><a class="nav-link text-primary text-hover-secondary fs-5" href="/posts">Posts</a></li>

            </ul>

        </div>
    </div>
</nav>