function saveMy() {
    console.log('Запущена функция с фетч');
    fetch('https://mysite.local/user/savemy/', {
        method: "POST"
    })
    .then((response) => {
        if (response.ok) {
            console.log("Успешное сохранение сессии");
        } else {
            console.error("Ошибка сохранения сессии");
        }
    })
    .catch((error) => {
        console.error("Сетевая ошибка:", error);
    });
}

document.querySelector(".saveMy").addEventListener('change', saveMy);