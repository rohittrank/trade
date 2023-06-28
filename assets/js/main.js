
$(document).ready(function () {
    $('.stock-tabs li').click(function () {
        var tabId = $(this).attr('deta-id')
        $('#' + tabId).fadeIn().siblings().hide()
        $(this).addClass('active').siblings().removeClass('active')
    })

    $('.manage-fund a, .closing-buttons a').click(function () {
        let popId = $(this).attr('href')
        $(popId).show()
    })
    $('.close-btn').click(function () {
        $('.popup').hide()
    })

    $('.eye-btn').click(function(e){
        let inptype = $(this).next('input').attr('type')
        if(inptype === 'password'){
            $(this).next('input').attr('type', 'text')
        }else{
            $(this).next('input').attr('type', 'password')
        }
        $(this).toggleClass('show')
    })
});