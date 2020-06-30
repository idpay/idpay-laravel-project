<div class="col-lg-12">
    <span>زمان انتقال به درگاه پرداخت:</span>
    <span class="request-time">{{$step_date}}</span>
</div>
<div>
    <h4 style="text-align: left">URL</h4>
    @php
        echo '<pre>',print_r($url,true),'</pre>';
    @endphp
</div>
