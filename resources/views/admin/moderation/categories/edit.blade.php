@extends('layouts.admin')

@section('content')
    <div class="container">
        <div class="card mt-2">
            <div class="card-header"> Edit Category</div>
            <div class="card-body">
{{--                {{ Form::model($subdomain, ['route' => ['subdomain.update', $subdomain->id], 'method' => 'put']) }}--}}
                {{ Form::open(['route' => ['category.update', $category], 'method' => 'post', 'files' => true]) }}

                    <div class="form-group mt-2 md-2">

                        {{ Form::label('name', 'Name', ['class' => 'col-4 text-md-right']) }}
                        <div class="col-8 {{ $errors->has('name') ? 'is-invalid' : '' }}">
                            {{ Form::text('name', $category->name, ['class' => 'form-control', 'required']) }}
                            @if($errors->has('name'))
                                <span class="invalid-feedback" role="alert"></span>
                                <strong> {{ $errors->first('name') }}</strong>
                            @endif
                        </div>

                        {{ Form::label('code', 'Code', ['class' => 'col-4 text-md-right']) }}
                        <div class="col-8 {{ $errors->has('code') ? 'is-invalid' : '' }}">
                            {{ Form::text('code', $category->code, ['class' => 'form-control', 'required'] ) }}
                            @if($errors->has('code'))
                                <span class="invalid-feedback" role="alert"></span>
                                <strong> {{ $errors->first('code') }}</strong>
                            @endif
                        </div>

                        {{ Form::label('subdomain_id', 'Domain', ['class' => 'col-4 text-md-right']) }}
                        <div class="col-8 {{ $errors->has('subdomain_id') ? 'is-invalid' : '' }}">
                            {{ Form::select('subdomain_id', $subdomains, $current_domain) }}

                            @if($errors->has('subdomain_id'))
                                <span class="invalid-feedback" role="alert"></span>
                                <strong> {{ $errors->first('subdomain_id') }}</strong>
                            @endif
                        </div>

                        <div class="form-group ">
                            <div class="col-md-12 mt-2">
                                {{ Form::submit('Edit category', ['class' => 'btn btn-primary']) }}
                            </div>
                        </div>
                    </div>
                {{ Form::close() }}
        </div>
    </div>
@endsection
