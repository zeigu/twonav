function lxqq(qq) {
    if (qq) {
        if (qq === "---") {
            layer.open({
                type: 0,
                shadeClose: true,
                skin: 'atuikeLayerSkin1',
                content: '该作者由于违反本站管理规范，已被管理员封禁账号。无法联系',
                btn: ['我知道了']
            });
            return;
        }

        layer.open({
            type: 0,
            shadeClose: true,
            skin: 'atuikeLayerSkin1',
            content: '<center><font size="4px" color="red">友联申请条件</font></center><br>1、百度权重≥0，索引量≥100，日流量200IP以上<br>2、正规网站，不违反法律法规的<br>3、已将总裁(dh.peakmzf.cn)添加友链的<br>4、不能是新网站，网站内容也不能不完善',
            btn: ['联系申请', '暂不申请'],
            yes: function () {
                window.open("http://wpa.qq.com/msgrd?v=3&uin=" + qq + "&site=qq&menu=yes", "_blank");
                layer.closeAll();
            }
        });

    } else {
        layer.open({
            type: 0,
            shadeClose: true,
            skin: 'atuikeLayerSkin1',
            content: '该管理员没有填写QQ联系方式，无法联系~',
            btn: ['我知道了']
        });
    }
}