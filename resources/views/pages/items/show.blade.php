@extends('layouts.app')

@section('header_styles')
    <link rel="stylesheet" href="{{ elixir('css/carousel.css') }}" />
@endsection

@section('subheader')
	<div class="Subheader Subheader--item">
		<h2>{{ $item->name }}</h2>
	</div>
@endsection

@section('content')
	<div class="container">
		<div id="ShowItem"></div>
	</div>
@endsection

@section('footer_scripts')
    <script src="{{ elixir('js/carousel.js') }}"></script>
    <script src="{{ elixir('js/ShowItem.js') }}"></script>
@endsection