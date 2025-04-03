{% if not user_authorized %}
    <p><a class="btn btn-success" href="/user/enter/">Вход в систему</a></p>
{% else %}
    <p>Добро пожаловать на сайт, {{ user_name }}!</p>
    <a class="btn btn-danger" href="/user/logout/">Выйти</a>
{% endif %}