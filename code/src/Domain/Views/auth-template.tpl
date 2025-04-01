{% if not user_authorized %}
    <p><a href="/user/enter/">Вход в систему</a></p>
{% else %}
    <p>Добро пожаловать на сайт, {{ user_name }}!</p>
    <a href="/user/logout/">Выйти</a>
{% endif %}