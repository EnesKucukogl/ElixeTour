@extends('admin.layout.mainlayout')
@section('content')

    <p><img class="w-px-100 h-auto rounded-circle"  width="100%" src="{{URL::asset('admin-assets/img/avatars/1.png')}}" alt="profile">

    <div id="frmEditProfile"></div>

    <button style="float: right"  id="btnSaveProfile" type="button"  class="btn btn-save btn-primary">Kaydet</button>


    <script type="text/javascript" src="{{URL::asset('/js/admin-pages/profile.js')}}"></script>


@endsection
