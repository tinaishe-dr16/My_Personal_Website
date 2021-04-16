<?php

class wpda_gall_post_page_popup{
	private $gallery_tree;
	private $popup_themes;
	function __construct(){
		global $wpdb;
		$this->popup_themes=$wpdb->get_results('SELECT `id`,`name` FROM ' . wpdevart_gallery_databese::$table_names['popup_theme'],ARRAY_A);
		$all['id']=9999;//07-11-2017
		$all['name']='All themes';//07-11-2017
		array_push($this->popup_themes,$all);//07-11-2017
		$this->gallery_tree=$this->get_tree();
		$this->generete_html();
	}
	private function required_js_and_style(){
		wp_print_scripts("jquery");
		wp_print_styles('dashicons');
		?>
		<script type="text/javascript" src="<?php echo wpdevart_gallery_plugin_url ?>includes/admin/js/post_page_popup.js"></script>
		<link rel='stylesheet' href='<?php echo wpdevart_gallery_plugin_url ?>includes/admin/css/post_page_popup.css' type='text/css' media='all' />
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/tiny_mce_popup.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/mctabs.js"></script>
		<script language="javascript" type="text/javascript" src="<?php echo site_url(); ?>/wp-includes/js/tinymce/utils/form_utils.js"></script>
		<?php
	}
	private function generete_html(){
		?>
		<!DOCTYPE html>
		<!--[if IE 8]>
		<html xmlns="http://www.w3.org/1999/xhtml" class="ie8 wp-toolbar"  >
		<![endif]-->
		<!--[if !(IE 8) ]><!-->
		<html xmlns="http://www.w3.org/1999/xhtml">
		<!--<![endif]-->
		<head>
			<?php
			$this->required_js_and_style();
			$this->generete_gallery_and_album_js();
			?>
			<title>WpDevArt Gallery</title>
			<style>
				table tr{
					height: 40px;
				}
				table select{
					width: 240px;
				}
			</style>
           </head><body>
            <table width="100%" class="paramlist admintable" cellspacing="1">
                <tbody>
                    <tr>
						<td colspan="2"><?php 	echo $this->create_all_sections();	?></td>
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="paramlist_key">
                            <span class="editlinktip">
                                <label style="font-size:12px" class="hasTip">Select Gallery: </label>
                            </span>
                        </td>
                        <td class="paramlist_value" >                        
							<select style="font-size:12px" id="select_gallery">
								
							</select>        
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="paramlist_key">
                            <span class="editlinktip">
                                <label style="font-size:12px" class="hasTip">Select Album: </label>
                            </span>
                        </td>
                        <td class="paramlist_value" >                        
					       	<select style="font-size:12px" id="select_album">
								
							</select>          
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="paramlist_key">
                            <span class="editlinktip">
                                <label style="font-size:12px" class="hasTip">Select Theme: </label>
                            </span>
                        </td>
                        <td class="paramlist_value" >                        
					        <?php $this->generete_thmes(); ?>   
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="paramlist_key">
                            <span class="editlinktip">
                                <label style="font-size:12px" class="hasTip">Select Popup Theme: </label>
                            </span>
                        </td>
                        <td class="paramlist_value" >                        
					        <?php $this->create_popup_themes(); ?>
                        </td>
                    </tr>
                    <tr>
                        <td style="width: 150px;" class="paramlist_key">
                            <span class="editlinktip">
                                <label style="font-size:12px" class="hasTip">Select Ordering mode: </label>
                            </span>
                        </td>
                        <td class="paramlist_value" >                        
					              <select style="font-size:12px" id="wpda_gall_oreder_type" name="rgn_shortcode_order">
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'kirpich'):''; ?> value="kirpich"> Square view </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'masony'):'';  ?> value="masony"> Masonry view </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'mosaik'):'';  ?> value="mosaik"> Mosaic view </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'tumbnails'):'';  ?> value="tumbnails"> Thumbnail view  </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'kirpich_'):'';  ?> value="kirpich_"> Square alternative view </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'masony_'):'';  ?> value="masony_"> Masonry alternative view </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'mosaik_'):'';  ?> value="mosaik_"> Mosaic alternative view </option>
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'tumbnails_'):'';  ?> value="tumbnails_"> Thumbnail alternative view  </option>                         
									<option <?php isset($_GET['order_type'])?selected($_GET['order_type'],'column'):'';  ?> value="column"> Column view </option>
								</select>       
                        </td>
                    </tr>
                </tbody>
            </table>
       		<div class="mceActionPanel">
                <div style="float: left">
                    <input type="button" id="cancel" name="cancel" value="Cancel" onClick="tinyMCEPopup.close();"/>
                </div>
    
                <div style="float: right">
                    <input type="submit" id="insert" name="insert" value="Insert" onClick="insert_gallery();"/>
                    <input type="hidden" name="iden" value="1"/>
                </div>
            </div>
        
    
        	<script type="text/javascript">
				function insert_gallery() {					  
					if(jQuery('#wpdevart_forms_id').val()!='0'){
						var tagtext;
						tagtext = '<p>[wpdevart_gallery lost_ids="'+wpda_gall_post_page_popup.lost_elements.join(",")+'" gallery_id="' + jQuery('#select_gallery').val()+'"  album_id="' + jQuery('#select_album').val()+'"  popup_albums_themes="' + wpda_gall_post_page_popup.popup_albums_themes+'" popup_themeid="' + jQuery('#wpda_gall_popup_theme').val()+'"  theme_id="' + jQuery('#wpda_gall_theme').val()+'" order_type="' + jQuery('#wpda_gall_oreder_type').val()+'"]</p>';
						window.parent.tinyMCE.execCommand('mceInsertContent', false, tagtext);
						tinyMCEPopup.close();
					}
					else{
						tinyMCEPopup.close();
					}
				}  
			</script>
        	</body></html>
				<?php
		die();
	}
	private function get_tree(){
		global $wpdb;
		$gallerys = $wpdb->get_results( "SELECT `id`,`gallery` FROM ".wpdevart_gallery_databese::$table_names['gallery']." WHERE `album` IS NULL ORDER BY `id` ASC ;",ARRAY_A);
		foreach($gallerys as $key=>$value){
			$curent_gallery_albums=$wpdb->get_results( "SELECT `id`,`album` FROM ".wpdevart_gallery_databese::$table_names['gallery']." WHERE `gallery` = '".$value['gallery']."' AND album IS NOT NULL AND `image_name` IS NULL  ORDER BY `id` ASC ;",ARRAY_A );
			$curent_albums_array=array();
			foreach($curent_gallery_albums as $alb_key => $alb_value){
				$curent_albums_array[$alb_value['id']]=$alb_value['album'];
			}
			$galleryes_array[$value['id']]['albums']=$curent_albums_array;
			$galleryes_array[$value['id']]['name']=$value['gallery'];
		}           	
		return $galleryes_array;
	}
	private function generete_gallery_and_album_js(){
	
			$current_gallery='all';
			if(isset($_GET['gallery_id']) && $_GET['gallery_id']!='')
				$current_gallery= $_GET['gallery_id'];
		
			$current_album='all';
			if(isset($_GET['album_id']) && $_GET['album_id']!='')
				$current_album= $_GET['album_id'];
			if(isset($_GET['lost_ids']) && $_GET['lost_ids']!='')
				$lost_elements= $_GET['lost_ids'];
			if(isset($_GET['popup_albums_themes']) && $_GET['popup_albums_themes']!='')
				$popup_album_themes= $_GET['popup_albums_themes'];
			?>
         	<script>
				wpda_gall_post_page_popup['tree_info']=<?php echo json_encode($this->gallery_tree ,JSON_FORCE_OBJECT); ?>;
				wpda_gall_post_page_popup['default_gallery_id']='<?php echo $current_gallery; ?>';
				wpda_gall_post_page_popup['default_album_id']='<?php echo $current_album; ?>';
				wpda_gall_post_page_popup['lost_elements']=<?php echo '['.str_replace("%",",",$lost_elements).']'; ?>;
				wpda_gall_post_page_popup['popup_albums_themes']='<?php echo $popup_album_themes; ?>';
			</script>          	
		<?php		
	}
	private function generete_thmes(){
		global $wpdb;
		$themes=$wpdb->get_results('SELECT `id`,`name` FROM ' . wpdevart_gallery_databese::$table_names['theme'],ARRAY_A);
		echo "<select style='font-size:12px' id='wpda_gall_theme'>";
		foreach($themes as $key=>$value){
			$selected='';
			if(isset($_GET['theme_id']) && $_GET['theme_id']==$value['id']){
				$selected='selected="selected"';
			}
			echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
		}
		echo "</select>";
	}
	private function create_section($name_of_section="",$inside_content="",$section_params=array()){
		$output='';
		$output.='<div id='.$section_params["id"].' class="main_parametrs_group_div closed_params">';
		$output.='<div class="head_panel_div" title="Click to toggle">';
		if($section_params["extend_checkboxes"]){
			foreach($section_params["extend_checkboxes"] as $key => $value){
				$output.='<div class="ch_button"><label><input type="checkbox" checked data-name="'.$value.'" class="gallery_checkbox" value="'.$key.'"><span>'.$value.'</span></label></div>';
			}
		}else{
			$output.='<span class="title_parametrs_group">'.$name_of_section.'</span>';
		}
		//$output.='<span class="checkbox_params">'.$name_of_section.'</span>';
		$output.='<span class="enabled_or_disabled_parametr"></span>';
		$output.='<span class="open_or_closed"></span>';	
		$output.='</div>';	         
		$output.='<div class="inside_information_div">'.$inside_content.'</div></div>';		
		return $output;
	}
	private function create_albom_checkboxes($checkboxs){
		$checkboxes="";
		foreach($checkboxs as $id => $name){			
			$checkboxes.='<div class="ch_button album_selecte_button"><label><input type="checkbox" checked data-name="'.$name.'" class="alboms_checkbox" value="'.$id.'"><span>'.$name.'</span></label>'.$this->create_popup_album_themes().'</div>';
		}
		return $checkboxes;
	}
	private function create_all_sections(){
		$sections='';
		foreach($this->gallery_tree as $gallery_index => $gallery_value){
			$inside_gallery_section_content='';			
			$albom_checkboxes=$this->create_albom_checkboxes($gallery_value["albums"]);	
			$sections.=$this->create_section($gallery_value["name"],$albom_checkboxes,array("id"=>$gallery_index,"extend_checkboxes"=>array($gallery_index=>$gallery_value["name"])));
		}
		$main_section_params=array(
			"id"=>"mian_section",
		);
		$sections=$this->create_section("Galleries",$sections,$main_section_params);
		return $sections;
	}
	private function create_popup_themes(){
		echo "<select id='wpda_gall_popup_theme'>";
		foreach($this->popup_themes as $key=>$value){
			$selected='';
			if(isset($_GET['popup_themeid']) && $_GET['popup_themeid']==$value['id']){
				$selected='selected="selected"';
			}
			echo "<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
		}
		echo "</select>";
	}
	private function create_popup_album_themes(){
		$select='';
		$select.="<select class='album_popup_select'>";
			$select.="<option  value='0'>Popup theme</option>";
		foreach($this->popup_themes as $key=>$value){
			$select.="<option ".$selected." value='".$value['id']."'>".$value['name']."</option>";
		}
		$select.="</select>";
		return $select;
	}
}
?>
