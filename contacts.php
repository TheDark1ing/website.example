<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Контакты';
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
          <h4>Обратная связь</h4>
          <form method="post">
            <label for="username" class="mt-3">Имя</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="text" name="username" id="username" class="form-control ">
            </div>
            <label for="email" class="mt-2">Email</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="email" name="email" id="email" class="form-control ">
            </div>
            <label for="mess" class="mt-2">Сообщение</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <textarea name="mess" id="mess" class="form-control "></textarea>
            </div>

            <div class="alert alert-danger col-lg-6 col-md-8 col-sm-8 col-xs-8 mt-3" id="errorBlock">
            </div>

            <button type="button" id="mess_send" class="btn btn-info mt-3">Отправить сообщение</button>
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
    $('#mess_send').click(function () {
      var name = $('#username').val();
      var email = $('#email').val();
      var mess = $('#mess').val();

      $.ajax({
        url: 'ajax/mail.php',
        method: 'POST',
        cache: false,
        data: {'username' : name, 'email' : email, 'mess' : mess},
        dataType: 'html',
        success: function(data) {
          if(data == 'Готово'){
            $('#reg_user').text('Все готово');
            $('#errorBlock').hide();
            $('#username').val("");
            $('#email').val("");
            $('#mess').val("");
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
