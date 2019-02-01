<!---[ 指定繼承: layout.master 母模板]---->
@extends('layouts.master')

<!---[ 傳送資料到母模板，且指定變數為  title ]---->

@section('tittle',$title)
<!---[ 傳送資料到母模板，且指定變數為  content ]---->



@section('content')

<h1>{{ $title}}</h1>
<!--{{ $title}} 引入該模板後，可接受傳入的變數-->

@include('components.socialButtons')

Email: <input type="text" name='email' placeholder='Email'>
密碼: <input type="password" name='password' placeholder='密碼'>
暱稱: <input type="text" name='nickname' placeholder='暱稱'>

@endsection
