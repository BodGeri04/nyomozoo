window.deleteConfirm = function(message, url, cssid){
    swal(message, {
      dangerMode: true,
      buttons: true,
    }).then(function(isConfirm){
        if(isConfirm){
          $.ajax({
            url: url,
            type: 'DELETE',  // user.destroy
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(result) {
              swal({
                title: "Sikeres!",
                text: "A módosítások mentésre kerültek!",
                type: "success"
            }).then(function() {
                window.location = "";
            });
            }
        });
        }
    });
    }
 window.linkConfirm = function(message, url){
    swal(message, {
      dangerMode: true,
      buttons: true,
    }).then(function(isConfirm){
        if(isConfirm){
          window.location.href = url;
        }
    });
}