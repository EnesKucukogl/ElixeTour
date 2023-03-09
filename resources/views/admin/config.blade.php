@extends('admin.layout.mainlayout')
@section('content')

    <h4 class="fw-bold py-3 mb-4"><a href="{{route('admin.home')}}"><span class="text-muted fw-light">Anasayfa /</span></a> Ayarlar</h4>
    <div id="frmEditConfig"></div>

    <button style="float: right"  id="btnSaveConfig" type="button"  class="btn btn-save btn-primary mt-3">Kaydet</button>


    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/config.js')}}"></script>


@endsection
