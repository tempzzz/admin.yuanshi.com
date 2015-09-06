$.ajaxSetup({
    headers: {
        'token': $('meta[name="token"]').attr('content')
    }
});