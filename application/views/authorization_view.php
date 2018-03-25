<head>
    <link href="/styles/style_login.css" rel="stylesheet" type="text/css">
</head>
<div class="container">
    <section id="content">
        <form action="/authorization/login" method="post">
            <h1>Войти</h1>
            <?php if(isset($errors)) {
                echo $errors;
            } ?>
            <div>
                <input type="text" placeholder="Email" id="username" name="loginForm[email]" />
            </div>
            <div>
                <input type="password" placeholder="Пароль" id="password" name="loginForm[password]"/>
            </div>
            <div>
                <input type="submit" value="Log in" />
                <a href="dsf">Lost your password?</a>
                <a href="login/formRegister">Register</a>
            </div>
        </form>
    </section>
</div>