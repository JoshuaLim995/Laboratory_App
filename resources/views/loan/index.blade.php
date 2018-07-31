@extends('layouts.app')
@section('content')

@if(Auth::user()->isA('dlmsa', 'assistant', 'admin'))
@include('loan.admin')
@elseif(Auth::user()->isA('pg', 'ug', 'as'))
@include('loan.student')

@endif	
@endsection