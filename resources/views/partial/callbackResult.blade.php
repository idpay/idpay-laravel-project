<blockquote class="blockquote text-center titleAction">
    <p class="mb-0">بازگشت از درگاه</p>
    <footer class="blockquote-footer"><cite title="Source Title">
        </cite></footer>
</blockquote>

<br>
<br>

<div class="col-lg-6" id="callbackResult">

    پرداخت کننده از درگاه به آدرس
    <br>
    url:
    {{$url}}

    منتقل شد. اطلاعات روبرو دریافت شد
</div>

<div class="col-lg-6" id="callbackResult">

    تاریخ بازگشت از درگاه:
    ({{$step_tome}})


    @php
        $txt = preg_replace('/(\[.+\])\s+=>\s+Array\s+\(/msiU','$1 => Array (', print_r($callbackResult,true));
        echo '<pre>',$txt,'</pre>';
    @endphp

    <script src="{{ asset('json/prism.js') }}"></script>

</div>










