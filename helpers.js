function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, options);
}

function validateItineraryData(data) {
    const { destination, activities } = data;
    if (!destination || destination.trim() === '') {
        return 'Destination is required.';
    }
    if (!Array.isArray(activities) || activities.length === 0) {
        return 'At least one activity is required.';
    }
    return null;
}

function generateItineraryCard(itinerary) {
    return `
        <div class="itinerary-card">
            <h3>${itinerary.destination}</h3>
            <p>Date: ${formatDate(itinerary.date)}</p>
            <ul>
                ${itinerary.activities.map(activity => `<li>${activity}</li>`).join('')}
            </ul>
        </div>
    `;
}function formatDate(date) {
    const options = { year: 'numeric', month: 'long', day: 'numeric' };
    return new Date(date).toLocaleDateString(undefined, options);
}

function validateItineraryData(data) {
    const { destination, activities } = data;
    if (!destination || destination.trim() === '') {
        return 'Destination is required.';
    }
    if (!Array.isArray(activities) || activities.length === 0) {
        return 'At least one activity is required.';
    }
    return null;
}

function generateItineraryCard(itinerary) {
    return `
        <div class="itinerary-card">
            <h3>${itinerary.destination}</h3>
            <p>Date: ${formatDate(itinerary.date)}</p>
            <ul>
                ${itinerary.activities.map(activity => `<li>${activity}</li>`).join('')}
            </ul>
        </div>
    `;
}