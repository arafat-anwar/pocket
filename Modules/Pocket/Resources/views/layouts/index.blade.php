@php
  $systemInformation = session()->get('system-information');
@endphp

<!DOCTYPE html>
<html lang="en">

@include('pocket::layouts.head')

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        @include('pocket::layouts.header')

        <div class="content-wrapper">
            @yield('content')
            @include('tools.modals')

            @include('pocket::pocket.newIncome')
            @include('pocket::pocket.newExpenses')
            @include('pocket::pocket.entryEditModal')

            <div class="floating-bar floating-bar-right">
                <a data-toggle="modal" data-target="#newIncome" class="new-income"><i class="text-white fa fa-plus-circle"></i></a>
                <a data-toggle="modal" data-target="#newExpenses" class="new-expense"><i class="text-white fa fa-minus-circle"></i></a>
                <a onclick="calculator()" class="calculator"><i class="text-white fa fa-calculator"></i></a>
            </div>
        </div>

        @include('pocket::layouts.footer')
    </div>

    @include('pocket::layouts.scripts')
</body>
</html>
