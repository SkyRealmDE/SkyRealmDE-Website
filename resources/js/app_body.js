const images = document.querySelectorAll("img");

images.forEach((image) => {
    image.draggable = false;
});

document.addEventListener('DOMContentLoaded', () => {
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
        let differenceInSeconds = 0,
            prefix = "",
            title = "",
            colors = [];

        if (now < startDate) {
            differenceInSeconds = Math.round((startDate - now) / 1000);
            prefix = 'Startet in';
            title = 'BALD:';
            colors = ['bg-gray2-100', 'border-gray2-200'];
            timeElement.title = formatFullDate(startDate);
        } else {
            differenceInSeconds = Math.round((endDate - now) / 1000);
            prefix = 'Endet in';
            title = 'LIVE:';
            colors = ['bg-red-800', 'border-red-400'];
            timeElement.title = formatFullDate(endDate);
        }

        for(const color of colors) {
            document.getElementById('event-title').parentElement.classList.add(color);
        }

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
        return `${prefix} ${differenceInSeconds} Sekunde${differenceInSeconds > 1 ? 'n' : ''}`;
    } else if (differenceInMinutes < 60) {
        return `${prefix} ${differenceInMinutes} Minute${differenceInMinutes > 1 ? 'n' : ''}`;
    } else if (differenceInHours < 24) {
        return `${prefix} ${differenceInHours} Stunde${differenceInHours > 1 ? 'n' : ''}`;
    } else {
        return `${prefix} ${differenceInDays} Tag${differenceInDays > 1 ? 'en' : ''}`;
    }
}
