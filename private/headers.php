<?php


function profile_page_header($username){


  return "<div class='header__wrapper header__wrapper--medium'>
        <div class='header' style='
    float: right;
'>
        <div id='userbar' class='header__account'><div class='widget_text widget header__widget'><div class='textwidget custom-html-widget' style='
    margin-right: 35em;
    
'><div class='ultimate__box-actions' style='margin-left: 30px;'><a class='btn btn--sm' style='display:block;' href='http://peep.so/bundle'><strong>{$username}</strong></a></div></div></div></div>

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
        </div>
      </div>";


}



function home_page_headers(){



	
}


?>