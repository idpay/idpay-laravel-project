<blockquote class="blockquote text-center titleAction">
    <p class="mb-0">تایید تراکنش</p>
    <footer class="blockquote-footer"><cite title="Source Title">
        </cite></footer>
</blockquote>


<div class="col-lg-6">
    @if (session('status'))
        <div class="alert alert-danger">
            {{ session('status') }}
        </div>
    @else

        <form class="form-horizontal" action="{{route('verify',['id'=>$order_id])}}"
              id="verifyTransaction" method="post">

            @csrf
            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-9">
                    <button type="submit" class="btn btn-default">تایید تراکنش</button>
                </div>
            </div>
        </form>
    @endif


</div>

<div class="col-lg-6" id="verifyResult">


    <link rel="stylesheet" href="{{ asset('json/prism.css') }}">
    <script src="{{ asset('json/prism.js') }}"></script>


    <script>


        $(document).on('submit', '#verifyTransaction', function (e) {


            e.preventDefault(); // avoid to execute the actual submit of the form.
            var form = $(this);
            var url = form.attr('action');

            loadWaiting()
            // alert(url)
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
                    stopLoadWaiting()



                },
                error: function (error) {
                    console.log(error);
                }
            });
        });


    </script>


</div>