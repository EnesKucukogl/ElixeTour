@extends('layout.mainlayout')
@section('content')
    @php

        $file_path = getImage($packageFile,$package->Id);
        $package_name = viewLanguageSupport($package->packageTextContent);

        if($file_path === null || $file_path === '')
        {
            $file_path = 'img/no-image.png';
        }
    @endphp
    <script>

        //ready function ajax


        var selectedDayId;
        var selectedDayPrice;
        var selectedRoomId;
        var selectedRoomPrice;
        var selectedRoomPassengersPrice;
        var selectedRoomPassengersId;
        var selectedRoomFoodTypePrice;
        var selectedRoomFoodTypeId;
        var selectedRoomName;
        var selectedRoomPassengersName;
        var selectedRoomFoodTypeName;
        var name;
        var surname;
        var email;
        var phone;
        var packageId;
        var hotelId;
        var packageName;
        var hotelName;
        var totalPrice;
        var dayCount;
        var dayName;

        function setDayPrice() {
            selectedDayId = document.getElementById("selected_packpage").selectedOptions[0].getAttribute("data-day-id");
            selectedDayPrice = document.getElementById("selected_packpage").selectedOptions[0].getAttribute("data-price");

            dayCount = document.getElementById("selected_packpage").selectedOptions[0].getAttribute("data-day-count");
            dayName = document.getElementById("selected_packpage").selectedOptions[0].getAttribute("data-day-name");

            document.getElementById("selected_price").innerHTML = '$' + selectedDayPrice;
            document.getElementById("frm1_totalPrice").innerHTML = 'Total Price: $' + selectedDayPrice;
        }

        function setRoomPrices(accomodation_id, hotel_id) {

            var room_price_text = document.getElementById("room_price-" + accomodation_id)
            var total_room_price_text = document.getElementById("total_room_price-" + accomodation_id)

            var roomPassengersPrice = document.getElementById("selected_room_passengers-" + accomodation_id).selectedOptions[0].getAttribute("data-name");
            var roomFoodTypePrice = document.getElementById("selected_room_foodType-" + accomodation_id).selectedOptions[0].getAttribute("data-name");
            var singlePrice;
            $.ajax({
                type: "GET",
                url: '/getSinglePrice',
                datatype: "json",
                data: {
                    hotel_id: hotel_id,
                    accomodation_id: accomodation_id,
                    room_type_detail: roomPassengersPrice,
                    room_board: roomFoodTypePrice
                },
                async: false,
                success: function (data) {
                    singlePrice = data;
                }
            });


            //console.log(roomFoodTypePrice);
            var total_price = parseFloat(singlePrice.sales_price) + parseFloat(selectedDayPrice);
            var total_room_price = parseFloat(singlePrice.sales_price);

            room_price_text.innerHTML = singlePrice.sales_currency_symbol + ' ' + total_room_price;
            total_room_price_text.innerHTML = singlePrice.sales_currency_symbol + ' ' + total_price;

        }

        function setAllRoomsPrices(hotel_id) {

            $.ajax({
                type: "GET",
                url: '/getHotelAccomodation',
                datatype: "json",
                data: {hotel_id: hotel_id},
                async: false,
                success: function (data) {
                    $.each(data, function (index, value) {
                        $.ajax({
                            type: "GET",
                            url: '/getHotelAccodomotationType',
                            datatype: "json",
                            data: {hotel_id: hotel_id, accomodation_id: value.Id},
                            async: false,
                            success: function (data) {
                                $.each(data, function (index, value) {
                                    setRoomPrices(value.accomodation_id, value.hotel_id);
                                });
                            }
                        });
                    });

                }
            });
        }

        function frmRoomClick(room_id, room_price) {

            selectedRoomPassengersPrice = document.getElementById("selected_room_passengers-" + room_id).selectedOptions[0].getAttribute("data-price");
            selectedRoomPassengersId = document.getElementById("selected_room_passengers-" + room_id).selectedOptions[0].getAttribute("data-id");
            selectedRoomFoodTypePrice = document.getElementById("selected_room_foodType-" + room_id).selectedOptions[0].getAttribute("data-price");
            selectedRoomFoodTypeId = document.getElementById("selected_room_foodType-" + room_id).selectedOptions[0].getAttribute("data-id");
            selectedRoomPassengersName = document.getElementById("selected_room_passengers-" + room_id).selectedOptions[0].getAttribute("data-name");
            selectedRoomFoodTypeName = document.getElementById("selected_room_foodType-" + room_id).selectedOptions[0].getAttribute("data-name");
            selectedRoomName = document.getElementById("selected_room_name-" + room_id).getAttribute("data-name");

            selectedRoomId = room_id;
            selectedRoomPrice = room_price;
            totalPrice = parseFloat(selectedRoomPrice) + parseFloat(selectedRoomPassengersPrice) + parseFloat(selectedRoomFoodTypePrice) + parseFloat(selectedDayPrice);
            setReviewPage();

        }

        function frmclick() {
            name = document.getElementById("i_name").value;
            surname = document.getElementById("i_surname").value;
            email = document.getElementById("i_email").value;
            phone = document.getElementById("i_phone").value;
            check = document.getElementById("i_check").checked;

            if (name == "" || surname == "" || email == "" || phone == "" || check == false) {
                alert("Please fill all fields");
                return;
            }


            var data = {
                name: name,
                surname: surname,
                email: email,
                phone: phone,
                PackageId: packageId,
                PackageName: packageName,
                DayId: selectedDayId,
                DayName: dayName,
                DayPrice: selectedDayPrice,
                DayCount: dayCount,
                HotelId: hotelId,
                HotelName: hotelName,
                RoomId: selectedRoomId,
                RoomPrice: selectedRoomPrice,
                RoomPassengersPrice: selectedRoomPassengersPrice,
                RoomPassengersId: selectedRoomPassengersId,
                RoomFoodTypePrice: selectedRoomFoodTypePrice,
                RoomFoodTypeId: selectedRoomFoodTypeId,
                RoomName: selectedRoomName,
                RoomPassengersName: selectedRoomPassengersName,
                RoomFoodTypeName: selectedRoomFoodTypeName,
                TotalPrice: totalPrice
            }

            $.ajax({
                type: "POST",
                url: "sendRequest.php",
                data: data,
                success: function (response) {
                    alert("Your request has been sent successfully! We will contact you as soon as possible.");
                    $.ajax({
                        type: "POST",
                        url: "sendRequestResponse.php",
                        data: data,
                        success: function (response) {
                            document.getElementById("frm1").reset();
                        }
                    });
                }
            });
        }

        function setReviewPage() {
            if (dayName.length > 0) {
                document.getElementById("review_package_name").innerHTML += ' - ' + dayName;
            }
            document.getElementById("review_room_price").innerHTML = "$" + selectedRoomPrice;
            document.getElementById("review_roomPerson_price").innerHTML = "$" + selectedRoomPassengersPrice;
            document.getElementById("review_roomFoodType_price").innerHTML = "$" + selectedRoomFoodTypePrice;
            document.getElementById("review_total_price").innerHTML = "$" + (parseFloat(selectedDayPrice) + parseFloat(selectedRoomPrice) + parseFloat(selectedRoomPassengersPrice) + parseFloat(selectedRoomFoodTypePrice));

            document.getElementById("review_room_name").innerHTML = selectedRoomName;
            document.getElementById("review_roomPerson_name").innerHTML = selectedRoomPassengersName
            document.getElementById("review_roomFoodType_name").innerHTML = selectedRoomFoodTypeName

        }

    </script>

    <!-- Common Banner Area -->
    <section id="common_banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="common_bannner_text">
                        <h2>Buy Package</h2>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Area -->
    <section id="" class="section_padding">
        <div class="container">
            <div class="row d-flex justify-content-center align-content-center">
                <div class="col-12 bg-light card">
                    <div class="bs-stepper">
                        <div class="bs-stepper-header" role="tablist">
                            <!-- your steps here -->
                            <div class="step" data-target="#rooms-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="rooms-part"
                                        id="rooms-part-trigger">
                                    <span class="bs-stepper-circle">1</span>
                                    <span class="bs-stepper-label" onclick="next()">Package Details</span>
                                </button>
                            </div>
                            <div class="line" id="line-1"></div>
                            <div class="step" data-target="#package-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="package-part"
                                        id="package-part-trigger">
                                    <span class="bs-stepper-circle">2</span>
                                    <span class="bs-stepper-label">Room Details</span>
                                </button>
                            </div>
                            <div class="line" id="line-2"></div>
                            <div class="step" data-target="#information-part">
                                <button type="button" class="step-trigger" role="tab" aria-controls="information-part"
                                        id="information-part-trigger">
                                    <span class="bs-stepper-circle">3</span>
                                    <span class="bs-stepper-label">Customer Details</span>
                                </button>
                            </div>
                        </div>

                        <div class="bs-stepper-content">
                            <form name="frm1" id="frm1">
                                <!-- your steps content here -->
                                <div id="rooms-part" class="content" role="tabpanel"
                                     aria-labelledby="rooms-part-trigger">

                                    <div class="row">

                                        <div class="col-lg-4">
                                            <h3 class="mt-4 mb-4">Selected Package</h3>
                                            <div class="theme_common_box_two img_hover"
                                                 style="border:#44aa44 solid 2px">
                                                <div class="theme_two_box_img">
                                                    <a href="package/{{$package->slug}}"><img src="/{{$file_path}}"
                                                                                              alt="img"></a>
                                                    <p><i class="fas fa-map-marker-alt"></i>Package</p>
                                                </div>
                                                <div class="theme_two_box_content">
                                                    <h4><a href="package/{{$package->slug}}">{{$package_name}}</a></h4>
                                                    @if($package->package_type == 2)
                                                        <div class="col-lg-6">
                                                            <div class="form-group">
                                                                <select id="selected_packpage" name="frm_dayPrice"
                                                                        onchange="setDayPrice()"
                                                                        class="form-control form-select bg_input mt-4 mb-4">

                                                                    <option data-day-id="0"
                                                                            data-day-count="{$package->duration}}"
                                                                            data-price="{{$package->price}}"
                                                                            data-day-name="Single" value="0">Single
                                                                    </option>
                                                                    <option data-day-id="1"
                                                                            data-day-count="{$package->duration}}"
                                                                            data-price="{{$package->price*2}}"
                                                                            data-day-name="Double" value="1">Double
                                                                    </option>


                                                                </select>
                                                            </div>
                                                        </div>
                                                        <h3 id="selected_price">
                                                            {{$package->price_currency_code."".$package->price}}
                                                        </h3>

                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-8">
                                            <div class="tour_details_boxed">

                                                <div class="tour_details_boxed_inner">
                                                    <table class="table table-bordered table-striped">
                                                        <thead>
                                                        <tr>
                                                            <th scope="col"><i class="fa fa-heart"
                                                                               style="margin-right: 10px;color:#ed1c24;"></i>Therapies
                                                            </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($package_treatment as $item)
                                                            @php

                                                                $treatment_name = viewLanguageSupport($item->treatmentTextContent);
                                                            @endphp
                                                            <tr>
                                                                <td>{{$treatment_name}}</td>

                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h3 class="mt-4 mb-4">Featured Packages</h3>
                                        @foreach($hotelPackage as $item)

                                            @if($item->package_type == 2)
                                                @php
                                                    $file_path = getImage($otelPackageFile,$item->Id);

                                                    $package_name = viewLanguageSupport($item->packageTextContent);

                                                    if($file_path === null || $file_path === '')
                                                    {
                                                        $file_path = 'img/no-image.png';
                }
                                                @endphp
                                                <div class="col-lg-4 col-6">
                                                    <div class="theme_common_box_two img_hover">
                                                        <div class="theme_two_box_img">
                                                            <a href="package/{{$item->slug}}"><img src="/{{$file_path}}"
                                                                                                   alt="img"></a>
                                                            <p><i class="fas fa-map-marker-alt"></i>{{ __('Package') }}
                                                            </p>
                                                        </div>
                                                        <div class="theme_two_box_content">
                                                            <h4><a href="package/{{$item->slug}}">{{$package_name}}</a>
                                                            </h4>
                                                            <p><span
                                                                    class="review_rating">{{$item->duration}} {{ __('Days') }}</span>
                                                            </p>
                                                            <h3>{{$item->price_currency_code."".$item->price}}<span
                                                                    class="price-starts">{{ __('Price starts from') }}</span>
                                                            </h3>
                                                            <a href='/process/{{$item->Id}}/{{$hotel->Id}}'
                                                               class="custom-btn btn-5 mt-3">Choose
                                                                Package</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                        <script>


                                            function setRoomPrice(room_id, roomPrice, select, index) {
                                                if (index == 0) {
                                                    var price = select.options[select.selectedIndex].getAttribute("data-price");
                                                    var price2 = select.parentElement.childNodes[7].options[select.parentElement.childNodes[7].selectedIndex].getAttribute("data-price2");
                                                    console.log(roomPrice);
                                                    console.log(price);
                                                    console.log(price2);
                                                    var packagePrice = $('.pricetag1').text().split("$")[1];
                                                    console.log(packagePrice);
                                                    var roomTotalPrice = parseFloat(roomPrice) + parseFloat(price) + parseFloat(price2);
                                                    var totalPrice = parseFloat(roomPrice) + parseFloat(price) + parseFloat(price2) + parseFloat(packagePrice);
                                                    document.getElementById("totalRoomPrice-" + room_id).innerHTML = "$" + roomTotalPrice;
                                                    document.getElementById("totalPrice2-" + room_id).innerHTML = "$" + totalPrice;
                                                } else {
                                                    var price = select.options[select.selectedIndex].getAttribute("data-price2");
                                                    var price2 = select.parentElement.childNodes[3].options[select.parentElement.childNodes[3].selectedIndex].getAttribute("data-price");
                                                    console.log(roomPrice);
                                                    console.log(price);
                                                    console.log(price2);
                                                    var packagePrice = $('.pricetag1').text().split("$")[1];
                                                    console.log(packagePrice);
                                                    var roomTotalPrice = parseFloat(roomPrice) + parseFloat(price) + parseFloat(price2);
                                                    var totalPrice = parseFloat(roomPrice) + parseFloat(price) + parseFloat(price2) + parseFloat(packagePrice);
                                                    document.getElementById("totalRoomPrice-" + room_id).innerHTML = "$" + roomTotalPrice;
                                                    document.getElementById("totalPrice2-" + room_id).innerHTML = "$" + totalPrice;
                                                }
                                                console.log("----");

                                            };

                                            function triggerOnChange() {
                                                var elements = document.getElementsByClassName("priceSelectTrigger");
                                                for (var i = 0; i < elements.length; i++) {
                                                    elements[i].onchange();
                                                }
                                            }

                                            var setPrice = function (selected_price) {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "setPrice.php",
                                                    data: {price: selected_price},
                                                    success: function (data) {
                                                        console.log(data);
                                                        $('.pricetag1').html('Total Price: $' + data);
                                                    }
                                                });
                                            };

                                            function getSelectedPrice() {
                                                var selected_price = document.getElementById("selected_packpage").options[document.getElementById("selected_packpage").selectedIndex].getAttribute("data-price");
                                                document.getElementById("selected_price").innerHTML = "$" + selected_price;
                                                setPrice(selected_price);

                                            }

                                            function getSelectedPriceValue() {
                                                var selected_price = document.getElementById("selected_packpage").options[document.getElementById("selected_packpage").selectedIndex].getAttribute("data-price");
                                                return selected_price;

                                            }

                                            /*   function selectOtherPackage(selected_package_id) {
                                                   window.location.href = "process.php?package_id=" + selected_package_id;
                                               }
                       */
                                            function setDetails(roomId, onlyRoomPrice) {
                                                var packagePrice = document.getElementById("selected_packpage").options[document.getElementById("selected_packpage").selectedIndex].getAttribute("data-price");
                                                var reviewPrice = document.getElementById("review_package_price");

                                                reviewPrice.innerHTML = "$" + packagePrice;

                                                var roomDiv = document.getElementById("roomDiv-" + roomId);
                                                var passengerPrice = roomDiv.getElementsByClassName("selectPassenger")[0].options[roomDiv.getElementsByClassName("selectPassenger")[0].selectedIndex].getAttribute("data-price");
                                                var foodPrice = roomDiv.getElementsByClassName("selectFoodType")[0].options[roomDiv.getElementsByClassName("selectFoodType")[0].selectedIndex].getAttribute("data-price2");
                                                var roomPrice = onlyRoomPrice;
                                                var roomName = roomDiv.getElementsByClassName("selectRoomName")[0].textContent;

                                                console.log(roomDiv);

                                                document.getElementById("review_room_price").innerHTML = "$" + roomPrice;
                                                document.getElementById("review_roomPerson_price").innerHTML = "$" + passengerPrice;
                                                document.getElementById("review_roomFoodType_price").innerHTML = "$" + foodPrice;
                                                document.getElementById("review_total_price").innerHTML = "$" + (parseFloat(packagePrice) + parseFloat(roomPrice) + parseFloat(passengerPrice) + parseFloat(foodPrice));

                                                document.getElementById("review_room_name").innerHTML = roomName;
                                                document.getElementById("review_roomPerson_name").innerHTML = roomDiv.getElementsByClassName("selectPassenger")[0].options[roomDiv.getElementsByClassName("selectPassenger")[0].selectedIndex].text;
                                                document.getElementById("review_roomFoodType_name").innerHTML = roomDiv.getElementsByClassName("selectFoodType")[0].options[roomDiv.getElementsByClassName("selectFoodType")[0].selectedIndex].text;

                                                event.preventDefault();
                                                $.post("sendRequest.php", {room_id: roomId});

                                            }
                                        </script>
                                    </div>

                                    <div class="row d-flex justify-content-end">
                                        <div class="col-lg-4 p-0 card">
                        <span id="frm1_totalPrice" class="display-6 pricetag1 text-center p-4"
                              style="font-size:24px"></span>
                                            <button type="button" class="btn btn_theme btn_md float-end m-0"
                                                    name="next1"
                                                    onclick="next();setAllRoomsPrices({{$hotel->Id}});">Next
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div id="package-part" class="content" role="tabpanel"
                                     aria-labelledby="package-part-trigger">

                                    @foreach ($hotelAccomodation as $item)

                                        @php
                                            $accomodationId =  $item->Id;
                                                      $hotelAccomodationTypeArr = getAccomodationType($hotelAccomodationType,$accomodationId);
                                                      $file_path = getImage($otelAccomodationFile,$item->Id);

                                                      if($file_path === null || $file_path === '')
                                                      {
                                                          $file_path = 'img/no-image.png';
                                                      }

                                        @endphp
                                        @if(count($hotelAccomodationTypeArr) > 0)
                                            <div class="row">
                                                <div class="room_book_item" id="roomDiv-' . $room->id . '">
                                                    <div class="room_book_img col-4">
                                                        <img src="/{{$file_path}}" alt="img">
                                                    </div>
                                                    <div class="room_booking_right_side">
                                                        <div class="room_booking_heading">
                                                            <h3><a href="#"
                                                                   id="selected_room_name-{{$item->Id}}"
                                                                   data-name="{{$item->room_type}}"
                                                                   class="selectRoomName">{{$item->room_type}}
                                                                </a></h3>

                                                            <div class="room_fasa_area">

                                                            </div>
                                                        </div>
                                                        <div class="room_person_select">

                                                            <h3 id="room_price-{{$item->Id}}"><sub> - room price</sub>
                                                            </h3>
                                                            @php
                                                                $grouped_data_room_type_detail = array_reduce($hotelAccomodationTypeArr, function($result, $item) {
                                                                $room_type_detail = $item->room_type_detail;
                                                                if (!isset($result[$room_type_detail])) {
                                                                    $result[$room_type_detail] = array();
                                                                }
                                                                $result[$room_type_detail][] = $item;
                                                                return $result;
                                                            }, array());
                                                            //var_dump($grouped_data_room_type_detail);
                                                            @endphp
                                                            <select
                                                                onchange="setRoomPrices({{$item->Id}},{{$hotel->Id}})"
                                                                id="selected_room_passengers-{{$item->Id}}"
                                                                class="form-select selected_room_passengers_c">
                                                                @foreach($grouped_data_room_type_detail as $room_type_detail => $value)

                                                                    <option
                                                                        data-id="{{$room_type_detail}}"
                                                                        data-name="{{$room_type_detail}}"
                                                                        value="{{$room_type_detail}}">{{$room_type_detail}}
                                                                    </option>
                                                                @endforeach

                                                            </select>

                                                            <br>
                                                            @php
                                                                $grouped_data_room_board = array_reduce($hotelAccomodationTypeArr, function($result, $item) {
                                                                $room_board = $item->room_board;
                                                                if (!isset($result[$room_board])) {
                                                                    $result[$room_board] = array();
                                                                }
                                                                $result[$room_board][] = $item;
                                                                return $result;
                                                            }, array());
                                                            //var_dump($grouped_data);
                                                            @endphp
                                                            <select
                                                                onchange="setRoomPrices({{$item->Id}},{{$hotel->Id}})"
                                                                id="selected_room_foodType-{{$item->Id}}"
                                                                class="form-select priceSelectTrigger selected_room_foodTypes_c">
                                                                @foreach($grouped_data_room_board as $room_board => $value)
                                                                    <option
                                                                        data-id="{{$room_board}}"
                                                                        data-name="{{$room_board}}"
                                                                        value="{{$room_board}}">{{$room_board}}
                                                                    </option>
                                                                @endforeach

                                                            </select>
                                                            <br>
                                                            <div class="room_person_select_btn">
                                                                <h3 class="total_room_prices_c" data-id='{{$item->Id}}'
                                                                id="total_room_price-{{$item->Id}}"></h3>
                                                                <button type="button" name="frm_room"
                                                                        value="{{$item->Id}}"
                                                                        onclick="next(); frmRoomClick();"
                                                                        class="btn btn_theme btn_md frm_room">Book Now
                                                                </button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach

                                    <button type="button" name="previous1" onclick="previous();"
                                            class="btn btn_theme btn_md float-start mt-4 mb-2"
                                    >Previous
                                    </button>
                                </div>
                                <div id="information-part" class="content" role="tabpanel"
                                     aria-labelledby="information-part-trigger">
                                       <div class="row">


                                            <div class="col-lg-4 col-md-6 col-12">
                                                <h2 class="mb-4">Review</h2>
                                                <h3 class="mt-4 mb-4">Your Purchase Information</h3>
                                                <div class="theme_common_box_two img_hover" style="border:#44aa44 solid 3px">
                                                    <div class="theme_two_box_img">
                                                        <a href="#"><img src="dsds" alt="img"></a>
                                                        <p><i class="fas fa-map-marker-alt">dsds</i></p>
                                                    </div>
                                                    <div class="theme_two_box_content">
                                                        <h4><a href="#" id="review_hotel_name">dsds</a></h4>
                                                        <div class="col-lg-12 d-flex mb-4 mt-4" style="justify-content:space-between;">

                                                            <h5><a href="#" id="review_package_name">dsds</a></h5>
                                                            <h5 id="review_package_price" class="text-secondary"></h5>
                                                        </div>
                                                        <div class="col-lg-12 d-flex mb-4" style="justify-content:space-between;">
                                                            <h4><a href="#" id="review_room_name"></a></h4>
                                                            <h5 id="review_room_price" class="text-secondary"></h5>
                                                        </div>
                                                        <div class="col-lg-12 d-flex mb-4" style="justify-content:space-between;">
                                                            <h4><a href="#" id="review_roomPerson_name"></a></h4>
                                                            <h5 id="review_roomPerson_price" class="text-secondary"></h5>
                                                        </div>
                                                        <div class="col-lg-12 d-flex mb-4" style="justify-content:space-between;">
                                                            <h4><a href="#" id="review_roomFoodType_name"></a></h4>
                                                            <h5 id="review_roomFoodType_price" class="text-secondary"></h5>
                                                        </div>
                                                        <br>
                                                        <div class="col-lg-12">
                                                            <h4><a href="#" id="" class="float-end mt-4 mb-2">Total Price</a></h4>
                                                            <h5 id="review_total_price" class="text-secondary float-end mb-4"></h5>
                                                        </div>


                                                        <h4 id="review_total_price"></h4>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-8 col-md-12 col-12 mt-5" style="padding:50px;">
                                                <div class="row g-3 needs-validation" novalidate>
                                                    <h3 class="mb-4">Personal Information</h3>
                                                    <div class="col-md-6">
                                                        <label for="validationCustom01" class="form-label">Ad</label>
                                                        <input type="text" class="form-control" id="i_name" value=""
                                                               required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="validationCustom02" class="form-label">Soyad</label>
                                                        <input type="text" class="form-control" id="i_surname" value=""
                                                               required>
                                                        <div class="valid-feedback">
                                                            Looks good!
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="validationCustomUsername" class="form-label">E-Posta</label>
                                                        <div class="input-group has-validation">
                                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                            <input type="email" class="form-control" id="i_email"
                                                                   aria-describedby="inputGroupPrepend" required>
                                                            <div class="invalid-feedback">
                                                                Please choose a mail.
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <label for="validationCustom03" class="form-label">Telefon</label>
                                                        <input type="tel" class="form-control" id="i_phone" required>
                                                        <div class="invalid-feedback">
                                                            Please provide a valid phone.
                                                        </div>
                                                    </div>
                                                    <div class="col-12">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox" value="" id="i_check"
                                                                   required>
                                                            <label class="form-check-label" for="invalidCheck">
                                                                I agree to the terms and conditions.
                                                            </label>
                                                            <div class="invalid-feedback">
                                                                You must agree before submitting.
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                    <button type="button" name="previous2" onclick="previous();"
                                            class="btn btn_theme btn_md float-start mt-4 mb-2"
                                    >Previous
                                    </button>
                                    <button type="button" name="submit" onclick="frmclick()"
                                            class="btn btn_theme btn_md float-end mt-4 mb-2"
                                    >Submit
                                    </button>
                                </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <script>

        //ready function
        setDayPrice();


        setRoomPrices();

    </script>

@endsection
