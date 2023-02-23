@extends('admin.layout.mainlayout')
@section('content')
    <div id="gridContainer"></div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/contact.js')}}"></script>
    <div class="modal fade" id="updateContact" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div id="frmEditContact"></div>

                </div>
                <div class="modal-footer">

                    <button id="btnSaveContact" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
@endsection

