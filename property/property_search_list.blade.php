@section('title','Property Search') 
@extends('layouts.app')
@section('content')
@include('layouts.banner', ['banner_text' => 'Property Search'])
    <div class="container main">
        <div class="row">
            <div class="col-lg-8 col-md-12 ">
                <div class="row">
                    <div class="col-lg-7 col-md-12 f30 f300">
                        <label> Property List </label>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-7 col-8">
                        <!-- <div class="sort_custom dropdown">
                            <button class="btn btn-orange btn-block dropdown-toggle" data-toggle="dropdown" type="button" aria-expanded="false"> Sort by </button>
                            <div class="dropdown-menu" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(0px, 38px, 0px);">
                                <a class="dropdown-item" href="#">Link 1</a>
                                <a class="dropdown-item" href="#">Link 2</a>
                                <a class="dropdown-item" href="#">Link 3</a>
                            </div>
                        </div> -->
                    </div>
                    <div class=" col-lg-2 col-md-6 col-sm-5 col-4 text-right">
                        <div class=" f30 color-white float-center btn-group p-0 m-0">
                            <a class="btn-light p-0 m-0"></a>
                            <a class="btn-light p-0 m-0"></a>
                        </div>
                    </div>
                </div>
                <hr class="btn-orange">
                <div>
                    @if(count($property_list) > 0)
                        @foreach($property_list as $property)
                            <div class="p-1 ">
                                <div class="row bg-color color-gray p-3">
                                    <div class="col-md-4 col-sm-6 ">
                                        <?php $url = '/images/property_images/'.$property->cover_image; ?>
                                        <a class="color-gray f15 float-center"  href="{{ url('propertydetails/'.$property->id) }}">
                                            <img alt="property_image" class="mb-1" width="100%" src="{{url($url)}}">
                                        </a>
                                    </div>
                                    <div class="col-md-8 col-sm-6 mb-1">
                                        <div class="f25 ">
                                            <a class="color-gray f15 float-center" href="{{ url('propertydetails/'.$property->id) }}">{{$property->unit_name}} </a>
                                        </div>
                                        <div  class="f18 f700">{{$property->rent}}
                                            <span class="color-orange"> / </span>
                                            <span " class="f13 color-orange f300">Month</span>
                                        </div>
                                        <div class="f13 color-gray"><i class="fa fa-map-marker" aria-hidden="true"></i> 
                                             {{$property->address}} 
                                        </div>
                                        <div class="row f14 f300">
                                            <div class="col-md-4 "> <i class="fa fa-area-chart" aria-hidden="true"></i> {{$property->area}} Sq Ft
                                            </div>
                                            <div class="col-md-4"><i class="fa fa-bed" aria-hidden="true"></i> {{$property->bedrooms}}
                                            </div>
                                            <div class="col-md-4"><i class="fa fa-calendar" aria-hidden="true"></i> {!! \Helper::Date($property->created_at); !!}
                                            </div>
                                        </div>
                                        <div class="row btn-orange f14">
                                            <div  class="col-md-4 col-6 col-sm-6 py-1">
                                                <div ><i class="fa fa-building" aria-hidden="true"></i> {{ucfirst($property->u_type)}}
                                                </div>
                                            </div>
                                            <div  class="col-md-4 col-6 col-sm-6 py-1">
                                                <div><i class="fa fa-bath" aria-hidden="true"></i> {{ucfirst($property->toilet)}}
                                                </div>
                                            </div>
                                            <div  class="col-md-1" style="clip-path: polygon(100% 0, 0 100%, 100% 100%); background: #202020;">
                                            </div>
                                            <div  class="col-md-3 col-12 col-sm-12  py-1" style="background: #202020;"><a  class="color-white f15 float-center" href="{{ url('propertydetails/'.$property->id) }}"> More Details </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <div class="row" style="justify-content: center; margin-top: 2%;">
                            <ul class="pagination">
                                <!-- LINK FIRST AND PREV -->
                                <?php
                                // $limit = 2 ; // Amount of data per page  

                                // To determine what data will be displayed in the table in the database
                                $limit_start = ( $page - 1 ) * $limit ;    
                                if($page == 1){ // Jika page adalah page ke 1, maka disable link PREV
                                ?>
                                <li class="disabled active"><a class="btn mx-1" href="#">First</a></li>
                                <li class="disabled"><a class="btn btn-InActive mx-1" href="#">&laquo;</a></li>
                                <?php
                                }else{ // Jika page bukan page ke 1
                                $link_prev = ($page > 1)? $page - 1 : 1;
                                ?>
                                <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=1">First</a></li>
                                <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=<?php echo $link_prev; ?>">&laquo;</a></li>
                                <?php
                                }
                                ?>

                                <!-- LINK NUMBER -->
                                <?php
                                $jumlah_page = $total_pages; // Hitung jumlah halamannya
                                $jumlah_number = 3; // Tentukan jumlah link number sebelum dan sesudah page yang aktif
                                $start_number = ($page > $jumlah_number)? $page - $jumlah_number : 1; // Untuk awal link number
                                $end_number = ($page < ($jumlah_page - $jumlah_number))? $page + $jumlah_number : $jumlah_page; // Untuk akhir link number

                                for($i = $start_number; $i <= $end_number; $i++){
                                $link_active = ($page == $i)? ' class="active"' : '';
                                $btn_active = ($page == $i)? '' : 'btn-InActive';
                                ?>
                                <li<?php echo $link_active; ?>><a class="btn mx-1 <?php echo $btn_active; ?>" href="<?php echo url()->full(); ?>&pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                <?php
                                }
                                ?>

                                <!-- LINK NEXT AND LAST -->
                                <?php
                                // Jika page sama dengan jumlah page, maka disable link NEXT nya
                                // Artinya page tersebut adalah page terakhir 
                                if($page == $jumlah_page){ // Jika page terakhir
                                ?>
                                <li class="disabled"><a class="btn btn-InActive mx-1" href="#">&raquo;</a></li>
                                <li class="disabled active"><a class="btn mx-1" href="#">Last</a></li>
                                <?php
                                }else{ // Jika Bukan page terakhir
                                $link_next = ($page < $jumlah_page)? $page + 1 : $jumlah_page;
                                ?>
                                <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=<?php echo $link_next; ?>">&raquo;</a></li>
                                <li><a class="btn btn-InActive mx-1" href="<?php echo url()->full(); ?>&pageno=<?php echo $jumlah_page; ?>">Last</a></li>
                                <?php
                                }
                                ?>
                            </ul>
                        </div>
                    @else
                    <p>No result found!</p>             
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-12 ">
                <div class="row my-4">
                  <div class="col-md-12 col-sm-12 col-12">
                    <div class="f25 f300 color-gray">
                      <i class="fa fa-minus color-orange" aria-hidden="true"></i> Advanced search
                    </div>
                    <form action="{{url('property-search')}}" method="get">
                        @csrf
                        <div class="form-group">
                            <input name="latitude" id="latitude" type="hidden" value="{{ $_GET['latitude']}}">   
                            <input name="longitude" id="longitude" type="hidden" value="{{ $_GET['longitude']}}">
                            <input id="autocomplete" name="search" class="form-control autocomplete" placeholder="Enter your address" type="text" autocomplete="off" value="{{ $_GET['search']}}">
                        </div>
                        <div class="form-group">
                            <select name="property_type" class="form-control color-gray">
                                <option value="">Property Type</option>
                                <option value="residential">Residential</option>
                                <option value="industrial">Industrial</option>
                                <option value="house">House</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input name="keyword" class="form-control" placeholder="Keyword" type="text"/>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-orange btn-block search_">Search</button>
                            </div>
                        </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        .property_images img {width: 250px; }
        .property_description .title {font-size: 20px; font-weight: bold; color: #ff8500; }
        .property_description-body span {font-size: 16px; font-weight: bold; padding-right: 10px; }
        .property_description-body {margin: 20px 10px; }
        .property_description-body div {padding: 5px 0; }
        .property-action {text-align: center; }
        .property-action button {text-decoration: none; padding: 10px 39px; width: 200px; font-size: 14px; background-color: #f28401; color: #fff; border-radius: 5px; border: 0; }
        .main { margin-bottom: 10%; }
        .mb-3, .my-3 { margin-bottom: 1rem !important; }
        .mt-3, .my-3 { margin-top: 1rem !important;}
        .f400 { font-weight: 400 !important; }
        .f30 { font-size: 30px !important; }
        .color-gray { color: rgba(0, 0, 0, 0.6) !important; }
        .f500 {    font-weight: 500 !important; }
        .mb-4, .my-4 {    margin-bottom: 1.5rem!important; }
        .f500 {    font-weight: 500 !important; }
        .mt-4, .my-4 {    margin-top: 1.5rem!important;}
        .bg-color {    background-color: #f1f1f1 !important;}
        .row { display: flex;flex-wrap: wrap;margin-right: -15px;margin-left: -15px; }
        .f300 { font-weight: 300 !important;}
        .f15 { font-size: 15px !important; }
        .mb-2, .my-2 { margin-bottom: .5rem!important; }
        .mt-2, .my-2 {   margin-top: .5rem!important; }
        .text-right {    text-align: right!important;}
        .p-0 {    padding: 0!important;}
        .m-0 {    margin: 0!important;}
        .btn-group, .btn-group-vertical {    position: relative;    display: inline-flex; vertical-align: middle; }
        .color-white {    color: #fff !important;}
        a:not([href]):not([tabindex]) {    color: inherit;    text-decoration: none;}
        .p-0 {   padding: 0!important;}
        .m-0 {    margin: 0!important;}
        .btn-light {    color: #212529;background-color: #f8f9fa; border-color: #f8f9fa;}
        .dropdown, .dropleft, .dropright, .dropup {    position: relative;}
        .dropdown-toggle {    white-space: nowrap;}
        .btn-block {    display: block;    width: 100%;}
        .btn-orange {    background-color: #ff8500 !important;color: #ffffff !important;}
        .p-1 {    padding: .25rem!important;}
        .p-3 {    padding: 1rem!important; }
        .f15 {    font-size: 15px !important;}
        .mb-1, .my-1 {margin-bottom: .25rem!important;}
        img {    vertical-align: middle;    border-style: none;}
        .f25 {    font-size: 25px !important;}
        .f700 {
            font-weight: 700 !important;
        }
        .color-orange {
            color: #ff8500;
        }
        .f13 {
            font-size: 13px !important;
        }
        .f18 {
            font-size: 18px !important;
        }
        .f14 {
            font-size: 14px !important;
        }
        .pb-1, .py-1 {
            padding-bottom: .25rem!important;
        }

        .pt-1, .py-1 {
            padding-top: .25rem!important;
        }
        .ml-1, .mx-1 {
            margin-left: .25rem!important;
        }

        .mr-1, .mx-1 {
            margin-right: .25rem!important;
        }

        hr {
            margin-top: 1rem;
            margin-bottom: 1rem;
            border: 0;
            border-top: 1px solid rgba(0,0,0,.1);
        }
        .sort_custom .dropdown-toggle::after {
            display: inline-block;
            margin-left: .255em;
            vertical-align: .255em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }
        .pagination>.active>a, .pagination>.active>a:focus, .pagination>.active>a:hover, .pagination>.active>span, .pagination>.active>span:focus, .pagination>.active>span:hover {
            color: #fff;
            background-color: #f48400;
            border-color: #f48400;
        }
        .pagination>li>a:focus, .pagination>li>a:hover, .pagination>li>span:focus, .pagination>li>span:hover {
            color: #fff;
            background-color: #f48400;
            border-color: #ddd;
        }
        .pagination>li>a, .pagination>li>span {
            color: #f48400;
        }
        /*.dropdown-menu {
            position: absolute;
            top: 100%;
            left: 0;
            z-index: 1000;
            display: none;
            float: left;
            min-width: 10rem;
            padding: .5rem 0;
            margin: .125rem 0 0;
            font-size: 1rem;
            color: #212529;
            text-align: left;
            list-style: none;
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid rgba(0,0,0,.15);
            border-radius: .25rem;
        }*/
        .dropdown-item {
            display: block;
            width: 100%;
            padding: .25rem 1.5rem;
            clear: both;
            font-weight: 400;
            color: #212529;
            text-align: inherit;
            white-space: nowrap;
            background-color: transparent;
            border: 0;
        }
        .btn {
            display: inline-block;
            margin-bottom: 0;
            font-weight: 400;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            -ms-touch-action: manipulation;
            touch-action: manipulation;
            cursor: pointer;
            background-image: none;
            border: 1px solid transparent;
            padding: 6px 12px;
            font-size: 14px;
            line-height: 1.42857143;
            border-radius: 4px;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }
        .f300 i.fa  {color: #f48400;}
        i.fa.fa-map-marker {color: #f48400;}
        a {
            color: #007bff;
            text-decoration: none;
            background-color: transparent;
        }
        .btn-orange {    background-color: #ff8500 !important;color: #ffffff !important;}
        
    </style>
@endsection