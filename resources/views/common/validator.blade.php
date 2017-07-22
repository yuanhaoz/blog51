<!-- 验证失败的信息全部都会被validate函数自动存到errors这个全局变量中，
直接调用判断是不是存在错误信息,
 \Illuminate\View\Middleware\ShareErrorsFromSession::class, -->

@if(count($errors))
<!-- 所有的错误提示 -->

<div class="alert alert-danger">
    <ul>
        <li>{{ $errors->first() }}</li> <!-- 打印错误的第一条信息 -->
    </ul>
</div>

<div class="alert alert-danger">
    <ul>
        @foreach($errors->all() as $error) <!-- all()方法可以获取所有的错误信息 -->
            <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif