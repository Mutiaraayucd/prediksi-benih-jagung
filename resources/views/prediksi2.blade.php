@extends('main')
@section('main')
<div class="mode-selector">
            <div class="mode-buttons">
                <div class="mode-button active" id="defaultModeBtn" onclick="switchMode('default')">
                    <div class="mode-button-title">Mode Default</div>
                    <div class="mode-button-subtitle">Sebelum Panen (MC Rata-rata)</div>
                </div>
                <div class="mode-button manual" id="manualModeBtn" onclick="switchMode('manual')">
                    <div class="mode-button-title">Mode Manual</div>
                    <div class="mode-button-subtitle">Setelah Panen (MC Terukur)</div>
                </div>
            </div>

            <div class="mode-info" id="modeInfo">
                <div class="mode-info-icon">
                    <i class="fas fa-info-circle"></i>
                </div>
                <div>
                    <div class="mode-info-title">Prediksi Pra-Panen</div>
                    <div class="mode-info-text">
                        Gunakan mode ini untuk perencanaan sebelum panen. Sistem akan menggunakan MC rata-rata default dari varietas yang dipilih.
                    </div>
                </div>
            </div>
        </div>
        
        <section class="form-container">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-database"></i></div>
                <div class="card-title">Input Data Produksi Benih</div>
            </div>
            
            <div class="card-content">
                <div id="predictionForm">
                    <!-- Varietas -->
                    <div class="form-group">
                        <label for="variety" class="form-label">
                            Varietas Jagung <span class="required">*</span>
                        </label>
                        <select class="form-select" id="variety" onchange="updateVarietyInfo()">
                            <option value="">Pilih Varietas</option>
                            <option value="Hibrida 1" data-mc="24.5">Hibrida 1</option>
                            <option value="Hibrida 2" data-mc="25.0">Hibrida 2</option>
                            <option value="Hibrida 3" data-mc="23.8">Hibrida 3</option>
                            <option value="Pioneer P27" data-mc="25.5">Pioneer P27</option>
                            <option value="Bisi 18" data-mc="24.0">Bisi 18</option>
                            <option value="NK 212" data-mc="26.0">NK 212</option>
                        </select>
                        <div class="variety-note" id="varietyNote" style="display: none;"></div>
                        <div class="error-message" id="varietyError">Harap pilih varietas jagung</div>
                    </div>

                    <!-- Estimasi Hasil Panen -->
                    <div class="form-group">
                        <label for="harvestResult" class="form-label">
                            Estimasi Hasil Panen (dari Prediksi 1) <span class="required">*</span>
                        </label>
                        <div class="input-unit">
                            <input type="number" class="form-input" id="harvestResult" placeholder="Masukkan berat panen" step="0.01">
                            <span class="unit-suffix">Ton</span>
                        </div>
                        <div class="error-message" id="harvestResultError">Harap masukkan estimasi hasil panen</div>
                    </div>

                    <!-- MC Manual (Hidden by default) -->
                    <div class="form-group" id="mcManualGroup" style="display: none;">
                        <div class="mc-highlight">
                            <label for="moistureContent" class="form-label">
                                <i class="fas fa-tint"></i> Kadar Air Jagung Real (MC %) <span class="required">*</span>
                            </label>
                            <div class="input-unit">
                                <input type="number" class="form-input" id="moistureContent" placeholder="Contoh: 28.5" step="0.1" min="0" max="100">
                                <span class="unit-suffix">%</span>
                            </div>
                            <div class="mc-note">
                                <i class="fas fa-ruler"></i> Masukkan hasil pengukuran moisture meter setelah panen
                            </div>
                            <div class="error-message" id="moistureContentError">Harap masukkan kadar air yang valid (0-100%)</div>
                        </div>
                    </div>

                    <button type="button" class="predict-button" id="predictButton" onclick="handlePredict()">
                        <i class="fas fa-calculator"></i> Mulai Prediksi Stok
                    </button>
                </div>

                <!-- Hasil Prediksi -->
                <div class="prediction-result" id="predictionResult">
                    <div class="prediction-header">
                        <h2 class="prediction-title">Hasil Prediksi Stok Benih</h2>
                        <div style="color: #666; font-size: 13px;">Estimasi benih siap kemas berdasarkan proses produksi</div>
                        <div class="mc-badge" id="mcBadge"></div>
                    </div>

                    <!-- MC Info Card -->
                    <div class="mc-info-card">
                        <div class="mc-info-icon">
                            <i class="fas fa-tint"></i>
                        </div>
                        <div class="mc-info-content">
                            <div class="mc-info-label">Kadar Air (MC) Digunakan</div>
                            <div class="mc-info-value" id="mcUsed">-</div>
                        </div>
                    </div>

                    <div class="results-grid">
                        <div class="result-card">
                            <div class="result-title">Total Stok Benih</div>
                            <div class="result-value" id="totalStock">-</div>
                            <div class="result-subtitle" id="totalStockKg">-</div>
                        </div>
                        <div class="result-card">
                            <div class="result-title">Recovery Rate</div>
                            <div class="result-value" id="recoveryRate">-</div>
                            <div class="result-subtitle">dari hasil panen</div>
                        </div>
                    </div>

                    <div class="packaging-section">
                        <div class="packaging-title">Kemasan Siap Jual</div>
                        <div class="packaging-grid">
                            <div class="result-card">
                                <div class="result-title">Kemasan 1 kg</div>
                                <div class="result-value" id="package1kg">-</div>
                                <div class="result-subtitle">pack</div>
                            </div>
                            <div class="result-card">
                                <div class="result-title">Kemasan 5 kg</div>
                                <div class="result-value" id="package5kg">-</div>
                                <div class="result-subtitle">pack</div>
                            </div>
                        </div>
                    </div>

                    <div class="process-section">
                        <div class="process-title">Detail Proses Produksi</div>
                        
                        <div class="process-item">
                            <div class="process-name">
                                <div class="process-check"><i class="fas fa-check"></i></div>
                                <span>Sortasi</span>
                            </div>
                            <div class="process-result">
                                <div class="process-weight" id="sortasiWeight">-</div>
                                <div>(90% recovery)</div>
                            </div>
                        </div>

                        <div class="process-item">
                            <div class="process-name">
                                <div class="process-check"><i class="fas fa-check"></i></div>
                                <span>Drying</span>
                            </div>
                            <div class="process-result">
                                <div class="process-weight" id="dryingWeight">-</div>
                                <div>(80% recovery)</div>
                            </div>
                        </div>

                        <div class="process-item">
                            <div class="process-name">
                                <div class="process-check"><i class="fas fa-check"></i></div>
                                <span>Shelling</span>
                            </div>
                            <div class="process-result">
                                <div class="process-weight" id="shellingWeight">-</div>
                                <div>(75% recovery)</div>
                            </div>
                        </div>

                        <div class="process-item">
                            <div class="process-name">
                                <div class="process-check"><i class="fas fa-check"></i></div>
                                <span>Grading</span>
                            </div>
                            <div class="process-result">
                                <div class="process-weight" id="gradingWeight">-</div>
                                <div>(70% recovery)</div>
                            </div>
                        </div>
                    </div>

                    <div class="action-buttons">
                        <button class="action-button" onclick="downloadReport()">
                            <i class="fas fa-download"></i> Download Laporan
                        </button>
                        <button class="action-button" onclick="savePrediction()">
                            <i class="fas fa-save"></i> Simpan Prediksi
                        </button>
                        <button class="action-button" onclick="rePredict()">
                            <i class="fas fa-redo"></i> Prediksi Ulang
                        </button>
                    </div>
                </div>
            </div>
        </section>
<script>
      let currentMode = 'default';
        const varietyData = {
            'Hibrida 1': { mcDefault: 24.5 },
            'Hibrida 2': { mcDefault: 25.0 },
            'Hibrida 3': { mcDefault: 23.8 },
            'Pioneer P27': { mcDefault: 25.5 },
            'Bisi 18': { mcDefault: 24.0 },
            'NK 212': { mcDefault: 26.0 }
        };

        // DOM Elements
    
        const predictionResult = document.getElementById('predictionResult');
        const predictButton = document.getElementById('predictButton');
        
        // Toggle sidebar on mobile
       

        // Switch Mode Function
        function switchMode(mode) {
            currentMode = mode;
            const defaultBtn = document.getElementById('defaultModeBtn');
            const manualBtn = document.getElementById('manualModeBtn');
            const modeInfo = document.getElementById('modeInfo');
            const mcManualGroup = document.getElementById('mcManualGroup');
            const moistureContent = document.getElementById('moistureContent');
            
            if (mode === 'default') {
                defaultBtn.classList.add('active');
                manualBtn.classList.remove('active');
                modeInfo.classList.remove('manual');
                predictButton.classList.remove('manual-mode');
                mcManualGroup.style.display = 'none';
                moistureContent.value = '';
                
                modeInfo.innerHTML = `
                    <div class="mode-info-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <div class="mode-info-title">Prediksi Pra-Panen</div>
                        <div class="mode-info-text">
                            Gunakan mode ini untuk perencanaan sebelum panen. Sistem akan menggunakan MC rata-rata default dari varietas yang dipilih.
                        </div>
                    </div>
                `;
            } else {
                manualBtn.classList.add('active');
                defaultBtn.classList.remove('active');
                modeInfo.classList.add('manual');
                predictButton.classList.add('manual-mode');
                mcManualGroup.style.display = 'block';
                
                modeInfo.innerHTML = `
                    <div class="mode-info-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <div>
                        <div class="mode-info-title">Prediksi Pasca-Panen</div>
                        <div class="mode-info-text">
                            Gunakan mode ini setelah panen dan Anda sudah mengukur kadar air (MC) jagung menggunakan moisture meter untuk hasil yang lebih akurat.
                        </div>
                    </div>
                `;
            }
            
            predictionResult.style.display = 'none';
            updateVarietyInfo();
        }

        // Update Variety Info
        function updateVarietyInfo() {
            const varietySelect = document.getElementById('variety');
            const varietyNote = document.getElementById('varietyNote');
            const selectedOption = varietySelect.options[varietySelect.selectedIndex];
            
            if (currentMode === 'default' && varietySelect.value) {
                const mcDefault = selectedOption.getAttribute('data-mc');
                varietyNote.textContent = `💡 MC Default untuk ${varietySelect.value}: ${mcDefault}%`;
                varietyNote.style.display = 'block';
            } else {
                varietyNote.style.display = 'none';
            }
        }

        // Validate Form
        function validateForm() {
            let isValid = true;
            
            const variety = document.getElementById('variety');
            const harvestResult = document.getElementById('harvestResult');
            const moistureContent = document.getElementById('moistureContent');
            
            // Reset errors
            variety.classList.remove('error');
            harvestResult.classList.remove('error');
            moistureContent.classList.remove('error');
            document.getElementById('varietyError').style.display = 'none';
            document.getElementById('harvestResultError').style.display = 'none';
            document.getElementById('moistureContentError').style.display = 'none';
            
            // Validate variety
            if (!variety.value) {
                variety.classList.add('error');
                document.getElementById('varietyError').style.display = 'block';
                isValid = false;
            }
            
            // Validate harvest result
            if (!harvestResult.value || parseFloat(harvestResult.value) <= 0) {
                harvestResult.classList.add('error');
                document.getElementById('harvestResultError').style.display = 'block';
                isValid = false;
            }
            
            // Validate MC for manual mode
            if (currentMode === 'manual') {
                if (!moistureContent.value) {
                    moistureContent.classList.add('error');
                    document.getElementById('moistureContentError').textContent = 'Harap masukkan kadar air';
                    document.getElementById('moistureContentError').style.display = 'block';
                    isValid = false;
                } else if (parseFloat(moistureContent.value) < 0 || parseFloat(moistureContent.value) > 100) {
                    moistureContent.classList.add('error');
                    document.getElementById('moistureContentError').textContent = 'Kadar air harus antara 0-100%';
                    document.getElementById('moistureContentError').style.display = 'block';
                    isValid = false;
                }
            }
            
            return isValid;
        }

        // Handle Predict
        function handlePredict() {
            if (!validateForm()) {
                return;
            }
            
            predictButton.disabled = true;
            predictButton.innerHTML = '<span class="loading-spinner"></span>Memproses Prediksi...';
            
            setTimeout(() => {
                calculatePrediction();
                predictButton.disabled = false;
                predictButton.innerHTML = '<i class="fas fa-calculator"></i> Mulai Prediksi Stok';
                predictionResult.style.display = 'block';
                predictionResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 1500);
        }

        // Calculate Prediction
        function calculatePrediction() {
            const variety = document.getElementById('variety').value;
            const harvestTons = parseFloat(document.getElementById('harvestResult').value);
            
            let mcValue;
            let mcType;
            
            if (currentMode === 'default') {
                mcValue = varietyData[variety].mcDefault;
                mcType = 'MC Default (Rata-rata Varietas)';
                document.getElementById('mcBadge').className = 'mc-badge default';
                document.getElementById('mcBadge').textContent = mcType;
            } else {
                mcValue = parseFloat(document.getElementById('moistureContent').value);
                mcType = 'MC Real (Terukur)';
                document.getElementById('mcBadge').className = 'mc-badge manual';
                document.getElementById('mcBadge').textContent = mcType;
            }
            
            const mcTarget = 12;
            
            // Process calculations
            const sortasi = harvestTons * 0.90;
            const drying = sortasi * ((100 - mcValue) / (100 - mcTarget));
            const shelling = drying * 0.75;
            const grading = shelling * 0.70;
            
            const totalStock = grading;
            const recoveryRate = (totalStock / harvestTons) * 100;
            
            // Update results
            document.getElementById('mcUsed').textContent = mcValue.toFixed(1) + '%';
            document.getElementById('totalStock').textContent = totalStock.toFixed(2) + ' ton';
            document.getElementById('totalStockKg').textContent = `(${(totalStock * 1000).toFixed(0)} kg)`;
            document.getElementById('recoveryRate').textContent = recoveryRate.toFixed(1) + '%';
            
            // Packaging
            const totalKg = totalStock * 1000;
            document.getElementById('package1kg').textContent = Math.floor(totalKg).toLocaleString();
            document.getElementById('package5kg').textContent = Math.floor(totalKg / 5).toLocaleString();
            
            // Process details
            document.getElementById('sortasiWeight').textContent = sortasi.toFixed(2) + ' ton';
            document.getElementById('dryingWeight').textContent = drying.toFixed(2) + ' ton';
            document.getElementById('shellingWeight').textContent = shelling.toFixed(2) + ' ton';
            document.getElementById('gradingWeight').textContent = grading.toFixed(2) + ' ton';
        }

        // Action Functions
        function downloadReport() {
            alert('Fitur download laporan akan segera tersedia!');
        }

        function savePrediction() {
            alert('Prediksi stok benih berhasil disimpan!');
        }

        function rePredict() {
            predictionResult.style.display = 'none';
            document.getElementById('variety').value = '';
            document.getElementById('harvestResult').value = '';
            document.getElementById('moistureContent').value = '';
            updateVarietyInfo();
        }

     

        // Real-time validation for moisture content
        document.getElementById('moistureContent').addEventListener('input', function() {
            const value = parseFloat(this.value);
            const error = document.getElementById('moistureContentError');
            
            if (this.value && (value > 100 || value < 0)) {
                this.classList.add('error');
                error.textContent = 'Kadar air harus antara 0-100%';
                error.style.display = 'block';
            } else {
                this.classList.remove('error');
                error.style.display = 'none';
            }
        });
</script>
@endsection