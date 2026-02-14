<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ganti Password | ONMAI</title>

    <link rel="icon" type="image/png" href="{{ asset('landing-page/assets/img/img1.png') }}" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600,700,800" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,300,700" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: '#ffc800',
                    },
                    fontFamily: {
                        heading: ['Montserrat', 'sans-serif'],
                        body: ['Roboto Slab', 'serif'],
                    }
                }
            }
        }
    </script>

    <style>
        body { font-family: 'Roboto Slab', serif; }
        
        /* Animasi Masuk */
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in-up {
            animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        }

        /* Background Pattern */
        .bg-pattern {
            background-color: #111827;
            background-image: radial-gradient(#374151 1px, transparent 1px);
            background-size: 30px 30px;
        }

        /* Fix Icon Position Absolute */
        .input-icon-wrapper {
            position: relative;
            width: 100%;
        }
        .input-icon-left {
            position: absolute;
            top: 50%;
            left: 1rem;
            transform: translateY(-50%);
            color: #9ca3af;
            pointer-events: none;
            z-index: 10;
        }
        .input-icon-right {
            position: absolute;
            top: 50%;
            right: 1rem;
            transform: translateY(-50%);
            color: #9ca3af;
            cursor: pointer;
            z-index: 10;
        }
        /* Memaksa input field punya padding yang pas */
        .form-input-field {
            padding-left: 3rem !important; /* Jarak untuk icon kiri */
            padding-right: 3rem !important; /* Jarak untuk icon kanan */
        }
    </style>
</head>

<body class="bg-pattern flex items-center justify-center min-h-screen selection:bg-brand selection:text-black text-gray-800">

    <div class="w-full max-w-md p-6 animate-fade-in-up">

        <div class="bg-white rounded-3xl shadow-2xl overflow-hidden relative group">
            
            <div class="h-2 w-full bg-brand"></div>

            <div class="px-8 pt-10 pb-6 text-center">
                <a href="{{ url('/') }}" class="inline-flex items-center gap-3 mb-6 hover:scale-105 transition-transform duration-300">
                    <img src="{{ asset('landing-page/assets/img/img1.png') }}" class="h-12 w-auto drop-shadow-md" alt="Logo">
                    <span class="text-2xl font-extrabold font-heading text-gray-900 tracking-tight">
                        ON<span class="text-brand">MAI</span>
                    </span>
                </a>

                <h2 class="text-2xl font-bold text-gray-900 font-heading tracking-wide">
                    Keamanan Akun
                </h2>
                <p class="text-gray-500 mt-2 text-sm font-light">
                    Perbarui password Anda secara berkala demi keamanan.
                </p>
            </div>

            <div class="px-8 pb-10">

                @if(session('success'))
                    <div class="mb-6 flex items-center bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl text-sm shadow-sm">
                        <i class="fas fa-check-circle text-lg mr-3"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="mb-6 bg-red-50 border border-red-200 text-red-600 p-4 rounded-xl text-sm shadow-sm">
                        <div class="flex items-center mb-2 font-bold">
                            <i class="fas fa-exclamation-triangle mr-2"></i> Terjadi Kesalahan
                        </div>
                        <ul class="list-disc list-inside space-y-1 ml-1 text-gray-600">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('password.update') }}" class="space-y-5">
                    @csrf

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">
                            Password Lama
                        </label>
                        <div class="input-icon-wrapper group focus-within:ring-2 focus-within:ring-brand/50 rounded-xl transition-all">
                            <div class="input-icon-left">
                                <i class="fas fa-lock group-focus-within:text-brand transition-colors"></i>
                            </div>
                            
                            <input type="password" name="current_password" required placeholder="••••••••"
                                class="form-input-field w-full py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-brand transition-all duration-300 password-input">
                            
                            <button type="button" class="input-icon-right toggle-password" tabindex="-1">
                                <i class="fas fa-eye hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">
                            Password Baru
                        </label>
                        <div class="input-icon-wrapper group focus-within:ring-2 focus-within:ring-brand/50 rounded-xl transition-all">
                            <div class="input-icon-left">
                                <i class="fas fa-key group-focus-within:text-brand transition-colors"></i>
                            </div>
                            <input type="password" name="password" required placeholder="Minimal 8 karakter"
                                class="form-input-field w-full py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-brand transition-all duration-300 password-input">
                            
                            <button type="button" class="input-icon-right toggle-password" tabindex="-1">
                                <i class="fas fa-eye hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-wider mb-2 ml-1">
                            Konfirmasi Password
                        </label>
                        <div class="input-icon-wrapper group focus-within:ring-2 focus-within:ring-brand/50 rounded-xl transition-all">
                            <div class="input-icon-left">
                                <i class="fas fa-check-circle group-focus-within:text-brand transition-colors"></i>
                            </div>
                            <input type="password" name="password_confirmation" required placeholder="Ulangi password baru"
                                class="form-input-field w-full py-3.5 rounded-xl border border-gray-200 bg-gray-50 text-gray-900 placeholder-gray-400 focus:outline-none focus:bg-white focus:border-brand transition-all duration-300 password-input">
                            
                            <button type="button" class="input-icon-right toggle-password" tabindex="-1">
                                <i class="fas fa-eye hover:text-gray-600"></i>
                            </button>
                        </div>
                    </div>

                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-4 rounded-xl bg-brand hover:bg-yellow-400 text-gray-900 font-extrabold font-heading tracking-widest transition-all duration-300 shadow-lg shadow-yellow-500/30 hover:shadow-yellow-500/50 hover:-translate-y-1 flex justify-center items-center gap-2 group">
                            <span>SIMPAN PERUBAHAN</span>
                            <i class="fas fa-arrow-right text-sm transition-transform group-hover:translate-x-1"></i>
                        </button>
                    </div>

                </form>

                <div class="mt-8 text-center">
                    <a href="{{ route('ruang.index') }}"
                        class="inline-flex items-center gap-2 text-sm font-semibold text-gray-400 hover:text-gray-800 transition-colors duration-300">
                        <i class="fas fa-arrow-left text-xs"></i>
                        <span>Kembali ke Dashboard</span>
                    </a>
                </div>

            </div>
        </div>

        <div class="text-center mt-8">
            <p class="text-xs text-gray-500 font-medium opacity-50">
                &copy; {{ date('Y') }} ONMAI Learning Center. <br>Secure System.
            </p>
        </div>

    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                // Cari input terdekat dalam parent yang sama
                const wrapper = this.closest('.input-icon-wrapper');
                const input = wrapper.querySelector('.password-input');
                const icon = this.querySelector('i');

                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                    this.style.color = '#ffc800'; // Brand color saat visible
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                    this.style.color = '#9ca3af'; // Gray color saat hidden
                }
            });
        });
    </script>

</body>
</html>