@extends('adminlte::page')

@section('title', config('app.name') . ' - Meus créditos')

@section('content_header')
    <h1>Meus créditos</h1>
@stop

@section('content')

    @can($gate)

    @include('flash')

    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Aluno</a></li>
            <li><a href="#tab_2" data-toggle="tab">Créditos</a></li>
            <li><a href="#tab_3" data-toggle="tab">Faltam</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_1">
          		<div class="box-primary">
            		<div class="box-header">
						
                        @if( config('app.wsFoto') === true  )
                        <img style="margin-left: 0px; margin-bottom: 10px;" class="profile-user-img img-responsive img-circle" 
                            src="data: image/jpeg; base64, {{ Uspdev\Wsfoto::obter($dadosAluno['codpes']) }}" alt="{{ $dadosAluno['nompes'] }}" />
              			@endif
              			
              			<h3 class="box-title">{{ $dadosAluno['codpes'] }} - {{ $dadosAluno['nompes'] }}</h3>
            		</div>
            		<div class="box-body table-responsive no-padding">
              			<table class="table table-hover">
                			<tr>
                  				<th>Curso</th>
                  				<td>{{ $dadosAluno['codcur'] }} - {{ $dadosAluno['nomcur'] }}</td>
                			</tr>
                			<tr>
                  				<th>Habilitação</td>
                  				<td>{{ $dadosAluno['codhab'] }} - {{ $dadosAluno['nomhab'] }}</td>
                			</tr>
                			<tr>
                  				<th>Ano de ingresso</td>
                  				<td>{{ $dadosAluno['dtainivin'] }}</td>
                			</tr>
                			<tr>
                  				<th>Programa</td>
                  				<td>{{ $dadosAluno['codpgm'] }}</td>
                			</tr>
                			<tr>
                  				<th colspan="2">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>&nbsp;</th>
												<th>Créditos/Aula necessários</th>
												<th>Créditos/Aula que ainda faltam</th>
											</tr>
										</thead>
										<tbody>
											@if ($numcredisoptelt > 0)
											<tr>
												<td>Disciplinas Optativas Eletivas</td>
												<td>{{ $curriculoAluno['numcredisoptelt'] }}</td>
												<td>{{ $curriculoAluno['numcredisoptelt'] - $numcredisoptelt }}</td>
											</tr>	
											@endif
											@if ($curriculoAluno['numcredisoptliv'] > 0)
											<tr>
												<td>Disciplinas Optativas Livres</td>
												<td>{{ $curriculoAluno['numcredisoptliv'] }}</td>
												<td>{{ $curriculoAluno['numcredisoptliv'] - $numcredisoptliv }}</td>
											</tr>
											@endif																								
										</tbody>
									</table>
								</td>
                			</tr>															
              			</table>
            		</div>
          		</div>
            </div>
              
            <div class="tab-pane" id="tab_2">
          		<div class="box-primary">
            		<div class="box-header">
              			<h3 class="box-title">{{ $dadosAluno['codpes'] }} - {{ $dadosAluno['nompes'] }}</h3> 
            		</div>
            		<div class="box-body table-responsive">
						<h4>Disciplinas Concluídas</h4> 
						<table style="width: 100%;" class="table table-bordered table-striped table-hover" id="disciplinasObrigatorias">
							<thead>
								<tr>
									<th><label>Diciplinas Obrigatórias</label></th>
									<th>&nbsp;</th>
								</tr>                     
								<tr>
									<th>Disciplinas</th>
									<th>Créditos/Aula</th>
								</tr>                                          
							</thead>
							<tbody>                                                     
								@foreach ($disciplinasConcluidas as $disciplinaConcluida)                  
									@if (!in_array($disciplinaConcluida['coddis'], $disciplinasOptativasLivresConcluidas))
										<tr>
											<td style="width: 70%;">{{ $disciplinaConcluida['coddis'] }} - 
												{{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinaConcluida['coddis']) }}</td>
											<td style="width: 30%;">{{ $disciplinaConcluida['creaul'] }}</td>
										</tr>
									@endif
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th style="text-align: right;">Total de créditos</th>
									<th></th>
								</tr>
							</tfoot>							
						</table>
						<br />
						<table style="width: 100%;" class="table table-bordered table-striped table-hover" id="disciplinasOptativasEletivas">
							<thead>
								<tr>
									<th><label>Disciplinas Optativas Eletivas</label></th>
									<th>&nbsp;</th>
								</tr>                     
								<tr>
									<th>Disciplinas</th>
									<th>Créditos/Aula</th>
								</tr>                                          
							</thead>
							<tbody>                                                     
								@foreach ($disciplinasConcluidas as $disciplinaConcluida)                  
									@if (in_array($disciplinaConcluida['coddis'], $disciplinasOptativasEletivasConcluidas))
										<tr>
											<td style="width: 70%;">{{ $disciplinaConcluida['coddis'] }} - 
												{{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinaConcluida['coddis']) }}</td>
											<td style="width: 30%;">{{ $disciplinaConcluida['creaul'] }}</td>
										</tr>
									@endif
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th style="text-align: right;">Total de créditos</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
						<br />
						<table style="width: 100%;" class="table table-bordered table-striped table-hover" id="disciplinasLicenciaturas">
							<thead>
								<tr>
									<th><label>Disciplinas Licenciaturas</label></th>
									<th>&nbsp;</th>
								</tr>                     
								<tr>
									<th>Disciplinas</th>
									<th>Créditos/Aula</th>
								</tr>                                          
							</thead>
							<tbody>                                                     
								@foreach ($disciplinasConcluidas as $disciplinaConcluida)                  
									@if (in_array($disciplinaConcluida['coddis'], $disciplinasLicenciaturasConcluidas))
										<tr>
											<td style="width: 70%;">{{ $disciplinaConcluida['coddis'] }} - 
												{{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinaConcluida['coddis']) }}</td>
											<td style="width: 30%;">{{ $disciplinaConcluida['creaul'] }}</td>
										</tr>
									@endif
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th style="text-align: right;">Total de créditos</th>
									<th></th>
								</tr>
							</tfoot>
						</table>												
						<br />
						<table style="width: 100%;" class="table table-bordered table-striped table-hover" id="disciplinasOptativasLivres">
							<thead>
								<tr>
									<th><label>Disciplinas Optativas Livres</label></th>
									<th>&nbsp;</th>
								</tr>                     
								<tr>
									<th>Disciplinas</th>
									<th>Créditos/Aula</th>
								</tr>                                          
							</thead>
							<tbody>                                                     
								@foreach ($disciplinasConcluidas as $disciplinaConcluida)                  
									@if (in_array($disciplinaConcluida['coddis'], $disciplinasOptativasLivresConcluidas))
										<tr>
											<td style="width: 70%;">{{ $disciplinaConcluida['coddis'] }} - 
												{{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinaConcluida['coddis']) }}</td>
											<td style="width: 30%;">{{ $disciplinaConcluida['creaul'] }}</td>
										</tr>
									@endif
								@endforeach
							</tbody>
							<tfoot>
								<tr>
									<th style="text-align: right;">Total de créditos</th>
									<th></th>
								</tr>
							</tfoot>
						</table>	
            		</div>					
          		</div>
            </div>
              
            <div class="tab-pane" id="tab_3">
          		<div class="box-primary">
            		<div class="box-header">
              			<h3 class="box-title">{{ $dadosAluno['codpes'] }} - {{ $dadosAluno['nompes'] }}</h3>
            		</div>
            		<div class="box-body table-responsive">
					<h4>Disciplinas que Faltam</h4>
					<table style="width: 100%;" class="table table-bordered table-striped table-hover datatable">
							<thead>
								<tr>
									<th><label>Disciplinas Obrigatórias a concluir</label></th>
								</tr>                     
								<tr>
									<th>Disciplinas</th>
								</tr>                                          
							</thead>
							<tbody>                                                     
								@foreach ($disciplinasObrigatoriasFaltam as $disciplinaObrigatoriaFalta)                  
									<tr>
										<td style="width: 100%;">{{ $disciplinaObrigatoriaFalta }} - 
											{{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinaObrigatoriaFalta) }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>
						<br />
						<table style="width: 100%;" class="table table-bordered table-striped table-hover datatable">
							<thead>
								<tr>
									<th><label>Disciplinas Licenciaturas a concluir</label></th>
								</tr>                     
								<tr>
									<th>Disciplinas</th>
								</tr>                                          
							</thead>
							<tbody>                                                     
								@foreach ($disciplinasLicenciaturasFaltam as $disciplinaLicenciaturaFalta)                  
									<tr>
										<td style="width: 100%;">{{ $disciplinaLicenciaturaFalta }} - 
											{{ Uspdev\Replicado\Graduacao::nomeDisciplina($disciplinaLicenciaturaFalta) }}</td>
									</tr>
								@endforeach
							</tbody>
						</table>												
            		</div>					
          		</div>
            </div>
        </div>
    </div>

    @endcan

@stop

@section('js')
    
    <script type="text/javascript">
        $(function () {
            //Initialize Select2 Elements
            $('.select2').select2({
                placeholder:    "Selecione",
                allowClear:     true
            });
            
            //Datepicker
            $('.datepicker').datepicker({
                format:         "dd/mm/yyyy",
                viewMode:       "years", 
                minViewMode:    "years",
                autoclose:      true
            });

            // DataTables
            $('.datatable').DataTable({
                language    	: {
                    url     : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },  
                paging      	: true,
                lengthChange	: true,
                searching   	: true,
                ordering    	: true,
                info        	: true,
                autoWidth   	: true,
                pageLength  	: 100
            });

			// Total de créditos
			$('#disciplinasOptativasLivres').dataTable( {
				"footerCallback" : function(tfoot, data, start, end, display){
					var api = this.api();
					$(api.column(1).footer()).html(
						api.column(1).data().reduce(function(a, b){
							a = parseInt(a);
							b = parseInt(b);
							return a + b;
						}, 0)
					);
				},
				language    	: {
                    url     : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },  
				pageLength  	: 100
			});

			$('#disciplinasObrigatorias').dataTable( {
				"footerCallback" : function(tfoot, data, start, end, display){
					var api = this.api();
					$(api.column(1).footer()).html(
						api.column(1).data().reduce(function(a, b){
							a = parseInt(a);
							b = parseInt(b);
							return a + b;
						}, 0)
					);
				},
				language    	: {
                    url     : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },  
				pageLength  	: 100
			});			

			$('#disciplinasOptativasEletivas').dataTable( {
				"footerCallback" : function(tfoot, data, start, end, display){
					var api = this.api();
					$(api.column(1).footer()).html(
						api.column(1).data().reduce(function(a, b){
							a = parseInt(a);
							b = parseInt(b);
							return a + b;
						}, 0)
					);
				},
				language    	: {
                    url     : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },  
				pageLength  	: 100
			});				
			
			$('#disciplinasLicenciaturas').dataTable( {
				"footerCallback" : function(tfoot, data, start, end, display){
					var api = this.api();
					$(api.column(1).footer()).html(
						api.column(1).data().reduce(function(a, b){
							a = parseInt(a);
							b = parseInt(b);
							return a + b;
						}, 0)
					);
				},
				language    	: {
                    url     : '//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json'
                },  
				pageLength  	: 100
			});

        });

    </script>

@stop

