<?php
if ( !function_exists( 'add_action' ) ) {
    echo 'You are not allowed to enter.';
    exit;
}

function WPKF_include() {
    wp_enqueue_style( 'WPKF-style-metabox', plugins_url('includes/metabox.css', __FILE__), array(), "1.0" );
    wp_enqueue_script('WPKF-script-metabox', plugins_url('includes/metabox.js', __FILE__), array(), '1.0');
}

// evil yazi icine metabox ekliyor
add_action( 'add_meta_boxes', 'WPKF_add_all_meta_box' );

function WPKF_add_all_meta_box() {
    add_meta_box( 'ew_keyword_finder', __('Keyword Finder', 'WPKF-plugin'), 'WPKF_register_metabox', 'post', 'normal', 'high' );
    add_action('admin_head', 'WPKF_include');
}

function WPKF_register_metabox( $post ) {
    $values = get_post_custom ( $post->ID );

    if (!empty($values['WPKF_country'][0])) // postun kayitli bir countrysi varsa ona
        $country = $values['WPKF_country'][0];
    else if (get_option("WPKF_default_country") !== "") // eklentinin default countrysi varsa ona
        $country = get_option("WPKF_default_country");
    else
        $country = "TR"; // sabir bir country ver

    if (!empty($values['WPKF_language'][0]))
        $language = $values['WPKF_language'][0];
    else if (get_option("WPKF_default_language") !== "")
        $language = get_option("WPKF_default_language");
    else
        $language = "TR";

    if (!empty($values['WPKF_source'][0]))
        $source = $values['WPKF_source'][0];
    else if (get_option("WPKF_default_source") !== "")
        $source = get_option("WPKF_default_source");
    else
        $source = "0";


    $keyword = isset( $values['WPKF_keyword'] ) ? $values['WPKF_keyword'][0] : '';

    //$source = isset( $values['WPKF_source'] ) ? $values['WPKF_source'][0] : '';

    wp_nonce_field( 'WPKF_meta_box_nonce', 'meta_box_nonce' );
    ?>

    <div class="girdiler">
        <input type="text" autocomplete="off" name="WPKF_keyword" id="WPKF_keyword" value="<?php echo $keyword; ?>" class="WPKF-input">
    </div>
    <div class="girdiler">
        <select name="WPKF_country" id="WPKF_country" class="WPKF-select">
            <option value="0">Select Country</option>
            <option value="AF">Afghanistan</option>
            <option value="AX">Åland Islands</option>
            <option value="AL">Albania</option>
            <option value="DZ">Algeria</option>
            <option value="AS">American Samoa</option>
            <option value="AD">Andorra</option>
            <option value="AO">Angola</option>
            <option value="AI">Anguilla</option>
            <option value="AQ">Antarctica</option>
            <option value="AG">Antigua and Barbuda</option>
            <option value="AR">Argentina</option>
            <option value="AM">Armenia</option>
            <option value="AW">Aruba</option>
            <option value="AU">Australia</option>
            <option value="AT">Austria</option>
            <option value="AZ">Azerbaijan</option>
            <option value="BS">Bahamas</option>
            <option value="BH">Bahrain</option>
            <option value="BD">Bangladesh</option>
            <option value="BB">Barbados</option>
            <option value="BY">Belarus</option>
            <option value="BE">Belgium</option>
            <option value="BZ">Belize</option>
            <option value="BJ">Benin</option>
            <option value="BM">Bermuda</option>
            <option value="BT">Bhutan</option>
            <option value="BO">Bolivia, Plurinational State of</option>
            <option value="BQ">Bonaire, Sint Eustatius and Saba</option>
            <option value="BA">Bosnia and Herzegovina</option>
            <option value="BW">Botswana</option>
            <option value="BV">Bouvet Island</option>
            <option value="BR">Brazil</option>
            <option value="IO">British Indian Ocean Territory</option>
            <option value="BN">Brunei Darussalam</option>
            <option value="BG">Bulgaria</option>
            <option value="BF">Burkina Faso</option>
            <option value="BI">Burundi</option>
            <option value="KH">Cambodia</option>
            <option value="CM">Cameroon</option>
            <option value="CA">Canada</option>
            <option value="CV">Cape Verde</option>
            <option value="KY">Cayman Islands</option>
            <option value="CF">Central African Republic</option>
            <option value="TD">Chad</option>
            <option value="CL">Chile</option>
            <option value="CN">China</option>
            <option value="CX">Christmas Island</option>
            <option value="CC">Cocos (Keeling) Islands</option>
            <option value="CO">Colombia</option>
            <option value="KM">Comoros</option>
            <option value="CG">Congo</option>
            <option value="CD">Congo, the Democratic Republic of the</option>
            <option value="CK">Cook Islands</option>
            <option value="CR">Costa Rica</option>
            <option value="CI">Côte d'Ivoire</option>
            <option value="HR">Croatia</option>
            <option value="CU">Cuba</option>
            <option value="CW">Curaçao</option>
            <option value="CY">Cyprus</option>
            <option value="CZ">Czech Republic</option>
            <option value="DK">Denmark</option>
            <option value="DJ">Djibouti</option>
            <option value="DM">Dominica</option>
            <option value="DO">Dominican Republic</option>
            <option value="EC">Ecuador</option>
            <option value="EG">Egypt</option>
            <option value="SV">El Salvador</option>
            <option value="GQ">Equatorial Guinea</option>
            <option value="ER">Eritrea</option>
            <option value="EE">Estonia</option>
            <option value="ET">Ethiopia</option>
            <option value="FK">Falkland Islands (Malvinas)</option>
            <option value="FO">Faroe Islands</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finland</option>
            <option value="FR">France</option>
            <option value="GF">French Guiana</option>
            <option value="PF">French Polynesia</option>
            <option value="TF">French Southern Territories</option>
            <option value="GA">Gabon</option>
            <option value="GM">Gambia</option>
            <option value="GE">Georgia</option>
            <option value="DE">Germany</option>
            <option value="GH">Ghana</option>
            <option value="GI">Gibraltar</option>
            <option value="GR">Greece</option>
            <option value="GL">Greenland</option>
            <option value="GD">Grenada</option>
            <option value="GP">Guadeloupe</option>
            <option value="GU">Guam</option>
            <option value="GT">Guatemala</option>
            <option value="GG">Guernsey</option>
            <option value="GN">Guinea</option>
            <option value="GW">Guinea-Bissau</option>
            <option value="GY">Guyana</option>
            <option value="HT">Haiti</option>
            <option value="HM">Heard Island and McDonald Islands</option>
            <option value="VA">Holy See (Vatican City State)</option>
            <option value="HN">Honduras</option>
            <option value="HK">Hong Kong</option>
            <option value="HU">Hungary</option>
            <option value="IS">Iceland</option>
            <option value="IN">India</option>
            <option value="ID">Indonesia</option>
            <option value="IR">Iran, Islamic Republic of</option>
            <option value="IQ">Iraq</option>
            <option value="IE">Ireland</option>
            <option value="IM">Isle of Man</option>
            <option value="IL">Israel</option>
            <option value="IT">Italy</option>
            <option value="JM">Jamaica</option>
            <option value="JP">Japan</option>
            <option value="JE">Jersey</option>
            <option value="JO">Jordan</option>
            <option value="KZ">Kazakhstan</option>
            <option value="KE">Kenya</option>
            <option value="KI">Kiribati</option>
            <option value="KP">Korea, Democratic People's Republic of</option>
            <option value="KR">Korea, Republic of</option>
            <option value="KW">Kuwait</option>
            <option value="KG">Kyrgyzstan</option>
            <option value="LA">Lao People's Democratic Republic</option>
            <option value="LV">Latvia</option>
            <option value="LB">Lebanon</option>
            <option value="LS">Lesotho</option>
            <option value="LR">Liberia</option>
            <option value="LY">Libya</option>
            <option value="LI">Liechtenstein</option>
            <option value="LT">Lithuania</option>
            <option value="LU">Luxembourg</option>
            <option value="MO">Macao</option>
            <option value="MK">Macedonia, the former Yugoslav Republic of</option>
            <option value="MG">Madagascar</option>
            <option value="MW">Malawi</option>
            <option value="MY">Malaysia</option>
            <option value="MV">Maldives</option>
            <option value="ML">Mali</option>
            <option value="MT">Malta</option>
            <option value="MH">Marshall Islands</option>
            <option value="MQ">Martinique</option>
            <option value="MR">Mauritania</option>
            <option value="MU">Mauritius</option>
            <option value="YT">Mayotte</option>
            <option value="MX">Mexico</option>
            <option value="FM">Micronesia, Federated States of</option>
            <option value="MD">Moldova, Republic of</option>
            <option value="MC">Monaco</option>
            <option value="MN">Mongolia</option>
            <option value="ME">Montenegro</option>
            <option value="MS">Montserrat</option>
            <option value="MA">Morocco</option>
            <option value="MZ">Mozambique</option>
            <option value="MM">Myanmar</option>
            <option value="NA">Namibia</option>
            <option value="NR">Nauru</option>
            <option value="NP">Nepal</option>
            <option value="NL">Netherlands</option>
            <option value="NC">New Caledonia</option>
            <option value="NZ">New Zealand</option>
            <option value="NI">Nicaragua</option>
            <option value="NE">Niger</option>
            <option value="NG">Nigeria</option>
            <option value="NU">Niue</option>
            <option value="NF">Norfolk Island</option>
            <option value="MP">Northern Mariana Islands</option>
            <option value="NO">Norway</option>
            <option value="OM">Oman</option>
            <option value="PK">Pakistan</option>
            <option value="PW">Palau</option>
            <option value="PS">Palestinian Territory, Occupied</option>
            <option value="PA">Panama</option>
            <option value="PG">Papua New Guinea</option>
            <option value="PY">Paraguay</option>
            <option value="PE">Peru</option>
            <option value="PH">Philippines</option>
            <option value="PN">Pitcairn</option>
            <option value="PL">Poland</option>
            <option value="PT">Portugal</option>
            <option value="PR">Puerto Rico</option>
            <option value="QA">Qatar</option>
            <option value="RE">Réunion</option>
            <option value="RO">Romania</option>
            <option value="RU">Russian Federation</option>
            <option value="RW">Rwanda</option>
            <option value="BL">Saint Barthélemy</option>
            <option value="SH">Saint Helena, Ascension and Tristan da Cunha</option>
            <option value="KN">Saint Kitts and Nevis</option>
            <option value="LC">Saint Lucia</option>
            <option value="MF">Saint Martin (French part)</option>
            <option value="PM">Saint Pierre and Miquelon</option>
            <option value="VC">Saint Vincent and the Grenadines</option>
            <option value="WS">Samoa</option>
            <option value="SM">San Marino</option>
            <option value="ST">Sao Tome and Principe</option>
            <option value="SA">Saudi Arabia</option>
            <option value="SN">Senegal</option>
            <option value="RS">Serbia</option>
            <option value="SC">Seychelles</option>
            <option value="SL">Sierra Leone</option>
            <option value="SG">Singapore</option>
            <option value="SX">Sint Maarten (Dutch part)</option>
            <option value="SK">Slovakia</option>
            <option value="SI">Slovenia</option>
            <option value="SB">Solomon Islands</option>
            <option value="SO">Somalia</option>
            <option value="ZA">South Africa</option>
            <option value="GS">South Georgia and the South Sandwich Islands</option>
            <option value="SS">South Sudan</option>
            <option value="ES">Spain</option>
            <option value="LK">Sri Lanka</option>
            <option value="SD">Sudan</option>
            <option value="SR">Suriname</option>
            <option value="SJ">Svalbard and Jan Mayen</option>
            <option value="SZ">Swaziland</option>
            <option value="SE">Sweden</option>
            <option value="CH">Switzerland</option>
            <option value="SY">Syrian Arab Republic</option>
            <option value="TW">Taiwan, Province of China</option>
            <option value="TJ">Tajikistan</option>
            <option value="TZ">Tanzania, United Republic of</option>
            <option value="TH">Thailand</option>
            <option value="TL">Timor-Leste</option>
            <option value="TG">Togo</option>
            <option value="TK">Tokelau</option>
            <option value="TO">Tonga</option>
            <option value="TT">Trinidad and Tobago</option>
            <option value="TN">Tunisia</option>
            <option value="TR">Turkey</option>
            <option value="TM">Turkmenistan</option>
            <option value="TC">Turks and Caicos Islands</option>
            <option value="TV">Tuvalu</option>
            <option value="UG">Uganda</option>
            <option value="UA">Ukraine</option>
            <option value="AE">United Arab Emirates</option>
            <option value="GB">United Kingdom</option>
            <option value="US">United States</option>
            <option value="UM">United States Minor Outlying Islands</option>
            <option value="UY">Uruguay</option>
            <option value="UZ">Uzbekistan</option>
            <option value="VU">Vanuatu</option>
            <option value="VE">Venezuela, Bolivarian Republic of</option>
            <option value="VN">Viet Nam</option>
            <option value="VG">Virgin Islands, British</option>
            <option value="VI">Virgin Islands, U.S.</option>
            <option value="WF">Wallis and Futuna</option>
            <option value="EH">Western Sahara</option>
            <option value="YE">Yemen</option>
            <option value="ZM">Zambia</option>
            <option value="ZW">Zimbabwe</option>
        </select>
    </div>
    <div class="girdiler">
        <select name="WPKF_language" id="WPKF_language" class="WPKF-select">
            <option value="0">Select Language</option>
            <option value="AF">Afrikaans</option>
            <option value="SQ">Albanian</option>
            <option value="AR">Arabic</option>
            <option value="HY">Armenian</option>
            <option value="EU">Basque</option>
            <option value="BN">Bengali</option>
            <option value="BG">Bulgarian</option>
            <option value="CA">Catalan</option>
            <option value="KM">Cambodian</option>
            <option value="ZH">Chinese (Mandarin)</option>
            <option value="HR">Croatian</option>
            <option value="CS">Czech</option>
            <option value="DA">Danish</option>
            <option value="NL">Dutch</option>
            <option value="EN">English</option>
            <option value="ET">Estonian</option>
            <option value="FJ">Fiji</option>
            <option value="FI">Finnish</option>
            <option value="FR">French</option>
            <option value="KA">Georgian</option>
            <option value="DE">German</option>
            <option value="EL">Greek</option>
            <option value="GU">Gujarati</option>
            <option value="HE">Hebrew</option>
            <option value="HI">Hindi</option>
            <option value="HU">Hungarian</option>
            <option value="IS">Icelandic</option>
            <option value="ID">Indonesian</option>
            <option value="GA">Irish</option>
            <option value="IT">Italian</option>
            <option value="JA">Japanese</option>
            <option value="JW">Javanese</option>
            <option value="KO">Korean</option>
            <option value="LA">Latin</option>
            <option value="LV">Latvian</option>
            <option value="LT">Lithuanian</option>
            <option value="MK">Macedonian</option>
            <option value="MS">Malay</option>
            <option value="ML">Malayalam</option>
            <option value="MT">Maltese</option>
            <option value="MI">Maori</option>
            <option value="MR">Marathi</option>
            <option value="MN">Mongolian</option>
            <option value="NE">Nepali</option>
            <option value="NO">Norwegian</option>
            <option value="FA">Persian</option>
            <option value="PL">Polish</option>
            <option value="PT">Portuguese</option>
            <option value="PA">Punjabi</option>
            <option value="QU">Quechua</option>
            <option value="RO">Romanian</option>
            <option value="RU">Russian</option>
            <option value="SM">Samoan</option>
            <option value="SR">Serbian</option>
            <option value="SK">Slovak</option>
            <option value="SL">Slovenian</option>
            <option value="ES">Spanish</option>
            <option value="SW">Swahili</option>
            <option value="SV">Swedish </option>
            <option value="TA">Tamil</option>
            <option value="TT">Tatar</option>
            <option value="TE">Telugu</option>
            <option value="TH">Thai</option>
            <option value="BO">Tibetan</option>
            <option value="TO">Tonga</option>
            <option value="TR">Turkish</option>
            <option value="UK">Ukrainian</option>
            <option value="UR">Urdu</option>
            <option value="UZ">Uzbek</option>
            <option value="VI">Vietnamese</option>
            <option value="CY">Welsh</option>
            <option value="XH">Xhosa</option>
        </select>
    </div>
    <div class="girdiler">
        <select name="WPKF_source" id="WPKF_source" class="WPKF-select">
            <option value="0">Select Source</option>
            <option <?php echo ($source == 'bing') ? 'selected' : '';  ?> value="bing">Bing</option>
            <option <?php echo ($source == 'google') ? 'selected' : '';  ?> value="google">Google</option>
            <option <?php echo ($source == 'yahoo') ? 'selected' : '';  ?> value="yahoo">Yahoo</option>
        </select>
    </div>

    <?php 
    if(!empty($country)){
        echo '<script>jQuery("#WPKF_country option[value=' . $country. ']").attr("selected", "selected");</script>';
    }
    if(!empty($language)){
        echo '<script>jQuery("#WPKF_language option[value=' . $language. ']").attr("selected", "selected");</script>';
    }
    if(!empty($source)){
        echo '<script>jQuery("#WPKF_source option[value=' . $source. ']").attr("selected", "selected");</script>';
    }
    ?>

<h1 style="display:none;" id="wpkf-title">click <span>and</span> copy</h1>
<div style="display:none;" id="wpkf-keywords"></div>

<div onclick="getKeywords(
              document.getElementById('WPKF_keyword').value,
              document.getElementById('WPKF_country').value,
              document.getElementById('WPKF_language').value,
              document.getElementById('WPKF_source').value
              );" class="button button-primary button-large">
    <?php echo __('Get Keywords', 'WPKF-plugin'); ?>
</div>
<div class="clear"></div>

<?php
}

add_action( 'save_post', 'WPKF_meta_box_save' );
function WPKF_meta_box_save( $post_id ) {
    // Autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    // if our nonce isn't there, or we can't verify it, bail
    if( !isset( $_POST['meta_box_nonce'] ) || !wp_verify_nonce( $_POST['meta_box_nonce'], 'WPKF_meta_box_nonce' ) ) return;

    // User can "edit_post"
    if( !current_user_can( 'edit_post' ) ) return;
    
    $post_keyword = sanitize_text_field($_POST['WPKF_keyword']);
    $post_country = sanitize_text_field($_POST['WPKF_country']);
    $post_language = sanitize_text_field($_POST['WPKF_language']);
    $post_source = sanitize_text_field($_POST['WPKF_source']);

    // Update data
    if(isset($post_keyword) || isset($post_country) || isset($post_language) || isset($post_source)){
        update_post_meta( $post_id, 'WPKF_keyword', sanitize_text_field($post_keyword) );
        update_post_meta( $post_id, 'WPKF_country', sanitize_text_field($post_country) );
        update_post_meta( $post_id, 'WPKF_language', sanitize_text_field($post_language) );
        update_post_meta( $post_id, 'WPKF_source', sanitize_text_field($post_source) );
    }
}

function WPKF_objectToArray($object) {
    if(!is_object($object) && !is_array($object)){
        return $object;
    }
    return array_map('WPKF_objectToArray', (array) $object);
}
    
function wpkf_keywords_ajax(){
    $keyword = urlencode($_POST['getAjaxWPKeyword']);       // ajaxdan gelen keyword
    $country = urlencode($_POST['getAjaxWPCountry']);       // ajaxdan gelen country
    $language = urlencode($_POST['getAjaxWPLanguage']);     // ajaxdan gelen language
    $source = urlencode($_POST['getAjaxWPSource']);         // ajaxdan gelen source

    $api_url = 'http://mecmua.site/api/';

    $request_string = array(
        'body' => array(
            'action' => 'keyword_search',
            'keyword' => $keyword,
            'country' => $country,
            'language' => $language,
            'source' => $source,
            'api-key' => md5(get_bloginfo('url'))
        ),
        'user-agent' => 'WordPress/' . $wp_version . '; ' . get_bloginfo('url')
    );

    $request = wp_remote_post($api_url, $request_string);

    if (is_wp_error($request)) {
        $sonuc = new WP_Error('plugins_api_failed', __('An Unexpected HTTP Error occurred during the API request.</p> <p><a href="?" onclick="document.location.reload(); return false;">Try again</a>'), $request->get_error_message());
    } else {
        $sonuc = unserialize($request['body']); // object
        $sonuc = WPKF_objectToArray($sonuc);

        if ($sonuc == false){
            $sonuc = new WP_Error('plugins_api_failed', __('An unknown error occurred'), $request['body']);
        }else {
            if($sonuc['keywordler'] == 'ERROR'){
                print('ERROR!');
            }else{
                $sonucCount = count($sonuc['keywordler']);

                if($sonucCount > 0){
                    for ( $i = 0; $i < $sonucCount; $i++ ) {
                        echo $sonuc['keywordler'][$i].', ';
                    }
                }
            }
        }
    }
    wp_die();
}
add_action( 'wp_ajax_wpkf_keywords_ajax', 'wpkf_keywords_ajax' );