<br>
<blockquote class="blockquote text-center titleAction">
    <p class="mb-0">بازگشت از درگاه</p>
    <footer class="blockquote-footer"><cite title="Source Title">
        </cite></footer>
</blockquote>
<div class="col-lg-12">
    <div class="col-lg-6">
        درخواست
    </div>
    <div class="col-lg-6" style="font-size: 14px; text-align: left">
        زمان:
        {{$step_tome}}
    </div>
</div>

<br>
<br>

<div class="col-lg-12">
    <div class="col-lg-6" id="callbackResult">

        پرداخت کننده از درگاه به آدرس
        <br>
        url:
        {{$url}}

        منتقل شد. اطلاعات روبرو دریافت شد
    </div>

    <div class="col-lg-6" id="callbackResult">

        <p style="text-align: left">:form-data</p>
        @php
            $txt= str_replace("Array", "", print_r($callbackResult['view'],true));
            $txt= str_replace("(", "[", $txt);
            $txt= str_replace(")", "]", $txt);
            echo '<pre>',$txt,'</pre>';
        @endphp
        <br>

        <p style="text-align: left">:header</p>
        @php
            echo '<pre>',print_r($callbackResult['CONTENT_TYPE'],true),'</pre>';
        @endphp

        <script src="{{ asset('json/prism.js') }}"></script>

    </div>


</div>









