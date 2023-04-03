@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a> Konaklama İşlemleri </h4>
    <button type='button' class='btn btn-primary btn-outline mb-3' id="addAccomodation">
        <i class="fa fa-plus"></i> <span>Yeni Konaklama</span>
    </button>
    <div class="table-responsive">
        <div id="gridContainer"></div>
    </div>

    <div class="modal fade" id="updateAccomodation" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modalHeading"></h4>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="nav-align-top mb-4">

                        <div id="frmEdit"></div>

                        <div class="language row md-form "></div>
                    </div>
                    <button id="btnSaveMenu" type="button" class="btn btn-save btn-primary mt-3">Kaydet</button>
                </div>


            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/accomodation.js')}}"></script>
@endsection
