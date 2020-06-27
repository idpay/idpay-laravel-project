<script src="{{ asset('json/prism.js') }}"></script>

<div class="col-lg-12">

    <div class="col-lg-6">
        درخواست
    </div>
    <div class="col-lg-6" style="font-size: 14px; text-align: left">
        زمان
        {{$activity['step_time']}}
    </div>
</div>

<div class="col-lg-12">
    <pre class="ltr"><code id="GFG_DOWN" class="language-json json-response"></code></pre>
    <p>پاسخ(کد وضعیت پاسخ:{{$http_code}})</p>
    <pre class="ltr"><code id="GFG_DOWN2" class="language-json json-response"></code></pre>


</div>

<script>
    var el_up = document.getElementById("GFG_UP");
    var el_down = document.getElementById("GFG_DOWN");
    var el_down2 = document.getElementById("GFG_DOWN2");

    var obj =@php echo $activity['request'] @endphp;
    var obj2 =@php echo $activity['response'] @endphp;


    el_down.innerHTML = JSON.stringify(obj, undefined, 4);
    el_down2.innerHTML = JSON.stringify(obj2, undefined, 4);

</script>






