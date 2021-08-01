@extends('layouts.app')

@section('content')
<link rel='stylesheet' href="{{asset('css/modal.css')}}">

    <div class="mt-5">
        <div class="row">
            <div class="col-md-1">
            </div>
            
            <div class="col-md-4 border">
                <br>
                <h2>イベント予約</h2>
                <br>
                <div class="row">
                    <div class="col-md">
                        <form action="/events" method="POST">
                            {{ csrf_field() }}
                            <div class="form-group mb-4">
                                <label>メンター氏名(slack)：</label>
                                <input type="input" class="form-control" name="event[mentor_name]" value="{{ $yourName }}" readonly>
                            </div>
                            <div class="form-group mb-4">
                                <label for="date" class="col-form-label">イベント名</label>
                                <input type="text" class="form-control" name="event[event_name]" value="{{ old('event.event_name') }}">
                                <p class="event_name__error" style="color:red">{{ $errors->first('event.event_name') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="date" class="col-form-label">日付</label>
                                <input type="date" class="form-control" name="event[date]" value="{{ old('event.date') }}" id="date">
                                <p class="date__error" style="color:red">{{ $errors->first('event.date') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="beginning_time" class="col-form-label">開始時間</label>
                                <input type="time" class="form-control" name="event[beginning_time]" value="{{ old('event.beginning_time') }}" id="beginning_time">
                                <p class="starting_time__error" style="color:red">{{ $errors->first('event.beginning_time') }}</p>
                            </div>
                            <div class="form-group mb-4">
                                <label for="ending_time" class="col-form-label">終了時間</label>
                                <input type="time" class="form-control" name="event[ending_time]" value="{{ old('event.ending_time') }}"id="ending_time">
                                <p class="ending_time__error" style="color:red">{{ $errors->first('event.ending_time') }}</p>
                            </div>
                            
                            <!-- ユーザーidをリレーション用に格納 -->
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
              
            <div class="col-md-5" id="time_grid_view">
                    
            </div>
            
            <div class="col-md-1">
            </div>
        </div>
    
    <!-- モーダル表示部分 -->
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
    
    <div class="col text-center mt-4 mb-4">
        <a href="/">
            <button type="button" class="btn btn-secondary">戻る</button>
        </a>
    </div>
    
    <script src="{{ mix('js/Calendar/TimeGridView.js') }}"></script>
    <script src="{{ mix('js/Calendar/FetchMeetingSchedule.js') }}"></script>
    <script src="{{ mix('js/Calendar/FetchEventSchedule.js') }}"></script>
    
@endsection