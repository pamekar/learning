<div class="eltdf-tabs-content">
	<div class="tab-content">
		<div class="tab-pane fade in active" id="import">
			<div class="eltdf-tab-content">
				<h2 class="eltdf-page-title"><?php esc_html_e('Backup Options', 'academist'); ?></h2>
				<form method="post" class="eltdf_ajax_form eltdf-backup-options-page-holder">
					<div class="eltdf-page-form">
						<div class="eltdf-page-form-section-holder">
							<h3 class="eltdf-page-section-title"><?php esc_html_e('Export/Import Options', 'academist'); ?></h3>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Export', 'academist'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'academist'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control eltdf-form-element" rows="10" readonly><?php echo academist_core_export_options(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Import', 'academist'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'academist'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_theme_options" id="import_theme_options" class="form-control eltdf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="eltdf-import-theme-options-btn"><?php esc_html_e('Import', 'academist'); ?></button>
									<?php wp_nonce_field('eltdf_import_theme_options_secret_value', 'eltdf_import_theme_options_secret', false); ?>
									<span class="eltdf-bckp-message"></span>
								</div>
							</div>
							<div class="eltdf-page-form-section eltdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'academist') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will overide all your existing options.', 'academist'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="eltdf-page-form-section-holder">
							<h3 class="eltdf-page-section-title"><?php esc_html_e('Export/Import Custom Sidebars', 'academist'); ?></h3>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Export', 'academist'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'academist'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_options" id="export_options" class="form-control eltdf-form-element" rows="10" readonly><?php echo academist_core_export_custom_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Import', 'academist'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'academist'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_custom_sidebars" id="import_custom_sidebars" class="form-control eltdf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="eltdf-import-custom-sidebars-btn"><?php esc_html_e('Import', 'academist'); ?></button>
									<?php wp_nonce_field('eltdf_import_custom_sidebars_secret_value', 'eltdf_import_custom_sidebars_secret', false); ?>
									<span class="eltdf-bckp-message"></span>
								</div>
							</div>
							<div class="eltdf-page-form-section eltdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'academist') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing custom sidebars.', 'academist'); ?></li>
									</ul>
								</div>
							</div>
						</div>
						<div class="eltdf-page-form-section-holder">
							<h3 class="eltdf-page-section-title"><?php esc_html_e('Export/Import Widgets', 'academist'); ?></h3>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Export', 'academist'); ?></h4>
									<p><?php esc_html_e('Copy the code from this field and save it to a textual file to export your options. Save that textual file somewhere so you can later use it to import options if necessary.', 'academist'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="export_widgets" id="export_widgets" class="form-control eltdf-form-element" rows="10" readonly><?php echo academist_core_export_widgets_sidebars(); ?></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<h4><?php esc_html_e('Import', 'academist'); ?></h4>
									<p><?php esc_html_e('To import options, just paste the code you previously saved from the "Export" field into this field, and then click the "Import" button.', 'academist'); ?></p>
								</div>
								<div class="eltdf-section-content">
									<div class="container-fluid">
										<div class="row">
											<div class="col-lg-12">
												<textarea name="import_widgets" id="import_widgets" class="form-control eltdf-form-element" rows="10"></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="eltdf-page-form-section">
								<div class="eltdf-field-desc">
									<button type="button" class="btn btn-primary btn-sm " name="import" id="eltdf-import-widgets-btn"><?php esc_html_e('Import', 'academist'); ?></button>
									<?php wp_nonce_field('eltdf_import_widgets_secret_value', 'eltdf_import_widgets_secret', false); ?>
									<span class="eltdf-bckp-message"></span>
								</div>
							</div>
							<div class="eltdf-page-form-section eltdf-import-button-wrapper">
								<div class="alert alert-warning">
									<strong><?php esc_html_e('Important notes:', 'academist') ?></strong>
									<ul>
										<li><?php esc_html_e('Please note that import process will override all your existing widgets.', 'academist'); ?></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>