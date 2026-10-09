@extends('layouts.app')

@section('title', '新規ユーザー登録')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">新規ユーザー登録</p>
  </div>

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
      <form action="" method="post">
        @csrf
        <div class="flex flex-col gap-2 text-base mb-6 mx-auto">
          <label for="home" class="">家族の名字</label>
          <input type="text" id="home" name="home" value="{{ old('home') }}" class="w-full border required">
        </div>
        <div class="flex flex-col gap-2 text-base mb-6 mx-auto">
          <label for="email" class="">メールアドレス</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" class="w-full border required">
          <p class="text-sm">登録の際にEメールは届きません。</p>
        </div>
        <div class="flex flex-col gap-2 text-base mb-6 mx-auto">
          <label for="password" class="">パスワード（４文字以上）</label>
          <input type="password" id="password" name="password" value="" class="w-full border required">
        </div>
        <div class="flex flex-col gap-2 text-base mb-6 mx-auto">
          <label for="password_confirmation" class="">パスワード（確認）</label>
          <input type="password" id="password_confirmation" name="password_confirmation" value="" class="w-full border required">
        </div>
        <button type="submit" class="bg-gray-200 rounded-sm border mx-auto block py-4 px-10 mt-6">
          <div class="">新規登録</div>
        </button>
      </form>
    </div>
  </div>
  <a href="{{ route('login.index') }}" class="block bg-gray-200 rounded-lg ring-1 ring-gray-200/50 shadow-md p-4 mb-6 mx-auto max-w-md">
    <p class="text-center">ログイン画面へ戻る</p>
  </a>
@endsection

@section('script')
<script>
</script>
@endsection

</html>
