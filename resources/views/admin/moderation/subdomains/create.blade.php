@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header"> Create subdomain</div>
            <div class="card-body">
                {{ Form::open(['route' => 'subdomain.store', 'files' => true]) }}

                    <div class="form-group mt-2 md-2">
                        {{ Form::label('name', 'Name', ['class' => 'col-4 text-md-right']) }}
                        <div class="col-8 {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            {{ Form::text('name', null, ['class' => 'form-control' , 'required'] ) }}

                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert"></span>
                                <strong> {{ $errors->first('name') }}</strong>
                            @endif
                        </div>

                        {{ Form::label('subdomain', 'Subdomain', ['class' => 'col-4 text-md-right']) }}
                        <div class="col-8 {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            {{ Form::text('subdomain', null, ['class' => 'form-control', 'required']) }}

                            @if($errors->has('subdomain'))
                                <span class="invalid-feedback" role="alert"></span>
                                <strong> {{ $errors->first('subdomain') }}</strong>
                            @endif
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 mt-2">
                                {{ Form::submit('Create subdomain', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
            </div>
        </div>
@endsection
