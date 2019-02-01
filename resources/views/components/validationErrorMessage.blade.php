
<!-- 判斷是否有 驗證器-錯誤訊息 -若有就顯示出來 -->
@if($errors AND count($errors))
<ul>
        @foreach($errors->all() as $err)
        <li>{{ $err  }}</li>
        @endforeach
</ul>
@endif