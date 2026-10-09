@extends('layouts.app')

@section('title', '記録')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white  rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">赤ちゃんの編集</p>
  </div>

  @if(session('success'))
  <div class="bg-green-100 rounded-lg shadow-md p-3 mb-6 mx-auto max-w-lg ">
    {{ session("success") }}
  </div>
  @endif


  <div class="max-w-lg mx-auto">
    <a href="{{ route('baby.index',[ 'home' => $home->id ]) }}" class="block text-2xl max-w-md mx-auto  rounded-lg shadow-lg px-10 py-4 mb-6 bg-yellow-100 text-center">＋ 新規登録</a>
  </div>

  <div class="max-w-lg mx-auto bg-white rounded-md shadow-md p-4 mb-6">
    <h2 class="text-lg mb-4">赤ちゃんの一覧</h2>
    <div class="space-y-3">
      @forelse($babies as $baby)
      <div class="flex items-center justify-around bg-gray-200 text-2xl text-gray-600 rounded-lg shadow-md p-4 mb-6">
        <div>{{ $baby->name }}</div>
          <div class="flex justify-end gap-2 mt-2">
            <a href="{{ route('baby.edit',[ 'home'=>$home->id,'baby'=>$baby->id ]) }}"
               class="bg-white border rounded-sm text-md px-3 py-1">
               変更</a>
            <form action="{{ route('baby.destroy',[ 'home'=>$home->id,'baby'=>$baby->id ]) }}" method="post" onsubmit="return confirm('本当に削除しますか？')" class="block">
              @csrf
              @method('DELETE')
              <button type="submit" class="bg-white border rounded-sm text-md px-3 py-1">削除</button>
            </form>
          </div>
      </div>
      @empty
      <div class="text-center text-gray-500 py-6">
          まだ赤ちゃんが登録されていません
      </div>
      @endforelse
    </div>
  </div>
  <div class="max-w-lg mx-auto">
    <a href="{{ route('homes.index',[ 'home' => $home->id ]) }}" class="block w-fit max-w-lg mr-auto bg-gray-200 rounded-md shadow-md px-10 py-4 mb-6">戻る</a>
  </div>
@endsection

@section('script')
<script>
</script>
@endsection

</html>
