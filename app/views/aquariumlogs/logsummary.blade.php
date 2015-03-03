<h3>Latest Logs (Last {{ $lastDays}} Days)</h3>

<table id="logs">
	<tr><th class="logDate">Date</th><th>Summary</th></tr>
</table>


@section('footer')
@parent 
<script src="/js/getAquariumLogs.js"></script>
<script type="text/javascript">
	getLogs({{ $aquariumID }});
</script>
@stop
