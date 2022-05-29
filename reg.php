<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Регистрация';
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
          <h4>Форма регистрации</h4>
          <form method="post">
            <label for="username" class="mt-3">Имя</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="text" name="username" id="username" class="form-control ">
            </div>
            <label for="login" class="mt-2">Логин</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="text" name="login" id="login" class="form-control ">
            </div>
            <label for="email" class="mt-2">Email</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="email" name="email" id="email" class="form-control ">
            </div>
            <label for="pass" class="mt-2">Пароль</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="password" name="pass" id="pass" class="form-control ">
            </div>

            <div class="alert alert-danger col-lg-6 col-md-8 col-sm-8 col-xs-8 mt-3" id="errorBlock">
            </div>

            <button type="button" id="reg_user" class="btn btn-info mt-3">Зарегистрироваться</button>
          </form>
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
    $('#reg_user').click(function () {
      var name = $('#username').val();
      var login = $('#login').val();
      var email = $('#email').val();
      var pass = $('#pass').val();

      $.ajax({
        url: 'ajax/reg.php',
        method: 'POST',
        cache: false,
        data: {'username' : name, 'login' : login, 'email' : email, 'pass' : pass},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово'){
            $('#reg_user').text('Все готово');
            $('#errorBlock').hide();
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
