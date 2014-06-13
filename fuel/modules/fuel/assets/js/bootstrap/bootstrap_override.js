function getQuerystring(key, default_) {
    if (default_ == null)
        default_ = "";
    key = key.replace(/[\[]/, "\\\[").replace(/[\]]/, "\\\]");
    var regex = new RegExp("[\\?&]" + key + "=([^&#]*)");
    var qs = regex.exec(window.location.href);
    if (qs == null)
        return default_;
    else
        return qs[1];
}

function showonlyonev2(thechosenone) {
    var newboxes = document.getElementsByTagName("div");
    for (var x = 0; x < newboxes.length; x++) {
        name = newboxes[x].getAttribute("name");
        if (name == 'newboxes-2') {
            if (newboxes[x].id == thechosenone) {
                if (newboxes[x].style.display == 'block') {
                    newboxes[x].style.display = 'none';
                } else {
                    newboxes[x].style.display = 'block';
                }
            } else {
                newboxes[x].style.display = 'none';
            }
        }
    }
}

function sidebarHide(object) {
    var status = document.getElementById(object).style.display;
    if (status == "inline") {
        status = "none";
    } else {
        status = "inline";
    }
}

function changebg() {
    //document.getElementById('Sidebg').style.backgroundImage = "url(<?php echo img_path('newimages/top2_bg.jpg'); ?>)";
    //document.getElementById('Sidebg').style.backgroundRepeat = "no-repeat";
    //console.log("ChangeBg", this);
    $("#Sidebg,#sidebg").css("background-image", "url('/hilo/modules/fuel/assets/images/newimages/top2_bg.jpg')");
    try {
        document.getElementById('vewscroller').fleXcroll.scrollContent(false, -600);
    } catch(e) {
        console.log("FlexScroll fail", e);
    }
}

function changebg1() {
    //document.getElementById('Sidebg').style.backgroundImage = "url(<?php echo img_path('newimages/top1_bg.jpg'); ?>)";
    //document.getElementById('Sidebg').style.backgroundRepeat = "no-repeat";
    //console.log("ChangeBg-1", this);
    $("#Sidebg,#sidebg").css("background-image", "url('/hilo/modules/fuel/assets/images/newimages/top1_bg.jpg')");
    try {
        document.getElementById('vewscroller').fleXcroll.scrollContent(false, -600);
    } catch(e) {
        console.log("FlexScroll fail", e);
    }
}

function adjustParentHeight(element) {
    // Increase parent height, if required
    var $element = $(element);
    if ($element.height() > $element.parent().height())
        $element.parent().height($element.height());
}


$(document).ready(function() {
    $("#toggleSidePanel").on("click mouseenter", function() {
        //Toggle the side-panel
        var $sidePanel = $(".left-td-bg");
        //The sidePanel
        if ($sidePanel.is(":visible")) {
            $sidePanel.fadeOut("fast", function() {
                $("#toggleSidePanel").text("+");
                $("#mainPanelDisplay").attr("class", "span12").css("width", "100%");
            });
        } else {
            $("#mainPanelDisplay").attr("class", "span10").css("width", $("#fuel_body").width() - $sidePanel.outerWidth(true));
            $sidePanel.fadeIn("fast", function() {
                $("#toggleSidePanel").text("-");
            });
        }
    });
    $(window).on("resize orientationchange", function() {
        var $sidePanel = $(".left-td-bg");
        //The sidePanel
        var $mainPanelDisplay = $("#mainPanelDisplay");
        $mainPanelDisplay.css("width", $("#fuel_body").width() - $sidePanel.outerWidth(true));
        if ($(window).width() < 1335) {
            //Auto hide side-bar if width is low
            if ($sidePanel.is(":visible")) {
                $sidePanel.fadeOut("fast", function() {
                    $("#toggleSidePanel").text("+");
                    $mainPanelDisplay.attr("class", "span12");
                    $mainPanelDisplay.css("width", "100%");
                });
            }
        } else {
            //Auto-show when greater
            if (!$sidePanel.is(":visible")) {
                $mainPanelDisplay.attr("class", "span10");
                $sidePanel.fadeIn("fast", function() {
                    $("#toggleSidePanel").text("-");
                });
            }
        }
        if (!$sidePanel.is(":visible")) {
            $mainPanelDisplay.css("width", "100%");
        }
        adjustParentHeight("#filters");
        adjustParentHeight("#actions");
    });
    $(window).trigger("resize");
    $("#toggleSidePanel").trigger("click");

    // var removeEmpty = (function() {
    // //Hide unused divs
    // var $this = $(this);
    // while ($this.is(":empty") || ($this.children().length > 0 && !$this.children().is(":visible"))) {
    // //Remove this and it's empty-parents
    // $this.hide();
    // $this = $this.parent();
    // }
    // });
    // $("#action div, #action ul").each(removeEmpty);

    $("select").chosen();
    /*window.applyDDSlick = function() {
     $this = $(this);
     $this.ddslick({
     width : $this.width(),
     onChanged : function(pluginData) {
     //Update the select field, trigger change and re-create DDSlick
     console.log(this, arguments, $(pluginData.original));
     //$(pluginData.original).trigger("change");
     $(pluginData.selectedItem).closest('.dd-container').ddslick('destroy');
     $(pluginData.original).trigger("change click").each(applyDDSlick);
     }
     });
     //Apply the name attribute to the hidden element for form submissions
     $this.siblings('.dd-container').find('input[type=hidden]').attr("name", $this.attr("name"));
     };
     $("select").each(applyDDSlick);*/
    $("#topMenu").tinyNav();

    /*var fix_bad_div_table = (function(){
    //Hack to bring table-data into the table; Ideally should be done in the back-end
    var $data_rows = $('#data_table_container').children().filter('div');
    if($data_rows.length<=2){
    //If it hasn't already been un-wrapped
    $($data_rows[1]).children().unwrap();
    //Add data-labels
    var rows = $('#data_table_container').children().filter('div');
    var $first=$(rows[0]).children();
    //console.log(rows);
    for(var i=1;i<rows.length;i++){
    var row = $(rows[i]).children();
    for(var j=0;j<row.length;j++){
    //console.log("Row", row, "data",row[j]);
    $(row[j]).attr("data-label", $($first[j]).text());
    }
    }
    }
    });
    setTimeout(fix_bad_div_table, 0);
    setTimeout(fix_bad_div_table, 1000);
    setTimeout(fix_bad_div_table, 3000);
    setTimeout(fix_bad_div_table, 5000);*/

    //Hacky fix for the browers poor updation of table-cell
    $("table").find(".span4").css("display", "block");
    setTimeout(function() {
        $("table").find(".span4").css("display", "table-cell");
    }, 500);

    //Create minimize button
    $(".jdash-head").each(function() {
        var $this = $(this);
        $this.append("<button class='jdash-minimize' style='float:right;margin:3px;'>-</button>");
    });

    //Allow hiding of jDash items
    $('.jdash-minimize').on("click tap", function() {
        var $this = $(this);
        var body = $this.closest(".jdash-item").find(".jdash-body");
        if (body.is(":visible")) {
            body.fadeOut();
            $this.text("+");
        } else {
            body.fadeIn();
            $this.text("-");
        }
    });

    $("#vewscroller").css("overflow-x", "hidden");
    setTimeout('$("#vewscroller").css("overflow-x","hidden");', 1500);

});

/* Drop-down fix for iOS: As a side-effect, this may prevent drop-downs from closing on blur */
/*$('a.dropdown-toggle, .dropdown-menu a').on('touchstart', function(e) {
 e.stopPropagation();
 }); //Not working?
 $('body').on('touchstart.dropdown', '.dropdown-menu', function(e) {
 e.stopPropagation();
 });
 //Fixed in bootstrap.min.js
 */
function preventDefault(e) {
    // Trying all the various prevent-Default mechanisms
    if (e.preventDefault) {
        e.preventDefault();
    }
    if (e.stopImmediatePropagation) {
        e.stopImmediatePropagation();
    }
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    if (e.stop) {
        e.stop();
    }
    e.returnValue = false;
    return false;
}

/* modal-custom */
$(document).on("click.modal_custom", ".modal-custom", function(e) {
    //Hide Chart on clicking the overlay
    $(this).fadeOut();
}).on("click.modal_custom", ".modal-custom .close, .modal-custom [data-dismiss='modal-custom']", function(e) {
    //Setup close button
    $(this).closest(".modal-custom").fadeOut();
}).on("click.modal_custom", ".modal-custom .content", function(e) {
    //Prevent hiding if click was on the content
    return preventDefault(e);
}).on("click.modal_custom", "[data-toggle='modal-custom']", function(e) {
    //Trigger the modal-custom
    $($(this).attr("href")).fadeIn("normal", function() {
        //Trigger resize to correct chart display
        $(window).trigger("resize");
    });
    return preventDefault(e);
});
$(document).ready(function() {
    $(".modal-custom").css("display", "table").hide();
});

function beautifySelect(i, e) {
    // Bootstrap-ize selects
    e = e || this;
    i = parseInt(Math.random() * 1000000, 10);
    if (!($(e).data('convert') == 'no')) {
        $(e).hide().wrap('<div class="btn-group" id="select-group-' + i + '" style="display:inline-block" />');
        var select = $('#select-group-' + i);
        var current = $(e).val() || $(e).find('option').first().text() || "&nbsp;";
        select.html('<input type="hidden" value="' + $(e).val() + '" name="' + $(e).attr('name') + '" id="' + $(e).attr('id') + '" class="' + $(e).attr('class') + '" /><span class="btn btn-inverse dropdown-toggle" data-toggle="dropdown" href="javascript:;" style="border-radius: 4px; -webkit-border-radius: 4px; -moz-border-radius: 4px;"><span class="text">' + current + '</span> <span class="caret"></span></span><ul class="dropdown-menu" style="list-style:none; margin:0px; padding: 2px;"></ul>');
        $(e).find('option').each(function(o, q) {
            select.find('.dropdown-menu').append('<li><a href="javascript:;" data-value="' + $(q).attr('value') + '">' + $(q).text() + '</a></li>');
            if ($(q).attr('selected'))
                select.find('.dropdown-menu li:eq(' + o + ')').click();
        });
        select.find('.dropdown-menu a').click(function() {
            select.find('input[type=hidden]').val($(this).data('value')).change();
            select.find('.btn:eq(0)').find(".text").text($(this).text());
        });
    }
};

$(window).load(function() {
    // Functions for beautifying the jTable modal select & other things
    $(".jtable-dropdown-input").find("select").chosen();
    $("body").on("click", ".jtable-add-record > a", function() {
        setTimeout(function() {
            $(".jtable-dropdown-input").find("select").filter(":visible").chosen();
            $(".ui-dialog-buttonset").find("button").each(function() {
                var $this = $(this), text = $this.attr("text");
                if (!$this.text() && text) {
                    $this.html('<span class="ui-button-text">' + text + '</span>')
                }
            });
        }, 700);
    });
});
