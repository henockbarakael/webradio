@extends('errors.template')

@section('title', 'Non Trouvé')
@section('details', $exception->getMessage())
