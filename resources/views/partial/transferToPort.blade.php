<form class="form-horizontal" action="{{route('payment',['id'=>$order_id])}}" data-content="transferToPortRequestSubmit" id="transferToPortRequest">
    <input type="hidden" name="link" value="{{$link}}">
    <div class="form-group">
        <label class="control-label col-sm-2" for="">
        </label>
        <div class="col-sm-8">
            <input type="submit" class="form-control submit-idpay" id="transferToPortRequestSubmit" value="انتقال به درگاه">
        </div>
        <label class="control-label col-sm-2" for="">
        </label>
    </div>
</form>




<script>
    $(document).on('submit', '#transferToPortRequest', function (e) {

        e.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var submitButton = form.attr('data-content');
        $("#" + submitButton).attr("disabled", true);
        var timing;
        var myTimer;

        // begin()


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

                timing = 3;

                $('#timing').html('درحال انتقال به درگاه ' + timing);
                $('#msg').show();
                $('#msgLink').html(result.link)

                // $('#begin').prop('disabled', true);
                myTimer = setInterval(function () {
                    --timing;
                    $('#timing').html('درحال انتقال به درگاه ' + timing);
                    if (timing === 0) {
                        clearInterval(myTimer);
                        loadWaiting()
                        toastr.options.rtl = true;
                        toastr.success(result.message, '');
                        window.location.replace(result.link);

                    }
                }, 1000);





            },
            error: function (error) {
                console.log(error);
            }
        });




    });


</script>



