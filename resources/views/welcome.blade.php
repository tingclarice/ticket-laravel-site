@php
    $concertDate = 'Date to be announced';
    $concertCity = 'City to be announced';
    $concertVenue = 'Venue to be announced';
@endphp
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#f7f1e8">
        <meta name="description" content="Register your interest in a fan-made Laufey concert gathering.">
        <title>Laufey Live — Fan registration</title>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Playfair+Display:wght@400;500;600;700&display=swap" rel="stylesheet">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body>
        <main class="page-shell">
            <section class="hero" aria-labelledby="page-title">
                <span class="hero-note hero-note-one" aria-hidden="true">♪</span>
                <span class="hero-note hero-note-two" aria-hidden="true">♫</span>

                <p class="eyebrow"><span class="eyebrow-line"></span>A night for the romantics<span class="eyebrow-line"></span></p>
                <h1 id="page-title">Laufey <em>Live</em></h1>
                <p class="hero-tagline">An evening of timeless melodies, tender stories, and a little bit of magic.</p>

                <div class="concert-details" aria-label="Concert details">
                    <div class="detail-item">
                        <span class="detail-label">When</span>
                        <span class="detail-value">{{ $concertDate }}</span>
                    </div>
                    <span class="detail-divider" aria-hidden="true"></span>
                    <div class="detail-item">
                        <span class="detail-label">Where</span>
                        <span class="detail-value">{{ $concertCity }}</span>
                    </div>
                    <span class="detail-divider" aria-hidden="true"></span>
                    <div class="detail-item">
                        <span class="detail-label">Venue</span>
                        <span class="detail-value">{{ $concertVenue }}</span>
                    </div>
                </div>
            </section>

            <section class="registration-card" aria-labelledby="form-title">
                <div class="card-flourish" aria-hidden="true">
                    <svg viewBox="0 0 42 14" fill="none">
                        <path d="M1 7h12m16 0h12M16 7a5 5 0 1 1 10 0 5 5 0 0 1-10 0Z" stroke="currentColor" stroke-width="1.2"/>
                        <path d="M21 1v12" stroke="currentColor" stroke-width="1.2"/>
                    </svg>
                </div>
                <p class="card-kicker">Save your place in the daydream</p>
                <h2 id="form-title">Register your interest</h2>
                <p class="card-intro">Leave your details and let us know what kind of evening you’re dreaming of.</p>

                <form id="registration-form" novalidate>
                    <div class="form-field">
                        <label for="full-name">Full name <span aria-hidden="true">*</span></label>
                        <input id="full-name" name="fullName" type="text" autocomplete="name" placeholder="How should we address you?" required aria-describedby="full-name-error">
                        <p class="field-error" id="full-name-error" aria-live="polite"></p>
                    </div>

                    <div class="form-field">
                        <label for="email">Email address <span aria-hidden="true">*</span></label>
                        <input id="email" name="email" type="email" autocomplete="email" placeholder="you@example.com" required aria-describedby="email-error">
                        <p class="field-error" id="email-error" aria-live="polite"></p>
                    </div>

                    <div class="form-row">
                        <div class="form-field">
                            <label for="ticket-type">Ticket type <span aria-hidden="true">*</span></label>
                            <select id="ticket-type" name="ticketType" required aria-describedby="ticket-type-error">
                                <option value="">Choose a ticket</option>
                                <option value="Regular">Regular</option>
                                <option value="VIP">VIP</option>
                                <option value="Meet &amp; Greet">Meet &amp; Greet</option>
                            </select>
                            <p class="field-error" id="ticket-type-error" aria-live="polite"></p>
                        </div>

                        <div class="form-field">
                            <label for="ticket-count">Number of tickets <span aria-hidden="true">*</span></label>
                            <div class="quantity-control">
                                <button class="quantity-button" type="button" data-quantity-step="-1" aria-label="Remove one ticket">−</button>
                                <input id="ticket-count" name="ticketCount" type="number" min="1" max="6" step="1" value="1" required aria-describedby="ticket-count-error">
                                <button class="quantity-button" type="button" data-quantity-step="1" aria-label="Add one ticket">+</button>
                            </div>
                            <p class="field-error" id="ticket-count-error" aria-live="polite"></p>
                        </div>
                    </div>

                    <p class="privacy-note">This is an interest form only. No payment details are collected, and your entry stays in this browser.</p>
                    <p class="form-message" id="form-message" role="alert" hidden></p>
                    <button class="submit-button" id="submit-button" type="submit">
                        <span>Count me in</span>
                        <svg viewBox="0 0 20 20" fill="none" aria-hidden="true">
                            <path d="M3.5 10h12m0 0-5-5m5 5-5 5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>
                </form>

                <div class="confirmation" id="confirmation" role="status" tabindex="-1" hidden>
                    <div class="confirmation-mark" aria-hidden="true">♪</div>
                    <p class="card-kicker">You’re on the list</p>
                    <h2>How lovely, <span id="confirmation-name"></span>.</h2>
                    <p class="confirmation-copy">We’ve saved your interest for <strong id="confirmation-ticket"></strong> — <strong id="confirmation-count"></strong>. Keep this browser handy; this is a fan-made registration, not a ticket or booking.</p>
                </div>
            </section>

            <footer class="page-footer">
                <span aria-hidden="true">✦</span>
                <p>This is a fan-made registration page, not an official ticketing site.</p>
                <span aria-hidden="true">✦</span>
            </footer>
        </main>
    </body>
</html>
