<form action="/logindo" method="post">
    @csrf
    <p>用户名：<input type="text" name="user_name"></p>
    <p>密码：<input type="password" name="password"></p>
    <p><input type="submit" value="登录"></p>
</form>
<input id="btn" type="button" value="跨域获取数据" />
<textarea id="text" style="width: 400px; height: 100px;"></textarea>
<script src="/js/jquery-3.2.1.min.js"></script>
<script>
    $.ajax({
        type:'post',
        url:'http://api.1809a.com/test'
    })
             // $('#btn').click(function(){
             //     $("head").append("<script src='http://api.1809a.com/test?callback=showData'><\/script>");
             // })
</script>