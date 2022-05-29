<?php
  if($_COOKIE['login'] == '') {
    header('Location: /reg.php');
    exit();
  }
?>

<!DOCTYPE html>
<html lang="ru">
<head>
  <?php
    $website_title = 'Добавление статьи';
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
          <h4>Добавление статьи</h4>
          <form method="post">
            <label for="title" class="mt-3">Заголовок статьи</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <input type="text" name="title" id="title" class="form-control ">
            </div>

            <label for="intro" class="mt-3">Интро статьи</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <textarea type="text" name="intro" id="intro" class="form-control "></textarea>
            </div>

            <label for="text" class="mt-3">Текст статьи</label>
            <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
              <textarea type="text" name="text" id="text" class="form-control "></textarea>
            </div>

            <div class="alert alert-danger col-lg-6 col-md-8 col-sm-8 col-xs-8 mt-3" id="errorBlock">
            </div>

            <button type="button" id="article_send" class="btn btn-info mt-3">Добавить</button>
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
    $('#article_send').click(function () {
      var title = $('#title').val();
      var intro = $('#intro').val();
      var text = $('#text').val();

      $.ajax({
        url: 'ajax/add_article.php',
        method: 'POST',
        cache: false,
        data: {'title' : title, 'intro' : intro, 'text' : text},
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
