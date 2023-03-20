@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a>
        Otel Hizmetleri</h4>
    <button type='button' class='btn btn-primary  mb-3' id="addFacility">
        <i class="fa fa-plus"></i> Yeni Otel Hizmeti Ekle
    </button>
    <div id="gridContainer"></div>


    <div class="modal fade" id="updateFacility" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="modelHeading"></h4>

                </div>
                <div class="modal-body">
                    <div class="nav-align-top mb-4">

                        <div id="frmEditFacility"></div>

                        <div class="language row md-form"></div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button id="btnSaveFacility" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal pencere -->

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Otel Seçim Ekranı</h4>
                </div>
                <div class="modal-body">
                    <!-- dxDataGrid bileşenini göstermek için <div> öğesi -->
                    <div class="nav-align-top mb-4">
                        <div id="gridContainerModal"></div>
                        <div id="frmEditHotel"></div>


                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSaveHotel" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>




    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/facility.js')}}"></script>
@endsection



