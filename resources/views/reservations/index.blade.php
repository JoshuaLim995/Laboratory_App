@extends('layouts.app')
@section('content')
<div class="container">







	<div class="control-group input-group">
		<a href="{{ route('reservation.create') }}"><button class="btn btn-default">Make reservation
		</button></a>
	</div>

	<div class="panel panel-primary">
		{!! $calendar_details->calendar()  !!}
		{!! $calendar_details->script() !!}
	</div>
</div>


<script type="text/javascript">

</script>
@endsection