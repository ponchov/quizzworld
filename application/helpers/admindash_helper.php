<?php  if ( ! defined( 'BASEPATH' ) ) exit( 'No direct script access allowed' );

if ( ! function_exists('get_user_name'))
{
    function get_user_name()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id   =   $_COOKIE["search_user_id"];
            $user      =   $ci->admindash_model->get_user($user_id);
            $user_name =   $user->first_name ." ". $user->last_name;
            return $user_name;
        }
        else{
            return "";
        }
    }

}

if ( ! function_exists('get_user_id'))
{
    function get_user_id()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){            
            return $_COOKIE["search_user_id"];
        }
        else{
            return "";
        }
    }
}

if ( ! function_exists('get_approve_user'))
{
    function get_approve_user()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id      =   $_COOKIE["search_user_id"];
            $user         =   $ci->admindash_model->get_user($user_id);
            if($user->is_approved==0)
            return "Not Approved";
            else
                return "Approved";
        }
        else{
            return "";
        }
    }
}

if ( ! function_exists('get_user_info'))
{
    function get_user_info()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id      =   $_COOKIE["search_user_id"];
            $user_type    =   get_user_type();
            
            if($user_type==2){
                $user         =   $ci->student_model->get_student_info($user_id);
                return $user;
            }
            elseif($user_type==1){
                $user         =   $ci->tutor_model->get_tutorinfo($user_id);
                return $user;
            }
            else{
                return "";
            }
            
        }
        else{
            return "";
        }
        
    }
}

if ( ! function_exists('get_user_type'))
{
    function get_user_type()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id      =   $_COOKIE["search_user_id"];
            $user         =   $ci->admindash_model->get_user($user_id);
            
            return $user->user_type;
        }
        else{
            return "";
        }
        
    }
}

if ( ! function_exists('get_countries'))
{
    function get_countries()
    {
        $ci =& get_instance();
        $countries  =   $ci->student_model->get_countries();
        return $countries;
    }
}

if ( ! function_exists('get_cities'))
{
    function get_cities()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id        =   $_COOKIE["search_user_id"];
            $user_info      =   get_user_info();
            if($user_info->user_type==2){
                $cities         =   $ci->tutor_model->get_city_by_country_id($user_info->country_id);
            }
            else{
                $cities         =   $ci->tutor_model->get_city_by_country_id($user_info->countryid);
            }
            return $cities;
        }
        else{
            return "";
        }
        
    }
}

if ( ! function_exists('get_tutor_qualification'))
{
    function get_tutor_qualification()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id        =   $_COOKIE["search_user_id"];
            $user_type      =   get_user_type();
            if($user_type==1){
                $tutor_qualification_list       =   $ci->tutor_model->get_tutor_qualifications($user_id);
                return $tutor_qualification_list;
            }
            else{
                return "";
            }
        }
        else{
            return "";
        }
        
    }
}


if ( ! function_exists('get_tutor_subject'))
{
    function get_tutor_subject()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id        =   $_COOKIE["search_user_id"];
            $user_type      =   get_user_type();
            if($user_type==1){
                $tutor_subject_list       =   $ci->tutor_model->get_tutor_subjects($user_id);
                return $tutor_subject_list;
            }
            else{
                return "";
            }
        }
        else{
            return "";
        }
        
    }
}


if ( ! function_exists('get_tutor_language'))
{
    function get_tutor_language()
    {
        $ci =& get_instance();
        if(isset( $_COOKIE["search_user_id"] )){
            $user_id        =   $_COOKIE["search_user_id"];
            $user_type      =   get_user_type();
            if($user_type==1){
                $tutor_language_list       =   $ci->tutor_model->get_tutor_languages($user_id);
                return $tutor_language_list;
            }
            else{
                return "";
            }
        }
        else{
            return "";
        }
        
    }
}