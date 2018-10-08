<aside class="sidebar sidebar-light-green">
    <ul class="nav metismenu">
        <li>
            <a href="{{route('home')}}" @if(Request::segment(1) == 'home') class="current-page" @endif><i class="zmdi zmdi-apps"></i>Inicio</a>
        </li>

        <li>
            <a href="{{asset("/orcamentos")}}" @if(Request::segment(1) == 'orcamentos') class="current-page" @endif><i class="zmdi zmdi-apps"></i>Orçamentos</a>
        </li>

        <li>
            <a href="{{asset("/clientes")}}" @if(Request::segment(1) == 'clientes') class="current-page" @endif><i class="zmdi zmdi-apps"></i>Clientes</a>
        </li>

        <li>
            <a href="{{asset("/contatos")}}" @if(Request::segment(1) == 'contatos') class="current-page" @endif><i class="zmdi zmdi-apps"></i>Contatos</a>
        </li>

        <li>
            <a href="{{asset("/eventos")}}" @if(Request::segment(1) == 'eventos') class="current-page" @endif><i class="zmdi zmdi-apps"></i>Eventos</a>
        </li>

        <li>
            <a href="#"><i class="zmdi zmdi-view-dashboard"></i>Resumos<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside @if(Request::segment(1) == 'resumo') collapse in @else collapse @endif">
                <li><a href="{{route('resumoSemanal')}}" @if(Request::segment(2) == 'semanal') class="current-page" @endif>Semanal</a></li>
                <li><a href="{{route('resumoMensal', 'atual')}}" @if(Request::segment(2) == 'mensal') class="current-page" @endif>Mensal</a></li>
                <li><a href="" @if(Request::segment(2) == 'anual') class="current-page" @endif>Anual</a></li>
                <li><a href="" @if(Request::segment(2) == 'total') class="current-page" @endif>Total</a></li>

            </ul>
        </li>

        <li>
            <a href="#"><i class="zmdi zmdi-view-dashboard"></i>Outras Listas<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside @if(Request::segment(1) == 'outras') collapse in @else collapse @endif">
                <li><a href="{{route('eventoPassado')}}" @if(Request::segment(2) == 'eventopassado') class="current-page" @endif>Eventos passados</a></li>
                <li><a href="{{route('orcamentoPassado')}}" @if(Request::segment(2) == 'orcamentopassado') class="current-page" @endif>Orçamentos passados</a></li>
                <li><a href="{{route('orcamentoCancelado')}}" @if(Request::segment(2) == 'cancelados') class="current-page" @endif>Orçamentos cancelados</a></li>
                <li><a href="{{route('abertosproximos')}}" @if(Request::segment(2) == 'cancelados') class="current-page" @endif>Abertos proximos dias</a></li>
                <li><a href="{{route('semretorno')}}" @if(Request::segment(2) == 'cancelados') class="current-page" @endif>Sem retorno</a></li>

            </ul>
        </li>

        <li>
            <a href="#"><i class="zmdi zmdi-view-dashboard"></i>Cadastros<span class="zmdi arrow"></span></a>
            <ul class="nav nav-inside @if(Request::segment(1) == 'cadastro') collapse in @else collapse @endif">
                <li><a href="{{asset("/cadastro/meiocontatos")}}" @if(Request::segment(2) == 'meiocontatos') class="current-page" @endif>Tipo de contato</a></li>
                <li><a href="{{asset("/cadastro/tipoeventos")}}" @if(Request::segment(2) == 'tipoeventos') class="current-page" @endif>Tipo de evento</a></li>
                <li><a href="{{asset("/cadastro/conheceus")}}" @if(Request::segment(2) == 'conheceus') class="current-page" @endif>Como conheceu</a></li>
                <li><a href="{{asset("/cadastro/qtdconvidados")}}" @if(Request::segment(2) == 'qtdconvidados') class="current-page" @endif>Qtd convidados</a></li>
                <li><a href="{{asset("/cadastro/qtdfotos")}}" @if(Request::segment(2) == 'qtdfotos') class="current-page" @endif>Qtd de impressoes</a></li>
                <li><a href="{{asset("/cadastro/tipofotos")}}" @if(Request::segment(2) == 'tipofotos') class="current-page" @endif>Tipo de impressao</a></li>
                <li><a href="{{asset("/cadastro/tipocancelamentos")}}" @if(Request::segment(2) == 'tipocancelamentos') class="current-page" @endif>Tipo de cancelamento</a></li>
                <li><a href="{{asset("/cadastro/opcaos")}}" @if(Request::segment(2) == 'opcaos') class="current-page" @endif>Opções</a></li>
                <li><a href="{{asset("/cadastro/metas")}}" @if(Request::segment(2) == 'metas') class="current-page" @endif>Metas</a></li>
            </ul>
        </li>
    </ul>
</aside>