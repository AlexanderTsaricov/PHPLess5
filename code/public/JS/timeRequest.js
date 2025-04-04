let maxId = $('.table-responsive table tbody tr:last-child td:first-child').html() || 0;
let isAdmin = admin === "true";
setInterval(function() {
    $.ajax({
        method: "POST",
        url: '/user/indexRefresh/',
        data: {maxId: maxId}
    }).done(function(response) {
        console.log(response);
        updateUsersTable(response);
    });
}, 10000);


function updateUsersTable(response) {
    let table = getTable();
    const users = $.parseJSON(response);
    // Check update and missing items in the table
    users.forEach(user => {
        if (!table.hasOwnProperty(user.id)) {
            console.log(typeof(user.id));
            let row = `<tr class="table_row" id="${user.id}">`;

            row += `<td class="table_userId">${user.id}</td>`;
            maxId = user.id;
            row += `<td class="table_username">${user.username}</td>`;
            row += `<td class="table_userlastname">${user.userlastname}</td>`;
            row += `<td class="table_userBirthday">${user.userbirthday}</td>`;

            if (isAdmin) {
                row += `<td class="table_userUpdate">
                    <a href="/user/updatingUser/?id=${user.id}">Обновить данные</a>
                    <a href="/user/delete/?id=${user.id}">Удалить пользователя</a>
                </td>`;
            }

            row += "</tr>";

            $('.content-template tbody').append(row);
        } else {
            if (table[user.id].username.textContent != user.username) {
                table[user.id].username.textContent = user.username;
            }
            if (table[user.id].userlastname.textContent != user.userlastname) {
                table[user.id].userlastname.textContent = user.userlastname;
            }
            if (table[user.id].userbirthday.textContent != user.userbirthday) {
                if (user.userbirthday == null) {
                    table[user.id].userbirthday.innerHTML = "<b>Не установлен</b>";
                } else {
                    table[user.id].userbirthday.textContent = user.userbirthday;
                }                
            }
        }
    });
    // Check deleted users
    table = getTable();
    const usersId = [];
    users.forEach(user => {
        usersId.push(user.id);
    });
    Object.keys(table).forEach(key => {
        if (!usersId.includes(parseInt(key))) {
            document.querySelector(`#${key}`).remove();
        }
    });
}

function getTable() {
    const result = {};
    const rows = document.querySelectorAll(".table_row");
    rows.forEach(row => {
        result[parseInt(row.id)] = {
            username: row.querySelector(".table_username"),
            userlastname: row.querySelector(".table_userlastname"),
            userbirthday: row.querySelector(".table_userBirthday")
        };
    });

    return result;
}