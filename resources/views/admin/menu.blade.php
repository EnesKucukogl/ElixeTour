@extends('admin.layout.mainlayout')
@section('content')



    <button type='button' class='btn btn-primary  mb-3' id="addMenu">
        <i class="fa fa-plus"></i> Yeni Menü Ekle
    </button>
    <div id="gridContainer"></div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/menu.js')}}"></script>



    <div class="modal fade" id="updateMenu" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>
                </div>
                <div class="modal-body">
                    <div class="nav-align-top mb-4">

                        <div id="frmEditMenu"></div>

                        <div class="language"></div>

                    </div>

                </div>
                <div class="modal-footer">

                    <button id="btnSaveMenu" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
@endsection



