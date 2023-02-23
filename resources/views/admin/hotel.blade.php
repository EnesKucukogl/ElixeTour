@extends('admin.layout.mainlayout')
@section('content')
    <button type='button' class='btn btn-primary btn-xs btn-outline' id="addCorporation">
        <i class="fa fa-plus"></i> <span data-lng="yeni_sirket">Yeni Şirket</span>
    </button>
    <div class="table-responsive">
        <div id="gridContainer"></div>
    </div>
    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/hotel.js')}}"></script>
@endsection
