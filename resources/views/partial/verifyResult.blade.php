<script src="{{ asset('json/prism.js') }}"></script>


<div class="col-lg-12">

    <div class="col-lg-6">
        درخواست
    </div>
    <div class="col-lg-6" style="font-size: 14px; text-align: left">
        زمان
        {{$step_time}}
    </div>
</div>


<div class="col-lg-12">

    <pre class="ltr"><code id="verifyRequest" class="language-json json-response"></code></pre>
    <p>پاسخ(کد وضعیت پاسخ:{{$http_code}})</p>
    <pre class="ltr"><code id="verifyResponse" class="language-json json-response"></code></pre>
</div>

<script>


    var el_up = document.getElementById("GFG_UP");
    var el_down = document.getElementById("verifyRequest");
    var el_down2 = document.getElementById("verifyResponse");
    //

    var obj =@php echo $request @endphp;
    var obj2 =@php echo $response @endphp;


    el_down.innerHTML = JSON.stringify(obj, undefined, 4);
    el_down2.innerHTML = JSON.stringify(obj2, undefined, 4);

</script>


