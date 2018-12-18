
class Views {


   static get_views_tempalte($fullname,$time,$view,$no_view_support,$no_view_oppose,){


        return "<div class=\"ps-comment cstream-respond wall-cocs\" id=\"wall-cmt-482\"> " +
            "<div class=\"ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--482\" data-act-id=\"482\"> <div id=\"wall-cmt-493\" class=\"ps-comment ps-comment-nested ps-js-comment-reply--493\"> <div class=\"ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--493\" data-act-id=\"493\"> <div class=\"ps-comment-body cstream-content\"> <div class=\"ps-comment-message stream-comment-content\">" +
            " <a class=\"ps-comment-user cstream-author\" href=\" ://demo.peepso.com/profile/andrew/\">" + $fullname + "</a> <span class=\"ps-comment__content\" data-type=\"stream-comment-content\"><div class=\"peepso-markdown\">" +
            "<p>" + $view + "</p></div></span> </div><div data-type=\"stream-more\" class=\"cstream-more\" data-commentmore=\"true\"></div> <div class=\"ps-comment-time ps-shar-meta-date\"> <small class=\"activity-post-age\" data-timestamp=\"1529076809\"><span class=\"ps-js-autotime\" data-timestamp=\"1529076809\" title=\"June 15, 2018 3:33 pm\">2 weeks ago</span></small> <div id=\"act-like-496\" class=\"ps-comment-links cstream-likes ps-js-act-like--496\" data-count=\"1\"> <a onclick=\"return activity.show_likes(496);\" href=\"#showLikes\">1 person likes this</a>			</divdiv class=\"ps-comment-links stream-actions\" data-type=\"stream-action\"> <span class=\"ps-stream-status-action ps-stream-status-action\"> " +
            "<nav class=\"ps-stream-status-action ps-stream-status-action\"> <a data-stream-id=\"934\" onclick=\"activity.comment_action_like(this, 496); return false;\" href=\"#like\" class=\"actaction-like liked ps-icon-thumbs-up\"><span><span title=\"1 person likes this\">Like</span></span></a>" +
            "<a data-stream-id=\"934\" onclick=\"activity.comment_action_report(496); return false;\" href=\"#report\" class=\"actaction-report ps-icon-warning-sign\"><span>Report</span></a> <a data-stream-id=\"934\" onclick=\"activity.comment_action_edit(934, this); return false;\" href=\"#edit\" class=\"actaction-edit ps-icon-pencil\"><span>Edit</span></a> <a data-stream-id=\"934\" onclick=\"activity.comment_action_delete(934); return false;\" href=\"#delete\" class=\"actaction-delete ps-icon-trash\"><span></span></a> </nav> </span> </div> </div> </div> </div> </div> " +
            "<div id=\"act-new-comment-493\" class=\"ps-comment-reply cstream-form stream-form wallform ps-js-comment-new ps-js-newcomment-493\" data-type=\"stream-newcomment\" data-formblock=\"true\" style=\"display:none;\"> <a class=\"ps-avatar cstream-avatar cstream-author\" href=\" ://demo.peepso.com/profile/demo/\"> <img src=\" ://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg\" alt=\"\"> </a> <div class=\"ps-textarea-wrapper cstream-form-input\"> <div class=\"ps-tagging-wrapper\"><div class=\"ps-tagging-beautifier\"></div><textarea data-act-id=\"493\" class=\"ps-textarea cstream-form-text ps-tagging-textarea\" name=\"comment\" oninput=\"return activity.on_commentbox_change(this);\" placeholder=\"Write a reply...\"></textarea>" +
            "<input type=\"hidden\" class=\"ps-tagging-hidden\"><div class=\"ps-tagging-dropdown\"></div></div> <div class=\"ps-commentbox__addons ps-js-addons\"> <div class=\"ps-commentbox__addon ps-js-addon-giphy\" style=\"display:none\"> <div class=\"ps-popover__arrow ps-popover__arrow--up\"></div> <img class=\"ps-js-img\" alt=\"photo\" src=\"\"> <div class=\"ps-commentbox__addon-remove ps-js-remove\"> <i class=\"ps-icon-remove\"></i> </div> </div> <div class=\"ps-commentbox__addon ps-js-addon-photo\" style=\"display:none\"> <div class=\"ps-popover__arrow ps-popover__arrow--up\"></div> <img class=\"ps-js-img\" alt=\"photo\" src=\"\" data-id=\"\"> <div class=\"ps-loading ps-js-loading\"> <img src=\"../includes/assets/images/ajax-loader.gif\" alt=\"loading\"> </div> <div class=\"ps-commentbox__addon-remove ps-js-remove\"> <input type=\"hidden\" id=\"_wpnonce_remove_temp_comment_photos\" name=\"_wpnonce_remove_temp_comment_photos\" value=\"3ca8a9ab47\"><input type=\"hidden\" name=\"_wp_http_referer\" value=\"/peepsoajax/activity.show_posts_per_page\">		<i class=\"ps-icon-remove\"></i> </div> </div> </div> <div class=\"ps-commentbox-actions\"> <a onclick=\"peepso.photos.comment_attach_photo(this); return false;\" title=\"Upload photos\" href=\"#\" class=\"ps-postbox__menu-item ps-icon-camera\"><span></span></a> <a onclick=\"return false;\" title=\"Send gif\" href=\"#\" class=\"ps-list-item ps-js-comment-giphy ps-icon-giphy\"></a> </div> </div> <div class=\"ps-comment-send cstream-form-submit\" style=\"display:none;\"> <div class=\"ps-comment-loading\" style=\"display:none;\"> <img src=\"../includes/assets/images/ajax-loader.gif\" alt=\"\"> <div> </div> </div> <div class=\"ps-comment-actions\" style=\"display:none;\"> <button onclick=\"return activity.comment_cancel(493);\" class=\"ps-btn ps-button-cancel\">Clear</button> <button onclick=\"return activity.comment_save(493, this);\" class=\"ps-btn ps-btn-primary ps-button-action\" disabled=\"\">Post</button> </div> </div> </div> </div> </div>";


    }


    static get_view_textarea_template(){

       return "<div id=\"act-new-comment-482\" class=\"ps-comment-reply cstream-form stream-form wallform ps-js-comment-new ps-js-newcomment-482\" data-id=\"482\" data-type=\"stream-newcomment\" data-formblock=\"true\">\n" +
           "\t\t\t\n" +
           "\t\t\t<div class=\"ps-textarea-wrapper cstream-form-input\">\n" +
           "\t\t\t\t<div class=\"ps-tagging-wrapper\"><div class=\"ps-tagging-beautifier\"></div><textarea data-act-id=\"482\" class=\"ps-textarea cstream-form-text ps-tagging-textarea\" name=\"comment\" oninput=\"return activity.on_commentbox_change(this);\" placeholder=\"Write a comment...\"></textarea><input type=\"hidden\" class=\"ps-tagging-hidden\"><div class=\"ps-tagging-dropdown\"></div></div>\n" +
           "\t\t\t\t<div class=\"ps-commentbox__addons ps-js-addons\">\n" +
           "<div class=\"ps-commentbox__addon ps-js-addon-giphy\" style=\"display:none\">\n" +
           "\t<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>\n" +
           "\t<img class=\"ps-js-img\" alt=\"photo\" src=\"\">\n" +
           "\t<div class=\"ps-commentbox__addon-remove ps-js-remove\">\n" +
           "\t\t<i class=\"ps-icon-remove\"></i>\n" +
           "\t</div>\n" +
           "</div>\n" +
           "<div class=\"ps-commentbox__addon ps-js-addon-photo\" style=\"display:none\">\n" +
           "\t<div class=\"ps-popover__arrow ps-popover__arrow--up\"></div>\n" +
           "\n" +
           "\t<img class=\"ps-js-img\" alt=\"photo\" src=\"\" data-id=\"\">\n" +
           "\n" +
           "\t<div class=\"ps-loading ps-js-loading\">\n" +
           "\t\t<img src=\"../includes/assets/images/ajax-loader.gif\" alt=\"loading\">\n" +
           "\t</div>\n" +
           "\n" +
           "\t<div class=\"ps-commentbox__addon-remove ps-js-remove\">\n" +
           "\t\t<input type=\"hidden\" id=\"_wpnonce_remove_temp_comment_photos\" name=\"_wpnonce_remove_temp_comment_photos\" value=\"3ca8a9ab47\"><input type=\"hidden\" name=\"_wp_http_referer\" value=\"/peepsoajax/activity.show_posts_per_page\">\t\t<i class=\"ps-icon-remove\"></i>\n" +
           "\t</div>\n" +
           "</div>\n" +
           "</div>\n" +
           "\n" +
           "\t\t\t</div>\n" +
           "\t\t\t<div class=\"ps-comment-send cstream-form-submit\" style=\"display:none;\">\n" +
           "\t\t\t\t<div class=\"ps-comment-loading\" style=\"display:none;\">\n" +
           "\t\t\t\t\t<img src=\"../includes/assets/images/ajax-loader.gif\" alt=\"\">\n" +
           "\t\t\t\t\t<div> </div>\n" +
           "\t\t\t\t</div>\n" +
           "\t\t\t\t<div class=\"ps-comment-actions\" style=\"display:none;\">\n" +
           "\t\t\t\t\t<button onclick=\"return activity.comment_cancel(482);\" class=\"ps-btn ps-button-cancel\">Clear</button>\n" +
           "\t\t\t\t\t<button onclick=\"return activity.comment_save(482, this);\" class=\"ps-btn ps-btn-primary ps-button-action\" disabled=\"\">Post</button>\n" +
           "\t\t\t\t</div>\n" +
           "\t\t\t</div>\n" +
           "\t\t</div>";
    }


}