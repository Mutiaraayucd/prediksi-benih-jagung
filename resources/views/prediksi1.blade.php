
        @extends('main')
        @section('main')
        <section class="form-container">
            <div class="card-header">
                <div class="card-header-icon"><i class="fas fa-edit"></i></div>
                <div class="card-title">Input Data Pra-Panen</div>
            </div>
            
            <div class="card-content">
                <form id="predictionForm" novalidate>
                    <div class="form-row">
                        <div class="form-group">
                            <label for="landArea" class="form-label">Luas Lahan</label>
                            <input type="number" id="landArea" class="form-input" placeholder="Masukkan Luas Lahan" min="0" step="0.1" required>
                            <small style="color: #6c757d; font-size: 11px;">Hektar (Ha)</small>
                            <div class="error-message" id="landAreaError">Harap masukkan luas lahan yang valid</div>
                        </div>
                        <div class="form-group">
                            <label for="village" class="form-label">Desa</label>
                            <input type="text" id="village" class="form-input" placeholder="Masukkan Nama Desa" required>
                            <div class="error-message" id="villageError">Harap masukkan nama desa</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="district" class="form-label">Kabupaten</label>
                            <select id="district" class="form-select" required>
                                <option value="">Pilih Kabupaten</option>
                                <option value="bandung">Bandung</option>
                                <option value="garut">Garut</option>
                                <option value="sukabumi">Sukabumi</option>
                                <option value="cianjur">Cianjur</option>
                            </select>
                            <div class="error-message" id="districtError">Harap pilih kabupaten</div>
                        </div>
                        <div class="form-group">
                            <label for="cornType" class="form-label">Jenis/Varietas Jagung</label>
                            <select id="cornType" class="form-select" required>
                                <option value="">Pilih Varietas</option>
                                <option value="hibrida1">Hibrida NK-212</option>
                                <option value="hibrida2">Hibrida Bisi-18</option>
                                <option value="hibrida3">Hibrida Pioneer-27</option>
                            </select>
                            <div class="error-message" id="cornTypeError">Harap pilih varietas jagung</div>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="subdistrict" class="form-label">Kecamatan</label>
                            <select id="subdistrict" class="form-select" required>
                                <option value="">Pilih Kecamatan</option>
                                <option value="kec1">Kecamatan A</option>
                                <option value="kec2">Kecamatan B</option>
                                <option value="kec3">Kecamatan C</option>
                            </select>
                            <div class="error-message" id="subdistrictError">Harap pilih kecamatan</div>
                        </div>
                        <div class="form-group">
                            <label for="plantingDate" class="form-label">Tanggal Tanam</label>
                            <input type="date" id="plantingDate" class="form-input" required>
                            <div class="error-message" id="plantingDateError">Harap pilih tanggal tanam</div>
                        </div>
                    </div>

                    <div class="system-data-section">
                        <div class="system-data-title">Data Otomatis Sistem:</div>
                        <div class="system-data-row">
                            <span>Suhu Rata-rata:</span>
                            <span id="avgTemperature">-</span>
                        </div>
                        <div class="system-data-row">
                            <span>Curah Hujan:</span>
                            <span id="rainfall">-</span>
                        </div>
                        <div class="system-data-row">
                            <span>Umur Tanaman:</span>
                            <span id="plantAge">-</span>
                        </div>
                    </div>

                    <button type="submit" class="predict-button" id="predictButton">
                        <i class="fas fa-calculator"></i> Mulai Prediksi
                    </button>
                </form>

                <div class="result-placeholder" id="resultPlaceholder">
                    <div style="text-align: center;">
                        <div style="font-size: 36px; margin-bottom: 10px; color: #8FBC8F;" aria-hidden="true">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <div>Hasil prediksi akan ditampilkan di sini</div>
                    </div>
                </div>

                <!-- Hasil Prediksi -->
                <div class="prediction-result" id="predictionResult">
                    <div class="prediction-header">
                        <h2 class="prediction-title">Estimasi Hasil Panen</h2>
                        <div class="yield-per-hectare" id="yieldPerHectare">2.70</div>
                        <div class="yield-unit">Ton per Hektar</div>
                        <div class="confidence-level" id="confidenceLevel">
                            <i class="fas fa-chart-line"></i> Tingkat Kepercayaan: 87%
                            <div class="progress-bar">
                                <div class="progress-fill"></div>
                            </div>
                        </div>
                    </div>

                    <div class="prediction-content">
                        <div class="prediction-grid">
                            <div class="prediction-card">
                                <div class="prediction-card-title">Total Estimasi</div>
                                <div class="prediction-card-value" id="totalEstimation">21.88 Ton untuk lahan 2.5 Ha</div>
                            </div>
                            <div class="prediction-card">
                                <div class="prediction-card-title">Waktu Panen</div>
                                <div class="prediction-card-value" id="harvestTime">25 Desember 2025 (±7 hari)</div>
                            </div>
                            <div class="prediction-card">
                                <div class="prediction-card-title">Estimasi Nilai</div>
                                <div class="prediction-card-value" id="estimatedValue">Rp 131.3 Juta @Rp 6,000/kg</div>
                            </div>
                        </div>

                        <div class="prediction-status">
                            <div class="status-title">Status Prediksi</div>
                            <div class="status-value" id="predictionStatus">
                                <i class="fas fa-check-circle"></i> Sangat Baik - Kondisi optimal
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
            </div>
        </section>
    </div>

    <script>
        // DOM Elements
        const sidebar = document.getElementById('sidebar');
        const menuToggle = document.getElementById('menuToggle');
        const form = document.getElementById('predictionForm');
        const resultPlaceholder = document.getElementById('resultPlaceholder');
        const predictionResult = document.getElementById('predictionResult');
        const predictButton = document.getElementById('predictButton');
        
        // Toggle sidebar on mobile
        menuToggle.addEventListener('click', function() {
            sidebar.classList.toggle('active');
        });

        // Form validation and submission
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            if (validateForm()) {
                simulatePrediction();
            }
        });

        // Form validation function
        function validateForm() {
            let isValid = true;
            const fields = [
                { id: 'landArea', errorId: 'landAreaError' },
                { id: 'village', errorId: 'villageError' },
                { id: 'district', errorId: 'districtError' },
                { id: 'cornType', errorId: 'cornTypeError' },
                { id: 'subdistrict', errorId: 'subdistrictError' },
                { id: 'plantingDate', errorId: 'plantingDateError' }
            ];

            fields.forEach(field => {
                const input = document.getElementById(field.id);
                const error = document.getElementById(field.errorId);
                
                if (!input.value.trim()) {
                    input.classList.add('error');
                    error.style.display = 'block';
                    isValid = false;
                } else {
                    input.classList.remove('error');
                    error.style.display = 'none';
                }
            });

            // Additional validation for land area
            const landArea = document.getElementById('landArea');
            if (landArea.value && parseFloat(landArea.value) <= 0) {
                landArea.classList.add('error');
                document.getElementById('landAreaError').textContent = 'Luas lahan harus lebih dari 0';
                document.getElementById('landAreaError').style.display = 'block';
                isValid = false;
            }

            return isValid;
        }

        // Simulate prediction process
        function simulatePrediction() {
            // Show loading state
            predictButton.disabled = true;
            predictButton.innerHTML = '<span class="loading-spinner"></span>Memproses Prediksi...';
            
            // Update system data with mock values
            document.getElementById('avgTemperature').textContent = '28°C';
            document.getElementById('rainfall').textContent = '150 mm';
            
            // Calculate plant age based on planting date
            const plantingDate = new Date(document.getElementById('plantingDate').value);
            const today = new Date();
            const plantAge = Math.floor((today - plantingDate) / (1000 * 60 * 60 * 24));
            document.getElementById('plantAge').textContent = plantAge + ' hari';
            
            // Simulate API call delay
            setTimeout(() => {
                // Reset button state
                predictButton.disabled = false;
                predictButton.innerHTML = '<i class="fas fa-calculator"></i> Mulai Prediksi';
                
                // Calculate prediction results
                const landArea = parseFloat(document.getElementById('landArea').value);
                const yieldPerHectare = 2.70; // Fixed value from image
                const totalYield = (yieldPerHectare * landArea).toFixed(2);
                
                // Calculate harvest date (90 days from planting)
                const harvestDate = new Date(plantingDate);
                harvestDate.setDate(harvestDate.getDate() + 90);
                
                // Format harvest date
                const options = { day: 'numeric', month: 'long', year: 'numeric' };
                const formattedHarvestDate = harvestDate.toLocaleDateString('id-ID', options);
                
                // Calculate estimated value
                const pricePerKg = 6000;
                const totalValue = (totalYield * 1000 * pricePerKg) / 1000000; // Convert to juta
                
                // Update prediction result display
                document.getElementById('yieldPerHectare').textContent = yieldPerHectare.toFixed(2);
                document.getElementById('totalEstimation').textContent = `${totalYield} Ton untuk lahan ${landArea} Ha`;
                document.getElementById('harvestTime').textContent = `${formattedHarvestDate} (±7 hari)`;
                document.getElementById('estimatedValue').textContent = `Rp ${totalValue.toFixed(1)} Juta @Rp ${pricePerKg.toLocaleString('id-ID')}/kg`;
                
                // Determine prediction status based on conditions
                let status = "Sangat Baik - Kondisi optimal";
                document.getElementById('predictionStatus').innerHTML = '<i class="fas fa-check-circle"></i> ' + status;
                
                // Hide placeholder and show result
                resultPlaceholder.style.display = 'none';
                predictionResult.style.display = 'block';
                
                // Animate progress bar
                const progressFill = document.querySelector('.progress-fill');
                progressFill.style.width = '0';
                setTimeout(() => {
                    progressFill.style.width = '87%';
                }, 500);
                
                // Scroll to result
                predictionResult.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            }, 2000);
        }

        // Action button functions
        function downloadReport() {
            alert('Fitur download laporan akan segera tersedia!');
        }

        function savePrediction() {
            alert('Prediksi berhasil disimpan!');
        }

        function rePredict() {
            predictionResult.style.display = 'none';
            resultPlaceholder.style.display = 'flex';
            form.reset();
            
            // Reset system data
            document.getElementById('avgTemperature').textContent = '-';
            document.getElementById('rainfall').textContent = '-';
            document.getElementById('plantAge').textContent = '-';
        }

        // User avatar click effect
        document.getElementById('userAvatar').addEventListener('click', function() {
            this.innerHTML = '<i class="fas fa-user"></i>';
            setTimeout(() => {
                this.innerHTML = 'MA';
            }, 1000);
        });

        // Add today's date as max for planting date
        document.getElementById('plantingDate').max = new Date().toISOString().split('T')[0];

        // Real-time validation for land area
        document.getElementById('landArea').addEventListener('input', function() {
            if (this.value && parseFloat(this.value) <= 0) {
                this.classList.add('error');
                document.getElementById('landAreaError').textContent = 'Luas lahan harus lebih dari 0';
                document.getElementById('landAreaError').style.display = 'block';
            } else {
                this.classList.remove('error');
                document.getElementById('landAreaError').style.display = 'none';
            }
        });

        // Add hover effect to prediction cards
        document.addEventListener('DOMContentLoaded', function() {
            const predictionCards = document.querySelectorAll('.prediction-card');
            predictionCards.forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateX(5px)';
                });
                
                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateX(0)';
                });
            });
        });
    </script>
@endsection