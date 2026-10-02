@extends('layouts.admin')

@section('title', 'Berita Baru')
@section('heading', 'Berita Baru')

@section('content')
    @include('admin.news._form', [
        'news'   => new \App\Models\News(),
        'action' => route('admin.news.store'),
        'method' => 'POST',
    ])
@endsection