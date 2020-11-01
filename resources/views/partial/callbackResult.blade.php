<br>
<blockquote class="blockquote text-center titleAction">
    <p class="mb-0">بازگشت از درگاه</p>
    <footer class="blockquote-footer"><cite title="Source Title">
            پرداخت کننده از درگاه به آدرس
            url:
            {{$url}}
            منتقل شد.
        </cite></footer>
</blockquote>

<div class="col-lg-12">
    <div class="col-lg-6 detail">
        <span>زمان بازگشت از درگاه پرداخت:</span>
        <span class="request-time">{{$step_tome}}</span>
    </div>
</div>

<div class="col-lg-12" id="callbackResult">
    <h4 style="text-align: left">Header</h4>
    @php
        echo '<pre>',print_r($callbackResult['CONTENT_TYPE'], true),'</pre>';
    @endphp
    <h4 style="text-align: left">Method</h4>
    @php
        echo '<pre>',print_r($callbackResult['REQUEST_METHOD'], true),'</pre>';
    @endphp
    <h4 style="text-align: left">
        @if(!empty($callbackResult['REQUEST_METHOD']) && $callbackResult['REQUEST_METHOD'] == 'GET')
            Query string
        @else
            Form data
        @endif
    </h4>
    @php
        $txt= str_replace("Array", "", print_r($callbackResult['view'], true));
        $txt= str_replace("(", "[", $txt);
        $txt= str_replace(")", "]", $txt);
        echo '<pre>',$txt,'</pre>';
    @endphp
    <br>
    <script src="{{ asset('json/prism.js') }}"></script>
</div>











