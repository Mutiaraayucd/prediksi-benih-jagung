<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class PrediksiController extends Controller
{
    public function index()
    {
      $title = "Prediksi Estimasi Hasil Panen Jagung Hibrida";
        return view('prediksi1', compact('title'));
    }
    public function benih()
    {
      $title = "Prediksi Stok Benih Jagung Hibrida";
        return view('prediksi2', compact('title'));
    }

    public function riwayat()
    {
      $title = "Riwayat Prediksi";
        return view('riwayatprediksi', compact('title'));
    }


    public function predict(Request $request)
    {
        /* ===============================
       1. VALIDASI
    ================================ */
        $validator = Validator::make($request->all(), [
            'kabupaten'          => 'required|string',
            'kecamatan'          => 'required|string',
            'desa'               => 'required|string',
            'tanggal_tanam'      => 'required|date_format:Y-m-d',
            'luas_lahan'         => 'required|numeric|min:0.01',
            // 'harga_beli_petani'  => 'required|numeric|min:0',
            'varietas_jagung'           => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validasi gagal',
                'errors' => $validator->errors()
            ], 422);
        }

        /* ===============================
       2. NORMALISASI DATA
    ================================ */
        $payload = [
            "kabupaten" => strtoupper($request->kabupaten),
            "kecamatan" => strtoupper($request->kecamatan),
            "desa" => strtoupper($request->desa),
            "tanggal_tanam" => Carbon::parse($request->tanggal_tanam)->format('Y-m-d'),
            "luas_lahan" => (float) str_replace(',', '.', $request->luas_lahan),
            // "harga_beli_petani" => (int) $request->harga_beli_petani,
            "varietas_jagung" => strtoupper($request->varietas_jagung)
        ];

        /* ===============================
       3. KIRIM KE FASTAPI
    ================================ */
        try {
            $response = Http::timeout(60)
                ->acceptJson()
                ->post('http://127.0.0.1:8001/predict', $payload);

            if (!$response->successful()) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'API prediksi gagal',
                    'detail' => $response->json()
                ], $response->status());
            }

            /* ===============================
           4. RETURN RESPONSE ML
        ================================ */
            return response()->json([
                'status' => 'success',
                'data' => $response->json()
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Gagal koneksi ke API prediksi',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
