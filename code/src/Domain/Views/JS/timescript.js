function updateTime() {
    let currentTime = new Date();
    let hours = currentTime.getHours().toString().padStart(2, "0");
    let minutes = currentTime.getMinutes().toString().padStart(2, "0");
    let seconds = currentTime.getSeconds().toString().padStart(2, "0");
    document.querySelector(".time").textContent = `${hours}:${minutes}:${seconds}`;
}

setInterval(updateTime, 1000);
