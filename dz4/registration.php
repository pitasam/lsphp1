
<div class="container">

    <div class="form-container">
        <form class="form-horizontal" action="" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Логин" name="login" value="<?php echo @$data['login']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Пароль" name="password" value="<?php echo @$data['password']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword4" class="col-sm-2 control-label">Пароль (Повтор)</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword4" placeholder="Пароль" name="password2" value="<?php echo @$data['password2']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputName5" class="col-sm-2 control-label">Имя</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputName5" placeholder="Имя" name="name" value="<?php echo @$data['name']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAge5" class="col-sm-2 control-label">Возраст</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputAge5" placeholder="Возраст" name="age" value="<?php echo @$data['age']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputAbout6" class="col-sm-2 control-label">О себе</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="inputAbout6" placeholder="О себе" name="about" ><?php echo @$data['about']; ?></textarea>
                </div>
            </div>
            <div class="form-group">
                <label for="inputAbout6" class="col-sm-2 control-label">Фото</label>
                <div class="col-sm-10">
                    <input class="form-file" id="inputAbout6" type="file" placeholder="О себе" name="file" >
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="do_signup">Зарегистрироваться</button>
                    <br><br>
                    Зарегистрированы? <a href="index.php?page=auth">Авторизируйтесь</a>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->

