
<div class="container">

    <div class="form-container">
        <form class="form-horizontal" action="" method="POST">
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-2 control-label">Логин</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputEmail3" placeholder="Логин" name="login" value="<?php @$data['login']; ?>">
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                <div class="col-sm-10">
                    <input type="password" class="form-control" id="inputPassword3" placeholder="Пароль" name="password" value="<?php @$data['password']; ?>">
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default" name="do_login">Войти</button>
                    <br><br>
                    Нет аккаунта? <a href="index.php?page=reg">Зарегистрируйтесь</a>
                </div>
            </div>
        </form>
    </div>

</div><!-- /.container -->

