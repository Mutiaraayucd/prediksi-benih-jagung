<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
}
