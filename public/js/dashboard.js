
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Button click effects
        document.getElementById('startHarvestPrediction').addEventListener('click', function() {
            alert('Fitur Prediksi Panen akan segera dibuka!');
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Memproses...';
            setTimeout(() => {
                this.innerHTML = 'Mulai Prediksi Panen';
            }, 2000);
        });

        document.getElementById('calculateStock').addEventListener('click', function() {
            alert('Menghitung stok benih...');
            this.innerHTML = '<i class="fas fa-calculator"></i> Menghitung...';
            setTimeout(() => {
                this.innerHTML = 'Hitung Stok Benih';
            }, 1500);
        });

        document.getElementById('viewHistory').addEventListener('click', function() {
            alert('Membuka riwayat prediksi...');
            this.innerHTML = '<i class="fas fa-history"></i> Membuka...';
            setTimeout(() => {
                this.innerHTML = 'Lihat Riwayat';
            }, 1500);
        });

        // Stat cards click effects
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = '';
                }, 200);
            });
        });

        // User avatar click effect
        document.getElementById('userAvatar').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-user"></i>';
            setTimeout(() => {
                this.innerHTML = 'MA';
            }, 1000);
        });

        // Animate progress bars on page load
        window.addEventListener('load', function() {
            const progressFill = document.querySelector('.progress-fill');
            progressFill.style.width = '0';
            setTimeout(() => {
                progressFill.style.width = '87%';
            }, 500);
        });

        // Add hover effect to info rows
        document.querySelectorAll('.info-row').forEach(row => {
            row.addEventListener('mouseenter', function() {
                this.style.transform = 'translateX(5px)';
            });
            
            row.addEventListener('mouseleave', function() {
                this.style.transform = 'translateX(0)';
            });
        });
