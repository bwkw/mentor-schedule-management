import $ from 'jquery';

let data = "";
function set_work_schedule_data(x){
    data = x;
}

// ajaxでデータを取得する
$.ajax({
    type: "GET",
    url: "https://docs.google.com/spreadsheets/d/1-Rdn9b--9e2lNH25KWILFOXkupQyBDbYbm_ivNbmMHc/edit#gid=358493515",
    mode: 'cors',
    async: false,
    success : function(data) {
        set_work_schedule_data(data)
    }
});

console.log(data);