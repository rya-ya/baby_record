@extends('layouts.app')

@section('title', '赤ちゃん新規登録')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">{{ $baby->name }} の編集</p>
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

  <div class=" max-w-lg  mx-auto bg-white rounded-md shadow-md p-4 mb-6">
    <div class="">
      <form action="{{ route('baby.update',['baby' => $baby->id,'home' => $home->id]) }}" method="post">
        @csrf
        @method('PUT')
        <div class="text-xl mb-6 w-full flex gap-4 mt-8">
          <label for="name">名前</label>
          <input type="text" id="name" name="name" value="{{ old('name',$baby->name) }}" class="border w-3/4 ml-4">
        </div>
        <div class="text-xl mb-6 w-full flex gap-4 mt-8">
          <p>性別</p>
          <dev class="ml-4 text-xl w-2/3 flex gap-12">
            <label>
              <input type="radio" name="gender" value="1" @checked(old('gender',$baby->gender)=='1') >男の子
            </label>
            <label>
              <input type="radio" name="gender" value="2"  @checked(old('gender',$baby->gender)=='2') >女の子
            </label>
          </dev>
        </div>

        <div class="text-xl mb-6 w-full flex gap-4 mt-8">
          <p>誕生日</p>
          <input type="date" id="birthday" name="birthday" class="w-3/5 border" value="{{ old('birthday',$baby->birthday) }}">
        </div>

        <div class="text-xl mb-6 w-full flex gap-4 mt-8">
          <label for="memo">メモ</label>
          <textarea type="text" id="memo" name="memo" value="" class="border w-3/4 ml-4" rows="3">{{ old('memo',$baby->memo) }}</textarea>
        </div>
        <button type="submit" class="bg-gray-200 rounded-sm border p-6 mb-6 mx-auto w-full mt-6">
          <div class="text-3xl font-bold ">変更</div>
        </button>
      </form>
    </div>
  </div>
  <a href="{{ route('homes.edit',['home' => $home->id]) }}" class="block max-w-md w-1/4 mx-auto text-center bg-gray-200 rounded-md shadow-md p-4 mb-6">
    <div>戻る</div>
  </a>
@endsection

@section('script')
@endsection

</html>
