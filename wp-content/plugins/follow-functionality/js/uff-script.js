jQuery(function ($) {

    $("#follow-me").on('click', function (e) {

        $("#uff-followers").modal('show');

        $.post(ajax_object.ajax_url,
                {
                    action: 'followers-ajax-action',
                    follow_nonce: ajax_object.ajax_nonce,
                    start: 0,
                    length: 10
                }, null, "json")
                .done(function (response) {
                    // console.log(response.data.followers);
                    response.data.followers.forEach(function (element, index) {
                        console.log(element);

                        $("#streamer-profile-draft")
                                .clone()
                                .attr( "id", index)
                                .css("display", "block")
                                .appendTo("#modal-body");
                        
                        $("#"+index).find(".streamer-nicename").text(element['user_nicename']);
                        $("#"+index).find(".streamer-email").text(element['user_email']);
                    });
                })
                .fail(function () {
                    alert("error");
                })
    });



    $("#modal-body").scroll(function () {
        console.log("scroll");
    });

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


