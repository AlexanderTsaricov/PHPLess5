<header class="header">
    <div class="header_box">
        <p>Это шапка сайта</p>
        <a href="/">Главная</a>
        <a href="/user/index/">Пользователи</a>
        <a href="/user/edit/">Создать пользователя</a>        
    </div>
    <div class="header_box">
        {% include "auth-template.tpl" %}
    </div>
</header>

<link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/header/header.css" }}>