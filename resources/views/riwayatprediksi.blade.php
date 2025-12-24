@extends('main')
@section('main')        <!-- Statistics Section -->
        <section class="stats-section">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="card-title">Ringkasan Prediksi</div>
            </div>
            
            <div class="card-content">
                <div class="stats-controls">
                    <button class="filter-btn">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                    <button class="export-btn">
                        <i class="fas fa-download"></i> Export Data
                    </button>
                </div>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-chart-line"></i></div>
                        <div class="stat-number">5</div>
                        <div class="stat-label">Total Prediksi</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-seedling"></i></div>
                        <div class="stat-number">3</div>
                        <div class="stat-label">Prediksi Panen</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-box"></i></div>
                        <div class="stat-number">2</div>
                        <div class="stat-label">Prediksi Benih</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><i class="fas fa-bullseye"></i></div>
                        <div class="stat-number">89%</div>
                        <div class="stat-label">Rata-rata Akurasi</div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Filter Tabs -->
        <div class="filter-tabs">
            <button class="filter-tab active" data-filter="all">Semua Prediksi (5)</button>
            <button class="filter-tab" data-filter="harvest">Hasil Panen (3)</button>
            <button class="filter-tab" data-filter="seed">Stok Benih (2)</button>
        </div>

        <!-- Search -->
        <div class="search-container">
            <input type="text" class="search-input" placeholder="Cari riwayat prediksi..." id="searchInput">
        </div>

        <!-- Data Table -->
        <section class="data-table">
            <div class="table-header">
                <div>Tanggal</div>
                <div>Tipe Prediksi</div>
                <div>Varietas & Lokasi</div>
                <div>Hasil Prediksi</div>
                <div>Status</div>
                <div>Aksi</div>
            </div>

            <div class="table-body" id="tableBody">
                <div class="table-row" data-type="harvest">
                    <div class="cell-date">20/06/2025</div>
                    <div class="cell-type">Hasil Panen</div>
                    <div class="cell-details">
                        <div class="cell-location"><strong>Saga 1</strong></div>
                        <div class="cell-location">Blitar, Jawa Timur</div>
                        <div class="cell-location">Luas: 2.5 Ha</div>
                    </div>
                    <div class="cell-result">12.5 Ton</div>
                    <div class="cell-status">Selesai</div>
                    <div class="cell-actions">
                        <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="table-row" data-type="harvest">
                    <div class="cell-date">18/06/2025</div>
                    <div class="cell-type">Hasil Panen</div>
                    <div class="cell-details">
                        <div class="cell-location"><strong>Saga 2</strong></div>
                        <div class="cell-location">Malang, Jawa Timur</div>
                        <div class="cell-location">Luas: 3.2 Ha</div>
                    </div>
                    <div class="cell-result">15.8 Ton</div>
                    <div class="cell-status">Selesai</div>
                    <div class="cell-actions">
                        <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="table-row" data-type="harvest">
                    <div class="cell-date">15/06/2025</div>
                    <div class="cell-type">Hasil Panen</div>
                    <div class="cell-details">
                        <div class="cell-location"><strong>Saga 3</strong></div>
                        <div class="cell-location">Kediri, Jawa Timur</div>
                        <div class="cell-location">Luas: 1.8 Ha</div>
                    </div>
                    <div class="cell-result">9.2 Ton</div>
                    <div class="cell-status">Selesai</div>
                    <div class="cell-actions">
                        <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="table-row" data-type="seed">
                    <div class="cell-date">12/06/2025</div>
                    <div class="cell-type">Stok Benih</div>
                    <div class="cell-details">
                        <div class="cell-location"><strong>Saga 1</strong></div>
                        <div class="cell-location">Blitar, Jawa Timur</div>
                        <div class="cell-location">Kebutuhan: 5.2 Ha</div>
                    </div>
                    <div class="cell-result">46.49 Kg</div>
                    <div class="cell-status">Selesai</div>
                    <div class="cell-actions">
                        <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </div>

                <div class="table-row" data-type="seed">
                    <div class="cell-date">10/06/2025</div>
                    <div class="cell-type">Stok Benih</div>
                    <div class="cell-details">
                        <div class="cell-location"><strong>Saga 2</strong></div>
                        <div class="cell-location">Malang, Jawa Timur</div>
                        <div class="cell-location">Kebutuhan: 3.8 Ha</div>
                    </div>
                    <div class="cell-result">33.92 Kg</div>
                    <div class="cell-status">Selesai</div>
                    <div class="cell-actions">
                        <button class="action-btn edit-btn" title="Edit"><i class="fas fa-edit"></i></button>
                        <button class="action-btn delete-btn" title="Hapus"><i class="fas fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pagination -->
        <div class="pagination">
            <button class="page-nav" disabled><i class="fas fa-chevron-left"></i> Sebelumnya</button>
            <button class="page-btn active">1</button>
            <button class="page-btn">2</button>
            <button class="page-btn">3</button>
            <button class="page-nav">Selanjutnya <i class="fas fa-chevron-right"></i></button>
        </div>
    

    <script>
        // Toggle sidebar on mobile
        document.getElementById('menuToggle').addEventListener('click', function() {
            document.getElementById('sidebar').classList.toggle('active');
        });

        // Filter functionality
        document.querySelectorAll('.filter-tab').forEach(tab => {
            tab.addEventListener('click', function() {
                // Remove active class from all tabs
                document.querySelectorAll('.filter-tab').forEach(t => t.classList.remove('active'));
                
                // Add active class to clicked tab
                this.classList.add('active');
                
                // Filter table rows
                const filter = this.dataset.filter;
                const rows = document.querySelectorAll('.table-row');
                
                rows.forEach(row => {
                    if (filter === 'all') {
                        row.style.display = 'grid';
                    } else if (filter === 'harvest' && row.dataset.type === 'harvest') {
                        row.style.display = 'grid';
                    } else if (filter === 'seed' && row.dataset.type === 'seed') {
                        row.style.display = 'grid';
                    } else {
                        row.style.display = 'none';
                    }
                });
            });
        });

        // Search functionality
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('.table-row');
            
            rows.forEach(row => {
                const text = row.textContent.toLowerCase();
                if (text.includes(searchTerm)) {
                    row.style.display = 'grid';
                } else {
                    row.style.display = 'none';
                }
            });
        });

        // Action buttons
        document.querySelectorAll('.edit-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                alert('Fitur edit prediksi akan segera tersedia');
            });
        });

        document.querySelectorAll('.delete-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus prediksi ini?')) {
                    const row = this.closest('.table-row');
                    row.style.opacity = '0';
                    row.style.transform = 'translateX(-100%)';
                    setTimeout(() => {
                        row.remove();
                        updateStats();
                    }, 300);
                }
            });
        });

        // Filter and Export buttons
        document.querySelector('.filter-btn').addEventListener('click', function() {
            alert('Dialog filter akan ditampilkan di sini');
        });

        document.querySelector('.export-btn').addEventListener('click', function() {
            alert('Fitur ekspor data akan segera tersedia');
        });

        // Pagination
        document.querySelectorAll('.page-btn').forEach(btn => {
            btn.addEventListener('click', function() {
                // Remove active class from all page buttons
                document.querySelectorAll('.page-btn').forEach(b => b.classList.remove('active'));
                
                // Add active class to clicked button
                this.classList.add('active');
            });
        });

        document.querySelector('.page-nav:last-child').addEventListener('click', function() {
            const activeBtn = document.querySelector('.page-btn.active');
            const nextBtn = activeBtn.nextElementSibling;
            
            if (nextBtn && nextBtn.classList.contains('page-btn')) {
                activeBtn.classList.remove('active');
                nextBtn.classList.add('active');
            }
        });

        document.querySelector('.page-nav:first-child').addEventListener('click', function() {
            const activeBtn = document.querySelector('.page-btn.active');
            const prevBtn = activeBtn.previousElementSibling;
            
            if (prevBtn && prevBtn.classList.contains('page-btn')) {
                activeBtn.classList.remove('active');
                prevBtn.classList.add('active');
            }
        });

        // User avatar click effect
        document.getElementById('userAvatar').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-user"></i>';
            setTimeout(() => {
                this.innerHTML = 'MA';
            }, 1000);
        });

        // Update stats when rows are deleted
        function updateStats() {
            const totalRows = document.querySelectorAll('.table-row').length;
            const harvestRows = document.querySelectorAll('.table-row[data-type="harvest"]').length;
            const seedRows = document.querySelectorAll('.table-row[data-type="seed"]').length;
            
            document.querySelector('.stat-number:nth-child(1)').textContent = totalRows;
            document.querySelector('.stat-number:nth-child(2)').textContent = harvestRows;
            document.querySelector('.stat-number:nth-child(3)').textContent = seedRows;
            
            // Update filter tabs
            document.querySelector('.filter-tab[data-filter="all"]').textContent = `Semua Prediksi (${totalRows})`;
            document.querySelector('.filter-tab[data-filter="harvest"]').textContent = `Hasil Panen (${harvestRows})`;
            document.querySelector('.filter-tab[data-filter="seed"]').textContent = `Stok Benih (${seedRows})`;
        }

        // Animate stats on page load
        window.addEventListener('load', function() {
            document.querySelectorAll('.stat-number').forEach(stat => {
                const finalValue = stat.textContent.includes('%') ? 
                    parseInt(stat.textContent) : 
                    parseInt(stat.textContent);
                    
                let currentValue = 0;
                const increment = finalValue / 20;
                
                const animation = setInterval(() => {
                    currentValue += increment;
                    if (currentValue >= finalValue) {
                        stat.textContent = stat.textContent.includes('%') ? 
                            `${finalValue}%` : 
                            finalValue;
                        clearInterval(animation);
                    } else {
                        stat.textContent = stat.textContent.includes('%') ? 
                            `${Math.floor(currentValue)}%` : 
                            Math.floor(currentValue);
                    }
                }, 50);
            });
        });

        // Add hover animations to stat cards
        document.querySelectorAll('.stat-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px)';
            });
            
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
@endsection