<div class="plugin-setting-container">
    <h3><?php esc_html_e('Custom Contact Form', 'custom-form'); ?></h3>
    <h4><?php echo esc_html_e('Use below shortcode any post or page to display contact form with (Name, email, Contact No, Comment and country field).'); ?></h4>
    <h3><?php echo esc_html_e('Shortcode: [custom_contact_form]'); ?></h3>
</div>
<div id="general-section" class="yoatab active plugin-setting-contain">
    <div class="rows">
        <table class="user-data-table">
            <thead>
                <tr>
                    <th><?php echo esc_html_e('Name', 'custom-form'); ?></th>
                    <th><?php echo esc_html_e('Email', 'custom-form'); ?></th>
                    <th><?php echo esc_html_e('Contact Number', 'custom-form'); ?></th>
                    <th><?php echo esc_html_e('Comment', 'custom-form'); ?></th>
                    <th><?php echo esc_html_e('Country', 'custom-form'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                global $wpdb;
                $results = $wpdb->get_results("SELECT * FROM {$wpdb->prefix}custom_contact_form_table");
                if (!empty($results)) {
                    foreach ($results as $result) {
                    echo "<tr>
                    <td>$result->name</td>
                    <td>$result->email</td>
                    <td>$result->contact_no</td>
                    <td>$result->comment</td>
                    <td>$result->country</td>
                    </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</div>
