import { Calendar } from '@fullcalendar/core';
import dayGridPlugin from '@fullcalendar/daygrid';
import MeetingDate from "./MeetingScheduleGet";


document.addEventListener('DOMContentLoaded', function(){
  var calendarEl = document.getElementById('month_view');
  
  var calendar = new Calendar(calendarEl, {
    //初期設定
    plugins: [ dayGridPlugin ],
    initialView: 'dayGridMonth',
    
    //イベントの編集可能に可能に
    editable: true,
    
    // カレンダーに表示する文字の言語選択
    locale: 'ja',
    
    // カレンダー上のツールバーのボタン配置
    headerToolbar: {
      left: 'prev',
      center: 'title',
      right: 'today next',
    },
    
    //カレンダーの表示から"日"を削除
    dayCellContent: function(e) {
        e.dayNumberText = e.dayNumberText.replace('日', '');
      },
      
    
    editable: true,
  
    //面談日程の追加
    events:
      MeetingDate,
      
    eventClick: function(info) {
        //カレンダーへのリンクはさせません。
        info.jsEvent.preventDefault();
        alert('予定あり');
      }
    
  });

  //キャンバスにレンダリング
  calendar.render();
});