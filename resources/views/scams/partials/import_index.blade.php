 <!--<div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;"> -->
 <div class="modal-dialog" style="margin-top: 50px; margin-bottom:50px; max-width:30%;">
    <div class="modal-content">

            <div class="modal-header">

                <h4 class="modal-title">Import Scam Phone</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div style="margin-bottom:70px;">
                    <a href="public/upload/sample/sample_scam_phone_import.csv" class="btn btn-info float-sm-right" role="button" download>Download Sample file</a>
                </div>

                <div style="color: red; margin-bottom: 30px;"> <b>Note:</b> Upload only .csv file extension, File size must be less than 2MB </div>
                <div id="add-connection">
                    {!! Form::open(['route'=>'scams.storeImport', 'id' => 'telecom-main-form', 'class' => 'dirtyforms', 'enctype' => "multipart/form-data"]) !!}
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="name" class="col-form-label text-md-right">{{ __('Import CSV') }}<span style="color:red;"> *</span></label>
                        {!! Form::file('phone_import',  null, [
                          'class' => 'form-control',
                          'required'                      => 'required',
                          'data-parsley-trigger'          => 'change focusout',
                          ]) !!}
                        <span class="text-danger">{{ $errors->first('phone_import') }}</span>
                    </div>

                    <div class="mt-20 text-right">
                      @include('partials.form.save-cancel', ['submitValue'=>"Save", 'cancelValue' => false, 'skipCancel'=> true, 'submitBtnStatus' => 'Primary'])

                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
          {{--  <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                --}}{{--<button type="button" class="btn btn-primary">Save changes</button>--}}{{--
            </div>--}}
        </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

