    <section id="content" class="register" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%,-50%);">
        <form action="/login/register" method="post" class="form-register">
            <h1>Форма регистрации</h1>
            <div>
                <input type="text" placeholder="Имя" name="registerForm[name]" <?php if (isset($attributes) && !in_array('name', $attributes)):?>
                       value="<?= $_POST['registerForm']['name'] ?>" <?php elseif(!isset($success)): ?> value="" class="error" <?php endif; ?>/>
            </div>
            <div>
                <input type="text" placeholder="Телефон" name="registerForm[phone]" <?php if (isset($attributes) && !in_array('phone', $attributes)):?>
                    value="<?= $_POST['registerForm']['phone'] ?>" <?php elseif(!isset($success)): ?> value="" class="error" <?php endif; ?>/>
            </div>
            <div>
                <input type="text" placeholder="Email" name="registerForm[email]" <?php if (isset($attributes) && !in_array('email', $attributes)):?>
                    value="<?= $_POST['registerForm']['email'] ?>" <?php elseif(!isset($success)): ?> value="" class="error" <?php endif; ?>/>
            </div>
            <div>
                <input type="password" placeholder="Пароль"  name="registerForm[password]" <?php if (isset($attributes) && !in_array('password', $attributes)):?>
                    class="error" <?php endif; ?>/>
            </div>
            <div>
                <input type="password" placeholder="Повторите пароль" name="registerForm[password_check]" />
            </div>
            <div>
                <input type="submit" value="Регистрация" />
            </div>
        </form>


        <div id="results">
            <h1>Упс! Ошибочки...</h1>
            <div class="errors-wrapper">
                <?php
                    foreach ($errors as $error){
                        echo $error . '<br>';
                    }
                ?>
            </div>
        </div>

        <div id="success">
            <h1>Теперь ты в наших рядах</h1>
            <div class="success-wrapper">
                <?= $success; ?>

                <a href="/login">Войти в систему</a>
                <a href="/">На главную</a>
            </div>
        </div>

    </section>


    <script>
        <?php if (isset($errors)) { ?>
            $(function () {
                $('#results').addClass('active');
            });
        <?php } else if (isset($success)) { ?>
            $(function () {
                $('#success').addClass('active');
            });
        <?php } ?>
    </script>
