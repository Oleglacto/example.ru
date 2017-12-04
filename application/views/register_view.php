<head>
    <link href="/styles/style_register.css" rel="stylesheet" type="text/css">
</head>
<body>
    <section id="content" class="register" style="position: fixed;top: 50%;left: 50%;transform: translate(-50%,-50%);">
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
        <form action="register" method="post">
            <h1>Register Form</h1>
            <div>
                <input type="text" placeholder="Имя" required="Заполни" name="first_name" />
            </div>
            <div>
                <input type="text" placeholder="Телефон" required="" name="phone" />
            </div>
            <div>
                <input type="text" placeholder="Ваш адрес" required="" name="address" />
            </div>
            <div>
                <input type="password" placeholder="Пароль" required="" name="password" />
            </div>
            <div>
                <input type="password" placeholder="Повторите пароль" required="" name="password_check" />
            </div>
            <div>
                <input type="submit" value="Регистрация" />
            </div>
        </form>
    </section>
</body>
