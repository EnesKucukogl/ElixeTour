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
                        <div class="nav-align-top mb-4">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <button
                                        type="button"
                                        class="nav-link active"
                                        role="tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#navs-top-home"
                                        aria-controls="navs-top-home"
                                        aria-selected="true"
                                    >
                                        Konaklama Bilgileri
                                    </button>
                                </li>
                                <li class="nav-item">
                                    <button
                                        type="button"
                                        class="nav-link"
                                        role="tab"
                                        data-bs-toggle="tab"
                                        data-bs-target="#navs-top-image"
                                        aria-controls="navs-top-image"
                                        aria-selected="true"
                                    >
                                        Resimler
                                    </button>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="navs-top-home" role="tabpanel">
                                    <div id="frmEdit"></div>
                                    <button id="btnSave" type="button" class="btn btn-save btn-primary mt-3">Kaydet</button>
                                </div>
                                <div class="tab-pane fade show " id="navs-top-image" role="tabpanel">
                                    <div id="frmResimMenu"></div>
                                    <div id="gridResimContainer"></div>
                                </div>
                            </div>
                        </div>
                    </div>



                </div>

            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Otel Seçim Ekranı</h4>
                </div>
                <div class="modal-body">
                    <!-- dxDataGrid bileşenini göstermek için <div> öğesi -->
                    <div class="nav-align-top mb-4">
                        <div id="frmEditHotel"></div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="btnSaveHotel" type="button" class="btn btn-save btn-primary">Kaydet</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/accomodation.js')}}"></script>
@endsection
