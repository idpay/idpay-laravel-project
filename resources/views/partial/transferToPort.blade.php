<form class="form-horizontal" action="{{route('payment',['id'=>$order_id])}}" data-content="transferToPortRequestSubmit" id="transferToPortRequest">
    <input type="hidden" name="link" value="{{$link}}">
    <div class="form-group">
        <div class="col-sm-offset-3 col-sm-9">
            <button type="submit" class="btn btn-default" id="transferToPortRequestSubmit">انتقال به درگاه</button>
        </div>
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



