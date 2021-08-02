@extends('layouts.app')

@section('link')
    <link rel='stylesheet' href="{{ asset('css/modal.css') }}">
@endsection

@section('script')
    <script src="{{ mix('js/Calendar/time-grid-view.js') }}"></script>
@endsection

@section('content')

    <div class="mt-5 row">
        
        <div class="col-md-1">
        </div>
        
        <div class="col-md-4 border">
            <br>
            <h2>イベント予約</h2>
            <br>
            <div class="row">
                <div class="col-md">
                    <form action="/events/{{ $event->id }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label>メンター氏名(slack)</label>
                            <input type="input" class="form-control" value="{{ $event->mentor_name }}" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="date" class="col-form-label">イベント名</label>
                            <input type="input" class="form-control" value="{{ $event->event_name }}" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label for="date" class="col-form-label">日付</label>
                            <input type="date" class="form-control" name="event[date]" value="{{ $event->date }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="beginning_time" class="col-form-label">開始時間</label>
                            <input type="time" class="form-control" name="event[beginning_time]" value="{{ $event->beginning_time }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="ending_time" class="col-form-label">終了時間</label>
                            <input type="time" class="form-control" name="event[ending_time]" value="{{ $event->ending_time }}">
                        </div>
                        
                        {{-- ユーザーidをリレーション用に格納 --}}
                        <input type="hidden" name="event[user_id]" value="{{ Auth::user()->id }}">
                        
                        <div class="text-center mt-3 mb-2">
                            <button type="submit" class="btn btn-secondary">送信</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-md-1">
        </div>
          
        <div class="col-md-5" id="timeGridView">
            {{-- タイムグリッド形式のカレンダー表示 --}} 
        </div>
        
        <div class="col-md-1">
        </div>
    </div>
    
    <div class="modal modal-background">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">イベント情報</h5>
            </div>
            <div class="modal-body">
                <div class="modal-body-start-time"></div>
                <div class="modal-body-end-time"></div>
                <div class="modal-body-title"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
    
    
    <div class="col text-center mt-4 mb-4">
        <a href="/">
            <button type="button" class="btn btn-secondary">戻る</button>
        </a>
    </div>
    
@endsection
