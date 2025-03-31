

<section>
    <h2>Список пользователей в хранилище</h2>

    <ul class="ul" id="navigation">
        {% for user in users %}
            <li class=ul_li>
                <p>{{ user.getUserName() }} {{ user.getUserLastname() }}. День рождения {{ user.getUserBirthday() | date('d.m.Y') }}</p>
                <a href="/user/updatingUser/?id={{ user.getUserId() }}">Обновить данные</a>
                <a href="/user/delete/?id={{ user.getUserId() }}">Удалить пользователя</a>
            </li>
        {% endfor %}
    </ul>
</section>




<link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/user-index/user-index.css" }}>