<!DOCTYPE html>
<html lang="ru">
<head>
	<?php
    require_once 'mysql_connect.php';

    $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
    $id = $_GET['id'];
    $query = $pdo->prepare($sql);
    $query->execute(['id' => $id]);

    $article = $query->fetch(PDO::FETCH_OBJ);

		$website_title = $article->title;
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
        <div class="container-fluid bg-secondary text-light p-5 rounded-3">
          <h1><?=$article->title?></h1>
          <p><b>Автор статьи: </b><mark><?=$article->author?></mark></p>
          <?php
            $date = date('d ', $article->date);
            $array = ['января', 'февраля', 'марта', 'апреля', 'мая', 'июня','июля', 'августа', 'сентября','октября', 'ноября', 'декабря'];
            $date .= $array[date('n', $article->date) - 1];
            $date .= date(' H:i', $article->date);
          ?>
          <p><b>Время публикации: </b><u><?=$date?></u></p>
          <p>
            <?=$article->intro?>
            <br><br>
            <?=$article->text?>
          </p>
        </div>
        <h3 class="mt-5">Комментарии</h3>
        <form action="/news.php?id=<?=$id?>" method="post">
          <label for="username" class="mt-3">Имя</label>
          <div class="col-lg-6 col-md-8 col-sm-8 col-xs-8">
            <input type="text" name="username" value="<?=$_COOKIE['login']?>" id="username" class="form-control">
          </div>
          <label for="mess" class="mt-2">Сообщение</label>
          <div >
            <textarea name="mess" id="mess" class="form-control"></textarea>
          </div>

          <button type="submit" id="mess_send" class="btn btn-info mt-5 mb-5">Добавить комментарий</button>
        </form>
        <?php
          if($_POST['username'] != '' && $_POST['mess'] != ''){
            $username = trim(filter_var($_POST['username'], FILTER_SANITIZE_STRING));
            $mess = trim(filter_var($_POST['mess'], FILTER_SANITIZE_STRING));

            $sql = 'INSERT INTO comments(name, mess, article_id) VALUES(?, ?, ?)';
            $query = $pdo->prepare($sql);
            $query->execute([$username, $mess, $id]);
          }

          $sql = 'SELECT * FROM `comments` WHERE `article_id` = :id ORDER BY `id` DESC';
          $query = $pdo->prepare($sql);
          $query->execute(['id' => $id]);
          $comments = $query->fetchAll(PDO::FETCH_OBJ);

          foreach($comments as $comment){
            echo "<div class='alert alert-info mb-2'>
                  <h5><b>$comment->name</b></h5>
                  <p>$comment->mess</p></div>";
          }

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
</body>
</html>
