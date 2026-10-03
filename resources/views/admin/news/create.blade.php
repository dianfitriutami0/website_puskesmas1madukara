@extends('layouts.admin')

@section('title', 'Buat Berita Baru')
@section('heading', 'Buat Berita Baru')
@section('breadcrumb', 'Berita')

@section('content')
    @include('admin.news._form', [
        'news'   => new \App\Models\News(),
        'action' => route('admin.news.store'),
        'method' => 'POST',
    ])
@endsection
