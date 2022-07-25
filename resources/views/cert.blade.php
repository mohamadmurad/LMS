<!doctype html>
<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>


    <!-- Latest compiled and minified CSS -->
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0/css/bootstrap.css">--}}
    <style>
        body {
            font-family: Roboto;
        }

        .certificate-container {
            /*padding: 50px;*/
            /*width: 1024px;*/
            /*width: 800px;*/
            height: 600px;
        }
        .certificate {
            border: 20px solid #0C5280;
            padding: 25px;
            /*height: 500px;*/
            /*width: 800px;*/
            height: 600px;
            position: relative;
        }

        /*.certificate:after {*/
        /*    content: '';*/
        /*    top: 0px;*/
        /*    left: 0px;*/
        /*    bottom: 0px;*/
        /*    right: 0px;*/
        /*    position: absolute;*/
        /*    background-image: url(https://image.ibb.co/ckrVv7/water_mark_logo.png);*/
        /*    background-size: 100%;*/
        /*    z-index: -1;*/
        /*}*/

        .certificate-header > .logo {
            /*background: #0c5280;*/
            /*border-radius: 12px;*/
            /*padding: 10px;*/
            width: 80px;
            height: 80px;
        }

        .certificate-title {
            text-align: center;
        }

        .certificate-body {
            text-align: center;
        }

        h1 {

            font-weight: 400;
            font-size: 48px;
            color: #0C5280;
        }

        .student-name {
            font-size: 24px;
            font-weight: bold;
        }
        .subject-name{
            font-size: 24px;
            font-weight: normal;
        }

        .certificate-content {
            margin: 0 auto;
            width: 750px;
        }

        .about-certificate {
            width: 380px;
            margin: 0 auto;
        }

        .topic-description {

            text-align: center;
        }



        p.b-hr {
            border-bottom: 1px solid #0c5280;
            width: 20%;
            padding-bottom: 11px;
            margin: 0 auto;
        }





    </style>
</head>
<body>

<div class="certificate-container">
    <div class="certificate">
        <div class="water-mark-overlay"></div>
        <div class="certificate-header">
            <img src="https://image.ibb.co/ckrVv7/water_mark_logo.png" class="logo" alt="">

        </div>
        <div class="certificate-body">

{{--            <p class="certificate-title"><strong>RENR NCLEX AND CONTINUING EDUCATION (CME) Review Masters</strong></p>--}}
            <h1>Certificate of Completion</h1>
            <p class="student-name">{{$data['name']}}</p>
            <div class="certificate-content">
                <div class="about-certificate">
                    <p>
                        has successfully completed
                    </p>

                    <p class="subject-name">{{$data['subject']}}</p>
                    <p>with mark <b>{{$data['mark']}}%</b></p>

                    <p>an online course authorized by {{$data['creator']}} and offered through {{config('app.name')}}</p>

                </div>
                <p class="topic-title">
                    On {{$data['date']}}
                </p>
{{--                <div class="text-center">--}}
{{--                    <p class="topic-description text-muted">Contract adminitrator - Types of claim - Claim Strategy - Delay analysis - Thepreliminaries to a claim - The essential elements to a successful claim - Responses - Claim preparation and presentation </p>--}}
{{--                </div>--}}
            </div>
            <div class="certificate-footer text-muted">
                <div class="row" style="display:block;">
                    <div style="width: 48%; display: inline-block">
                        <div class="col-md-6" style="display: block;    flex-direction: column;    align-items: center;">
                            <p class="b-hr">Principal </p>
                            <p>{{$data['creator']}}</p>
                        </div>
                    </div>

                    <div class="col-md-6" style="width: 48%;display: inline-block">

                            <div class="col-md-6" style="display: flex;    flex-direction: column;    align-items: center;">
                                <p class="b-hr">
                                    Accredited by
                                </p>
                                <p>
                                    {{config('app.name')}}
                                </p>
                            </div>
{{--                            <div class="col-md-6">--}}
{{--                                <p>--}}
{{--                                    Endorsed by --}}
{{--                                </p>--}}
{{--                            </div>--}}

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
