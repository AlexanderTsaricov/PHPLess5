<form action="/user/save/" class="addUserForm">
    <label class="addUserForm_label">Имя нового пользователя</label>
    <input type="text"/ name="name" class="addUserForm_input">
    <label class="addUserForm_label">Фамилия нового пользователя</label>
    <input type="text"/ name="lastname" class="addUserForm_input">
    <label class="addUserForm_label">День рождения нового пользователя</label>
    <input type="date"/ name="birthday" class="addUserForm_input">
    <input type="submit" value="Сохранить" class="addUserForm_submit">
</form>

<link rel="stylesheet" type="text/css" href={{ CSSHref ~ "/addUserForm/addUserForm.css" }}>