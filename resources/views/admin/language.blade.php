@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a> Diller </h4>
    <button type='button' class='btn btn-primary  mb-3' id="addLanguage">
        <i class="fa fa-plus"></i> Yeni Dil Ekle
    </button>
    <div id="gridContainer"></div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/language.js')}}"></script>

    <div class="modal fade" id="updateLanguage" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div class="nav-align-top mb-4">

                        <div id="frmEditLanguage"></div>

                        <div class="language row md-form "></div>
                    </div>
                    <button id="btnSaveLanguage" type="button" class="btn btn-save btn-primary mt-3">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
@endsection
