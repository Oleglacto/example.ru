<head>
    <link href="/styles/style_register.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container">
        <section id="content" class="register">
            <?php
            if (isset($error)) {
                $error;
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
    </div>
</body>
