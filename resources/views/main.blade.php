@include('header')
<body>
    <button class="menu-toggle" id="menuToggle">
        <i class="fas fa-bars"></i>
    </button>
    
    @include('sidebar')
    
    <div class="main-content" id="mainContent">
        <div class="header">
            <h1>{{ $title }}</h1>
            <div class="user-info user-dropdown">
                 <div class="user-trigger" id="userTrigger">
             <div class="user-avatar">MA</div>
                <div class="user-text">
            <div style="font-weight: 600; font-size: 13px;">
                {{ Auth::user()->name }}
            </div>
            <div style="font-size: 11px; color: #666;">Admin</div>
        </div>
        <i class="fas fa-chevron-down"></i>
         </div>

    <div class="dropdown-menu" id="userDropdown">
        {{-- <a href="{{ route('profile') }}">
            <i class="fas fa-user"></i> Profil
        </a> --}}
        <a href="#" onclick="logout()">
            <i class="fas fa-sign-out-alt"></i> Logout
        </a>
    </div>
        </div>

        </div>
        @include('sweetalert::alert')

        @yield('main')
        
    </div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
     document.addEventListener('DOMContentLoaded', function() {
    const userTrigger = document.getElementById('userTrigger');
    const userDropdown = document.getElementById('userDropdown');
    const userDropdownParent = document.querySelector('.user-dropdown');

    if (userTrigger && userDropdown) {
        console.log('Dropdown elements found:', { userTrigger, userDropdown });
        
        // Toggle dropdown dengan class
        userTrigger.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            console.log('User trigger clicked');
            
            // Toggle class 'show'
            if (userDropdownParent.classList.contains('show')) {
                userDropdownParent.classList.remove('show');
                userDropdown.style.display = 'none';
            } else {
                userDropdownParent.classList.add('show');
                userDropdown.style.display = 'block';
            }
        });

        // Close dropdown ketika klik di luar
        document.addEventListener('click', function (e) {
            if (!userTrigger.contains(e.target) && !userDropdown.contains(e.target)) {
                userDropdownParent.classList.remove('show');
                userDropdown.style.display = 'none';
            }
        });

        // Close dropdown ketika klik item
        userDropdown.addEventListener('click', function (e) {
            if (e.target.tagName === 'A') {
                userDropdownParent.classList.remove('show');
                this.style.display = 'none';
            }
        });
    } else {
        console.error('Dropdown elements not found!');
    }
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

        // Logout function menggunakan SweetAlert
        function logout() {
            Swal.fire({
                title: 'Yakin ingin logout?',
                text: "Anda akan keluar dari sesi ini.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, logout!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ route('logout') }}";
                }
            });
        }
    </script>
</body>
</html>