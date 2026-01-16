@extends('main')
@section('main')

<section class="form-container">
    <div class="card-header">
        <div class="card-header-icon"><i class="fas fa-edit"></i></div>
        <div class="card-title">Input Data Pra-Panen</div>
    </div>

    <div class="card-content">

        <!-- ================= FORM ================= -->
        <form id="predictionForm" novalidate>

            <!-- ROW 1 -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kabupaten</label>
                    <select id="district" class="form-select" required name="kabupaten">
                        <option value="" disabled selected>Pilih Kabupaten</option>
                    </select>
                    <div class="error-message" id="districtError">Harap pilih kabupaten</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Kecamatan</label>
                    <select id="subdistrict" class="form-select" name="kecamatan" required disabled>
                        <option value="">Pilih Kecamatan</option>
                    </select>
                    <div class="error-message" id="subdistrictError">Harap pilih kecamatan</div>
                </div>
            </div>

            <!-- ROW 2 -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Desa</label>
                    <select id="village" class="form-select" name="desa" required disabled>
                        <option value="">Pilih Desa</option>
                    </select>
                    <div class="error-message" id="villageError">Harap pilih desa</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Luas Lahan</label>
                    <input type="number" id="landArea" class="form-input" min="0" step="0.01" placeholder="Contoh: 0.2" required name="luas_lahan">
                    <small>Hektar (Ha)</small>
                    <div class="error-message" id="landAreaError">Luas lahan tidak valid</div>
                </div>
            </div>

            <!-- ROW 3 -->
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Varietas Jagung</label>
                    <select id="cornType" class="form-select" required name="varietas_jagung">
                        <option value="">Pilih Varietas</option>
                        <option value="SAGE 1B">SAGE 1B</option>
                        <option value="SAGE 2">SAGE 2</option>
                        <option value="SAGE 5">SAGE 5</option>
                        <option value="SAGE 7">SAGE 7</option>
                    </select>
                    <div class="error-message" id="cornTypeError">Harap pilih varietas</div>
                </div>

                <div class="form-group">
                    <label class="form-label">Tanggal Tanam</label>
                    <input type="date" id="plantingDate" class="form-input" required>
                    <div class="error-message" id="plantingDateError">Harap pilih tanggal tanam</div>
                </div>
            </div>

            <!-- DATA SISTEM -->
            <div class="system-data-section">
                <div class="system-data-title">Data Otomatis Sistem</div>
                <div class="system-data-row"><span>Suhu</span><span id="avgTemperature">-</span></div>
                <div class="system-data-row"><span>Curah Hujan</span><span id="rainfall">-</span></div>
                <div class="system-data-row"><span>Umur Tanaman</span><span id="plantAge">-</span></div>
                <div class="system-data-row"><span>Mc (%)</span><span id="mcValue">-</span></div>
            </div>

            <button type="submit" class="predict-button" id="predictButton">
                <i class="fas fa-calculator"></i> Proses Estimasi Panen
            </button>
        </form>

        <!-- ================= PLACEHOLDER ================= -->
        <div class="result-placeholder" id="resultPlaceholder">
    <div class="placeholder-content">
        <div class="placeholder-icon">
            <i class="fas fa-chart-line"></i>
        </div>
        <p class="placeholder-text">
            Hasil estimasi panen akan ditampilkan di sini
        </p>
    </div>
</div>

        <!-- ================= HASIL PREDIKSI ================= -->
        <div class="prediction-result" id="predictionResult" style="display:none">

            <div class="prediction-header">
                <h2 class="prediction-title">Hasil Estimasi Panen Jagung</h2>
                <div class="yield-per-hectare" id="yieldPerHectare">-</div>
                <div class="yield-unit">Kg per Hektar</div>
            </div>

            <div class="prediction-content">

    <!-- HASIL 1 BARIS -->
    <div class="result-row-inline">

        <div class="result-item">
            <div class="result-label">Prediksi Total Panen</div>
            <div class="result-value" id="totalEstimation">-</div>
        </div>

        <div class="result-item">
            <div class="result-label">Tanggal Panen</div>
            <div class="result-value" id="harvestTime">-</div>
        </div>

        <div class="result-item status">
            <div class="result-label">Segmen Lahan</div>
            <div class="result-value" id="predictionStatus">-</div>
        </div>

    </div>

    <!-- ACTION BUTTONS -->
    <div class="action-buttons-inline">
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

<script>

/* ===============================
                    INIT WILAYAH (AMAN & FINAL)
                             ================================ */

        console.log('SCRIPT JALAN');

  

        // kode provinsi
        const PROV_JATIM = 35;
        const PROV_BALI = 51;

        // element form
        const kabSelect = document.getElementById('district');
        const kecSelect = document.getElementById('subdistrict');
        const desaSelect = document.getElementById('village');

        // validasi element
        if (!kabSelect || !kecSelect || !desaSelect) {
            throw new Error('Element form wilayah tidak ditemukan');
        }

        /* ===============================
           LOAD KABUPATEN
        ================================ */
        async function loadKabupaten() {
    try {
        console.log('LOAD KABUPATEN');

        const jatim = await fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${PROV_JATIM}.json`
        ).then(r => r.json());

        const bali = await fetch(
            `https://www.emsifa.com/api-wilayah-indonesia/api/regencies/${PROV_BALI}.json`
        ).then(r => r.json());

        const allKab = [...jatim, ...bali];

        function capitalize(text) {
            return text.replace(/\b\w/g, c => c.toUpperCase());
        }

        allKab.forEach(kab => {
            const namaKab = kab.name
                .replace(/^(kabupaten|kota)\s+/i, '')
                .trim();

            kabSelect.insertAdjacentHTML(
                'beforeend',
                `<option value="${kab.id}">${capitalize(namaKab)}</option>`
            );
        });

    } catch (error) {
        console.error('GAGAL LOAD KABUPATEN:', error);
    }
}

        /* ===============================
           KABUPATEN → KECAMATAN
        ================================ */
        kabSelect.addEventListener('change', async function() {
            const kabId = this.value;

            kecSelect.innerHTML = '<option value="">-- Pilih Kecamatan --</option>';
            desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
            kecSelect.disabled = true;
            desaSelect.disabled = true;

            if (!kabId) return;

            try {
                console.log('LOAD KECAMATAN');

                const kecamatan = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/districts/${kabId}.json`
                ).then(r => r.json());

                kecamatan.forEach(kec => {
                    kecSelect.insertAdjacentHTML(
                        'beforeend',
                        `<option value="${kec.id}">${kec.name}</option>`
                    );
                });

                kecSelect.disabled = false;

            } catch (error) {
                console.error('GAGAL LOAD KECAMATAN:', error);
            }
        });

        /* ===============================
           KECAMATAN → DESA
        ================================ */
        kecSelect.addEventListener('change', async function() {
            const kecId = this.value;

            desaSelect.innerHTML = '<option value="">-- Pilih Desa --</option>';
            desaSelect.disabled = true;

            if (!kecId) return;

            try {
                console.log('LOAD DESA');

                const desa = await fetch(
                    `https://www.emsifa.com/api-wilayah-indonesia/api/villages/${kecId}.json`
                ).then(r => r.json());

                desa.forEach(d => {
                    desaSelect.insertAdjacentHTML(
                        'beforeend',
                        `<option value="${d.name}">${d.name}</option>`
                    );
                });

                desaSelect.disabled = false;

            } catch (error) {
                console.error('GAGAL LOAD DESA:', error);
            }
        });

        /* ===============================
           START
        ================================ */
        loadKabupaten();



const form = document.getElementById('predictionForm');
const resultPlaceholder = document.getElementById('resultPlaceholder');
const predictionResult = document.getElementById('predictionResult');
const predictButton = document.getElementById('predictButton');

form.addEventListener('submit', function(e) {
    e.preventDefault();
    callPredictionAPI();
});

async function callPredictionAPI() {

    predictButton.disabled = true;
    predictButton.innerHTML = 'Memproses...';

    const payload = {
        tanggal_tanam: document.getElementById('plantingDate').value,
        varietas_jagung: document.getElementById('cornType').value,
        luas_lahan: parseFloat(document.getElementById('landArea').value),
        kabupaten: kabSelect.options[kabSelect.selectedIndex].text,
        kecamatan: kecSelect.options[kecSelect.selectedIndex].text,
        desa: desaSelect.value
    };

    try {
        const response = await fetch('http://127.0.0.1:8000/api/prediksi_panenn', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(payload)
        });

        const result = await response.json();

        if (!response.ok || result.status !== 'success') {
            throw new Error('Gagal mengambil prediksi');
        }

        const data = result.data;
        // console.log('DATA PREDIKSI:', data);
        /* ===============================
           ISI DATA SISTEM
        ================================ */
        document.getElementById('avgTemperature').textContent = data.suhu_c + ' °C';
        document.getElementById('rainfall').textContent = data.curah_hujan_mm + ' mm';
        document.getElementById('plantAge').textContent = data.umur_tanaman_hari + ' hari';
        document.getElementById('mcValue').textContent = data.mc_persen + ' %';

        /* ===============================
           HASIL UTAMA
        ================================ */
        document.getElementById('yieldPerHectare').textContent =
            data.prediksi_panen_kg.toFixed(2);

        document.getElementById('totalEstimation').textContent =
            data.produktivitas_kg_ha.toFixed(2) + ' Kg';

        document.getElementById('harvestTime').textContent =
            new Date(data.tanggal_panen).toLocaleDateString('id-ID');

        document.getElementById('predictionStatus').innerHTML =
            '' + data.segment_lahan + '';

        /* ===============================
           TAMPILKAN HASIL
        ================================ */
        resultPlaceholder.style.display = 'none';
        predictionResult.style.display = 'block';
        predictionResult.scrollIntoView({ behavior: 'smooth' });

    } catch (error) {
        alert('Terjadi kesalahan saat memproses prediksi');
        console.error(error);
    } finally {
        predictButton.disabled = false;
        predictButton.innerHTML = 'Proses Estimasi Panen';
    }
}

function rePredict() {
    predictionResult.style.display = 'none';
    resultPlaceholder.style.display = 'flex';
    form.reset();
}



</script>

@endsection
