      <nav>

        <!-- judul -->
        <div class="shop-name">
          <h1> GREEN FLORIST </h1>
        </div>

        <div class="menu-logo center" onclick="navActive()"></div>

        <!-- navbar -->
        <!-- jika belum login -->
        <?php if (!isset($_SESSION["login"])) { ?>
        <div class="menu">

          <ul>
            <li> <a href="index.php" class="link-hover"> HOME </a> </li>
            <li> <a href="about.php" class="link-hover"> ABOUT </a> </li>
            <li> <a href="contact.php" class="link-hover"> CONTACT </a> </li>
          </ul>

          <ul>
            <li> <a href="sign-in.php" class="link-hover"> PRODUCTS </a> </li>
            <li> <a href="sign-in.php" class="link-hover"> CART </a> </li>
            <li> <a href="sign-in.php" class="link-hover"> SIGN IN </a> </li>
          </ul>

        </div>

        <!-- jika login sebagai admin -->
        <?php } else if ($_SESSION["login"] == "admin") { ?>

        <div class="menu admin">

          <ul>
            <li> <a href="index.php" class="link-hover"> HOME </a> </li>
            <li> <a href="about.php" class="link-hover"> ABOUT </a> </li>
            <li> <a href="contact.php" class="link-hover"> CONTACT </a> </li>
            <li> <a href="products.php" class="link-hover"> PRODUCTS </a> </li>
          </ul>

          <ul>
            <li> <a href="add.php" class="link-hover"> ADD </a> </li>
            <li> <a href="products.php?mode=edit" class="link-hover"> EDIT </a> </li>
            <li> <a href="order.php" class="link-hover"> ORDER </a> </li>
            <li> <a href="logout.php" class="link-hover"> LOG OUT </a> </li>
          </ul>

        </div>

        <!-- jika login sebagai user -->
        <?php } else if ($_SESSION["login"] == "user") { ?>

        <div class="menu user">

          <ul>
            <li> <a href="index.php" class="link-hover"> HOME </a> </li>
            <li> <a href="about.php" class="link-hover"> ABOUT </a> </li>
            <li> <a href="contact.php" class="link-hover"> CONTACT </a> </li>
            <li> <a href="products.php" class="link-hover"> PRODUCTS </a> </li>
          </ul>

          <ul>
            <li> <a href="order.php" class="link-hover"> ORDER </a> </li>
            <li> <a href="cart.php" class="link-hover"> CART </a> </li>
            <li> <a href="profile.php" class="link-hover"> PROFILE </a> </li>
            <li> <a href="logout.php" class="link-hover"> LOG OUT </a> </li>
          </ul>

        </div>

        <?php } ?> <!-- end if -->

      </nav>