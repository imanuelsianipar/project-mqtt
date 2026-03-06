<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; 

class DashboardController extends Controller
{
    // ==============================================================
    // 1. FUNGSI UNTUK MENAMPILKAN PETA SEBARAN (DASHBOARD)
    // ==============================================================
    public function index()
    {
        $daftarAlat = [
            ['id_alat' => 10, 'site' => 'AWS Stageof Bandung', 'lat' => -6.88351, 'lon' => 107.59731],
            ['id_alat' => 1, 'site' => 'AWS UI', 'lat' => -6.37191, 'lon' => 106.82762],
            ['id_alat' => 5, 'site' => 'AWS Kebun Bibit Cibubur', 'lat' => -6.356835, 'lon' => 106.890804],
            ['id_alat' => 8, 'site' => 'AWS Sukamandi', 'lat' => -6.37032, 'lon' => 107.62513],
            ['id_alat' => 9, 'site' => 'AWS SMPK Bojong Picung', 'lat' => -6.83688, 'lon' => 107.27382],
            ['id_alat' => 7, 'site' => 'AWS Sukaraja', 'lat' => -6.861181, 'lon' => 106.977009],
            ['id_alat' => 6, 'site' => 'AWS Jagorawi', 'lat' => -6.46052, 'lon' => 106.86946],
            ['id_alat' => 4, 'site' => 'AWS Leuwiliang', 'lat' => -6.56485, 'lon' => 106.6297],
            ['id_alat' => 2, 'site' => 'AWS IPB', 'lat' => -6.600471, 'lon' => 106.8054],
            ['id_alat' => 3, 'site' => 'AWS Cisolok', 'lat' => -6.95955, 'lon' => 106.47628],
            ['id_alat' => 14, 'site' => 'PJT II Gabus', 'lat' => -6.16733, 'lon' => 107.04884],
            ['id_alat' => 12, 'site' => 'PJT II Muara', 'lat' => -6.12492, 'lon' => 107.06328],
            ['id_alat' => 13, 'site' => 'PJT II Jatiasih', 'lat' => -6.30567, 'lon' => 106.96229],
            ['id_alat' => 11, 'site' => 'ARG Rekayasa Cisadane', 'lat' => -6.60785, 'lon' => 106.79298]
        ];

        $lokasiPeralatan = [];

        foreach ($daftarAlat as $alat) {
            $isArg = (strpos(strtolower($alat['site']), 'arg') !== false || strpos(strtolower($alat['site']), 'pjt') !== false);
            $namaTabel = $isArg ? 'data_arg' : 'data_aws';

            $dataTerakhir = DB::table($namaTabel) 
                ->where('id_peralatan', $alat['id_alat'])
                ->orderBy('waktu_observasi', 'desc')
                ->first();

            $status = 1; 
            $jenis_anomali = []; 
            $waktu_anomali = '-';

            if ($dataTerakhir) {
                // Konversi aman ke integer untuk pengecekan
                $qc_range = isset($dataTerakhir->status_qc_range) ? (int)$dataTerakhir->status_qc_range : 1;
                $qc_step  = isset($dataTerakhir->status_qc_step) ? (int)$dataTerakhir->status_qc_step : 1;
                $flag_missing = isset($dataTerakhir->flag_missing) ? (int)$dataTerakhir->flag_missing : 0;

                if ($qc_range === 0) $jenis_anomali[] = "Range Check";
                if ($qc_step === 0) $jenis_anomali[] = "Step Check";
                if ($flag_missing === 1) $jenis_anomali[] = "Missing Data";

                if (!empty($jenis_anomali)) {
                    $status = 0; 
                    $waktu_anomali = \Carbon\Carbon::parse($dataTerakhir->waktu_observasi)->format('H:i:s');
                }
            }

            $lokasiPeralatan[] = [
                'id_alat'       => $alat['id_alat'],
                'site'          => $alat['site'],
                'lat'           => $alat['lat'], // Hapus duplikat 'lat' di sini
                'lon'           => $alat['lon'],
                'status'        => $status, 
                'info_anomali'  => implode(', ', $jenis_anomali), 
                'waktu_anomali' => $waktu_anomali
            ];
        }

        return view('dashboard', compact('lokasiPeralatan'));
    }

    // ==============================================================
    // 2. FUNGSI UNTUK MENAMPILKAN DETAIL SENSOR (DASHBOARD INDIVIDU)
    // ==============================================================
    public function detail($id_alat)
    {
        // 1. Perbaiki typo nama variabel daftar alat
        $daftarAlat = [
            10 => 'AWS Stageof Bandung', 1 => 'AWS UI', 5 => 'AWS Kebun Bibit Cibubur',
            8 => 'AWS Sukamandi', 9 => 'AWS SMPK Bojong Picung', 7 => 'AWS Sukaraja',
            6 => 'AWS Jagorawi', 4 => 'AWS Leuwiliang', 2 => 'AWS IPB',
            3 => 'AWS Cisolok', 14 => 'PJT II Gabus', 12 => 'PJT II Muara',
            13 => 'PJT II Jatiasih', 11 => 'ARG Rekayasa Cisadane'
        ];

        // 2. Tentukan nama site dan jenis alat
        $nama_site = $daftarAlat[$id_alat] ?? 'Unknown Site';
        $jenis_alat = 'AWS'; 
        if (strpos(strtolower($nama_site), 'arg') !== false || strpos(strtolower($nama_site), 'pjt') !== false) {
            $jenis_alat = 'ARG'; 
        }

        // 3. Ambil 1 data terbaru berdasarkan tabel yang sesuai
        $namaTabel = ($jenis_alat == 'ARG') ? 'data_arg' : 'data_aws';

        $dataTerakhir = DB::table($namaTabel)
            ->where('id_peralatan', $id_alat)
            ->orderBy('waktu_observasi', 'desc')
            ->first();

        // (Opsional) Mengisi variabel $dataSensor dengan $dataTerakhir 
        // agar kalau di Blade kamu memanggil $dataSensor, web-nya tidak error
        $dataSensor = $dataTerakhir;

        // 4. Siapkan variabel untuk Banner Merah Anomali di View
        $is_anomali = false;
        $pesan_anomali = '';

        if ($dataTerakhir) {
            $list_error = [];
            if (isset($dataTerakhir->status_qc_range) && $dataTerakhir->status_qc_range == 0) $list_error[] = "Range Check Error";
            if (isset($dataTerakhir->status_qc_step) && $dataTerakhir->status_qc_step == 0) $list_error[] = "Step Check Error";
            if (isset($dataTerakhir->flag_missing) && $dataTerakhir->flag_missing == 1) $list_error[] = "Data Missing / Imputasi";

            if (count($list_error) > 0) {
                $is_anomali = true;
                $pesan_anomali = implode(', ', $list_error);
            }
        }

        // 5. Kirim semua data ke tampilan web (cuma boleh ada 1 return di bagian akhir)
        return view('dashboard_detail', compact('id_alat', 'nama_site', 'jenis_alat', 'dataTerakhir', 'dataSensor', 'is_anomali', 'pesan_anomali'));
    }

    // ==============================================================
    // 3. FUNGSI UNTUK HALAMAN TABEL DATA KESELURUHAN
    // ==============================================================
    public function halamanData()
    {
        // AMBIL SEMUA DATA TERBARU AWS (NORMAL & ANOMALI)
        $logDataAWS = DB::table('data_aws')
            ->orderBy('waktu_observasi', 'desc')
            ->limit(100) 
            ->get();

        // AMBIL SEMUA DATA TERBARU ARG (NORMAL & ANOMALI)
        $logDataARG = DB::table('data_arg')
            ->orderBy('waktu_observasi', 'desc') 
            ->limit(100)
            ->get();

        return view('data_page', compact('logDataAWS', 'logDataARG'));
    }
}