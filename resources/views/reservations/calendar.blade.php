@extends('layouts.app')
@section('content')
<div class="container">

{!! $calendar_details->calendar() !!}
	{!! $calendar_details->script() !!}
</div>
@endsection
