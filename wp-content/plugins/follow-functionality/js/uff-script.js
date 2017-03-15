/**
 * This is the infinite scroll functionality
 */
function scroll_ajax_post(obj) {

    $.post(ajax_object.ajax_url,
            {
                action: obj.action,
                follow_nonce: obj.nonce,
                start: obj.start,
                length: obj.length,
                down: obj.direction
            }, null, "json")
            .done(function (response) {
                if (Array.isArray(response.data.followers)) {

                    var index_id;
                    response.data.followers.forEach(function (element, index) {
                        if (obj.direction) {
                            index_id = parseInt(obj.start) + index;
                            $("#streamer-profile-draft")
                                    .clone()
                                    .attr("id", index_id)
                                    .css("display", "block")
                                    .appendTo("#modal-body");

                        } else {
                            index_id = parseInt(obj.start) - index - 1;
                            $("#streamer-profile-draft")
                                    .clone()
                                    .attr("id", index_id)
                                    .css("display", "block")
                                    .prependTo("#modal-body");
                        }



                        $("#" + index_id).find(".streamer-nicename").text(element['user_nicename']);
                        $("#" + index_id).find(".streamer-email").text(element['user_email']);
                    });

                    if (obj.reduce) {
                        obj.reduce(20, 10, obj, "#modal-body .streamer-profile");
                    }
                }

            })
            .fail(function () {
                alert("error");
            })
}

function reduce(list_length_max, list_reduction, obj, selector) {
    var length = $(selector).length;
    if (length > list_length_max) {
        var i = 0;
        while (i < list_reduction) {
            obj.direction ? $(selector).first().remove() : $(selector).last().remove();
            i++;
        }
    }
    obj.ajaxDown = true;
    obj.ajaxUp = true;

}

jQuery(function ($) {
    
    $("#follow-me").on('click', function (e) {

        $("#uff-followers").modal('show');

        var last_id = $("#modal-body .streamer-profile").last().attr("id");

        if (!parseInt(last_id)) {

            scroll_ajax_post({
                action: 'followers-ajax-action',
                nonce: ajax_object.ajax_nonce,
                start: 0,
                length: 10,
                direction: true,
                reduce: null
            });

//            $.post(ajax_object.ajax_url,
//                    {
//                        action: 'followers-ajax-action',
//                        follow_nonce: ajax_object.ajax_nonce,
//                        start: 0,
//                        length: 10,
//                        down: true
//                    }, null, "json")
//                    .done(function (response) {
//                    
//                        response.data.followers.forEach(function (element, index) {
//
//
//                            $("#streamer-profile-draft")
//                                    .clone()
//                                    .attr("id", index)
//                                    .css("display", "block")
//                                    .appendTo("#modal-body");
//
//                            $("#" + index).find(".streamer-nicename").text(element['user_nicename']);
//                            $("#" + index).find(".streamer-email").text(element['user_email']);
//                        });
//                    })
//                    .fail(function () {
//                        alert("error");
//                    })
        }
    });

    var obj = {
        action: 'followers-ajax-action',
        nonce: ajax_object.ajax_nonce,
        start: "",
        length: 10,
        direction: true,
        reduce: reduce,
        ajaxUp: true,
        ajaxDown: true,
    }

    $("#modal-body").scroll(function () {

        var position_last = $("#modal-body .streamer-profile").last().position();
        var scrollTop = $("#modal-body").scrollTop();

        if (scrollTop > position_last.top && obj.ajaxDown) {

            obj.ajaxDown = false;

            var last_id = $("#modal-body .streamer-profile").last().attr("id");
            last_id = parseInt(last_id) + 1;

            obj.start = last_id;
            obj.direction =true;
        

            scroll_ajax_post(obj);


//            $.post(ajax_object.ajax_url,
//                    {
//                        action: 'followers-ajax-action',
//                        follow_nonce: ajax_object.ajax_nonce,
//                        start: last_id,
//                        length: 10,
//                        down: true
//                    }, null, "json")
//                    .done(function (response) {
//                        if (Array.isArray(response.data.followers)) {
//                            response.data.followers.forEach(function (element, index) {
//
//                                var index_id = parseInt(last_id) + index;
//
//
//                                $("#streamer-profile-draft")
//                                        .clone()
//                                        .attr("id", index_id)
//                                        .css("display", "block")
//                                        .appendTo("#modal-body");
//
//                                $("#" + index_id).find(".streamer-nicename").text(element['user_nicename']);
//                                $("#" + index_id).find(".streamer-email").text(element['user_email']);
//                            });
//
//                            var length = $("#modal-body .streamer-profile").length;
//
//                            if (length > 20) {
//                                var i = 0;
//                                while (i < 10) {
//                                    $("#modal-body .streamer-profile").first().remove();
//                                    i++;
//                                }
//                            }
//
//                            ajaxDown = true;
//                        }
//
//
//                    })
//                    .fail(function () {
//                        alert("error");
//                    })

        }

        var position_first = $("#modal-body .streamer-profile").first().position();
        var first_id = $("#modal-body .streamer-profile").first().attr("id");

        //        console.log("ajax  " + ajaxUp);
        //        console.log("fist    " + (scrollTop - position_first.top));

        if (scrollTop < position_first.top && parseInt(first_id) > 0 && obj.ajaxUp) {

            obj.ajaxUp = false;

            obj.start = parseInt(first_id);
            obj.direction =false;

            scroll_ajax_post(obj);

//            $.post(ajax_object.ajax_url,
//                    {
//                        action: 'followers-ajax-action',
//                        follow_nonce: ajax_object.ajax_nonce,
//                        start: first_id,
//                        length: 10,
//                        down: false
//                    }, null, "json")
//                    .done(function (response) {
//                        // console.log(response.data.followers);
//                        if (Array.isArray(response.data.followers)) {
//                            response.data.followers.forEach(function (element, index) {
//                      
//                                var index_id = parseInt(first_id) - index - 1;
//
//                                $("#streamer-profile-draft")
//                                        .clone()
//                                        .attr("id", index_id)
//                                        .css("display", "block")
//                                        .prependTo("#modal-body");
//
//                                $("#" + index_id).find(".streamer-nicename").text(element['user_nicename']);
//                                $("#" + index_id).find(".streamer-email").text(element['user_email']);
//                            });
//
//                            var length = $("#modal-body .streamer-profile").length;
//
//                            if (length > 20) {
//                                var i = 0;
//                                while (i < 10) {
//                                    $("#modal-body .streamer-profile").last().remove();
//                                    i++;
//                                }
//                                ajaxDown = true;
//                            }
//
//                            ajaxUp = true;
//                        }
//
//
//                    })
//                    .fail(function () {
//                        alert("error");
//                    })
        }


    });

});


jQuery(function ($) {


    if (following_object.following_users === "anonim") {
        $("#uff").hide();
    } else {
        $("#uff").show();
        $("#total-followers").text(following_object.total_followers);
        $("#total-following").text(following_object.total_following);
    }



    $("button[data-streamerID]").each(function (index) {

        var followButton = $(this);

        if (following_object.following_users !== "anonim") {

            var button_id = followButton.attr("data-streamerID");

            var inArray = following_object.following_users.indexOf(parseInt(button_id));

            if (inArray == -1) {
                followButton.removeClass("btn-warning").addClass("btn-success");
                followButton.text("Follow me");
            } else {
                followButton.removeClass("btn-success").addClass("btn-warning");
                followButton.text("Unfollow me");
            }
        } else {
            followButton.text("Login to follow");
            followButton.addClass("disabled");
        }

    });

    $("#home").on("click", "button[data-streamerID]", function (e) {


        var followButton = $(this);
                $.post(ajax_object.ajax_url,
                {
                    action: 'follow-ajax-action',
                    follow_nonce: ajax_object.ajax_nonce,
                    streamer: followButton.attr("data-streamerID"),
                    text: followButton.text()

                }, null, "json")
                .done(function (response) {
                    console.log(response.data['own_stream']);
                    if (response.data['own_stream'] === true) {
                        followButton.text("Your own stream");
                    } else {
                        followButton.toggleClass("btn-success").toggleClass("btn-warning");
                        followButton.text((followButton.text() === "Unfollow me") ? "Follow me" : "Unfollow me");
                        $("#total-followers").text(response.data['followers']);
                        $("#total-following").text(response.data['following_users']);
                    }
                })
                .fail(function () {
                    alert("error");
                })
                .always(function () {
                    //location.reload();
                });
    });
});


