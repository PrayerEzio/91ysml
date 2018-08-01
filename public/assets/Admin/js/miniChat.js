if(window.WebSocket){
    //var swoole_host = document.getElementById('swoole_host').value;
    //var swoole_port = document.getElementById('swoole_port').value;
    //var webSocket = new WebSocket("ws://"+swoole_host+":"+swoole_port");
    var webSocket = new WebSocket("ws://47.99.33.85:9502");
    webSocket.onopen = function (event,$req) {
        var token = document.getElementById('token').value;
        var data = {'token':token};
        webSocket.send(data);
    };
    webSocket.onmessage = function (event) {
        var content = document.getElementById('miniChat_content');
        var data = JSON.parse(event.data);
        var html;
        if (data.source != 'system')
        {
            html = '<div class="left"><div class="author-name">'+data.user_name+'<small class="chat-date">'+data.time+'</small></div><div class="chat-message active">'+data.message+'</div></div></p>'
        }else {
            html = '<div class="center">'+data.message+'</div>';
        }
        content.innerHTML = content.innerHTML.concat(html);
    }

    var sendMessage = function(){
        var data = document.getElementById('minichat_message').value;
        webSocket.send(data);
    }
}else{
    console.log("您的浏览器不支持WebSocket");
}