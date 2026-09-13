/**
 * Parsa Restaurant & Bistro - Table Reservation Engine
 */

// ⚙️ WORDPRESS & VERCEL CONFIGURATION
// Automatically detects your Vercel link (e.g. https://your-site.vercel.app) or WordPress backend:
const WORDPRESS_BACKEND_URL = window.letoileSettings?.ajaxUrl || window.location.origin + '/wp-admin/admin-ajax.php';

document.addEventListener('DOMContentLoaded', () => {
    // 1. Seating Ambiance Selector
    const seatingCards = document.querySelectorAll('.seating-card');
    const selectedSeatingInput = document.getElementById('selected_seating');

    seatingCards.forEach(card => {
        card.addEventListener('click', () => {
            seatingCards.forEach(c => c.classList.remove('selected'));
            card.classList.add('selected');
            const area = card.getAttribute('data-area');
            if (selectedSeatingInput) {
                selectedSeatingInput.value = area;
            }
        });
    });

    // 2. Service Time Slot Selector
    const timeSlotBtns = document.querySelectorAll('.time-slot-btn');
    const selectedTimeInput = document.getElementById('selected_time');

    timeSlotBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            timeSlotBtns.forEach(b => b.classList.remove('selected'));
            btn.classList.add('selected');
            const time = btn.getAttribute('data-time');
            if (selectedTimeInput) {
                selectedTimeInput.value = time;
            }
        });
    });

    // 3. Reservation Form Submission
    const reservationForm = document.getElementById('letoile-reservation-form');
    const modal = document.getElementById('reservation-modal');
    const closeModalBtn = document.getElementById('close-modal-btn');

    if (reservationForm) {
        reservationForm.addEventListener('submit', (e) => {
            e.preventDefault();

            const submitBtn = document.getElementById('btn-submit-booking');
            const originalText = submitBtn ? submitBtn.innerText : 'Confirm';
            if (submitBtn) {
                submitBtn.innerText = 'Securing Table...';
                submitBtn.disabled = true;
            }

            const name = document.getElementById('guest_name')?.value || 'Valued Guest';
            const email = document.getElementById('guest_email')?.value || '';
            const phone = document.getElementById('guest_phone')?.value || '';
            const date = document.getElementById('res_date')?.value || '';
            const time = selectedTimeInput?.value || '19:00';
            const guests = document.getElementById('res_guests')?.value || '2';
            const seating = selectedSeatingInput?.value || 'Main Dining Room';
            const notes = document.getElementById('res_notes')?.value || '';

            // Format readable time
            let displayTime = time;
            if (time.includes(':')) {
                const parts = time.split(':');
                const hour = parseInt(parts[0], 10);
                const ampm = hour >= 12 ? 'PM' : 'AM';
                const formattedHour = hour % 12 || 12;
                displayTime = `${formattedHour}:${parts[1]} ${ampm}`;
            }

            const formattedDate = new Date(date + 'T00:00:00').toLocaleDateString('en-US', {
                month: 'short',
                day: 'numeric',
                year: 'numeric'
            });

            // Generate Booking Code
            const bookingCode = 'PARSA-' + Math.random().toString(36).substring(2, 7).toUpperCase();

            // Direct Supabase Database Submission
            const supabaseUrl = window.PARSA_SUPABASE_URL || localStorage.getItem('parsa_supabase_url') || 'https://praocrdvlavznipehkek.supabase.co';
            const supabaseKey = window.PARSA_SUPABASE_KEY || localStorage.getItem('parsa_supabase_key') || 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6InByYW9jcmR2bGF2em5pcGVoa2VrIiwicm9sZSI6ImFub24iLCJpYXQiOjE3ODkyNjE4MDgsImV4cCI6MjEwNDgzNzgwOH0.iSSN3G3m101wgesZpEEw1dMqZVJ1jnCNBoH4etOrGEA';

            if (supabaseUrl && supabaseKey) {
                fetch(supabaseUrl.replace(/\/$/, '') + '/rest/v1/reservations', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'apikey': supabaseKey,
                        'Authorization': 'Bearer ' + supabaseKey,
                        'Prefer': 'return=minimal'
                    },
                    body: JSON.stringify({
                        booking_code: bookingCode,
                        guest_name: name,
                        guest_email: email,
                        guest_phone: phone,
                        res_date: date,
                        res_time: displayTime,
                        res_guests: parseInt(guests),
                        res_seating: seating,
                        res_notes: notes,
                        status: 'Confirmed'
                    })
                }).then(() => console.log('Successfully saved reservation to Supabase database!'))
                .catch(err => console.warn('Supabase database sync note:', err));
            }

            // Save to local storage cache as backup
            try {
                const existing = JSON.parse(localStorage.getItem('parsa_reservations') || '[]');
                existing.unshift({
                    code: bookingCode,
                    name: name,
                    email: email,
                    phone: phone,
                    date: date,
                    time: displayTime,
                    guests: guests,
                    seating: seating,
                    notes: notes,
                    status: 'Confirmed',
                    created_at: new Date().toISOString()
                });
                localStorage.setItem('parsa_reservations', JSON.stringify(existing));
            } catch(e) {}

            // Send Reservation to WordPress Backend API if connected
            const backendEndpoint = window.letoileSettings?.ajaxUrl || WORDPRESS_BACKEND_URL;

            if (window.jQuery && window.letoileSettings) {
                window.jQuery.ajax({
                    url: backendEndpoint,
                    type: 'POST',
                    data: {
                        action: 'letoile_submit_reservation',
                        security: window.letoileSettings.nonce,
                        guest_name: name,
                        guest_email: email,
                        guest_phone: phone,
                        res_date: date,
                        res_time: displayTime,
                        res_guests: guests,
                        res_seating: seating,
                        res_notes: notes
                    },
                    success: function(response) {
                        displayConfirmationModal(response.data?.bookingCode || bookingCode, name, formattedDate + ' at ' + displayTime, guests, seating);
                    },
                    error: function() {
                        displayConfirmationModal(bookingCode, name, formattedDate + ' at ' + displayTime, guests, seating);
                    },
                    complete: function() {
                        if (submitBtn) {
                            submitBtn.innerText = originalText;
                            submitBtn.disabled = false;
                        }
                    }
                });
            } else {
                // Standalone / Vercel Live Preview Simulation
                setTimeout(() => {
                    displayConfirmationModal(bookingCode, name, formattedDate + ' at ' + displayTime, guests, seating);
                    if (submitBtn) {
                        submitBtn.innerText = originalText;
                        submitBtn.disabled = false;
                    }
                }, 400);
            }
        });
    }

    function displayConfirmationModal(code, name, datetime, guests, seating) {
        document.getElementById('conf-code').textContent = code;
        document.getElementById('conf-name').textContent = name;
        document.getElementById('conf-datetime').textContent = datetime;
        document.getElementById('conf-guests').textContent = guests + (parseInt(guests) === 1 ? ' Person' : ' People');
        document.getElementById('conf-seating').textContent = seating;

        if (modal) {
            modal.classList.add('open');
        }
    }

    if (closeModalBtn && modal) {
        closeModalBtn.addEventListener('click', () => {
            modal.classList.remove('open');
            reservationForm.reset();
        });

        modal.addEventListener('click', (e) => {
            if (e.target === modal) {
                modal.classList.remove('open');
            }
        });
    }
});
