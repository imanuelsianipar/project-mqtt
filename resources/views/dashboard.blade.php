<!DOCTYPE html>
<html lang="id">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Peta - SIPANCAR</title>
    
    <link href="https://fonts.googleapis.com/css2?family=ABeeZee&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />

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

        /* SIDEBAR */
        .sidebar { width: 220px; background: #9AFCFF; display: flex; flex-direction: column; padding-top: 30px; border-right: 1px solid rgba(0,0,0,0.1); z-index: 10; }
        .sidebar-logos { display: flex; justify-content: space-evenly; align-items: center; margin-bottom: 40px; }
        .logo-small { width: 50px; height: 50px; background-color: #fff; border-radius: 50%; display: flex; justify-content: center; align-items: center; font-size: 10px; text-align: center; border: 1px solid #ddd; font-weight: bold;}
        
        .nav-menu { display: flex; flex-direction: column; flex-grow: 1; }
        .nav-item { display: flex; align-items: center; padding: 15px 25px; text-decoration: none; color: #000000; font-size: 18px; border-bottom: 1px solid #000000; transition: 0.3s; }
        .nav-item.active, .nav-item:hover { background-color: rgba(255,255,255,0.4); font-weight: bold;}
        .nav-item.first-item { border-top: 1px solid #000000; }
        
        .logout-btn { display: flex; align-items: center; padding: 15px 25px; text-decoration: none; color: #000000; font-size: 18px; border-top: 1px solid #000000; margin-bottom: 20px; }
        .logout-btn:hover { background-color: #ffcccc; }

        /* MAIN CONTENT PETA */
        .main-content { flex: 1; display: flex; flex-direction: column; padding: 25px; background-color: #FAFAFA; position: relative; }
        h2 { margin-bottom: 15px; font-weight: bold; color: #333; font-size: 22px; text-align: left;}

        /* WADAH PETA */
        .map-wrapper { flex: 1; position: relative; border-radius: 15px; border: 1px solid #ccc; overflow: hidden; box-shadow: 0 4px 6px rgba(0,0,0,0.05);}
        #map { width: 100%; height: 100%; z-index: 1; }

        /* LEAFLET CUSTOM */
        .leaflet-tooltip-custom { background-color: rgba(255, 255, 255, 0.95); border: 1px solid #ccc; border-radius: 8px; color: #333; padding: 10px; font-size: 13px; box-shadow: 0 2px 10px rgba(0,0,0,0.15); }
        .legend { position: absolute; bottom: 20px; right: 20px; background: white; padding: 12px; border-radius: 10px; border: 1px solid #ccc; z-index: 1000; font-size: 12px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .legend-item { display: flex; align-items: center; margin-bottom: 6px; }
        .legend-item:last-child { margin-bottom: 0; }
        .color-box { width: 14px; height: 14px; border-radius: 50%; margin-right: 10px; border: 1px solid #777; }

        /* ========================================================
           KODE KHUSUS HP (Dashboard Peta)
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
            h2 { font-size: 18px; margin-bottom: 10px; }
            
            /* Penyesuaian legenda di HP agar tidak kebesaran */
            .legend { bottom: 10px; right: 10px; padding: 8px; font-size: 10px; }
            .color-box { width: 10px; height: 10px; margin-right: 5px; }
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

            <a href="{{ url('/') }}" class="logout-btn">🚪 Log out</a>
        </div>

        <div class="main-content">
            <h2>Sebaran & Status Peralatan AWS/ARG</h2>
            
            <div class="map-wrapper">
                <div id="map"></div>
                
                <div class="legend">
                    <div class="legend-item"><div class="color-box" style="background: #2ecc71;"></div> Aman (Normal)</div>
                    <div class="legend-item"><div class="color-box" style="background: #e74c3c;"></div> Anomali (Ada Masalah)</div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
    <script>
        var map = L.map('map').setView([-6.8, 107.4], 8);

        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; OpenStreetMap contributors'
        }).addTo(map);

        var dataAlat = @json($lokasiPeralatan);

        dataAlat.forEach(function(lokasi) {
            var warna = lokasi.status === 1 ? '#2ecc71' : '#e74c3c';

            var marker = L.circleMarker([lokasi.lat, lokasi.lon], {
                radius: 10, fillColor: warna, color: "#fff", weight: 2, opacity: 1, fillOpacity: 0.9
            }).addTo(map);

            var pesanError = '';
            if (lokasi.status === 0) {
                pesanError = `
                    <div style="background:#ffe6e6; color:#cc0000; padding:5px; border-radius:5px; margin-top:5px; font-size:11px; font-weight:bold;">
                        ⚠️ ${lokasi.info_anomali}<br>
                        🕒 Jam: ${lokasi.waktu_anomali} WIB
                    </div>
                `;
            }

            var content = `
                <div style="text-align:center;">
                    <b style="font-size:14px; border-bottom:1px solid #eee; padding-bottom:3px; display:block; margin-bottom:5px;">${lokasi.site}</b>
                    <span style="font-size:11px; color:#777;">ID: ${lokasi.id_alat}</span><br>
                    <span style="color:${warna}; font-weight:bold; display:block; margin-top:3px;">
                        ${lokasi.status === 1 ? '✅ AMAN' : '❌ ANOMALI'}
                    </span>
                    ${pesanError}
                    <small style="color:#3498db; margin-top:8px; display:block; font-weight:bold;">(Klik untuk detail)</small>
                </div>
            `;

            marker.bindTooltip(content, { permanent: false, direction: 'top', className: 'leaflet-tooltip-custom' });

            marker.on('click', function() {
                window.location.href = "{{ url('/dashboard/detail') }}/" + lokasi.id_alat;
            });
        });
    </script>

    <script>
        setInterval(function() {
            window.location.href = window.location.href.split('?')[0] + "?t=" + new Date().getTime();
        }, 60000); 
    </script>
</body>
</html>