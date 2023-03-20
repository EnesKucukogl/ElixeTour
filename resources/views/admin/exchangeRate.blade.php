@extends('admin.layout.mainlayout')
@section('content')
    <button type='button' class='btn btn-primary btn-outline mb-3' id="tcmbkurguncelle">
        <i class="fa fa-plus"></i> <span>TCMB Kur Güncelle</span>
    </button>
    <div class="table-responsive">
        <div id="gridContainer"></div>
    </div>

    <div class="modal fade" id="updateExchangeRate" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                </div>
                <div class="modal-body">
                    <div id="frmEdit"></div>

                </div>
                <div class="modal-footer">

                    <button id="btnSave" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/exchangeRate.js')}}"></script>
@endsection
