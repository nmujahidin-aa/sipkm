<!DOCTYPE html>
<!--
Developer: Nur Mujahidin Achmad Akbar
Website: -
IG: nmujahidin_aa
-->
<html lang="en">
	<!--begin::Head-->
	<head>
		<title>@yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<meta charset="utf-8" />
		<meta property="og:locale" content="en_US" />
		<link rel="shortcut icon" href="{{URL::to('/')}}/assets/media/illustrations/sketchy-1/2.png" />
		<!--begin::Fonts-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
		<!--end::Fonts-->
		<!--begin::Global Stylesheets Bundle(used by all pages)-->
		<link href="{{URL::to('/')}}/assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{URL::to('/')}}/assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
		<link href="{{URL::to('/')}}/vendor/sweetalert/custom.css" rel="stylesheet" type="text/css" />
		<!--end::Global Stylesheets Bundle-->

        <style>
            .bgi-overlay {
                background: linear-gradient(to bottom, rgba(2, 84, 179, 0.7), rgb(130, 251, 255));
                position: relative;
                min-height: 100vh;
            }
        </style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body" style="margin: 0px;">
        @include('sweetalert::alert')
		<!--begin::Main-->
        <div class="row" >
            <div class="col-lg-6 col-sm-12" >
                <div class="d-flex flex-center h-100">
                    @yield('content')
                </div>
            </div>
            <div class="col-lg-6 d-none d-lg-block">
                <div class="bgi-overlay d-flex flex-center h-100">
                    <div class="text-center">
                        <img src="{{URL::to('/')}}/assets/media/illustrations/sketchy-1/2.png" class="w-50 max-w-200px" alt="Background Left" />
                        <div class="mt-5">
                            <div class="fw-bold fs-1"><b>Hai, Pejuang PIMNAS!!!</b></div>
                            <div class="fs-3">Selamat datang di <b>Sistem Informasi dan Manajemen PKM</b> Universitas Negeri Malang</div>
                            <div class="fs-3 text-dark">Satu jiwa untuk UM jadi Juara, Salam Cakrawala</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
		<!--end::Main-->
		<script>var hostUrl = "assets/";</script>
		<script src="{{URL::to('/')}}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{URL::to('/')}}/assets/js/scripts.bundle.js"></script>
		<script src="{{URL::to('/')}}/vendor/sweetalert/custom.js"></script>
	</body>
	<!--end::Body-->
</html>
