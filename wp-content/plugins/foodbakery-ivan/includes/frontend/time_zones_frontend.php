<?php

// Direct access not allowed.
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Time_Zones_Frontend')) {

    /**
     * Class Time_Zones_Frontend
     */
    class Time_Zones_Frontend {

        var $visitor_timezone = '';

        /**
         * Time_Zones_Frontend constructor.
         */
        public function __construct() {
            $timezone_name = $this->getTimeZoneFromIpAddress();
            $this->visitor_timezone = $timezone_name;
            add_filter('foodbakery_timezone_convert', array($this, 'foodbakery_timezone_convert_callback'), 11, 2);
            add_filter('foodbakery_datetime_field_id', array($this, 'foodbakery_datetime_field_id_callback'), 11);
            add_filter('foodbakery_moh_day_label', array($this, 'foodbakery_moh_day_label_callback'), 11);
        }

        public function foodbakery_moh_day_label_callback($show_label) {
            return false;
        }

        public function foodbakery_datetime_field_id_callback($datetime_field_id) {
            return 'datetimepicker_cust';
        }

        /*
         * Get Current Time of Visiting User
         */

        public function foodbakery_timezone_convert_callback($time_string, $time_format = 'H:i') {
            $timezone_name = $this->visitor_timezone;
            //$timezone_name = timezone_name_from_abbr("", 300 * 60, false);
            $time_string = $this->timeZoneConvert($time_string, $timezone_name, $time_format);
            return $time_string;
        }

        public function timeZoneConvert($fromTime, $toTimezone, $format = 'H:i') {
            $wp_timezone = wp_timezone_string();
            $from = new DateTimeZone($wp_timezone);
            $to = new DateTimeZone($toTimezone);
            date_default_timezone_set($toTimezone);
            $orgTime = new DateTime($fromTime, $from);
            $toTime = new DateTime($orgTime->format("c"));
            $toTime->setTimezone($to);
            $new_datetime = $toTime->format($format);
            new DateTimeZone($wp_timezone);
            date_default_timezone_set($wp_timezone);
            return $new_datetime;
        }

        public function getTimeZoneFromIpAddress() {
            $clientsIpAddress = $this->get_client_ip();
            $clientInformation = unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip=' . $clientsIpAddress));
            $clientsLatitude = $clientInformation['geoplugin_latitude'];
            $clientsLongitude = $clientInformation['geoplugin_longitude'];
            $clientsCountryCode = $clientInformation['geoplugin_countryCode'];
            $timeZone = $this->get_nearest_timezone($clientsLatitude, $clientsLongitude, $clientsCountryCode);

            return $timeZone;
        }

        public function get_client_ip() {
            $ipaddress = '';
            if (getenv('HTTP_CLIENT_IP'))
                $ipaddress = getenv('HTTP_CLIENT_IP');
            else if (getenv('HTTP_X_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
            else if (getenv('HTTP_X_FORWARDED'))
                $ipaddress = getenv('HTTP_X_FORWARDED');
            else if (getenv('HTTP_FORWARDED_FOR'))
                $ipaddress = getenv('HTTP_FORWARDED_FOR');
            else if (getenv('HTTP_FORWARDED'))
                $ipaddress = getenv('HTTP_FORWARDED');
            else if (getenv('REMOTE_ADDR'))
                $ipaddress = getenv('REMOTE_ADDR');
            else
                $ipaddress = 'UNKNOWN';
            return $ipaddress;
        }

        public function get_nearest_timezone($cur_lat, $cur_long, $country_code = '') {
            $timezone_ids = ($country_code) ? DateTimeZone::listIdentifiers(DateTimeZone::PER_COUNTRY, $country_code) : DateTimeZone::listIdentifiers();

            if ($timezone_ids && is_array($timezone_ids) && isset($timezone_ids[0])) {
                $time_zone = '';
                $tz_distance = 0;
                //only one identifier?
                if (count($timezone_ids) == 1) {
                    $time_zone = isset($timezone_ids[0]) ? $timezone_ids[0] : '';
                } else {
                    foreach ($timezone_ids as $timezone_id) {
                        $timezone = new DateTimeZone($timezone_id);
                        $location = $timezone->getLocation();
                        $tz_lat = isset($location['latitude']) ? $location['latitude'] : '';
                        $tz_long = isset($location['longitude']) ? $location['longitude'] : '';

                        $theta = $cur_long - $tz_long;
                        $cur_lat = isset($cur_lat) && $cur_lat !== null ? $cur_lat : 0.0;
                        $tz_lat = isset($tz_lat) && $tz_lat !== null ? $tz_lat : 0.0;
                        $theta = isset($theta) && $theta !== null ? $theta : 0.0;

                        $distance = (sin(deg2rad($cur_lat)) * sin(deg2rad($tz_lat))) + (cos(deg2rad($cur_lat)) * cos(deg2rad($tz_lat)) * cos(deg2rad($theta)));
                        $distance = acos($distance);
                        $distance = abs(rad2deg($distance));
                        if (!$time_zone || $tz_distance > $distance) {
                            $time_zone = $timezone_id;
                            $tz_distance = $distance;
                        }
                    }
                }
                return $time_zone;
            }
            return 'unknown';
        }

    }

    new Time_Zones_Frontend();
}
?>