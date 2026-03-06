<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail - {{ $nama_site }}</title>
    
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
   <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'ABeeZee', sans-serif; }
        body { background-color: #FFFFFF; display: flex; justify-content: center; align-items: center; min-height: 100vh; padding: 10px; }
        
        /* CONTAINER DINAMIS */
        .home-container { 
            display: flex; 
            width: 100%; 
            max-width: 1000px; 
            height: 90vh; 
            background: rgba(255, 245, 245, 0.15); 
            box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.25); 
            border-radius: 20px; 
            overflow: hidden; 
        }

        .sidebar { width: 220px; background: #9AFCFF; display: flex; flex-direction: column; padding-top: 30px; border-right: 1px solid rgba(0,0,0,0.1); z-index: 10; }
        .sidebar-logos { display: flex; justify-content: space-evenly; align-items: center; margin-bottom: 40px; }
        .logo-small { width: 50px; height: 50px; background-color: #fff; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px; text-align: center; border: 1px solid #ddd; font-weight: bold;}
        
        .nav-menu { display: flex; flex-direction: column; flex-grow: 1; }
        .nav-item { display: flex; align-items: center; padding: 15px 25px; text-decoration: none; color: #000000; font-size: 18px; border-bottom: 1px solid #000000; transition: 0.3s; }
        .nav-item.active, .nav-item:hover { background-color: rgba(255,255,255,0.4); font-weight: bold;}
        .nav-item.first-item { border-top: 1px solid #000000; }
        
        .logout-btn { display: flex; align-items: center; padding: 15px 25px; text-decoration: none; color: #000000; font-size: 18px; border-top: 1px solid #000000; margin-bottom: 20px; }
        .logout-btn:hover { background-color: #ffcccc; }

        .main-content { flex: 1; display: flex; flex-direction: column; padding: 25px; background-color: #FAFAFA; position: relative; overflow-y: auto; }
        
        .header-detail { display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px; border-bottom: 2px solid #ddd; padding-bottom: 10px; }
        .header-detail h2 { font-weight: bold; color: #333; font-size: 20px; }
        .btn-back { background: #333; padding: 8px 15px; border-radius: 8px; text-decoration: none; color: #fff; font-size: 13px; transition: 0.3s; font-weight: bold; box-shadow: 0 2px 4px rgba(0,0,0,0.2); white-space: nowrap;}
        .btn-back:hover { background: #555; }

        .alert-box { background-color: #ffe6e6; border-left: 5px solid #ff4d4d; padding: 12px; border-radius: 8px; margin-bottom: 15px; font-size: 13px; color: #cc0000; font-weight: bold; }
        .time-container { display: flex; gap: 15px; margin-bottom: 20px; justify-content: center; flex-wrap: wrap; }
        .time-pill { background-color: #e9ecef; padding: 6px 20px; border-radius: 15px; font-size: 13px; font-weight: bold; color: #444; border: 1px solid #ccc; white-space: nowrap;}

        .grid-container { display: grid; grid-template-columns: repeat(3, 1fr); gap: 15px; padding-bottom: 20px; }
        .card { background: #fff; padding: 20px 10px; border-radius: 12px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); text-align: center; border-bottom: 5px solid #9AFCFF; transition: transform 0.2s; }
        .card:hover { transform: translateY(-3px); box-shadow: 0 6px 10px rgba(0,0,0,0.1); }
        .card h3 { font-size: 13px; color: #555; font-weight: bold; margin-bottom: 10px; display: flex; align-items: center; justify-content: center; gap: 5px; }
        .card .value { font-size: 32px; color: #222; font-weight: bold; line-height: 1; }
        .card .unit { font-size: 12px; color: #888; font-weight: normal; margin-top: 5px; display: block; }

        .empty-state { text-align: center; margin-top: 60px; color: #666; }
        .empty-state i { font-size: 50px; color: #ccc; margin-bottom: 15px; }
        .empty-state p { font-size: 16px; font-weight: bold; }

        /* ========================================================
           KODE KHUSUS HP (Halaman Detail)
           ======================================================== */
        @media (max-width: 768px) {
            body { padding: 0; }
            .home-container { height: 100vh; flex-direction: column; border-radius: 0; }
            .sidebar { width: 100%; height: auto; padding-top: 10px; border-right: none; border-bottom: 2px solid #ddd; }
            .sidebar-logos { display: none; }
            
            .nav-menu { flex-direction: row; overflow-x: auto; padding-bottom: 5px; }
            .nav-item { padding: 8px 15px; font-size: 14px; border: none !important; white-space: nowrap; }
            .logout-btn { padding: 8px 15px; font-size: 14px; margin: 0; border: none; white-space: nowrap; }
            
            .main-content { padding: 15px; }
            
            /* Susunan judul dan tombol kembali menyesuaikan layar */
            .header-detail { flex-direction: column; align-items: flex-start; gap: 10px; }
            h2 { font-size: 18px; }
            
            /* Grid Data Suhu dll diubah jadi 2 kolom agar tidak gepeng */
            .grid-container { grid-template-columns: repeat(2, 1fr); gap: 10px; }
            .card .value { font-size: 24px; }
        }
    </style>
</head>
<body>

    <div class="home-container">
        <div class="sidebar">
            <div class="sidebar-logos">
                <div class="logo-small">Logo<br>BMKG</div>
                <div class="logo-small">Logo<br>JABAR</div>
            </div>

            <div class="nav-menu">
                <a href="{{ url('/home') }}" class="nav-item first-item">🏠 Home</a>
                <a href="{{ url('/dashboard') }}" class="nav-item active">📊 Dashboard</a>
                <a href="{{ url('/data') }}" class="nav-item">🗄️ Data</a>
            </div>

            <a href="{{ url('/logout') }}" class="logout-btn">🚪 Log out</a>
        </div>

        <div class="main-content">
            <div class="header-detail">
                <h2>{{ $nama_site }}</h2>
                <a href="{{ url('/dashboard') }}" class="btn-back"><i class="fas fa-arrow-left"></i> Kembali ke Map</a>
            </div>

            @if($dataTerakhir)
                @php
                    $waktu_observasi = \Carbon\Carbon::parse($dataTerakhir->waktu_observasi);
                @endphp

                @if(isset($is_anomali) && $is_anomali)
                    <div class="alert-box">
                        <i class="fas fa-exclamation-triangle"></i> 
                        Terjadi Anomali ({{ $pesan_anomali }})
                    </div>
                @endif

                <div class="time-container">
                    <div class="time-pill"><i class="fas fa-calendar-alt"></i> Tanggal : {{ $waktu_observasi->format('d-m-Y') }}</div>
                    <div class="time-pill"><i class="fas fa-clock"></i> Waktu : {{ $waktu_observasi->format('H:i:s') }} WIB</div>
                </div>

                <div class="grid-container">
                    @if($jenis_alat == 'AWS')
                        <div class="card">
                            <h3><i class="fas fa-thermometer-half"></i> Suhu</h3>
                            <div class="value">{{ isset($dataTerakhir->suhu) ? number_format((float)$dataTerakhir->suhu, 2) : '-' }}</div>
                            <span class="unit">(°C)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-tint"></i> Kelembapan</h3>
                            <div class="value">{{ isset($dataTerakhir->kelembapan) ? number_format((float)$dataTerakhir->kelembapan, 2) : '-' }}</div>
                            <span class="unit">(%)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-cloud-showers-heavy"></i> Curah Hujan</h3>
                            <div class="value">{{ isset($dataTerakhir->curah_hujan) ? number_format((float)$dataTerakhir->curah_hujan, 2) : '0' }}</div>
                            <span class="unit">(mm)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-wind"></i> Kecepatan Angin</h3>
                            <div class="value">{{ isset($dataTerakhir->kecepatan_angin) ? number_format((float)$dataTerakhir->kecepatan_angin, 2) : '-' }}</div>
                            <span class="unit">(m/s)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-compass"></i> Arah Angin</h3>
                            <div class="value">{{ isset($dataTerakhir->arah_angin) ? number_format((float)$dataTerakhir->arah_angin, 2) : '-' }}</div>
                            <span class="unit">(°)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-sun"></i> Radiasi Matahari</h3>
                            <div class="value">{{ isset($dataTerakhir->radiasi_matahari) ? number_format((float)$dataTerakhir->radiasi_matahari, 2) : '-' }}</div>
                            <span class="unit">(W/m²)</span>
                        </div>
                    @endif

                    @if($jenis_alat == 'ARG')
                        <div class="card">
                            <h3><i class="fas fa-cloud-showers-heavy"></i> Curah Hujan</h3>
                            <div class="value">{{ isset($dataTerakhir->curah_hujan) ? number_format((float)$dataTerakhir->curah_hujan, 2) : '0' }}</div>
                            <span class="unit">(mm)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-battery-three-quarters"></i> Tegangan Baterai</h3>
                            <div class="value">{{ isset($dataTerakhir->baterai) ? number_format((float)$dataTerakhir->baterai, 2) : '-' }}</div>
                            <span class="unit">(Volt)</span>
                        </div>
                        <div class="card">
                            <h3><i class="fas fa-temperature-low"></i> Suhu Logger</h3>
                            <div class="value">{{ isset($dataTerakhir->log_temp) ? number_format((float)$dataTerakhir->log_temp, 2) : '-' }}</div>
                            <span class="unit">(°C)</span>
                        </div>
                    @endif
                </div>

            @else
                <div class="empty-state">
                    <i class="fas fa-folder-open"></i>
                    <p>Belum ada data masuk untuk stasiun ini.</p>
                </div>
            @endif

        </div>
    </div>

    <script>
        setInterval(function() {
            window.location.href = window.location.href.split('?')[0] + "?t=" + new Date().getTime();
        }, 60000); 
    </script>
</body>
</html>