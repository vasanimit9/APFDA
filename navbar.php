
  <?php
    if(empty($_SESSION))
      header("Location: ./");
  ?>
  <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
    <a class="navbar-brand" href="#">A P F D A</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarCollapse">
        <ul class="navbar-nav mr-auto">
          <?php if ($_SESSION['type'] < 3) { ?>
          <li class="nav-item active">
            <a class="nav-link" href="./cpanel.php">Admin Panel</a>
          </li>
          <?php } ?>
          <li class="nav-item active">
            <a class="nav-link" href="#">Link</a>
          </li>
          <!-- <li class="nav-item active">
            <a class="nav-link" href="./logout.php">Log out</a>
          </li> -->
        </ul>
        <a class="nav-link my-2 my-md-0 text-white" href="./logout.php">Log out</a>
      </div>
    </nav>

