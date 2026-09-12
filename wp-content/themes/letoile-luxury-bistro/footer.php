<?php
/**
 * Footer Template for Parsa Restaurant & Bistro
 * 
 * @package ParsaBistro
 */
?>
<footer id="site-footer" class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <!-- Column 1: Brand & About -->
            <div class="footer-about">
                <div class="brand-logo" style="margin-bottom: 1rem;">
                    <div class="brand-crest">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2L15.09 8.26L22 9.27L17 14.14L18.18 21.02L12 17.77L5.82 21.02L7 14.14L2 9.27L8.91 8.26L12 2Z"/></svg>
                    </div>
                    <span class="brand-title" style="font-size: 1.2rem;">Parsa</span>
                </div>
                <p>
                    A warm and welcoming restaurant in Manhattan serving delicious steaks, fresh seafood, handmade pasta, and fine wine.
                </p>
                <div class="awards-row" style="margin-top: 1rem;">
                    <span class="award-item">⭐ Top Rated Food</span>
                    <span class="award-item">🍷 Great Wine Selection</span>
                </div>
            </div>

            <!-- Column 2: Navigation Links -->
            <div>
                <h4 class="footer-heading">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="#about" class="footer-link">About Us</a></li>
                    <li><a href="#menu" class="footer-link">Our Menu</a></li>
                    <li><a href="#specials" class="footer-link">Chef's Specials</a></li>
                    <li><a href="#reservation" class="footer-link">Book a Table</a></li>
                    <li><a href="#gallery" class="footer-link">Photo Gallery</a></li>
                    <li><a href="#reviews" class="footer-link">Customer Reviews</a></li>
                </ul>
            </div>

            <!-- Column 3: Hours of Service -->
            <div>
                <h4 class="footer-heading">Opening Hours</h4>
                <ul class="footer-hours-list">
                    <li class="footer-hours-item">
                        <span>Tuesday – Friday</span>
                        <strong style="color: var(--gold-light);">5:00 PM – 11:30 PM</strong>
                    </li>
                    <li class="footer-hours-item">
                        <span>Saturday & Sunday</span>
                        <strong style="color: var(--gold-light);">4:30 PM – Midnight</strong>
                    </li>
                    <li class="footer-hours-item">
                        <span>Weekend Lunch</span>
                        <strong style="color: var(--gold-light);">12:00 PM – 3:30 PM</strong>
                    </li>
                    <li class="footer-hours-item">
                        <span>Bar & Drinks</span>
                        <strong style="color: var(--gold-light);">Until 1:30 AM</strong>
                    </li>
                    <li class="footer-hours-item">
                        <span>Monday</span>
                        <span style="color: var(--crimson-accent);">Private Events Only</span>
                    </li>
                </ul>
            </div>

            <!-- Column 4: Newsletter & Parking -->
            <div>
                <h4 class="footer-heading">Join Our Newsletter</h4>
                <p style="font-size: 0.88rem; color: var(--text-secondary); margin-bottom: 0.85rem;">
                    Sign up to receive special menu updates, holiday offers, and invitations to wine dinners at Parsa.
                </p>
                <form class="newsletter-form" id="newsletter-form" onsubmit="event.preventDefault(); alert('Thank you for subscribing to Parsa newsletter!');">
                    <input type="email" class="newsletter-input" placeholder="Your email address..." required>
                    <button type="submit" class="btn btn-gold" style="padding: 0.65rem 1rem; font-size: 0.75rem;">Join</button>
                </form>
                <div style="margin-top: 1.25rem; font-size: 0.8rem; color: var(--text-muted);">
                    🚗 Free valet parking available right at our front entrance.
                </div>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div>
                &copy; <?php echo date( 'Y' ); ?> Parsa Restaurant & Bistro. All Rights Reserved.
            </div>
            <div style="display: flex; gap: 1.5rem;">
                <a href="#" class="footer-link">Privacy Policy</a>
                <a href="#" class="footer-link">Dress Code</a>
                <a href="#" class="footer-link">Directions</a>
                <a href="#site-header" class="footer-link" style="color: var(--gold-primary);">Back to Top ↑</a>
            </div>
        </div>
    </div>
</footer>

<!-- Table Reservation Instant Confirmation Modal -->
<div class="modal-backdrop" id="reservation-modal">
    <div class="modal-dialog">
        <div class="modal-icon-success">
            <svg width="34" height="34" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
        </div>
        <h3 class="gold-text" style="font-size: 1.85rem; margin-bottom: 0.5rem;">Reservation Confirmed!</h3>
        <p style="color: var(--text-secondary); font-size: 0.95rem;">
            Thank you! We look forward to welcoming you to Parsa.
        </p>

        <div class="confirmation-card" id="confirmation-details">
            <div class="confirmation-item">
                <span class="conf-label">Reservation Code</span>
                <span class="conf-value" id="conf-code">PARSA-7842</span>
            </div>
            <div class="confirmation-item">
                <span class="conf-label">Your Name</span>
                <span class="conf-value" id="conf-name">John Smith</span>
            </div>
            <div class="confirmation-item">
                <span class="conf-label">Date & Time</span>
                <span class="conf-value" id="conf-datetime">Sep 18, 2026 at 7:00 PM</span>
            </div>
            <div class="confirmation-item">
                <span class="conf-label">Guests</span>
                <span class="conf-value" id="conf-guests">2 People</span>
            </div>
            <div class="confirmation-item">
                <span class="conf-label">Table Area</span>
                <span class="conf-value" id="conf-seating">Main Dining Room</span>
            </div>
        </div>

        <p style="font-size: 0.8rem; color: var(--text-muted); margin-bottom: 1.75rem;">
            We have sent a confirmation email and text message with your booking details.
        </p>

        <div style="display: flex; gap: 1rem; justify-content: center;">
            <button class="btn btn-gold" id="close-modal-btn">Done</button>
            <a href="#menu" class="btn btn-outline-gold" onclick="document.getElementById('reservation-modal').classList.remove('open')">See Menu</a>
        </div>
    </div>
</div>

<?php wp_footer(); ?>
</body>
</html>
