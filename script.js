document.addEventListener('DOMContentLoaded', function() {
    // Highlight active navigation link
    let currentPath = window.location.pathname.split('/').pop() || 'index.html';
    let navLinks = document.querySelectorAll('.nav-link');
    
    for (let i = 0; i < navLinks.length; i++) {
        let link = navLinks[i];
        let linkPath = link.getAttribute('href');
        if (linkPath === currentPath) {
            link.classList.add('active');
        } else {
            link.classList.remove('active');
        }
    }

   // Smooth scrolling for anchor links (if any internal links are used) //
    let anchorLinks = document.querySelectorAll('a[href^="#"]');
    for (let j = 0; j < anchorLinks.length; j++) {
        anchorLinks[j].addEventListener('click', function (e) {
            let targetId = this.getAttribute('href');
            if (targetId === '#') return;
            let target = document.querySelector(targetId);
            if (target) {
                e.preventDefault();
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    }

    // Form Validation (Contact Page)
    let contactForm = document.getElementById('contactForm');
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            // Basic reset
            let inputs = contactForm.querySelectorAll('.form-control, .form-check-input');
            for (let k = 0; k < inputs.length; k++) {
                inputs[k].classList.remove('is-invalid');
            }
            
            let isValid = true;
            
            // Required Check
            for (let m = 0; m < inputs.length; m++) {
                let input = inputs[m];
                if (input.type !== 'checkbox' && input.value.trim() === '' && input.hasAttribute('required')) {
                    input.classList.add('is-invalid');
                    isValid = false;
                }
            }
            
            // Email Custom Validation
            let email = document.getElementById('email');
            let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email && email.value && !emailRegex.test(email.value)) {
                email.classList.add('is-invalid');
                isValid = false;
            }
            
            // Phone Custom Validation
            let phone = document.getElementById('phone');
            let phoneRegex = /^[\d\+\-\s\(\)]+$/;
            if (phone && phone.value && (!phoneRegex.test(phone.value) || phone.value.replace(/\D/g,'').length < 10)) {
                phone.classList.add('is-invalid');
                isValid = false;
            }
            
            // Checkbox
            let terms = document.getElementById('terms');
            if (terms && !terms.checked) {
                terms.classList.add('is-invalid');
                isValid = false;
            }
            
            if (!isValid) {
                e.preventDefault(); // Prevent submission only if validation fails
            } else {
                // Show loading state while submitting
                let submitBtn = contactForm.querySelector('button[type="submit"]');
                submitBtn.innerHTML = 'Sending...';
                submitBtn.disabled = true;
            }
        });
    }

});
