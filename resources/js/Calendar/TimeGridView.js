import { Calendar } from '@fullcalendar/core';
import timeGridPlugin from '@fullcalendar/timegrid';
import MeetingData from "./MeetingScheduleGet";


document.addEventListener('DOMContentLoaded', function(){
  var calendarEl = document.getElementById('calendar');
  
  var calendar = new Calendar(calendarEl, {
    //初期設定
    plugins: [ timeGridPlugin ],
    initialView: 'timeGridWeek',
    
    //イベントの編集可能に可能に
    editable: true,
    
    //カレンダーに表示する文字の言語選択
    locale: 'ja',
    
    //カレンダー上のツールバーのボタン配置
    headerToolbar: {
      left: 'prev',
      center: 'title',
      right: 'today next',
    },
    
    //カレンダーの見出しの文言から月を削除し、日にちだけに
    views: {
      timeGridWeek: {
        titleFormat: function (date) {
          const startMonth = date.start.month + 1;
          const endMonth = date.end.month + 1;
    
          // 1週間のうちに月をまたぐかどうかの分岐処理
          if (startMonth === endMonth) {
             return startMonth + '月';
          } else {
             return startMonth + '月～' + endMonth + '月'; 
          }
        },
        dayHeaderFormat: function (date) {
          const day = date.date.day;
          const weekNum = date.date.marker.getDay();
          const week = ['(日)', '(月)', '(火)', '(水)', '(木)', '(金)', '(土)'][weekNum];
    
          return day + ' ' + week;
        }
      }
    },
    
    //現在時刻を可視化
    nowIndicator: true,
    
    //面談日程の追加
    
    events:
      MeetingData
    
  
  });

  //キャンバスにレンダリング
  calendar.render();
});