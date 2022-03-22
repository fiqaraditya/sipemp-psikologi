@extends('errors::minimal')

@section('title', __('403 Akses Ditolak'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Maaf, Anda Tidak Memiliki Akses'))
