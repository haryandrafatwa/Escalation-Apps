function showAppDesc(){
  var app_desc = document.getElementById('app-desc')
  if(app_desc.style.display == 'none'){
    document.getElementById('ic-btn').className = "fas fa-times fa-lg"
    app_desc.style.display = 'block'
  }else{
    document.getElementById('ic-btn').className = "fas fa-play fa-lg"
    app_desc.style.display = 'none'
  }
}
