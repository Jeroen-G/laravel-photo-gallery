@extends('gallery::layouts.master')

@section('content')

    @include($form)

    @if (isset($errors) && count($errors) > 0)
        <div class="alert alert-danger" role="alert">
            <strong>Oh snap! {{ trans('gallery::gallery.errors') }}</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@endsection


