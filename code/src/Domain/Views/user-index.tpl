

<section>
    <h3>Список пользователей в хранилище</h3>
    <p>Значение admin: {{ admin ? 'true' : 'false' }}</p>

    <div class="table-responsive small">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="cole">ID</th>
                    <th scope="cole">Имя</th>
                    <th scope="cole">Фамилия</th>
                    <th scope="cole">Дата рождения</th>
                    {% if admin %}
                        <th scope="cole">Действия</th>
                    {% endif %}
                </tr>
            </thead>
            <tbody>
                {% for user in users %}
                    <tr class="table_row" id={{ user.getUserId() }}>
                        <td class="table_userId">{{ user.getUserId() }}</td>
                        <td class="table_username">{{ user.getUserName() }}</td>
                        <td class="table_userlastname">{{ user.getUserLastname() }}</td>
                        <td class="table_userBirthday">
                            {% if user.getUserBirthday() is empty %}
                                <b>Не установлен</b>
                            {% else %}
                                {{ user.getUserBirthday() | date('d.m.Y') }}
                            {% endif %}
                        </td>
                        {% if admin %}
                            <td class="table_userUpdate">
                                <a href="/user/updatingUser/?id={{ user.getUserId() }}">Обновить данные</a>
                                <a href="/user/delete/?id={{ user.getUserId() }}">Удалить пользователя</a>
                            </td>
                        {% endif %}
                    </tr>
                {% endfor %}
            </tbody>
        </table>
    </div>
</section>
<script>
    var admin = {{ admin ? 'true' : 'false' }};
</script>
<script src="/JS/timeRequest.js"></script>
<link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/user-index/user-index.css" }}>