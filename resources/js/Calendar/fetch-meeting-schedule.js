import $ from 'jquery';


// ajaxで取得した面談データを格納するための変数定義
var meetingData = "";

// ajaxで取得したデータを加工するための変数定義
var studentName = "";
var howTo = "";
var date = "";
var beginningTime = "";
var endingTime = "";
var meetingDetails =[];
var meetingDetail = "";

/**
 * ajaxで取得したデータをグローバル変数として使うための関数
 */ 
function setMeetingData(x){
    meetingData = x;
}

// ajaxでデータを取得する
$.ajax({
    type: "GET",
    url: "/meetings",
    async: false,
    success : function(data) {
        setMeetingData(data)
    }
});

// ajaxで取得したデータを加工する
for (var i = 0; i < meetingData.length; i++) {
    studentName = meetingData[i]["student_name"];
    howTo = meetingData[i]["how_to"];
    date = meetingData[i]["date"];
    beginningTime = meetingData[i]["beginning_time"];
    endingTime = meetingData[i]["ending_time"];
    meetingDetail = 
        {
            title:`${studentName}との面談（${howTo}）`,
            // fullcalendarのフォーマットに合わせ日付と時間の間に「T」を挿入
            start: `${date}T${beginningTime}`,
            end: `${date}T${endingTime}`
        }
    meetingDetails.push(meetingDetail);
 }
 

export default meetingDetails;
