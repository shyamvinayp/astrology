 <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;">
        <div class="modal-content">
             <div id="edit-connection">
                <div class="modal-header">
                    <h4 class="modal-title">Edit SIP Connection</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="text-success"></div>
                    {!! Form::open(['route'=>'connections.store', 'id' => 'telecom-main-form', 'class' => 'dirtyforms']) !!}
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        add-aj-connection file
                    {!! Form::close() !!}
                </div>
             </div>
        </div>
        <!-- /.modal-content -->
 </div>
    <!-- /.modal-dialog -->

