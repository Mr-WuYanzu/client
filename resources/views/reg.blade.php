<form action="/reg_do" method="post">
    @csrf
    <p>用户名：<input type="text" name="user_name"></p>
    <p>邮箱：<input type="text" name="email"></p>
    <p>密码：<input type="password" name="password"></p>
    <p><input type="submit" value="注册"></p>
</form>