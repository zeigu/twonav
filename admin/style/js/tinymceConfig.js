const tinyId = 'tContent'

function showCode() {
  tinyMCE.editors[tinyId].hide()
}

function showTinymce() {
  tinyMCE.editors[tinyId].show()
}

$(function () {
  tinymce.init({
    selector: '#' + tinyId, //选择器
    language: 'zh_CN',  //调用放在langs文件夹内的语言包
    min_height: 300,  //最小高度
    branding: false,  //隐藏右下角技术支持
    draggable_modal: true,  //模态窗口允许拖动
    placeholder: '请输入内容', //占位符
    menubar: true, //隐藏菜单栏
    convert_urls: false,  //是否自动转换URL
    relative_urls: false, //是否把当前域名中的所有URL转换为相对URL
    remove_script_host: false,  //是否删除URL的域名部分
    fix_list_elements: true,  //修复列表元素
    toolbar_mode: 'sliding',  //工具栏模式
    toolbar_sticky: true,
    autosave_ask_before_unload: false,
    //扩展有效元素
    extended_valid_elements: 'a[*],altglyph[*],altglyphdef[*],altglyphitem[*],animate[*],animatecolor[*],animatemotion[*],animatetransform[*],circle[*],clippath[*],color-profile[*],cursor[*],defs[*],desc[*],ellipse[*],feblend[*],fecolormatrix[*],fecomponenttransfer[*],fecomposite[*],feconvolvematrix[*],fediffuselighting[*],fedisplacementmap[*],fedistantlight[*],feflood[*],fefunca[*],fefuncb[*],fefuncg[*],fefuncr[*],fegaussianblur[*],feimage[*],femerge[*],femergenode[*],femorphology[*],feoffset[*],fepointlight[*],fespecularlighting[*],fespotlight[*],fetile[*],feturbulence[*],filter[*],font[*],font-face[*],font-face-format[*],font-face-name[*],font-face-src[*],font-face-uri[*],foreignobject[*],g[*],glyph[*],glyphref[*],hkern[*],line[*],marker[*],mask[*],metadata[*],missing-glyph[*],mpath[*],path[*],pattern[*],polygon[*],polyline[*],radialgradient[*],rect[*],script[*],set[*],stop[*],lineargradient[*],style[*],m[*],v[*],vs[*],us[*],hide[*],svg[*],switch[*],symbol[*],text[*],textpath[*],title[*],tref[*],tspan[*],use[*],view[*],vkern[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],blockquote[*]',
    //自定义工具栏
    toolbar: [
      'code bold italic underline forecolor backcolor | link unlink blockquote pagebreak nonbreaking hr | copy paste charmap removeformat | table image media emoticons codesample',
      'styleselect alignleft aligncenter alignright | bullist numlist outdent indent lineheight | undo redo restoredraft searchreplace | help wordcount preview fullscreen'
    ],
    //指定需加载的插件
    plugins: 'code advlist autolink autosave charmap codesample colorpicker emoticons fullscreen help hr image link lists lineheight media nonbreaking pagebreak paste preview quickbars searchreplace tabfocus table textpattern wordcount',
    //codesample插件:
    codesample_languages: [
      {text: 'HTML/XML', value: 'markup'},
      {text: 'JavaScript', value: 'javascript'},
      {text: 'CSS', value: 'css'},
      {text: 'PHP', value: 'php'},
      {text: 'Ruby', value: 'ruby'},
      {text: 'Python', value: 'python'},
      {text: 'Java', value: 'java'},
      {text: 'C', value: 'c'},
      {text: 'C#', value: 'csharp'},
      {text: 'C++', value: 'cpp'}
    ],
    image_advtab: true, //image插件: 高级参数
    images_upload_url: './api.php?act=image_upload', //image插件: 指定上传图片的后端处理程序的URL
    default_link_target: '_blank',  //link插件：默认链接打开方式
    link_context_toolbar: true, //link插件：链接的右键增强菜单
    pagebreak_split_block: true,  //pagebreak插件：插入时拆分块元素
    //textpattern插件: 快速排版(可实现markdown写法)
    textpattern_patterns: [
      {start: '*', end: '*', format: 'italic'},
      {start: '**', end: '**', format: 'bold'},
      {start: '#', format: 'h1'},
      {start: '##', format: 'h2'},
      {start: '###', format: 'h3'},
      {start: '####', format: 'h4'},
      {start: '#####', format: 'h5'},
      {start: '######', format: 'h6'},
      {start: '1. ', cmd: 'InsertOrderedList'},
      {start: '* ', cmd: 'InsertUnorderedList'},
      {start: '- ', cmd: 'InsertUnorderedList'}
    ],
    //初始化前执行
    setup: function (editor) {
      editor.on('change', function () {
        editor.save()
      })
    }
  })
  $('#' + tinyId).parent('.oz-form-field').before('<span style="position:absolute; right:0;"><button class="oz-btn" onclick="showTinymce()">可视化</button> <button class="oz-btn" onclick="showCode()">源代码</button></span>')
})