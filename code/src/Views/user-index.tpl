

<section>
    <h2>Список пользователей в хранилище</h2>

    <ul class="ul" id="navigation">
        {% for user in users %}
            <li class=ul_li>{{ user.getUserName() }}. День рождения {{ user.getUserBirthday() | date('d.m.Y') }}</li>
        {% endfor %}
    </ul>
</section>
<section>
    <h2>Добавить пользователя в хранилище</h2>
    {% include "addUserForm.tpl" %}
</section>




<link rel="stylesheet" type="text/css" href={{CSSHref}}>