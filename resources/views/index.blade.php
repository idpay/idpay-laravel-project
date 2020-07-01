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

    <div class="row" hidden id="transferToGetWay">
        <blockquote class="blockquote text-center titleAction" id="titleTranserToGetway">
            <p class="mb-0">انتقال به درگاه</p>
            <footer class="blockquote-footer"><cite title="Source Title">
                </cite></footer>
        </blockquote>
        <div class="col-lg-6" id="transferToPort"></div>
        <div class="col-lg-6" id="transferToPortWait">
            <div style="display: none"></div>
            <h4 style="text-align: left"> Redirect to</h4>
            <pre id="msgLink"></pre>
        </div>
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

                        $('#msgLink').html(result.link)
                        stopLoadWaiting()
                        $("#" + submitButton).attr("disabled", false);
                        toastr.options.rtl = true;
                        toastr.success(result.message, '');
                    } else if (result.status == 'ERROR') {
                        jQuery('#paymentResult').html(result.paymentAnswer);
                        toastr.options.rtl = true;
                        toastr.error(result.message, '');
                        $("#" + submitButton).attr("disabled", false);
                        stopLoadWaiting()
                    }

                },
                error: function (error) {

                }
            });
        });

    </script>

@endsection
