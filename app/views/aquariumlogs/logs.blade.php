@extends('layout')
@section('content')

<h2>Aquarium Logs</h2>

@include('aquariumlogs.logsummary')


{{ link_to_route('aquariums.show', 'Go Back', array($aquariumID)) }}

@stop
