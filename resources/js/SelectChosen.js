import jquery from 'jquery'

jquery(document).ready(function () {
    jquery(".chosen").chosen({  
        search_contains: true  ,
        no_results_text:"ありません"
    })  
});  