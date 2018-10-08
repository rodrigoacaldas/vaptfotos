<nav class="navbar navbar-green">

    <div class="navbar-header container">
        <a href="#" class="menu-toggle"><i class="zmdi zmdi-menu"></i></a>
        <a href="{{route('home')}}" class="logo"><img src="/vendor/img/logocabecalho.png" alt="Logo VaptFotos"></a>
        <a href="{{route('home')}}" class="icon-logo"></a>
    </div>

    <div class="navbar-container clearfix">
        <div class="pull-left">
            <a href="#" class="page-title text-uppercase">@if( isset($pagetitle)) {{$pagetitle}} @else CRM - Vapt
                Fotos @endif</a>
        </div>


        <div class="pull-right">
            <a href="{{route('resumoSemanal')}}">
                <i style="margin-right:10px" class="zmdi zmdi-calendar-note"></i>
            </a>

            <a href="{{route('abertosproximos')}}">
                <i style="margin-right:10px" class="zmdi zmdi-email-open"></i>
            </a>

            <a href="{{route('novoSimples')}}">
                <span class="btn btn-info raised waves-effect"> <i class="zmdi zmdi-plus"></i>  Novo Orçamento </span>
            </a>

            <ul class="nav pull-right right-menu">
                <li class="more-options dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <i class="zmdi zmdi-account-circle"></i>
                    </a>
                    <div class="more-opt-container dropdown-menu">
                        <a href="#"><i class="zmdi zmdi-account-o"></i>Conta</a>
                        <a href="#"><i class="zmdi zmdi-calendar-note"></i>Calendario </a>
                        <a href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="zmdi zmdi-run"></i> Sair
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </a>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</nav>