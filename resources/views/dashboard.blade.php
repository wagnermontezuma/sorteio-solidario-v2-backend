@extends('layouts.default')


@section('title', 'Admin')

@push('css')
    <link href="/assets/plugins/jvectormap-next/jquery-jvectormap.css" rel="stylesheet" />
    <link href="/assets/plugins/nvd3/build/nv.d3.css" rel="stylesheet" />
    <link href="/assets/plugins/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@section('content')

    <ol class="breadcrumb float-xl-right">
        <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
        <li class="breadcrumb-item active">Dashboard</li>
    </ol>
    <h1 class="page-header mb-3">Dashboard</h1>
    <div class="d-sm-flex align-items-center mb-3">
        <a href="#" class="btn btn-inverse mr-2 text-truncate" id="daterange-filter">
            <i class="fa fa-calendar fa-fw text-white-transparent-5 ml-n1"></i>
            <span>1 Jun 2019 - 7 Jun 2019</span>
            <b class="caret"></b>
        </a>
        <div class="text-muted f-w-600 mt-2 mt-sm-0">comparado com <span id="daterange-prev-date">24 Mar - 30 Abr 2019</span>
        </div>
    </div>

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-teal">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-globe fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">TOTAL DE CLIENTES</div>
                    <div class="stats-number">180.200</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 70.1%;"></div>
                    </div>
                    <div class="stats-desc">70,1% a mais do que semana passada</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-blue">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-dollar-sign fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">TOTAL DE TRANSFERÊNCIAS</div>
                    <div class="stats-number">842.900</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 40.5%;"></div>
                    </div>
                    <div class="stats-desc">40.5% a mais do que semana passada</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-indigo">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-archive fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">NOVAS CONTAS</div>
                    <div class="stats-number">100.900</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 76.3%;"></div>
                    </div>
                    <div class="stats-desc">76.3% a mais do que semana passada</div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="widget widget-stats bg-dark">
                <div class="stats-icon stats-icon-lg"><i class="fa fa-comment-alt fa-fw"></i></div>
                <div class="stats-content">
                    <div class="stats-title">ATENDIMENTO</div>
                    <div class="stats-number">3.988</div>
                    <div class="stats-progress progress">
                        <div class="progress-bar" style="width: 54.9%;"></div>
                    </div>
                    <div class="stats-desc">54.9% a menos do que semana passada</div>
                </div>
            </div>
        </div>
    </div>
    <!-- end row -->

    <div class="row">
        <div class="col-xl-6">
            <div class="row">
                <div class="col-sm-6">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">CLIENTES ATIVOS</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover"
                                        data-trigger="hover" data-title="Clientes ativos" data-placement="top"
                                        data-content="Percentual de usuários com sessão ativa" data-original-title=""
                                        title=""></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="2.19">0.00</span>%
                                </h2>
                                <div class="ml-auto">
                                    <div id="conversion-rate-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-caret-down"></i> <span data-animation="number"
                                    data-value="0.50">0.00</span>% comparado com a última semana
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-red f-s-8 mr-2"></i>
                                    Uso baixo
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span
                                            data-animation="number" data-value="262">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number"
                                            data-value="3.79">0.00</span>%</div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-warning f-s-8 mr-2"></i>
                                    Uso médio
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span
                                            data-animation="number" data-value="11">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number"
                                            data-value="3.85">0.00</span>%</div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-lime f-s-8 mr-2"></i>
                                    Uso alto
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span
                                            data-animation="number" data-value="57">0</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number"
                                            data-value="2.19">0.00</span>%</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="card border-0 bg-dark text-white text-truncate mb-3">
                        <div class="card-body">
                            <div class="mb-3 text-grey">
                                <b class="mb-3">DOWNLOADS POR PLATAFORMAS</b>
                                <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover"
                                        data-trigger="hover" data-title="Downloads por plataformas" data-placement="top"
                                        data-content="Número total de downloads por plataformas." data-original-title=""
                                        title=""></i></span>
                            </div>
                            <div class="d-flex align-items-center mb-1">
                                <h2 class="text-white mb-0"><span data-animation="number" data-value="70719">0</span></h2>
                                <div class="ml-auto">
                                    <div id="store-session-sparkline"></div>
                                </div>
                            </div>
                            <div class="mb-4 text-grey">
                                <i class="fa fa-caret-up"></i> <span data-animation="number" data-value="9.5">0.00</span>%
                                comparado com a última semana
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-teal f-s-8 mr-2"></i>
                                    Android
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span
                                            data-animation="number" data-value="25.7">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number"
                                            data-value="53210">0</span></div>
                                </div>
                            </div>
                            <div class="d-flex mb-2">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-blue f-s-8 mr-2"></i>
                                    iOS
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span
                                            data-animation="number" data-value="16.0">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number"
                                            data-value="11959">0</span></div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="d-flex align-items-center">
                                    <i class="fa fa-circle text-aqua f-s-8 mr-2"></i>
                                    Desktop
                                </div>
                                <div class="d-flex align-items-center ml-auto">
                                    <div class="text-grey f-s-11"><i class="fa fa-caret-up"></i> <span
                                            data-animation="number" data-value="7.9">0.00</span>%</div>
                                    <div class="width-50 text-right pl-2 f-w-600"><span data-animation="number"
                                            data-value="5545">0</span></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-8 col-lg-6">
            <div class="card bg-dark border-0 text-white mb-3">
                <div class="card-body">
                    <div class="mb-3 text-grey"><b>ANÁLISE DE VISITAS</b> <span class="ml-2"><i
                                class="fa fa-info-circle" data-toggle="popover" data-trigger="hover"
                                data-title="Análise de visitas" data-placement="top"
                                data-content="Horários de maior visitação e consumo do aplicativo." data-original-title=""
                                title=""></i></span></div>
                    <div class="row">
                        <div class="col-xl-3 col-4">
                            <h3 class="mb-1"><span data-animation="number" data-value="127.1">0</span>K</h3>
                            <div>Novos Usuários</div>
                            <div class="text-grey f-s-11 text-truncate"><i class="fa fa-caret-up"></i> <span
                                    data-animation="number" data-value="25.5">0.00</span>% de 7 dias atrás</div>
                        </div>
                        <div class="col-xl-3 col-4">
                            <h3 class="mb-1"><span data-animation="number" data-value="179.9">0</span>K</h3>
                            <div>Visitantes Recorrentes</div>
                            <div class="text-grey f-s-11 text-truncate"><i class="fa fa-caret-up"></i> <span
                                    data-animation="number" data-value="5.33">0.00</span>% de 7 dias atrás</div>
                        </div>
                        <div class="col-xl-3 col-4">
                            <h3 class="mb-1"><span data-animation="number" data-value="766.8">0</span>K</h3>
                            <div>Total de Páginas Navegadas</div>
                            <div class="text-grey f-s-11 text-truncate"><i class="fa fa-caret-up"></i> <span
                                    data-animation="number" data-value="0.323">0.00</span>% de 7 dias atrás</div>
                        </div>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div style="height: 269px">
                        <div id="visitors-line-chart" class="widget-chart-full-width nvd3-inverse-mode"
                            style="height: 254px">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-6">
            <div class="card bg-dark border-0 text-white mb-3">
                <div class="card-body">
                    <div class="mb-2 text-grey">
                        <b>CLIENTES POR LOCALIZAÇÃO</b>
                        <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover"
                                data-trigger="hover" data-title="Clientes por localização" data-placement="top"
                                data-content="Total de clientes por estado."></i></span>
                    </div>
                    <div id="visitors-map" class="mb-2" style="height: 200px"></div>
                    <div>
                        <div class="d-flex align-items-center text-white mb-2">
                            <div class="widget-img widget-img-xs rounded bg-inverse mr-2 width-40"
                                style="background-image: url(/assets/img/flag/pa.png)"></div>
                            <div class="d-flex w-100">
                                <div>Pará</div>
                                <div class="ml-auto text-grey"><span data-animation="number"
                                        data-value="39.85">0.00</span>%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-white mb-2">
                            <div class="widget-img widget-img-xs rounded bg-inverse mr-2 width-40"
                                style="background-image: url(/assets/img/flag/am.png)"></div>
                            <div class="d-flex w-100">
                                <div>Amazonas</div>
                                <div class="ml-auto text-grey"><span data-animation="number"
                                        data-value="14.23">0.00</span>%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-white mb-2">
                            <div class="widget-img widget-img-xs rounded bg-inverse mr-2 width-40"
                                style="background-image: url(/assets/img/flag/ma.png)"></div>
                            <div class="d-flex w-100">
                                <div>Maranhão</div>
                                <div class="ml-auto text-grey"><span data-animation="number"
                                        data-value="12.83">0.00</span>%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-white mb-2">
                            <div class="widget-img widget-img-xs rounded bg-inverse mr-2 width-40"
                                style="background-image: url(/assets/img/flag/to.png)"></div>
                            <div class="d-flex w-100">
                                <div>Tocantins</div>
                                <div class="ml-auto text-grey"><span data-animation="number"
                                        data-value="11.14">0.00</span>%</div>
                            </div>
                        </div>
                        <div class="d-flex align-items-center text-white mb-0">
                            <div class="widget-img widget-img-xs rounded bg-inverse mr-2 width-40"
                                style="background-image: url(/assets/img/flag/ap.png)"></div>
                            <div class="d-flex w-100">
                                <div>Amapá</div>
                                <div class="ml-auto text-grey"><span data-animation="number"
                                        data-value="10.75">0.00</span>%</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-7 col-lg-7">
            <div class="card border-0 bg-dark-darker text-white mb-3">
                <div class="card-body"
                    style="background: no-repeat bottom right; background-image: url(/assets/img/svg/img-4.svg); background-size: auto 60%;">
                    <div class="mb-3 text-grey">
                        <b>CONVERSÃO POR REDE SOCIAL</b>
                        <span class="text-grey ml-2"><i class="fa fa-info-circle" data-toggle="popover"
                                data-trigger="hover" data-title="Conversão por rede social" data-placement="top"
                                data-content="Conversão com anúncios através de redes sociais."></i></span>
                    </div>
                    <h3 class="m-b-10"><span data-animation="number" data-value="55547">0.00</span></h3>
                    <div class="text-grey m-b-1"><i class="fa fa-caret-up"></i> <span data-animation="number"
                            data-value="45.76">0.00</span>% a mais</div>
                </div>
                <div class="widget-list widget-list-rounded inverse-mode">
                    <a href="#" class="widget-list-item rounded-0 p-t-3">
                        <div class="widget-list-media icon">
                            <i class="fab fa-youtube bg-red text-white"></i>
                        </div>
                        <div class="widget-list-content">
                            <div class="widget-list-title">YouTube</div>
                        </div>
                        <div class="widget-list-action text-nowrap text-grey">
                            <span data-animation="number" data-value="34840">0.00</span>
                        </div>
                    </a>
                    <a href="#" class="widget-list-item">
                        <div class="widget-list-media icon">
                            <i class="fab fa-facebook-f bg-blue text-white"></i>
                        </div>
                        <div class="widget-list-content">
                            <div class="widget-list-title">Facebook</div>
                        </div>
                        <div class="widget-list-action text-nowrap text-grey">
                            <span data-animation="number" data-value="12502">0.00</span>
                        </div>
                    </a>
                    <a href="#" class="widget-list-item">
                        <div class="widget-list-media icon">
                            <i class="fab fa-twitter bg-aqua text-white"></i>
                        </div>
                        <div class="widget-list-content">
                            <div class="widget-list-title">Twitter</div>
                        </div>
                        <div class="widget-list-action text-nowrap text-grey">
                            <span data-animation="number" data-value="4799">0.00</span>
                        </div>
                    </a>
                    <a href="#" class="widget-list-item">
                        <div class="widget-list-media icon">
                            <i class="fab fa-google bg-red text-white"></i>
                        </div>
                        <div class="widget-list-content">
                            <div class="widget-list-title">Google Adwords</div>
                        </div>
                        <div class="widget-list-action text-nowrap text-grey">
                            <span data-animation="number" data-value="3405">0.00</span>
                        </div>
                    </a>
                    <a href="#" class="widget-list-item p-b-3">
                        <div class="widget-list-media icon">
                            <i class="fab fa-instagram bg-pink text-white"></i>
                        </div>
                        <div class="widget-list-content">
                            <div class="widget-list-title">Instagram</div>
                        </div>
                        <div class="widget-list-action text-nowrap text-grey">
                            <span data-animation="number" data-value="1140">0.00</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-5 col-lg-5" style="height: 100%; width: 100%;">
            <div class="card border-0 bg-dark-darker text-white mb-3">
                <div class="card-body">
                    <div class="mb-2 text-grey">
                        <b>CLIENTES POR TIPO</b>
                        <span class="ml-2"><i class="fa fa-info-circle" data-toggle="popover"
                                data-trigger="hover" data-title="Clientes por tipo" data-placement="top"
                                data-content="Total de clientes por tipo."></i></span>
                    </div>
                    <div class="row justify-content-center">
                        <div class="widget-chart-sidebar bg-dark-darker">
                            <div class="chart-number">
                                <b>289.256</b>
                            </div>
                            <div class="flex-grow-1 d-flex align-items-center">
                                <div id="visitors-donut-chart" class="nvd3-inverse-mode" style="height: 200px"></div>
                            </div>
                            <ul class="chart-legend f-s-11">
                                <li><i class="fa fa-circle fa-fw text-blue f-s-9 m-r-5 t-minus-1"></i> 34.0% <span>Pessoa
                                        Jurídica</span></li>
                                <li><i class="fa fa-circle fa-fw text-teal f-s-9 m-r-5 t-minus-1"></i> 56.0% <span>Pessoa
                                        Civil</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/plugins/d3/d3.min.js"></script>
    <script src="/assets/plugins/nvd3/build/nv.d3.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap.min.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap-world-mill.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery-jvectormap-brazil.js"></script>
    <script src="/assets/plugins/jvectormap-next/jquery.vmap.brazil.js"></script>
    <script src="/assets/plugins/apexcharts/dist/apexcharts.min.js"></script>
    <script src="/assets/plugins/moment/moment.js"></script>
    <script src="/assets/plugins/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script src="/assets/js/demo/dashboard-v3.js" defer></script>

@endsection
