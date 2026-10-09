@extends('layouts.app')

@section('title', '記録')

@section('content')
  <div class="flex flex-col items-center justify-center bg-white rounded-lg shadow-md p-6 mb-6 mx-auto max-w-lg">
    <p class="text-3xl font-bold">{{ $home->name }}家</p>
  </div>
  <div class="max-w-lg mx-auto bg-white rounded-md shadow-md p-4 mb-6">
    <h2 class="text-lg mb-4">赤ちゃんの一覧</h2>
    <div class="space-y-3">
      @forelse($babies as $baby)
      <a href="{{ route('days.index',['baby' => $baby->id]) }}" class="block max-w-sm text-center mx-auto text-2xl text-gray-600 rounded-lg shadow-md p-6 mb-6 rounded-md shadow-md
      {{ $baby->gender == 1 ? 'bg-blue-200' : 'bg-red-200' }}">
        <div>{{ $baby->name }}</div>
        <div class="text-sm mt-2 flex justify-center gap-4">
          <div>{{ $baby->gender == 1 ? '男の子' : '女の子' }}</div>
          <div>{{ $baby->age }}</div>
        </div>
      </a>
      @empty
      <div class="text-center text-gray-500 py-6">
          まだ赤ちゃんが登録されていません
      </div>
      @endforelse
    </div>
  </div>
  <div class="max-w-lg flex justify-center mx-auto">
    <div class="max-w-lg mx-auto">
      <a href="{{ route('homes.edit',[ 'home' => $home->id ]) }}" class="block w-fit max-w-lg mr-auto bg-gray-200 rounded-md shadow-md px-10 py-4 mb-6">赤ちゃん編集</a>
    </div>
    <div class="max-w-lg mx-auto">
      <form action="{{ route('logout.logout') }}" method="post">
        @csrf
        <button type="submit" class="block w-fit max-w-lg mr-auto bg-gray-200 rounded-md shadow-md px-10 py-4 mb-6">ログアウト</button>
      </form>
    </div>
</div>
@endsection

@section('script')
<script>
</script>
@endsection

</html>
