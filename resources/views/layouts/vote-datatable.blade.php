@extends('adminlte::master')


@section('adminlte_css')
    @stack('css')
    @yield('css')
@stop

@section('body')
    <div class="wrapper">


        {{-- Content Wrapper --}}

            {{-- Main Content --}}
            <div class="content" style="background: yellowgreen;">
                    @yield('content')
            </div>


    </div>
@stop

@section('adminlte_js')
    @stack('js')
    @yield('js')
@stop
