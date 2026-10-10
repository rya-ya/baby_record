@extends('layouts.app')

@section('title', 'おねんね')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">おねんねを記録</p>
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
      <form action="{{ route('sleep.create',['baby' => $baby->id]) }}" method="post">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <div class="flex justify-around gap-5 w-full ">
          <div class="text-xl mb-6 w-1/3">
            <label for="start-time">寝た時間</label>
            <input type="time" id="start-time" name="start_time" value="{{ now()->format('H:i') }}" class="w-full rounded-md p-1 border">
          </div>
          <div class="text-xl mt-6">→</div>
          <div class="text-xl mb-6 w-1/3">
            <label for="end-time">起きた時間</label>
            <input type="time" id="end-time" name="end_time" value="{{ now()->format('H:i') }}" class="w-full rounded-md p-1 border">
          </div>

        </div>
        <p id="time-error" class="text-red-500 text-sm mt-2"></p>
          <div class="text-xl mb-6 w-full flex gap-4 mt-6">
            <label for="memo">メモ</label>
            <textarea type="text" id="memo" name="memo" value="" class="border w-3/4" rows="3">{{ old('memo') }}</textarea>
          </div>

        <button type="submit" class="bg-gray-200 rounded-sm border p-6 mb-6 mx-auto w-full mt-6">
          <div class="text-3xl font-bold ">変更</div>
        </button>
      </form>
    </div>
  </div>
  <a href="{{ route('days.index',['baby' => $baby->id,'date' => $date]) }}" class="block max-w-md w-1/4 mx-auto text-center bg-gray-200 rounded-md shadow-md p-4 mb-6">
    <div>戻る</div>
  </a>
@endsection

@section('script')
<script>
</script>
@endsection

</html>
