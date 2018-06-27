@extends('layouts.admin')

@section('title', ' | Admin | Dashboard')

@section('content')

    @admcontent

        @slot('banners')
            @include('admin.partials._banners')
        @endslot

        @slot('card')
            @include('admin.partials._chart')
        @endslot

    @endadmcontent

@endsection