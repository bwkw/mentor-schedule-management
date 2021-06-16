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
                                <select data-placeholder="選択してください" class="form-control chosen" data-placeholder="選択してください" name="event[mentor_name]">
                                    <option value="">選択してください</option>
                                    @foreach($mentors as $mentor)
                                        <option value="{{$mentor->slack_name}}">{{$mentor->slack_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group mb-4">
                                <label for="date" class="col-form-label">イベント名</label>
                                <input type="text" class="form-control" name="event[event_name]">
                            </div>
                            <div class="form-group mb-4">
                                <label for="date" class="col-form-label">日程</label>
                                <input type="date" class="form-control" name="event[date]" id="date">
                            </div>
                            <div class="form-group mb-4">
                                <label for="starting_time" class="col-form-label">開始時間</label>
                                <input type="time" class="form-control" name="event[starting_time]" id="starting_time">
                            </div>
                            <div class="form-group mb-4">
                                <label for="ending_time" class="col-form-label">終了時間</label>
                                <input type="time" class="form-control" name="event[ending_time]" id="ending_time">
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
                <button type="button" class="btn btn-secondary modal-close" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
    
    
    <div class="col text-center mt-4 mb-4">
        <a href="/">
            <button type="button" class="btn btn-secondary">戻る</button>
        </a>
    </div>
    
    <script src="{{ mix('js/Calendar/TimeGridView.js') }}"></script>
    <script src="{{ mix('js/Calendar/MeetingScheduleGet.js') }}"></script>
    <script src="{{ mix('js/Calendar/EventScheduleGet.js') }}"></script>
    <!-- <script src="{{ mix('js/SelectChosen.js') }}"></script> -->
    
@endsection