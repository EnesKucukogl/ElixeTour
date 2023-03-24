@extends('admin.layout.mainlayout')
@section('content')
    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a> Müşteri Mailleri </h4>
    <div id="gridContainer"></div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/contact.js')}}"></script>
    <div class="modal fade" id="updateContact" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <i class="menu-icon fa-solid fa-comments mr-3"></i>
                    <h4 class="modal-title" id="modelHeading"></h4>
                    <button
                        type="button"
                        class="btn-close"
                        data-bs-dismiss="modal"
                        aria-label="Close"
                    ></button>
                </div>
                <div class="modal-body">
                    <div id="frmEditContact"></div>
                    <button id="btnSaveContact" type="button" class="btn btn-save btn-primary mt-3 mb-3">Kaydet</button>
                    <div class="mt-3" id="frmSendMail"></div>
                    <button id="btnSendMail" type="button" class="btn btn-save btn-primary mt-3 mb-3">Gönder</button>
                    <div class="mt-3" id="gridContainerSendMail"></div>
                </div>

            </div>
        </div>
    </div>
@endsection

