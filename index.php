<?php
   session_start();
   if(!isset($_SESSION["csrf_token"])) {
      $token = md5(uniqid(rand(), true));
      $_SESSION["csrf_token"] = $token;
   } else {
      // Reuse the token
      $token = $_SESSION["csrf_token"];
   }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Move Anything Anywhere - Ingress Logistics</title>
    <link rel="stylesheet" href="style.css">
    <meta name="description"
        content="Professional logistics solutions with unbeatable prices and 5-star service. Get your free quote today!">
    <meta name="keywords"
        content="logistics, moving services, house removals, office relocations, vehicle transport, furniture delivery, international shipping">
    <meta name="author" content="Ingress Logistics">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
</head>

<body>
    <div id="customAlert" class="alert-dialog">
        <div class="alert-content">
            <h2 class="alert-title">Success!</h2>
            <p class="alert-message"></p>
            <button id="closeAlertButton" class="close-button">Close</button>
        </div>
    </div>
    <header>
        <nav class="container">
            <div class="logo">
                <img src="images/logo.png" alt="Ingress Logistics">
            </div>
            <ul class="nav-links">
                <li><a href="#services">Services</a></li>
                <li><a href="#about">About</a></li>
                <!-- <li><a href="#contact">Contact</a></li> -->
                <!-- <li><a href="#tracking">Track Shipment</a></li> -->
            </ul>
            <a href="#quote" class="get-quote-btn">Get Quote</a>
        </nav>
    </header>

    <main>
        <section class="hero">
            <div class="container">
                <h1>Move Anything, Anywhere</h1>
                <p>Professional logistics solutions with unbeatable prices and 5-star service</p>

                <!-- <div class="hero-stats">
                    <div class="stat">
                        <span class="stat-number">2.5M+</span>
                        <div class="stat-text">Happy Customers</div>
                    </div>
                    <div class="stat">
                        <span class="stat-number">40%</span>
                        <div class="stat-text">Cost Savings</div>
                    </div>
                    <div class="stat">
                        <span class="stat-number">5★</span>
                        <div class="stat-text">Average Rating</div>
                    </div>
                </div> -->
            </div>
        </section>

        <section id="quote" class="container">
            <form class="quote-form" id="quoteForm">
                <h2 style="text-align: center; margin-bottom: 2rem; color: #1f2937;">Get Your Free Quote</h2>
                <div class="form-grid">
                    <div class="form-group">
                        <label for="pickup">Pickup Location</label>
                        <input type="text" id="pickup" name="pickup" placeholder="Enter pickup address" required>
                    </div>
                    <div class="form-group">
                        <label for="pickup-floor">Pickup Floor</label>
                        <select id="pickup-floor" name="pickup_floor" required>
                            <option value="">Select pickup floor</option>
                            <option value="1">Ground</option>
                            <option value="2">First</option>
                            <option value="3">Second</option>
                            <option value="4">Third</option>
                            <option value="5">Fourth</option>
                            <option value="6">Above Fourth</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="delivery">Delivery Location</label>
                        <input type="text" id="delivery" name="delivery" placeholder="Enter delivery address" required>
                    </div>
                    <div class="form-group">
                        <label for="delivery-floor">Delivery Floor</label>
                        <select id="delivery-floor" name="delivery_floor" required>
                            <option value="">Select delivery floor</option>
                            <option value="1">Ground</option>
                            <option value="2">First</option>
                            <option value="3">Second</option>
                            <option value="4">Third</option>
                            <option value="5">Fourth</option>
                            <option value="6">Above Fourth</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service">Service Type</label>
                        <select id="service" name="service" required>
                            <option value="">Select service type</option>
                            <option value="top-tier-move">Top Tier Home Removal</option>
                            <option value="house-move">Basic Home Removal</option>
                            <option value="single-item">Single Item Delivery</option>
                            <option value="office-move">Office Removals/Relocation</option>
                            <option value="man-van">Man &amp; Van Service</option>
                            <option value="assembly">Assembling and Disassembling</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="date">Preferred Date</label>
                        <input type="date" id="date" name="date" required>
                    </div>
                    <div class="form-group full-width">
                        <label for="details">Additional Details</label>
                        <textarea id="details" name="details" rows="3"
                            placeholder="Describe what you're moving..."></textarea>
                    </div>
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" id="name" name="name" placeholder="Enter your full name" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="Enter your phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group full-width">
                        <button type="submit" class="quote-btn">Get My Free Quote</button>
                    </div>
                    
            </form>
        </section>

        <section id="about" class="about-section">
            <div class="container">
                <div class="about-content">
                    <div class="about-text">
                        <h2>Our Story</h2>
                        <p>At Ingress Logistics, moving isn't just about boxes and vans — it's about people, trust, and new beginnings. Founded in Kent, our company was born from the simple belief that moving should feel exciting, not stressful.</p>
                        
                        <p>After moving to the UK just a few years ago, our founder saw how overwhelming the moving process could be for families, professionals, and businesses. She wanted to change that — by building a company that combined efficiency, professionalism, and a touch of luxury.</p>
                        
                        <p>That's how Ingress Logistics was created: to give every customer a service that feels personal, premium, and unforgettable.</p>
                        <div class="vision-mission">
                            <div class="mission">
                                <h3>Our Mission</h3>
                                <p>To make moving seamless, stress-free, and special — delivering every service with care, professionalism, and a "red carpet" touch.</p>
                            </div>
                            <div class="vision">
                                <h3>Our Vision</h3>
                                <p>To redefine moving in the UK by being the most trusted, reliable, and customer-focused logistics company — where excellence and empathy go hand in hand.</p>
                            </div>
                        </div>
                    </div>
                    <div class="about-image">
                        <div class="values-grid">
                            <div class="value-item">
                                <div class="value-icon">⭐</div>
                                <h4>Excellence</h4>
                                <p>We aim for the highest standards in every move.</p>
                            </div>
                            <div class="value-item">
                                <div class="value-icon">🤝</div>
                                <h4>Trust</h4>
                                <p>Transparent pricing and honest communication.</p>
                            </div>
                            <div class="value-item">
                                <div class="value-icon">❤️</div>
                                <h4>Care</h4>
                                <p>Your belongings are treated as if they were our own.</p>
                            </div>
                            <div class="value-item">
                                <div class="value-icon">💡</div>
                                <h4>Innovation</h4>
                                <p>Modern solutions for a smoother moving experience.</p>
                            </div>
                            <div class="value-item">
                                <div class="value-icon">👩‍💼</div>
                                <h4>Empowerment</h4>
                                <p>Proudly female-owned, bringing diversity and leadership to the logistics industry.</p>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- <div class="mission-vision">
                    <div class="mission">
                        <h3>Our Mission</h3>
                        <p>To make moving seamless, stress-free, and special — delivering every service with care, professionalism, and a "red carpet" touch.</p>
                    </div>
                    <div class="vision">
                        <h3>Our Vision</h3>
                        <p>To redefine moving in the UK by being the most trusted, reliable, and customer-focused logistics company — where excellence and empathy go hand in hand.</p>
                    </div>
                </div> -->
            </div>
        </section>

        <section id="services" class="services">
            <div class="container">
                <h2>Our Services</h2>
                <div class="services-grid">
                    <div class="service-card">
                        <div class="service-icon">🚚</div>
                        <h3>Top Tier Home Removal</h3>
                        <p>This service includes full packing assistance. Our team will arrive with boxes, bubble wrap, and all necessary materials to carefully pack your belongings. You won’t need to lift a finger—we handle everything from packing and labeling to transporting your items. Once at your new location, we&apos;ll place each box in the correct room for easy unpacking.</p>
                        <p>The service also covers the disassembly and reassembly of furniture and other items.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">🏠</div>
                        <h3>Basic Home Removal</h3>
                        <p>We arrive at your home with a team of movers to assist you with your already packed up items. we&apos;ll load them carefully, transport them to your destination, and deliver everything to a place.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">👨‍🔧</div>
                        <h3>Man &amp; Van Service</h3>
                        <p>This service provides a man and van option, where our driver arrives with the van to help you load your belongings. It is a budget-friendly choice, as you will assist with both loading at the pick-up location and unloading at the destination. This service includes one man and the van.</p>
                    </div>
                    <!-- <div class="service-card">
                        <div class="service-icon">🏺</div>
                        <h3>Antiques & Fragile Items</h3>
                        <p>From family heirlooms to expensive artwork, our specially trained team handles your most precious items with museum-quality care and protection.</p>
                    </div> -->
                    <div class="service-card">
                        <div class="service-icon">📦</div>
                        <h3>Single Item Delivery</h3>
                        <p>Just purchased large furniture or any other bulky item? We can deliver it straight to your door with utmost care.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">🚚</div>
                        <h3>Assembly and Disassembly</h3>
                        <p>This service includes professional assistance with assembling and disassembling your items. We also move them safely to your desired location.</p>
                    </div>
                    <div class="service-card">
                        <div class="service-icon">🏢</div>
                        <h3>Office Removals/Relocation</h3>
                        <p>A professional service that helps businesses move from one office space to another with minimal disruption. It includes packing office equipment, furniture, and documents, safely transporting them, and setting them up at the new location to ensure a smooth transition.</p>
                    </div>
                    
                </div>
            </div>
        </section>

        <section id="why-different" class="why-different">
            <div class="container">
                <h2>Why Choose Ingress Logistics?</h2>
                <div class="why-choose-us-content">
                    <div class="why-choose-us-text">
                        <p>We are more than just movers. We're a team that treats your belongings — and your peace of mind — with the utmost care. From house moves to office relocations, from delicate antiques to bulky furniture, we handle every detail with precision and pride.</p>
                        
                        <p>As a female-owned business, we bring empathy and integrity to an industry that's often rushed and transactional. With us, you'll never feel like just another booking. You'll feel valued, respected, and cared for at every step.</p>
                    </div>
                    <div class="why-choose-us-list">
                        <ul>
                            <li>✅ Red Carpet Experience - Every client treated like a VIP</li>
                            <li>✅ Female-Owned Business - Competence with a personal touch</li>
                            <li>✅ Reliable & Punctual - On time, every time</li>
                            <li>✅ Extra Care - Fragile items treated as if they were our own</li>
                            <li>✅ Transparent Pricing - No surprises, just honesty</li>
                        <ul>
                    </div>
                    
                </div>
            </div>
        </section>
        <section id="faq" class="faq-section">
            <div class="container">
                <h2>Frequently Asked Questions</h2>
                <div class="faq-grid">
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>What areas do you cover?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">We're based in Kent but proudly serve clients across the UK. Whether
                            you're moving locally or long-distance, we've got you covered.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>How do I get a quote?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">It's simple! Just click "Get a Free Quote" on our website, fill in a few
                            details, and we'll provide you with a clear, transparent price — no hidden fees.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>How much notice do you need for a booking?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">We recommend booking as early as possible, especially for weekends and
                            peak times. However, we'll always do our best to accommodate last-minute moves.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>Do you provide packing materials?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">Yes. We offer high-quality packing boxes, bubble wrap, and other
                            materials to protect your belongings. We can also handle all the packing for you if you
                            choose our Packing & Unpacking Service.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>Will my belongings be insured?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">Absolutely. Your items are fully insured while in our care. We treat
                            your belongings as if they were our own, and our insurance gives you extra peace of mind.
                        </div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>Can you handle fragile or valuable items?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">Yes. From antiques to pianos, our team has the training and equipment to
                            safely handle delicate, oversized, or valuable items with extra care.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>Do you dismantle and reassemble furniture?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">Yes, we can. If you need help dismantling furniture before moving — and
                            reassembling it at your new place — just let us know when booking.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>Do you do small moves or single-item deliveries?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">Of course! Whether it's one piece of furniture or a few boxes, no job is
                            too small. Every client still gets our red carpet experience.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>How do you keep pricing transparent?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">We believe in honesty. Our quotes include everything upfront, so you
                            won't face hidden charges on moving day.</div>
                    </div>
                    <div class="faq-item">
                        <div class="faq-question"
                            style="display: flex; align-items: center; cursor: pointer; justify-content: space-between;">
                            <span>What makes Ingress Logistics different?</span>
                            <img src="images/icons/arrow-down.png" class="arrow-icon" alt="arrow down icon">
                        </div>
                        <div class="faq-answer">We're not just movers — we're your moving partners. As a female-owned
                            business, we bring professionalism, empathy, and a personal touch to every job. And with our
                            red carpet promise, every client feels like a VIP.</div>
                    </div>
                </div>

                <div
                    style="text-align: center; margin-top: 3rem; padding: 2rem; background: white; border-radius: 12px; box-shadow: 0 4px 20px rgba(0,0,0,0.08);">
                    <h3 style="color: #dc2626; margin-bottom: 1rem;">Still Have a Question?</h3>
                    <p style="margin-bottom: 1.5rem; color: #4b5563;">If your question isn't listed here, we'd love to
                        hear from you.</p>
                    <div style="display: flex; justify-content: center; gap: 1rem; flex-wrap: wrap;">
                        <a href="tel:+447404039458"
                            style="color: #dc2626; text-decoration: none; font-weight: bold;">📞
                            +44 740 403 9458
                        </a>
                        <a href="mailto:support@ingresslogistics.com"
                            style="color: #dc2626; text-decoration: none; font-weight: bold;">📧
                            support@ingresslogistics.com
                        </a>
                    </div>
                </div>
            </div>
        </section>
        <div class="closing-line">
            <div class="container">
                Not just a moving company. A Red Carpet Experience.
            </div>
        </div>
    </main>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Services</h3>
                    <ul>
                        <li><a href="#services">Home Removals</a></li>
                        <li><a href="#services">Office Relocations</a></li>
                        <li><a href="#services">Man & Van</a></li>
                        <li><a href="#services">Single Item Delivery</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Support</h3>
                    <ul>
                        <li><a href="#quote">Get Quote</a></li>
                        <li><a href="#faq">FAQs</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#about">About Us</a></li>
                        <!-- <li><a href="#">Partner With Us</a></li> -->
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Info</h3>
                    <ul>
                        <li>📞 <a href="tel:+447404039458">+44 740 403 9458</a></li>
                        <li>✉️ <a href="mailto:support@ingresslogistics.com">support@ingresslogistics.com</a></li>
                        <li>📍 Kent, United Kingdom</li>
                        <li>🕒 24/7 Support</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2025 Ingress Logistics Limited. All rights reserved.</p>
            </div>
        </div>
    </footer>
    <script async
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhU13nLy5ZA1PNh00H3G_Hca9X_7da5zQ&loading=async&libraries=places&callback=initMap">
    </script>

    <script>
        const closeAlertButton = document.getElementById('closeAlertButton');
        customAlert.addEventListener('click', (event) => {
            if (event.target === customAlert) {
                closeCustomAlert();
            }
        });
        function showCustomAlert(message) {
            const alertMessage = document.querySelector('.alert-message');
            alertMessage.textContent = message || "Your request has been received! We'll get back to you shortly.";
            customAlert.style.display = 'flex';
        }

        function closeCustomAlert() {
            customAlert.style.display = 'none';
        }

        const closeSubmitButton = document.querySelector('.quote-btn');
        const buttonText = closeSubmitButton.textContent;

        closeAlertButton.addEventListener('click', closeCustomAlert);
        // Quote form submission
        document.getElementById('quoteForm').addEventListener('submit', function (e) {
            e.preventDefault();

            closeSubmitButton.disabled = true;
            closeSubmitButton.textContent = 'Submitting...';

            const formData = new FormData(this);
            const data = Object.fromEntries(formData);

            if (!data.pickup || !data.delivery || !data.service || !data.name || !data.phone || !data.email) {
                alert('Please fill in all required fields.');
                return;
            }

            fetch('https://server.ingresslogistics.com', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            }).then(response => response.text())
            .then(result => {
                showCustomAlert("Thank you, " + data.name + "! Your quote request has been received. We'll contact you soon with a detailed quote.");

                closeSubmitButton.disabled = false;
                closeSubmitButton.textContent = buttonText;
                // Reset form
                this.reset();

                document.querySelector('.hero').scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }).catch(error => {
                console.error('Error:', error);
                showCustomAlert("Sorry, there was an error submitting your request. Please try again later.");
            })
        });

        document.querySelectorAll('.faq-question').forEach(question => {
            question.addEventListener('click', function () {
                const answer = this.nextElementSibling;
                const isOpen = answer.style.display === 'block';

                // Close all other answers
                document.querySelectorAll('.faq-answer').forEach(ans => {
                    ans.style.display = 'none';
                });

                document.querySelectorAll('.faq-question .arrow-icon').forEach(icon => {
                    icon.src = 'images/icons/arrow-down.png';
                });

                // Toggle current answer
                answer.style.display = isOpen ? 'none' : 'block';

                question.querySelector('.arrow-icon').src = isOpen ? 'images/icons/arrow-down.png' : 'images/icons/arrow-up.png';
            });
        });

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Set minimum date to today for the date picker
        document.getElementById('date').min = new Date().toISOString().split('T')[0];

        // Add some interactivity to service cards
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('click', function () {
                const serviceType = this.querySelector('h3').textContent;
                document.getElementById('service').value = serviceType.toLowerCase().replace(/[^a-z0-9]/g, '-');
                document.getElementById('quote').scrollIntoView({ behavior: 'smooth' });
            });
        });

        function initMap() {
            const pickupInput = document.getElementById('pickup');
            const deliveryInput = document.getElementById('delivery');

            // Configure options for the Autocomplete service
            const options = {
                // Restrict searches to the UK for relevance
                componentRestrictions: { country: 'gb' },
                // Limit the type of results to 'addresses'
                fields: ['address_components', 'geometry', 'name'],
                types: ['geocode']
            };

            // Create Autocomplete objects for both inputs
            const pickupAutocomplete = new google.maps.places.Autocomplete(pickupInput, options);
            const deliveryAutocomplete = new google.maps.places.Autocomplete(deliveryInput, options);

            // Optional: Add listeners to log when a place is selected (for debugging or future use)
            pickupAutocomplete.addListener('place_changed', () => {
                const place = pickupAutocomplete.getPlace();
            });

            deliveryAutocomplete.addListener('place_changed', () => {
                const place = deliveryAutocomplete.getPlace();
            });
        }
    </script>
    
</body>

</html>
