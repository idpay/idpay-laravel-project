@extends('layouts.master')






@section('content')



    <link rel="stylesheet" href="{{ asset('json/prism.css') }}">
    <script src="{{ asset('json/prism.js') }}"></script>



    <div class="row">
        <blockquote class="blockquote text-center titleAction">
            <p class="mb-0">ایجاد تراکنش</p>
            <footer class="blockquote-footer"><cite title="Source Title">برای ایجاد تراکنش باید مقادیر زیر را کامل
                    کنید.</cite></footer>
        </blockquote>


        <div class="col-lg-6">


            @include('form')


        </div>

        <div class="col-lg-6" id="paymentResult">

            {!! $paymentAnswerHtml !!}

        </div>


    </div>

    <br>

    <div class="row" id="transferToGetWay">
        <blockquote class="blockquote text-center titleAction" id="titleTranserToGetway">
            <p class="mb-0">انتقال به درگاه</p>
            <footer class="blockquote-footer"><cite title="Source Title">
                </cite></footer>
        </blockquote>



        <div class="col-lg-6">





            <div class="col-lg-12">

                <div class="col-lg-6">

                </div>
                <div class="col-lg-6" style="font-size: 14px; text-align: left">

                </div>
            </div>

            <br>
            <br>

            <div class="col-lg-12" id="transferToPort">

                <p style="text-align: center">
                    کاربر به درگاه به ادرس روبرو منتقل شد.
                </p>
            </div>


        </div>

        <div class="col-lg-6" id="transferToPortWait">


            {!! $callbackHtml !!}


        </div>

    </div>






    <div class="row">

        {!! $callbackResultHtml !!}

    </div>


    <div class="row">


        {!! $verifyTansactionHtml !!}


    </div>




    <script>

        $(document).on('submit', '#snedPaymentApi', function (e) {


            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            var submitButton = form.attr('data-content')
            var rowDisable = form.attr('data-value')

            $("#" + submitButton).attr("disabled", true);

            loadWaiting()

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            jQuery.ajax({
                url: url,


                method: 'post',
                data: form.serialize(),
                success: function (result) {

                    // alert(result.status);
                    if (result.status == 'OK') {

                        jQuery('#titleTranserToGetway').show();
                        jQuery('#paymentResult').html(result.paymentAnswer);

                        jQuery('#transferToPort').html(result.transferToPort);
                        $("#" + submitButton).attr("disabled", true);
                        $("#" + rowDisable).attr("hidden", false);
                        stopLoadWaiting()

                        $("#snedPaymentApi :input").prop("disabled", true);


                    } else if (result.status == 'ERROR') {
                        jQuery('#paymentResult').html(result.paymentAnswer);
                        $("#" + submitButton).attr("disabled", false);
                        stopLoadWaiting()


                    }


                },
                error: function (error) {

                }
            });
        });


    </script>



    {{--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>--}}
    <script>
        function loadWaiting() {

            var div = $("#loadWaiting");

            div.animate({width: '100%', opacity: '1'}, "100");
            // div.animate({width: '0', opacity: '0'}, "fast");


        }

        function stopLoadWaiting() {

            var div = $("#loadWaiting");
            div.stop();
            div.animate({width: '0', opacity: '0'}, "fast");


        }


    </script>

@endsection
