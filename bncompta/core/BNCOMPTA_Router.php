<?php

(defined('BASEPATH')) OR exit('No direct script access allowed');

/* load the MX_Router class */
require APPPATH . "third_party/MX/Router.php";

class BNCOMPTA_Router extends MX_Router {

    /**
     *
     * @author Karim BESBES
     * @param type $route
     * @return type 
     */
    public function item($route) {

        return $this->routes[$route];
    }

    /**
     *  Parse Routes
     *
     * This function matches any routes that may exist in
     * the config/routes.php file against the URI to
     * determine if the class/method need to be remapped.
     *
     * @access	private
     * @return	void
     */
    function _parse_routes() {

        foreach (Modules::$locations as $key) {
            $dir = './' . $key;
        }

        // Turn the segment array into a URI string
        $uri = implode('/', $this->uri->segments);

        // Is there a literal match?  If so we're done
        if (isset($this->routes[$uri])) {

            return $this->_set_request(explode('/', $this->routes[$uri]));
        }

        // Loop through the route array looking for wild-cards
        foreach ($this->routes as $key => $val) {
            // Convert wild-cards to RegEx
            $key = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $key));

            // Does the RegEx match?
            if (preg_match('#^' . $key . '$#', $uri)) {
                // Do we have a back-reference?
                if (strpos($val, '$') !== FALSE AND strpos($key, '(') !== FALSE) {
                    $val = preg_replace('#^' . $key . '$#', $val, $uri);
                }

                return $this->_set_request(explode('/', $val));
            }
        }

        // If we got this far it means we didn't encounter a
        // matching route so we'll set the site default route

        if (ENVIRONMENT === "production") {
            if ($this->locate($this->uri->segments)) {

                show_404();
            }
        } else {
            $this->_set_request($this->uri->segments);
        }
    }

    /**
     * Get module  routed routes
     * @author Karim BESBES 
     * @param type $route 
     */
    public function get_route($route) {

        foreach ($this->routes as $k => $v) {

            if ($k == 'default_controller')
                continue;
            if ($v === $route) {
                return $k;
            }
        }
    }

    // --------------------------------------------------------------------

    /**
     * Set the route mapping
     *
     * This function determines what should be served based on the URI request,
     * as well as any "routes" that have been set in the routing config file.
     *
     * @access	private
     * @return	void
     */
    function _set_routing() {

        // Are query strings enabled in the config file?  Normally CI doesn't utilize query strings
        // since URI segments are more search-engine friendly, but they can optionally be used.
        // If this feature is enabled, we will gather the directory/class/method a little differently
        $segments = array();
        if ($this->config->item('enable_query_strings') === TRUE AND isset($_GET[$this->config->item('controller_trigger')])) {
            if (isset($_GET[$this->config->item('directory_trigger')])) {
                $this->set_directory(trim($this->uri->_filter_uri($_GET[$this->config->item('directory_trigger')])));
                $segments[] = $this->fetch_directory();
            }

            if (isset($_GET[$this->config->item('controller_trigger')])) {
                $this->set_class(trim($this->uri->_filter_uri($_GET[$this->config->item('controller_trigger')])));
                $segments[] = $this->fetch_class();
            }

            if (isset($_GET[$this->config->item('function_trigger')])) {
                $this->set_method(trim($this->uri->_filter_uri($_GET[$this->config->item('function_trigger')])));
                $segments[] = $this->fetch_method();
            }
        }

        // Load the routes.php file.
        if (defined('ENVIRONMENT') AND is_file(APPPATH . 'config/' . ENVIRONMENT . '/routes.php')) {
            include(APPPATH . 'config/' . ENVIRONMENT . '/routes.php');
        } elseif (is_file(APPPATH . 'config/routes.php')) {
            include(APPPATH . 'config/routes.php');
        }



        // Hack to include the routes.php in each modules
        foreach (Modules::$locations as $k => $v) {
            $dir_content = opendir($k);
            while (($current_dir = readdir($dir_content)) !== false) {
                $dir = $k . $current_dir . '/config/routes' . EXT;
                if (is_file($dir) && $current_dir !== '.' && $current_dir !== '..') {
                    include_once $dir;
                }
            }
            closedir($dir_content);
        }

        $this->routes = array_merge($route, $this->routes);
        $this->routes = (!isset($route) OR !is_array($route)) ? array() : $route;
        unset($route);

        // Set the default controller so we can display it in the event
        // the URI doesn't correlated to a valid controller.
        $this->default_controller = (!isset($this->routes['default_controller']) OR $this->routes['default_controller'] == '') ? FALSE : strtolower($this->routes['default_controller']);

        // Were there any query string segments?  If so, we'll validate them and bail out since we're done.
        if (count($segments) > 0) {
            return $this->_validate_request($segments);
        }

        // Fetch the complete URI string
        $this->uri->_fetch_uri_string();

        // Is there a URI string? If not, the default controller specified in the "routes" file will be shown.
        if ($this->uri->uri_string == '') {
            return $this->_set_default_controller();
        }

        // Do we need to remove the URL suffix?
        $this->uri->_remove_url_suffix();

        // Compile the segments into an array
        $this->uri->_explode_segments();

        // Parse any custom routing that may exist
        $this->_parse_routes();

        // Re-index the segment array so that it starts with 1 rather than 0
        $this->uri->_reindex_segments();
    }

}