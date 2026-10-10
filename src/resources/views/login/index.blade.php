@extends('layouts.app')

@section('title', 'ログイン')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">ログイン</p>
  </div>

  @if(session('success'))
  <div class="bg-green-100 rounded-lg shadow-md p-3 mb-6 mx-auto max-w-lg ">
    {{ session("success") }}
  </div>
  @endif

  @if ($errors->any())
    <div class="bg-white text-red-700 rounded-lg p-4 mb-4 mx-auto max-w-lg">
      <ul class="list-disc list-inside">
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif

  <div class=" max-w-lg  mx-auto bg-white rounded-md shadow-md p-8 mb-6">
    <div class="">
      <form action="{{ route('login.login') }}" method="post">
        @csrf
        <div class="flex items-center text-base mb-6 mx-auto">
          <label for="email" class="w-28 shrink-0">EMAIL</label>
          <input type="email" id="email" name="email" value="" class="min-w-0 flex-1 border">
        </div>
        <div class="flex items-center text-base mb-6 mx-auto">
          <label for="password" class="w-28 shrink-0">PASSWORD</label>
          <input type="password" id="password" name="password" value="" class="min-w-0 flex-1 border">
        </div>
        <button type="submit" class="bg-gray-200 rounded-sm border mx-auto block py-4 px-10 mt-6">
          <div class="">ログイン</div>
        </button>
      </form>
    </div>
  </div>
  <a href="{{ route('register.index') }}" class="block bg-gray-200 rounded-lg ring-1 ring-gray-200/50 shadow-md p-4 mb-6 mx-auto max-w-md">
    <p class="text-center">新規ユーザー登録</p>
  </a>
@endsection

@section('script')
<script>
</script>
@endsection

</html>
