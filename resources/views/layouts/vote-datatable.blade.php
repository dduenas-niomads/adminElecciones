@extends('adminlte::master')


@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body')
    <div class="wrapper">


        {{-- Content Wrapper --}}
        <div class="content-wrapper {{ config('adminlte.classes_content_wrapper') ?? '' }}">

            {{-- Main Content --}}
            <div class="content">
                    @yield('content')
            </div>

        </div>

    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
