let maxId = $('.table-responsive table tbody tr:last-child td:first-child').html() || 0;
let isAdmin = admin === "true";
setInterval(function() {
    $.ajax({
        method: "POST",
        url: '/user/indexRefresh/',
        data: {maxId: maxId}
    }).done(function(response) {
        // data - json response
        // k => [username, userlastname, userbirthday]
        /*
            TODO: Переделать скрипт, чтобы обновлялось удаление и обновление пользователей
        */

        let users = $.parseJSON(response);

        if (users.length != 0) {
            for (var k in users) {
                let row = "<tr>";

                row += "<td>" + users[k].id + "</td>";
                maxId = users[k].id;
                row += "<td>" + users[k].username + "</td>";
                row += "<td>" + users[k].userlastname + "</td>";
                row += "<td>" + users[k].userbirthday + "</td>";
                if (isAdmin) {
                    row += "<td>" + `
                    <a href="/user/updatingUser/?id=${users[k].id}">Обновить данные</a>
                    <a href="/user/delete/?id=${users[k].id}">Удалить пользователя</a>
                    ` + "</td>";
                }
                

                row += "</tr>";

                $('.content-template tbody').append(row);
            }
        }
    });
}, 10000);