<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ $systemInformation->name }}</title>

    <link rel="stylesheet" href="{{ asset('lte/plugins/fontawesome-free/css/all.min.css') }}">

    @if(direction() == 'rtl')
    <link rel="stylesheet" href="{{ asset('css/rtl.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte_rtl.css') }}">
    @else
    <link rel="stylesheet" href="{{ asset('lte/dist/css/adminlte.min.css') }}">
    @endif

    <link rel="stylesheet" href="{{ asset('lte/jquery-confirm/jquery-confirm.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('lte/plugins/ion-rangeslider/css/ion.rangeSlider.min.css') }}">
    
    <link rel="stylesheet" href="{{ asset('lte/wnoty/wnoty.css') }}">

    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="icon" href="{{ url('system-images/icons/'.$systemInformation->icon) }}" type="image/png">

    <style>
        :root {
            --skywatch: #15233c;
        }
        .bg-primary, .bg-blue {
            background-color: var(--skywatch) !important;
        }

        .card-primary.card-outline {
            border-top: 3px solid var(--skywatch) !important;
        }

        .btn-outline-primary {
            border-color: var(--skywatch) !important;
        }
        .btn-outline-primary:hover {
            border-color: var(--skywatch) !important;
            background-color: var(--skywatch) !important;
            color: white !important
        }

        .btn-primary {
            background-color: var(--skywatch) !important;
            border-color: var(--skywatch) !important;
        }

        .btn-style{
            padding: 2px 4px;
            margin: 0px;
            font-size: 10px;
        }
        .fa-style{
            margin-top:3px;
        }

        .m-5{
            margin: 5px
        }
        .mt-5{
            margin-top: 50px
        }
        .text-style{
            font-size: 11px;
        }
        .wnoty-block.wnoty-top-right{
            right: 5px
        }

        @media (min-width: 768px){
            ::-webkit-scrollbar {
                width: 5px;
            }
            ::-webkit-scrollbar-track {
                background: none; 
            }
            ::-webkit-scrollbar-thumb {
                background: #888;
                height: 15px;
            }
            ::-webkit-scrollbar-thumb:hover {
                background: #666; 
            }
            ::-webkit-scrollbar-button:start {
            height: 10px;
            }
        }

        .floating-bar {
            position: fixed;
            top: 13.25%;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .floating-bar-right {
            position: fixed;
            top: 13.25%;
            right: 5px;
            -webkit-transform: translateY(-50%);
            -ms-transform: translateY(-50%);
            transform: translateY(-50%);
        }
        .floating-bar a {
            display: block;
            text-align: center;
            padding: 5px 8px;
            margin: 1px;
            transition: all 0.3s ease;
            color: white;
            font-size: 20px;
        } 
        .floating-bar a:hover {
            background-color: #000;
        }
        .calculator {
            cursor: pointer;
            background: #3B5998;
            color: white;
        }
        .new-income {
            cursor: pointer;
            background: #3c763d;
            color: white;
        }
        .new-expense {
            cursor: pointer;
            background: #a94442;
            color: white;
        }
        .inquiry {
            cursor: pointer;
            background: #3c763d;
            color: white;
        }
        .find-and-replace {
            cursor: pointer;
            background: #3B5998;
            color: white;
        }
        .report {
            cursor: pointer;
            background: #3c763d;
            color: white;
        }
        .status {
            cursor: pointer;
            background: #3B5998;
            color: white;
        }
        .post{
            background: white;
            padding: 10px;
            border-radius: 5px;
            border-bottom: none !important
        }

        .pocket-table th, .pocket-table td{
            padding-top: 4px !important;
            padding-bottom: 4px !important;
            padding-left: 7px !important;
            padding-right: 7px !important;
        }

        .pocket-footer-table th, .pocket-footer-table td{
            border-top: none !important;
            padding-top: 1px !important;
            padding-bottom: 1px !important;
            padding-left: 7px !important;
            padding-right: 7px !important;
        }
    </style>

    @if(direction() == 'rtl')
    <style>
        .ribbon-wrapper .ribbon {
            -webkit-transform: rotate(-45deg) !important;
            transform: rotate(-45deg) !important;
        }
    </style>
    @endif
</head>