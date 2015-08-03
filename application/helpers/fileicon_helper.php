<?php  if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package  CodeIgniter
 * @author  ExpressionEngine Dev Team
 * @copyright Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license  http://codeigniter.com/user_guide/license.html
 * @link  http://codeigniter.com
 * @since  Version 1.0
 * @filesource
 */

function get_icon( $original_name ) {

	$ext = explode( '.', $original_name );

	switch ( $ext[1] ) {
	case 'jpg':
		$icon = "jpeg.png";
		break;
	case 'txt':
		$icon = "text.png";
		break;
	case 'text':
		$icon = "text.png";
		break;
	case 'zip':
		$icon = "zip.png";
		break;
	case 'rar':
		$icon = "zip.png";
		break;
	case 'html':
		$icon = "html.png";
		break;
	case 'htm':
		$icon = "html.png";
		break;
	case 'pdf':
		$icon = "pdf.png";
		break;
	case 'docx':
		$icon = "doc.png";
		break;
	case 'doc':
		$icon = "doc.png";
		break;
	default:
		$icon = "unknown.png";
	}

	return $icon;

}

function getIcon( $original_name ) {

	$ext = explode( '.', $original_name );

	switch ( $ext[1] ) {
	case 'jpg':
		$icon = "icon-camera";
		break;
	case 'txt':
		$icon = "icon-file";
		break;
	case 'text':
		$icon = "icon-file";
		break;
	case 'zip':
		$icon = "icon-archive";
		break;
	case 'rar':
		$icon = "icon-archive";
		break;
	case 'html':
		$icon = "icon-file";
		break;
	case 'htm':
		$icon = "icon-file";
		break;
	case 'pdf':
		$icon = "icon-file";
		break;
	case 'docx':
		$icon = "icon-file";
		break;
	case 'doc':
		$icon = "icon-file";
		break;
	default:
		$icon = "icon-file";
	}

	return $icon;

}

/* End of file fileicon.php */
