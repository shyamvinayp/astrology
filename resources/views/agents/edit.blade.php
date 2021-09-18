@extends('adminlte::page')
<script src="{!! asset('js/datatables/jquery.js') !!}"></script>

@section('content_header')
    @include('partials.content-header', [
        'pageHeadTitle' => 'Edit Agent',
        ])
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            @include('flash-message')
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header"><h4>Edit Agent</h4></div>
                    <div class="card-body">
                        {!! Form::model($agent, ['url'=>route('agents.update',$agent->id), 'id' => 'telecom-main-form', 'class' => 'dirtyforms']) !!}
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        @include('agents.partials.form-fields')
                        <div class="row mt-20 text-right">
                            <div class="col-sm-12">
                                @include('partials.form.save-cancel', ['submitValue'=>"Save", 'cancelValue' => 'Cancel', 'skipCancel'=> false, 'submitBtnStatus' => 'Primary'])
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection

@section('scripts')
    @include('agents.partials.create-edit-scripts')
@endsection
