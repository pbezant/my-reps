<?php

/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       www.PrestonBezant.com
 * @since      1.0.0
 *
 * @package    Rep_lookup
 * @subpackage Rep_lookup/public/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<script name="KEY">
	var API_KEY = "<?php echo get_option('Rep_lookup')['google_api_key']; ?>";
</script>

<?php //echo file_get_contents( plugins_url( '../../templates/lookup-page.php', __FILE__ ) ); ?>

    <div class='main-content rep-page'>
        <div class="container">
            <!-- Update this tagline! -->
            <p class='lead'>Enter your address to <strong>find and contact</strong> your federal, state, county and local elected representatives</p>
            <br />
            <!-- Add your call to action here! -->
            <div class="row">
                <div class='col m-auto'>
                    <div class="input-group input-group-lg">
                        <input type="text" class="form-control" placeholder="Enter your address to find who represents you" id="address" name="address">
                        <span class="input-group-btn">
                        <button class="btn btn-info" type="submit" id="address-search"><i class='fa fa-search'></i> <span class='hidden-xs hidden-sm'>Search</span></button>
                        <!--  <button class="btn btn-default" type="submit" id="find-me"><i class='fa fa-crosshairs'></i> <span class='hidden-xs hidden-sm'>Find me</span> </button> -->
                        </span>

                    </div>

                    <div class='filter_level text-center' style="display: none;">
                        <br />
                        <p class=''>
                            Show level of government:
                        </p>
                        <div class="d-flex justify-content-center">
                            <label>
                                <input type="checkbox" id="show_local_results" value="Local"> Local
                            </label>
                            <label>
                                <input type="checkbox" id="show_county_results" value="County"> County
                            </label>
                            <label>
                                <input type="checkbox" id="show_state_results" value="State"> State
                            </label>
                            <label>
                                <input type="checkbox" id="show_federal_results" value="Federal"> Federal
                            </label>
                        </div>
                    </div>
                    <br />
                </div>
            </div>
            <div class="row">
                <div class='col m-auto'>
                    <div id='no-response-container' class='text-center' style="display:none;">
                        <h1><i class='fa fa-exclamation-triangle'></i> </h1>
                        <h3>No representatives found</h3>
                        <p>We couldn't find any representatives for that address. Please try again.</p>
                    </div>
                    <div id='response-container' style="display:none;">
                        <div class='text-center' id='address-image'></div>
                        <br />
                        <br />
                        <p class="lead text-center" id='results-nav'>
                            Levels of government
                            <br />
							
							<span id='local-nav' style='display: none;'>
							<a id="local-name-nav" href="#local-name"></a>
							</span>
							
							<span id='county-nav' style='display: none;'>
							<a id="county-name-nav" href="#county-name"></a>
							</span>
							
							<span id='state-nav' style='display: none;'>
							<a id="state-name-nav" href="#state-name"></a>
							</span>
							
							<span id='fed-nav'>
							<a id="federal-name-nav" href="#federal-name">Federal</a></li>
							</span>
							
                        </p>
                        <hr />
                        <p class='text-center'><small><em>Note: Data comes from the <a target='_blank' href='https://developers.google.com/civic-information/'>Google Civic Information API</a>, which does not have 100% coverage of all representatives.<br />If you notice an issue with the data, please <a target='_blank' href='https://docs.google.com/forms/d/e/1FAIpQLScFpFTOkTpm0YoerLLprY_ySS9PRXLsu27SM01hebHqkefW2Q/viewform'>report it to Google</a>.</em></small></p>
                        <div id="tag-container" class="d-flex flex-wrap justify-content-around ">
                        </div>
                        <div id='state-container'>
                            <br />
                            <h3 class='text-center' id="state-name"></h3>
                            <table id="state-results" class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Representative</th>
                                        <th class='hidden-xs hidden-sm'><i class='fa fa-institution'></i> Office</th>
                                        <th class='hidden-xs'><i class='fa fa-map-marker'></i> Address</th>
                                        <th><i class='fa fa-external-link'></i> Links</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id='local-container'>
                            <br />
                            <h3 class='text-center' id="local-name"></h3>
                            <table id="local-results" class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Representative</th>
                                        <th class='hidden-xs hidden-sm'><i class='fa fa-institution'></i> Office</th>
                                        <th class='hidden-xs'><i class='fa fa-map-marker'></i> Address</th>
                                        <th><i class='fa fa-external-link'></i> Links</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id='local-container-not-found' style='display: none;' class='text-center'>
                            <h3 class='text-center' id="local-name-not-found"></h3>
                            <p>We couldn't find any representatives for this area</p>
                        </div>
                        <div id='county-container'>
                            <br />
                            <h3 class='text-center' id="county-name"></h3>
                            <table id="county-results" class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Representative</th>
                                        <th class='hidden-xs hidden-sm'><i class='fa fa-institution'></i> Office</th>
                                        <th class='hidden-xs'><i class='fa fa-map-marker'></i> Address</th>
                                        <th><i class='fa fa-external-link'></i> Links</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                        <div id='county-container-not-found' style='display: none;' class='text-center'>
                            <h3 class='text-center' id="county-name-not-found"></h3>
                            <p>We couldn't find any representatives for this area</p>
                        </div>

                        <div id='federal-container'>
                            <h3 id='federal-name' class='text-center'>United States Federal Government</h3>
                            <table id="federal-results" class="table table-responsive-sm">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>Representative</th>
                                        <th class='hidden-xs hidden-sm'><i class='fa fa-institution'></i> Office</th>
                                        <th class='hidden-xs'><i class='fa fa-map-marker'></i> Address</th>
                                        <th><i class='fa fa-external-link'></i> Links</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class='row'>
                <div class='col-md-7'>
                    <br />
                    <h2>About</h2>
                    <div class='about'>
                        <p>This is a tool for looking up who your <a href='https://en.wikipedia.org/wiki/Representative_democracy' target='_blank'>elected representatives</a> are across the United States. Based on your address, we can find all the federal, state, county and local officials who represent you in government.</p>
                        <p>Knowing who these representatives are and contacting their offices directly is the most effective way to change how our government works.</p>
                        <p>Have an issue you care about? <strong>Find your rep and tell them!</strong></p>
                        <p><a href='/about.html'>More about this project &raquo;</a></p>
                    </div>
                </div>
                <div class='col-md-5 hidden-xs hidden-sm'>
                    <img class='img-fluid img-responsive' src="<?php echo plugins_url( '../../images/usa.png', __FILE__ ) ?>" title='The United States of America' alt='The United States of America' />
                </div>
            </div>
            <!-- Modal -->
            <div class="modal" id="contactModal" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="contactModalLabel"></h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id='modalContent'></div>
                        <div class="modal-footer">
                            <!-- <button type="button" class="btn btn-primary">Save changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
            <script id="tableGuts" type="text/EJS">
                <% $.each(people, function(i, info){ %>
                    <tr>
                        <td>
                            <% if (info.person.photoUrl) { %>
                                <img class="img-rounded headshot" src="<%= info.person.photoUrl %>" alt="<%= info.person.name %>" title="<%= info.person.name %>" />
                                <% } else { %>
                                    <img class="img-rounded headshot" src="<?php echo plugins_url( '../../images/blank-person.jpg', __FILE__ ) ?>" alt="<%= info.person.name %>" title="<%= info.person.name %>" />
                                    <% } %>
                        </td>
                        <td>
                            <%= info.person.name %>
                                <%= formatParty(info.person.party) %>
                                    <span class='visible-xs-block visible-sm-block'><%= info.office.name %></span>
                        </td>
                        <td class='hidden-xs hidden-sm'>
                            <%= info.office.name %>
                        </td>
                        <td class='hidden-xs'>
                            <% if (info.address) { %>
                                <% $.each(info.address, function(i, addr){ %>
                                    <p>
                                        <%= toTitleCase(addr.line1) %>
                                            <br />
                                            <% if (addr.line2) { %>
                                                <%= toTitleCase(addr.line2) %>
                                                    <br />
                                                    <% } %>
                                                        <% if (addr.line3) { %>
                                                            <%= toTitleCase(addr.line3) %>
                                                                <br />
                                                                <% } %>
                                                                    <%= toTitleCase(addr.city) %>,
                                                                        <%= addr.state.toUpperCase() %>
                                                                            <%= addr.zip %>
                                    </p>
                                    <% }) %>
                                        <% } %>
                        </td>
                        <td>
                            <% if (info.channels || info.urls){ %>
                                <span class='visible-xs-inline visible-sm-inline'>
                        <% if (info.channels){ %>
                        <% $.each(info.channels, function(i, channel){ %>
                            <a href="<%= channel.link %>" target="_blank"><i class="fa fa-fw fa-<%= channel.icon %>"> </i></a>
                        <% }) %>
                        <% } %>
                        <% if (info.urls){ %>
                            <% $.each(info.urls, function(i, url){ %>
                                <a href="<%= url %>" target="_blank"><i class="fa fa-fw fa-globe"> </i></a>
                            <% }) %>
                        <% } %>
                    </span>
                                <% } %>
                        </td>
                        <% if (info.phones || info.emails){ %>
                            <td class='nowrap'>
                                <button type="button" class="btn btn-default btn-contact" data-toggle="modal" data-id="<%= info.pseudo_id %>">
                                    Contact <i class='fa fa-chevron-right'></i>
                                </button>
                            </td>
                            <% } else { %>
                                <td></td>
                                <% } %>
                    </tr>
                    <% }) %>
            </script>
            <script id="modalGuts" type="text/EJS">
            <div class="media">
                <% if (info.person.photoUrl) { %>
                <img class="img-responsive align-self-center mr-3 w-25" src="<%= info.person.photoUrl %>" alt="<%= info.person.name %>" title="<%= info.person.name %>" />
                <% } else { %>
                <img class="img-responsive align-self-center mr-3 w-25" src="<?php echo plugins_url( '../../images/blank-person.jpg', __FILE__ ) ?> alt="<%= info.person.name %>" title="<%= info.person.name %>" />
                <% } %>
                <div class="media-body">
                    <!-- Add your contact instructions here! -->
                    <p><strong><%= info.person.name %></strong><br/>
                    <%= info.office.name %><br/>
                    <%= info.jurisdiction %></p>
                    <hr />
                    
                    <% if (info.phones){ %>
                        <% $.each(info.phones, function(i, phone){ %>
                            <% if ((i + 1) < info.phones.length){ %>
                                <i class='fa fa-fw fa-phone'></i>
                                <%= phone %>
                                    <br />
                                    <% } else { %>
                                        <i class='fa fa-fw fa-phone'></i>
                                        <a href="tel:<%= phone %>"><%= phone %></a>
                                            <% } %>
                                                <% }) %>
                                                    <br />
                                                    <% } %>
                                                        <% if (info.emails){ %>
                                                            <% $.each(info.emails, function(i, email){ %>
                                                                <% if ((i + 1) < info.emails.length){ %>
                                                                    <i class='fa fa-fw fa-envelope'></i>
                                                                    <a href='mailto:<%= email %>'>
                                                                        <%= email %>
                                                                    </a>
                                                                    <br />
                                                                    <% } else { %>
                                                                    <i class='fa fa-fw fa-envelope'></i>
                                                                    <a href='mailto:<%= email %>'>
                                                                        <%= email %>
                                                                    </a>
                            <% } %>
                        <% }) %>
                    <% } %>
                </div>
            </div>
            </script>
        </div>
    </div>
    <div class='clearfix'></div>
    <div class="container-fluid">
        <div class="row" id="footer">
            <div class='col-md-10 col-md-offset-1'>
                <p class='text-center small'>
                    <br />
                    <br /> Built by <a href='http://datamade.us' target="_blank">DataMade</a> and the <a href='http://participatorybudgeting.org/'>Participatory Budgeting Project</a> | Powered by the <a target='_blank' href='https://developers.google.com/civic-information/'>Google Civic Information API</a>
                </p>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
    //<![CDATA[

    jQuery(document).ready(function($) {

        var autocomplete = new google.maps.places.Autocomplete(document.getElementById('address'), { types: ['address'] });

        $("#address").val(convertToPlainString($.address.parameter('address')));

        if ($("#address").val())
            addressSearch();

        $('#address-search').click(function() {
            addressSearch();
        });

        var results_level = $.address.parameter('results_level');
        if (results_level == undefined)
            results_level = ['local', 'county', 'state', 'federal'];

        // set levels of government checkboxes
        if (results_level.indexOf("local") >= 0)
            $('#show_local_results').prop('checked', true);
        if (results_level.indexOf("county") >= 0)
            $('#show_county_results').prop('checked', true);
        if (results_level.indexOf("state") >= 0)
            $('#show_state_results').prop('checked', true);
        if (results_level.indexOf("federal") >= 0)
            $('#show_federal_results').prop('checked', true);

        $("#results-nav a").click(function(e) {
            e.preventDefault();
            var scroll_to = $($("#" + e.target.id).attr('href'));
            $('html, body').animate({
                scrollTop: scroll_to.offset().top
            }, 1000);
        });

        $('#find-me').click(function() {
            findMe();
            return false;
        });

        $(":text").keydown(function(e) {
            var key = e.keyCode ? e.keyCode : e.which;
            if (key === 13) {
                $('#address-search').click();
                return false;
            }
        });
    });
    //]]>

    </script>


