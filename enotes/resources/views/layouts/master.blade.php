<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Notes App - @yield('title')</title>

    {{-- Favicon --}}
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    
    {{-- Bootstrap 4, Font Awesome, DataTables CDN --}}
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/dataTables.bootstrap4.min.css">

    <style>

        body { 
            background-color: #121212 !important; 
            color: #e0e0e0; 
            padding-bottom: 80px; 
            font-family: sans-serif; 
        }
        
        /* Navbar */
        .navbar { 
            background-color: #1f1f1f !important; 
            border-bottom: 1px solid #333; 
            box-shadow: 0 2px 4px rgba(0,0,0,.5); 
        }
        .navbar-dark .navbar-nav .nav-link { color: rgba(255,255,255,.75); }
        .navbar-dark .navbar-nav .nav-link.active { color: #fff; font-weight: bold; }
        .navbar-dark .navbar-nav .nav-link:hover { color: #fff; }
        
        /* Card Styles */
        .card { 
            background-color: #1e1e1e; 
            border: 1px solid #333; 
            border-top: 4px solid #007bff; 
        }
        .card:hover { 
            transform: translateY(-5px); 
            box-shadow: 0 10px 20px rgba(0,0,0,.5) !important; 
            background-color: #252525;
            transition: all 0.3s ease; 
        }
        .card-title, h1, h2, h3, h4, h5, h6 { color: #fff !important; }
        .text-muted { color: #b0b0b0 !important; }
        .card-header, .card-footer { background-color: transparent; border-color: #333; color: #fff; }
        
        /* Form Inputs */
        .form-control { 
            background-color: #2b2b2b; 
            border: 1px solid #444; 
            color: #fff; 
        }
        .form-control:focus { 
            background-color: #333; 
            border-color: #007bff; 
            color: #fff; 
            box-shadow: none; 
        }
        .form-control::placeholder { color: #aaa; }
        
        /* Search Bar Glow */
        .input-search-premium {
            background-color: #2b2b2b !important;
            border: 1px solid #444;
            color: #fff !important;
            border-radius: 50px 0 0 50px !important;
            padding-left: 20px;
            height: 45px;
            transition: all 0.3s;
        }
        .input-search-premium:focus {
            background-color: #333 !important;
            border-color: #007bff;
            box-shadow: 0 0 15px rgba(0, 123, 255, 0.5);
            z-index: 10;
        }
        .btn-search-premium {
            border-radius: 0 50px 50px 0 !important;
            background: linear-gradient(45deg, #007bff, #0056b3);
            border: none; color: white; padding: 0 25px; height: 45px;
        }
        .btn-search-premium:hover { background: linear-gradient(45deg, #0056b3, #004494); }

        /* Buttons Premium (Gradient & Lift) */
        .btn-premium {
            border: none; border-radius: 50px; padding: 8px 20px;
            font-weight: 600; transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            box-shadow: 0 4px 6px rgba(0,0,0,0.3);
            display: inline-flex; align-items: center; justify-content: center;
        }
        .btn-premium:hover { transform: translateY(-3px) scale(1.02); box-shadow: 0 8px 15px rgba(0,0,0,0.5); }
        
        /* Varian Warna Gradient */
        .btn-gradient-primary { background: linear-gradient(135deg, #007bff, #00c6ff); color: white !important; }
        .btn-gradient-success { background: linear-gradient(135deg, #28a745, #85d66b); color: white !important; }
        .btn-gradient-danger  { background: linear-gradient(135deg, #dc3545, #ff6b6b); color: white !important; }
        .btn-gradient-warning { background: linear-gradient(135deg, #ffc107, #ffe082); color: #212529 !important; }
        .btn-gradient-secondary { background: linear-gradient(135deg, #6c757d, #aab7c4); color: white !important; }

        .account-overlay {
            position: fixed; bottom: 30px; right: 30px;
            background: rgba(30, 30, 30, 0.95); backdrop-filter: blur(10px);
            border: 1px solid #444; padding: 10px 20px; border-radius: 50px;
            display: flex; align-items: center; box-shadow: 0 8px 32px rgba(0,0,0,0.5); z-index: 9999;
            transition: all 0.3s ease;
        }
        .account-overlay:hover { border-color: #007bff; transform: translateY(-3px); }
        .account-avatar { width: 40px; height: 40px; background: linear-gradient(45deg, #007bff, #00c6ff); color: #fff; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 1.2rem; }
        .btn-icon-mini { background: transparent; border: none; cursor: pointer; font-size: 1.1rem; padding: 5px; color: #aaa; transition: 0.2s; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center; }
        .btn-icon-mini:hover { color: #fff; transform: scale(1.1); background-color: rgba(255,255,255,0.1); }
        .btn-icon-mini.text-danger:hover { color: #ff4444 !important; background-color: rgba(255, 68, 68, 0.1); }
    </style>
</head>
<body>

    {{-- A. NAVIGATION BAR --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            {{-- Brand / Logo --}}
            <a class="navbar-brand d-flex flex-column align-items-center p-0" href="{{ route('notes.index') }}">
                <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 40px;" class="mb-1">
                <span style="font-size: 0.7rem; letter-spacing: 1px; line-height: 1;" class="font-weight-bold">E-NOTES</span>
            </a>

            {{-- Right Menu --}}
            <div class="navbar-nav ml-auto align-items-center">
                @auth
                    {{-- Menu: Daftar Catatan --}}
                    <a class="nav-item nav-link {{ request()->is('notes*') ? 'active' : '' }}" href="{{ route('notes.index') }}">
                        <i class="fas fa-list mr-1"></i> Daftar Catatan
                    </a>
                    {{-- Menu: Data User (Admin) --}}
                    <a class="nav-item nav-link {{ request()->is('users*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                        <i class="fas fa-users mr-1"></i> Data User
                    </a>
                    {{-- Menu: Ganti Password --}}
                    <a class="nav-item nav-link {{ request()->is('password/change') ? 'active' : '' }}" href="{{ route('password.change') }}">
                        <i class="fas fa-lock mr-1"></i> Ganti Pass
                    </a>
                @else
                    <a class="nav-link" href="{{ route('login') }}">Login</a>
                    @if (Route::has('register'))
                        <a class="nav-link" href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    {{-- B. MAIN CONTENT --}}
    <div class="container">
        @yield('content')
    </div>

    {{-- C. FOOTER (CLEAN VERSION) --}}
    <footer class="text-center mt-5 mb-3 text-muted small" style="font-family: 'Courier New', monospace;">
        > developer: <a href="https://instagram.com/pcfndr_" target="_blank" class="text-secondary" style="text-decoration: none;">pcfndr_</a>
        <br>
        > status: all systems operational. &copy; {{ date('Y') }}
    </footer>

    {{-- D. FLOATING USER WIDGET (Auth Only) --}}
    @auth
    <div class="account-overlay">
        {{-- Avatar --}}
        <div class="account-avatar"><i class="fas fa-user"></i></div>
        
        {{-- Info --}}
        <div class="d-flex flex-column mx-3">
            <span class="font-weight-bold text-white" style="font-size: 0.9rem;">{{ Auth::user()->name }}</span>
            <span style="font-size: 0.7rem; color: #28a745;">● Online</span>
        </div>

        {{-- Actions --}}
        <div class="d-flex align-items-center" style="border-left: 1px solid #555; padding-left: 10px;">
            {{-- Hapus Akun Sendiri --}}
            <button type="button" class="btn-icon-mini text-danger mr-1" title="Hapus Akun Permanen" 
                    data-toggle="modal" data-target="#deleteAccountModal">
                <i class="fas fa-user-times"></i>
            </button>
            {{-- Logout --}}
            <a href="{{ route('logout') }}" class="btn-icon-mini" title="Logout"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
            </a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">@csrf</form>
    </div>

    {{-- MODAL HAPUS AKUN (GLOBAL) --}}
    <div class="modal fade" id="deleteAccountModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="background-color: #1e1e1e; border: 1px solid #ff4444; color: #fff;">
                <div class="modal-header border-0 pb-0">
                    <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body text-center pt-0 pb-4 px-4">
                    <div class="mb-3 text-danger"><i class="fas fa-skull-crossbones fa-3x"></i></div>
                    <h4 class="font-weight-bold text-danger mb-3">Hapus Akun Permanen?</h4>
                    <p class="text-muted mb-4">Semua catatan akan hilang selamanya. Yakin?</p>
                    <form action="{{ route('account.delete') }}" method="POST">
                        @csrf @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-block font-weight-bold py-2 rounded-pill shadow-sm">
                            <i class="fas fa-bomb mr-2"></i>YA, HAPUS AKUN SAYA
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endauth

    {{-- E. SCRIPTS --}}
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            // 1. Input File Name Fix
            $(document).on('change', '.custom-file-input', function() {
                let fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass("selected").html(fileName);
            });

            // 2. Image Preview Logic
            function readURL(input, previewId) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $(previewId).attr('src', e.target.result).show();
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#fileInput").change(function() { readURL(this, '#imagePreviewCreate'); });
            $("#fileInputEdit").change(function() { readURL(this, '#imagePreviewEdit'); });

            // 3. Auto Close Alert
            setTimeout(function() { 
                $(".alert").fadeTo(500, 0).slideUp(500, function(){ $(this).remove(); }); 
            }, 5000);
        });
    </script>

</body>
</html>