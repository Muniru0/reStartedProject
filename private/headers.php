 <?php

function home_header($firstname = "",$lastname = ""){

  return "<div class='header'>
          <div class='header__logo'>
            <a href=' ://demo.peepso.com/'>
              <img src=' ://demo.peepso.com/wp-content/themes/new/assets/images/logo.svg' alt='PeepSo'><img src=' ://demo.peepso.com/wp-content/themes/new/assets/images/logo-white.svg' alt='PeepSo'>
            </a>
          </div>
          <ul class='header__menu'>
            <li id='menu-item-149' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-149'><a href=' ://demo.peepso.com/'>Transport</a></li>
			<li id='menu-item-149' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-149'><a href=' ://demo.peepso.com/'>Health</a></li>
			<li id='menu-item-149' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-149'><a href=' ://demo.peepso.com/'>Work</a></li>
			<li id='menu-item-149' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-home current-menu-item page_item page-item-5 current_page_item menu-item-149'><a href=' ://demo.peepso.com/'>Sanitation</a></li>
<li id='menu-item-148' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-148'><a href=' ://demo.peepso.com/profile/'>S.O.L</a></li>
<li id='menu-item-663' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-663'><a href=' ://demo.peepso.com/members/'>Security</a></li>
<li id='menu-item-664' class='menu-item menu-item-type-post_type menu-item-object-page menu-item-664'><a href=' ://demo.peepso.com/classifieds/'>Sanitation</a></li>
<li id='menu-item-150' class='menu-item menu-item-type-custom menu-item-object-custom menu-item-150'><a target='_blank' href='/wp-admin/'>Corruption</a></li>

<li id='menu-item-150' class='menu-item menu-item-type-custom menu-item-object-custom menu-item-150'><a target='_blank' href='/wp-admin/'>Other</a></li>
            <li class='menu-item menu-item--myacccount'>
              <a href=' ://www.peepso.com/my-account/'>Other</a>
            </li>
          </ul>

                    <div id='userbar' class='header__account'><div class='widget_text widget header__widget'><div class='textwidget custom-html-widget'><div class='ultimate__box-actions' style='margin-left: 30px;'><a class='btn btn--sm' style='display:block;' href='http://peep.so/bundle'><strong>{$firstname} {$lastname}</strong></a></div></div></div></div>

          <div class='header__actions'>
                        <a class='header__toggle header__toggle--account' href='#userbar'>
              <svg class='svg-inline--fa fa-user-alt fa-w-16' aria-hidden='true' data-prefix='fas' data-icon='user-alt' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z'></path></svg><!-- <i class='fas fa-user-alt'></i> -->
            </a>

            <a href='#userbar' class='header__toggle header__toggle--close' style='display: none'>
              <svg class='svg-inline--fa fa-times fa-w-12' aria-hidden='true' data-prefix='fas' data-icon='times' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512' data-fa-i2svg=''><path fill='currentColor' d='M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z'></path></svg><!-- <i class='fas fa-times'></i> -->
            </a>

            <a class='header__toggle header__toggle--menu modal__toggle' href='#menu'>
              <svg class='svg-inline--fa fa-bars fa-w-14' aria-hidden='true' data-prefix='fas' data-icon='bars' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' data-fa-i2svg=''><path fill='currentColor' d='M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z'></path></svg><!-- <i class='fas fa-bars'></i> -->
            </a>
          </div>
        </div>";

}// home_header();





// the user profile header
function profile_header($firstname = "" ,$lastname = ""){
	
	return "<div class='header__wrapper header__wrapper--medium'>
        
		<div class='header' style='margin: 0px auto;'>
          <div class='header__logo'>
            <a href=' ://demo.peepso.com/'>
              <img src=' ://demo.peepso.com/wp-content/themes/new/assets/images/logo.svg' alt='PeepSo'><img src=' ://demo.peepso.com/wp-content/themes/new/assets/images/logo-white.svg' alt='PeepSo'>
            </a>
          </div>
    <div id='userbar' class='header__account' style='
    margin-left: 8em;
'><div class='widget_text widget header__widget'><div class='textwidget custom-html-widget'><div class='ultimate__box-actions' style='margin-left: 30px;'><a class='btn btn--sm' style='display:block;' href='#'><strong>{$firstname} {$lastname}</strong></a></div></div></div></div>
          <ul class='header__menu' style='
    max-width: 300px !important;
   
'>
<li  class='menu-item menu-item-type-custom menu-item-object-custom menu-item-150'><a target='_blank' href=''><i class='fal fa-envelope'></i>Message</a></li>

 <li  class='menu-item menu-item-type-custom menu-item-object-custom '><a target='_blank' href=''><i class='fal fa-user'></i>Profile</a></li>
</ul>
</div>

          <div class='header__actions'>
                        <a class='header__toggle header__toggle--account' href='#userbar'>
              <svg class='svg-inline--fa fa-user-alt fa-w-16' aria-hidden='true' data-prefix='fas' data-icon='user-alt' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M256 288c79.5 0 144-64.5 144-144S335.5 0 256 0 112 64.5 112 144s64.5 144 144 144zm128 32h-55.1c-22.2 10.2-46.9 16-72.9 16s-50.6-5.8-72.9-16H128C57.3 320 0 377.3 0 448v16c0 26.5 21.5 48 48 48h416c26.5 0 48-21.5 48-48v-16c0-70.7-57.3-128-128-128z'></path></svg><!-- <i class='fas fa-user-alt'></i> -->
            </a>

            <a href='#userbar' class='header__toggle header__toggle--close' style='display: none'>
              <svg class='svg-inline--fa fa-times fa-w-12' aria-hidden='true' data-prefix='fas' data-icon='times' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 384 512' data-fa-i2svg=''><path fill='currentColor' d='M323.1 441l53.9-53.9c9.4-9.4 9.4-24.5 0-33.9L279.8 256l97.2-97.2c9.4-9.4 9.4-24.5 0-33.9L323.1 71c-9.4-9.4-24.5-9.4-33.9 0L192 168.2 94.8 71c-9.4-9.4-24.5-9.4-33.9 0L7 124.9c-9.4 9.4-9.4 24.5 0 33.9l97.2 97.2L7 353.2c-9.4 9.4-9.4 24.5 0 33.9L60.9 441c9.4 9.4 24.5 9.4 33.9 0l97.2-97.2 97.2 97.2c9.3 9.3 24.5 9.3 33.9 0z'></path></svg><!-- <i class='fas fa-times'></i> -->
            </a>

            <a class='header__toggle header__toggle--menu modal__toggle' href='#menu'>
              <svg class='svg-inline--fa fa-bars fa-w-14' aria-hidden='true' data-prefix='fas' data-icon='bars' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 448 512' data-fa-i2svg=''><path fill='currentColor' d='M16 132h416c8.837 0 16-7.163 16-16V76c0-8.837-7.163-16-16-16H16C7.163 60 0 67.163 0 76v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16zm0 160h416c8.837 0 16-7.163 16-16v-40c0-8.837-7.163-16-16-16H16c-8.837 0-16 7.163-16 16v40c0 8.837 7.163 16 16 16z'></path></svg><!-- <i class='fas fa-bars'></i> -->
            </a>
          </div>
        
      </div>";
}


    // community side left templates
	function community_side__left(){
		
		return "<div class='community__side community__side--left'>
              <div class='widget community__widget'>
	<div class='ps-widget--profile__wrapper ps-widget--external'>
		<!-- Title of Profile Widget -->

		<div class='ps-widget--profile'>

					<div class='ps-widget--profile__cover'>
	<div class='ps-widget--profile__cover-image' style='background:url('images/image-1.jpg') no-repeat center'></div>
				<a class='ps-widget--profile__cover-wrapper' href=''>
					<div class='ps-widget--profile__cover-header'>
						<!-- Avatar -->
						<div class='ps-widget--profile__cover-avatar'>
							<div class='ps-avatar ps-avatar--widget' href='#'>
								<img alt='Osman Ganiu ' title='Profile Image' src='assets/images/image_5.gif'>
							</div>
						</div>

						<!-- Name, edit profile -->
						<div class='ps-widget--profile__cover-details'>
							<img src=' ://demo.peepso.com/wp-content/plugins/peepso-extras-vip/classes/../assets/svg/def_3.svg' alt='VIP' title='VIP' class='ps-img-vipicons ps-js-vip-badge' data-id='2'>Osman Ganiu</div>
					</div>
				</a>
				<div class='ps-widget--profile__cover-notif'>
					        <div class='ps-widget--profile__notifications'>                    <span class='ps-js-friends-notification friends-notification psnotification-toggle'>              <a href=' ://demo.peepso.com/profile/demo/friends/requests' title=''>                <div class='ps-bubble__wrapper'>                    <i class='ps-icon-users'></i>                        <span class='js-counter ps-bubble ps-bubble--widget ps-js-counter'>                            1                        </span>                </div>              </a>            <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span>                    <span class='dropdown-notification ps-js-notifications'>              <a href=' ://demo.peepso.com/profile/?notifications' title='Pending Notifications'>                <div class='ps-bubble__wrapper'>                    <i class='ps-icon-globe'></i>                        <span class='js-counter ps-bubble ps-bubble--widget ps-js-counter'>20</span>                </div>              </a>            <div class='ps-popover app-box' style='display:none;'><div class='ps-notifications' style='max-height: 40vh; overflow: auto;'><div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='assets/images/image_5.gif' alt='William Torres'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>William</strong>
				liked your comment on your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--150' data-id='150' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1502693781/#comment.457.933.933'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='assets/images/image_5.gif' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:39'><span title='2018-06-15 15:32:39'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--149' data-id='149' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505368315/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='assets/images/image_5.gif' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:32'><span title='2018-06-15 15:32:32'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--146' data-id='146' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/#comment.471.932.932'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='assets/images/image_5.gif' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your cover photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:24'><span title='2018-06-15 15:32:24'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='assets/images/image_5.gif' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
</div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='#' style='float: left; width: 50%;'>Mark All as Read</a><a href='#' style='float: left; width: 50%;'>Show unread only</a></div></div></span>                </div>        				</div>
			</div>

			<!-- Profile Completeness -->
							<div class='ps-progress-status ps-completeness-status' style=''>
					<a href=' ://demo.peepso.com/profile/demo/about'>Your profile is 37% complete</a>				</div>
				<div class='ps-progress-bar ps-completeness-bar' style=''>
					<span style='width:60%'></span>
				</div>


			<!-- Profile Links -->
			<span class='ps-widget--profile__title'>My Profile</span>
			<div class='ps-widget--profile__menu'>
				<a href=' ://demo.peepso.com/profile/demo/' class=''><span class='ps-icon-home'></span> Stream</a><a href=' ://demo.peepso.com/profile/demo/about' class=''><span class='ps-icon-user'></span> About</a><a href='../private/' class=''><span class='ps-icon-users'></span> Friends</a><a href=' ://demo.peepso.com/profile/demo/groups' class=''><span class='ps-icon-group'></span> Groups</a><a href=' ://demo.peepso.com/profile/demo/photos' class=''><span class='ps-icon-camera'></span> Photos</a><a href=' ://demo.peepso.com/profile/demo/videos' class=''><span class='ps-icon-videocam'></span> Videos</a>			</div>
       <div class='ps-widget--profile__menu'>
					<a href='#' id='logout_link' tabindex='0' role='button' style='border-radius:3px;'><span class='ps-icon-off' style='color:#d2578b;'></span> Log Out <img src='assets/images/ajax-loader.gif' alt='ajax loader' style='position: relative;top: 0.2em;left: 1.3em; display:none;'></a>	

   <form id='logout_form' method='POST' style='display:none;'>
   <input id='csrf' type='hidden' name='csrf_token' value='f6d144667f4596f1aaa678c0e77d600d'>   <button type='submit' id='logout_button' name='submit'></button>
   
   </form>
					</div>

		</div>
	</div>

</div><div class='widget community__widget'>


</div>          </div>";
		
	}// community_side__left();


// communities toolbar
  function communties_toolbar(){
	  
	  
	  return "<div class='ps-toolbar ps-toolbar--desktop js-toolbar'>
  <div class='ps-toolbar__menu' title='communities(You will get more post from this community if you are part of it)'>
             <span class=''> <a href='transport.php' title='transport community'> <div class='ps-bubble__wrapper'>Transport <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='health.php' title='health community'> <div class='ps-bubble__wrapper'>Health <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 10 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='sol.php'>View All</a></div></div></span> <span class=''> <a href='sol.php' title='Standard of living'> <div class='ps-bubble__wrapper'>S.O.L <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='Security.php' title='secuirty community'> <div class='ps-bubble__wrapper'>Security<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='sanitation.php' title='sanitation community'> <div class='ps-bubble__wrapper'>Sanitation <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='work.php' title='work community'> <div class='ps-bubble__wrapper'>Work <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='other.php' title='You will get updated about all the other communities'> <div class='ps-bubble__wrapper'>Other<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='oppresion.php' title='Friend Requests'> <div class='ps-bubble__wrapper'>Oppresion<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href=' ://demo.peepso.com/profile/demo/friends/requests' title='Friend Requests'> <div class='ps-bubble__wrapper'>placeholder<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class='dropdown-notification ps-js-notifications'> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications' style='max-height: 40vh; overflow: auto;'><div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/6/avatar-full.jpg' alt='William Torres'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>William</strong>
				liked your comment on your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--150' data-id='150' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1502693781/#comment.457.933.933'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:39'><span title='2018-06-15 15:32:39'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--149' data-id='149' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505368315/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:32'><span title='2018-06-15 15:32:32'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--146' data-id='146' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/#comment.471.932.932'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your cover photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:24'><span title='2018-06-15 15:32:24'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
</div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='#' style='float: left; width: 50%;'>Mark All as Read</a><a href='#' style='float: left; width: 50%;'>Show unread only</a></div></div></span>             </div>
        </div>
		
		
		
		";
  }
  
  //toolbar for the notifications
function notifications_toolbar(){
	
	return "<div class='ps-toolbar'>

            <div class='ps-toolbar__menu'>
		<span>
			<a href='javascript:' class='ps-toolbar__toggle'>
				<i class='ps-icon-menu'></i>
			</a>
		</span>
                <span class=''> <a href=' ://demo.peepso.com/activity/' title='Activity'> <div class='ps-bubble__wrapper'> <i class='ps-icon-home'></i> <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class='ps-js-friends-notification friends-notification psnotification-toggle'> <a href=' ://demo.peepso.com/profile/demo/friends/requests' title='Friend Requests'> <div class='ps-bubble__wrapper'> <i class='ps-icon-users'></i> <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 10 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class='dropdown-notification ps-js-notifications'> <a href=' ://demo.peepso.com/profile/?notifications' title='Pending Notifications'> <div class='ps-bubble__wrapper'> <i class='ps-icon-globe'></i> <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'>20</span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications' style='max-height: 40vh; overflow: auto;'><div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/6/avatar-full.jpg' alt='William Torres'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>William</strong>
				liked your comment on your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--150' data-id='150' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1502693781/#comment.457.933.933'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:39'><span title='2018-06-15 15:32:39'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--149' data-id='149' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505368315/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:32'><span title='2018-06-15 15:32:32'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--146' data-id='146' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/#comment.471.932.932'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your cover photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:24'><span title='2018-06-15 15:32:24'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
</div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='#' style='float: left; width: 50%;'>Mark All as Read</a><a href='#' style='float: left; width: 50%;'>Show unread only</a></div></div></span>             </div>

            <div id='ps-main-nav' class='ps-toolbar__submenu'>
                <span class=''> <a href=' ://demo.peepso.com/members/' title='Members'> <div class='ps-bubble__wrapper'> <i class='ps-icon-users'></i> Members <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class=''> <a href=' ://demo.peepso.com/classifieds/' title='Classifieds'> <div class='ps-bubble__wrapper'> <i class='ps-icon-bullhorn'></i> Classifieds <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class=''> <a href=' ://demo.peepso.com/groups/' title='Groups'> <div class='ps-bubble__wrapper'> <i class='ps-icon-group'></i> Groups <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class='ps-dropdown ps-dropdown--right ps-js-dropdown'> <a onclick='return false;' href='' class='ps-dropdown__toggle ps-js-dropdown-toggle'> <div class='ps-avatar ps-avatar--toolbar ps-avatar--xs'><img src=' ://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg' alt='Patricia Currie avatar'></div> Patricia </a> <div class='ps-dropdown__menu ps-dropdown__menu--toolbar ps-js-dropdown-menu'> <a class='' href=' ://demo.peepso.com/profile/demo/'> <i class='ps-icon-home'></i> Stream</a> <a class='' href=' ://demo.peepso.com/profile/demo/about'> <i class='ps-icon-user'></i> About</a> <a class='' href=' ://demo.peepso.com/profile/demo/classifieds'> <i class='ps-icon-bullhorn'></i> Classifieds</a> <a class='' href=' ://demo.peepso.com/profile/demo/friends'> <i class='ps-icon-users'></i> Friends</a> <a class='' href=' ://demo.peepso.com/profile/demo/groups'> <i class='ps-icon-group'></i> Groups</a> <a class='' href=' ://demo.peepso.com/profile/demo/photos'> <i class='ps-icon-camera'></i> Photos</a> <a class='' href=' ://demo.peepso.com/profile/demo/videos'> <i class='ps-icon-videocam'></i> Videos</a> <a class='' href=' ://demo.peepso.com/profile/demo/about/preferences/'> <i class='ps-icon-edit'></i> Preferences</a> <a class='' href=' ://demo.peepso.com/profile/?logout'> <i class='ps-icon-off'></i> Log Out</a> </div> </span>            </div>
        </div>";
}  
  
  
  function postbox(){
	  
	  
	  
	  return "<div id='postbox-main' class='ps-postbox ps-clearfix' style=''>


    <div data-tab-id='videos'><div class='ps-postbox-videos'>
            <div class='ps-postbox-fetched'></div>
            <div style='position:relative'>
                <div class='ps-postbox-input ps-inputbox ' id='post_title'>
                    <sup class='label-error' style='font-size: 1em; top: 0.01em; right: 0em; display:none;'>Please a title is required *</sup>
                    <input class='ps-textarea ps-videos-url input' maxlength='100' placeholder='Please give a title to your post (Max: 100 characters)' style='min-height: 1.4em; text-align: center; font-size: 14px !important'>
                    <div class='ps-postbox-loading' style='display: none;'>
                        <img src='https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif'>
                        <div>
                        </div>
                    </div>
                </div>
                <div class='ps-postbox-preview' style='display: none;'>
                </div>
            </div>
        </div></div>
    <fieldset class='labelset' style='font-family:'myfont' !important; text-align:center;'>

    <legend style='display:inline'>Please attach a label to your Post</legend>
   <small class='label-error' style='display:none;'>A label is required *</small>
    <div class='label-div' style='padding-top: 0.7%;'>
    <!--Transport Label -->
    <input type='radio' name='label' id='transport' value='transport' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='transport' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Transport</label>
<!--   post label for health community  -->
        <input type='radio' name='label' id='health' value='health' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='health' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Health</label>
<!--    post label for work community  -->
        <input type='radio' name='label' id='work' value='work' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='work' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Work</label>
<!--    post label for sol community  -->
        <input type='radio' name='label' id='sol' value='sol' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='sol' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>S.O.L</label>
<!--   post label for security community  -->
        <input type='radio' name='label' id='security' value='security' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='security' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Security</label>
<!--  post label for sanitation community  -->
        <input type='radio' name='label' id='sanitation' value='sanitation' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='sanitation' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Sanitation</label>
        <!--  post label for corruption -->
        <input type='radio' name='label' id='corruption' value='corruption' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='corruption' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Corruption</label>
<!--     post label for other community    -->
        <input type='radio' name='label' id='other' value='other' class='checkboxradio ui-checkboxradio ui-helper-hidden-accessible'>
     <label for='other' class='ui-checkboxradio-label ui-corner-all ui-button ui-widget ui-checkboxradio-radio-label'><span class='ui-checkboxradio-icon ui-corner-all ui-icon ui-icon-background ui-icon-blank'></span><span class='ui-checkboxradio-icon-space'> </span>Other</label>
   </div>
      <div id='success-dialog' title='Upload Success' style='display:none;'>Please Your post is currently under going verification.It will appear in the stream very soon.<br><b>(this may take up to 5 minutes).</b></div>
<div id='error-dialog' title='Error' style='display:none;'>Please try again</div>
       </fieldset>

    <div id='ps-postbox-status' class='ps-postbox-content'>
        <div class='ps-postbox-tabs' style='display:block;'>
            <div id='postcontent' class='dropzone dz-clickable' style='cursor: pointer; text-align: center; min-height: 0px; border: 0px; display: block;'><div class='ps-postbox-photos'>
                    <div class='ps-postbox-fetched'></div>
                    <div style='position:relative'>
                        <div id='ps-upload-container' class='ps-postbox-input ps-inputbox browse_file dz-clickable' style='cursor:pointer;'>
                            <div class='ps-postbox-photo-upload fileinput-button' id='image_upload' style='cursor:pointer;'>
                                <div class='ps-postbox-info'>
                                    <i class='ps-icon-picture'></i>
                                    <span>Click here to start uploading photos</span>
                                </div>
                                <span>Max photo dimensions: 4000 x 3000px | Max file size: 8MB</span>
                            </div>
                            <div class='ps-postbox-preview' style='display:none;'>
                                <div class='ps-js-photos-container'></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id='photo-supported-format' style='display:none;'>Supported formats are: gif, jpg, jpeg, tiff, and png.</div>
                <div id='photo-comment-label' style='display:none;'>Say something about this photo...</div>
                <div class='dz-default dz-message'><span></span></div></div><div data-tab-id='videos'><div class='ps-postbox-videos'>style='cursor:pointer'
                    <div class='ps-postbox-fetched'></div>
                    <div style='position:relative'>
                        <div id='post_title_div' class='ps-postbox-input ps-inputbox' title='Please give a short title for your post'>
                            <input class='ps-textarea ps-videos-url input' placeholder='Enter video URL here' style='min-height: 1.4em;'>
                            <div class='ps-postbox-loading' style='display: none;'>
                                <img src='assets/images/ajax-loader.gif'>
                                <div> </div>
                            </div>
                        </div>
                        <div class='ps-postbox-preview' style='display: none;'>
                        </div>
                    </div>
                </div>
            </div><div data-tab-id='polls'><div class='ps-poll__form ps-js-polls'>
                    <div class='ps-postbox-fetched'></div>
                    <div style='position:relative'>
                        <div style='position:relative'>
                            <div class='ui-sortable'>
                                <div class='ps-poll__option'>
                                    <a class='ps-btn ps-js-handle ui-sortable-handle' title='Move' href='#'><i class='ps-icon-move'></i></a>
                                    <input class='ps-input' type='text' placeholder='Option 1'>
                                    <a id='ps-delete-option' class='ps-btn ps-btn--delete' title='Delete' href='#'><i class='ps-icon-trash'></i></a>
                                </div>
                                <div class='ps-poll__option'>
                                    <a class='ps-btn ps-js-handle ui-sortable-handle' title='Move' href='#'><i class='ps-icon-move'></i></a>
                                    <input class='ps-input' type='text' placeholder='Option 2'>
                                    <a id='ps-delete-option' class='ps-btn ps-btn--delete' title='Delete' href='#'><i class='ps-icon-trash'></i></a>
                                </div>
                            </div>

                            <div class='ps-poll__actions'>
                                <button class='ps-btn ps-btn-small ps-button-action' id='ps-add-new-option'>Add new option</button>

                                <div class='ps-checkbox'>
                                    <input type='checkbox' id='allow-multiple' class='ace ace-switch ace-switch-2 allow-multiple'>
                                    <label class='lbl' for='allow-multiple'>Allow multiple options selection</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		</div>
<!--        <div class='ps-postbox-status' style='display:block;'>-->
<!--            <div style='position:relative'>-->
<!--                <div style='position:absolute'>-->
<!--                    <span class='ps-postbox-mirror'></span>-->
<!--                    <span class='ps-postbox-addons'></span>-->
<!--                </div>-->
<!--                <div class='ps-postbox-input ps-inputbox'>-->
<!--                    <div class='ps-tagging-wrapper'><div class='ps-tagging-beautifier'></div><textarea id='poststatus' class='ps-textarea ps-postbox-textarea ps-tagging-textarea ' placeholder='Say something about this post...' maxlength='4000' style='overflow: hidden; word-wrap: break-word; resize: none; height: 36px;'></textarea><input type='hidden' class='ps-tagging-hidden'><div class='ps-tagging-dropdown'></div></div>-->
<!--                </div>-->
<!--            </div>-->
<!--            <div class='post-charcount charcount ps-postbox-charcount'>4000</div>-->
<!--        </div>-->
        <div class='ps-postbox-status' style='display: block;'>
            <div style='position:relative'>
                <div style='position:absolute'>
                    <span class='ps-postbox-mirror'></span>
                    <span class='ps-postbox-addons ' style='display: none;'>— <i class='ps-emoticon ps-emoticon ps-emo-1'></i> <b> feeling joyful</b></span>
                </div>
                <div class='ps-postbox-input ps-inputbox'>
             <div class='ps-tagging-wrapper'>
                <div class='ps-tagging-beautifier'></div>
                <textarea id='post_caption' class='ps-textarea ps-postbox-textarea ps-tagging-textarea' placeholder='You can eloborate more on the above title here(optional)...' maxlength='4000' oninput='utility.resizeTextarea(this);' style='overflow: hidden; word-wrap: break-word; resize: none; height: 20px; min-height: 20px;font-size:0.9em;'></textarea>
                <input type='hidden' class='ps-tagging-hidden'><div class='ps-tagging-dropdown'></div></div>
             </div>
            </div>
            <div class='post-charcount charcount ps-postbox-charcount'>4000</div>
        </div>

    </div>

	<div class='ps-postbox-tab ps-postbox-tab-root ps-clearfix'>

	</div>

	<nav class='ps-postbox-tab selected interactions' id='post_nav' style='display: block;'>

    <!--The beginning of the postbox inline options of people,mood,location,photo,video,etc. -->
        <div class='ps-postbox__menu' id='post_menu'>
<small class='label-error' style='height: 50%;position: relative; left: 0.1em;top: 0.9em; margin-right: .4em; display:none '>A location is required*</small>
    <!-- Post item 1(People) -->
    	<!-- <div id='privacy-tab' class='ps-postbox__menu-item'>
    <div class='interaction-icon-wrapper' id='people_wrapper'>
    <a class='pstd-secondary' onclick='return;' title='Privacy settings for your post'>
<i class='ps-icon-globe'></i>
<span class='ps-icon-html-privacy'>Public</span>
</a>
</div><input type='hidden' autocomplete='off' id='postbox_acc' name='postbox_acc' value='10'><div class='ps-postbox-privacy ps-privacy-dropdown ps-dropdown__menu' style='display: none; max-height:40vh;overflow-x:hidden; overflow-y:auto; ' id='people_wrapper_div'>
<!--
            <a id='postbox-acc-10' href='javascript:' data-option-value='10'><i class='ps-icon-globe'></i><span>Public</span></a><a id='postbox-acc-20' href='javascript:' data-option-value='20'><i class='ps-icon-users'></i><span>Site Members</span></a><a id='postbox-acc-30' href='javascript:' data-option-value='30'><i class='ps-icon-user2'></i><span>Friends Only</span></a><a id='postbox-acc-40' href='javascript:' data-option-value='40'><i class='ps-icon-lock'></i><span>Only Me</span></a>


<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
    <div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>


<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>


<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>

<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>


    <div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>


    <div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>


<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='<?php// echo $profile_image; ?>' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>

<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='<?php// echo $profile_image; ?>' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1' >
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='<?php// echo $profile_image; ?>' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div> -->

<!--
<span class='dropdown-notification ps-js-notifications'><a href=' ://demo.peepso.com/profile/?notifications' title='Pending Notifications'><div class='ps-bubble__wrapper'><i class='ps-icon-globe'></i>                        <span class='js-counter ps-bubble ps-bubble--widget ps-js-counter'>20</span>                </div>              </a>            <div class='ps-popover app-box' style='display:none;'><div class='ps-notifications' style='max-height: 40vh; overflow: auto;'><div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='<?php// echo $profile_image; ?>' alt='William Torres'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>William</strong>
				liked your comment on your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--150' data-id='150' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1502693781/#comment.457.933.933'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='<?php// echo $profile_image; ?>' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:39'><span title='2018-06-15 15:32:39'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--149' data-id='149' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505368315/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:32'><span title='2018-06-15 15:32:32'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--146' data-id='146' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/#comment.471.932.932'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your cover photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:24'><span title='2018-06-15 15:32:24'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src='' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
</div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='#' style='float: left; width: 50%;'>Mark All as Read</a><a href='#' style='float: left; width: 50%;'>Show unread only</a></div></div></span>
-->
<!-- </div></div> -->


<!--END OF THE PEOPLES POSTBOX ITEM -->

<div id='location-tab' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper' id='location_wrapper'><a class='pstd-secondary' onclick='return;' title='Please you need to select the location that the event occured'>
<i class='ps-icon-map-marker'></i>
</a>
</div><div id='pslocation' class='hidden ps-postbox-dropdown ps-js-postbox-location'>
<div class='ps-postbox-location ps-postbox-location-compact'>
<div class='ps-postbox-loading'>
 
<div> </div>
</div>
<div class='ps-postbox-locmap'>
<div id='pslocation-map' class='ps-postbox-map'></div>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('pslocation-map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }

    </script>
<div class='ps-postbox-locct'>
 Enter your location:				<br>
 <input type='text' class='ps-input' name='postbox_loc_search' value='' disabled=''>
 <ul class='ps-postbox-locations'></ul>
 <div class='ps-postbox-action ps-location-action' style='display: none;'>
   <button class='ps-btn ps-btn-primary ps-add-location' style='display: inline-block;'>
     <i class='ps-icon-map-marker'></i>Select					</button>
   <button class='ps-btn ps-btn-danger ps-remove-location' style='display: none;'>
     <i class='ps-icon-remove'></i>Remove					</button>
 </div>
</div>
</div>
</div>
</div>
<div style='display: none;'>
<div id='pslocation-search-loading'>
<img src='assets/images/ajax-loader.gif' alt=''>
</div>
<div id='pslocation-in-text'></div>
</div>
</div>



<div id='mood-tab' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper' id='mood_wrapper'><a class='pstd-secondary' onclick='return;' title='Mood settings for your post'>
<i class='ps-icon-happy'></i>
</a>
</div><div id='postbox-mood' class='ps-dropdown__menu ps-dropdown__menu--moods ps-js-postbox-mood' style='display:none'>

				<a class='mood-list' id='postbox-mood-1' href='javascript:' data-option-value='1' data-option-display-value='joyful'>
					<i class='ps-emoticon ps-emo-1'></i><span>joyful</span>
				</a>
				<a class='mood-list' id='postbox-mood-2' href='javascript:' data-option-value='2' data-option-display-value='meh'>
					<i class='ps-emoticon ps-emo-2'></i><span>meh</span>
				</a>
				<a class='mood-list' id='postbox-mood-3' href='javascript:' data-option-value='3' data-option-display-value='love'>
					<i class='ps-emoticon ps-emo-3'></i><span>love</span>
				</a>
				<a class='mood-list' id='postbox-mood-4' href='javascript:' data-option-value='4' data-option-display-value='flattered'>
					<i class='ps-emoticon ps-emo-4'></i><span>flattered</span>
				</a>
				<a class='mood-list' id='postbox-mood-5' href='javascript:' data-option-value='5' data-option-display-value='crazy'>
					<i class='ps-emoticon ps-emo-5'></i><span>crazy</span>
				</a>
				<a class='mood-list' id='postbox-mood-6' href='javascript:' data-option-value='6' data-option-display-value='cool'>
					<i class='ps-emoticon ps-emo-6'></i><span>cool</span>
				</a>
				<a class='mood-list' id='postbox-mood-7' href='javascript:' data-option-value='7' data-option-display-value='tired'>
					<i class='ps-emoticon ps-emo-7'></i><span>tired</span>
				</a>
				<a class='mood-list' id='postbox-mood-8' href='javascript:' data-option-value='8' data-option-display-value='confused'>
					<i class='ps-emoticon ps-emo-8'></i><span>confused</span>
				</a>
				<a class='mood-list' id='postbox-mood-9' href='javascript:' data-option-value='9' data-option-display-value='speechless'>
					<i class='ps-emoticon ps-emo-9'></i><span>speechless</span>
				</a>
				<a class='mood-list' id='postbox-mood-10' href='javascript:' data-option-value='10' data-option-display-value='confident'>
					<i class='ps-emoticon ps-emo-10'></i><span>confident</span>
				</a>
				<a class='mood-list' id='postbox-mood-11' href='javascript:' data-option-value='11' data-option-display-value='relaxed'>
					<i class='ps-emoticon ps-emo-11'></i><span>relaxed</span>
				</a>
				<a class='mood-list' id='postbox-mood-12' href='javascript:' data-option-value='12' data-option-display-value='strong'>
					<i class='ps-emoticon ps-emo-12'></i><span>strong</span>
				</a>
				<a class='mood-list' id='postbox-mood-13' href='javascript:' data-option-value='13' data-option-display-value='happy'>
					<i class='ps-emoticon ps-emo-13'></i><span>happy</span>
				</a>
				<a class='mood-list' id='postbox-mood-14' href='javascript:' data-option-value='14' data-option-display-value='angry'>
					<i class='ps-emoticon ps-emo-14'></i><span>angry</span>
				</a>
				<a class='mood-list' id='postbox-mood-15' href='javascript:' data-option-value='15' data-option-display-value='scared'>
					<i class='ps-emoticon ps-emo-15'></i><span>scared</span>
				</a>
				<a class='mood-list' id='postbox-mood-16' href='javascript:' data-option-value='16' data-option-display-value='sick'>
					<i class='ps-emoticon ps-emo-16'></i><span>sick</span>
				</a>
				<a class='mood-list' id='postbox-mood-17' href='javascript:' data-option-value='17' data-option-display-value='sad'>
					<i class='ps-emoticon ps-emo-17'></i><span>sad</span>
				</a>
				<a class='mood-list' id='postbox-mood-18' href='javascript:' data-option-value='18' data-option-display-value='blessed'>
					<i class='ps-emoticon ps-emo-18'></i><span>blessed</span>
				</a>
							<button id='postbox-mood-remove' class='ps-btn ps-btn-danger ps-remove-location' style='width:100%; display:none'><i class='ps-icon-remove'></i>Remove Mood</button>
						</div><div style='display:none'>
				<input type='hidden' id='postbox-mood-input' name='postbox-mood-input' value='0'>
				<span id='mood-text-string'> feeling </span>

       </div></div>

      <div id='status-post' class='ps-postbox__menu-item' style='display: none;'><div class='interaction-icon-wrapper'><a class='pstd-secondary' onclick='return;' title='Post a Status'>
<i class='ps-icon-pencil'></i>
</a>
</div></div><div id='photo-post' class='ps-postbox__menu-item' data-dz-clickable='' style='cursor:pointer;'><div class='interaction-icon-wrapper media-upload' id='media-upload-image'><a class='pstd-secondary' onclick='return;' title='Upload photos'>
<i class='ps-icon-camera'></i>
</a>
</div></div><div id='video-post' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper media-upload' id='media-upload-video'><a class='pstd-secondary' onclick='return;' title='Upload videos'>
<i class='ps-icon-youtube-play'></i>
</a>
</div></div>		</div>
		<div id='post_action_div' class='ps-postbox__action ps-postbox-action' style='display: block;'>
			<button type='button' id='cancel_button' class='ps-btn ps-btn--postbox ps-button-cancel' style='display:none;'>Cancel</button>
			<button type='button' class='ps-btn ps-btn--postbox ps-button-action postbox-submit' style='display: none;'>Post</button>
     <input id='csrf' type='hidden' name='csrf_token' value='377b9846cd53858ac76c2b33dfeaf54e'>		</div>
		<div id='uploadSize' class='ps-postbox-loading' style='margin-right: 10em;'>
		</div>
        <div class='ps-progress-bar ps-completeness-bar hidden' id='uploadprogress'>
					<span style='width:0%'></span>
				</div>
	</nav>
</div>";
	  
  }



// main header
  function main_header($page_header = "",$request_type = ""){

  	return "
     <!DOCTYPE html>
  	<html lang='en-US' class='no-js fontawesome-i2svg-active fontawesome-i2svg-complete gr__localhost'><head><style type='text/css'>.gm-err-container{height:100%;width:100%;display:table;background-color:#e0e0e0;position:relative;left:0;top:0}.gm-err-content{border-radius:1px;padding-top:0;padding-left:10%;padding-right:10%;position:static;vertical-align:middle;display:table-cell}.gm-err-content a{color:#4285f4}.gm-err-icon{text-align:center}.gm-err-title{margin:5px;margin-bottom:20px;color:#616161;font-family:Roboto,Arial,sans-serif;text-align:center;font-size:24px}.gm-err-message{margin:5px;color:#757575;font-family:Roboto,Arial,sans-serif;text-align:center;font-size:12px}.gm-err-autocomplete{padding-left:20px;background-repeat:no-repeat;background-size:15px 15px}
</style><style type='text/css'>.gm-style-pbc{transition:opacity ease-in-out;background-color:rgba(0,0,0,0.45);text-align:center}.gm-style-pbt{font-size:22px;color:white;font-family:Roboto,Arial,sans-serif;position:relative;margin:0;top:50%;-webkit-transform:translateY(-50%);-ms-transform:translateY(-50%);transform:translateY(-50%)}
</style>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width'>
 
    <title>My Project</title>

<link rel='stylesheet' href='../public/assets/css/speakup_major.css' type='text/css' media='all' async>


<link rel='stylesheet' id='peepso-site-css-04-06-css' href='../public/assets/css/speakup_minor.css' type='text/css' media='all' async>

<meta name='description' content='File Upload widget with multiple file selection, drag &amp;drop support, progress bars, validation and preview images, audio and video for jQuery. Supports cross-domain, chunked and resumable file uploads and client-side image resizing. Works with any server-side platform (PHP, Python, Ruby on Rails, Java, Node.js, Go etc.) that supports standard HTML form file uploads.'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>

<link rel='stylesheet' href='../public/assets/css/style.css' async>

<noscript></noscript>
<noscript></noscript>

<meta property='og:title' content='SpeakUp'>
<meta property='og:description' content='Come and join our community. Expand your network and get to know new people!'>
<meta property='og:image' content=''>
<meta property='og:url' content=' ://www.speakup.com/'>

<meta name='msapplication-TileImage' content=' ://demo.peepso.com/wp-content/uploads/2017/09/PeepSo_128.png'>
		<style type='text/css' id='wp-custom-css'>
.mce-ico {
    font-family: 'tinymce', Arial  !important;
}

i.mce-i-aligncenter, i.mce-i-alignjustify, i.mce-i-alignleft, i.mce-i-alignright, i.mce-i-backcolor, i.mce-i-blockquote, i.mce-i-bold, i.mce-i-bullist, i.mce-i-charmap, i.mce-i-dashicon, i.mce-i-dfw, i.mce-i-forecolor, i.mce-i-fullscreen, i.mce-i-help, i.mce-i-hr, i.mce-i-indent, i.mce-i-italic, i.mce-i-link, i.mce-i-ltr, i.mce-i-numlist, i.mce-i-outdent, i.mce-i-pastetext, i.mce-i-pasteword, i.mce-i-redo, i.mce-i-remove, i.mce-i-removeformat, i.mce-i-spellchecker, i.mce-i-strikethrough, i.mce-i-underline, i.mce-i-undo, i.mce-i-unlink, i.mce-i-wp-media-library, i.mce-i-wp_adv, i.mce-i-wp_code, i.mce-i-wp_fullscreen, i.mce-i-wp_help, i.mce-i-wp_more, i.mce-i-wp_page {
    font: 400 20px/1 dashicons !important;
}		</style>

<!--        <script type='text/javascript' src='../public/assets/js/script.js' defer></script>-->

<link rel='stylesheet' href='../public/assets/css/dropzone.min.css'>
<link rel='stylesheet' href='../public/assets/css/jquery-ui.css'>
<link rel='stylesheet' href='../public/assets/css/main_styles.css'>
<script type='text/javascript' src='../public/assets/js/jquery.js'></script>
<link rel='stylesheet' href='../public/assets/fonts/fontawesome5/css/all.css'>
<script type='text/javascript' src='../public/assets/js/comments.js'>  </script> 
	


<link rel='stylesheet' href='../public/assets/fonts/fontawesome5/all.min.css'> 
	
      
	  
	  </head>
	 
  <body class='home page-template page-template-page-tpl-community page-template-page-tpl-community-php page page-id-5 logged-in plg-peepso' id='top' data-gr-c-s-loaded='true'>
  {$request_type}
    <div class='top__button' style='display: none;'>
      <a class='btn btn--red' href='#top'><svg class='svg-inline--fa fa-angle-up fa-w-10' aria-hidden='true' data-prefix='fas' data-icon='angle-up' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 320 512' data-fa-i2svg=''><path fill='currentColor' d='M177 159.7l136 136c9.4 9.4 9.4 24.6 0 33.9l-22.6 22.6c-9.4 9.4-24.6 9.4-33.9 0L160 255.9l-96.4 96.4c-9.4 9.4-24.6 9.4-33.9 0L7 329.7c-9.4-9.4-9.4-24.6 0-33.9l136-136c9.4-9.5 24.6-9.5 34-.1z'></path></svg><!-- <i class='fas fa-angle-up'></i> --></a>
    </div>
    <div class='page__wrapper'>
    {$page_header}  

      <!-- CONTENT -->
      <div class='page__content'>

<div class='page__section page__section--community'>
  <div class='community__wrapper'>
    <div class='community__side community__side--left'>
              <div class='widget community__widget'>
	<div class='ps-widget--profile__wrapper ps-widget--external'>
		<!-- Title of Profile Widget -->

		<div class='ps-widget--profile'>

					

			<!-- Profile Completeness -->
							
				


			<!-- Profile Links -->
			<span class='ps-widget--profile__title'>My Profile</span>
			<div class='ps-widget--profile__menu'>
				<a href=' ://demo.peepso.com/profile/demo/' class=''><span class='ps-icon-home'></span> Stream</a><a href=' ://demo.peepso.com/profile/demo/about' class=''><span class='ps-icon-user'></span> About</a><a href='../private/' class=''><span class='ps-icon-users'></span>Links</a><a href=' ://demo.peepso.com/profile/demo/photos' class=''><span class='ps-icon-camera'></span> Photos</a><a href=' ://demo.peepso.com/profile/demo/videos' class=''><span class='ps-icon-videocam'></span> Videos</a>			</div>
       <div class='ps-widget--profile__menu'>
					<a href='#' id='logout_link' tabindex='0' role='button' style='border-radius:3px;'><span class='ps-icon-off' style='color:#d2578b;'></span> Log Out <img src='assets/images/ajax-loader.gif' alt='ajax loader' style='position: relative;top: 0.2em;left: 1.3em; display:none;'></a>	

   <form id='logout_form' method='POST' style='display:none;'>
   <input id='csrf' type='hidden' name='csrf_token' value='63f35ba387a5fbb49440b5afdb242d62'>   <button type='submit' id='logout_button' name='submit'></button>
   
   </form>
					</div>

		</div>
	</div>

</div><div class='widget community__widget'>


</div>          </div>
    <div class='community__main'>
            <div id='peepso-wrap' class='container-fluid'><div class='peepso ps-page--activity-post'>
    <section id='mainbody' class='ps-wrapper ps-clearfix'>
        <section id='component' role='article' class='ps-clearfix'>
            <noscript>
<div class='alert alert-error pstd-important'>
	<span style='color: #ff0000;'>Please Note:</span> SpeakUP requires the use of Javascript
	for proper operation. Please enable Javascript in order to experience the full capabilities
	of the application. You may also visit our website for
	<a href='#'>more information about enabling Javascript.</a>
	Thank you!
</div>
</noscript>
<div class='ps-toolbar ps-toolbar--desktop js-toolbar'>
  <div class='ps-toolbar__menu' title='communities(You will get more post from this community if you are part of it)'>
             <span class=''> <a href='transport.php' title='transport community'> <div class='ps-bubble__wrapper'>Transport <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='health.php' title='health community'> <div class='ps-bubble__wrapper'>Health <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 10 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='sol.php'>View All</a></div></div></span> <span class=''> <a href='sol.php' title='Standard of living'> <div class='ps-bubble__wrapper'>S.O.L <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='Security.php' title='secuirty community'> <div class='ps-bubble__wrapper'>Security<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='sanitation.php' title='sanitation community'> <div class='ps-bubble__wrapper'>Sanitation <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='work.php' title='work community'> <div class='ps-bubble__wrapper'>Work <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='other.php' title='You will get updated about all the other communities'> <div class='ps-bubble__wrapper'>Other<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href='oppresion.php' title='Friend Requests'> <div class='ps-bubble__wrapper'>Oppresion<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class=''> <a href=' ://demo.peepso.com/profile/demo/friends/requests' title='Friend Requests'> <div class='ps-bubble__wrapper'>placeholder<span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 1 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class='dropdown-notification ps-js-notifications'> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications' style='max-height: 40vh; overflow: auto;'><div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/6/avatar-full.jpg' alt='William Torres'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>William</strong>
				liked your comment on your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--150' data-id='150' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1502693781/#comment.457.933.933'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:39'><span title='2018-06-15 15:32:39'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--149' data-id='149' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505368315/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:32'><span title='2018-06-15 15:32:32'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--146' data-id='146' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/#comment.471.932.932'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your cover photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:24'><span title='2018-06-15 15:32:24'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
</div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='#' style='float: left; width: 50%;'>Mark All as Read</a><a href='#' style='float: left; width: 50%;'>Show unread only</a></div></div></span>             </div>
        </div>


<!---Labels to choose from when uploading post -->

        <div class='ps-toolbar' style='display:block;'>

            <div class='ps-toolbar__menu'>
		<span>
			<a href='javascript:' class='ps-toolbar__toggle'>
				<i class='ps-icon-menu'></i>
			</a>
		</span>
                <span class=''> <a href=' ://demo.peepso.com/activity/' title='Activity'> <div class='ps-bubble__wrapper'> <i class='ps-icon-home'></i> <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class='ps-js-friends-notification friends-notification psnotification-toggle'> <a href=' ://demo.peepso.com/profile/demo/friends/requests' title='Friend Requests'> <div class='ps-bubble__wrapper'> <i class='ps-icon-users'></i> <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> 10 </span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications ps-notifications--empty' style='max-height: 40vh; overflow: auto;'></div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href=' ://demo.peepso.com/profile/demo/friends/requests'>View All</a></div></div></span> <span class='dropdown-notification ps-js-notifications'> <a href=' ://demo.peepso.com/profile/?notifications' title='Pending Notifications'> <div class='ps-bubble__wrapper'> <i class='ps-icon-globe'></i> <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'>20</span> </div> </a> <div class='ps-popover app-box' style='display: none;'><div class='ps-notifications' style='max-height: 40vh; overflow: auto;'><div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--158' data-id='158' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1528720781/?t=1530441733#comment.482.931.493.935'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/6/avatar-full.jpg' alt='William Torres'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>William</strong>
				liked your comment on your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-25 10:01:52'><span title='2018-06-25 10:01:52'>6 days ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--150' data-id='150' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1502693781/#comment.457.933.933'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:39'><span title='2018-06-15 15:32:39'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--149' data-id='149' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505368315/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:32'><span title='2018-06-15 15:32:32'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--146' data-id='146' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/#comment.471.932.932'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				commented on your cover photo			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:24'><span title='2018-06-15 15:32:24'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
<div class='ps-notification ps-notification--unread ps-js-notification ps-js-notification--145' data-id='145' data-unread='1'>
	<a class='ps-notification__inside' href=' ://demo.peepso.com/activity/?status/2-2-1505369700/'>
		<div class='ps-notification__header'>
			<div class='ps-avatar ps-avatar--notification'>
				<img src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' alt='Andrew Simmons'>
			</div>
		</div>

		<div class='ps-notification__body'>
			<div class='ps-notification__desc'>
				<strong>Andrew</strong>
				Loved your post			</div>

			<div class='ps-notification__meta'>
				<small class='activity-post-age' data-timestamp='2018-06-15 15:32:13'><span title='2018-06-15 15:32:13'>2 weeks ago</span></small>

								<span class='ps-notification__status ps-tooltip ps-tooltip--notification ps-js-mark-as-read' data-tooltip='Mark as read' style='cursor:pointer;'>
					<i class='ps-icon-eye'></i>
					<span>Mark as read</span>
				</span>
							</div>
		</div>
	</a>
</div>
</div><div class='ps-popover-footer app-box-footer ps-clearfix'><a href='#' style='float: left; width: 50%;'>Mark All as Read</a><a href='#' style='float: left; width: 50%;'>Show unread only</a></div></div></span>             </div>

            <div id='ps-main-nav' class='ps-toolbar__submenu'>
                <span class=''> <a href=' ://demo.peepso.com/members/' title='Members'> <div class='ps-bubble__wrapper'> <i class='ps-icon-users'></i> Members <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class=''> <a href=' ://demo.peepso.com/classifieds/' title='Classifieds'> <div class='ps-bubble__wrapper'> <i class='ps-icon-bullhorn'></i> Classifieds <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class=''> <a href=' ://demo.peepso.com/groups/' title='Groups'> <div class='ps-bubble__wrapper'> <i class='ps-icon-group'></i> Groups <span class='js-counter ps-bubble ps-bubble--toolbar ps-js-counter'> </span> </div> </a> </span> <span class='ps-dropdown ps-dropdown--right ps-js-dropdown'> <a onclick='return false;' href='' class='ps-dropdown__toggle ps-js-dropdown-toggle'> <div class='ps-avatar ps-avatar--toolbar ps-avatar--xs'><img src=' ://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg' alt='Patricia Currie avatar'></div> Patricia </a> <div class='ps-dropdown__menu ps-dropdown__menu--toolbar ps-js-dropdown-menu'> <a class='' href=' ://demo.peepso.com/profile/demo/'> <i class='ps-icon-home'></i> Stream</a> <a class='' href=' ://demo.peepso.com/profile/demo/about'> <i class='ps-icon-user'></i> About</a> <a class='' href=' ://demo.peepso.com/profile/demo/classifieds'> <i class='ps-icon-bullhorn'></i> Classifieds</a> <a class='' href=' ://demo.peepso.com/profile/demo/friends'> <i class='ps-icon-users'></i> Friends</a> <a class='' href=' ://demo.peepso.com/profile/demo/groups'> <i class='ps-icon-group'></i> Groups</a> <a class='' href=' ://demo.peepso.com/profile/demo/photos'> <i class='ps-icon-camera'></i> Photos</a> <a class='' href=' ://demo.peepso.com/profile/demo/videos'> <i class='ps-icon-videocam'></i> Videos</a> <a class='' href=' ://demo.peepso.com/profile/demo/about/preferences/'> <i class='ps-icon-edit'></i> Preferences</a> <a class='' href=' ://demo.peepso.com/profile/?logout'> <i class='ps-icon-off'></i> Log Out</a> </div> </span>            </div>
        </div>


            <div class='ps-body'>
                <!--<div class='ps-sidebar'></div>-->
                <div class='ps-main ps-main-full'>

<div id='postbox-main' class='ps-postbox ps-clearfix' style=''>


    <div data-tab-id='videos'><div class='ps-postbox-videos'>
            <div class='ps-postbox-fetched'></div>
            <div style='position:relative'>
                <div class='ps-postbox-input ps-inputbox ' id='post_title'>
                    <sup class='label-error' style='font-size: 1em; top: 0.01em; right: 0em; display:none;'>Please a title is required *</sup>
                    <input class='ps-textarea ps-videos-url input' maxlength='100' placeholder='Please give a title to your post (Max: 100 characters)' style='min-height: 1.4em; text-align: center; font-size: 14px !important'>
                    <div class='ps-postbox-loading' style='display: none;'>
                        <img src='https://demo.peepso.com/wp-content/plugins/peepso-core/assets/images/ajax-loader.gif'>
                        <div>
                        </div>
                    </div>
                </div>
                <div class='ps-postbox-preview' style='display: none;'>
                </div>
            </div>
        </div></div>
    <fieldset class='labelset' style='font-family:'myfont' !important; text-align:center;'>

    <legend style='display:inline'>Please attach a label to your Post</legend>
   <small class='label-error' style='display:none;'>A label is required *</small>
    <div class='label-div' style='padding-top: 0.7%;'>
    <!--Transport Label -->
    <input type='radio' name='label' id='transport' value='transport' class='checkboxradio'>
     <label for='transport'>Transport</label>
<!--   post label for health community  -->
        <input type='radio' name='label' id='health' value='health' class='checkboxradio'>
     <label for='health'>Health</label>
<!--    post label for work community  -->
        <input type='radio' name='label' id='work' value='work' class='checkboxradio'>
     <label for='work'>Work</label>
<!--    post label for sol community  -->
        <input type='radio' name='label' id='sol' value='sol' class='checkboxradio'>
     <label for='sol'>S.O.L</label>
<!--   post label for security community  -->
        <input type='radio' name='label' id='security' value='security' class='checkboxradio'>
     <label for='security'>Security</label>
<!--  post label for sanitation community  -->
        <input type='radio' name='label' id='sanitation' value='sanitation' class='checkboxradio'>
     <label for='sanitation'>Sanitation</label>
        <!--  post label for corruption -->
        <input type='radio' name='label' id='corruption' value='corruption' class='checkboxradio'>
     <label for='corruption'>Corruption</label>
<!--     post label for other community    -->
        <input type='radio' name='label' id='other' value='other' class='checkboxradio'>
     <label for='other'>Other</label>
   </div>
      <div id='success-dialog' title='Upload Success' style='display:none;'>Please Your post is currently under going verification.It will appear in the stream very soon.<br /><b>(this may take up to 5 minutes).</b></div>
<div id='error-dialog' title='Error' style='display:none;'>Please try again</div>
       </fieldset>

    <div id='ps-postbox-status' class='ps-postbox-content'>
        <div class='ps-postbox-tabs' style='display:block;'>
            <div id='postcontent' class='dropzone dz-clickable' style='cursor: pointer; text-align: center; min-height: 0px; border: 0px; display: block;'><div class='ps-postbox-photos'>
                    <div class='ps-postbox-fetched'></div>
                    <div style='position:relative'>
                        <div id='ps-upload-container' class='ps-postbox-input ps-inputbox browse_file dz-clickable' style='cursor:pointer;'>
                            <div class='ps-postbox-photo-upload fileinput-button' id='image_upload' style='cursor:pointer;'>
                                <div class='ps-postbox-info'>
                                    <i class='ps-icon-picture'></i>
                                    <span>Click here to start uploading photos</span>
                                </div>
                                <span>Max photo dimensions: 4000 x 3000px | Max file size: 8MB</span>
                            </div>
                            <div class='ps-postbox-preview' style='display:none;'>
                                <div class='ps-js-photos-container'></div>
                            </div>
                        </div>
                    </div>
                </div>

                <div id='photo-supported-format' style='display:none;'>Supported formats are: gif, jpg, jpeg, tiff, and png.</div>
                <div id='photo-comment-label' style='display:none;'>Say something about this photo...</div>
                <div class='dz-default dz-message'><span></span></div></div><div data-tab-id='videos'><div class='ps-postbox-videos'>style='cursor:pointer'
                    <div class='ps-postbox-fetched'></div>
                    <div style='position:relative'>
                        <div id='post_title_div' class='ps-postbox-input ps-inputbox' title='Please give a short title for your post'>
                            <input class='ps-textarea ps-videos-url input' placeholder='Enter video URL here' style='min-height: 1.4em;'>
                            <div class='ps-postbox-loading' style='display: none;'>
                                <img src='assets/images/ajax-loader.gif'>
                                <div> </div>
                            </div>
                        </div>
                        <div class='ps-postbox-preview' style='display: none;'>
                        </div>
                    </div>
                </div>
            </div><div data-tab-id='polls'><div class='ps-poll__form ps-js-polls'>
                    <div class='ps-postbox-fetched'></div>
                    <div style='position:relative'>
                        <div style='position:relative'>
                            <div class='ui-sortable'>
                                <div class='ps-poll__option'>
                                    <a class='ps-btn ps-js-handle ui-sortable-handle' title='Move' href='#'><i class='ps-icon-move'></i></a>
                                    <input class='ps-input' type='text' placeholder='Option 1'>
                                    <a id='ps-delete-option' class='ps-btn ps-btn--delete' title='Delete' href='#'><i class='ps-icon-trash'></i></a>
                                </div>
                                <div class='ps-poll__option'>
                                    <a class='ps-btn ps-js-handle ui-sortable-handle' title='Move' href='#'><i class='ps-icon-move'></i></a>
                                    <input class='ps-input' type='text' placeholder='Option 2'>
                                    <a id='ps-delete-option' class='ps-btn ps-btn--delete' title='Delete' href='#'><i class='ps-icon-trash'></i></a>
                                </div>
                            </div>

                            <div class='ps-poll__actions'>
                                <button class='ps-btn ps-btn-small ps-button-action' id='ps-add-new-option'>Add new option</button>

                                <div class='ps-checkbox'>
                                    <input type='checkbox' id='allow-multiple' class='ace ace-switch ace-switch-2 allow-multiple'>
                                    <label class='lbl' for='allow-multiple'>Allow multiple options selection</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>		</div>

        <div class='ps-postbox-status' style='display: block;'>
            <div style='position:relative'>
                <div style='position:absolute'>
                    <span class='ps-postbox-mirror'></span>
                    <span class='ps-postbox-addons ' style='display: none;'>— <i class='ps-emoticon ps-emoticon ps-emo-1'></i> <b> feeling joyful</b></span>
                </div>
                <div class='ps-postbox-input ps-inputbox'>
             <div class='ps-tagging-wrapper'>
                <div class='ps-tagging-beautifier'></div>
                <textarea id='post_caption' class='ps-textarea ps-postbox-textarea ps-tagging-textarea' placeholder='You can eloborate more on the above title here(optional)...' maxlength='4000' oninput='utility.resizeTextarea(this);' style='overflow: hidden; word-wrap: break-word; resize: none; height: 20px; min-height: 20px;font-size:0.9em;'></textarea>
                <input type='hidden' class='ps-tagging-hidden'><div class='ps-tagging-dropdown'></div></div>
             </div>
            </div>
            <div class='post-charcount charcount ps-postbox-charcount'>4000</div>
        </div>

    </div>

	<div class='ps-postbox-tab ps-postbox-tab-root ps-clearfix'>

	</div>

	<nav class='ps-postbox-tab selected interactions' id='post_nav' style='display: block;'>

    <!--The beginning of the postbox inline options of people,mood,location,photo,video,etc. -->
        <div class='ps-postbox__menu' id='post_menu'>
<small class='label-error' style='height: 50%;position: relative; left: 0.1em;top: 0.9em; margin-right: .4em; display:none '>A location is required*</small>
  


<!--END OF THE PEOPLES POSTBOX ITEM -->

<div id='location-tab' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper' id='location_wrapper'><a class='pstd-secondary' onclick='return;' title='Please you need to select the location that the event occured'>
<i class='ps-icon-map-marker'></i>
</a>
</div><div id='pslocation' class='hidden ps-postbox-dropdown ps-js-postbox-location'>
<div class='ps-postbox-location ps-postbox-location-compact'>
<div class='ps-postbox-loading'>
 
<div> </div>
</div>
<div class='ps-postbox-locmap'>
<div id='pslocation-map' class='ps-postbox-map' style='overflow: hidden;'><div style='height: 100%; width: 100%; position: absolute; top: 0px; left: 0px; background-color: rgb(229, 227, 223);'><div class='gm-err-container'><div class='gm-err-content'><div class='gm-err-icon'><img src='https://maps.gstatic.com/mapfiles/api-3/images/icon_error.png' draggable='false' style='user-select: none;'></div><div class='gm-err-title'>Oops! Something went wrong.</div><div class='gm-err-message'>This page didn't load Google Maps correctly. See the JavaScript console for technical details.</div></div></div></div></div>
    <script>
        var map;
        function initMap() {
            map = new google.maps.Map(document.getElementById('pslocation-map'), {
                center: {lat: -34.397, lng: 150.644},
                zoom: 8
            });
        }

    </script>
<div class='ps-postbox-locct'>
 Enter your location:				<br>
 <input type='text' class='ps-input' name='postbox_loc_search' value='' disabled=''>
 <ul class='ps-postbox-locations'></ul>
 <div class='ps-postbox-action ps-location-action' style='display: none;'>
   <button class='ps-btn ps-btn-primary ps-add-location' style='display: inline-block;'>
     <i class='ps-icon-map-marker'></i>Select					</button>
   <button class='ps-btn ps-btn-danger ps-remove-location' style='display: none;'>
     <i class='ps-icon-remove'></i>Remove					</button>
 </div>
</div>
</div>
</div>
</div>
<div style='display: none;'>
<div id='pslocation-search-loading'>
<img src='assets/images/ajax-loader.gif' alt=''>
</div>
<div id='pslocation-in-text'></div>
</div>
</div>



<div id='mood-tab' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper' id='mood_wrapper'><a class='pstd-secondary' onclick='return;' title='Mood settings for your post'>
<i class='ps-icon-happy'></i>
</a>
</div><div id='postbox-mood' class='ps-dropdown__menu ps-dropdown__menu--moods ps-js-postbox-mood' style='display:none'>

				<a class='mood-list' id='postbox-mood-1' href='javascript:' data-option-value='1' data-option-display-value='joyful'>
					<i class='ps-emoticon ps-emo-1'></i><span>joyful</span>
				</a>
				<a class='mood-list' id='postbox-mood-2' href='javascript:' data-option-value='2' data-option-display-value='meh'>
					<i class='ps-emoticon ps-emo-2'></i><span>meh</span>
				</a>
				<a class='mood-list' id='postbox-mood-3' href='javascript:' data-option-value='3' data-option-display-value='love'>
					<i class='ps-emoticon ps-emo-3'></i><span>love</span>
				</a>
				<a class='mood-list' id='postbox-mood-4' href='javascript:' data-option-value='4' data-option-display-value='flattered'>
					<i class='ps-emoticon ps-emo-4'></i><span>flattered</span>
				</a>
				<a class='mood-list' id='postbox-mood-5' href='javascript:' data-option-value='5' data-option-display-value='crazy'>
					<i class='ps-emoticon ps-emo-5'></i><span>crazy</span>
				</a>
				<a class='mood-list' id='postbox-mood-6' href='javascript:' data-option-value='6' data-option-display-value='cool'>
					<i class='ps-emoticon ps-emo-6'></i><span>cool</span>
				</a>
				<a class='mood-list' id='postbox-mood-7' href='javascript:' data-option-value='7' data-option-display-value='tired'>
					<i class='ps-emoticon ps-emo-7'></i><span>tired</span>
				</a>
				<a class='mood-list' id='postbox-mood-8' href='javascript:' data-option-value='8' data-option-display-value='confused'>
					<i class='ps-emoticon ps-emo-8'></i><span>confused</span>
				</a>
				<a class='mood-list' id='postbox-mood-9' href='javascript:' data-option-value='9' data-option-display-value='speechless'>
					<i class='ps-emoticon ps-emo-9'></i><span>speechless</span>
				</a>
				<a class='mood-list' id='postbox-mood-10' href='javascript:' data-option-value='10' data-option-display-value='confident'>
					<i class='ps-emoticon ps-emo-10'></i><span>confident</span>
				</a>
				<a class='mood-list' id='postbox-mood-11' href='javascript:' data-option-value='11' data-option-display-value='relaxed'>
					<i class='ps-emoticon ps-emo-11'></i><span>relaxed</span>
				</a>
				<a class='mood-list' id='postbox-mood-12' href='javascript:' data-option-value='12' data-option-display-value='strong'>
					<i class='ps-emoticon ps-emo-12'></i><span>strong</span>
				</a>
				<a class='mood-list' id='postbox-mood-13' href='javascript:' data-option-value='13' data-option-display-value='happy'>
					<i class='ps-emoticon ps-emo-13'></i><span>happy</span>
				</a>
				<a class='mood-list' id='postbox-mood-14' href='javascript:' data-option-value='14' data-option-display-value='angry'>
					<i class='ps-emoticon ps-emo-14'></i><span>angry</span>
				</a>
				<a class='mood-list' id='postbox-mood-15' href='javascript:' data-option-value='15' data-option-display-value='scared'>
					<i class='ps-emoticon ps-emo-15'></i><span>scared</span>
				</a>
				<a class='mood-list' id='postbox-mood-16' href='javascript:' data-option-value='16' data-option-display-value='sick'>
					<i class='ps-emoticon ps-emo-16'></i><span>sick</span>
				</a>
				<a class='mood-list' id='postbox-mood-17' href='javascript:' data-option-value='17' data-option-display-value='sad'>
					<i class='ps-emoticon ps-emo-17'></i><span>sad</span>
				</a>
				<a class='mood-list' id='postbox-mood-18' href='javascript:' data-option-value='18' data-option-display-value='blessed'>
					<i class='ps-emoticon ps-emo-18'></i><span>blessed</span>
				</a>
							<button id='postbox-mood-remove' class='ps-btn ps-btn-danger ps-remove-location' style='width:100%; display:none'><i class='ps-icon-remove'></i>Remove Mood</button>
						</div><div style='display:none'>
				<input type='hidden' id='postbox-mood-input' name='postbox-mood-input' value='0'>
				<span id='mood-text-string'> feeling </span>

       </div></div>

      <div id='status-post' class='ps-postbox__menu-item' style='display: none;'><div class='interaction-icon-wrapper'><a class='pstd-secondary' onclick='return;' title='Post a Status'>
<i class='ps-icon-pencil'></i>
</a>
</div></div><div id='photo-post' class='ps-postbox__menu-item' data-dz-clickable='' style='cursor:pointer;'><div class='interaction-icon-wrapper media-upload' id='media-upload-image'><a class='pstd-secondary' onclick='return;' title='Upload photos'>
<i class='ps-icon-camera'></i>
</a>
</div></div><div id='video-post' class='ps-postbox__menu-item'><div class='interaction-icon-wrapper media-upload' id='media-upload-video'><a class='pstd-secondary' onclick='return;' title='Upload videos'>
<i class='ps-icon-youtube-play'></i>
</a>
</div></div>		</div>
		<div id='post_action_div' class='ps-postbox__action ps-postbox-action' style='display: block;'>
			<button type='button' id='cancel_button' class='ps-btn ps-btn--postbox ps-button-cancel' style='display:none;'>Cancel</button>
			<button type='button' class='ps-btn ps-btn--postbox ps-button-action postbox-submit' style='display: none;'>Post</button>
     <input id='csrf' type='hidden' name='csrf_token' value='492034218df84f0918ffc814b7652446'>		</div>
		<div id='uploadSize' class='ps-postbox-loading' style='margin-right: 10em;'>
		</div>
        <div class='ps-progress-bar ps-completeness-bar hidden' id='uploadprogress'>
					<span style='width:0%'></span>
				</div>
	</nav>
</div>
<div class='ps-stream__filters'>
    
    <input type='hidden' id='deactivate_scroll' value='activate' />
  
<span class='ps-dropdown ps-dropdown--stream-filter ps-js-dropdown ps-js-activitystream-filter' data-id='peepso_stream_filter_show_my_posts'>
	<button class='ps-btn ps-btn--small ps-js-dropdown-toggle' aria-haspopup='true' onclick='stream.getSelfStream(\"self\",this);'>
		<span>Show my posts</span>
		<img class='buttons_loader' src='assets/images/ajax-loader.gif' alt='' />
	</button>
	<div role='menu' class='ps-dropdown__menu ps-js-dropdown-menu'>
				<a role='menuitem' class='ps-dropdown__group' data-option-value='1'>
      <div class='ps-checkbox ps-dropdown__group-title'>
        <input type='radio' name='peepso_stream_filter_show_my_posts' id='peepso_stream_filter_show_my_posts_opt_1' value='1' checked=''>
  			<label for='peepso_stream_filter_show_my_posts_opt_1'>
          <span>Show my posts</span>
  			</label>
      </div>
		</a>
				<a role='menuitem' class='ps-dropdown__group' data-option-value='0'>
      <div class='ps-checkbox ps-dropdown__group-title'>
        <input type='radio' name='peepso_stream_filter_show_my_posts' id='peepso_stream_filter_show_my_posts_opt_0' value='0'>
  			<label for='peepso_stream_filter_show_my_posts_opt_0'>
          <span>Hide my posts</span>
  			</label>
      </div>
		</a>
				<div class='ps-dropdown__actions'>
			<button class='ps-btn ps-btn--small ps-js-cancel'>Cancel</button>
			<button class='ps-btn ps-btn--small ps-btn-primary ps-js-apply'>Apply</button>
		</div>
	</div>
</span>

<span class='ps-dropdown ps-dropdown--stream-filter ps-js-dropdown ps-js-activitystream-filter' data-id='peepso_search'>
	<a class='ps-btn ps-btn--small ps-js-dropdown-toggle' aria-haspopup='true' aria-label='Search'>
		<i class='ps-icon-search'></i>
		<span data-empty='' data-keyword='Search: '></span>
	</a>
	<div role='menu' class='ps-dropdown__menu ps-js-dropdown-menu'>
		<div class='ps-dropdown__actions'>
			<input type='text' id='ps-activitystream-search' class='ps-input ps-input--small ps-full' placeholder='Type to search' value=''>
		</div>

		<a role='menuitem' class='ps-dropdown__group' data-option-value='exact'>
			<div class='ps-checkbox ps-dropdown__group-title'>
				<input type='radio' name='peepso_search' id='peepso_search_opt_exact' value='exact' checked=''>
				<label for='peepso_search_opt_exact'>
					<span>Exact phrase</span>
				</label>
			</div>
		</a>
		<a role='menuitem' class='ps-dropdown__group' data-option-value='any'>
			<div class='ps-checkbox ps-dropdown__group-title'>
				<input type='radio' name='peepso_search' id='peepso_search_opt_any' value='any'>
				<label for='peepso_search_opt_any'>
					<span>Any of the words</span>
				</label>
			</div>
		</a>
		<div class='ps-dropdown__actions'>
			<button class='ps-btn ps-btn--small ps-js-cancel'>Cancel</button>
			<button class='ps-btn ps-btn--small ps-btn-primary ps-js-search'>Search</button>
		</div>
	</div>
</span>

<input type='hidden' id='peepso_search_hashtag' value=''>
<span class='ps-dropdown ps-dropdown--stream-filter ps-js-dropdown ps-js-activitystream-filter' data-id='peepso_search_hashtag'>
	<a class='ps-btn ps-btn--small ps-js-dropdown-toggle' aria-haspopup='true' style='vertical-align:top'>
		<span data-empty='#' data-keyword='#'>#</span>
	</a>
	<div role='menu' class='ps-dropdown__menu ps-js-dropdown-menu'>
		<div class='ps-dropdown__actions'>
			#<input maxlength='16' type='text' class='ps-input ps-input--small ps-full' placeholder='Type to search' value=''>
        </div>
        <div class='ps-dropdown__desc'>
        	<i class='ps-icon-info-circled'></i>
            Letters and numbers only, minimum 3 and maximum 16 character(s)		</div>
		<div class='ps-dropdown__actions'>
			<button class='ps-btn ps-btn--small ps-js-cancel'>Cancel</button>
			<button class='ps-btn ps-btn--small ps-btn-primary ps-js-search-hashtag' disabled='disabled'>Apply</button>
		</div>
	</div>
</span>
</div>

                 <!-- stream activity -->
                    <div class='ps-stream-wrapper'>
                        <div id='ps-activitystream-recent' class='ps-stream-container' style='display:none'></div>
     <div id='ps-activitystream' class='ps-stream-container' style=''>";
  
  }//main_header();




// main footer 
  function main_footer($page_footer = ""){



  	return "<div id='modal-wrapper' class='modal' style='display: none;'>
  

  
  
  <div id='registration' class='ps-landing-action'>
<div class='alert alert-danger' id='login_err' role='alert' style='display:none;'>
 <button type='button' class='close' data-dismiss='alert' id='close' aria-label='Close'>
    <span aria-hidden='true'>×</span>
  </button>
</div>
<script>
      $('#close').click(function(){
        $('#login_err').toggle();    
      });
</script>
            
  <div class='login-area'>
<form class='ps-form ps-js-form-login' method='post' name='login' id='form'>
   <!--<input id='csrf' type='hidden' name='csrf_token' value='15a6b97e16503f7789a1e98b4ae29039'>
   --><div class='ps-landing-form'> 
        <div class='ps-form-input ps-form-input-icon'>
          <span class='ps-icon'><i class='ps-icon-user'></i></span>
          <input class='ps-input' type='text' id='login_box_email' name='email' placeholder='Email' mouseev='true' autocomplete='off' keyev='true' clickev='true'>
        </div>
        <div class='ps-form-input ps-form-input-icon'>
          <span class='ps-icon'><i class='ps-icon-lock'></i></span>
          <input class='ps-input' id='login_box_password' type='password' name='password' placeholder='Password' mouseev='true' autocomplete='off' keyev='true' clickev='true'>
        </div>
        <div class='ps-form-input ps-form-input--button'>
          <button type='submit' name='submit' onclick='utility.loginWithLoginBox(this);' class='ps-btn ps-btn-login'>
            <span>Login</span>
            <img style='display:none' src='assets/images/ajax-loader.gif'>
          </button>
        </div>
</div>
<div class='ps-checkbox'>
        <input type='checkbox' alt='Remember Me' value='yes' id='remember' name='remember'>
        <label for='remember'>Remember Me</label>
      </div>
      <a class='ps-link ps-link--recover' href='signup.php'>Recover Password</a>
        <a class='ps-link ps-link--recover' href='signup.php'>Register</a>
            <a class='ps-link ps-link--activation ps-js-register-activation' href='https://demo.peepso.com/register/?resend' style='display: none;'>Resend activation code</a>
            <!-- Alert -->
      <div class='errlogin calert clear alert-error' style='display:none'></div>
          </form>
     </div>
</div>
</div>

<script>
// If user clicks anywhere outside of the modal, Modal will close

var modal = document.getElementById('modal-wrapper');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = 'none';
    }
}
</script>

                        
    <!--First Post Display -->
    


</div>

<div id='ps-activitystream-loading' style=''>
                            <div class='ps-stream ps-stream--placeholder'>
    <div class='ps-animated-background'>
        <div class='ps-background-masker ps-header-top'></div>
        <div class='ps-background-masker ps-header-left'></div>
        <div class='ps-background-masker ps-header-right'></div>
        <div class='ps-background-masker ps-header-bottom'></div>
        <div class='ps-background-masker ps-subheader-left'></div>
        <div class='ps-background-masker ps-subheader-right'></div>
        <div class='ps-background-masker ps-subheader-bottom'></div>
        <div class='ps-background-masker ps-content-top'></div>
        <div class='ps-background-masker ps-content-first-end'></div>
        <div class='ps-background-masker ps-content-second-line'></div>
        <div class='ps-background-masker ps-content-second-end'></div>
        <div class='ps-background-masker ps-content-third-line'></div>
        <div class='ps-background-masker ps-content-third-end'></div>
    </div>
</div>
                        </div>

                        <div id='ps-no-posts' class='ps-alert' style='display:none'>No posts found. Be the first one to share something amazing!</div>
                        <div id='ps-no-posts-match' class='ps-alert' style='display:none'>No posts found.</div>
                        <div id='ps-no-more-posts' class='ps-alert' style='display:none'>Nothing more to show.</div>

                        <div id='ps-dialogs' style='display:none'>
	<div id='ajax-loader-gif' style='display:none;'>
		<div class='ps-loading-image'>
			<img src='assets/images/ajax-loader.gif' alt=''>
			<div> </div>
		</div>
	</div>
	<div id='ps-dialog-comment'>
		<div data-type='stream-newcomment' class='cstream-form stream-form wallform ' data-formblock='true' style='display: block;'>
            <form>
            <input id='myform' type='hidden' name='hidden' value='csrf'>
            </form>
			<form class='reset-gap'>
				<div class='cstream-form-submit'>
					<a data-action='cancel' onclick='return activity.comment_cancel();' class='ps-btn ps-btn-small cstream-form-cancel' href='javascript:'>Cancel</a>
					<button data-action='save' onclick='return activity.comment_save();' class='ps-btn ps-btn-small ps-btn-primary'>Post Comment</button>
				</div>
			</form>
		</div>
	</div>

	<div id='ps-report-dialog'>
		<div id='activity-report-title'>Report Content to Admin</div>
		<div id='activity-report-content'>
			<div id='postbox-report-popup'>
				<div>Reason for Report:</div>
				<div class='ps-text--danger'><select class='ps-select ps-full ps-js-report-type'>
<option value=''>- select reason -</option>
<option value='Spamming'>Spamming</option><option value='Advertisement'>Advertisement</option><option value='Profanity'>Profanity</option><option value='Inappropriate Content/Abusive'>Inappropriate Content/Abusive</option><option value='Other' data-need-reason='1'>Other</option></select>
<div class='ps-js-report-desc' style='position:relative; margin-top:10px'><textarea class='ps-textarea ps-full' maxlength='250' placeholder='Report description...'></textarea><div class='ps-charcount ps-charcount--input ps-js-counter'></div></div><div class='ps-alert ps-alert-danger ps-js-report-error' style='margin:10px 0 0; display:none'></div></div>
				<div class='ps-alert' style='display:none'></div>
				<input type='hidden' id='postbox-post-id' name='post_id' value='{post-id}'>
			</div>
		</div>
		<div id='activity-report-actions'>
			<button type='button' name='rep_cacel' class='ps-btn ps-btn-small ps-button-cancel' onclick='pswindow.hide(); return false;'>Cancel</button>
			<button type='button' name='rep_submit' class='ps-btn ps-btn-small ps-button-action' onclick='activity.submit_report(); return false;'>Submit Report</button>
		</div>
	</div>

	<span id='report-error-select-reason'>ERROR: Please select Reason for Report.</span>
	<span id='report-error-empty-reason'>ERROR: Please fill Reason for Report.</span>

	<div id='ps-share-dialog'>
		<div id='share-dialog-title'>Share This</div>
		<div id='share-dialog-content'>
			<h5 class='reset-gap'>Share this via Link:</h5>
			<div class='ps-list ps-list--share'>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://www.facebook.com/sharer.php?u={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--facebook'>Facebook</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url= ://delicious.com/save?url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--delicious'>del.icio.us</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://digg.com/submit?phase=2&amp;url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--digg'>Digg</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url= ://www.stumbleupon.com/submit?url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--stumbleupon'>StumbleUpon</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://blinklist.com/blink?u={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--blinklist'>Blinklist</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url= ://plus.google.com/share?url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--googleplus'>Google+</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url= ://www.diigo.com/post?url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--diigo'>Diigo</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url= ://myspace.com/post?l=2&amp;u={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--myspace'>Myspace</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url= ://twitter.com/share?url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--twitter'>Twitter</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://blogmarks.net/my/new.php?mini=1&amp;url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--blogmarks'>Blogmarks</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://lifestream.aol.com/share/?url={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--lifestream'>Lifestream</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://www.linkedin.com/shareArticle?mini=true&amp;url={peepso-url}&amp;source=PeepSo+Demo' target='_blank'>
<span class='ps-share__icon ps-share__icon--linkedin'>LinkedIn</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://www.newsvine.com/_tools/seed&amp;save?popoff=0&amp;u={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--newsvine'>Newsvine</span>
</a>
<a class='ps-list__item' href=' ://demo.peepso.com/external-link/?url=http://www.google.com/bookmarks/mark?op=edit&amp;bkmk={peepso-url}' target='_blank'>
<span class='ps-share__icon ps-share__icon--google'>Google Bookmarks</span>
</a>
</div>
			<div class='ps-clearfix'></div>
		</div>
	</div>

	<div id='default-delete-dialog'>
		<div id='default-delete-title'>Confirm Delete</div>
		<div id='default-delete-content'>
			Are you sure you want to delete this?		</div>
		<div id='default-delete-actions'>
			<button type='button' class='ps-btn ps-btn-small ps-button-cancel' onclick='pswindow.hide(); return false;'>Cancel</button>
			<button type='button' class='ps-btn ps-btn-small ps-button-action' onclick='pswindow.do_delete();'>Delete</button>
		</div>
	</div>

	<div id='default-acknowledge-dialog'>
		<div id='default-acknowledge-title'>Confirm</div>
		<div id='default-acknowledge-content'>
			<div>{content}</div>
		</div>
		<div id='default-acknowledge-actions'>
			<button type='button' class='ps-btn ps-btn-small ps-button-action' onclick='return pswindow.hide();'>Okay</button>
		</div>
	</div>

	<div id='ps-profile-delete-dialog'>
		<div id='profile-delete-title'>Confirm Delete</div>
		<div id='profile-delete-content'>
			<div>
				<h4 class='ps-page__body-title'>Are you sure you want to delete your Profile?</h4>

				<p>This will remove all of your posts, saved information and delete your account.</p>

				<p><em class='ps-text--danger'>The delete cannot be undone.</em></p>

				<button type='button' name='rep_cacel' class='ps-btn ps-button-cancel' onclick='pswindow.hide(); return false;'>Cancel</button>
				&nbsp;
				<button type='button' name='rep_submit' class='ps-btn ps-button-action' onclick='profile.delete_profile_action(); return false;'>Delete My Profile</button>
			</div>
		</div>
	</div>

	<div id='repost-dialog'>
	<div class='dialog-title'>
		Share This Post	</div>
	<div class='dialog-content'>
		<div class='ps-postbox-input ps-inputbox'>
			<textarea id='share-post-box' class='ps-textarea' placeholder='SpeakUp about a particular  ...'></textarea>
		</div>
		<div class='ps-gap'></div>
		<div class='ps-share-status-preview ps-clearfix'>
			<div class='ps-dropdown ps-privacy-dropdown ps-stream-privacy ps-js-dropdown ps-js-dropdown--privacy'>
				<button class='ps-btn ps-btn-small ps-dropdown__toggle ps-js-dropdown-toggle' data-value=''>
					<span class='dropdown-value'><i class='ps-icon-globe'></i></span>
					<span>▾</span>
				</button>
				<input type='hidden' id='repost_acc' name='repost_acc' value='10'>
				<div class='ps-dropdown__menu ps-js-dropdown-menu'><a href='javascript:' data-option-value='10' onclick='return '><i class='ps-icon-globe'></i><span>Public</span></a><a href='javascript:' data-option-value='20' onclick='return '><i class='ps-icon-users'></i><span>Site Members</span></a><a href='javascript:' data-option-value='30' onclick='return '><i class='ps-icon-user2'></i><span>Friends Only</span></a><a href='javascript:' data-option-value='40' onclick='return '><i class='ps-icon-lock'></i><span>Only Me</span></a></div>			</div>
			<input type='hidden' id='postbox-post-id' name='post_id' value='{post-id}'>
			<div class='ps-gap'></div>
	      	<div class='ps-share-status-inner ps-text--muted'>
    	        <span class='ps-share-status-content'>
    	        	{post-content}
    	        </span>
	      	</div>
	    </div>
	</div>
	<div class='dialog-action'>
		<button type='button' name='rep_cacel' class='ps-btn ps-btn-small ps-button-cancel' onclick='pswindow.hide(); return false;'>Cancel</button>
		<button type='button' name='rep_submit' class='ps-btn ps-btn-small ps-button-action' onclick='activity.submit_repost(); return false;'>Share</button>
	</div>
</div>
	<div id='ps-member-search-html' class='ps-form'>
	<div class='ps-form-row'>
        <input value='' type='search' name='query' class='ps-input ps-full' placeholder='Start typing to search…'>
        <input type='hidden' id='_wpnonce' name='_wpnonce' value='8d08e22f9f'><input type='hidden' name='_wp_http_referer' value='/'>	</div>
	<div class='ps-padding ps-text--center hidden member-search-notice'>
		No results found.	</div>
</div>
	</div>
                    </div>
                </div>
            </div>
        </section><!--end component-->
    </section><!--end mainbody-->
</div><!--end row-->
<div class='ps-clearfix'></div></div>
          </div>
    <div class='community__side community__side--right'>
          <div class='widget community__widget'>
<div class='ps-widget__wrapper--external ps-widget--external'>
    <div class='ps-widget__header--external'>
        <h3>Latest Community Photos</h3>    </div>
    <div class='ps-widget__body--external'>
        <div class='ps-widget--photos'>
                    <div class='ps-widget__photos'>
            <div class='ps-widget__photos-item ps-js-photo' data-post-id='936'>
	<a data-id='498' href='javascript:' rel='post-936' onclick='ps_comments.open(202, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/4/photos/thumbs/70640a470d2dc15316ba72aba3217b6d_s_s.jpg' title='70640a470d2dc15316ba72aba3217b6d.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='937'>
	<a data-id='500' href='javascript:' rel='post-937' onclick='ps_comments.open(203, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/4/photos/thumbs/efdf37f9f321058da933d99689b53b56_s_s.jpg' title='efdf37f9f321058da933d99689b53b56.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(192, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/9c82616225c5528674c7ea8356d77535_s_s.jpg' title='9c82616225c5528674c7ea8356d77535.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(193, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/74a44b916c14e35205e478a5c7a628df_s_s.jpg' title='74a44b916c14e35205e478a5c7a628df.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(194, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/9a45d90e5bcaa0265b925bf1f14cb6c3_s_s.jpg' title='9a45d90e5bcaa0265b925bf1f14cb6c3.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(195, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/15598b15256036969d4491f68db09291_s_s.jpg' title='15598b15256036969d4491f68db09291.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(196, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/f8b8c8df5a87be458b26af9de27a3726_s_s.jpg' title='f8b8c8df5a87be458b26af9de27a3726.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(197, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/99f0c9db0c47bcbb8547f715e8b5b077_s_s.jpg' title='99f0c9db0c47bcbb8547f715e8b5b077.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(198, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/6fbfb103b71552812d15660baf571b20_s_s.jpg' title='6fbfb103b71552812d15660baf571b20.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(199, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/1a0404c47115f89b03dc6014c886828b_s_s.jpg' title='1a0404c47115f89b03dc6014c886828b.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(200, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/44ac221e456bbe980d831f783ee7768a_s_s.jpg' title='44ac221e456bbe980d831f783ee7768a.jpg' alt=''>
	</a>
</div>
<div class='ps-widget__photos-item ps-js-photo' data-post-id='930'>
	<a data-id='482' href='javascript:' rel='post-930' onclick='ps_comments.open(201, 'photo', { nonav: 1 }); return false;'>
		<img src=' ://demo.peepso.com/wp-content/peepso/users/2/photos/thumbs/655b536fd174a7b229c298025ef81177_s_s.jpg' title='655b536fd174a7b229c298025ef81177.jpg' alt=''>
	</a>
</div>
            </div>
                </div>
    </div>
</div>

</div><div class='widget community__widget'>
<div class='ps-widget__wrapper--external ps-widget--external'>
    <div class='ps-widget__header--external'>
        <h3>Community Videos</h3>    </div>


    <div class='ps-widget__body--external'>
        <div class='ps-widget--videos'>
                    <div class='ps-widget__videos'>
            <div class='ps-widget__videos-item ps-video-wrapper ps-js-video' data-post-id='590'>
    <div class='ps-video-item'>
        <a href='javascript:void()' onclick='ps_comments.open('590', 'video'); return false;'>
            <img src=' ://i.ytimg.com/vi/mMgHsufmjEA/hqdefault.jpg'>
            <i class='ps-icon-youtube-play ps-video-play'></i>
        </a>
    </div>
</div>
<div class='ps-widget__videos-item ps-video-wrapper ps-js-video' data-post-id='589'>
    <div class='ps-video-item'>
        <a href='javascript:void()' onclick='ps_comments.open('589', 'video'); return false;'>
            <img src=' ://i.ytimg.com/vi/zEUG3_Zh-rw/hqdefault.jpg'>
            <i class='ps-icon-youtube-play ps-video-play'></i>
        </a>
    </div>
</div>
<div class='ps-widget__videos-item ps-video-wrapper ps-js-video' data-post-id='513'>
    <div class='ps-video-item'>
        <a href='javascript:void()' onclick='ps_comments.open('513', 'video'); return false;'>
            <img src=' ://i.ytimg.com/vi/kukI2LnxrqY/hqdefault.jpg'>
            <i class='ps-icon-youtube-play ps-video-play'></i>
        </a>
    </div>
</div>
<div class='ps-widget__videos-item ps-video-wrapper ps-js-video' data-post-id='359'>
    <div class='ps-video-item'>
        <a href='javascript:void()' onclick='ps_comments.open('359', 'video'); return false;'>
            <img src=' ://i.ytimg.com/vi/xV7Ha3VDbzE/hqdefault.jpg'>
            <i class='ps-icon-youtube-play ps-video-play'></i>
        </a>
    </div>
</div>
            </div>
                </div>
    </div>
</div>

</div><div class='widget community__widget'><div class='ps-widget--members__wrapper ps-widget__wrapper--external ps-widget--external ps-js-widget-latest-members ps-js-initialized' data-hideempty='0' data-totalmember='0' data-limit='12'>

    <div class='ps-widget__header--external'>
        <h3>Latest Members</h3>    </div>
    <div class='ps-widget__body--external'>
        <div class='ps-widget--members ps-js-widget-content' id='peepso-latest-members-29150bb2319c182c944841c74d2f8d75'><div class='ps-widget__members'><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/paul/' title='Paul Derby'>				<img alt='Paul Derby avatar' src=' ://demo.peepso.com/wp-content/peepso/users/12/fdafa667df-avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/eric/' title='Eric Tracz'>				<img alt='Eric Tracz avatar' src=' ://demo.peepso.com/wp-content/peepso/users/10/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/thomas/' title='Thomas A Anderson'>				<img alt='Thomas A Anderson avatar' src=' ://demo.peepso.com/wp-content/peepso/users/9/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/andrew/' title='Andrew Simmons'>				<img alt='Andrew Simmons avatar' src=' ://demo.peepso.com/wp-content/peepso/users/8/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/andrea/' title='Andrea Greer'>				<img alt='Andrea Greer avatar' src=' ://demo.peepso.com/wp-content/peepso/users/7/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/william/' title='William Torres'>				<img alt='William Torres avatar' src=' ://demo.peepso.com/wp-content/peepso/users/6/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/dena/' title='Dena Segal'>				<img alt='Dena Segal avatar' src=' ://demo.peepso.com/wp-content/peepso/users/5/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/amy/' title='Amy Doyle'>				<img alt='Amy Doyle avatar' src=' ://demo.peepso.com/wp-content/peepso/users/4/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/gregory/' title='Gregory Jones'>				<img alt='Gregory Jones avatar' src=' ://demo.peepso.com/wp-content/peepso/users/3/avatar-full.jpg' class='ps-name-tips'> </a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/demo/' title='Patricia Currie'>				<img alt='Patricia Currie avatar' src=' ://demo.peepso.com/wp-content/peepso/users/2/avatar-full.jpg' class='ps-name-tips'> <span data-tooltip='Patricia Currie is currently online' class='ps-tooltip ps-tooltip--online ps-user__status ps-icon-circle ps-user__status--member'></span></a></div><div class='ps-widget__members-item'><a class='ps-avatar ps-avatar--full' href=' ://demo.peepso.com/profile/admin/' title='Community Admin'>				<img alt='Community Admin avatar' src=' ://demo.peepso.com/wp-content/peepso/users/1/717bd395c2-avatar-full.jpg' class='ps-name-tips'> </a></div></div></div>
    </div>

</div></div>          </div>
  </div></div>
</div>


</div><!-- CLOSE PAGE CONTENT -->




<div id='menu' class='modal modal--menu' style='display:none;'>
  <div class='modal__content'>
    <ul class='modal__menu'>
      <li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-home menu-item-149'><a href=' ://demo.peepso.com/'>Community</a></li>
<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-148'><a href=' ://demo.peepso.com/profile/'>Profile</a></li>
<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-663'><a href=' ://demo.peepso.com/members/'>Members</a></li>
<li class='menu-item menu-item-type-post_type menu-item-object-page menu-item-664'><a href=' ://demo.peepso.com/classifieds/'>Classifieds</a></li>
<li class='menu-item menu-item-type-custom menu-item-object-custom menu-item-150'><a target='_blank' href='/wp-admin/'>Login to Admin</a></li>
      <li>
        <a href=' ://www.peepso.com/my-account/'><svg class='svg-inline--fa fa-user-circle fa-w-16' aria-hidden='true' data-prefix='fas' data-icon='user-circle' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 496 512' data-fa-i2svg=''><path fill='currentColor' d='M248 8C111 8 0 119 0 256s111 248 248 248 248-111 248-248S385 8 248 8zm0 96c48.6 0 88 39.4 88 88s-39.4 88-88 88-88-39.4-88-88 39.4-88 88-88zm0 344c-58.7 0-111.3-26.6-146.5-68.2 18.8-35.4 55.6-59.8 98.5-59.8 2.4 0 4.8.4 7.1 1.1 13 4.2 26.6 6.9 40.9 6.9 14.3 0 28-2.7 40.9-6.9 2.3-.7 4.7-1.1 7.1-1.1 42.9 0 79.7 24.4 98.5 59.8C359.3 421.4 306.7 448 248 448z'></path></svg><!-- <i class='fas fa-user-circle'></i> --> My Account</a>
      </li>
              <li><a href=' ://demo.peepso.com/wp-login.php?action=logout&amp;_wpnonce=5281523fcf'><svg class='svg-inline--fa fa-sign-out-alt fa-w-16' aria-hidden='true' data-prefix='fas' data-icon='sign-out-alt' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M497 273L329 441c-15 15-41 4.5-41-17v-96H152c-13.3 0-24-10.7-24-24v-96c0-13.3 10.7-24 24-24h136V88c0-21.4 25.9-32 41-17l168 168c9.3 9.4 9.3 24.6 0 34zM192 436v-40c0-6.6-5.4-12-12-12H96c-17.7 0-32-14.3-32-32V160c0-17.7 14.3-32 32-32h84c6.6 0 12-5.4 12-12V76c0-6.6-5.4-12-12-12H96c-53 0-96 43-96 96v192c0 53 43 96 96 96h84c6.6 0 12-5.4 12-12z'></path></svg><!-- <i class='fas fa-sign-out-alt'></i> --> Logout</a></li>
          </ul>
    <a class='modal__close' href='javascript:'>
      <svg class='svg-inline--fa fa-times-circle fa-w-16' aria-hidden='true' data-prefix='fas' data-icon='times-circle' role='img' xmlns='http://www.w3.org/2000/svg' viewBox='0 0 512 512' data-fa-i2svg=''><path fill='currentColor' d='M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm121.6 313.1c4.7 4.7 4.7 12.3 0 17L338 377.6c-4.7 4.7-12.3 4.7-17 0L256 312l-65.1 65.6c-4.7 4.7-12.3 4.7-17 0L134.4 338c-4.7-4.7-4.7-12.3 0-17l65.6-65-65.6-65.1c-4.7-4.7-4.7-12.3 0-17l39.6-39.6c4.7-4.7 12.3-4.7 17 0l65 65.7 65.1-65.6c4.7-4.7 12.3-4.7 17 0l39.6 39.6c4.7 4.7 4.7 12.3 0 17L312 256l65.6 65.1z'></path></svg><!-- <i class='fas fa-times-circle'></i> -->
    </a>
  </div>
</div>

<!--beginning of comment template-->

<div id='comment_template' class='ps-comment-item cstream-comment stream-comment' data-comment-id='935' style='display:none;'>
	

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href=' ://demo.peepso.com/profile/demo/'>Patricia Currie</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p><a href=' ://demo.peepso.com/profile/andrew/' title='Andrew Simmons'>Andrew</a> yes! That's the first one we saw. But trust me, it's not nearly as empty as the gif shows. There's a lot of tourists. </p></div></span>
		</div>

		<div data-type='stream-more' class='cstream-more' data-commentmore='true'></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small class='activity-post-age' data-timestamp='1529076871'><span class='ps-js-autotime' data-timestamp='1529076871' title='June 15, 2018 3:34 pm'>2 weeks ago</span></small>

						<div id='act-like-497' class='ps-comment-links cstream-likes ps-js-act-like--497' data-count='1'>
				<a onclick='return activity.show_likes(497);' href='#showLikes'>1 person likes this</a>			</div>

			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a data-stream-id='935' onclick='activity.comment_action_like(this, 497); return false;' href='#like' class='actaction-like ps-icon-thumbs-up'><span><span title='1 person likes this'>Like</span></span></a>
<a data-stream-id='935' onclick='activity.comment_action_reply(497, 935, this, { id: 2, name: 'Patricia Currie' }); return false;' href='#reply' class='actaction-reply ps-icon-plus'><span>Reply</span></a>
<a data-stream-id='935' onclick='activity.comment_action_edit(935, this); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a data-stream-id='935' onclick='comment.delete_comment(); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>

<!--end of comment template-->

 <!-- the beginning of reply template -->

<div id='reply_wall_template' class='ps-comment reply-wall ps-comment-nested ps-js-comment-reply--506'>
	<div class='ps-comment-container comment-container ps-js-comment-container ps-js-comment-container--2' data-act-id='2'>
			<div id='reply-item-' class='ps-comment-item cstream-comment stream-comment' data-comment-id='1120' style='display:none;'>
	

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href='' data-hover-card='2'> Patricia Currie</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p>okay lets see how the css is like here</p></div></span>
		</div>

		<div data-type='stream-more' class='cstream-more' data-commentmore='true'></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small class='activity-post-age' data-timestamp='1547457853'><span class='ps-js-autotime' data-timestamp='1547457853' title='January 14, 2019 9:24 am'>4 mins ago</span></small>

						<div id='act-like-716' class='ps-comment-links cstream-likes ps-js-act-like--716' data-count='0' style='display:none'></div>
			
			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a data-stream-id='1120' onclick='activity.comment_action_like(this, 716); return false;' href='#like' class='actaction-like ps-icon-thumbs-up'><span>Like</span></a>
<a data-stream-id='1120' onclick='activity.comment_action_reply(716, 1120, this, { id: 2, name: 'Patricia Currie' }); return false;' href='#reply' class='actaction-reply ps-icon-plus'><span>Reply</span></a>
<a data-stream-id='1120' onclick='activity.comment_action_edit(1120, this); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a data-stream-id='1120' onclick='activity.comment_action_delete(1120); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>

<div id='comment-item-1121' class='ps-comment-item cstream-comment stream-comment' data-comment-id='1121' style='display: none;'>
	<div class='ps-avatar-comment'>
		<a class='cstream-avatar cstream-author' href=''>
			<img data-author='2' src='' alt='Patricia Currie avatar'>
		</a>
	</div>

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href='' data-hover-card='2'><img src='' alt='VIP' title='VIP' class='ps-img-vipicons ps-js-vip-badge ' data-id='2'> Patricia Currie</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p>yes and another one</p></div></span>
		</div>

		<div data-type='stream-more' class='cstream-more' data-commentmore='true'></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small class='activity-post-age' data-timestamp='1547458032'><span class='ps-js-autotime' data-timestamp='1547458032' title='January 14, 2019 9:27 am'>just now</span></small>

						<div id='act-like-717' class='ps-comment-links cstream-likes ps-js-act-like--717' data-count='0' style='display:none'></div>
			
			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a data-stream-id='1121' onclick='activity.comment_action_like(this, 717); return false;' href='#like' class='actaction-like ps-icon-thumbs-up'><span>Like</span></a>
<a data-stream-id='1121' onclick='activity.comment_action_reply(717, 1121, this, { id: 2, name: 'Patricia Currie' }); return false;' href='#reply' class='actaction-reply ps-icon-plus'><span>Reply</span></a>
<a data-stream-id='1121' onclick='activity.comment_action_edit(1121, this); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a data-stream-id='1121' onclick='activity.comment_action_delete(1121); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div></div>

	<div id='act-new-comment-506' class='ps-comment-reply cstream-form stream-form wallform ps-js-comment-new ps-js-newcomment-506' data-type='stream-newcomment' data-formblock='true' style='display:none;'>
		
		<div class='ps-textarea-wrapper cstream-form-input'>
			<div class='ps-tagging-wrapper'><div class='ps-tagging-beautifier'></div><textarea data-act-id='506' class='ps-textarea cstream-form-text ps-tagging-textarea' name='comment' oninput='return activity.on_commentbox_change(this);' placeholder='Write a reply...' style='height: 37px;'></textarea><input type='hidden' class='ps-tagging-hidden' value=''><div class='ps-tagging-dropdown' style='display: none;'></div></div>
				

		</div>
		<div class='ps-comment-send cstream-form-submit' style='display: none;'>
			<div class='ps-comment-loading' style='display: none;'>
				<img src='assets/images/ajax-loader.gif' alt=''>
				<div> </div>
			</div>
			<div class='ps-comment-actions' style='display: none;'>
				<button onclick='return activity.comment_cancel(506);' class='ps-btn ps-button-cancel'>Clear</button>
				<button onclick='return activity.comment_save(506, this);' class='ps-btn ps-btn-primary ps-button-action' disabled='disabled'>Post</button>
			</div>
		</div>
	</div>

</div>


<!-- new reply template -->

	<div id='reply-items-template' class='ps-comment-item cstream-comment stream-comment' data-comment-id='1120' style='display:none;'>
	

	<div class='ps-comment-body cstream-content'>
		<div class='ps-comment-message stream-comment-content'>
			<a class='ps-comment-user cstream-author' href='' data-hover-card='2'> Patricia Currie</a>
			<span class='ps-comment__content' data-type='stream-comment-content'><div class='peepso-markdown'><p>okay lets see how the css is like here</p></div></span>
		</div>

		<div data-type='stream-more' class='cstream-more' data-commentmore='true'></div>

		<div class='ps-comment-media cstream-attachments'></div>

		<div class='ps-comment-time ps-shar-meta-date'>
			<small class='activity-post-age' data-timestamp='1547457853'><span class='ps-js-autotime' data-timestamp='1547457853' title='January 14, 2019 9:24 am'>4 mins ago</span></small>

						<div id='act-like-716' class='ps-comment-links cstream-likes ps-js-act-like--716' data-count='0' style='display:none'></div>
			
			<div class='ps-comment-links stream-actions' data-type='stream-action'>
				<span class='ps-stream-status-action ps-stream-status-action'>
					<nav class='ps-stream-status-action ps-stream-status-action'>
<a data-stream-id='1120' onclick='activity.comment_action_like(this, 716); return false;' href='#like' class='actaction-like ps-icon-thumbs-up'><span>Like</span></a>

<a data-stream-id='1120' onclick='activity.comment_action_edit(1120, this); return false;' href='#edit' class='actaction-edit ps-icon-pencil'><span>Edit</span></a>
<a data-stream-id='1120' onclick='activity.comment_action_delete(1120); return false;' href='#delete' class='actaction-delete ps-icon-trash'><span></span></a>
</nav>
				</span>
			</div>
		</div>
	</div>
</div>
<!-- end of new reply template -->

<!-- the end of the reply template -->
<!--- End Of Jquery Javascript file -->

      <textarea tabindex='-1' style='position: absolute; top: -999px; left: 0px; right: auto; bottom: auto; border: 0px; padding: 0px; box-sizing: content-box; word-wrap: break-word; overflow: hidden; transition: none; height: 0px !important; min-height: 0px !important; font-family: Helvetica, Arial, sans-serif; font-size: 14px; font-weight: 400; font-style: normal; letter-spacing: 0px; text-transform: none; word-spacing: 0px; text-indent: 0px; line-height: 18px; width: 720.391px;' class='autosizejs' id='autosizejs'></textarea>
      <div class='ad_unit ad-unit text-ad text_ad pub_300x250' style='width: 1px !important; height: 1px !important; position: absolute !important; left: 0px !important; top: 0px !important; overflow: hidden !important;'>&nbsp;</div>
 
    <script type='text/javascript' src='assets/js/bootstrap.bundle.min.js'>  </script>
    <script type='text/javascript' src='assets/js/dropzone.js'>  </script>

    <script src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCrhBOort1omiPN4Vbqzm53abzTZSswtio&amp;callback=initMap' async='' defer=''></script>
    <script type='text/javascript' src='assets/js/jquery-ui.min.js'>  </script>
	<script type='text/javascript' src='assets/js/utility.js'>  </script>
	<script type='text/javascript' src='assets/js/reactions.js'>  </script>
	
    <script type='text/javascript' src='assets/js/su_post.js'></script><input type='file' multiple='multiple' class='dz-hidden-input' accept='image/gif,image/png,image/jpeg,image/jpg,video/x-ms-wmv,video/mp4,video/3gpp,audio/mpeg,audio/mp4,audio/mp3' style='visibility: hidden; position: absolute; top: 0px; left: 0px; height: 0px; width: 0px;'>   <script type='text/javascript' src='assets/js/stream.js'></script> 
	
  
    <script type='text/javascript' src='assets/js/script.js'></script> 

<div style='position: absolute; left: 0px; top: -2px; height: 1px; overflow: hidden; visibility: hidden; width: 1px;'><span style='position: absolute; font-size: 300px; width: auto; height: auto; margin: 0px; padding: 0px; font-family: Roboto, Arial, sans-serif;'>BESbswy</span></div>
</body></html>";

  }// main_footer();


?> 