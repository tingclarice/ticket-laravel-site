const form = document.querySelector('#registration-form');
const formFields = {
    fullName: document.querySelector('#full-name'),
    email: document.querySelector('#email'),
    ticketType: document.querySelector('#ticket-type'),
    ticketCount: document.querySelector('#ticket-count'),
};
const submitButton = document.querySelector('#submit-button');
const formMessage = document.querySelector('#form-message');
const confirmation = document.querySelector('#confirmation');
const touchedFields = new Set();
const errorIds = {
    fullName: 'full-name-error',
    email: 'email-error',
    ticketType: 'ticket-type-error',
    ticketCount: 'ticket-count-error',
};

function getFieldError(fieldName) {
    const field = formFields[fieldName];
    const value = field.value.trim();

    if (fieldName === 'fullName' && value === '') {
        return 'Please enter your full name.';
    }

    if (fieldName === 'email') {
        if (value === '') {
            return 'Please enter your email address.';
        }

        if (!field.validity.valid) {
            return 'Please enter a valid email address.';
        }
    }

    if (fieldName === 'ticketType' && value === '') {
        return 'Please choose a ticket type.';
    }

    if (fieldName === 'ticketCount') {
        const count = Number(value);

        if (value === '' || !Number.isInteger(count)) {
            return 'Please enter a whole number of tickets.';
        }

        if (count < 1 || count > 6) {
            return 'Choose between 1 and 6 tickets.';
        }
    }

    return '';
}

function validateField(fieldName) {
    const field = formFields[fieldName];
    const error = getFieldError(fieldName);
    const errorElement = document.querySelector(`#${errorIds[fieldName]}`);

    field.setAttribute('aria-invalid', error ? 'true' : 'false');
    errorElement.textContent = error;

    return error === '';
}

function showFormMessage(message) {
    formMessage.textContent = message;
    formMessage.hidden = false;
}

for (const [fieldName, field] of Object.entries(formFields)) {
    field.addEventListener('blur', () => {
        touchedFields.add(fieldName);
        validateField(fieldName);
    });

    field.addEventListener('input', () => {
        if (touchedFields.has(fieldName)) {
            validateField(fieldName);
        }
    });

    field.addEventListener('change', () => {
        if (touchedFields.has(fieldName)) {
            validateField(fieldName);
        }
    });
}

document.querySelectorAll('[data-quantity-step]').forEach((button) => {
    button.addEventListener('click', () => {
        const field = formFields.ticketCount;
        const step = Number(button.dataset.quantityStep);
        const currentCount = Number.parseInt(field.value, 10);
        const baseCount = Number.isNaN(currentCount) ? 1 : currentCount;

        field.value = String(Math.max(1, Math.min(6, baseCount + step)));

        if (touchedFields.has('ticketCount')) {
            validateField('ticketCount');
        }
    });
});

form.addEventListener('submit', async (event) => {
    event.preventDefault();
    formMessage.hidden = true;

    const isValid = Object.keys(formFields).map(validateField).every(Boolean);

    if (!isValid) {
        const firstInvalidField = Object.values(formFields).find((field) => field.getAttribute('aria-invalid') === 'true');
        firstInvalidField?.focus();
        return;
    }

    submitButton.disabled = true;
    submitButton.querySelector('span').textContent = 'Saving your place…';

    await new Promise((resolve) => window.requestAnimationFrame(resolve));

    try {
        const savedEntries = JSON.parse(localStorage.getItem('laufeyInterestRegistrations') || '[]');

        if (!Array.isArray(savedEntries)) {
            throw new Error('Saved registrations are not in the expected format.');
        }

        const registration = {
            fullName: formFields.fullName.value.trim(),
            email: formFields.email.value.trim(),
            ticketType: formFields.ticketType.value,
            ticketCount: Number(formFields.ticketCount.value),
            submittedAt: new Date().toISOString(),
        };

        // BACKEND: Replace this localStorage save with a POST request to your registration endpoint.
        localStorage.setItem('laufeyInterestRegistrations', JSON.stringify([...savedEntries, registration]));

        document.querySelector('#confirmation-name').textContent = registration.fullName;
        document.querySelector('#confirmation-ticket').textContent = registration.ticketType;
        document.querySelector('#confirmation-count').textContent = `${registration.ticketCount} ${registration.ticketCount === 1 ? 'ticket' : 'tickets'}`;

        form.hidden = true;
        confirmation.hidden = false;
        confirmation.focus();
    } catch (error) {
        showFormMessage('We couldn’t save your interest in this browser. Check your browser storage settings and try again.');
        submitButton.disabled = false;
        submitButton.querySelector('span').textContent = 'Count me in';
        console.error('Unable to save the fan registration locally.', error);
    }
});
