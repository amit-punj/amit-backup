@extends('layouts.app')
@section('content')
        <div class="container">
            <div class="banner-main">
                <div class="row">
                     <div class="col-sm-4">
                        <div class="findSearch"> Find properties to Rent</div>
                    </div>
                </div>
                <div class="banner-form">
                    <div class="row">
                        <form>
                            <div class="col-md-10 col-12 col-sm-12">
                                <div  class="row">
                                    <div  class="col-md-6">
                                        <div  class="form-group">
                                            <input  class="form-control " placeholder="Keyword" type="text">
                                        </div>
                                    </div>
                                    <div  class="col-md-6">
                                        <div  class="form-group">
                                            <select  class="form-control color-gray">
                                                <option >Property Type</option>
                                                <option >Room</option>
                                                <option >House</option>
                                                <option >Apartment</option>
                                                <option >Villas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div  class="form-group">
                                    <input  class="form-control overflow" placeholder="Seach by address, Suburb or City" type="text">
                                </div>
                            </div>
                            <div  class="col-md-2 col-12 col-sm-12">
                                <div >
                                    <button  class="btn btn-success btn-block">Search</button>
                                </div>
                                <div >
                                    <button  class="btn btn-orange mt-3 btn-block">More !</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
             <div  class="rental-services">
                <div  class="outerDIV">
                    <div  class="main-content text-center">
                        <h2>New Rental Property for You</h2>
                        <h5>Along with property, TGH also provides real estate rental services</h5>
                    </div>
                </div>
            </div>
            <div  class="property-listing">
                <div  class="row">
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 col-sm-6 col-12">
                        <div class="property-main">
                            <span class="prop-tag">House</span>
                            <div class="property-info">
                                <span class="badge">$1100</span>
                                <h5 class="add1">3395, Lodgeville Road</h5>
                                <h6 class="add2">Golden Valley,MN 55427</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
        <div  class="container-fluid " id="search-by-cat">
            <div  class="container new-property">
                <div  class="new-property-top">
                    <h2  class="title">New Rental Property for You</h2>
                    <h5  class="text">Along with property, TGH also provides real estate rental services</h5>
                </div>
                <div  class="row mt-5">
                    <div  class="col-md-4 text-center">
                        <span class="br">
                            <img src="{{ url('/images/icon4.png') }}">
                        </span>
                        <h5  class="title">Rooms for Rent</h5>
                        <p  class="text">The Guest Home One is the new home to help you find a place to stay around New Zealand.</p>
                    </div>
                    <div  class="col-md-4 text-center">
                        <span  class="br">
                            <img src="{{ url('/images/icon5.png') }}">
                        </span>
                        <h5  class="title">Securing the Property</h5>
                        <p  class="text">We appreciate that not everyone wants to rent a whole house and only need one or two rooms for a short or long term.</p>
                    </div>
                    <div  class="col-md-4 text-center">
                        <span  class="br">
                             <img src="{{ url('/images/icon6.png') }}">
                        </span>
                        <h5  class="title">List Your Property</h5>
                        <p  class="text">We have thousands you can choose a play to live that suits you needs, ranging in price from high properties down to budget concious rooms in suburbs to suite your requirements.</p>
                    </div>
                </div>
            </div>           
        </div> 
        <div  class="container-fluid " id="submit-property">
            <div  class="submit-property-box text-white">
                <div  class="container">
                    <div  class="row my-2">
                        <div  class="col-md-8 m-auto">
                            <h3  class="mb-0">Do you want your property to be listed here?</h3>
                        </div>
                        <div  class="col-md-4">
                            <button  mat-raised-button="" tabindex="0" class="mat-raised-button">
                                <span class="mat-button-wrapper">Submit your property</span>
                                <div class="mat-button-ripple mat-ripple" matripple=""></div>
                                <div class="mat-button-focus-overlay"></div>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
        </div> 
        <div  class="container">
            <div  class="main-content Why-people">
                <div  class="row">
                    <div  class="col-md-7">
                        <div  class="textBox">
                            <h2  class="f300 color-orange">Why people choose us?</h2>
                            <div  class="row pt-4">
                                <div  class="col-md-1 col-sm-2 col-3">
                                     <img src="{{ url('/images/excellent-icon.png') }}">
                                </div>
                                <div  class="col-md-11 col-sm-10 col-9 ">
                                    <h5 >Excellent Reputation</h5>
                                    <p >We’ll show you the local schools and amenities, crime stats, commute times … You’ll find it all - and more - under The Guest Home.</p>
                                </div>
                                <div  class="col-md-1 col-sm-2 col-3">
                                    <img src="{{ url('/images/resource-icon.png') }}">
                                </div>
                                <div  class="col-md-11 col-sm-10 col-9">
                                    <h5 >Excellent Reputation</h5>
                                    <p >The Guest Home One is the new home to help you find a place to stay around New Zealand. We appreciate that not everyone wants to rent a whole house and only need one or two rooms for a short or long term.</p>
                                </div>
                                <div  class="col-md-1 col-sm-2 col-3">
                                    <img src="{{ url('/images/years-icon.png') }}">
                                </div>
                                <div  class="col-md-11 col-sm-10 col-9">
                                    <h5 >Excellent Reputation</h5>
                                    <p >We have thousands you can choose a play to live that suits you needs, ranging in price from high properties down to budget concious rooms in suburbs to suite your requirements. </p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div  class="col-md-5">
                        <div  class="imageBox">
                            <img src="{{ url('/images/1.png') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div> 
@endsection