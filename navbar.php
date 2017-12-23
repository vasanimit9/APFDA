
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
          <?php if ($_SESSION['type'] < 4) { ?>
          <li class="nav-item active">
            <a class="nav-link" href="./cpanel.php">Admin Panel</a>
          </li>
          <?php } ?>
          <li class="nav-item active">
            <a class="nav-link" href="#">Link</a>
          </li>
          <li class="nav-item active" id="logout_phone">
            <a class="nav-link" href="./logout.php">Log out</a>
          </li>
        </ul>
        <a class="nav-link my-2 my-md-0 text-white" id="logout_pc" href="./logout.php">Log out</a>
      </div>
    </nav>

    <script type="text/javascript">
      $(document).ready(function() {
        if(window.innerWidth < 568) {
          $("#logout_pc").css("display","none");
        }
        else {
          $("#logout_phone").css("display","none");
        }
      });
    </script>
