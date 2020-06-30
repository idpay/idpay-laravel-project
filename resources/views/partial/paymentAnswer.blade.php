<script src="{{ asset('json/prism.js') }}"></script>

<div class="col-lg-12 ">
    <h4>درخواست</h4>
</div>

<div class="col-lg-12">
    <div class="col-lg-6 detail">
        <span>زمان:</span>
        <span class="request-time">{{$activity['step_time']}}</span>
    </div>
</div>

<div class="col-lg-12">
    <pre class="ltr"><code id="GFG_DOWN" class="language-json json-response"></code></pre>
</div>

<div class="col-lg-12 ">
    <h4>پاسخ</h4>
</div>
<div class="col-lg-12 detail">
    <div class="col-lg-6" >
        <span>  زمان دریافت پاسخ:</span>
        <span>{{$activity['request_time']}} ثانیه </span>
    </div>
    <div class="col-lg-6" style="text-align: left">
        <span>کد وضعیت:</span>
        <span>{{$http_code}}</span>
    </div>
</div>

<div class="col-lg-12">
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






