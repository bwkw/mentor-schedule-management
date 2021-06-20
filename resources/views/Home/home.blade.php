@extends('layouts.app')

@section('content')
    <link rel='stylesheet' href="{{asset('css/home.css')}}">
    <link rel='stylesheet' href="{{asset('css/modal.css')}}">

    <div>
        <div class="row mt-5">
            <div class="col-md-1">
            </div>
            
            <div class="col-md-4 border">
                <div class="row justify-content-center mt-3">
                    <a href="/meetings/register">
                        <button type="button" class="btn btn-primary btn-lg">面談の登録</button>
                    </a>
                    <div class="col-md-1"></div>
                    <a href="/events/register">
                        <button type="button" class="btn btn-warning btn-lg">イベントの登録</button>
                    </a>
                </div>
                
                <div>
                    <div class="card mt-4" style="width: 18rem;">
                        <div class="card-header">
                            今後の予定
                        </div>
                        // 面談とイベントの表示をプロパティによって条件分岐
                        @foreach($meetings_events_array as $key => $meeting_event)
                            @if(!empty(($meeting_event->student_name)))
                                <li class="list-group-item">
                                    {{$meeting_event->date}}：{{$meeting_event->starting_time}}〜{{$meeting_event->ending_time}}<br>
                                    {{$meeting_event->student_name}}との面談<br>
                                </li>
                            @else
                                <li class="list-group-item">
                                    {{$meeting_event->date}}：{{$meeting_event->starting_time}}〜{{$meeting_event->ending_time}}<br>
                                    {{$meeting_event->event_name}}<br>
                                </li>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
            
            <div class="col-md-1">
            </div>
            
            <div class="col-md-5" id="month_view">
                
            </div>
            
            <div class="col-md-1">
            </div>
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

    <script src="{{ mix('js/Calendar/MonthView.js') }}"></script>

@endsection
