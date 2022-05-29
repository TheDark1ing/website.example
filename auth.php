<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Авторизация';
		require 'blocks/head.php';
	?>
</head>
<body>
	<?php
		require 'blocks/header.php';
	?>

	<main class="container mt-5">
		<div class="row">
			<div class="col-md-8 mb-3">
        <?php
            if($_COOKIE['login'] == ''):
        ?>
          <h4>Форма авторизации</h4>
          <form method="post">

            <label for="login" class="mt-2">Логин</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="text" name="login" id="login" class="form-control ">
            </div>

            <label for="pass" class="mt-2">Пароль</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="password" name="pass" id="pass" class="form-control ">
            </div>

            <div class="alert alert-danger col-lg-6 col-md-8 col-sm-8 col-xs-8 mt-3" id="errorBlock">
            </div>

            <button type="button" id="auth_user" class="btn btn-info mt-3">Войти</button>
          </form>
          <?php
            else:
          ?>
          <h2><?=$_COOKIE['login']?></h2>
          <button class="btn btn-danger" id="exit_btn">Выйти</button>
          <?php
            endif;
          ?>
			</div>
			<?php
				require 'blocks/aside.php';
			?>
		</div>
	</main>

	<?php
		require 'blocks/footer.php';
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script>
  $('#exit_btn').click(function () {
    $.ajax({
      url: 'ajax/exit.php',
      method: 'POST',
      cache: false,
      data: {},
      dataType: 'html',
      success: function(data) {
        document.location.reload(true);
      }
    });
  });

    $('#auth_user').click(function () {
      var login = $('#login').val();
      var pass = $('#pass').val();

      $.ajax({
        url: 'ajax/auth.php',
        method: 'POST',
        cache: false,
        data: {'login' : login, 'pass' : pass},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово'){
            $('#auth_user').text('Готово');
            $('#errorBlock').hide();
            document.location.reload(true);
            }
          else {
            $('#errorBlock').show();
            $('#errorBlock').text(data);
          }
        }
      });
    });
  </script>
</body>
</html>