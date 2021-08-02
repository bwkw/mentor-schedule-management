@extends('layouts.app')

@section('link')
    <link rel='stylesheet' href="{{ asset('css/home.css') }}">
    <link rel='stylesheet' href="{{ asset('css/modal.css') }}">
@endsection

@section('script')
    <script src="{{ mix('js/Calendar/month-view.js') }}"></script>
    <script src="{{ mix('js/delete-check.js') }}"></script>
@endsection

@section('content')

    <div class="row mt-5">
        
        <div class="col-md-1">
        </div>
        
        <div class="col-md-4 border pt-3 pb-3">
            
            <div class="row justify-content-center">
                <a href="/meetings/register">
                    <button type="button" class="btn btn-primary btn-lg">面談の登録</button>
                </a>
                <div class="col-md-1"></div>
                <a href="/events/register">
                    <button type="button" class="btn btn-warning btn-lg">イベントの登録</button>
                </a>
            </div>
            
            <div>
                <div class="col-md-1">
                </div>
                
                <div class="card mt-4" >
                    <div class="card-header">
                        今後の予定
                    </div>
                    <ul class="list-group list-group-flush">
                        
                        @if (count($meetingsEvents) == 0)
                            <li class="list-group-item d-flex justify-content-around align-items-center">
                                現在予定はありません
                            </li>
                        @else
                            {{-- 面談とイベントの表示をプロパティによって条件分岐 --}}
                            @for ($i = 0; $i < count($meetingsEvents); $i++)
                                @if (!empty($meetingsEvents[$i]["student_name"]))
                                    <li class="list-group-item d-flex justify-content-around align-items-center">
                                        {{ $meetingsEvents[$i]["date"] }}：{{ $meetingsEvents[$i]["beginning_time"] }}〜{{ $meetingsEvents[$i]["ending_time"] }}<br>
                                        {{ $meetingsEvents[$i]["student_name"] }}との面談（{{ $meetingsEvents[$i]["how_to"] }}）
                                        
                                        <form action="/meetings/{{ $meetingsEvents[$i]["id"] }}" id="meetingDelete{{ $meetingsEvents[$i]["id"] }}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary meetingDeleteButton" id="{{ $meetingsEvents[$i]["id"] }}">削除</button>
                                        </form>
                                        
                                        <a href="/meetings/{{ $meetingsEvents[$i]["id"] }}/edit">
                                            <button type="button" class="btn btn-secondary">編集</button>
                                        </a>
                                    </li>
                                @else
                                    <li class="list-group-item d-flex justify-content-around align-items-center">
                                        {{ $meetingsEvents[$i]["date"] }}：{{ $meetingsEvents[$i]["beginning_time"] }}〜{{ $meetingsEvents[$i]["ending_time"] }}<br>
                                        {{ $meetingsEvents[$i]["event_name"] }}
                                        
                                        <form action="/events/{{ $meetingsEvents[$i]["id"] }}" id="eventDelete{{ $meetingsEvents[$i]["id"] }}" method="post">
                                            {{ csrf_field() }}
                                            @method('DELETE')
                                            <button type="button" class="btn btn-secondary eventDeleteButton" id="{{ $meetingsEvents[$i]["id"] }}">削除</button>
                                        </form>
                                        
                                        <a href="/events/{{ $meetingsEvents[$i]["id"] }}/edit">
                                            <button type="button" class="btn btn-secondary">編集</button>
                                        </a>
                                    </li>
                                @endif
                            @endfor
                        @endif
                        
                    </ul>
                </div>
                
                <div class="col-md-1">
                </div>
            </div>
        </div>
        
        <div class="col-md-1">
        </div>
        
        <div class="col-md-5" id="month_view">
            {{-- MonthView形式のカレンダー表示 --}}
        </div>
        
        <div class="col-md-1">
        </div>
        
    </div>
    
    {{-- モーダル表示部分 --}}
    <div class="modal modal-background">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">イベント情報</h5>
            </div>
            <div class="modal-body">
          　     <div class="modal-body-time"></div>
          　     <div class="modal-body-title"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>

@endsection
