
<!---[ 指定繼承: layout.master 母模板]---->
@extends('layouts.master')

<!---[ 傳送資料到母模板，且指定變數為  title ]---->

@section('tittle',$title)
<!---[ 傳送資料到母模板，且指定變數為  content ]---->


@section('content')

<div class="container">
<h1>{{ $title}}</h1>
<!--{{ $title}} view() 引入該模板後，可接受傳入的變數-->

@include('components.validationErrorMessage')

<form action="/user/auth/sign-up" method='post' >
<label>
暱稱: <input type="text" name='nickname' placeholder='暱稱' value="{{ old('nickname') }}">
</label>
<label>
Email: <input type="text" name='email' placeholder='Email' value="{{ old('email') }}">
</label>
<label>
密碼: <input type="password" name='password' placeholder='密碼' value="{{ old('password') }}">
</label>

<label>
確認密碼: <input type="password" name='password_confirmation' placeholder='確認密碼' value="{{ old('password_confirmation') }}">
</label>

<label>
帳號類型:
<select name="type" id="#">
<option value="G">一般會員</option>
<option value="A">管理者</option>
</select>
</label>

<!-- 自動產生 csrd_token 隱藏欄位 -->
{!! csrf_field() !!}
<button type="submit">註冊</button>
</form>

</div>
@endsection


