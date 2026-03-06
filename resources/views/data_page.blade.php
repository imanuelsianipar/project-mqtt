<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imputasi Data - SIPANCAR</title>
    
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'ABeeZee', sans-serif; }
        body { background-color: #FFFFFF; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 10px; }
        
        /* 1. CONTAINER - Dibuat Fleksibel (Tidak kaku 1000px lagi) */
        .home-container { 
            display: flex; 
            width: 100%; 
            max-width: 1000px; 
            height: 90vh; /* Mengikuti tinggi layar */
            background: rgba(255, 245, 245, 0.15); 
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
            border-radius: 20px; 
            overflow: hidden; 
        }

        /* SIDEBAR */
        .sidebar { width: 220px; background: #9AFCFF; display: flex; flex-direction: column; padding-top: 30px; border-right: 1px solid rgba(0,0,0,0.1); z-index: 10; }
        .sidebar-logos { display: flex; justify-content: space-evenly; align-items: center; margin-bottom: 40px; }
        .logo-small { width: 50px; height: 50px; background-color: #fff; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px; text-align: center; border: 1px solid #ddd; font-weight: bold;}
        
        /* MENU NAVIGASI */
        .nav-menu { display: flex; flex-direction: column; flex-grow: 1; }
        .nav-item { display: flex; align-items: center; padding: 15px 25px; text-decoration: none; color: #000000; font-size: 18px; border-bottom: 1px solid #000000; transition: 0.3s; }
        .nav-item.active, .nav-item:hover { background-color: rgba(255,255,255,0.4); font-weight: bold;}
        .nav-item.first-item { border-top: 1px solid #000000; }
        
        .logout-btn { display: flex; align-items: center; padding: 15px 25px; text-decoration: none; color: #000000; font-size: 18px; border-top: 1px solid #000000; margin-bottom: 20px; transition: 0.3s;}
        .logout-btn:hover { background-color: #ffcccc; }

        /* MAIN CONTENT */
        .main-content { flex: 1; display: flex; flex-direction: column; padding: 25px; background-color: #FAFAFA; position: relative; overflow: hidden; }
        h2 { margin-bottom: 5px; font-weight: bold; color: #000000; font-size: 24px; }
        p.subtitle { font-size: 13px; color: #666; margin-bottom: 15px; }

        /* TOMBOL TAB */
        .tab-container { display: flex; margin-bottom: 15px; background: #eee; border-radius: 8px; overflow: hidden; width: max-content; box-shadow: 0 2px 5px rgba(0,0,0,0.05); }
        .tab-btn { padding: 10px 20px; border: none; background: transparent; cursor: pointer; font-size: 14px; font-weight: bold; color: #555; transition: 0.3s; }
        .tab-btn.active { background: #3498db; color: #fff; }

        /* 2. WADAH TABEL - Ditambah overflow-x agar bisa digeser */
        .table-wrapper { 
            flex: 1; 
            position: relative; 
            border-radius: 10px; 
            border: 1px solid #ddd; 
            overflow-y: auto; 
            overflow-x: auto; /* SAKTI: Mengaktifkan geser horizontal */
            background: #fff; 
            display: none; 
            box-shadow: 0 4px 6px rgba(0,0,0,0.05); 
        }
        .table-wrapper.active { display: block; }
        
        table { width: 100%; border-collapse: collapse; text-align: center; }
        /* SAKTI: white-space nowrap mencegah teks numpuk ke bawah */
        th, td { padding: 12px 8px; font-size: 13px; border-bottom: 1px solid #eee; color: #000; white-space: nowrap; }
        th { background-color: #f8f9fa; color: #000; font-weight: bold; position: sticky; top: 0; z-index: 2; box-shadow: 0 2px 2px -1px rgba(0,0,0,0.1); }
        
        tr { background-color: #fff; transition: 0.2s; }
        tr:hover { background-color: #f1f8ff; }
        
        .badge { padding: 5px 10px; border-radius: 6px; font-size: 11px; font-weight: bold; display: inline-block; border: 1px solid rgba(0,0,0,0.1); }
        .badge-range { background: #F8D7DA; color: #721C24; }
        .badge-step { background: #D4EDDA; color: #155724; }
        .badge-missing { background: #D1ECF1; color: #0C5460; }
        
        .text-imputasi { color: #E74C3C; font-weight: bold; }
        .label-imputasi { font-size: 10px; color: #E74C3C; display: block; margin-top: 2px; }
        
        .table-wrapper::-webkit-scrollbar { width: 8px; height: 8px; }
        .table-wrapper::-webkit-scrollbar-thumb { background: #bbb; border-radius: 10px; }
        .empty-state { text-align: center; margin-top: 50px; color: #27ae60; font-weight: bold; font-size: 16px; }

        /* ========================================================
           3. KODE KHUSUS HP (MEDIA QUERY) - Biar layarnya pas!
           ======================================================== */
        @media (max-width: 768px) {
            body { padding: 0; }
            .home-container { 
                height: 100vh; 
                flex-direction: column; /* Sidebar pindah ke atas */
                border-radius: 0; 
            }
            .sidebar { 
                width: 100%; 
                height: auto; 
                padding-top: 10px; 
                border-right: none; 
                border-bottom: 2px solid #ddd; 
            }
            .sidebar-logos { display: none; } /* Sembunyikan logo biar hemat layar HP */
            
            /* Ubah menu menjadi menyamping dan bisa digeser */
            .nav-menu { flex-direction: row; overflow-x: auto; padding-bottom: 5px; }
            .nav-item { padding: 8px 15px; font-size: 14px; border: none !important; white-space: nowrap; }
            .logout-btn { padding: 8px 15px; font-size: 14px; margin: 0; border: none; white-space: nowrap; }
            
            .main-content { padding: 15px; }
            h2 { font-size: 18px; }
            .tab-btn { padding: 8px 12px; font-size: 12px; }
        }
    </style>
</head>
<body>

    @php
        $daftarStasiun = [
            1 => 'UI', 2 => 'IPB', 3 => 'Cisolok', 4 => 'Cibeureum',
            5 => 'Kebun Bibit', 6 => 'Jagorawi', 7 => 'Sukaraja',
            8 => 'Sukamandi', 9 => 'Bojongpicung', 10 => 'Stageof Bandung',
            11 => 'ARG Cisadane', 12 => 'PJT II Muara', 13 => 'PJT II Jatiasih', 14 => 'PJT II Gabus'
        ];
    @endphp

    <div class="home-container">
        <div class="sidebar">
            <div class="sidebar-logos">
                <div class="logo-small">Logo<br>BMKG</div>
                <div class="logo-small">Logo<br>JABAR</div>
            </div>
            <div class="nav-menu">
                <a href="{{ url('/home') }}" class="nav-item first-item">🏠 Home</a>
                <a href="{{ url('/dashboard') }}" class="nav-item">📊 Dashboard</a>
                <a href="{{ url('/imputasi') }}" class="nav-item active">🗄️ Hasil Imputasi</a>
            </div>
            <a href="{{ url('/logout') }}" class="logout-btn">🚪 Log out</a>
        </div>

        <div class="main-content">
            <h2>Hasil Imputasi Data</h2>
            <p class="subtitle">Menampilkan data anomali yang telah dipulihkan oleh AI menggunakan Regresi Linear (Y = a + bX).</p>

            <div class="tab-container">
                <button class="tab-btn active" onclick="bukaTab('aws')">📡 Data AWS</button>
                <button class="tab-btn" onclick="bukaTab('arg')">🌧️ Data ARG</button>
            </div>

            <div id="aws-table" class="table-wrapper active">
                <table>
                    <thead>
                        <tr>
                            <th>Waktu (WIB)</th>
                            <th>Nama Peralatan</th>
                            <th>Suhu (°C)</th>
                            <th>RH (%)</th>
                            <th>Angin (m/s)</th>
                            <th>Arah (°)</th>
                            <th>Hujan (mm)</th>
                            <th>Radiasi</th>
                            <th>Status Error</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $countAWS = 0; @endphp
                        @foreach($logDataAWS as $data)
                            @php
                                $id_alat = (int) $data->id_peralatan;
                                $namaPeralatan = $daftarStasiun[$id_alat] ?? $data->id_peralatan;
                                
                                // Cek apakah baris ini mengalami imputasi
                                $isImputed = ($data->flag_missing == 1 || $data->status_qc_range == 0 || $data->status_qc_step == 0);
                            @endphp
                            
                            @if($isImputed)
                                @php $countAWS++; @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($data->waktu_observasi)->format('Y-m-d H:i:s') }}</td>
                                    <td><b>{{ $namaPeralatan }}</b></td>
                                    
                                    <td class="text-imputasi">{{ $data->suhu }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->kelembapan }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->kecepatan_angin }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->arah_angin }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->curah_hujan }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->radiasi_matahari }} <span class="label-imputasi">(Imputasi)</span></td>
                                    
                                    <td>
                                        @if($data->flag_missing == 1) <span class="badge badge-missing">Missing Check</span>
                                        @elseif($data->status_qc_range == 0) <span class="badge badge-range">Range Check</span>
                                        @elseif($data->status_qc_step == 0) <span class="badge badge-step">Step Check</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @if($countAWS == 0) 
                    <div class="empty-state">✅ Alat AWS Berjalan Normal. Belum ada hasil imputasi.</div> 
                @endif
            </div>

            <div id="arg-table" class="table-wrapper">
                <table>
                    <thead>
                        <tr>
                            <th>Waktu (WIB)</th>
                            <th>Nama Peralatan</th>
                            <th>Curah Hujan (mm)</th>
                            <th>Suhu Logger (°C)</th>
                            <th>Baterai (Volt)</th>
                            <th>Status Error</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $countARG = 0; @endphp
                        @foreach($logDataARG as $data)
                            @php
                                $id_alat = (int) $data->id_peralatan;
                                $namaPeralatan = $daftarStasiun[$id_alat] ?? $data->id_peralatan;

                                // Cek apakah baris ini mengalami imputasi
                                $isImputed = ($data->flag_missing == 1 || $data->status_qc_range == 0 || $data->status_qc_step == 0);
                            @endphp
                            
                            @if($isImputed)
                                @php $countARG++; @endphp
                                <tr>
                                    <td>{{ \Carbon\Carbon::parse($data->waktu_observasi)->format('Y-m-d H:i:s') }}</td>
                                    <td><b>{{ $namaPeralatan }}</b></td>
                                    
                                    <td class="text-imputasi">{{ $data->curah_hujan }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->log_temp }} <span class="label-imputasi">(Imputasi)</span></td>
                                    <td class="text-imputasi">{{ $data->baterai }} <span class="label-imputasi">(Imputasi)</span></td>
                                    
                                    <td>
                                        @if($data->flag_missing == 1) <span class="badge badge-missing">Missing Check</span>
                                        @elseif($data->status_qc_range == 0) <span class="badge badge-range">Range Check</span>
                                        @elseif($data->status_qc_step == 0) <span class="badge badge-step">Step Check</span>
                                        @endif
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                @if($countARG == 0) 
                    <div class="empty-state">✅ Alat ARG Berjalan Normal. Belum ada hasil imputasi.</div> 
                @endif
            </div>

        </div>
    </div>

    <script>
        function bukaTab(tipe) {
            document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
            document.querySelectorAll('.table-wrapper').forEach(tbl => tbl.classList.remove('active'));
            
            if(tipe === 'aws') {
                document.querySelectorAll('.tab-btn')[0].classList.add('active');
                document.getElementById('aws-table').classList.add('active');
            } else {
                document.querySelectorAll('.tab-btn')[1].classList.add('active');
                document.getElementById('arg-table').classList.add('active');
            }
        }
        
        // Refresh otomatis setiap 1 menit (60000 ms)
        setInterval(function() { window.location.href = window.location.href.split('?')[0] + "?t=" + new Date().getTime(); }, 60000); 
    </script>
</body>
</html>