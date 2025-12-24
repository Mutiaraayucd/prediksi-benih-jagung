
        let isPasswordVisible = false;

        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const toggleButton = document.querySelector('.password-toggle i');
            
            if (isPasswordVisible) {
                passwordInput.type = 'password';
                toggleButton.className = 'fas fa-eye';
            } else {
                passwordInput.type = 'text';
                toggleButton.className = 'fas fa-eye-slash';
            }
            
            isPasswordVisible = !isPasswordVisible;
        }

        // Password strength indicator
        document.getElementById('password').addEventListener('input', function(e) {
            // const password = e.target.value;
            // const strengthBars = document.querySelectorAll('.strength-bar');
            
            // // Reset all bars
            // strengthBars.forEach(bar => {
            //     bar.classList.remove('active', 'strong');
            // });
            
            // let strength = 0;
            
            // // Check password criteria
            // if (password.length >= 8) strength++;
            // if (/[a-z]/.test(password)) strength++;
            // if (/[A-Z]/.test(password)) strength++;
            // if (/[0-9]/.test(password)) strength++;
            // if (/[^A-Za-z0-9]/.test(password)) strength++;
            
            // // Activate bars based on strength
            // for (let i = 0; i < Math.min(strength, 4); i++) {
            //     if (strength >= 4) {
            //         strengthBars[i].classList.add('strong');
            //     } else {
            //         strengthBars[i].classList.add('active');
            //     }
            // }
        });

        // Form submission
       document.getElementById('loginForm').addEventListener('submit', function() {
    const button = document.querySelector('.login-button');
    const originalText = button.innerHTML;
    button.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Logging in...';
    button.disabled = true;
});


        // Add floating animation to feature cards
        const cards = document.querySelectorAll('.feature-card');
        cards.forEach((card, index) => {
            card.style.animationDelay = `${index * 0.2}s`;
        });
   