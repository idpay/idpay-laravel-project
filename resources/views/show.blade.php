@extends('layouts.master')
@section('title', 'Payment')


@section('content')

    <!-- Image loader -->
    <div id='loader' style='display: none;'>
        <img  src='{{asset('image/images.png')}}' width='32px' height='32px'>
    </div>
    @if(is_array($activity))
        <div class="row">
            <div class="title"><h3>ایجاد تراکنش</h3></div>
            <div class="col-md-6">
                <div id="form" class="row">

                    <div class=" row col-md-12">
                        {{ Form::label('APIKEY', 'APIKEY', ['class' => 'col-md-3']) }}

                        {{ Form::text('APIKEY',Null,['class' => ' col-md-5']) }}
                    </div>
                    <div class=" row col-md-12">
                        {{ Form::label('Sandbox', 'آزمایشگاه', ['class' => 'col-md-3']) }}

                        <input id="sandbox" name="sandbox" value="1" type="checkbox"></input>
                    </div>
                    <div class="row col-md-12">
                        {{ Form::label('Name', 'نام', ['class' => 'col-md-3']) }}
                        {{ Form::text('name',Null,['class' => ' col-md-5']) }}

                    </div>
                    <div class="row col-md-12">
                        {{ Form::label('Phone', 'تلفن', ['class' => 'col-md-3']) }}
                        {{ Form::text('phone',Null,['class' => ' col-md-5']) }}

                    </div>

                    <div class="row col-md-12">
                        {{ Form::label('Mail', 'ایمیل', ['class' => 'col-md-3']) }}
                        {{ Form::text('mail',Null,['class' => ' col-md-5']) }}

                    </div>
                    <div class="row col-md-12">
                        {{ Form::label('Amount', 'قیمت', ['class' => 'col-md-3']) }}
                        {{ Form::text('amount',Null,['class' => ' col-md-5']) }}

                    </div>
                    <div class="row col-md-12">
                        {{ Form::label('Reseller', 'کد نمایندگی', ['class' => 'col-md-3']) }}
                        {{ Form::text('reseller',Null,['class' => ' col-md-5']) }}

                    </div>
                    <button onclick="payment_new()">Payment</button>
                </div>
            </div>
            <div class="col-md-6 " id="create" style="display: none">
                <div class="response" id="request-create">
                    <lable class="col-md-3">درخواست</lable>
                </div>
                <div class="response" id="response-create">
                    <lable class="col-md-3">پاسخ</lable>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 callback" style="display: none">
                <button><a id="link" href="">انتقال به لینک دریافت شده</a></button>

            </div>
            <div class="col-md-6">

            </div>
        </div>


    @elseif(isset($activity) && is_object($activity))

        @foreach($activity->get_Activity as $key=>$val)
            @if($val->step=='create')

                <div class="row">
                    <div class="title"><h3>ایجاد تراکنش</h3></div>
                    <div class="col-md-6">
                        <div id="form" class="row">

                            <div class=" row col-md-12">
                                {{ Form::label('APIKEY', 'APIKEY', ['class' => 'col-md-3']) }}

                                {{ Form::text('APIKEY',$activity->API_KEY,['readonly','class' => ' col-md-5']) }}
                            </div>
                            <div class=" row col-md-12">
                                {{ Form::label('Sandbox', 'آزمایشگاه', ['class' => 'col-md-3']) }}
                                @if($activity->sandbox==1)
                                    <input name="sandbox" type="checkbox" checked>

                                @else
                                    <input name="sandbox" type="checkbox">

                                @endif
                            </div>
                            <div class="row col-md-12">
                                {{ Form::label('Name', 'نام', ['class' => 'col-md-3']) }}
                                {{ Form::text('name',$activity->name,['readonly','class' => ' col-md-5']) }}

                            </div>
                            <div class="row col-md-12">
                                {{ Form::label('Phone', 'تلفن', ['class' => 'col-md-3']) }}
                                {{ Form::text('phone',$activity->phone,['readonly','class' => ' col-md-5']) }}

                            </div>

                            <div class="row col-md-12">
                                {{ Form::label('Mail', 'ایمیل', ['class' => 'col-md-3']) }}
                                {{ Form::text('mail',$activity->mail,['readonly','class' => ' col-md-5']) }}

                            </div>
                            <div class="row col-md-12">
                                {{ Form::label('Amount', 'قیمت', ['class' => 'col-md-3']) }}
                                {{ Form::text('amount',$activity->amount,['readonly','class' => ' col-md-5']) }}

                            </div>
                            <div class="row col-md-12">
                                {{ Form::label('Reseller', 'کد نمایندگی', ['class' => 'col-md-3']) }}
                                {{ Form::text('reseller',$activity->reseller,['readonly','class' => ' col-md-5']) }}

                            </div>
                            <button disabled="true" onclick="payment_new()" readonly="readonly">Payment</button>
                        </div>
                    </div>
                    <div class="col-md-6 " id="create" style="">
                        <div class="response" id="request-create">
                            <lable>درخواست</lable>
                            <pre>{{$val->request}}</pre>
                        </div>
                        <div class="response" id="response-create">
                            {{--                            @php    $response=json_decode($val->response);  @endphp--}}

                            <lable>پاسخ</lable>
                            <pre>{{$val->response}}</pre>

                        </div>
                    </div>
                </div>
            @endif
            @if($val->step=='redirect')

                <div class="row">

                    <div class="title"><h3>انتقال به درگاه</h3></div>
                    <div class="col-md-6 callback">
                        <button disabled>انتقال به لینک دریافت شده</button>

                    </div>
                    <div class="col-md-6">
                        <lable>Callback</lable>
                        <pre>{{$val->request}}</pre>

                    </div>
                </div>
            @endif

            @if($val->step=='return')
                <div class="row">
                    <div class="title"><h3>بازگشت از از درگاه</h3></div>

                    <div class="col-md-6">return</div>
                    <div class="col-md-6">
                        {{ Form::label('مقدار بازگشتی از درگاه', 'مقدار بازگشتی از درگاه') }}
                        @php $response=json_decode($val->response) @endphp
                        <div style="direction: ltr">
                            <pre>@php print_r($response) @endphp </pre>
                        </div>
                    </div>
                </div>
                @if(sizeof($activity->get_Activity)==3)
                    <div class="row">
                        <div class="title"><h3>تایید تراکنش</h3></div>
                        <div class="col-md-6">
                            @if($response->status==10)
                                <div id="verifyButton">
                                    <button onclick="verify('{{$response->id}}','{{$response->order_id}}')">تایید پرداخت
                                    </button>
                                </div>

                            @else
                                {{$response->status}}
                            @endif
                        </div>

                        <div class="col-md-6" id="verify">

                            @if($val->step=='verify')
                                {{ Form::label('درخواست', 'درخواست', ['class' => 'col-md-3']) }}
                                <pre>{{$val->request}}))</pre>
                                {{ Form::label('پاسخ', 'پاسخ', ['class' => 'col-md-3']) }}
                                <pre> {{$val->response}} </pre>
                            @endif
                        </div>
                        @endif

                        @endif
                        @if($val->step=='verify')
                            <div class="row">
                                <div class="title"><h3>تایید تراکنش</h3></div>
                                <div class="col-md-6">
                                    <button>تایید پرداخت</button>

                                </div>
                                <div class="col-md-6" id="verify">
                                    khkhkhhj
                                    {{ Form::label('درخواست', 'درخواست', ['class' => 'col-md-3']) }}
                                    <pre>{{$val->request}}))</pre>
                                    {{ Form::label('پاسخ', 'پاسخ', ['class' => 'col-md-3']) }}
                                    <pre> {{$val->response}} </pre>
                                </div>
                                @endif

                                @endforeach
                                @endif

                                @endsection
                                @section('footer')

                                    <script>
                                        function a_onClick() {

                                            link = ($('#callback-link').attr('data-link'));
                                            order_id = ($('#callback-link').attr('data-orderId'));
                                            id = ($('#callback-link').attr('data-id'));
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                method: "post",
                                                url: "{{ route('store_callback') }}",
                                                data: {
                                                    link: link,
                                                    order_id: order_id,
                                                    id: id
                                                },
                                                success: function (responce) {
                                                    $("#loader").hide();

                                                    window.location.replace(link);

                                                },
                                                beforeSend: function(){
                                                    // Show image container
                                                    $("#loader").show();
                                                },
                                            })

                                        }

                                        function payment_new() {


                                            var inputs = $('#form :input');
                                            var values = {};
                                            inputs.each(function () {

                                                values[this.name] = $(this).val();
                                            });
                                            if ($('#sandbox').is(':checked')) {

                                                values['sandbox'] = 1;
                                            } else {
                                                values['sandbox'] = 0;
                                            }
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                method: "post",
                                                url: "{{ route('store') }}",
                                                data: {values},
                                                success: function (responce) {
                                                    $("#loader").hide();

                                                    $('#create').show();
                                                    // $('#request-create').append(responce.request);
                                                    // $('#response-create').append(responce.response.link);
                                                    $('#create').html(responce);
                                                    // $('#form :input').attr('readonly');
                                                },
                                                beforeSend: function () {
                                                    // Show image container
                                                    $("#loader").show();
                                                },
                                            })
                                        }

                                        function verify(id, order_id) {
                                            $.ajaxSetup({
                                                headers: {
                                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                                }
                                            });
                                            $.ajax({
                                                method: "POST",
                                                url: "{{route('verify')}}",
                                                data: {
                                                    id: id,
                                                    order_id: order_id
                                                },
                                                success: function (responce) {
                                                    $('#loader').hide();
                                                    $('#verifyButton').html('<button>تایید پرداخت</button>');
                                                    $('#verify').html(responce)
                                                }, beforeSend: function () {
                                                    // Show image container
                                                    $("#loader").show();
                                                },
                                            })

                                        }

                                    </script>
@endsection
