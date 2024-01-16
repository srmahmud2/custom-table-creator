<?php
defined('ABSPATH') or die('Access denied: Direct script access is not allowed.');

function custom_table_creator_admin_page() {
    ?>
    <div class="wrap">
        <h2>Create Custom Table</h2>
        <form method="post" action="">
            <?php wp_nonce_field('custom_table_creator_action', 'custom_table_creator_nonce'); ?>

            <label for="table_name">Table Name:</label>
            <input type="text" name="table_name" id="table_name" required><br><br>

            <label for="columns_number">Number of Columns:</label>
            <input type="number" name="columns_number" id="columns_number" min="1" required><br><br>

            <div id="columns_container"></div>

            <input type="submit" name="create_table" value="Create Table">
        </form>
    </div>

    <script>
        document.getElementById('columns_number').addEventListener('change', function() {
            var container = document.getElementById('columns_container');
            container.innerHTML = '';
            var columnsNumber = this.value;

            for (var i = 0; i < columnsNumber; i++) {
                container.appendChild(createColumnFields(i));
            }
        });

        function createColumnFields(index) {
            var div = document.createElement('div');
            div.innerHTML = `
                <h4>Column ${index + 1}</h4>
				<div class="custom-table-creator-container">
					<div class="custom-table-creator-input-group">
						<label for="column_name_${index}">Name:</label>
						<input type="text" name="column_name_${index}" required>
					</div>
					<div class="custom-table-creator-input-group">
						<label for="column_type_${index}">Type:</label>
						<select name="column_type_${index}">
							<option value="INT">INT</option>
							<option value="VARCHAR">VARCHAR</option>
							<option value="TEXT">TEXT</option>
							<option value="DATE">DATE</option>
							<!-- Add other types as needed -->
						</select>
					</div>
					<div class="custom-table-creator-input-group">
						<label for="column_length_${index}">Length/Values:</label>
						<input type="text" name="column_length_${index}">
					</div>
					<div class="custom-table-creator-checkbox-group">
						<input type="checkbox" name="column_primary_${index}" id="column_primary_${index}">
						<label for="column_primary_${index}">Primary Key</label>
					</div>
					<div class="custom-table-creator-checkbox-group">
						<input type="checkbox" name="column_auto_increment_${index}" id="column_auto_increment_${index}">
						<label for="column_auto_increment_${index}">Auto Increment</label>
					</div>
				</div>
            `;
            return div;
        }
    </script>
    <?php
}
