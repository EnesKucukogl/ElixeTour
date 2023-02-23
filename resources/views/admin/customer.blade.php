@extends('admin.layout.mainlayout')
@section('content')
{{--    <button type='button' class='btn btn-primary  mb-3' id="addLanguage">--}}
{{--        <i class="fa fa-plus"></i>--}}
{{--    </button>--}}
    <div id="gridContainer"></div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/customer.js')}}"></script>

    <div class="modal fade" id="updateCustomer" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class ="modal-header"></div>
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div id="frmEditCustomer"></div>
                </div>
                <div class="modal-footer">
                    <button id="btnSaveCustomer" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
@endsection
