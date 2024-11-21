<?php 

$countries = array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua and Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bonaire, Sint Eustatius and Saba", "Bosnia and Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cabo Verde", "Cambodia", "Cameroon", "Canada", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Croatia", "Cuba", "Curaçao", "Cyprus", "Czechia", "Côte d'Ivoire", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Eswatini", "Ethiopia", "Falkland Islands", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island and McDonald Islands", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea, Democratic People's Republic of", "Korea, Republic of", "Kuwait", "Kyrgyzstan", "Lao People's Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "North Macedonia", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestine, State of", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Romania", "Russian Federation", "Rwanda", "Réunion", "Saint Barthélemy", "Saint Helena, Ascension and Tristan da Cunha", "Saint Kitts and Nevis", "Saint Lucia", "Saint Martin", "Saint Pierre and Miquelon", "Saint Vincent and the Grenadines", "Samoa", "San Marino", "Sao Tome and Principe", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Sint Maarten", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia and the South Sandwich Islands", "South Sudan", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard and Jan Mayen", "Sweden", "Switzerland", "Syria Arab Republic", "Taiwan", "Tajikistan", "Tanzania, the United Republic of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad and Tobago", "Tunisia", "Turkmenistan", "Turks and Caicos Islands", "Tuvalu", "Türkiye", "US Minor Outlying Islands", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands, British", "Virgin Islands, U.S.", "Wallis and Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe", "Åland Islands");

$legislations = array("General Data Protection", "Cybercrime and Cybersecurity", "Primary Health Care", "Health Insurance", "Universal Health Care (UHC)", "General Health Care", "Digital Health", "Health Data Governance (specific)", "Emerging Tech", "Anti-Discrimination and Human Rights");
$stages = array("Directive in Force", "Regulation in Force", "Approved Regulation", "Approved Legislation", "Ratified or Acceded Convention", "Bill Introduced", "Drafting Legislation", "Signed Convention (did not ratify or accede)", "Planning (consultation, calls for an act)", "No Planned Legislation");

$checklists = array("Data Protection and Privacy", "Cybercrime and Cyber Security", "General Health", "Digital Health-Specific", "International Instruments", "Emerging Technologies");

$core_prinicples_1 = array("Address individual and collective risk", "Collect data with a defined purposes", "Collect personal or sensitive data only when necessary and with informed consent", "Use secure data collection and storage mechanisms", "Use de-identification and anonymisation", "Define inappropriate uses of health data", "Institute safeguards against discrimination, stigma, harassment and bias", "Provide guidance specific to marginalised groups and populations", "Align with best practices for data protection and privacy", "Ensure consent is informed and understood in all its complexities", "Obtain collective consent where appropriate", "Define concrete exceptions to informed consent", "Ensure data quality, availability, and accessibility", "Reinforce health data governance with evidence", "Establish transparent and accessible processes and systems", "Institute feedback and accountability mechanisms", "Require strong technical security measures for data processing", "Mitigate risks related to security threats", "Ensure transparency around data breaches", "Consider federated data systems");

$core_prinicples_2 = array("Evaluate the benefits of health data", "Use data to enhance health services for individuals and communities", "Encourage a culture of data-led insights and action", "Address health system efficiency, effectiveness, and resilience", "Strengthen community ownership of health data", "Enable and empower frontline health workers", "Establish data sharing rules and guidelines", "Validate informed consent before sharing data", "Promote interoperability of data systems", "Define common data structures across health systems", "Define multiple levels of data access", "se common definitions and global standards", "Support multi-sector partnerships", "Apply health data governance to emerging technologies", "Address the use of non-health data in health contexts", "Build public health data infrastructure", "Employ policy innovation");

$core_prinicples_3 = array("Represent all groups and populations equitably in data", "Consider the unique needs of marginalised groups and populations", "Mitigate data bias", "Use accessible language and plug knowledge gaps", "Implement inclusive data feedback mechanisms", "Promote equitable impact and benefit", "Apply a human rights lens to health data governance", "Define clear governance roles and responsibilities", "Codify data rights and ownership", "Extend data rights and ownership to products and services", "Develop health data trusts and health data cooperatives", "Employ participatory data governance mechanisms", "Connect to broader accountability");

//Merge arrays
$principles = array_merge($core_prinicples_1, $core_prinicples_2, $core_prinicples_3);
?>
<style>
    .error {
        border-color: red;
    }
    .error-message {
        color: red;
        font-size: 0.875em;
        margin-top: 0.25em;
    }
    .previewForm {
    }
</style>
<script src="<?php echo get_template_directory_uri(); ?>/src/vendor/jspdf/jspdf.umd.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        function downloadTXT(event) {
            event.preventDefault(); // Prevent form submission
            if (!validateForm()) {
                return;
            }
            const formPreview = document.getElementById('previewForm');
            //Generate a TXT file
            const element = document.createElement('a');
            const file = new Blob([formPreview.innerText], { type: 'text/plain' });
            element.href = URL.createObjectURL(file);
            element.download = 'assessment.txt';
            document.body.appendChild(element); // Required for this to work in FireFox
            element.click();
        }

        function downloadPDF(event) {

            event.preventDefault(); // Prevent form submission
            // Import jsPDF from the library
            const { jsPDF } = window.jspdf;

            // Create a new instance of jsPDF
            const pdf = new jsPDF();

            // Get the content of #preview
            const content = document.getElementById('previewForm').innerText;

            // console.log(content);

            // Set the font size
            pdf.setFontSize(10);

            // Add the content to the PDF
            pdf.text(content, 10, 10); // Start at 10,10 (x, y)

            // Save the PDF
            pdf.save('preview.pdf');
        }
        

        function addToPreview(label, value) {
            const previewElement = document.getElementById('previewForm');
            const previewItem = document.createElement('div');
            previewItem.className = 'preview-item';
            previewItem.innerHTML = `<strong>${label}:</strong><br> ${value}`;
            previewElement.appendChild(previewItem);
        }

        function updatePreview() {

            const formElement = document.getElementById('assessmentForm');
            const previewElement = document.getElementById('previewForm');
            previewElement.innerHTML = ''; // Clear previous content

            const country = formElement.querySelector('select[name="country"]')?.value || '';
            const legislation = formElement.querySelector('select[name="legislation"]')?.value || '';
            const specificActName = formElement.querySelector('input[name="specificActName"]')?.value || '';
            const sourceDocumentLink = formElement.querySelector('input[name="sourceDocumentLink"]')?.value || '';
            const year = formElement.querySelector('input[name="year"]')?.value || '';
            const stage = formElement.querySelector('select[name="stage"]')?.value || '';
            const resultsDetail = formElement.querySelector('textarea[name="resultsDetail"]')?.value || '';

            //Add country to the preview
            const countryItem = document.createElement('div');
            countryItem.innerHTML = `<strong>Country:</strong> ${country}`;
            previewElement.appendChild(countryItem);

            //Add legislation to the preview
            const legislationItem = document.createElement('div');
            legislationItem.innerHTML = `<strong>Legislation:</strong> ${legislation}`;
            previewElement.appendChild(legislationItem);

            //Add specific act name to the preview
            const specificActNameItem = document.createElement('div');
            specificActNameItem.innerHTML = `<strong>Specific Act Name:</strong> ${specificActName}`;
            previewElement.appendChild(specificActNameItem);

            //Add source document link to the preview
            const sourceDocumentLinkItem = document.createElement('div');
            sourceDocumentLinkItem.innerHTML = `<strong>Source Document Link:</strong> ${sourceDocumentLink}`;
            previewElement.appendChild(sourceDocumentLinkItem);

            //Also update the prompt value in #sourceDocumentURL
            if(document.getElementById('sourceDocumentURL')) {
                document.getElementById('sourceDocumentURL').textContent = sourceDocumentLink;
            }

            //Add year to the preview
            const yearItem = document.createElement('div');
            yearItem.innerHTML = `<strong>Year:</strong> ${year}`;
            previewElement.appendChild(yearItem);

            //Add stage to the preview
            const stageItem = document.createElement('div');
            stageItem.innerHTML = `<strong>Stage:</strong> ${stage}`;
            previewElement.appendChild(stageItem);

            //Add resultsDetail to the preview
            if(resultsDetail) {
                const resultsDetailItem = document.createElement('div');
                resultsDetailItem.innerHTML = `<strong>Results:</strong> ${resultsDetail}`;
                previewElement.appendChild(resultsDetailItem);
            }

            const formElements = formElement.querySelectorAll('input[type="checkbox"]');
            const checkboxGroups = {};

            formElements.forEach(element => {

                const fieldset = element.closest('fieldset');
                const legend = fieldset ? fieldset.querySelector('.govuk-details__summary-text') : null;
                const label = formElement.querySelector(`label[for="${element.id}"]`);
                const value = element.value;

                if (legend && label && element.type === 'checkbox' && element.checked) {
                    if (!checkboxGroups[legend.textContent]) {
                        checkboxGroups[legend.textContent] = [];
                    }
                    checkboxGroups[legend.textContent].push(label.textContent);
                }

            });

             // Append checkbox groups to the preview
             for (const [legendText, labels] of Object.entries(checkboxGroups)) {
                addToPreview(legendText, labels.join('<br>'));
            }

        }

        function validateForm() {

            const formElement = document.getElementById('assessmentForm');
            const requiredFields = formElement.querySelectorAll('[required]');
            let isValid = true;

            console.log(requiredFields);

            requiredFields.forEach(field => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.classList.add('error');
                    const errorMessage = document.createElement('div');
                    errorMessage.className = 'error-message';
                    errorMessage.textContent = 'This field is required';
                    if (!field.nextElementSibling || !field.nextElementSibling.classList.contains('error-message')) {
                        field.parentNode.insertBefore(errorMessage, field.nextSibling);
                    }
                } else {
                    field.classList.remove('error');
                    if (field.nextElementSibling && field.nextElementSibling.classList.contains('error-message')) {
                        field.nextElementSibling.remove();
                    }
                }
            });

            return isValid;
        }

        // Add event listeners to form elements
        const formElements = document.querySelectorAll('#assessmentForm input, #assessmentForm select, #assessmentForm textarea');
        formElements.forEach(element => {
            element.addEventListener('change', updatePreview);
        });

        //If the button #downloadPDF is clicked, download the PDF
        document.getElementById('downloadForm').addEventListener('click', downloadPDF);

        
        
    });
</script>

<form id="assessmentForm" method="get">
    <fieldset class="govuk-fieldset stack stack-large">

        <legend class="govuk-fieldset__legend govuk-fieldset__legend--l">
            <h1 class="govuk-fieldset__heading">
                <?php esc_html_e( 'Assestment Framework', 'hdg' ); ?>
            </h1>
        </legend>

        <div class="stack hdg-principles-form__legislation">

            <h2 id="step-1"><?php esc_html_e( 'Step 1 - Country-Specific Legislation', 'hdg' ); ?></h2>

            <?php 
            //Add multiple rows of the
            ?>

            <div class="govuk-form-group">
                <label class="govuk-label govuk-label--m" for="country">
                    <?php esc_html_e( 'Country', 'hdg' ); ?>
                </label>
                <select class="govuk-select" id="country" name="country" required>
                    <option value=""><?php esc_html_e( 'Select Country', 'hdg' ); ?></option>
                    <?php foreach ( $countries as $country ) : ?>
                        <option value="<?php echo esc_attr( $country ); ?>">
                            <?php echo esc_html( $country ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="govuk-form-group">
                <label class="govuk-label govuk-label--m" for="legislation">
                    <?php esc_html_e( 'Legislation method', 'hdg' ); ?>
                </label>
                <select class="govuk-select" id="legislation" name="legislation">
                    <option value=""><?php esc_html_e( 'Select Legislation method', 'hdg' ); ?></option>
                    <?php foreach ( $legislations as $legislation ) : ?>
                        <option value="<?php echo esc_attr( $legislation ); ?>">
                            <?php echo esc_html( $legislation ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="govuk-form-group">
                <label class="govuk-label govuk-label--m" for="specific-act-name">
                    <?php esc_html_e( 'Specific Act Name', 'hdg' ); ?>
                </label>
                <input class="govuk-input" id="specific-act-name" name="specificActName" type="text" required>
            </div>

            <div class="govuk-form-group">
                <label class="govuk-label govuk-label--m" for="source-document-link">
                    <?php esc_html_e( 'Source document link', 'hdg' ); ?>
                </label>
                <input class="govuk-input" id="source-document-link" name="sourceDocumentLink" type="text" required>
            </div>

            <div class="govuk-form-group">
                <div class="govuk-date-input" id="year">
                    <div class="govuk-date-input__item">
                        <div class="govuk-form-group">
                        <label class="govuk-label govuk-label--m govuk-date-input__label" for="year">
                            <?php esc_html_e( 'Year', 'hdg' ); ?>
                        </label>
                        <input class="govuk-input govuk-date-input__input govuk-input--width-4" id="year" name="year" type="text" inputmode="numeric">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="govuk-form-group">
                <label class="govuk-label govuk-label--m" for="stage">
                    <?php esc_html_e( 'Stage of Implementation', 'hdg' ); ?>
                </label>
                <select class="govuk-select" id="stage" name="stage">
                    <option value=""><?php esc_html_e( 'Select Stage of Implementation', 'hdg' ); ?></option>
                    <?php foreach ( $stages as $stage ) : ?>
                        <option value="<?php echo esc_attr( $stage ); ?>">
                            <?php echo esc_html( $stage ); ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        
        <div class="stack hdg-principles-form__detail">
            <h2 id="step-2"><?php esc_html_e( 'Step 2 - Country-Specific Detail', 'hdg' ); ?></h2>

            <?php /* ?>
            <p>
                <?php esc_html_e( 'This will take the source document link as provided in Step 1 and generate AI reponsed based on the Core Principles', 'hdg' ); ?>
            </p>
            <p>
                <a href="Generate via AI" class="govuk-button">Generate via AI</a> 
            </p>
            <?php */ ?>
            
            <p>
                <?php esc_html_e( 'Use the below prompt to generate potential matching summaries from the source document against the Core Prinicples', 'hdg' ); ?>

                <?php 
                /*
                Buttons for AI tools
                */
                ?>

            </p>
            <div class="govuk-notification-banner" role="region" aria-labelledby="govuk-notification-banner-title" data-module="govuk-notification-banner">
                <div class="govuk-notification-banner__header">
                    <h2 class="govuk-notification-banner__title" id="govuk-notification-banner-title">
                    Prompt
                    </h2>
                </div>
                <div class="govuk-notification-banner__content">
                    <p class="govuk-notification-banner__heading govuk-!-text-break-word">
                        Task: Using the document defined here: <span id="sourceDocumentURL">[source document link]</span>
                    </p>
                    <p class="govuk-notification-banner__heading govuk-!-text-break-word ">
                        Identify the clauses or specific sentences that correspond to each of the following core principles found here https://hdg-staging.mystagingwebsite.com/wp-content/themes/hdg/src/vendor/core-principles.txt. 
                    </p>
                    <p class="govuk-notification-banner__heading">
                        For each principle, provide the relevant clause or sentence from the document in a table format. 
                    </p>
                    <p class="govuk-notification-banner__heading">
                    Search for any clauses or sentences that align with the given description. Extract the specific clause or sentence, and match it to the corresponding core principle. Present your findings in a table, including the principle, the matching clause/sentence, and the clause number or section if possible.
                    </p>
                </div>
            </div>

            <div class="govuk-form-group">
                <label class="govuk-label" for="results-detail"><?php esc_html_e( 'Results', 'hdg' ); ?></label>
                <textarea class="govuk-textarea" id="results-detail" name="resultsDetail" rows="5" ></textarea>
            </div>

            <?php 
            /*
            Buttons for AI tools
            */
            ?>
            

        </div>

        <div class="stack stack-large hdg-principles-form__summary">
        
        <h2 id="step-3"><?php esc_html_e( 'Step 3 - Country-Specific Summary', 'hdg' ); ?></h2>
        <div>
        <?php 
        function render_principles($principles, $major_version, $minor_version, $checklists) {
            $patch_version = 0;
            foreach ( $principles as $principle ) : 
                $patch_version++;
                $version = sprintf('%d.%d.%d', $major_version, $minor_version, $patch_version);
            ?>
            <fieldset class="govuk-fieldset govuk-fieldset--checkboxes">
                <details class="govuk-details">
                <summary class="govuk-details__summary">
                        <span class="govuk-details__summary-text"><?php echo esc_html( $version . ' - ' . $principle ); ?></span>
                </summary>
                <div class="govuk-details__text">
                    <?php foreach ( $checklists as $checklist ) : ?>
                        <div class="govuk-checkboxes__item">
                            <input class="govuk-checkboxes__input" id="principle-<?php echo esc_attr( $principle ); ?>-<?php echo esc_attr( $checklist ); ?>" name="principle[<?php echo esc_attr( $principle ); ?>][]" type="checkbox" value="<?php echo esc_attr( $checklist ); ?>">
                            <label class="govuk-label govuk-checkboxes__label" for="principle-<?php echo esc_attr( $principle ); ?>-<?php echo esc_attr( $checklist ); ?>">
                                <?php echo esc_html( $checklist ); ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <?php /* ?>
                    <div class="govuk-form-group">
                        <label class="govuk-label" for="notes-detail"><?php esc_html_e( 'Notes', 'hdg' ); ?></label>
                        <div id="notes-detail-hint" class="govuk-hint"><?php esc_html_e( 'Including on structural aspects, as applicable', 'hdg' ); ?></div>
                        <textarea class="govuk-textarea" id="more-detail" name="notesDetail" rows="5" aria-describedby="notes-detail-hint"></textarea>
                    </div>
                    <?php */ ?>
                    
                    <!-- 
                    Add Rows - Source document
                    
                    //Prompt >> 
                    //Sample text - AI
                    //Source document name
                    //Dropdown of legislation type 
                    //Dropdown Core priniciples -->

                
                </div>
                </details>
</fieldset>
            <?php endforeach;
        }

        render_principles($core_prinicples_1, 1, 1, $checklists);
        render_principles($core_prinicples_2, 2, 1, $checklists);
        render_principles($core_prinicples_3, 3, 1, $checklists);
        ?>


</div>
                
    </div>

    <div class="govuk-form-group stack stack-large">

            <h2><?php esc_html_e( 'Preview', 'hdg' ); ?></h2>   
            <div id="previewForm" class="previewForm stack"></div>

            <a class="govuk-button" type="submit" id="downloadForm">
                <?php esc_html_e( 'Download Form', 'hdg' ); ?>
            </a>
        </div>
                    
        

    </fieldset>
</form>