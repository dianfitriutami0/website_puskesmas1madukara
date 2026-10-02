@extends('layouts.admin')

@section('title', 'Edit Berita')
@section('heading', 'Edit Berita')

@section('content')
    @include('admin.news._form', [
        'news'   => $news,
        'action' => route('admin.news.update', $news),
        'method' => 'PUT',
    ])
@endsection