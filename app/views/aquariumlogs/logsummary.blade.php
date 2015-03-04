<h3>Latest Logs</h3>

<table>
	<tr><th class="logDate">Date</th><th>Summary</th></tr>
	<tbody id="logs"></tbody>
</table>
<br />

<div class="pager">
<span id="pagination"></span>
</div>

@section('footer')
@parent
<script type="text/javascript">
	getLogs({{ $aquariumID }}, 1);

	function displayLogs(data, status, jqXHR)
	{
	  if(data.data.length == 0)
	  {
	    $("#logs").append("<tr><td colspan='2'>No Logs Found</td></tr>");
	    return;
	  }

	  $.each(data.data, function()
	  {
	    if(!this.summary)
	      this.summary = '';
	    $("#logs").append(
	      "<tr><td><a class='logs' href='" + "/aquarium/" + this.aquariumID  +
	        "/log/" + this.aquariumLogID + "'>" + this.logDate.date + "</a>" +
	        "</td><td>" + this.summary + "</td></tr>");
	  });

	  $("#pagination").empty();
	  if(data.prev_page_url)
	  {
	    prevPage = data.current_page - 1;
	    $("#pagination").append("<a class='pager' onclick='getLogs(" + data.data[0].aquariumID +
	      "," + prevPage + ")'>Previous</a>")
	  }
	  if(data.prev_page_url && data.next_page_url)
	    $("#pagination").append(" : ");
	  if(data.next_page_url)
	  {
	    nextPage = data.current_page + 1;
	    $("#pagination").append("<a class='pager' onclick='getLogs(" + data.data[0].aquariumID +
	      "," + nextPage + ")'>Next</a>")
	  }
	}

	function getLogs(aquariumID, page)
	{
	  $("#logs").empty();
	  jQuery.ajax({
	    type: "GET",
	    url: apiURL + "aquarium/" + aquariumID + "/logs/?page=" + page,
	    contentType: "application/json",
	    dataType: "json",
	    success: displayLogs,
	    error: errorCallback
	  });
	}

</script>
@stop
