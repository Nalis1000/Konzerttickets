function pay(form){
       console.log(form);
        var res = $(form).serialize()
        console.log(res);

        jQuery.ajax({
        url: 'addpaid',
        type: 'post',
        data: res,
        success: function(data) { $("#result").html(data); }
            });
    setInterval('location.reload()', 1000);



}
