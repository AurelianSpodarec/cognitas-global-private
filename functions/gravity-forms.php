<?php
/**
 * Group Fields for Gravity Form
 */
add_filter("gform_add_field_buttons", "add_fieldgroup_fields");
function add_fieldgroup_fields($field_groups){

  foreach($field_groups as &$group){
    if($group["name"] == "standard_fields"){
      $group["fields"][] = array("class"=>"button", "value" => __("Open Group", "gravityforms"), "onclick" => "StartAddField('fieldgroupopen');");
      $group["fields"][] = array("class"=>"button", "value" => __("Close Group", "gravityforms"), "onclick" => "StartAddField('fieldgroupclose');");
      break;
    }
  }
  return $field_groups;
}

// Add title to the Field Group fields
add_filter( 'gform_field_type_title' , 'field_group_titles' );
function field_group_titles( $type ) {
  if ( $type == 'fieldgroupopen' ) {
    return __( 'Open Field Group' , 'gravityforms' );
  } else if ( $type == 'fieldgroupclose' ) {
    return __( 'Close Field Group' , 'gravityforms' );
  }
}

add_filter("gform_field_content", "create_gf_field_group", 10, 5);
function create_gf_field_group($content, $field, $value, $lead_id, $form_id){
  if ( ! is_admin() ) {
    if(rgar($field,"type") == "fieldgroupopen"){
      $content = "<ul><li style='display: none;'>";
    }
    else if(rgar($field,"type") == "fieldgroupclose"){
      $content = "</li></ul><!-- close field group --><li style='display: none;'>";
    }
  }
  return $content;
}

// Add a CSS class to the Field Group Close field so we can hide the extra <li> that is created.
add_action("gform_field_css_class", "close_field_group_class", 10, 3);
function close_field_group_class($classes, $field, $form){
  if($field["type"] == "fieldgroupclose"){
    $classes .= " fieldgroup_extra_li";
  }
  return $classes;
}

add_action("gform_editor_js_set_default_values", "field_group_default_labels");
function field_group_default_labels(){
  ?>
  case "fieldgroupopen" :
  field.label = "Field Group Open";
  break;
  case "fieldgroupclose" :
  field.label = "Field Group Close";
  break;
  <?php
}

add_action("gform_editor_js", "allow_fieldgroup_settings");
function allow_fieldgroup_settings(){
  ?>
  <script type='text/javascript'>
    fieldSettings["fieldgroupopen"] = fieldSettings["text"] + ", .cssClass";
    fieldSettings["fieldgroupclose"] = fieldSettings["text"] + ", .cssClass";
  </script>
  <?php
}
