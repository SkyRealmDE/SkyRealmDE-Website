const images = document.querySelectorAll("img");

images.forEach((image) => {
    image.draggable = false;
});

document.addEventListener('DOMContentLoaded', function () {
    updateTimeElementsWithTimeDifference();
});

function updateTimeElementsWithTimeDifference() {
    const timeElements = document.querySelectorAll('time[data-startdate][data-enddate]');
    timeElements.forEach((timeElement) => {
        const startDateString = timeElement.getAttribute('data-startdate');
        const endDateString = timeElement.getAttribute('data-enddate');
        const startDate = new Date(startDateString);
        const endDate = new Date(endDateString);
        const now = new Date();
        let differenceInSeconds, prefix, title, color;

        if (now < startDate) {
            differenceInSeconds = Math.round((startDate - now) / 1000);
            prefix = 'Startet in';
            title = 'BALD:';
            color = ['bg-gray2-100', 'border-gray2-200']
            timeElement.title = formatFullDate(startDate);
        } else {
            differenceInSeconds = Math.round((endDate - now) / 1000);
            prefix = 'Endet in';
            title = 'LIVE:';
            color = ['bg-red-800', 'border-red-400']
            timeElement.title = formatFullDate(endDate);
        }

        document.getElementById('event-title').parentElement.classList.add(color);
        document.getElementById('event-title').innerText = title;

        const timeDifferenceString = getTimeDifferenceString(differenceInSeconds, prefix);
        timeElement.textContent = timeDifferenceString;
    });
}

function formatFullDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit' };
    const formattedDate = date.toLocaleDateString('de-DE', options);
    return formattedDate;
}

function getTimeDifferenceString(differenceInSeconds, prefix) {
    const differenceInMinutes = Math.round(differenceInSeconds / 60);
    const differenceInHours = Math.round(differenceInMinutes / 60);
    const differenceInDays = Math.round(differenceInHours / 24);

    if (differenceInSeconds < 60) {
        return `${prefix} ${differenceInSeconds} Sekunden`;
    } else if (differenceInMinutes < 60) {
        return `${prefix} ${differenceInMinutes} Minuten`;
    } else if (differenceInHours < 24) {
        return `${prefix} ${differenceInHours} Stunden`;
    } else {
        return `${prefix} ${differenceInDays} Tagen`;
    }
}
