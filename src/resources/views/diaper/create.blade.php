@extends('layouts.app')

@section('title', 'おむつ')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">おむつを記録</p>
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
      <form action="{{ route('diaper.create',['baby' => $baby->id]) }}" method="post">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">
        <div class="text-xl mb-6">
          <label for="time">時間</label>
          <input type="time" id="time" name="time" value="{{ old('time',now()->format('H:i')) }}" class="ml-8 rounded-md p-1 border">
        </div>
        <div class="flex gap-4">
          <button type="button" id="peeButton" class="flex-1 border rounded-md p-4 bg-white-200" onclick="selectDiaper(1)">
            おしっこ
          </button>
          <button type="button" id="poopButton" class="flex-1 border rounded-md p-4 bg-white-200" onclick="selectDiaper(2)">
            うんち
          </button>
        </div>
        <input type="hidden" name="type" id="diaper-type">
        <div class="text-xl mb-6 w-full flex gap-4 mt-6">
          <label for="memo">メモ</label>
          <textarea type="text" id="memo" name="memo" value="" class="border w-3/4" rows="3">{{ old('memo') }}</textarea>
        </div>
        <button type="submit" class="bg-gray-200 rounded-sm border p-6 mb-6 mx-auto w-full mt-6">
          <div class="text-3xl font-bold ">登録</div>
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
function selectDiaper(type){
  const peeButton = document.getElementById('peeButton');
  const poopButton = document.getElementById('poopButton');
  const typeInput = document.getElementById('diaper-type');

  typeInput.value=type;

  peeButton.classList.remove('bg-blue-500' , 'text-white');
  poopButton.classList.remove('bg-blue-500' , 'text-white');

  if (type === 1){
    peeButton.classList.add('bg-blue-500' , 'text-white');
  } else{
    poopButton.classList.add('bg-blue-500' , 'text-white');
  }

}
</script>
@endsection

</html>
