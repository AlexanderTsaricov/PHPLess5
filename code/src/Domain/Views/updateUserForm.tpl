<form action="/user/update/" method="post">
    <input id="csrf_token" type="hidden" name="csrf_token" value="{{ csrf_token }}">
    <h2>Обновление данных пользователя</h2>

    <p>ID пользователя: {{ userId }}<p>
    <input id="id_user" type="hidden" name="id_user" value="{{ userId }}">

    <label for="name">Имя: </label>
    <input id="name" type="text" name="name" value={{ user_firstname }} />

    <label for="lastname">Фамилия: </label>
    <input id="lastname" type="text" name="lastname" value={{ user_lastname }} />

    <label for="birthday">День рождения: </label>
    <input id="birthday" type="text" name="birthday" value={{ user_birthday }} />

    <input type="submit" value="Обновить"/>
<form/>