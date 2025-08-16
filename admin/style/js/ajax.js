const numberReg = /^[-]?[0-9]+$/ //验证数字
const urlReg = /^(?=^.{3,255}$)(http(s)?:\/\/)?(www\.)?[a-zA-Z0-9][-a-zA-Z0-9]{0,62}(\.[a-zA-Z0-9][-a-zA-Z0-9]{0,62})+(:\d+)*(\/([-\w]+)*(\.[-\w]+)*)*([#?&]\w+=\w*)*$/i //验证url
const aliasReg = /^[a-zA-Z][a-zA-Z0-9_]*$/i //验证别名
const qqReg = /^([1-9]\d{4,9}$)|^暂无$/ //验证QQ号
const emailReg = /^[A-Za-z\d]+([-_.][A-Za-z\d]+)*@([A-Za-z\d]+[-.])+[A-Za-z\d]{2,4}$/i //验证邮箱
const imgReg = /\.(ico|png|jpg|jpeg|gif)$/i //验证图片类型
const sqlReg = /\.sql$/i //验证sql文件类型
const zipReg = /\.zip$/i //验证sql文件类型

$(function () {
  let timer

  //懒加载
  lazyRender()

  $(window).on('scroll', function () {
    //监听懒加载渲染
    timer && clearTimeout(timer)
    timer = setTimeout(function () {
      lazyRender()
    }, 300)
  })
})

//全选功能
function selectAll(checkbox) {
  const form = $(checkbox).closest('form')
  form.find('input[type=checkbox]').prop('checked', $(checkbox).prop('checked'))
}

//刷新表格

function reload(callback) {
  layer.close()
  layer.load(2)
  $('body').load(location.href + ' #loadTable')
  setTimeout(() => {
    highLight()
    layer.close('loading')
    location.reload()
  }, 300)
}
//刷新按钮
function f5()
{
location.reload()
}
//更换搜索类型
function changeSearchType(dom) {
  const type = $(dom).val()
  $('#search').attr('action', type === 'post' ? 'post.php' : 'site.php')
}

//懒加载
function lazyRender() {
  $('.lazy-load').each(function () {
    const scrollTop = $(window).scrollTop(),
        windowHeight = $(window).height(),
        offsetTop = $(this).offset().top
    if (offsetTop < (scrollTop + windowHeight) && offsetTop > scrollTop && $(this).attr('data-src') !== $(this).attr('src')) {
      $(this).animate({opacity: 'toggle'}, 300, function () {
        $(this).attr('src', $(this).attr('data-src'))
        $(this).animate({opacity: 'toggle'}, 300)
      })
    }
  })
}

//显示消息提示框
function showToast(msg, callback, option) {
  return layer.msg(msg, {
    anim: 6,
    time: 500,
    ...option
  }, () => {
    typeof callback === 'function' && callback()
  })
}

//显示普通信息框
function showAlert(code, msg, option) {
  return layer.alert('错误代码：' + code + '<br/>错误信息：' + msg, {
    anim: 6,
    ...option
  })
}

//显示询问框
function showConfirm(msg, callback) {
  return layer.confirm(msg, {
    anim: 6,
    shadeClose: true,
  }, () => {
    typeof callback === 'function' && callback()
  })
}

//显示弹窗
function showPopup(title, content, option) {
  return layer.open({
    type: 1,
    title,
    content,
    resize: false,
    shadeClose: true,
    success() {
      $(':focus').blur()
    },
    ...option
  })
}

//关闭弹窗
function closePopup(index) {
  return layer.close(index || layer.index)
}

//检测输入
function checkInput(options) {
  for (const item of options) {
    const dom = $('#' + item.id)
    const value = dom.val()
    if (!dom.length || dom.attr('disabled') || (item.optional && !value)) {
      continue
    }
    let result
    if (item.reg) {
      result = item.reg.test(value)
    } else if (item.minLength) {
      result = value.length >= item.minLength
      item.msg = '长度不可少于' + item.minLength + '位'
    } else {
      result = !!value
    }
    if (!result) {
      showToast(item.msg)
      dom.focus()
      return false
    }
  }
  return true
}

//ajax请求
function ajax(act, data, callback, option) {
  return $.ajax({
    type: 'POST',
    url: './api.php?act=' + act,
    data,
    beforeSend: () => {
      layer.load(2)
    },
    success: (result) => {
      layer.closeAll('loading')
      setTimeout(() => {
        if (result.code !== 200) {
          return showAlert(result.code, result.msg)
        }
        showToast(result.msg, () => {
          typeof callback === 'function' ? callback(result.data) : reload()
        }, {
          anim: 0
        })
      }, 250)
    },
    error: () => {
      layer.closeAll('loading')
      setTimeout(() => {
        showToast('系统错误，请检查网络或联系管理员')
      }, 250)
    },
    ...option
  })
}

//给小于10的数字前面加个0
function addZero(number) {
  return (number > 9 ? '' : '0') + number
}

// 格式化消息时间
function formatTime(timestamp) {
  if (timestamp.length === 10) {
    timestamp += '000'
  }
  const t = new Date(parseInt(timestamp)),
      Y = t.getFullYear(),
      M = addZero(t.getMonth() + 1),
      D = addZero(t.getDate()),
      H = addZero(t.getHours()),
      m = addZero(t.getMinutes()),
      s = addZero(t.getSeconds())
  return Y + '-' + M + '-' + D + ' ' + H + ':' + m + ':' + s
}

//iconHtml
function getIconHtml(inputId, nowClass, keyword) {
  const str = '[{"name":"Web Application Icons","icons":["fa fa-address-book","fa fa-address-book-o","fa fa-address-card","fa fa-address-card-o","fa fa-adjust","fa fa-american-sign-language-interpreting","fa fa-anchor","fa fa-archive","fa fa-area-chart","fa fa-arrows","fa fa-arrows-h","fa fa-arrows-v","fa fa-asl-interpreting","fa fa-assistive-listening-systems","fa fa-asterisk","fa fa-at","fa fa-audio-description","fa fa-automobile","fa fa-balance-scale","fa fa-ban","fa fa-bank","fa fa-bar-chart","fa fa-bar-chart-o","fa fa-barcode","fa fa-bars","fa fa-bath","fa fa-bathtub","fa fa-battery","fa fa-battery-0","fa fa-battery-1","fa fa-battery-2","fa fa-battery-3","fa fa-battery-4","fa fa-battery-empty","fa fa-battery-full","fa fa-battery-half","fa fa-battery-quarter","fa fa-battery-three-quarters","fa fa-bed","fa fa-beer","fa fa-bell","fa fa-bell-o","fa fa-bell-slash","fa fa-bell-slash-o","fa fa-bicycle","fa fa-binoculars","fa fa-birthday-cake","fa fa-blind","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-bolt","fa fa-bomb","fa fa-book","fa fa-bookmark","fa fa-bookmark-o","fa fa-braille","fa fa-briefcase","fa fa-bug","fa fa-building","fa fa-building-o","fa fa-bullhorn","fa fa-bullseye","fa fa-bus","fa fa-cab","fa fa-calculator","fa fa-calendar","fa fa-calendar-check-o","fa fa-calendar-minus-o","fa fa-calendar-o","fa fa-calendar-plus-o","fa fa-calendar-times-o","fa fa-camera","fa fa-camera-retro","fa fa-car","fa fa-caret-square-o-down","fa fa-caret-square-o-left","fa fa-caret-square-o-right","fa fa-caret-square-o-up","fa fa-cart-arrow-down","fa fa-cart-plus","fa fa-cc","fa fa-certificate","fa fa-check","fa fa-check-circle","fa fa-check-circle-o","fa fa-check-square","fa fa-check-square-o","fa fa-child","fa fa-circle","fa fa-circle-o","fa fa-circle-o-notch","fa fa-circle-thin","fa fa-clock-o","fa fa-clone","fa fa-close","fa fa-cloud","fa fa-cloud-download","fa fa-cloud-upload","fa fa-code","fa fa-code-fork","fa fa-coffee","fa fa-cog","fa fa-cogs","fa fa-comment","fa fa-comment-o","fa fa-commenting","fa fa-commenting-o","fa fa-comments","fa fa-comments-o","fa fa-compass","fa fa-copyright","fa fa-creative-commons","fa fa-credit-card","fa fa-credit-card-alt","fa fa-crop","fa fa-crosshairs","fa fa-cube","fa fa-cubes","fa fa-cutlery","fa fa-dashboard","fa fa-database","fa fa-deaf","fa fa-deafness","fa fa-desktop","fa fa-diamond","fa fa-dot-circle-o","fa fa-download","fa fa-drivers-license","fa fa-drivers-license-o","fa fa-edit","fa fa-ellipsis-h","fa fa-ellipsis-v","fa fa-envelope","fa fa-envelope-o","fa fa-envelope-open","fa fa-envelope-open-o","fa fa-envelope-square","fa fa-eraser","fa fa-exchange","fa fa-exclamation","fa fa-exclamation-circle","fa fa-exclamation-triangle","fa fa-external-link","fa fa-external-link-square","fa fa-eye","fa fa-eye-slash","fa fa-eyedropper","fa fa-fax","fa fa-feed","fa fa-female","fa fa-fighter-jet","fa fa-file-archive-o","fa fa-file-audio-o","fa fa-file-code-o","fa fa-file-excel-o","fa fa-file-image-o","fa fa-file-movie-o","fa fa-file-pdf-o","fa fa-file-photo-o","fa fa-file-picture-o","fa fa-file-powerpoint-o","fa fa-file-sound-o","fa fa-file-video-o","fa fa-file-word-o","fa fa-file-zip-o","fa fa-film","fa fa-filter","fa fa-fire","fa fa-fire-extinguisher","fa fa-flag","fa fa-flag-checkered","fa fa-flag-o","fa fa-flash","fa fa-flask","fa fa-folder","fa fa-folder-o","fa fa-folder-open","fa fa-folder-open-o","fa fa-frown-o","fa fa-futbol-o","fa fa-gamepad","fa fa-gavel","fa fa-gear","fa fa-gears","fa fa-gift","fa fa-glass","fa fa-globe","fa fa-graduation-cap","fa fa-group","fa fa-hand-grab-o","fa fa-hand-lizard-o","fa fa-hand-paper-o","fa fa-hand-peace-o","fa fa-hand-pointer-o","fa fa-hand-rock-o","fa fa-hand-scissors-o","fa fa-hand-spock-o","fa fa-hand-stop-o","fa fa-handshake-o","fa fa-hard-of-hearing","fa fa-hashtag","fa fa-hdd-o","fa fa-headphones","fa fa-heart","fa fa-heart-o","fa fa-heartbeat","fa fa-history","fa fa-home","fa fa-hotel","fa fa-hourglass","fa fa-hourglass-1","fa fa-hourglass-2","fa fa-hourglass-3","fa fa-hourglass-end","fa fa-hourglass-half","fa fa-hourglass-o","fa fa-hourglass-start","fa fa-i-cursor","fa fa-id-badge","fa fa-id-card","fa fa-id-card-o","fa fa-image","fa fa-inbox","fa fa-industry","fa fa-info","fa fa-info-circle","fa fa-institution","fa fa-key","fa fa-keyboard-o","fa fa-language","fa fa-laptop","fa fa-leaf","fa fa-legal","fa fa-lemon-o","fa fa-level-down","fa fa-level-up","fa fa-life-bouy","fa fa-life-buoy","fa fa-life-ring","fa fa-life-saver","fa fa-lightbulb-o","fa fa-line-chart","fa fa-location-arrow","fa fa-lock","fa fa-low-vision","fa fa-magic","fa fa-magnet","fa fa-mail-forward","fa fa-mail-reply","fa fa-mail-reply-all","fa fa-male","fa fa-map","fa fa-map-marker","fa fa-map-o","fa fa-map-pin","fa fa-map-signs","fa fa-meh-o","fa fa-microchip","fa fa-microphone","fa fa-microphone-slash","fa fa-minus","fa fa-minus-circle","fa fa-minus-square","fa fa-minus-square-o","fa fa-mobile","fa fa-mobile-phone","fa fa-money","fa fa-moon-o","fa fa-mortar-board","fa fa-motorcycle","fa fa-mouse-pointer","fa fa-music","fa fa-navicon","fa fa-newspaper-o","fa fa-object-group","fa fa-object-ungroup","fa fa-paint-brush","fa fa-paper-plane","fa fa-paper-plane-o","fa fa-paw","fa fa-pencil","fa fa-pencil-square","fa fa-pencil-square-o","fa fa-percent","fa fa-phone","fa fa-phone-square","fa fa-photo","fa fa-picture-o","fa fa-pie-chart","fa fa-plane","fa fa-plug","fa fa-plus","fa fa-plus-circle","fa fa-plus-square","fa fa-plus-square-o","fa fa-podcast","fa fa-power-off","fa fa-print","fa fa-puzzle-piece","fa fa-qrcode","fa fa-question","fa fa-question-circle","fa fa-question-circle-o","fa fa-quote-left","fa fa-quote-right","fa fa-random","fa fa-recycle","fa fa-refresh","fa fa-registered","fa fa-remove","fa fa-reorder","fa fa-reply","fa fa-reply-all","fa fa-retweet","fa fa-road","fa fa-rocket","fa fa-rss","fa fa-rss-square","fa fa-s15","fa fa-search","fa fa-search-minus","fa fa-search-plus","fa fa-send","fa fa-send-o","fa fa-server","fa fa-share","fa fa-share-alt","fa fa-share-alt-square","fa fa-share-square","fa fa-share-square-o","fa fa-shield","fa fa-ship","fa fa-shopping-bag","fa fa-shopping-basket","fa fa-shopping-cart","fa fa-shower","fa fa-sign-in","fa fa-sign-language","fa fa-sign-out","fa fa-signal","fa fa-signing","fa fa-sitemap","fa fa-sliders","fa fa-smile-o","fa fa-snowflake-o","fa fa-soccer-ball-o","fa fa-sort","fa fa-sort-alpha-asc","fa fa-sort-alpha-desc","fa fa-sort-amount-asc","fa fa-sort-amount-desc","fa fa-sort-asc","fa fa-sort-desc","fa fa-sort-down","fa fa-sort-numeric-asc","fa fa-sort-numeric-desc","fa fa-sort-up","fa fa-space-shuttle","fa fa-spinner","fa fa-spoon","fa fa-square","fa fa-square-o","fa fa-star","fa fa-star-half","fa fa-star-half-empty","fa fa-star-half-full","fa fa-star-half-o","fa fa-star-o","fa fa-sticky-note","fa fa-sticky-note-o","fa fa-street-view","fa fa-suitcase","fa fa-sun-o","fa fa-support","fa fa-tablet","fa fa-tachometer","fa fa-tag","fa fa-tags","fa fa-tasks","fa fa-taxi","fa fa-television","fa fa-terminal","fa fa-thermometer","fa fa-thermometer-0","fa fa-thermometer-1","fa fa-thermometer-2","fa fa-thermometer-3","fa fa-thermometer-4","fa fa-thermometer-empty","fa fa-thermometer-full","fa fa-thermometer-half","fa fa-thermometer-quarter","fa fa-thermometer-three-quarters","fa fa-thumb-tack","fa fa-thumbs-down","fa fa-thumbs-o-down","fa fa-thumbs-o-up","fa fa-thumbs-up","fa fa-ticket","fa fa-times","fa fa-times-circle","fa fa-times-circle-o","fa fa-times-rectangle","fa fa-times-rectangle-o","fa fa-tint","fa fa-toggle-down","fa fa-toggle-left","fa fa-toggle-off","fa fa-toggle-on","fa fa-toggle-right","fa fa-toggle-up","fa fa-trademark","fa fa-trash","fa fa-trash-o","fa fa-tree","fa fa-trophy","fa fa-truck","fa fa-tty","fa fa-tv","fa fa-umbrella","fa fa-universal-access","fa fa-university","fa fa-unlock","fa fa-unlock-alt","fa fa-unsorted","fa fa-upload","fa fa-user","fa fa-user-circle","fa fa-user-circle-o","fa fa-user-o","fa fa-user-plus","fa fa-user-secret","fa fa-user-times","fa fa-users","fa fa-vcard","fa fa-vcard-o","fa fa-video-camera","fa fa-volume-control-phone","fa fa-volume-down","fa fa-volume-off","fa fa-volume-up","fa fa-warning","fa fa-wheelchair","fa fa-wheelchair-alt","fa fa-wifi","fa fa-window-close","fa fa-window-close-o","fa fa-window-maximize","fa fa-window-minimize","fa fa-window-restore","fa fa-wrench"]},{"name":"Accessibility Icons","icons":["fa fa-american-sign-language-interpreting","fa fa-asl-interpreting","fa fa-assistive-listening-systems","fa fa-audio-description","fa fa-blind","fa fa-braille","fa fa-cc","fa fa-deaf","fa fa-deafness","fa fa-hard-of-hearing","fa fa-low-vision","fa fa-question-circle-o","fa fa-sign-language","fa fa-signing","fa fa-tty","fa fa-universal-access","fa fa-volume-control-phone","fa fa-wheelchair","fa fa-wheelchair-alt"]},{"name":"Hand Icons","icons":["fa fa-hand-grab-o","fa fa-hand-lizard-o","fa fa-hand-o-down","fa fa-hand-o-left","fa fa-hand-o-right","fa fa-hand-o-up","fa fa-hand-paper-o","fa fa-hand-peace-o","fa fa-hand-pointer-o","fa fa-hand-rock-o","fa fa-hand-scissors-o","fa fa-hand-spock-o","fa fa-hand-stop-o","fa fa-thumbs-down","fa fa-thumbs-o-down","fa fa-thumbs-o-up","fa fa-thumbs-up"]},{"name":"Transportation Icons","icons":["fa fa-ambulance","fa fa-automobile","fa fa-bicycle","fa fa-bus","fa fa-cab","fa fa-car","fa fa-fighter-jet","fa fa-motorcycle","fa fa-plane","fa fa-rocket","fa fa-ship","fa fa-space-shuttle","fa fa-subway","fa fa-taxi","fa fa-train","fa fa-truck","fa fa-wheelchair","fa fa-wheelchair-alt"]},{"name":"Gender Icons","icons":["fa fa-genderless","fa fa-intersex","fa fa-mars","fa fa-mars-double","fa fa-mars-stroke","fa fa-mars-stroke-h","fa fa-mars-stroke-v","fa fa-mercury","fa fa-neuter","fa fa-transgender","fa fa-transgender-alt","fa fa-venus","fa fa-venus-double","fa fa-venus-mars"]},{"name":"File Type Icons","icons":["fa fa-file","fa fa-file-archive-o","fa fa-file-audio-o","fa fa-file-code-o","fa fa-file-excel-o","fa fa-file-image-o","fa fa-file-movie-o","fa fa-file-o","fa fa-file-pdf-o","fa fa-file-photo-o","fa fa-file-picture-o","fa fa-file-powerpoint-o","fa fa-file-sound-o","fa fa-file-text","fa fa-file-text-o","fa fa-file-video-o","fa fa-file-word-o","fa fa-file-zip-o"]},{"name":"Spinner Icons","icons":["fa fa-circle-o-notch","fa fa-cog","fa fa-gear","fa fa-refresh","fa fa-spinner"]},{"name":"Form Control Icons","icons":["fa fa-check-square","fa fa-check-square-o","fa fa-circle","fa fa-circle-o","fa fa-dot-circle-o","fa fa-minus-square","fa fa-minus-square-o","fa fa-plus-square","fa fa-plus-square-o","fa fa-square","fa fa-square-o"]},{"name":"Payment Icons","icons":["fa fa-cc-amex","fa fa-cc-diners-club","fa fa-cc-discover","fa fa-cc-jcb","fa fa-cc-mastercard","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-cc-visa","fa fa-credit-card","fa fa-credit-card-alt","fa fa-google-wallet","fa fa-paypal"]},{"name":"Chart Icons","icons":["fa fa-area-chart","fa fa-bar-chart","fa fa-bar-chart-o","fa fa-line-chart","fa fa-pie-chart"]},{"name":"Currency Icons","icons":["fa fa-bitcoin","fa fa-btc","fa fa-cny","fa fa-dollar","fa fa-eur","fa fa-euro","fa fa-gbp","fa fa-gg","fa fa-gg-circle","fa fa-ils","fa fa-inr","fa fa-jpy","fa fa-krw","fa fa-money","fa fa-rmb","fa fa-rouble","fa fa-rub","fa fa-ruble","fa fa-rupee","fa fa-shekel","fa fa-sheqel","fa fa-try","fa fa-turkish-lira","fa fa-usd","fa fa-won","fa fa-yen"]},{"name":"Text Editor Icons","icons":["fa fa-align-center","fa fa-align-justify","fa fa-align-left","fa fa-align-right","fa fa-bold","fa fa-chain","fa fa-chain-broken","fa fa-clipboard","fa fa-columns","fa fa-copy","fa fa-cut","fa fa-dedent","fa fa-eraser","fa fa-file","fa fa-file-o","fa fa-file-text","fa fa-file-text-o","fa fa-files-o","fa fa-floppy-o","fa fa-font","fa fa-header","fa fa-indent","fa fa-italic","fa fa-link","fa fa-list","fa fa-list-alt","fa fa-list-ol","fa fa-list-ul","fa fa-outdent","fa fa-paperclip","fa fa-paragraph","fa fa-paste","fa fa-repeat","fa fa-rotate-left","fa fa-rotate-right","fa fa-save","fa fa-scissors","fa fa-strikethrough","fa fa-subscript","fa fa-superscript","fa fa-table","fa fa-text-height","fa fa-text-width","fa fa-th","fa fa-th-large","fa fa-th-list","fa fa-underline","fa fa-undo","fa fa-unlink"]},{"name":"Directional Icons","icons":["fa fa-angle-double-down","fa fa-angle-double-left","fa fa-angle-double-right","fa fa-angle-double-up","fa fa-angle-down","fa fa-angle-left","fa fa-angle-right","fa fa-angle-up","fa fa-arrow-circle-down","fa fa-arrow-circle-left","fa fa-arrow-circle-o-down","fa fa-arrow-circle-o-left","fa fa-arrow-circle-o-right","fa fa-arrow-circle-o-up","fa fa-arrow-circle-right","fa fa-arrow-circle-up","fa fa-arrow-down","fa fa-arrow-left","fa fa-arrow-right","fa fa-arrow-up","fa fa-arrows","fa fa-arrows-alt","fa fa-arrows-h","fa fa-arrows-v","fa fa-caret-down","fa fa-caret-left","fa fa-caret-right","fa fa-caret-square-o-down","fa fa-caret-square-o-left","fa fa-caret-square-o-right","fa fa-caret-square-o-up","fa fa-caret-up","fa fa-chevron-circle-down","fa fa-chevron-circle-left","fa fa-chevron-circle-right","fa fa-chevron-circle-up","fa fa-chevron-down","fa fa-chevron-left","fa fa-chevron-right","fa fa-chevron-up","fa fa-exchange","fa fa-hand-o-down","fa fa-hand-o-left","fa fa-hand-o-right","fa fa-hand-o-up","fa fa-long-arrow-down","fa fa-long-arrow-left","fa fa-long-arrow-right","fa fa-long-arrow-up","fa fa-toggle-down","fa fa-toggle-left","fa fa-toggle-right","fa fa-toggle-up"]},{"name":"Video Player Icons","icons":["fa fa-arrows-alt","fa fa-backward","fa fa-compress","fa fa-eject","fa fa-expand","fa fa-fast-backward","fa fa-fast-forward","fa fa-forward","fa fa-pause","fa fa-pause-circle","fa fa-pause-circle-o","fa fa-play","fa fa-play-circle","fa fa-play-circle-o","fa fa-random","fa fa-step-backward","fa fa-step-forward","fa fa-stop","fa fa-stop-circle","fa fa-stop-circle-o","fa fa-youtube-play"]},{"name":"Brand Icons","icons":["fa fa-500px","fa fa-adn","fa fa-amazon","fa fa-android","fa fa-angellist","fa fa-apple","fa fa-bandcamp","fa fa-behance","fa fa-behance-square","fa fa-bitbucket","fa fa-bitbucket-square","fa fa-bitcoin","fa fa-black-tie","fa fa-bluetooth","fa fa-bluetooth-b","fa fa-btc","fa fa-buysellads","fa fa-cc-amex","fa fa-cc-diners-club","fa fa-cc-discover","fa fa-cc-jcb","fa fa-cc-mastercard","fa fa-cc-paypal","fa fa-cc-stripe","fa fa-cc-visa","fa fa-chrome","fa fa-codepen","fa fa-codiepie","fa fa-connectdevelop","fa fa-contao","fa fa-css3","fa fa-dashcube","fa fa-delicious","fa fa-deviantart","fa fa-digg","fa fa-dribbble","fa fa-dropbox","fa fa-drupal","fa fa-edge","fa fa-eercast","fa fa-empire","fa fa-envira","fa fa-etsy","fa fa-expeditedssl","fa fa-fa","fa fa-facebook","fa fa-facebook-f","fa fa-facebook-official","fa fa-facebook-square","fa fa-firefox","fa fa-first-order","fa fa-flickr","fa fa-font-awesome","fa fa-fonticons","fa fa-fort-awesome","fa fa-forumbee","fa fa-foursquare","fa fa-free-code-camp","fa fa-ge","fa fa-get-pocket","fa fa-gg","fa fa-gg-circle","fa fa-git","fa fa-git-square","fa fa-github","fa fa-github-alt","fa fa-github-square","fa fa-gitlab","fa fa-gittip","fa fa-glide","fa fa-glide-g","fa fa-google","fa fa-google-plus","fa fa-google-plus-circle","fa fa-google-plus-official","fa fa-google-plus-square","fa fa-google-wallet","fa fa-gratipay","fa fa-grav","fa fa-hacker-news","fa fa-houzz","fa fa-html5","fa fa-imdb","fa fa-instagram","fa fa-internet-explorer","fa fa-ioxhost","fa fa-joomla","fa fa-jsfiddle","fa fa-lastfm","fa fa-lastfm-square","fa fa-leanpub","fa fa-linkedin","fa fa-linkedin-square","fa fa-linode","fa fa-linux","fa fa-maxcdn","fa fa-meanpath","fa fa-medium","fa fa-meetup","fa fa-mixcloud","fa fa-modx","fa fa-odnoklassniki","fa fa-odnoklassniki-square","fa fa-opencart","fa fa-openid","fa fa-opera","fa fa-optin-monster","fa fa-pagelines","fa fa-paypal","fa fa-pied-piper","fa fa-pied-piper-alt","fa fa-pied-piper-pp","fa fa-pinterest","fa fa-pinterest-p","fa fa-pinterest-square","fa fa-product-hunt","fa fa-qq","fa fa-quora","fa fa-ra","fa fa-ravelry","fa fa-rebel","fa fa-reddit","fa fa-reddit-alien","fa fa-reddit-square","fa fa-renren","fa fa-resistance","fa fa-safari","fa fa-scribd","fa fa-sellsy","fa fa-share-alt","fa fa-share-alt-square","fa fa-shirtsinbulk","fa fa-simplybuilt","fa fa-skyatlas","fa fa-skype","fa fa-slack","fa fa-slideshare","fa fa-snapchat","fa fa-snapchat-ghost","fa fa-snapchat-square","fa fa-soundcloud","fa fa-spotify","fa fa-stack-exchange","fa fa-stack-overflow","fa fa-steam","fa fa-steam-square","fa fa-stumbleupon","fa fa-stumbleupon-circle","fa fa-superpowers","fa fa-telegram","fa fa-tencent-weibo","fa fa-themeisle","fa fa-trello","fa fa-tripadvisor","fa fa-tumblr","fa fa-tumblr-square","fa fa-twitch","fa fa-twitter","fa fa-twitter-square","fa fa-usb","fa fa-viacoin","fa fa-viadeo","fa fa-viadeo-square","fa fa-vimeo","fa fa-vimeo-square","fa fa-vine","fa fa-vk","fa fa-wechat","fa fa-weibo","fa fa-weixin","fa fa-whatsapp","fa fa-wikipedia-w","fa fa-windows","fa fa-wordpress","fa fa-wpbeginner","fa fa-wpexplorer","fa fa-wpforms","fa fa-xing","fa fa-xing-square","fa fa-y-combinator","fa fa-y-combinator-square","fa fa-yahoo","fa fa-yc","fa fa-yc-square","fa fa-yelp","fa fa-yoast","fa fa-youtube","fa fa-youtube-play","fa fa-youtube-square"]},{"name":"Medical Icons","icons":["fa fa-ambulance","fa fa-h-square","fa fa-heart","fa fa-heart-o","fa fa-heartbeat","fa fa-hospital-o","fa fa-medkit","fa fa-plus-square","fa fa-stethoscope","fa fa-user-md","fa fa-wheelchair","fa fa-wheelchair-alt"]}]'
  const arr = JSON.parse(str)
  let html = '<div class="icon-box" oz-input-id="' + inputId + '">'
  for (const itemSort of arr) {
    let iconHtml = ''
    for (const item of itemSort.icons) {
      if (!keyword || item.indexOf(keyword) > -1) {
        iconHtml += '<li class="oz-tooltip oz-tooltip-up ' + (nowClass === item ? 'active' : '') + '" oz-title="' + item + '" oz-icon="' + item + '"><i class="' + item + '"></i></li>'
      }
    }
    if (iconHtml) {
      html += '<ul class="icon-list"><div class="icon-name">' + itemSort.name + '</div>' + iconHtml + '</ul>'
    }
  }
  html += '</div>'
  return html
}

//FA图标弹窗
function iconPopup(dom) {
  const windowWidth = $(document).width()
  const nowIcon = $(dom).children('i').attr('class').replace('oz-icon-show ', '')
  const inputId = $(dom).closest('.oz-form-group').find('.oz-icon-input').attr('id')
  const html = '<input class="icon-search" placeholder="输入关键词搜索..."><div id="icon-box">'
      + getIconHtml(inputId, nowIcon)
      + '</div>'
  showPopup('Font Awesome图标', html, {
    id: 'icon-popup',
    area: [windowWidth > 767 ? '60%' : '98%', '85%'],
    resize: true,
    maxmin: true,
    zIndex: layer.zIndex,
    success() {
      $(':focus').blur()
      resizeIconBox()
      $(window).resize(() => {
        resizeIconBox()
      })
    },
    full() {
      resizeIconBox()
    },
    restore() {
      resizeIconBox()
    },
    resizing() {
      resizeIconBox()
    }
  })
}

//重新设置FA图标列表div宽度
function resizeIconBox() {
  const iconBox = $('.icon-box')
  const boxWidth = iconBox.width()
  let num = Math.floor(boxWidth / 35)
  if (num % 2 === 0) {
    num -= 1
  }
  iconBox.children('.icon-list').width(num * 35 + 'px')
}

//FA图标预览
$(document).on('input propertychange', '.oz-icon-input', function () {
  const icon = $(this).val()
  $(this).closest('.oz-form-group').find('.oz-icon-show').removeClass().addClass('oz-icon-show ' + icon)
})

//搜索FA图标
$(document).on('input propertychange', '.icon-search', function () {
  const inputId = $(this).next('#icon-box').find('.icon-box').attr('oz-input-id')
  $('#icon-box').html(getIconHtml(inputId, '', $(this).val()))
  resizeIconBox()
})

//填入FA图标代码
$(document).on('click', '.icon-box .icon-list li', function () {
  $('.icon-box .icon-list li').removeClass('active')
  $(this).addClass('active')
  const inputId = $(this).closest('.icon-box').attr('oz-input-id')
  const icon = $(this).attr('oz-icon')
  $('#' + inputId).val(icon).closest('.oz-form-group').find('.oz-icon-show').removeClass().addClass('oz-icon-show ' + icon)
  layer.close(layer.index)
})

//ICO图标预览
$(document).on('input propertychange', '#info-ico', function () {
  $('#info-ico-show').attr('src', $(this).val())
})

//图片弹窗
function imgPopup(title, src) {
  showPopup(title, '<div id="img-popup" class="popup show"><img src="' + src + '" alt="' + title + '"></div>')
}

//文字弹窗
function textPopup(title, content) {
  showPopup(title, '<div class="popup show">' + content + '</div>')
}

//添加弹窗
function addPopup(title) {
  const siteInfoForm = $('#site-info')[0]
  if (siteInfoForm) {
    siteInfoForm.reset()
    $('#info-ico-show').attr('src', '')
  }
  showPopup(title, $('#add-popup'))
}

//修改弹窗
function editPopup(title, type, id) {
  const data = JSON.parse($('#data-' + id).text())
  switch (type) {
    case 'nav':
      $('#nav-id').val(data.id)
      $('#nav-serial').val(data.serial)
      $('#nav-icon').val(data.icon).closest('.oz-form-group').find('.oz-icon-show').removeClass().addClass('oz-icon-show ' + data.icon)
      $('#nav-name').val(data.name)
      if (data.type === '1') {
        $('#nav-url').attr('name', 'url').removeAttr('disabled').val(data.url)
      } else {
        $('#nav-url').removeAttr('name').attr('disabled', 'disabled').val('该导航链接由系统生成，不可修改')
      }
      $('#nav-newTab').val(data.newTab)
      $('#nav-state').val(data.state)
      break
    case 'user':
      $('#user-id').val(data.id)
      $('#user-role').val(data.role)
      $('#user-username').val(data.username)
      $('#user-qq').val(data.qq)
      $('#user-email').val(data.email)
      $('#user-intro').val(data.intro)
      if (data.role === '1') {
        $('#user-state').closest('.oz-form-group').hide()
      } else {
        $('#user-state').val(data.state).closest('.oz-form-group').show()
      }
      break
    case 'sort':
      $('#sort-id').val(data.id)
      $('#sort-serial').val(data.serial)
      $('#sort-icon').val(data.icon).closest('.oz-form-group').find('.oz-icon-show').removeClass().addClass('oz-icon-show ' + data.icon)
      $('#sort-name').val(data.name)
      $('#sort-alias').val(data.alias)
      $('#sort-state').val(data.state)
      break
    case 'site':
      $('#site-id').val(data.id)
      $('#site-serial').val(data.serial)
      const temp1 = data.url.split('//')
      $('#site-protocol').val(temp1[0] + '//')
      $('#site-domain').val(temp1[1])
      $('#site-name').val(data.name)
      $('#site-sortId').val(data.sortId)
      $('#site-qq').val(data.qq)
      $('#site-alias').val(data.alias)
      $('#site-top').val(data.top)
      $('#site-state').val(data.state)
      $('#info-ico').val(data.ico)
      $('#info-ico-show').attr('src', data.ico)
      $('#info-title').val(data.title)
      $('#info-keywords').val(data.keywords)
      $('#info-description').val(data.description)
      $('#info-icp').val(data.icp)
      break
    case 'apply':
      $('#id').val(data.id)
      const temp2 = data.url.split('//')
      $('#protocol').val(temp2[0] + '//')
      $('#domain').val(temp2[1])
      $('#name').val(data.name)
      $('#sortId').val(data.sortId)
      $('#qq').val(data.qq)
      break
    case 'notice':
      $('#notice-id').val(data.id)
      $('#notice-content').val(data.content)
      break
    case 'link':
      $('#link-id').val(data.id)
      $('#link-serial').val(data.serial)
      $('#link-name').val(data.name)
      $('#link-url').val(data.url)
      $('#link-newTab').val(data.newTab)
      $('#link-state').val(data.state)
      break
    case 'ad':
      $('#ad-id').val(data.id)
      $('#ad-page').val(data.page)
      $('#ad-title').val(data.title)
      $('#ad-picture').val(data.picture)
      $('#ad-url').val(data.url)
      $('#ad_state').val(data.state)
      break
  }
  showPopup(title, $('#edit-popup'), {
    shadeClose: false
  })
}

//站点信息弹窗
function infoPopup(title, isEdit) {
  const domainId = isEdit ? 'site-domain' : 'domain'
  if (checkInput([
    {
      id: domainId,
      msg: '请输入正确的域名',
      reg: urlReg,
    }
  ])) {
    const protocol = isEdit ? $('#site-protocol').val() : $('#protocol').val(),
        domain = $('#' + domainId).val(),
        index = showPopup(title, $('#info-popup'), {
          shadeClose: false,
          closeBtn: 0,
        })
    $('#getInfo-btn').attr('onclick', "getSiteInfo('" + protocol + domain + "')")
    $('#saveInfo-btn').attr('onclick', "closePopup('" + index + "')")
  }
}

//站点详情弹窗
function detailPopup(title, id) {
  const data = JSON.parse($('#data-' + id).text())
  $('#detail-ico').attr('src', data.ico)
  $('#detail-title').text(data.title)
  $('#detail-keywords').text(data.keywords)
  $('#detail-description').text(data.description)
  $('#detail-icp').text(data.icp)
  $('#detail-time').text(formatTime(data.time))
  $('#detail-dayView').text(data.dayView + '次')
  $('#detail-monthView').text(data.monthView + '次')
  $('#detail-totalView').text(data.totalView + '次')
  $('#detail-love').text(data.love + '次')
  showPopup(title, $('#detail-popup'))
}


//后台登录
function login() {
  if (checkInput([
    {
      id: 'username',
      msg: '请输入账号'
    }, {
      id: 'password',
      msg: '请输入密码'
    }
  ])) {
    ajax('user_login', $('#login').serialize(), () => {
      location.reload()
    })
  }
}

//退出登录
function logout() {
  showConfirm('是否确定退出登录', () => {
    ajax('user_logout', null, () => {
      location.reload()
    })
  })
}

//添加广告
function addAd() {
  if (checkInput([
    {
      id: 'page',
      msg: '请选择页面'
    }, {
      id: 'title',
      msg: '请输入标题'
    }, {
      id: 'picture',
      msg: '请输入正确的图片链接',
      reg: imgReg
    }, {
      id: 'url',
      msg: '请输入正确的链接',
      reg: urlReg
    }
  ])) {
    ajax('ad_add', $('#ad-add').serialize())
  }
}

//修改友链信息
function editAd() {
  if (checkInput([
    {
      id: 'ad-page',
      msg: '请选择页面'
    }, {
      id: 'ad-title',
      msg: '请输入标题'
    }, {
      id: 'ad-picture',
      msg: '请输入正确的图片链接',
      reg: imgReg
    }, {
      id: 'ad-url',
      msg: '请输入正确的链接',
      reg: urlReg
    }
  ])) {
    ajax('ad_edit', $('#ad-edit').serialize())
  }
}

//添加导航
function addNav(type) {
  const data = $('#nav-add-' + type).serialize()
  if (type === 1) {
    if (!checkInput([
      {
        id: 'serial',
        msg: '请输入正确的序号',
        reg: numberReg
      }, {
        id: 'icon',
        msg: '请输入图标'
      }, {
        id: 'name',
        msg: '请输入名称'
      }, {
        id: 'url',
        msg: '请输入正确的链接',
        reg: urlReg
      }
    ])) {
      return
    }
  } else if (type === 2) {
    if (data.indexOf('sortId') < 0) {
      return showToast('请选择分类')
    }
  } else if (type === 3) {
    if (data.indexOf('pageId') < 0) {
      return showToast('请选择单页')
    }
  } else {
    return showToast('类型错误')
  }
  ajax('nav_add', data + '&type=' + type)
}

//修改导航信息
function editNav() {
  if (checkInput([
    {
      id: 'nav-serial',
      msg: '请输入正确的序号',
      reg: numberReg
    }, {
      id: 'nav-icon',
      msg: '请输入图标'
    }, {
      id: 'nav-name',
      msg: '请输入名称'
    }, {
      id: 'nav-url',
      msg: '请输入正确的链接',
      reg: urlReg
    }
  ])) {
    ajax('nav_edit', $('#nav-edit').serialize())
  }
}

//添加用户
function addUser() {
  if (checkInput([
    {
      id: 'username',
      msg: '请输入用户名',
      minLength: 6
    }, {
      id: 'password',
      msg: '请输入密码',
      minLength: 8
    }, {
      id: 'qq',
      msg: '请输入正确的QQ号',
      reg: qqReg,
      optional: true
    }, {
      id: 'email',
      msg: '请输入正确的邮箱',
      reg: emailReg
    }
  ])) {
    ajax('user_add', $('#user-add').serialize())
  }
}

//修改用户信息
function editUser() {
  if (checkInput([
    {
      id: 'user-username',
      msg: '请输入用户名',
      minLength: 6
    }, {
      id: 'user-password',
      msg: '请输入密码',
      minLength: 8,
      optional: true
    }, {
      id: 'user-qq',
      msg: '请输入正确的QQ号',
      reg: qqReg,
      optional: true
    }, {
      id: 'user-email',
      msg: '请输入正确的邮箱',
      reg: emailReg
    }
  ])) {
    ajax('user_edit', $('#user-edit').serialize(), () => {
      $('#user-role').val() === '1' ? location.reload() : reload()
    })
  }
}

//添加分类
function addSort(type) {
  if (checkInput([
    {
      id: 'serial',
      msg: '请输入正确的序号',
      reg: numberReg
    }, {
      id: 'icon',
      msg: '请输入图标'
    }, {
      id: 'name',
      msg: '请输入名称'
    }, {
      id: 'alias',
      msg: '请输入正确的别名',
      reg: aliasReg,
      optional: true
    }
  ])) {
    ajax('sort_add', $('#sort-add').serialize() + '&type=' + type)
  }
}

//修改分类信息
function editSort() {
  if (checkInput([
    {
      id: 'sort-serial',
      msg: '请输入正确的序号',
      reg: numberReg
    }, {
      id: 'sort-icon',
      msg: '请输入图标'
    }, {
      id: 'sort-name',
      msg: '请输入名称'
    }, {
      id: 'sort-alias',
      msg: '请输入正确的别名',
      reg: aliasReg,
      optional: true
    }
  ])) {
    ajax('sort_edit', $('#sort-edit').serialize())
  }
}

//添加站点
function addSite() {
  if (checkInput([
    {
      id: 'serial',
      msg: '请输入正确的序号',
      reg: numberReg,
      optional: true
    }, {
      id: 'domain',
      msg: '请输入正确的域名',
      reg: urlReg,
    }, {
      id: 'name',
      msg: '请输入名称'
    }, {
      id: 'sortId',
      msg: '请选择分类'
    }, {
      id: 'qq',
      msg: '请输入正确的QQ号',
      reg: qqReg,
      optional: true
    }, {
      id: 'alias',
      msg: '请输入正确的别名',
      reg: aliasReg,
      optional: true
    }
  ])) {
    ajax('site_add', $('#site-add').serialize() + '&' + $('#site-info').serialize())
  }
}

//修改站点信息
function editSite() {
  if (checkInput([
    {
      id: 'site-serial',
      msg: '请输入正确的序号',
      reg: numberReg,
      optional: true
    }, {
      id: 'site-domain',
      msg: '请输入正确的域名',
      reg: urlReg,
    }, {
      id: 'site-name',
      msg: '请输入名称'
    }, {
      id: 'site-sortId',
      msg: '请选择分类'
    }, {
      id: 'site-qq',
      msg: '请输入正确的QQ号',
      reg: qqReg,
      optional: true
    }, {
      id: 'site-alias',
      msg: '请输入正确的别名',
      reg: aliasReg,
      optional: true
    }
  ])) {
    ajax('site_edit', $('#site-edit').serialize() + '&' + $('#site-info').serialize())
  }
}

//抓取站点信息
function getSiteInfo(url) {
  if (!url) {
    return showToast('请先输入域名')
  }
  ajax(null, {url}, null, {
    url: '../include/api.php?act=site_info',
    success: (result) => {
      layer.closeAll('loading')
      setTimeout(() => {
        if (result.code !== 200) {
          result.data = {title: '', keywords: '', description: '', icp: '', ico: ''}
        }
        const data = result.data
        $('#info-ico').val(data.ico)
        $('#info-ico-show').attr('src', data.ico)
        $('#info-title').val(data.title)
        $('#info-keywords').val(data.keywords)
        $('#info-description').val(data.description)
        $('#info-icp').val(data.icp)
        showToast(result.msg, null, {
          anim: result.code !== 200 ? 6 : 0
        })
      }, 250)
    }
  })
}

//更新所有站点信息
function updateAllSite() {
  showConfirm('是否确定更新所有站点的信息？<br>包括icp备案号、标题、关键词、描述、ico图标(如果开启了ico本地化)<br><strong>将会耗时较久，请勿刷新本页。如果遇到卡死请关闭此页！</strong>', () => {
    layer.closeAll('dialog')
    layer.load(2)
    ajax('site_all', null, null, {
      success: (result) => {
        layer.closeAll('loading')
        if (result.code !== 200) {
          return showAlert(result.code, result.msg)
        }
        layer.load(2)
        const data = result.data
        for (let item of data) {
          ajax(null, {id: item.id, url: item.url}, null, {
            url: '../include/api.php?act=site_update',
            async: false,
            success: (result) => {
              if (result.code !== 200) {
                return showToast('[' + item.name + ']更新失败，' + result.msg, null, {
                  offset: 'b'
                })
              }
              showToast('[' + item.name + ']更新成功', null, {
                anim: 0,
                offset: 'b'
              })
            }
          })
        }
        layer.closeAll('loading')
        setTimeout(() => {
          showToast(data.length + '个站点全部更新完成', () => {
            reload()
          }, {
            anim: 0
          })
        }, 250)
      }
    })
  })
}

//发布文章/单页
function addPost(state, isPage) {
  $('#tContent').html(tinyMCE.editors['tContent'].getContent())
  if (checkInput([
    {
      id: 'title',
      msg: '请输入标题'
    }, {
      id: 'sortId',
      msg: '请选择分类',
      optional: isPage
    }, {
      id: 'alias',
      msg: '请输入正确的别名',
      reg: aliasReg,
      optional: true
    }
  ])) {
    ajax('post_add', $('#post-add').serialize() + '&state=' + state + '&isPage=' + (isPage ? 1 : 0), () => {
      location.href = isPage ? 'page.php' : 'post.php'
    })
  }
}

//修改文章内容
function editPost(state, isPage) {
  $('#tContent').html(tinyMCE.editors['tContent'].getContent())
  if (checkInput([
    {
      id: 'title',
      msg: '请输入标题'
    }, {
      id: 'sortId',
      msg: '请选择分类',
      optional: isPage
    }, {
      id: 'alias',
      msg: '请输入正确的别名',
      reg: aliasReg,
      optional: true
    }
  ])) {
    ajax('post_edit', $('#post-edit').serialize() + '&state=' + state + '&isPage=' + (isPage ? 1 : 0), () => {
      location.href = isPage ? 'page.php' : 'post.php'
    })
  }
}

//添加友链
function addLink() {
  if (checkInput([
    {
      id: 'serial',
      msg: '请输入正确的序号',
      reg: numberReg
    }, {
      id: 'name',
      msg: '请输入名称'
    }, {
      id: 'url',
      msg: '请输入正确的链接',
      reg: urlReg
    }
  ])) {
    ajax('link_add', $('#link-add').serialize())
  }
}

//修改友链信息
function editLink() {
  if (checkInput([
    {
      id: 'link-serial',
      msg: '请输入正确的序号',
      reg: numberReg
    }, {
      id: 'link-name',
      msg: '请输入名称'
    }, {
      id: 'link-url',
      msg: '请输入正确的链接',
      reg: urlReg
    }
  ])) {
    ajax('link_edit', $('#link-edit').serialize())
  }
}

//通过申请
function passApply(id) {
  const data = id ? 'id=' + id : $('#batch').serialize()
  if (data.indexOf('id') < 0) {
    return showToast('请选择选项')
  }
  ajax('apply_pass', data)
}

//发布公告
function addNotice() {
  if (checkInput([
    {
      id: 'content',
      msg: '请输入内容'
    }
  ])) {
    ajax('notice_add', $('#notice-add').serialize())
  }
}

//修改公告内容
function editNotice() {
  if (checkInput([
    {
      id: 'notice-content',
      msg: '请输入内容'
    }
  ])) {
    ajax('notice_edit', $('#notice-edit').serialize())
  }
}

//修改系统配置
function editConfig() {
  if (checkInput([
    {
      id: 'time',
      msg: '请输入建站时间',
    }, {
      id: 'number',
      msg: '请输入正确的数字',
      reg: numberReg,
      optional: true
    }, {
      id: 'sitePaging',
      msg: '请输入正确的数字',
      reg: numberReg,
      optional: true
    }, {
      id: 'postPaging',
      msg: '请输入正确的数字',
      reg: numberReg,
      optional: true
    }, {
      id: 'viewNum',
      msg: '请输入正确的数字',
      reg: numberReg,
      optional: true
    }
  ])) {
    let data = $('#config-edit').serialize()
    if ($('#time').length > 0) {
      data += '&time=' + new Date($('#time').val()).getTime() / 1000
    }
    ajax('config_edit', data)
  }
}

//移动站点/文章分类
function moveSort(type) {
  const data = $('#batch').serialize()
  if (!checkInput([
    {
      id: 'move-sortId',
      msg: '请选择分类'
    }
  ])) {
    return
  }
  if (data.indexOf('id') < 0) {
    return showToast('请选择选项')
  }
  showConfirm('是否确定移动到此分类？', () => {
    ajax(type + '_move', data)
  })
}

//修改单个字段
function modifyOne(type, id, key, value) {
  ajax(type + '_modify', {id, key, value})
}

//批量修改
function batchModify(type, key, value) {
  const data = $('#batch').serialize()
  if (data.indexOf('id') < 0) {
    return showToast('请选择选项')
  }
  showConfirm('是否确定执行该操作？', () => {
    ajax(type + '_modify', data + '&key=' + key + '&value=' + value)
  })
}

//删除单条记录
function deleteOne(type, id) {
  const typeTable = {
    ad: '广告',
    nav: '导航',
    user: '用户',
    sort: '分类',
    site: '站点',
    post: '文章',
    page: '单页',
    link: '友链',
    apply: '申请',
    notice: '公告',
    template: '模板',
    data: '数据备份',
    source: '源码备份'
  }
  let msg = '是否确定删除该' + typeTable[type] + '?'
  if (type === 'sort') {
    msg += '<br><strong>将会删除该分类下所有站点或文章！！！</strong>'
  } else if (type === 'data') {
    msg += '<br><strong>删除之后不可恢复，请做好备份工作！！！</strong>'
  } else if (type === 'page') {
    type = 'post'
  }
  showConfirm(msg, () => {
    ajax(type + '_delete', {id})
  })
}

//批量删除
function batchDelete(type) {
  const data = $('#batch').serialize()
  if (data.indexOf('id') < 0) {
    return showToast('请选择选项')
  }
  let tip = ''
  if (type === 'sort') {
    tip = '<br><strong>将会删除该分类下所有站点或文章！！！</strong>'
  } else if (type === 'data') {
    tip = '<br><strong>删除之后不可恢复，请做好备份工作！！！</strong>'
  }
  showConfirm('是否确定删除选中？' + tip, () => {
    ajax(type + '_delete', data)
  })
}


//推送链接
function pushUrl(target, url, type, id) {
  ajax('push_' + target, {url, type, id})
}

//推送全部站点/文章
/*function pushAll(target, type) {
  showConfirm('是否确定推送所有？', () => {
    ajax(type + '_all', null, null, {
      success: (result) => {
        layer.closeAll('loading')
        if (result.code !== 200) {
          return showAlert(result.code, result.msg)
        }
        layer.load(2)
        const data = result.data
        let urls = []
        for (let item of data) {
          urls.push(type === 'site' ? item.detail : item.url)
        }
        pushUrl(target, urls, type)
      }
    })
  })
}*/

//批量推送
function batchPush(target) {
  if (checkInput([{
    id: 'url',
    msg: '请输入要推送的链接'
  }])) {
    showConfirm('是否确定批量推送？', () => {
      const urls = $('#url').val().split('\n')
      pushUrl(target, urls)
    })
  }
}

//更换模板
function changeTemplate(template) {
  showConfirm('是否确定使用该模板？', () => {
    ajax('template_change', {template})
  })
}

//选择文件获取文件名
function selectFile(dom, type) {
  let check
  const file = $(dom).children('input[type="file"]')[0]
  const nameText = $(dom).next('.file-name')
  const fileName = file.files[0].name
  if (type === 'img') {
    check = imgReg.test(fileName)
  } else if (type === 'sql') {
    check = sqlReg.test(fileName)
  } else if (type === 'zip') {
    check = zipReg.test(fileName)
  }
  if (!check) {
    file.value = ''
    nameText.html('请选择文件')
    return showToast('文件类型不支持')
  }
  nameText.html(fileName)
}

//上传文件
function uploadFile(type) {
  let act
  const formData = new FormData()
  const file = $('#' + type)[0].files[0]
  if (!file) {
    return showToast('请选择要上传的文件')
  }
  formData.append(type, file)
  if (type === 'template') {
    act = 'template_upload'
  } else if (type === 'data') {
    act = 'data_import'
  } else {
    act = 'image_' + type
  }
  ajax(act, formData, null, {
    cache: false,
    processData: false,
    contentType: false
  })
}

//刷新在线商店数据
function refreshStore() {
  ajax('template_refresh', null, () => {
    reload(() => {
      lazyRender()
    })
  })
}

//下载模板并安装
function downTemplate(url) {
  showConfirm('是否确定安装该模板？<br><strong>如果已有该模板则将覆盖，请做好备份工作！！！</strong>', () => {
    ajax('template_download', {url}, () => {
      showConfirm('是否更换为新安装的模板？', () => {
        location.href = './template.php'
      })
    })
  })
}

//发送邮件
function sendEmail() {
  if (checkInput([
    {
      id: 'email',
      msg: '请输入收信邮箱'
    }, {
      id: 'subject',
      msg: '请输入邮件主题',
    }, {
      id: 'body',
      msg: '请输入邮件内容'
    }
  ])) {
    showConfirm('是否确定发送邮件？', () => {
      ajax('email_send', $('#email-send').serialize(), () => {
      })
    })
  }
}

//清除缓存
function clearCache(type) {
  showConfirm('是否确定清理？<br><strong>清理后不可恢复！！！</strong>', () => {
    ajax('clear_' + type)
  })
}
