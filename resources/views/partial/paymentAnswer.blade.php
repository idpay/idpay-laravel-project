<script src="{{ asset('json/prism.js') }}"></script>


<p>
    درخواست
    @if(isset($activity['data']['create_at']))
        ({{$activity['data']['create_at']}})
    @endif
</p>
<pre class="ltr"><code id="GFG_DOWN" class="language-json json-response"></code></pre>
<p>پاسخ(کد وضعیت پاسخ:{{$activity['data']['http_code']}})</p>
<pre class="ltr"><code id="GFG_DOWN2" class="language-json json-response"></code></pre>
{{--<pre id="GFG_DOWN" style="color:green; font-size: 10px; font-weight: bold;"></pre>--}}
{{--<pre id="GFG_DOWN2" style="color:green; font-size: 10px; font-weight: bold;"></pre>--}}

<script>
    var el_up = document.getElementById("GFG_UP");
    var el_down = document.getElementById("GFG_DOWN");
    var el_down2 = document.getElementById("GFG_DOWN2");

    var obj =@php echo $activity['data']['request'] @endphp;
    var obj2 =@php echo $activity['data']['response'] @endphp;


    el_down.innerHTML = JSON.stringify(obj, undefined, 4);
    el_down2.innerHTML = JSON.stringify(obj2, undefined, 4);

</script>






