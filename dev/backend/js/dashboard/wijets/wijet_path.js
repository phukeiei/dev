/*!
 * wijets_path
 * for specific ip of dashboard system
 *
 Replace Date::  Nov 2016 : 9:19 AM;
 Replacer:: Nattaphol Boonseng;
 Comment:: Update version control.;
 ----
 Author :: Nattaphol Boonseng;
 */
var da_path = window.location.href.split('/');
var the_path = da_path[0]+'//'+da_path[2]+'/'+da_path[3];
var metric_path = the_path+'/index.php/dashboard/Metric/get_metric/';
var curl_path = the_path+'/index.php/dashboard/Data_management/get_data';
var switch_flag = false;