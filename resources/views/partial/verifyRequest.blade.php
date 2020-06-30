@if (session('status'))
    <div class="alert alert-danger">
        {{ session('status') }}
    </div>
@else
    <form class="form-horizontal" action="{{route('verify',['id'=>$order_id])}}"
          id="verifyTransaction" method="post">
        @csrf
        <div class="form-group">
            <label class="control-label col-sm-2" for="">
            </label>
            <div class="col-sm-8">
                <input type="submit" class="btn btn-primary btn-block" value="تایید تراکنش">
            </div>
            <label class="control-label col-sm-2" for="">
            </label>

        </div>
    </form>
@endif
