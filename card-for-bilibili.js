!function () {
    if (jQuery) { $ = jQuery; }
    let reg = /(http[s]*\/\/)*[www\.]*bilibili\.com\/video\/av([0-9]+).*?/;
    window.CFB_TranformBilbiliLinks = function () {
        $("a").each(function (i, el) {
            let url = $(el).attr("href") || '';
            if (!reg.test(url)) { return; }
            let id = reg.exec(url)[2];
            $.ajax({
                url: "/bilibili/av" + id,
                success: function (data) {
                    if (data.code != 200) { return; }
                    $(el).html("<div class='bilibili-card'><img class='thumbnail' alt='" + data.name + "' referrerpolicy='no-referrer'/><div class='card-information'><h3 title='" + data.name + "' class='card-title'>" + data.name + "</h3><span class='card-uploader'>" + data.uploader + "</span><div class='card-description'>" + data.description.replace(/\n/g, "<br/>") + "</div></div></div>");
                    $(el).find("img.thumbnail")[0].src = data.thumbnail;
                },
                dataType: "json"
            });
            $("a").trigger("cfb-transformed");
        });
    }
    $(function () {
        CFB_TranformBilbiliLinks();
    });
}();