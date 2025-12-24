<div class="sidebar" id="sidebar">
        <div class="logo-section">
            <div class="logo">🌾</div>
            <div class="company-info">
                <h3>PT Sage</h3>
                <p>Maslahat Indonesia</p>
            </div>
        </div>
        
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="{{ route("dashboard") }}" class="nav-link @if(request()->is('dashboard')) active @endif">
                    <span class="nav-icon"><i class="fas fa-home"></i></span>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prediksi_1') }}" class="nav-link @if(request()->is('prediksi_panen')) active @endif">
                    <span class="nav-icon"><i class="fas fa-seedling"></i></span>
                    Prediksi Hasil Panen
                  
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('prediksi_2') }}" class="nav-link @if(request()->is('prediksi_benih')) active @endif">
                    <span class="nav-icon"><i class="fas fa-boxes"></i></span>
                    Prediksi Stok Benih
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('riwayat') }}" class="nav-link @if(request()->is('riwayat_prediksi')) active @endif">
                    <span class="nav-icon"><i class="fas fa-chart-line"></i></span>
                    Riwayat Prediksi
                </a>
            </li>

            
        </ul>
    </div>