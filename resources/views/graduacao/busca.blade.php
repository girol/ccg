<form method="post" action"/buscaReplicado">
    {{ csrf_field() }} 
    Nº USP: <input name="codpes" requrired>

    <button type="submit">Buscar</button>
</form>

@if (isset($graduacaoCurso))

    <h2>{{ $graduacaoCurso['nompes'] }}</h2>
    Curso: <strong>{{ $graduacaoCurso['codcur'] }} - {{ $graduacaoCurso['nomcur'] }}</strong><br />
    Habilitação: <strong>{{ $graduacaoCurso['codhab'] }} - {{ $graduacaoCurso['nomhab'] }}</strong><br />
    Ano de ingresso: <strong>{{ Carbon\Carbon::parse($graduacaoCurso['dtainivin'])->format('Y') }}</strong>

@endif