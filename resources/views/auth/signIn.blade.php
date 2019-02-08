<!---[ 指定繼承: layout.master 母模板]---->
@extends('layouts.master')

<!---[ 傳送資料到母模板，且指定變數為  title ]---->

@section('tittle',$title)
<!---[ 傳送資料到母模板，且指定變數為  content ]---->



@section('content')
<div class="container">
<h1>{{ $title}}</h1>
<!-- 錯誤訊息元件 {{ $title}} 引入該模板後，可接受傳入的變數-->
@include('components.socialButtons')
@include('components.validationErrorMessage')
<form action="/user/auth/sign-in" method="post">

<label for="">Email: <input type="text" name="email" placeholder="Email" value="{{ old('email') }}"></label>
<label for="">密碼: <input type="password" name="password" placeholder="密碼" value="{{ old('password') }}"></label>
<button type="sumit">登入</button>

<!--[CSRF 欄位] -->
{!! csrf_field() !!}


</form>


</div>
@endsection
