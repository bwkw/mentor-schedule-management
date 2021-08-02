import $ from 'jquery';


// ajaxで取得したイベントデータを格納するための変数定義
var eventData = "";

// ajaxで取得したデータを加工するための変数定義
var eventName = "";
var date = "";
var beginningTime = "";
var endingTime = "";
var eventDetails =[];
var eventDetail = "";

/**
 * ajaxで取得したデータをグローバル変数として使うための関数
 */ 
function setEventData(x){
    eventData = x;
}

// ajaxでデータを取得する
$.ajax({
    type: "GET",
    url: "/events",
    async: false,
    success : function(data) {
        setEventData(data)
    }
});

// ajaxで取得したデータを加工する
for (var i = 0; i < eventData.length; i++) {
    eventName = eventData[i]["event_name"];
    date = eventData[i]["date"];
    beginningTime = eventData[i]["beginning_time"];
    endingTime = eventData[i]["ending_time"];
    eventDetail = 
        {
            title:`${eventName}`,
            start: `${date}T${beginningTime}`,
            end: `${date}T${endingTime}`
        }
    eventDetails.push(eventDetail);
 }
 

export default eventDetails;
