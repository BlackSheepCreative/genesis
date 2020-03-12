<header class="header">
    <div class="border"></div>
    <div class="header__container">

        <a href="/" class="header__logo">
            <img src="$ThemeDir/images/loyalty_logo.png" alt="" class="header__logo">
        </a>
        <button class="header__hamburger hamburger hamburger--3dxy" type="button">
        <span class="hamburger-box">
            <span class="hamburger-inner"></span>
        </span>
        </button>
        <ul class="header__links">
            <% loop $Menu(1) %>
                <li class="header__link<% if $isCurrent %> header__link--active<% end_if %>">
                    <a href="$Link">$MenuTitle</a>
                </li>
            <% end_loop %>
        </ul>


        <div class="right">
            <div class="social-list">
                <div><img src="{$ThemeDir}/images/FlyBuysBlack.png" alt="" class="social-item"></div>
                <div><img src="{$ThemeDir}/images/Lab360Black.png" alt="" class="social-item"></div>
                <div><img src="{$ThemeDir}/images/Facebook.png" alt="" class="social-item"></div>
                <div><img src="{$ThemeDir}/images/twitter.png" alt="" class="social-item"></div>
                <div><img src="{$ThemeDir}/images/linkedin.png" alt="" class="social-item"></div>
            </div>

        </div>
    </div>
</header>