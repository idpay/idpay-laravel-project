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

    <div class="row" id="transferToGetWay">
        <blockquote class="blockquote text-center titleAction" id="titleTranserToGetway">
            <p class="mb-0">انتقال به درگاه</p>
            <footer class="blockquote-footer"><cite title="Source Title">
                    کاربر به درگاه پرداخت منتقل شد.
                </cite></footer>
        </blockquote>

        <div class="col-lg-12" id="transferToPortWait">
            {!! $callbackHtml !!}
        </div>

    </div>

    <div class="row">
        {!! $callbackResultHtml !!}
    </div>

    @if(!empty($verifyRequestHtml))
        <div class="row">
            <blockquote class="blockquote text-center titleAction">
                <p class="mb-0">تایید تراکنش</p>
                <footer class="blockquote-footer"><cite title="Source Title">
                    </cite></footer>
            </blockquote>

            <div class="col-lg-6">
                {!! $verifyRequestHtml !!}
            </div>

            <div class="col-lg-6" id="verifyResult">
                {!! $verifyResultHtml !!}
            </div>

        </div>
    @endif

    <script>

        $(document).on('submit', '#verifyTransaction', function (e) {
            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');
            loadWaiting();

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
                    jQuery('#verifyResult').html(result.data);

                    toastr.options.rtl = true;
                    toastr.info(result.message, '');
                    stopLoadWaiting()
                },
                error: function (error) {
                    console.log(error);
                }
            });
        });

    </script>
@endsection
