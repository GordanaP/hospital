@extends('layouts.admin')

@section('title', ' | Admin | Dashboard')

@section('content')

    @component('components.admin.dashboard')

        @slot('banners')
            @include('admin.partials._banners')
        @endslot

        @slot('card')
            @include('admin.partials._chart')
        @endslot

    @endcomponent

@endsection