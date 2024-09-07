@extends('layouts.default')

@section('title', 'アップロード画像の表示')
@section('content')
    <img src="{{ asset('storage/photos/' . $fileName) }}" alt="aa" />
@endsection
