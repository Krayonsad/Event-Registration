 @include('layouts.nav')
    <!-- Document Wrapper
                          ============================================= -->
   
    <!-- #page-title end -->
    <!-- Content
                            ============================================= -->
    <section id="content">
        <div class="content-wrap pt-0 pb-0">
            <div class="section nobg mt-0 pt-0 mb-0" style="padding-bottom:0;">
                <!--<div style="width:100%;background-size: cover;"><img src="{{ asset('login/images/banner-logo2.jpg') }}"></div>-->
                <div class="pt-4" style="background-color:#F9F9F9;">
                    <div class="container clearfix">
                        <div class="row pb-4 mb-0">
                            <div class="col-lg-9 col-md-12">
                                <div style="display:block;">
                                    <h4 class="bottom-margin20 backcolor section-title lfloat mb-1" style="font-size:22px">
                                        INTERNATIONAL CONFERENCE ON GREEN HYDROGEN 2025
                                    </h4>
                                </div>
                                <h4 class="bottom-margin10 backcolor section-title mb-0 ml-1 mr-1" style="display: flex;">
                                    <small style="font-weight:500;"><i class="icon-calendar21"></i> 11<sup>th</sup> -
                                        12<sup>th</sup> November, 2025</small>
                                    <small style="font-weight:500;">&nbsp;<i class="icon-location"></i> Bharat Mandapam, New
                                        Delhi</small>
                                </h4>
                                <!-- <h4 class="bottom-margin10 backcolor section-title mb-0 ml-1 mr-1" style="display: flex;">
                                  <small style="font-weight:500;"><i class="icon-location"></i> Bharat Mandapam, New Delhi</small>
                                </h4> -->
                            </div>
                            <!-- <div class="col-lg-3 col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{ route('new_register') }}" type="button" class="button button-circle">Registration</a>
                              </div> -->
                        </div>
                    </div>
                </div>
    </section>
    <div class="container" style="padding-top: 30px;" id="registration">
        <div class="row align-items-center">
            <div class="col-sm-12 col-md-12 col-lg-12">
                <h2 class="mb-0">Registration</h2>
            </div>
        </div>
    </div>
    <section class="about-layout1 about_top pt-50 pb-80">
        <div class="container mt-3">
            <div class="row">
                {{-- <div class="col-12 mb-3">
            <a href="#" class="button button-circle" style="width: 175px;text-align: center;">Delegates</a>
            <p style="display: inline-block; margin-left: 10px;"> A delegate pass allows you access to the sessions in the conference as well as the expo</p>
        </div> --}}
                {{-- <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;">Exhibitors</a>
                    <p style="display: inline-block; margin-left: 10px;">If you are interested to put up your stall at the
                        expo in ICGH 2024, kindly register as an exhibitor</p>
                </div> --}}
                <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;padding:0 20px;">Delegate </a>
                    <p style="display: inline-block; margin-left: 10px;">If you are a National / International Delegate, please register here.</p>
                </div>
                <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;padding:0 20px;">Govt. Employees </a>
                    <p style="display: inline-block; margin-left: 10px;">If you are a Government Employee / Sponsor PSU /
                        DIplomat please register here.</p>
                </div>
                <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;"> Student</a>
                    <p style="display: inline-block; margin-left: 10px;">If you are a student, please register here.</p>
                </div>
                {{-- <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;">Youth Session</a>
                    <p style="display: inline-block; margin-left: 10px;font-size:13px;">This pass allows you access only for
                        the session "Green Hydrogen for Youth" to be organized in ICGH 2024 on 12th September only, 2PM -
                        4PM. </p>
                </div> --}}
                <!-- <div class="col-12 mb-3">
                                    <a  href="#" class="button button-circle" style="width: 175px;text-align: center;text-transform: lowercase;">gh2thon</a>
                                    <p style="display: inline-block; margin-left: 10px;">This is only for the participants of the hackathon at ICGH 2024</p>
                                </div> -->
                <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;">Media</a>
                    <p style="display: inline-block; margin-left: 10px;">Only for Media</p>
                </div>
                <div class="col-12 mb-3">
                    <a href="#" class="button button-circle"
                        style="width: 175px;text-align: center;"> Speaker</a>
                    <p style="display: inline-block; margin-left: 10px;">Only for Speakers</p>
                </div>
            </div>
        </div>

    </section>
    
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            if (localStorage.getItem("scrollToContent") === "true") {
                localStorage.removeItem("scrollToContent");
                const target = document.getElementById("content");
                if (target) {
                    setTimeout(() => {
                        target.scrollIntoView({ behavior: "smooth" });
                    }, 500);
                }
            }
        });
    </script>

    <!-- <div class="container mt-3">
                        <div class="row justify-content-center" style="text-align: center;">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    {{-- <a href="{{asset('paid_registration')}}" class="w-100 button button-circle">Delegates Registration</a> --}}
                                    <a href="#" class="w-100 button button-circle">Delegates Registration</a>
                                    <p style="text-align: center;margin-bottom: 5px;padding-top: 10px;">For Conference & Expo Access</p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    {{-- <a href="{{asset('exhibitor_registration')}}" class="w-100 button button-circle">Exhibitors Registration</a> --}}
                                    <a href="#" class="w-100 button button-circle">Exhibitors Registration</a>
                                    <p style="text-align: center;margin-bottom: 5px;padding-top: 10px;"> For Stall Booking</p>
                                </div>
                            </div>
                          </div>
                          <div class="container mt-2 pb-3">
                        <div class="row justify-content-center" style="text-align: center;">
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    {{-- <a href="{{asset('visitor_registration')}}" class="w-100 button button-circle">Visitor Registration</a> --}}
                                    <a href="#" class="w-100 button button-circle">Visitor Registration</a>
                                    <p style="text-align: center;margin-bottom: 5px;padding-top: 10px;">To Attend the Expo</p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    <a href="{{ asset('youth_registration') }}" class="w-100 button button-circle">Youth Registration</a>
                                    <p style="text-align: center;margin-bottom: 5px;padding-top: 10px;"> For Youth Sessions Only</p>
                                </div>
                                <div class="col-12 col-sm-6 col-md-4 col-lg-3 mb-3">
                                    {{-- <a href="{{asset('hackathon_registration')}}" class="w-100 button button-circle">Youth Registration</a> --}}
                                    <a href="#" class="w-100 button button-circle">Hackathon Registration</a>
                                    <p style="text-align: center;margin-bottom: 5px;padding-top: 10px;"> For Hackathon Only</p>
                                </div>
                            </div>

