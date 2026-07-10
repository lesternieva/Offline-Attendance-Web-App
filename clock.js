function updateClock() {
    const now = new Date();

    const time = now.toLocaleTimeString('en-US', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit', 
        hour12: true
    });

    document.getElementById("clock").textContent = time;
}

updateClock();
setInterval(updateClock, 1000);
