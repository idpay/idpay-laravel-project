<form class="form-horizontal" action="{{route('store')}}" id="snedPaymentApi" method="post"
      data-content="snedPaymentApiButton" data-value="transferToGetWay">

    @csrf
    <div class="form-group">
        <label class="control-label col-sm-4"
               for="{{__('sandbox.api_key')}}">{{__('sandbox.api_key')}} *</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="api_key" placeholder="مثال: a5b6-4926-aa74-427b95c2"  @if(isset($order)) disabled  value="* {{$order->API_KEY}}" @endif
            name="api_key" >
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.sanbox')}}">{{__('sandbox.sanbox')}} *
        </label>
        <div class="col-sm-8">
            <select class="form-control" name="sandbox" {{--id="exampleFormControlSelect2"--}} @if(isset($order)) disabled @endif>
                <option value="1" @if(isset($order) and $order->sandbox == 1)selected @endif>بله</option>
                <option value="0" @if(isset($order) and $order->sandbox == 0)selected @endif>خیر</option>
            </select>
        </div>
    </div>

    <hr>

    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.amount')}}">{{__('sandbox.amount')}} *
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="amount" placeholder="مثال: 10000" @if(isset($order)) disabled value="{{$order->amount}}" @endif
            name="amount">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.callback')}}">{{__('sandbox.callback')}} *</label>
        <div class="col-sm-8">
            <input type="text" class="form-control en-style" id="callback" placeholder="https://sandbox.idpay.ir/callback" name="callback" @if(isset($order)) disabled  value="{{$order->callback}}" @else  value="{{route('callback')}}" @endif>
        </div>
    </div>



    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.name')}}">{{__('sandbox.name')}}</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="name" placeholder="مثال: محمد" name="name" @if(isset($order)) disabled  value="{{$order->name}}" @endif>
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-4"
               for="{{__('sandbox.phone_number')}}">{{__('sandbox.phone_number')}}</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="phone_number" placeholder="مثال: 09121234567" @if(isset($order)) disabled  value="{{$order->phone_number}}" @endif
            name="phone_number">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.email')}}">{{__('sandbox.email')}}</label>
        <div class="col-sm-8">
            <input type="text" class="form-control en-style" id="email" @if(isset($order)) disabled   value="{{$order->email}}"@endif
            placeholder="مثال: example@gmail.com"
                   name="email">
        </div>
    </div>


    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.desc')}}">{{__('sandbox.desc')}}</label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="desc" placeholder="مثال: این مبلغ بابت خرید کتاب است." name="desc" @if(isset($order)) disabled  value="{{$order->desc}}" @endif>
        </div>
    </div>





    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.reseller')}}">{{__('sandbox.reseller')}}
        </label>
        <div class="col-sm-8">
            <input type="text" class="form-control" id="reseller" placeholder="مثال: 1"  @if(isset($order))  value="{{$order->reseller}}"  disabled @endif
            name="reseller">
        </div>
    </div>

    <div class="form-group">
        <label class="control-label col-sm-4" for="{{__('sandbox.reseller')}}">
        </label>
        <div class="col-sm-8">
            <input type="submit" class="btn btn-primary btn-block" style="" id="snedPaymentApiButton"  @if(isset($order))   disabled @endif  value="ایجاد تراکنش">
        </div>
    </div>


    <div class="form-group">
        <div class="col-12">
        </div>
    </div>
</form>
