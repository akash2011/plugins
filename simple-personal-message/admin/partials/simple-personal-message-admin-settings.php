                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           <?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the Admin option form.
 *
 * @link       http://softyardbd.com/
 * @since      1.0.3
 *
 * @package    Simple_Personal_Message
 * @subpackage Simple_Personal_Message/admin/partials
 */
?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->

<?php

$settings = new Simple_Personal_Message_Admin('', '');

$result = $settings->load_personalize_by_user();

if ($result['spm_unread_row_border'] != 'border: none') {

    $unread_border = explode(' ', $result['spm_unread_row_border']);

    $unread_sides = explode('-', $unread_border[0]);

}

if ($result['spm_read_row_border'] != 'border: none') {

    $read_border = explode(' ', $result['spm_read_row_border']);

    $read_sides = explode('-', $read_border[0]);

}

?>

<div id="divLoading"></div>

<div class="container-fluid admin-wrap">

    <div id="post-message"></div>

    <div class="row">

        <div class="panel panel-default">

            <div class="panel-heading">

                <strong><?php echo esc_html(get_admin_page_title()); ?></strong>

                <span class="label label-info"></span>

            </div>

            <div class="panel-body">

                <form class="form-horizontal">

                    <div class="form-group">

                        <label for="spm_message_per_page" class="col-sm-3 control-label">Maximum message per page</label>

                        <div class="col-sm-9">

                            <input type="number" class="form-control" id="spm_message_per_page" placeholder="Maximum message per page" value="<?= (isset($result['spm_message_per_page']) ? $result['spm_message_per_page'] : '') ?>">

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="spm_message_inbox_keep" class="col-sm-3 control-label">Maximum days to keep old message (inbox)</label>

                        <div class="col-sm-9">

                            <select class="form-control" id="spm_message_inbox_keep">

                                <option value="keep" <?php selected($result['spm_message_inbox_keep'], "keep"); ?>>Keep forever</option>

                                <option value="30" <?php selected($result['spm_message_inbox_keep'], "30"); ?>>Keep for 30 Days</option>

                                <option value="60" <?php selected($result['spm_message_inbox_keep'], "60"); ?>>Keep for 60 Days</option>

                                <option value="90" <?php selected($result['spm_message_inbox_keep'], "90"); ?>>Keep for 90 Days</option>

                                <option value="120" <?php selected($result['spm_message_inbox_keep'], "120"); ?>>Keep for 120 Days</option>

                            </select>

                        </div>

                    </div>

                    <div class="form-group">

                        <label for="spm_message_outbox_keep" class="col-sm-3 control-label">Maximum days to keep old message (outbox)</label>

                        <div class="col-sm-9">

                            <select class="form-control" id="spm_message_outbox_keep">

                                <option value="keep" <?php selected($result['spm_message_outbox_keep'], "keep"); ?>>Keep forever</option>

                                <option value="30" <?php selected($result['spm_message_outbox_keep'], "30"); ?>>Keep for 30 Days</option>

                                <option value="60" <?php selected($result['spm_message_outbox_keep'], "60"); ?>>Keep for 60 Days</option>

                                <option value="90" <?php selected($result['spm_message_outbox_keep'], "90"); ?>>Keep for 90 Days</option>

                                <option value="120" <?php selected($result['spm_message_outbox_keep'], "120"); ?>>Keep for 120 Days</option>

                            </select>

                        </div>

                    </div>

                    <hr>

                </form>

                <div class="col-sm-6">

                    <div class="panel panel-primary">

                        <div class="panel-heading">Configure Unread Style</div>

                        <div class="panel-body">

                            <form class="form-horizontal">

                                <div class="form-group">

                                    <label for="spm_unread_row_font_style" class="col-sm-3 control-label">Font Style</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_unread_row_font_style">

                                            <option value="font-style:normal" <?php selected($result['spm_unread_row_font_style'], 'font-style:normal'); ?>>Normal</option>

                                            <option value="font-style:italic" <?php selected($result['spm_unread_row_font_style'], 'font-style:italic'); ?>>Italic</option>

                                            <option value="font-style:oblique" <?php selected($result['spm_unread_row_font_style'], 'font-style:oblique'); ?>>Oblique</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="spm_unread_row_font_weight" class="col-sm-3 control-label">Font Weight</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_unread_row_font_weight">

                                            <option value="font-weight:200" <?php selected($result['spm_unread_row_font_weight'], 'font-weight:200'); ?>>Normal</option>

                                            <option value="font-weight:bold" <?php selected($result['spm_unread_row_font_weight'], 'font-weight:bold'); ?>>Bold</option>

                                            <option value="font-weight:bolder" <?php selected($result['spm_unread_row_font_weight'], 'font-weight:bolder'); ?>>Bolder</option>

                                        </select>

                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">

                                    <label for="spm_unread_row_border_sides" class="col-sm-3 control-label">Border Sides</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_unread_row_border_sides">

                                            <option value="none">None</option>

                                            <option value="left" <?php (isset($unread_sides[1])) ? selected(trim($unread_sides[1], ':'), 'left') : '' ?>>Left Border</option>

                                            <option value="right" <?php (isset($unread_sides[1])) ? selected(trim($unread_sides[1], ':'), 'right') : '' ?>>Right Border</option>

                                            <option value="top" <?php (isset($unread_sides[1])) ? selected(trim($unread_sides[1], ':'), 'top') : '' ?>>Top Border</option>

                                            <option value="bottom" <?php (isset($unread_sides[1])) ? selected(trim($unread_sides[1], ':'), 'bottom') : '' ?>>Bottom Border</option>

                                            <option value="all" <?php (isset($unread_sides[1])) ? selected(trim($unread_sides[1], ':'), 'all') : '' ?>>All Border</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="spm_unread_row_border_width" class="col-sm-3 control-label">Border Width</label>

                                    <div class="col-sm-2">

                                        <input type="number" class="form-control" id="spm_unread_row_border_width" value="<?= (isset($unread_border[1])) ? (int)$unread_border[1] : '' ?>" placeholder="1px">

                                    </div>

                                    <div class="col-sm-2">

                                        <select class="form-control" id="spm_unread_row_border_style">

                                            <option value="inline" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'inline') : '' ?>>Inline</option>

                                            <option value="solid" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'solid') : '' ?>>Solid</option>

                                            <option value="dotted" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'dotted') : '' ?>>Dotted</option>

                                            <option value="dashed" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'dashed') : '' ?>>Dashed</option>

                                            <option value="double" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'double') : '' ?>>Double</option>

                                            <option value="groove" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'groove') : '' ?>>Groove</option>

                                            <option value="ridge" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'ridge') : '' ?>>Ridge</option>

                                            <option value="inset" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'inset') : '' ?>>Inset</option>

                                            <option value="outset" <?php (isset($unread_border[2])) ? selected($unread_border[2], 'outset') : '' ?>>Outset</option>

                                        </select>

                                    </div>

                                    <div class="col-sm-4">

                                        <input type="text" class="wp-pick-color" id="spm_unread_row_border_color" value="<?= (isset($unread_border[3])) ? $unread_border[3] : '' ?>" placeholder="Color">

                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">

                                    <label for="spm_unread_row_text_decoration" class="col-sm-3 control-label">Text Decoration</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_unread_row_text_decoration">

                                            <option value="text-decoration:none" <?php selected($result['spm_unread_row_text_decoration'], 'text-decoration:none'); ?>>None</option>

                                            <option value="text-decoration:underline" <?php selected($result['spm_unread_row_text_decoration'], 'text-decoration:underline'); ?>>Underline</option>

                                            <option value="text-decoration:overline" <?php selected($result['spm_unread_row_text_decoration'], 'text-decoration:overline'); ?>>Overline</option>

                                            <option value="text-decoration:line-through" <?php selected($result['spm_unread_row_text_decoration'], 'text-decoration:line-through'); ?>>Line Through</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="spm_unread_row_background" class="col-sm-3 control-label">Row Background</label>

                                    <div class="col-sm-8">

                                        <input type="text" class="wp-pick-color" id="spm_unread_row_background" value="<?= (isset($result['spm_unread_row_background']) ? $result['spm_unread_row_background'] : '') ?>">

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

                <div class="col-sm-6">

                    <div class="panel panel-info">

                        <div class="panel-heading">Configure Read Style</div>

                        <div class="panel-body">

                            <form class="form-horizontal">

                                <div class="form-group">

                                    <label for="spm_read_row_font_style" class="col-sm-3 control-label">Font Style</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_read_row_font_style">

                                            <option value="font-style:normal" <?php selected($result['spm_read_row_font_style'], 'font-style:normal'); ?>>Normal</option>

                                            <option value="font-style:italic" <?php selected($result['spm_read_row_font_style'], 'font-style:italic'); ?>>Italic</option>

                                            <option value="font-style:oblique" <?php selected($result['spm_read_row_font_style'], 'font-style:oblique'); ?>>Oblique</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="spm_read_row_font_weight" class="col-sm-3 control-label">Font Weight</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_read_row_font_weight">

                                            <option value="font-weight:200" <?php selected($result['spm_read_row_font_weight'], 'font-weight:200'); ?>>Normal</option>

                                            <option value="font-weight:bold" <?php selected($result['spm_read_row_font_weight'], 'font-weight:bold'); ?>>Bold</option>

                                            <option value="font-weight:bolder" <?php selected($result['spm_read_row_font_weight'], 'font-weight:bolder'); ?>>Bolder</option>

                                        </select>

                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">

                                    <label for="spm_read_row_border_sides" class="col-sm-3 control-label">Border Sides</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_read_row_border_sides">

                                            <option value="none">None</option>

                                            <option value="left" <?php (isset($read_sides[1])) ? selected(trim($read_sides[1], ':'), 'left') : '' ?>>Left Border</option>

                                            <option value="right" <?php (isset($read_sides[1])) ? selected(trim($read_sides[1], ':'), 'right') : '' ?>>Right Border</option>

                                            <option value="top" <?php (isset($read_sides[1])) ? selected(trim($read_sides[1], ':'), 'top') : '' ?>>Top Border</option>

                                            <option value="bottom" <?php (isset($read_sides[1])) ? selected(trim($read_sides[1], ':'), 'bottom') : '' ?>>Bottom Border</option>

                                            <option value="all" <?php (isset($read_sides[1])) ? selected(trim($read_sides[1], ':'), 'all') : '' ?>>All Border</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="spm_read_row_border_width" class="col-sm-3 control-label">Border Width</label>

                                    <div class="col-sm-2">

                                        <input type="number" class="form-control" id="spm_read_row_border_width" value="<?= (isset($read_border[1])) ? (int)$read_border[1] : '' ?>" placeholder="1px">

                                    </div>

                                    <div class="col-sm-2">

                                        <select class="form-control" id="spm_read_row_border_style">

                                            <option value="inline" <?php (isset($read_border[2])) ? selected($read_border[2], 'inline') : '' ?>>Inline</option>

                                            <option value="solid" <?php (isset($read_border[2])) ? selected($read_border[2], 'solid') : '' ?>>Solid</option>

                                            <option value="dotted" <?php (isset($read_border[2])) ? selected($read_border[2], 'dotted') : '' ?>>Dotted</option>

                                            <option value="dashed" <?php (isset($read_border[2])) ? selected($read_border[2], 'dashed') : '' ?>>Dashed</option>

                                            <option value="double" <?php (isset($read_border[2])) ? selected($read_border[2], 'double') : '' ?>>Double</option>

                                            <option value="groove" <?php (isset($read_border[2])) ? selected($read_border[2], 'groove') : '' ?>>Groove</option>

                                            <option value="ridge" <?php (isset($read_border[2])) ? selected($read_border[2], 'ridge') : '' ?>>Ridge</option>

                                            <option value="inset" <?php (isset($read_border[2])) ? selected($read_border[2], 'inset') : '' ?>>Inset</option>

                                            <option value="outset" <?php (isset($read_border[2])) ? selected($read_border[2], 'outset') : '' ?>>Outset</option>

                                        </select>

                                    </div>

                                    <div class="col-sm-4">

                                        <input type="text" class="wp-pick-color" id="spm_read_row_border_color" value="<?= (isset($read_border[3])) ? $read_border[3] : '' ?>" placeholder="Color">

                                    </div>

                                </div>

                                <hr>

                                <div class="form-group">

                                    <label for="spm_read_row_text_decoration" class="col-sm-3 control-label">Text Decoration</label>

                                    <div class="col-sm-8">

                                        <select class="form-control" id="spm_read_row_text_decoration">

                                            <option value="text-decoration:none" <?php selected($result['spm_read_row_text_decoration'], 'text-decoration:none'); ?>>None</option>

                                            <option value="text-decoration:underline" <?php selected($result['spm_read_row_text_decoration'], 'text-decoration:underline'); ?>>Underline</option>

                                            <option value="text-decoration:overline" <?php selected($result['spm_read_row_text_decoration'], 'text-decoration:overline'); ?>>Overline</option>

                                            <option value="text-decoration:line-through" <?php selected($result['spm_read_row_text_decoration'], 'text-decoration:line-through'); ?>>Line Through</option>

                                        </select>

                                    </div>

                                </div>

                                <div class="form-group">

                                    <label for="spm_read_row_background" class="col-sm-3 control-label">Row Background</label>

                                    <div class="col-sm-8">

                                        <input type="text" class="wp-pick-color" id="spm_read_row_background" value="<?= (isset($result['spm_read_row_background']) ? $result['spm_read_row_background'] : '') ?>">

                                    </div>

                                </div>

                            </form>

                        </div>

                    </div>

                </div>

            </div>

            <div class="panel-footer">

                <a href="javascript:void(0)" class="btn btn-primary btn-block" id="btn-save-personalize"><i class="fa fa-save"></i> Save Settings</a>

            </div>

        </div>

    </div>

</div>