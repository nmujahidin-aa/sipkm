<!DOCTYPE html>
<!--
Author: Keenthemes
Product Name: Metronic - Bootstrap 5 HTML, VueJS, React, Angular & Laravel Admin Dashboard Theme
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">
	<!--begin::Head-->
	<head><base href="../../../">
		<title>Masuk | SIPKM-UM</title>
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
                background: linear-gradient(to bottom, rgba(164, 235, 241, 0.7), rgb(255, 255, 255));
                position: relative;
                height: 100vh;
            }

            .background-image-left,
            .background-image-right {
                position: absolute;
                bottom: 0;
                width: 30vw;
                z-index: 1;
            }

            .background-image-left {
                left: 0;
                bottom: -50px;
            }

            .background-image-right {
                right: 0;
                bottom: -50px;
            }

            /* Media query for smaller screens */
            @media (max-width: 768px) {
                .background-image-left,
                .background-image-right {
                    width: 40vw; /* Adjust to make images smaller */
                    bottom: 0; /* Move to align with bottom */
                }

                .background-image-left {
                    left: -10vw; /* Adjust position for smaller screens */
                }

                .background-image-right {
                    right: -10vw; /* Adjust position for smaller screens */
                }
            }

            @media (max-width: 480px) {
                .background-image-left,
                .background-image-right {
                    width: 50vw; /* Make images even smaller for very small screens */
                    bottom: 0;
                }

                .background-image-left {
                    left: -20vw; /* Ensure visibility */
                }

                .background-image-right {
                    right: -20vw; /* Ensure visibility */
                }
            }
        </style>
	</head>
	<!--end::Head-->
	<!--begin::Body-->
	<body id="kt_body" class="bg-body">
        @include('sweetalert::alert')
		<!--begin::Main-->
		@yield('content')
		<!--end::Main-->
		<script>var hostUrl = "assets/";</script>
		<!--begin::Javascript-->
		<!--begin::Global Javascript Bundle(used by all pages)-->
		<script src="{{URL::to('/')}}/assets/plugins/global/plugins.bundle.js"></script>
		<script src="{{URL::to('/')}}/assets/js/scripts.bundle.js"></script>
		<!--end::Global Javascript Bundle-->
		<!--begin::Page Custom Javascript(used by this page)-->
		<script src="{{URL::to('/')}}/vendor/sweetalert/custom.js"></script>
		<!--end::Page Custom Javascript-->
		<!--end::Javascript-->
	</body>
	<!--end::Body-->
</html>
