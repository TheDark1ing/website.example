<header class="d-flex flex-wrap align-items-center justify-content-center justify-content-md-between py-3 mb-4 border-bottom">
  <a href="/" class="d-flex align-items-center col-md-3 mb-2 mb-md-0 text-dark text-decoration-none">
    <svg class="bi me-2" width="40" height="32" role="img"><img style="margin-right:45px;" src="/img/icon.png" alt=""></svg>
  </a>

  <ul class="nav col-12 col-md-auto mb-2 justify-content-center mb-md-0">
    <li><a href="/" class="nav-link px-2 link-secondary">Домой</a></li>
    <li><a href="/contacts.php" class="nav-link px-2 link-dark">Контакты</a></li>
    <?php
        if($_COOKIE['login'] != '')
          echo '<li><a href="/article.php" class="nav-link px-2 link-dark">Добавить статью</a></li>';
    ?>


  </ul>
  <?php
      if($_COOKIE['login'] == ''):
  ?>
  <div class="col-md-3 text-end">
    <a href="/auth.php"><button type="button" class="btn btn-outline-primary me-2 mb-2">Войти</button></a>
    <a href="/reg.php"><button type="button" class="btn btn-primary me-2 mb-2">Регистрация</button></a>
  </div>
  <?php
      else:
  ?>
  <div class="col-md-3 text-end">
    <a href="/auth.php"><button type="button" class="btn btn-outline-primary me-2 mb-2">Кабинет пользователя</button></a>
  </div>
  <?php
      endif;
  ?>
</header>
