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
            <h2>面談予約</h2>
            <br>
            <div class="row">
                <div class="col-md">
                    <form action="/meetings/{{ $meeting->id }}" method="POST">
                        {{ csrf_field() }}
                        @method('PUT')
                        <div class="form-group mb-4">
                            <label>メンター氏名(slack)</label>
                            <input type="input" class="form-control" value="{{ $meeting->mentor_name }}" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label>生徒氏名(slack)</label>
                            <input type="input" class="form-control" value="{{ $meeting->student_name }}" readonly>
                        </div>
                        <div class="form-group mb-4">
                            <label>面談形式</label>
                            <select class="form-control" name="meeting[how_to]">
                                @if(($meeting->how_to)=="対面")
                                    <option value="対面">対面</option>
                                    <option value="オンライン">オンライン</option>
                                @else
                                    <option value="オンライン" >オンライン</option>
                                    <option value="対面">対面</option>
                                @endif
                            </select>
                        </div>
                        <div class="form-group mb-4">
                            <label for="date" class="col-form-label">日付</label>
                            <input type="date" class="form-control" name="meeting[date]" value="{{ $meeting->date }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="beginning_time" class="col-form-label">開始時間</label>
                            <input type="time" class="form-control" name="meeting[beginning_time]" value="{{ $meeting->beginning_time }}">
                        </div>
                        <div class="form-group mb-4">
                            <label for="ending_time" class="col-form-label">終了時間</label>
                            <input type="time" class="form-control" name="meeting[ending_time]" value="{{ $meeting->ending_time }}">
                        </div>
                        
                        <!-- ユーザーidをリレーション用に格納 -->
                        <input type="hidden" name="meeting[user_id]" value="{{ Auth::user()->id }}">
                        
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
