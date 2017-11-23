<div class="container">
<h1>Запретная зона, доступ только авторизированному пользователю</h1>
  <h2>Информация выводится из базы данных</h2>
  <table class="table table-bordered">
      <tr>
          <th>Пользователь(логин)</th>
          <th>Имя</th>
          <th>возраст</th>
          <th>описание</th>
          <th>Фотография</th>
          <th>Действия</th>
      </tr>
      <?php
      while ($row = $stmt->fetch()){
          echo "<tr>";
            echo "<td>".$row['login']. "</td>";
            echo "<td>".$row['name']."</td>";
            echo "<td>".$row['age']."</td>";
            echo "<td>".$row['description']."</td>";
            echo '<td><img src="' . $uploads_dir. '/' .$row['photo'] . '" alt="" style="max-width:50px"></td>';
            echo '<td><a href="index.php?page=listusers&action=deleteuser&id='.$row["id"].'">Удалить пользователя</a></td>';

          echo "</tr>";
      }?>

  </table>

</div><!-- /.container -->

