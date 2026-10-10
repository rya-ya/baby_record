@extends('layouts.app')

@section('title', '記録')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg ">
    <div class="text-3xl font-bold">{{ $baby->name }}</div>
    <div class="text-sm mt-2 flex justify-center gap-4">
      <div class="{{ $baby->gender == 1 ? 'text-blue-400' : 'text-red-400' }}">{{ $baby->gender == 1 ? '男の子' : '女の子' }}</div>
      <div>{{ $baby->age }}</div>
    </div>
  </div>

  @if(session('success'))
  <div class="bg-green-100 rounded-lg shadow-md p-3 mb-6 mx-auto max-w-lg ">
    {{ session("success") }}
  </div>
  @endif

  <div class=" max-w-lg  mx-auto bg-white rounded-md shadow-md p-4 mb-6">
    <div class="mb-8">
      <label class="block mb-2 text-lg" for="date">
          記録する日にち
      </label>
      <!-- <div class="ml-4 flex items-center gap-4 w-full">
          <span id="selected-date" class="font-semibold text-xl"></span>
          <button type="button" onclick="document.getElementById('date').showPicker()" class="bg-gray-200 px-3 py-1 rounded-lg border ">変更</button>
          <input type="date" id="date" name="date" value="{{ $date }}" class="hidden">
      </div> -->

      <!-- safariに対応 -->
      <div class="ml-4 flex items-center gap-4 w-full">
          <span id="selected-date" class="font-semibold text-xl"></span>
          <div class="relative">
              <button type="button" class="bg-gray-200 px-3 py-1 rounded-lg border">変更</button>
              <input type="date" id="date" name="date" value="{{ $date }}" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
          </div>
      </div>
    </div>

    <div class="mt-4 grid grid-cols-3 gap-4">

      <a href="{{ route('milk.index',['baby' => $baby->id,'date' => $date]) }}"
      class="block bg-blue-300 text-white w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center">
        <div class="text-sm">milk</div><div class="text-lg font-bold"><i class="fa-solid fa-droplet"></i>ミルク</div>
      </a>

      <a href="{{ route('diaper.index',['baby' => $baby->id,'date' => $date]) }}" class="block bg-blue-300 text-white w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border">
        <div class="text-sm">diaper</div><div class="text-lg font-bold"><i class="fa-solid fa-baby"></i>おむつ</div>
      </a>

      <a href="{{ route('sleep.index',['baby' => $baby->id,'date' => $date]) }}" class="block bg-blue-300 text-white w-full aspect-[1.2] rounded-md flex flex-col items-center justify-center border">
        <div class="text-sm">sleep</div><div class="text-lg font-bold"><i class="fa-solid fa-moon"></i>おねんね</div>
      </a>

    </div>
  </div>

  <div class="max-w-lg mx-auto bg-white rounded-md shadow-md p-4 mb-4">
    <h2 class="text-lg mb-4">この日の記録内容</h2>
    <div class="space-y-3">

      @forelse($records as $record)
      <div class="flex gap-4 items-start">
        <div class="w-14 text-sm font-semibold text-gray-600">
            {{ \Carbon\Carbon::parse($record['time'])->format('H:i') }}
        </div>
        <div class="bg-white border rounded-lg p-3 shadow-sm w-full">
          <div class="">
            <div class="flex">
              <div class="font-semibold">
                  @if($record['type']=='milk')
                  <i class="fa-solid fa-droplet"></i>ミルク
                  @elseif($record['type']=='diaper')
                   <i class="fa-solid fa-baby"></i>
                  おむつ
                  @elseif($record['type']=='sleep')
                  <i class="fa-solid fa-moon"></i>
                  おねんね
                  @endif
              </div>
              <div class="text-sm text-gray-600 mt-1 ml-4">
                  @if($record['type']=='milk')
                  {{ $record['data']->amount }}ml
                  @elseif($record['type']=='diaper')
                    @if($record['data']->type==1)
                      おしっこ
                    @elseif($record['data']->type==2)
                      うんち
                    @endif
                  @elseif($record['type']=='sleep')
                  {{ \Carbon\Carbon::parse($record['data']->start_time)->format('H:i') }}～
                  {{ \Carbon\Carbon::parse($record['data']->end_time)->format('H:i') }}
                  @endif
              </div>
            </div>
            <div class="text-sm text-gray-600 mt-1 break-words">
                  {{ $record['data']->memo }}
            </div>
          </div>
          <div class="flex justify-end gap-2 mt-2">
            <a href="{{ route($record['type'].'.edit',[
                        'baby' => $baby->id,
                        'date' => $date,
                        $record['type'] => $record['data']->id,
                      ]) }}"
               class="bg-gray-200 border rounded-sm text-md px-3 py-1">
               変更</a>
            <form action="{{ route($record['type'].'.destroy',[
                        'baby' => $baby->id,
                        'date' => $date,
                        $record['type'] => $record['data']->id,
                      ]) }}" method="post" onsubmit="return confirm('この記録を削除しますか？')" class="block">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-gray-200 border rounded-sm text-md px-3 py-1">削除</button>
            </form>
          </div>
        </div>
      </div>
      @empty
      <div class="text-center text-gray-500 py-6">
          まだ登録されていません
      </div>
      @endforelse

    </div>
  </div>
  <div class="max-w-lg mx-auto">
    <a href="{{ route('homes.index',[ 'home' => $baby->home_id]) }}" class="block w-fit max-w-lg ml-auto bg-gray-200 rounded-md shadow-md px-6 py-3 mb-6">戻る</a>
  </div>
@endsection

@section('script')
<script>
    const dateInput = document.getElementById('date');
    const selectedDate = document.getElementById('selected-date');

    function updateDate(){
        const date = new Date(dateInput.value);

        const year = date.getFullYear();
        const month = date.getMonth() + 1;
        const day = date.getDate();

        const weekdays = ['日', '月', '火', '水', '木', '金', '土'];
        const weekday = weekdays[date.getDay()];

        selectedDate.textContent =
            `${year}年${month}月${day}日（${weekday}）`;
    }

    //初期表示
    updateDate();

      // 日付変更
      dateInput.addEventListener('change', function () {
          const date = this.value;
          const babyId = {{ $baby->id }};

          const url = `/babies/${babyId}/days?date=${date}`;

          window.location.href = url;
      });

</script>
@endsection

</html>
