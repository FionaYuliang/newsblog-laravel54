@extends("layout.main")
@section('content')
    <style type="text/css">
        .toolbar {
            border: 1px solid #ccc;
            overflow: scroll;
        }

        .text {
            border: 1px solid #ccc;
            height: 400px;
        }
    </style>

    <div class="col-sm-8 blog-main">
        <div>
            <div class="form-group">
                <label>标题</label>
                <input name="title" type="text" class="form-control" placeholder="这里是标题">
            </div>
            <div class="form-group">
                {{--<label>内容</label>--}}
                {{--<textarea id="content" style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容">--}}
                {{--请输入内容--}}

                {{--</textarea>--}}
                <div id="tool" class="toolbar">
                </div>
                <div style="padding: 5px 0; color: #ccc">中间隔离带</div>
                <div id="textarea" class="text"> <!--可使用 min-height 实现编辑区域自动增加高度-->

                </div>
            </div>
            @include('layout.error')
            <button id="submit" class="btn btn-info">提交</button>
        </div>


        <br>
    </div>



@endsection

@section('script')
    <script type="text/javascript" src="/js/wangEditor.js"></script>
    <script type="text/javascript">
      let E = window.wangEditor
      let editor = new E('#tool', '#textarea')
      // 或者 var editor = new E( document.getElementById('editor') )
      editor.customConfig.uploadImgServer = '/posts/image/upload'

      editor.create()

      $('#submit').on('click', function (ev) {
        let content = editor.txt.html()
        let title = $('input[name="title"]').val()

        $.post('/posts/ajaxCreate', {title: title, content: content}, function (res) {
        //  console.log('response =>', res)
          alert('发表成功!')
          window.location.href = '/posts'
        })

        return false
      })

    </script>
@endsection