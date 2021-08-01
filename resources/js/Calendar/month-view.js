import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import EventDate from './fetch-event-schedule';
import MeetingDate from './fetch-meeting-schedule';
import $ from 'jquery';


let beginning_datetime = "";
let ending_datetime = "";
let beginning_time = "";
let ending_time = "";
let time = "";

document.addEventListener('DOMContentLoaded', function(){
    var calendarEl = document.getElementById('month_view');
    
    var calendar = new Calendar(calendarEl, {
      
        // 初期設定
        plugins: [ dayGridPlugin ],
        initialView: 'dayGridMonth',
      
        // イベントの編集可能に可能に
        editable: true,
        
        // カレンダーに表示する文字の言語選択
        locale: 'ja',
        
        // カレンダー上のツールバーのボタン配置
        headerToolbar: {
            left: 'prev',
            center: 'title',
            right: 'today next',
        },
        
        // カレンダーの表示から"日"を削除
        dayCellContent: function(e) {
            e.dayNumberText = e.dayNumberText.replace('日', '');
        },
          
        // 面談・イベント日程の追加（配列を合体）
        events:
            MeetingDate.concat(EventDate),
        
        // イベントがクリックされた時、Modal関数を呼ぶ
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            Modal(info);
        },
      
    });
  
    // イベントクリック時にモーダルを表示する
    function Modal(info) {
        $('.modal').fadeIn();
        
        // イベントの時間とタイトルを取得
        beginning_datetime = info.event.start.toString();
        ending_datetime = info.event.end.toString();
        beginning_time = beginning_datetime.match(/\d{2}:\d{2}:\d{2}/)[0];
        ending_time = ending_datetime.match(/\d{2}:\d{2}:\d{2}/)[0];
        time = beginning_time + "~" + ending_time;
        $('.modal-body-time').html(time);
        $('.modal-body-title').html(info.event.title);
    };
    
    // モーダルのCloseボタンを押した時に、モーダルを非表示にする
    $('.modal-close').on('click',function(){
      $('.modal').fadeOut();
    });
    
    // キャンバスにレンダリング
    calendar.render();
});