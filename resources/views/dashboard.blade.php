
    
   
    
    @extends('main')
    @section('main')
        
        <!-- Stats Cards Top Row -->
        <div class="stats-grid">
            <div class="stat-card" id="totalPredictions">
                <div class="stat-icon"><i class="fas fa-chart-bar"></i></div>
                <div class="stat-title">Total Prediksi</div>
                <div class="stat-lines">
                    <div class="stat-value">125</div>
                    <div class="stat-subtitle">Prediksi bulan ini</div>
                </div>
            </div>
            
            <div class="stat-card" id="lastPrediction">
                <div class="stat-icon"><i class="fas fa-bullseye"></i></div>
                <div class="stat-title">Prediksi Terakhir</div>
                <div class="stat-lines">
                    <div class="stat-value">32.5</div>
                    <div class="stat-subtitle">Ton hasil panen</div>
                </div>
            </div>
            
            <div class="stat-card" id="lowStock">
                <div class="stat-icon"><i class="fas fa-exclamation-triangle"></i></div>
                <div class="stat-title">Stok rendah</div>
                <div class="stat-lines">
                    <div class="stat-value">8</div>
                    <div class="stat-subtitle">Varietas benih</div>
                </div>
            </div>
            
            <div class="stat-card" id="harvestSchedule">
                <div class="stat-icon"><i class="fas fa-calendar-alt"></i></div>
                <div class="stat-title">Jadwal Panen</div>
                <div class="stat-lines">
                    <div class="stat-value">15</div>
                    <div class="stat-subtitle">Hari lagi</div>
                </div>
            </div>
        </div>
        
        <!-- Main Dashboard Cards -->
        <div class="main-grid">
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-header-icon"><i class="fas fa-chart-line"></i></div>
                    <div class="card-title">Prediksi 1<br>Estimasi Hasil Panen</div>
                </div>
                <div class="card-content">
                    <div class="prediction-info">
                        <div class="info-row">
                            <span class="info-label">Luas Lahan:</span>
                            <span class="info-value">25 Ha</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Varietas:</span>
                            <span class="info-value">Jagung Hibrida NK212</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Lokasi:</span>
                            <span class="info-value">Singosari, Malang</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Tanggal Tanam:</span>
                            <span class="info-value">15 Juli 2025</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Prediksi Hasil:</span>
                            <span class="info-value">32.5 Ton</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Confidence Level:</span>
                            <span class="info-value">87%</span>
                           
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button class="footer-button" id="startHarvestPrediction">Mulai Prediksi Panen</button>
                </div>
            </div>
            
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-header-icon"><i class="fas fa-boxes"></i></div>
                    <div class="card-title">Prediksi 2<br>Estimasi Stok Benih</div>
                </div>
                <div class="card-content">
                    <div class="prediction-info">
                        <div class="info-row">
                            <span class="info-label">Benih Tersedia:</span>
                            <span class="info-value">1,250 Kg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Kebutuhan Bulanan:</span>
                            <span class="info-value">180 Kg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Stok Akan Habis:</span>
                            <span class="info-value">6.9 Bulan</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Reorder Point:</span>
                            <span class="info-value">300 Kg</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Status Stok:</span>
                            <span class="info-value">Aman</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Supplier:</span>
                            <span class="info-value">PT Benih Nusantara</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('prediksi_2') }}" class="footer-button" >Hitung Stok Benih</a>
                </div>
            </div>
            
            <div class="dashboard-card">
                <div class="card-header">
                    <div class="card-header-icon"><i class="fas fa-history"></i></div>
                    <div class="card-title">Riwayat Prediksi</div>
                </div>
                <div class="card-content">
                    <div class="prediction-info">
                        <div class="info-row">
                            <span class="info-label">Total Prediksi:</span>
                            <span class="info-value">125 Kali</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Prediksi Akurat:</span>
                            <span class="info-value">108 Kali (86%)</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Terakhir Diprediksi:</span>
                            <span class="info-value">23 Sep 2025</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Rata-rata Error:</span>
                            <span class="info-value">±2.3 Ton</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Lokasi Terbanyak:</span>
                            <span class="info-value">Malang (45x)</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Varietas Terpopuler:</span>
                            <span class="info-value">Hibrida NK212</span>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('riwayat') }}" class="footer-button">Lihat Riwayat</a>
                </div>
            </div>
        </div>
  
    @endsection