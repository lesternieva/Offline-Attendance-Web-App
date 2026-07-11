function updateClock() {
    const now = new Date();
    const dateNow = new Date();

    const time = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit', 
        hour12: true
    });

    document.getElementById("clock").textContent = time;
    document.getElementById("date").textContent = dateNow.toDateString();
}

updateClock();
setInterval(updateClock, 1000);
