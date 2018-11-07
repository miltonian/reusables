<?php

namespace Reusables;

class View
{
    // Array of global variables
    protected static $_global_data = array();
    // View filename
    protected $_file;
    // Array of local variables
    protected $_data = array();
    /**
     * Returns a new View object. If you do not define the "file" parameter,
     * you must call [View::set_filename].
     *
     *     $view = View::factory($file);
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @return  View
     */
    public static function factory( $file=NULL, array $data=NULL )
    {
        return new View( $file, $data );
    }
    /**
     * Captures the output that is generated when a view is included.
     * The view data will be extracted to make local variables. This method
     * is static to prevent object scope resolution.
     *
     *     $output = View::capture($file, $data);
     *
     * @param   string  $view_filename   filename
     * @param   array   $view_data       variables
     * @return  string
     * @throws  Exception
     */
    protected static function capture( $view_filename, array $view_data )
    {
        // Import the view variables to local namespace
        extract( $view_data, EXTR_SKIP );
        if( self::$_global_data)
        {
            // Import the global view variables to local namespace
            extract( self::$_global_data, EXTR_SKIP | EXTR_REFS );
        }
        // Capture the view output
        ob_start();
        try
        {
            // Load the view within the current scope
            // include $view_filename;
            if( substr($view_filename, 0, strlen("/")) === "/" ) {
                $f = BASE_DIR . "/" . $view_filename;
                $f = str_replace("//", "/", $f);
                include $f;
            } else {
                include realpath(__DIR__ . '/../..') . "/" . $view_filename;
            }
        }
        catch( \Exception $e )
        {
            // Delete the output buffer
            ob_end_clean();
            // Re-throw the exception
            throw $e;
        }
        // Get the captured output and close the buffer
        return ob_get_clean();
    }
    /**
     * Sets a global variable, similar to [View::set], except that the
     * variable will be accessible to all views.
     *
     *     View::set_global($name, $value);
     *
     * You can also use an array or Traversable object to set several values at once:
     *
     *     // Create the values $food and $beverage in the view
     *     View::set_global(array('food' => 'bread', 'beverage' => 'water'));
     *
     * [!!] Note: When setting with using Traversable object we're not attaching the whole object to the view,
     * i.e. the object's standard properties will not be available in the view context.
     *
     * @param   string|array|Traversable  $key    variable name or an array of variables
     * @param   mixed                     $value  value
     * @return  void
     */
    public static function set_global( $key, $value=NULL )
    {
        if( is_array( $key ) || $key instanceof \Traversable )
        {
            foreach( $key as $name => $value )
            {
                self::$_global_data[$name] = $value;
            }
        }
        else
        {
            self::$_global_data[$key] = $value;
        }
    }
    /**
     * Assigns a global variable by reference, similar to [View::bind], except
     * that the variable will be accessible to all views.
     *
     *     View::bind_global($key, $value);
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  referenced variable
     * @return  void
     */
    public static function bind_global( $key, &$value )
    {
        self::$_global_data[$key] = &$value;
    }
    /**
     * Sets the initial view filename and local data. Views should almost
     * always only be created using [View::factory].
     *
     *     $view = new View($file);
     *
     * @param   string  $file   view filename
     * @param   array   $data   array of values
     * @uses    View::set_filename
     */
    public function __construct( $file=NULL, array $data=NULL )
    {
        //asdf
        if( $file !== NULL )
        {
            $this->set_filename( $file );
        }

        if( $data !== NULL )
        {
            // Add the values to the current data
            $this->_data = $data + $this->_data;
        }
    }
    /**
     * Magic method, searches for the given variable and returns its value.
     * Local variables will be returned before global variables.
     *
     *     $value = $view->foo;
     *
     * [!!] If the variable has not yet been set, an exception will be thrown.
     *
     * @param   string  $key    variable name
     * @return  mixed
     * @throws  View_Exception
     */
    public function & __get( $key )
    {
        if( array_key_exists( $key, $this->_data ) )
        {
            return $this->_data[$key];
        }
        else if( array_key_exists( $key, self::$_global_data ) )
        {
            return self::$_global_data[$key];
        }
        else
        {
            throw new View_Exception( 'View variable is not set: :var', array( ':var' => $key ) );
        }
    }
    /**
     * Magic method, calls [View::set] with the same parameters.
     *
     *     $view->foo = 'something';
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  value
     * @return  void
     */
    public function __set( $key, $value )
    {
        $this->set( $key, $value );
    }
    /**
     * Magic method, determines if a variable is set.
     *
     *     isset($view->foo);
     *
     * [!!] `NULL` variables are not considered to be set by [isset](http://php.net/isset).
     *
     * @param   string  $key    variable name
     * @return  boolean
     */
    public function __isset( $key )
    {
        return ( isset( $this->_data[$key] ) || isset( self::$_global_data[$key] ) );
    }
    /**
     * Magic method, unsets a given variable.
     *
     *     unset($view->foo);
     *
     * @param   string  $key    variable name
     * @return  void
     */
    public function __unset( $key )
    {
        unset( $this->_data[$key], self::$_global_data[$key] );
    }
    /**
     * Magic method, returns the output of [View::render].
     *
     * @return  string
     * @uses    View::render
     */
    public function __toString()
    {
        try
        {
            return $this->render();
        }
        catch( \Exception $e )
        {
            /**
             * Display the exception message.
             *
             * We use this method here because it's impossible to throw an
             * exception from __toString().
             */
            $error_response = View_Exception::_handler( $e );
            return $error_response
                ->body()
            ;
        }
    }
    /**
     * Sets the view filename.
     *
     *     $view->set_filename($file);
     *
     * @param   string  $file   view filename
     * @return  View
     * @throws  View_Exception
     */
    public function set_filename( $file )
    {
        // if( ( $path = Foundation::find_file( 'views', $file ) ) === FALSE )
        // {
        //     throw new View_Exception('The requested view :file could not be found', array(
        //         ':file' => $file,
        //     ));
        // }
        // // Store the file path locally
        // $this->_file = $path;
        $this->_file = $file . '.php';
        return $this;
    }
    /**
     * Assigns a variable by name. Assigned values will be available as a
     * variable within the view file:
     *
     *     // This value can be accessed as $foo within the view
     *     $view->set('foo', 'my value');
     *
     * You can also use an array or Traversable object to set several values at once:
     *
     *     // Create the values $food and $beverage in the view
     *     $view->set(array('food' => 'bread', 'beverage' => 'water'));
     *
     * [!!] Note: When setting with using Traversable object we're not attaching the whole object to the view,
     * i.e. the object's standard properties will not be available in the view context.
     *
     * @param   string|array|Traversable  $key    variable name or an array of variables
     * @param   mixed                     $value  value
     * @return  $this
     */
    public function set( $key, $value=NULL )
    {
        if( is_array( $key ) || $key instanceof \Traversable )
        {
            foreach( $key as $name => $value )
            {
                $this->_data[$name] = $value;
            }
        }
        else
        {
            $this->_data[$key] = $value;
        }
        return $this;
    }
    /**
     * Assigns a value by reference. The benefit of binding is that values can
     * be altered without re-setting them. It is also possible to bind variables
     * before they have values. Assigned values will be available as a
     * variable within the view file:
     *
     *     // This reference can be accessed as $ref within the view
     *     $view->bind('ref', $bar);
     *
     * @param   string  $key    variable name
     * @param   mixed   $value  referenced variable
     * @return  $this
     */
    public function bind( $key, &$value )
    {
        $this->_data[$key] = &$value;
        return $this;
    }
    /**
     * Renders the view object to a string. Global and local data are merged
     * and extracted to create local variables within the view file.
     *
     *     $output = $view->render();
     *
     * [!!] Global variables with the same key name as local variables will be
     * overwritten by the local variable.
     *
     * @param   string  $file   view filename
     * @return  string
     * @throws  View_Exception
     * @uses    View::capture
     */
    public function render( $file=NULL )
    {
        if( $file !== NULL )
        {
            $this->set_filename( $file );
        }

        if( empty( $this->_file ) )
        {
            throw new View_Exception( 'You must set the file to use within your view before rendering' );
        }
        // Combine local and global data and capture the output
        return self::capture( $this->_file, $this->_data );
    }






















    public static function place( $viewtype, $file, $identifier )
  	{
  		$in_html = Page::inhtml();
  		if( $in_html ) {
  			CustomCode::end();
  		}

  		Views::addToQueue( $viewtype, $file, $identifier );

  		if( $in_html ) {
  			CustomCode::start();
  		}
  	}

    public static function cplace( $viewtype, $file, $identifier )
  	{

  		$in_html = Page::inhtml();
  		if( $in_html ) {
  			CustomCode::end();
  		}

  		Views::addToQueue( "Custom/" . $viewtype, $file, $identifier );

  		if( $in_html ) {
  			CustomCode::start();
  		}
  	}

    public static function setInContainer( $viewtype, $file, $identifier )
  	{
  		Info::add( $viewtype, 'viewtype', $identifier );
  		Info::add( $file, 'file', $identifier );
  		Info::add( $identifier, 'identifier', $identifier );

  		Views::addEditableParts( $identifier );
  		// return Ad::make( $file, $identifier );
      return Views::makeView( $file, $identifier, strtolower($viewtype) );
    }

    public static function getLink($identifier, $dict=null)
    {
        if($dict == null) {
            $dict = Data::get($identifier);
        }
        $viewoptions = Options::get($identifier);

        $link = Data::getValue($dict, "slug", $identifier);
        if ($link == "") {
            $link = Data::getValue($dict, "link", $identifier);
        }
        if ($link == "") {
            $link = Data::getValue($dict, "link_path", $identifier);
        }
        if ($link == "") {
            $link = Data::getValue($dict, "linkpath", $identifier);
        }

        return $link;
    }

    public static function getPreLink($identifier, $dict=null)
    {
        if($dict == null) {
            $dict = Data::get($identifier);
        }
        $viewoptions = Options::get($identifier);

        $pre_link = Data::getValue($viewoptions, "pre_slug");
        if ($pre_link == "") {
            $pre_link = Data::getValue($viewoptions, "pre_link");
        }

        return $pre_link;
    }

    public static function getFullLink($identifier, $dict=null)
    {
        if($dict == null) {
            $dict = Data::get($identifier);
        }

        $pre_link = View::getPreLink($identifier, $dict);
        $link = View::getLink($identifier, $dict);

        $full_link = $pre_link . $link;
        if ($full_link == "") {
            $full_link = "#";
        }

        return $full_link;
    }

    public static function getDescription($identifier, $dict=null)
    {
        if($dict == null) {
            $dict = Data::get($identifier);
        }
        $viewoptions = Options::get($identifier);

        $description = Data::getValue($dict, "html_text", $identifier);
        if ($description == "") {
            $description = Data::getValue($dict, "description", $identifier);
        }

        return $description;
    }

    public static function start($file, $identifier)
    {
        $vars = Views::prepare($file, $identifier);

        ob_start();
        Views::setContainerClass($file, $identifier);
        $output = ob_get_contents();
        ob_end_clean();

        echo "<div class=\"" . $output . "\">";

        ob_start();
        return $vars;
    }

    public static function end($viewdict, $viewoptions, $identifier, $file, $editable=false)
    {

        $output = ob_get_contents();
        ob_end_clean();

        $code = "";

        extract(Convert::viewParamsToVars($identifier));
        foreach ($viewvalues as $key => $value) {

            $new_output = View::replaceReusableViews($output, $key, $value, $identifier);

            $pre_link = "";
            $post_link = "";
            if( Data::getValue($value, "linkpath", $identifier) != "#" || Data::getValue($value, "linkpath", $identifier) != "" ) {
                $pre_link = "<a href=".Data::getValue($value, "linkpath", $identifier)." style=\"text-decoration: none\">";
                $post_link = "</a>";
            }

            $code .= $pre_link . $new_output . $post_link;
        }

        $code .= "</div>";

        if ($editable) {
            ob_start();
            Editing::clickToEditSection($viewdict, $viewoptions, $identifier, $file);
            $code .= ob_get_contents();
            ob_end_clean();
        }

        return $code;
    }

    public static function searchForReusableValues($output)
    {

        preg_match_all('/\\{\\{(.*)\\}\\}/sU', $output, $reusable_values);
        $reusable_values = $reusable_values[0];

		return $reusable_values;

    }

    public static function replaceReusableViews($output, $index, $dict, $identifier)
    {
        $reusable_values = View::searchForReusableValues($output);

        foreach ($reusable_values as $reusable_value) {

            // Trim and remove brackets to find the value key
            $value_key = str_replace("{{", "", $reusable_value);
            $value_key = str_replace("}}", "", $value_key);
            $value_key = trim($value_key, " ");

            if ($value_key == "container") {
                $output = str_replace($reusable_value, Info::file_name($identifier) . " inner index_".$index." clicktoedit", $output);
            } else if ($value_key == "index") {
                $output = str_replace($reusable_value, $index, $output);
            } else if ($value_key == "links") {

                $viewoptions = Options::get($identifier);

                // Get the links
                $links = Data::getValue($viewoptions, "links");

                $links_html = "";

                // Generate html for links
                if( $links != "" ) {
                    $links_html = "<div class=\"imagetext_inside links\">";
                        foreach ($links as $link_key => $link_value) {
                            $links_html .= "<a class=\"".Info::file_name($identifier)." link\" href=\"".$link_value."\">".$link_key."</a>";
                        }
                    $links_html .= "</div>";
                }

                $output = str_replace($reusable_value, $links_html, $output);
            } else {

              if( $value_key == "description" ) {
                $description = Data::getValue( $dict, $value_key, $identifier );
                if( $description == "" ) {
                  $description = Data::getValue( $dict, "html_text", $identifier );
                }
                $output = str_replace($reusable_value, $description, $output);
              } else {

                $output = str_replace($reusable_value, Data::getValue( $dict, $value_key, $identifier ), $output);
              }
            }
        }

        return $output;

    }


}
