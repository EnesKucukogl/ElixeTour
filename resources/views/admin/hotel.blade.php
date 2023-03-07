@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a> Oteller </h4>
    <button type='button' class='btn btn-primary btn-outline mb-3' id="addHotel">
        <i class="fa fa-plus"></i> <span data-lng="yeni_sirket">Yeni Otel</span>
    </button>
    <div class="table-responsive">
        <div id="gridContainer"></div>
    </div>

    <div class="modal fade" id="updateOtel" aria-hidden="true">
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
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/hotel.js')}}"></script>
@endsection
