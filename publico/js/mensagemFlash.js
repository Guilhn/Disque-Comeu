setTimeout(function(){ 
    var msg = document.getElementsByClassName("toast");
    while(msg.length > 0){
        msg[0].parentNode.removeChild(msg[0]);
    }
}, 3000);