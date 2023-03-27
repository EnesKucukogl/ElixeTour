@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a>
        Müşteriler </h4>
    <div id="gridContainer"></div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/customer.js')}}"></script>

    <div class="modal fade" id="updateCustomer" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-header">
                    <i class="menu-icon fa-solid fa-circle-question mr-3"></i>
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
                        <div id="frmEditCustomer"></div>
                        <div class="language row md-form "></div>
                    </div>
                    <button id="btnSaveCustomer" type="button" class="btn btn-save btn-primary mt-3">Kaydet</button>
                </div>


            </div>
        </div>
    </div>
@endsection
