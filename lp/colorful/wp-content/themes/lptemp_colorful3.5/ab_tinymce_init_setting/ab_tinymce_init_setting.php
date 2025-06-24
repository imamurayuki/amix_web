<?php
/*******************************************************************************
Plugin Name: TinyMCE Init Setting
Plugin URI: http://wpmu.litchee.com/
Description: 
Version: 1.0
Author: mineko@litchee.com
Author URI: http://wpmu.litchee.com/about/
*/
/*
    Copyright 2009 Mineko (email : mineko@litchee.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*******************************************************************************/

///////////////////////////////////////////////////////////////////////////////
// 
add_filter('tiny_mce_before_init', 'mce_init_filter_function');
function mce_init_filter_function($args){


    // tinyMCEを拡張していない場合、フォントのツールバーを追加します。
    $toolbarstr = ','. $args['theme_advanced_buttons1'] .','. $args['theme_advanced_buttons2'] .','. $args['theme_advanced_buttons3'] .','. $args['theme_advanced_buttons4'] .',';
    if( ! preg_match('/,fontsizeselect,/', $toolbarstr)
     && ! preg_match('/,fontselect,/', $toolbarstr) ){
        $args['theme_advanced_buttons3'] = (($args['theme_advanced_buttons3'] == "" )? "" : ",") . 'fontselect,fontsizeselect';
    }
    
    // フォントのセット
    $usefonts = array(
        'ゴシック体'    => 'ヒラギノ角ゴ Pro W3,ＭＳ Ｐゴシック,Sans-Serif',
        '明朝体'      => 'ヒラギノ明朝 Pro W3,ＭＳ Ｐ明朝,Serif',
        'Andale Mono'      => 'andale mono,times',
        'Arial'            => 'arial,helvetica,sans-serif',
        'Arial Black'      => 'arial black,avant garde',
        'Book Antiqua'     => 'book antiqua,palatino',
        'Comic Sans MS'    => 'comic sans ms,sans-serif',
        'Courier New'      => 'courier new,courier',
        'Georgia'          => 'georgia,palatino',
        'Helvetica'        => 'helvetica',
        'Impact'           => 'impact,chicago',
        'Symbol'           => 'symbol',
        'Tahoma'           => 'tahoma,arial,helvetica,sans-serif',
        'Terminal'         => 'terminal,monaco',
        'Times New Roman'  => 'times new roman,times',
        'Trebuchet MS'     => 'trebuchet ms,geneva',
        'Verdana'          => 'verdana,geneva',
        'Webdings'         => 'webdings',
        'Wingdings'        => 'wingdings,zapf dingbats'
    );
    $fontstr = "";
    foreach( $usefonts as $k => $v ){
        $fontstr .= $k."=".$v.";";
    }
    $args['theme_advanced_fonts'] = $fontstr;
    return $args;
}
