var editor = new wangEditor('content');

editor.config.uploadImgUrl = '/posts/image/upload';

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

// var editor = new wangEditor('textarea1');


editor.create();