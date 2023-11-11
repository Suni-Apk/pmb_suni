<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('layouts.include')
    <title>Oops!</title>
    <style>
        a.btn-back {
            background: rgba(255, 255, 255, .2);
            backdrop-filter: blur(4px);
        }

        a.btn-back:hover i {
            animation: HoveringBtn 1s ease 0s infinite normal forwards;
        }

        @keyframes HoveringBtn {
            0% {
                animation-timing-function: ease-in;
                opacity: 1;
                transform: translateX(0px);
            }

            50% {
                animation-timing-function: ease-out;
                opacity: 1;
                transform: translateX(-5px);
            }

            100% {
                animation-timing-function: ease-out;
                opacity: 1;
                transform: translateX(0px);
            }
        }

        .error-section h1 {
            font-size: 8rem;
            letter-spacing: -13px;
            line-height: 1;
            font-family: 'montserrat', sans-serif;
        }

        h1 span {
            text-shadow: -10px 0 0 #e9ecef;
        }
    </style>
</head>
<body class="overflow-hidden min-vh-100 p-4">
    <a href="{{ route('welcome') }}" class="btn-back btn btn-outline-dark rounded-pill position-fixed" style="top: 2.5rem; left: 3rem;">
        <i class="fas fa-arrow-left me-1"></i> Kembali ke home
    </a>
    
    <div class="error-section w-100 min-vh-80 shadow-xl row ms-0 justify-content-center align-items-center bg-light rounded-4">
        <div class="col-10 col-md-4 mb-0 mt-4 mt-md-0">
            <h1 class="text-dark"><span>4</span><span>0</span><span>4</span></h1>
            <h2 class="text-dark">Oops! Page not found</h2>
            <p class="mb-0 text-secondary">Halaman yang anda cari tidak dapat ditemukan</p>
        </div>
        <div class="col-12 col-md-4 mb-4 mb-md-0">
            <img src="/soft-ui-dashboard-main/assets/img/404-2.svg" alt="" class="img-fluid">
        </div>
    </div>

    @include('auth.layouts.footer')
</body>
</html>
