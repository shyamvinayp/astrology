 <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">

        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Add SIP Connection</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {!! Form::open(['route'=>'customers.store', 'id' => 'telecom-main-form', 'class' => 'dirtyforms', 'enctype' => "multipart/form-data"]) !!}
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="form-group">
                    <label for="name" class="col-form-label text-md-right">{{ __('Name') }}<span style="color:red;"> *</span></label>
                    {!! Form::text('tbl_sip_connection_name',  null, [
                      'class' => 'form-control',
                      'required'                      => 'required',
                      'data-parsley-trigger'          => 'change focusout',
                      ]) !!}
                    <span class="text-danger">{{ $errors->first('tbl_sip_connection_name') }}</span>
                </div>
                <div class="mt-20 text-right">
                    @include('partials.form.save-cancel', ['submitValue'=>"Create SIP Connection", 'cancelValue' => false, 'skipCancel'=> true, 'submitBtnStatus' => 'Primary'])

                </div>
                {!! Form::close() !!}
            </div>
          {{--  <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                --}}{{--<button type="button" class="btn btn-primary">Save changes</button>--}}{{--
            </div>--}}
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->

