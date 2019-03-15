@extends('layouts.app')

@section('breadcrumbs')
@endsection

@section('content')
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Dashboard</div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        You are logged in! Congratulations! {{ Auth::user()->name }}
                    </div>
                </div>
            </div>
        </div>
@endsection
