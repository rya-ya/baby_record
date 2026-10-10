@extends('layouts.app')

@section('title', 'ミルク')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">ミルクを編集</p>
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
      <form action="{{ route('milk.update',['baby' => $baby->id,'milk' => $milk->id]) }}" method="post">
        @csrf
        @method('PUT')
        <input type="hidden" name="date" value="{{ $date }}">
        <div class="text-xl mb-6">
          <label for="time">時間</label>
          <input type="time" id="time" name="time" value="{{ old('time',\Carbon\Carbon::parse($milk->time)->format('H:i')) }}" class="ml-16 rounded-md p-1 border">
        </div>
        <div class="text-xl">
          <label for="amount">ミルク量</label>
          <input type="text" id="amount" name="amount" class="w-1/5 ml-4 text-right" value="{{ old('amount',$milk->amount) }}" readonly>ml
          <div class="mt-4 grid grid-cols-3 gap-4" >
            <button type="button" class="block bg-red-200 w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border" onClick="changeMilkAmount(100)">
              <div class="text-lg font-bold">+100ml</div>
            </button>
            <button type="button" class="block bg-red-200 w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border" onClick="changeMilkAmount(50)">
              <div class="text-lg font-bold">+50ml</div>
            </button>
            <button type="button" class="block bg-red-200 w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border" onClick="changeMilkAmount(10)">
              <div class="text-lg font-bold">+10ml</div>
            </button>
            <button type="button" class="block bg-blue-200 w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border" onClick="changeMilkAmount(-100)">
              <div class="text-lg font-bold">-100ml</div>
            </button>
            <button type="button" class="block bg-blue-200 w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border" onClick="changeMilkAmount(-50)">
              <div class="text-lg font-bold">-50ml</div>
            </button>
            <button type="button" class="block bg-blue-200 w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border" onClick="changeMilkAmount(-10)">
              <div class="text-lg font-bold">-10ml</div>
            </button>
          </div>
        </div>
        <div class="text-xl mb-6 w-full flex gap-4 mt-6">
          <label for="memo">メモ</label>
          <textarea type="text" id="memo" name="memo" value="" class="border w-3/4" rows="3">{{ old('memo',$milk->memo) }}</textarea>
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
let milkAmount = parseInt(document.getElementById("amount").value);
function changeMilkAmount(value){
  milkAmount += value;
  if(milkAmount < 0 ){
    milkAmount = 0;
  }
  document.getElementById("amount").value = milkAmount;
}
</script>
@endsection

</html>
