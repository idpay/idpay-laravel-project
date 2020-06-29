
@if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@else
    <form class="form-horizontal" action="{{route('verify',['id'=>$order_id])}}"
          id="verifyTransaction" method="post">

        @csrf
        {{--<div class="form-group">--}}
            {{--<div class="col-sm-offset-3 col-sm-9">--}}
                {{--<button type="submit" class="btn btn-default">تایید تراکنش</button>--}}
            {{--</div>--}}
        {{--</div>--}}


        <div class="form-group">
            <label class="control-label col-sm-2" for="">
            </label>
            <div class="col-sm-8">
                <input type="submit" class="form-control submit-idpay"  value="تایید تراکنش">
            </div>
            <label class="control-label col-sm-2" for="">
            </label>

        </div>

    </form>
@endif







