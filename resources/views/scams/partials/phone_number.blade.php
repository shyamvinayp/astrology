
<!--<div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;"> -->
 <div class="modal-dialog" style="margin-top: 50px; margin-bottom:50px; max-width:30%;">
    <div class="modal-content">

        <div class="modal-header">

            <h4 class="modal-title" id="myModalLabel">Enter SIP Credenitals</h4>
            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        </div>



        <div class="modal-body">
            <p>To use our demo you will need your SIP credentials from your account. All fields are required.</p>
            <div class="form-group">
                <label>Display Name:</label>
                <input type="text" name="Display" value="akk" class="form-control" placeholder="i.e. Ben Franklin" required>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sip User:</label>
                        <input type="text" name="User" value="90001" class="form-control" placeholder="i.e. sipuser" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>WS URL:</label>
                        <input type="text" name="WSServer"  value="wss://155.138.217.237:7443/" class="form-control" placeholder="i.e. wss://sip.example.com:5060/" required>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sip Pass:</label>
                        <input type="password" name="Pass" value="90001" class="form-control" placeholder="i.e. supaSekret!" required>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label>Sip Realm:</label>
                        <input type="text" name="Realm" value="freeswitch" class="form-control" placeholder="i.e. sip.example.com" required>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="btnConfig">Launch Phone</button>
        </div>
        </div>
    <!-- /.modal-content -->
</div>
<!-- /.modal-dialog -->

