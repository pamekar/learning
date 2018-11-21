<?php

/*
   Class: AcademistElatedClassMultipleImages
   A class that initializes Elated LMS Course Sections
*/
class AcademistLMSCourseSectionsMetaBox implements iAcademistElatedInterfaceRender {
    private $name;
    private $label;
    private $description;

    function __construct($name, $label="", $description="") {
        global $academist_elated_global_Framework;
        $this->name = $name;
        $this->label = $label;
        $this->description = $description;
        $academist_elated_global_Framework->eltdMetaBoxes->addOption($this->name,"");
    }

    public function render($factory) {

        global $post;
        $rows = empty($post->ID) ? array() : get_post_meta($post->ID, 'eltdf_course_curriculum', true);

        //Get list of lessons;
        $academist_lessons = array();
        $lessons = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'lesson',
                'post_status' => 'publish',
            )
        );
        foreach ($lessons as $lesson) {
            $academist_lessons[$lesson->ID] = $lesson->post_title;
        }

        //Get list of quizzes;
        $academist_quizzes = array();
        $quizzes = get_posts(
            array(
                'numberposts' => -1,
                'post_type' => 'quiz',
                'post_status' => 'publish'
            )
        );
        foreach ($quizzes as $quiz) {
            $academist_quizzes[$quiz->ID] = $quiz->post_title;
        }

        ?>
        <input type="hidden" id="course_id" name="course_id" value="<?php echo esc_attr($post->ID); ?>">
        <div id="eltdf-course-section-content" class="eltdf-repeater-fields-holder eltdf-enable-pc eltdf-sortable-holder clearfix">
            <?php if(is_array($rows) && count($rows)) :
            $i = 0;
            ?>
            <?php foreach($rows as $key=>$value) : ?>
            <div class="eltdf-course-section eltdf-repeater-fields-row eltdf-sort-parent first-level" data-index="<?php echo esc_attr($i); ?>">
                <div class="eltdf-repeater-fields-row-inner">
                    <div class="eltdf-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="eltdf-repeater-field-item">
                        <div class="eltdf-page-form-section eltdf-repeater-field eltdf-no-description">
                            <div class="eltdf-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Name', 'academist-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control eltdf-input eltdf-form-element" value="<?php echo esc_attr($value['section_name']); ?>" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_name]">
                                            </div>
                                            <h4><?php esc_html_e('Section Title', 'academist-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control eltdf-input eltdf-form-element" value="<?php echo esc_attr($value['section_title']); ?>" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_title]">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Description', 'academist-lms'); ?></h4>
                                            <div class="form-group">
                                                <textarea type="text" rows="6" class="form-control eltdf-input eltdf-form-element" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_description]"><?php echo esc_attr($value['section_description']); ?></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eltdf-sortable-holder" id="eltdf-course-section-elements-<?php echo esc_attr($i); ?>">
                            <?php if(!empty($value['section_elements']) && is_array($value['section_elements']) && count($value['section_elements'])) : ?>
                                <?php $j = 0; ?>
                                <?php foreach($value['section_elements'] as $element) : ?>
                                    <?php if($element['type'] == 'lesson'): ?>
                                    <div class="eltdf-course-element eltdf-repeater-fields-row eltdf-sort-child second-level" data-index="<?php echo esc_attr($j); ?>">
                                        <div class="eltdf-repeater-fields-row-inner">
                                            <div class="eltdf-repeater-sort">
                                                <i class="fa fa-sort"></i>
                                            </div>
                                            <div class="eltdf-repeater-field-item">
                                                <div class="eltdf-page-form-section eltdf-repeater-field eltdf-no-description">
                                                    <div class="eltdf-section-content">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="eltdf-inner-field-holder">
                                                                        <input type="hidden" value="lesson" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][type]">
                                                                        <select class="eltdf-select2 form-control eltdf-form-element" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][value]">
                                                                            <?php foreach($academist_lessons as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                                                <option <?php if ($element['value'] == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="eltdf-repeater-remove">
                                                <a href="#" class="eltdf-course-lesson-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_attr_e('Remove Section', 'academist-lms'); ?>"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php elseif($element['type'] == 'quiz'): ?>
                                    <div class="eltdf-course-element eltdf-repeater-fields-row eltdf-sort-child second-level" data-index="<?php echo esc_attr($j); ?>">
                                        <div class="eltdf-repeater-fields-row-inner">
                                            <div class="eltdf-repeater-sort">
                                                <i class="fa fa-sort"></i>
                                            </div>
                                            <div class="eltdf-repeater-field-item">
                                                <div class="eltdf-page-form-section eltdf-repeater-field eltdf-no-description">
                                                    <div class="eltdf-section-content">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <div class="eltdf-inner-field-holder">
                                                                        <input type="hidden" value="quiz" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][type]">
                                                                        <select class="eltdf-select2 form-control eltdf-form-element" name="eltdf_course_curriculum[<?php echo esc_attr($i); ?>][section_elements][<?php echo esc_attr($j); ?>][value]">
                                                                            <?php foreach($academist_quizzes as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                                                <option <?php if ($element['value'] == $key) { echo "selected='selected'"; } ?>  value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                                            <?php } ?>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="eltdf-repeater-remove">
                                                <a href="#" class="eltdf-course-quiz-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_attr_e('Remove Section', 'academist-lms'); ?>"><i class="fa fa-times"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                    <?php $j++; ?>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </div>
                        <div class="eltdf-course-section-controls">
                            <div class="eltdf-repeater-add">
                                <a id="eltdf-course-lesson-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Lesson', 'academist-lms'); ?></a>
                                <a id="eltdf-course-quiz-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Quiz', 'academist-lms'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="eltdf-repeater-remove">
                        <a href="#" class="eltdf-course-section-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_attr_e('Remove Section', 'academist-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
            <?php
            $i++;
            endforeach;
                ?>
            <?php endif; ?>
        </div>

        <div class="eltdf-course-section-controls">
            <div class="eltdf-repeater-add">
                <a id="eltdf-course-section-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Section', 'academist-lms'); ?></a>
            </div>
        </div>

        <script type="text/html" id="tmpl-eltdf-course-section-template">
            <div class="eltdf-course-section eltdf-repeater-fields-row eltdf-sort-parent first-level" data-index="{{{ data.rowIndex }}}">
                <div class="eltdf-repeater-fields-row-inner">
                    <div class="eltdf-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="eltdf-repeater-field-item">
                        <div class="eltdf-page-form-section eltdf-repeater-field eltdf-no-description">
                            <div class="eltdf-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Name', 'academist-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control eltdf-input eltdf-form-element" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_name]">
                                            </div>
                                            <h4><?php esc_html_e('Section Title', 'academist-lms'); ?></h4>
                                            <div class="form-group">
                                                <input type="text" class="form-control eltdf-input eltdf-form-element" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_title]">
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4><?php esc_html_e('Section Description', 'academist-lms'); ?></h4>
                                            <div class="form-group">
                                                <textarea type="text" rows="6" class="form-control eltdf-input eltdf-form-element" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_description]"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="eltdf-sortable-holder" id="eltdf-course-section-elements-{{{ data.rowIndex }}}">

                        </div>
                        <div class="eltdf-course-section-controls">
                            <div class="eltdf-repeater-add">
                                <a id="eltdf-course-lesson-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Lesson', 'academist-lms'); ?></a>
                                <a id="eltdf-course-quiz-add" href="#" class="btn btn-primary"><?php esc_html_e('Add New Quiz', 'academist-lms'); ?></a>
                            </div>
                        </div>
                    </div>
                    <div class="eltdf-repeater-remove">
                        <a href="#" class="eltdf-course-section-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_attr_e('Remove Section', 'academist-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </script>

        <script type="text/html" id="tmpl-eltdf-section-lesson-template">
            <div class="eltdf-course-element eltdf-repeater-fields-row eltdf-sort-child second-level" data-index="{{{ data.lessonIndex }}}">
                <div class="eltdf-repeater-fields-row-inner">
                    <div class="eltdf-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="eltdf-repeater-field-item">
                        <div class="eltdf-page-form-section eltdf-repeater-field eltdf-no-description">
                            <div class="eltdf-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="eltdf-inner-field-holder">
                                                <input type="hidden" value="lesson" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.lessonIndex }}}][type]">
                                                <select class="eltdf-select2 form-control eltdf-form-element" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.lessonIndex }}}][value]">
                                                    <?php foreach($academist_lessons as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                        <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="eltdf-repeater-remove">
                        <a href="#" class="eltdf-course-lesson-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_attr_e('Remove Lesson', 'academist-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </script>

        <script type="text/html" id="tmpl-eltdf-section-quiz-template">
            <div class="eltdf-course-element eltdf-repeater-fields-row eltdf-sort-child second-level" data-index="{{{ data.quizIndex }}}">
                <div class="eltdf-repeater-fields-row-inner">
                    <div class="eltdf-repeater-sort">
                        <i class="fa fa-sort"></i>
                    </div>
                    <div class="eltdf-repeater-field-item">
                        <div class="eltdf-page-form-section eltdf-repeater-field eltdf-no-description">
                            <div class="eltdf-section-content">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="eltdf-inner-field-holder">
                                                <input type="hidden" value="quiz" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.quizIndex }}}][type]">
                                                <select class="eltdf-select2 form-control eltdf-form-element" name="eltdf_course_curriculum[{{{ data.rowIndex }}}][section_elements][{{{ data.quizIndex }}}][value]">
                                                    <?php foreach($academist_quizzes as $key=>$value) { if ($key == "-1") $key = ""; ?>
                                                        <option value="<?php echo esc_attr($key); ?>"><?php echo esc_html($value); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="eltdf-repeater-remove">
                        <a href="#" class="eltdf-course-lesson-remove-item" data-toggle="tooltip" data-placement="left" title="<?php esc_attr_e('Remove Quiz', 'academist-lms'); ?>"><i class="fa fa-times"></i></a>
                    </div>
                </div>
            </div>
        </script>

        <?php
    }
}