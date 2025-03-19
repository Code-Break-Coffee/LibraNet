<?php
/**
 * Get a base path
 * @param string $path
 * @return string
 */

function basePath($path="")
{
    $bp = __DIR__."/".$path;
    if(file_exists($bp)) return $bp;
    else echo "Path $path does not exist";
}

/**
 * Require a file
 * @param string $name
 * @param array $data
 * @return void
 */

function load($name,$data=[])
{
    $vp = basePath("App/Views/{$name}.view.php");
    if(file_exists($vp))
    {
        extract($data);
        require_once $vp;
    }
    else echo "View Path $name does not exist";
}

/**
 * Require a component
 * @param string $name
 * @param array $data
 * @return void
 */

function loadComponent($name,$data=[])
{
    $cp = basePath("App/Views/Components/{$name}.component.php");
    if(file_exists($cp))
    {
        extract($data);
        require_once $cp;
    }
    else echo "Component Path $name does not exist";
}

/**
 * Inspect
 * @param mixed $value
 * @return void
 */

function inspect($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
}

/**
 * Inspect and Die
 * @param mixed $value
 * @return void
 */

function inspectDie($value)
{
    echo "<pre>";
    var_dump($value);
    echo "</pre>";
    die();
}

/**
 * Redirect with Query Parameters
 *
 * @param string $url
 * @param array $data
 * @return void
 */
function redirect($url, $data = [])
{
    if (!empty($data))
    {
        $queryString = http_build_query($data);
        $url .= '?' . $queryString;
    }
    
    header("Location: $url");
    exit;
}