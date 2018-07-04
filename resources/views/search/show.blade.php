@extends('handytravelers')

@section('meta-title', "Blabla {$query}")
@section('meta-description', "Blabla {$query}")

@section('content')
<div class="section">
	<div class="filterable container">
		<scan-view query="{{{ $query }}}"></scan-view>
	</div>
</div>
@endsection
