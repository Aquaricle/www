function displayLogs(data, status, jqXHR)
{
  if(data.data.length == 0)
    $("#logs").append("<tr><td colspan='2'>No Logs Found</td></tr>");
  else
  {
    $.each(data.data, function()
    {
      $("#logs").append(
        "<tr><td><a class='logs' href='/aquarium/{{ $aquariumID }}/log/" + this.aquariumLogID + "'>" + this.logDate + "</a>" +
        "</td><td>" + this.summary + "</td></tr>");
      });
    }
}


function getLogs(aquariumID)
{
  jQuery.ajax({
    type: "GET",
    url: "/api/v1/aquarium/" + aquariumID + "/logs",
    contentType: "application/json",
    dataType: "json",
    success: displayLogs,
    error: errorCallback
  });
}
