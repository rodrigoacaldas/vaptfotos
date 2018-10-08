@if($errors->any())
    <section class="content">
        <div class="row">
            <div class="col-md-6">
                <div class="alert alert-warning">
                    @foreach($errors->all() as $error)
                        <p>{{ $error }}</p>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endif

@if(session('success'))
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4></i> Sucesso!</h4>
                    <span>{{session('success')}}</span>
                </div>
            </div>
        </div>
    </section>
@endif

@if(session('error'))
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4></i> Alerta!</h4>
                    <span>{{session('erros')}}</span>
                </div>
            </div>
        </div>
    </section>
@endif