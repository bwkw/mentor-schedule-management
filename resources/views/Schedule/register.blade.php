<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        @extends('layouts.app')

        @section('register')
            <div>
                <!-- 切り替えタブ部分 -->
                <ul class="nav nav-tabs nav-justified mt-3" role="tablist">
                    <!-- 1つ目のタブ -->
                    <li class="nav-item">
                        <a class="nav-link active" href="#meeting"
                            data-toggle="tab" role="tab">面談</a>
                    </li>
                    <!-- 2つ目のタブ -->
                    <li class="nav-item">
                        <a class="nav-link" href="#event" 
                        data-toggle="tab" role="tab">イベント</a>
                    </li>
                </ul>
                
                <div class="tab-content mt-4 mb-3">
                    <div class="tab-pane fade show active" id="meeting" role="tabpanel">
                        <div class="row">
                          
                            <div class="col-md-1">
                            </div>
                            
                            <div class="col-md-4 border">
                                <br>
                                <h2>面談予約</h2>
                                <br>
                                <div class="row">
                                    <div class="col-md">
                                        <form action="/meetings" method="POST">
                                            {{ csrf_field() }}
                                            <div class="form-group mb-4">
                                                <label>メンター氏名：</label>
                                                <input type="text" class="form-control" name="meeting[mentor_name]">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label>生徒氏名：</label>
                                                <input type="text" class="form-control" name="meeting[student_name]" >
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="date" class="col-form-label">日程</label>
                                                <input type="date" class="form-control" name="meeting[date]" id="date">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="starting_time" class="col-form-label">開始時間</label>
                                                <input type="time" class="form-control" name="meeting[starting_time]" id="starting_time">
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="ending_time" class="col-form-label">終了時間</label>
                                                <input type="time" class="form-control" name="meeting[ending_time]" id="ending_time">
                                            </div>
                                            
                                            <!-- ユーザーidをリレーション用に格納 -->
                                            <input type="hidden" name="meeting[user_id]" value="{{ Auth::user()->id }}">
                                            
                                            <div class="text-center mt-4">
                                                <button type="submit" class="btn btn-secondary">送信</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-1">
                            </div>
                              
                            <div class="col-md-5" id="calendar">
                                    
                            </div>
                            
                        </div>
                      </div>
    
                    <div class="tab-pane fade" id="event"
                         role="tabpanel">
                        さようなら
                    </div>
                </div>
            </div>
            
            <script src="{{ mix('js/Calendar/TimeGridView.js') }}"></script>
          
        @endsection

        @section('back')
            <div class="col text-center mt-4 mb-4">
                <a href="/">
                    <button type="button" class="btn btn-secondary">戻る</button>
                </a>
            </div>
        @endsection
      
    </body>
</html>
