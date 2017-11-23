<div class="container">
<h1>Запретная зона, доступ только авторизированному пользователю</h1>
  <h2>Информация выводится из списка файлов</h2>
  <table class="table table-bordered">
    <tr>
      <th>Название файла</th>
      <th>Фотография</th>
      <th>Действия</th>
    </tr>
    <?php
    while ($row = $stmt->fetch()){
      echo "<tr>";
      echo "<td>".$row['photo']."</td>";
      echo '<td><img src="' . $uploads_dir. '/' .$row['photo'] . '" alt="" style="max-width:50px"></td>';
      echo '<td>
        <a href="index.php?page=listfiles&action=deletefile&id='.$row["id"].'">Удалить аватарку пользователя</a>
      </td>';
      echo "</tr>";
    }?>
  </table>

</div><!-- /.container -->
