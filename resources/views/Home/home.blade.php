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
                    <div class="col-md-1"></div>
                    
                    <div class="card mt-4" >
                        <div class="card-header">
                            今後の予定
                        </div>
                        <ul class="list-group list-group-flush">
                            
                            @if( count( $meetings_events_array )==0 )
                                <li class="list-group-item d-flex justify-content-around align-items-center">
                                    現在予定はありません
                                </li>
                            @else
                                <!-- 面談とイベントの表示をプロパティによって条件分岐 -->
                                @foreach( $meetings_events_array as $key => $meeting_event )
                                    @if( !empty( $meeting_event->student_name ) )
                                    
                                        <li class="list-group-item d-flex justify-content-around align-items-center">
                                            {{ $meeting_event->date }}：{{ $meeting_event->beginning_time }}〜{{$meeting_event->ending_time}}<br>
                                            {{ $meeting_event->student_name }}との面談
                                            
                                            <form action="/meetings/{{ $meeting_event->id }}" id="form_delete" method="post">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" onclick="deleteSchedule(this);">削除</button> 
                                            </form>
                                            
                                            <a href="/meetings/{{ $meeting_event->id }}/edit">
                                                <button type="button" class="btn btn-secondary">編集</button>
                                            </a>
                                        </li>
                                        
                                    @else
                                    
                                        <li class="list-group-item d-flex justify-content-around align-items-center">
                                            {{ $meeting_event->date }}：{{ $meeting_event->beginning_time }}〜{{ $meeting_event->ending_time }}<br>
                                            {{ $meeting_event->event_name }}
                                            
                                            <form action="/events/{{ $meeting_event->id }}" id="form_delete" method="post">
                                                {{ csrf_field() }}
                                                @method('DELETE')
                                                <button type="button" class="btn btn-secondary" onclick="deleteSchedule(this);">削除</button> 
                                            </form>
                                            
                                            <a href="/events/{{$meeting_event->id}}">
                                                <button type="button" class="btn btn-secondary">編集</button>
                                            </a>
                                        </li>
                                        
                                    @endif
                                @endforeach
                            @endif
                            
                        </ul>
                    </div>
                    
                    <div class="col-md-1"></div>
                </div>
            </div>
            
            <div class="col-md-1">
            </div>
            
            <div class="col-md-5" id="month_view">
                <!-- 月単位で予定を表示する部分 -->
            </div>
            
            <div class="col-md-1">
            </div>
            
        </div>
    </div>
    
    <!-- モーダル表示部分 -->
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

    <script src="{{ mix('js/Calendar/MonthView.js') }}"></script>
    
    <script>
            function deleteSchedule(e){
                if (confirm('削除すると復元が出来ません。\n本当に削除しますか？')){
                    document.getElementById('form_delete').submit();
                }
            }
        </script>

@endsection
