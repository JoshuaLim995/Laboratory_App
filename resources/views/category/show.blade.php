@extends('layouts.app')
@section('content')
<div class="container">
	<h2>Category: {{ $category->name }}</h2>

	<a href="{{ route('category.index') }}"><button class="btn btn-primary">Done</button></a>
	<a href="{{ route('category.edit', $category) }}"><button class="btn btn-success">Edit</button></a>
	<a href="{{ route('category.delete', $category) }}"><button class="btn btn-danger" onclick="if(!confirm('Are you sure delete this record? \n This will also delete all inventories in this category.')){return false;};">Delete</button></a>




</div>
@endsection