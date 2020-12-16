$( document ).ready(function() {

  // Push.Permission.request(this.onGranted, this.onDenied);
  function requestPermission(){
    if(!Push.Permission.has()){
      Push.Permission.request();
    }
  }

  function detectMob() {
      const toMatch = [
          /Android/i,
          /webOS/i,
          /iPhone/i,
          /iPad/i,
          /iPod/i,
          /BlackBerry/i,
          /Windows Phone/i
      ];

      return toMatch.some((toMatchItem) => {
          return navigator.userAgent.match(toMatchItem);
      });
  }

  var pusher = new Pusher('61793d530781baf0985a', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('channel-task');
    channel.bind('new-task', function(data) {
      if(data.role == 1){
        if(data.jenis == 'Problem'){
          if(parseInt(document.getElementById('role-user').innerHTML) == 2){
              if(!detectMob()){
                  Push.create("Hai, "+document.getElementById('name-user').innerHTML+"!", {
                    body: "Anda memiliki task baru dari "+data.from+" pada line "+data.line+" perihal "+data.deskripsi+". Cek notifikasi anda untuk memulai-nya.",
                    icon: '/images/small_logo.png',
                    onClick: function () {
                        window.focus();
                        this.close();
                    }
                  });
                }else{
                  Swal.fire(
                    "Hai, "+document.getElementById('name-user').innerHTML+"!",
                    "Anda memiliki task baru dari "+data.from+" pada line "+data.line+" perihal "+data.deskripsi+". Cek notifikasi anda untuk memulai-nya.",
                    'success'
                  )

                  Push.create("Hai, "+document.getElementById('name-user').innerHTML+"!", {
                    body: "Anda memiliki task baru dari "+data.from+" pada line "+data.line+" perihal "+data.deskripsi+". Cek notifikasi anda untuk memulai-nya.",
                    icon: '/images/small_logo.png',
                    onClick: function () {
                        window.focus();
                        this.close();
                    }
                  });
                }
                var forName = document.getElementById('name-user').innerHTML
                var task_id = data.id
                var fromName = data.from
                var deskripsi = data.deskripsi
                var line = data.line
                var jenis = data.jenis
                var created_at = data.created_at
                var dataString = 'forName='+ forName + '&task_id=' + task_id + '&created_at=' + created_at + '&fromName=' + fromName + '&deskripsi=' + deskripsi + '&line=' + line + '&jenis=' + jenis;
                //alert (dataString);return false;
                $.ajax({
                  type: "POST",
                  url: document.getElementById('notif-url').innerHTML,
                  data: dataString,
                  success: function() {

                  }
                });
                return false;
          }
        }else{
          if(parseInt(document.getElementById('role-user').innerHTML) == 3){
            if(!detectMob()){
              Push.create("Hai, "+document.getElementById('name-user').innerHTML+"!", {
                body: "Anda memiliki task baru dari "+data.from+" pada line "+data.line+" perihal "+data.deskripsi+". Cek notifikasi anda untuk memulai-nya.",
                icon: '/images/small_logo.png',
                onClick: function () {
                    window.focus();
                    this.close();
                }
              });
            }
            var forName = document.getElementById('name-user').innerHTML
            var task_id = data.id
            var fromName = data.from
            var deskripsi = data.deskripsi
            var line = data.line
            var jenis = data.jenis
            var created_at = data.created_at
            var dataString = 'forName='+ forName + '&task_id=' + task_id + '&created_at=' + created_at + '&fromName=' + fromName + '&deskripsi=' + deskripsi + '&line=' + line + '&jenis=' + jenis;
            //alert (dataString);return false;
            $.ajax({
              type: "POST",
              url: document.getElementById('notif-url').innerHTML,
              data: dataString,
              success: function() {

              }
            });
            return false;
          }
        }
      }
    });
});

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-primary ml-2 col-4',
    cancelButton: 'btn btn-secondary mr-2 col-4'
  },
  buttonsStyling: false
})

function openForm(base_url){
  window.location = base_url;
}
