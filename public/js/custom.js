var MSGBOX = {
    MSGTYPE_ALERT:'alert',
    show:function(text,func,mtype){

        $('#modal-1').find('.modal-body').html(text);
        $('#modal-1').modal('show', {backdrop: 'fade'});

        switch (mtype){
            case this.MSGTYPE_ALERT:
                $('.btn-cancle').html('关闭');
                $('.btn-cancle').addClass('btn-blue');
                $('.btn-cancle').removeClass('btn-white');
                $('.btn-submit').css('display','none');
                break;
            default :


                break;
        }

        if(typeof(func)!='undefined'){
            $('#btn-callback').unbind('click');
            $('#btn-callback').click(
                function(){
                    func();
                   this.hide();
                });
        }
    },
    hide:function(){
        $('#modal-1').modal('hide');
    }
}