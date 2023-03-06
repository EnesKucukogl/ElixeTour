@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a> Paketler</h4>
    <button type='button' class='btn btn-primary  mb-3' id="addMenu">
        <i class="fa fa-plus"></i> Yeni Paket Ekle
    </button>
    <div id="gridContainer"></div>


    <div class="modal fade" id="updateMenu" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>

                </div>
                <div class="modal-body">
                    <div class="nav-align-top mb-4">

                        <div id="frmEditMenu"></div>

                        <div class="language row md-form "></div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button id="btnSaveMenu" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/package.js')}}"></script>
@endsection



