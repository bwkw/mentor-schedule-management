import $ from 'jquery';
import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import eventDetails from './fetch-event-schedule';
import meetingDetails from './fetch-meeting-schedule';


var beginningDatetime = "";
var endingDatetime = "";
var beginningTime = "";
var endingTime = "";
var time = "";

/**
 * MonthView形式のカレンダー作成
 */
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('monthView');
    
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
        
        /**
         * カレンダーの表示から"日"を削除
         */ 
        dayCellContent: function(e) {
            e.dayNumberText = e.dayNumberText.replace('日', '');
        },
          
        // 面談・イベント日程の追加
        events:
            meetingDetails.concat(eventDetails),
        
        /**
         * イベントがクリックされた時、Modal関数を呼ぶ
         */
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            Modal(info);
        }
    });
  
    /**
     * イベントクリック時にモーダルを表示する
     */
    function Modal(info) {
        $('.modal').fadeIn();
        
        // イベントの時間とタイトルを取得
        beginningDatetime = info.event.start.toString();
        endingDatetime = info.event.end.toString();
        beginningTime = beginningDatetime.match(/\d{2}:\d{2}:\d{2}/)[0];
        endingTime = endingDatetime.match(/\d{2}:\d{2}:\d{2}/)[0];
        time = beginningTime + "~" + endingTime;
        $('.modal-body-time').html(time);
        $('.modal-body-title').html(info.event.title);
    };
    
    /**
     * モーダルのCloseボタンを押した時に、モーダルを非表示にする
     */ 
    $('.modal-close').on('click', function() {
      $('.modal').fadeOut();
    });
    
    // キャンバスにレンダリング
    calendar.render();
});
