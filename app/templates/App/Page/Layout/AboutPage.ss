<div class="about">
    <div class="intro_section">
        <div class="intro_title">$Intro_title</div>
        <div class="content">
            <p class="intro_body">$Intro_body</p>
            <p class="Intro_body_description">$Intro_body_description</p>
        </div>
    </div>

    <div class="about_section">
        <div class="about_title">$Team_title</div>
        <div class="card_holder">
            <div class="card__list">
                <% loop $TeamMembers %>
                    <div class="card_item">
                        <img src="$Image.URL" alt="" class="card_image">
                        <div class="card-body">
                            <div class="name">$EmployeeName</div>
                            <div class="position">$EmployeePosition</div>
                            <div class="description">$EmployeeDescription</div>
                            <div class="readmore">READ MORE</div>
                        </div>
                    </div>
                <% end_loop %>
            </div>
        </div>

    </div>
    <div class="about_section">
        <div class="about_title">$Board_title</div>
        <div class="content">
            <p class="about_description">$Board_description
            </p>
            <div class="card_holder">
                <div class="card__list">
                    <% loop $BoardMembers %>
                        <div class="card_item">
                            <img src="$Image.URL" alt="" class="card_image">
                            <div class="card-body">
                                <div class="name">$EmployeeName</div>
                                <div class="position">$EmployeePosition</div>
                                <div class="description">$EmployeeDescription</div>
                                <div class="readmore">READ MORE</div>
                            </div>
                        </div>
                    <% end_loop %>
                </div>
            </div>


        </div>
    </div>

    <div class="about_section">
        <div class="about_title">$Shareholders_title</div>
        <div class="content">
            <p class="about_description">$Shareholders_description</p>
            <div class="stakeholders">
                <% loop $Shareholders %>
                    <div class="stakeholder__logo">
                        <img src="$Image.URL" class="image_logo">
                    </div>
                <% end_loop %>
            </div>
        </div>
    </div>

    <div class="about_section">
        <div class="about_title">$Awards_title</div>
        <div class="content">
            <p class="about_description">$Awards_description
            </p>
            <div class="card_holder">
                <div class="card__list">
                    <% loop $Awards %>
                        <div class="card_item">
                            <img src="$Image.URL" alt="" class="card_image">
                            <div class="card-body">
                                <div class="name">$AwardName</div>
                                <div class="position">$AwardPosition</div>
                                <div class="description">$AwardInfoDescription</div>
                                <div class="readmore">READ MORE</div>
                            </div>
                        </div>
                    <% end_loop %>
                </div>
            </div>
        </div>
    </div>


</div>