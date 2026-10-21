/**
 * Summit Information Display
 * Only show this on pages where there is a summit ID for that page.
 * Simple filter could also use a category filter
 */

// *********************************************************************************
// PRE-FETCH the area field value because it's an array and then display it
// *********************************************************************************

$area_value = get_field('area');

// Build array from the field value
$area_array = array();

// Check if the field has a value
if ($area_value) {
    // If it's already an array (like from a repeater or multiple select)
    if (is_array($area_value)) {
        $area_array = $area_value;
    }
    // If it's a string with comma-separated values
    elseif (is_string($area_value) && strpos($area_value, ',') !== false) {
        $area_array = array_map('trim', explode(',', $area_value));
    }
    // If it's a single value
    else {
        $area_array = array($area_value);
    }
}

// Only display if summit_id exists
if (get_field('summit_id')) {
    // ****************************************************
    //             END PRE-FETCH area array               *
    // ****************************************************
    
    // Table Header
    echo '<table style="border-collapse: collapse; width: 100%; border: 1px solid black;">';
    echo '<thead>';
    echo '<tr>';
    echo '<th style="border: 1px solid black; padding: 10px;" colspan="4">';
    echo '<b>Summit & Travel Info</b>';
    echo '</th>';
    echo '</tr>';
    echo '</thead>';
    
    // Table Body
    echo '<tbody class="bg-white divide-y border border-black">';
    
    // Row 1 - Summit ID, Name, Points
    echo '<tr>';
    
    echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Summit ID:</b> <a href="https://sotl.as/summits/'. get_field('summit_id') . '">' . get_field('summit_id');
    echo '</td>';
    
    echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Name:</b> <a href="https://sotl.as/summits/'. get_field('summit_id') . '">' . get_field('summit_name');
    echo '</td>';
    
    echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Points:</b> ' . get_field('points');
    echo '</td>';
    
    echo '</tr>';
    
    // Row 2 - Route Type, Distance, Elevation Gain
    echo '<tr>';
    
    echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Route Type:</b> ' . get_field('route_type');
    echo '</td>';
    
    echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Round Trip:</b> ' . get_field('route_miles') . ' mi.';
    echo '</td>';
    
    echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Gain:</b> ' . get_field('elevation_gain') . ' ft';
    echo '</td>';
    
    echo '</tr>';
    
    // Row 3 - Starting Point and Areas
    echo '<tr>';
    
    // Starting Point (spans 1 columns)
    echo '<td colspan="1" style="border: 1px solid black; padding: 10px;">';
    echo '<b>Starting point (lat/lon):</b> ';
    
    $starting_point = get_field('starting_point');
    if (!empty($starting_point)) {
        echo htmlspecialchars($starting_point);
    } else {
        echo "no starting point";
    }
    
    echo '</td>';
    
    // ***************************************************************************
    // **********   Display Area(s) from Array  *********************************
    // ***************************************************************************
    
    // Areas (spans 1 columns)
    echo '<td colspan="1" style="border: 1px solid black; padding: 10px;">';
    echo '<b>Area(s):</b> ';
    
    if (!empty($area_array)) {
        $area_count = count($area_array);
        
        foreach ($area_array as $index => $area) {
            echo htmlspecialchars($area);
            
            // Add comma if not the last item
            if ($index < $area_count - 1) {
                echo ', ';
            }
        }
        
        // Debug output (commented out)
        /*
        echo "<h3>Array Debug Info:</h3>\n";
        echo "<pre>";
        print_r($area_array);
        echo "</pre>";
        */
        
    } else {
        echo 'No areas found.';
    }
    echo '</td>';
	
    // ***************************************************************************
    // **********   Display Author username      *********************************
    // ***************************************************************************
	echo '<td style="border: 1px solid black; padding: 1px;">';
    echo '<b>Author:</b> ' . get_the_author_meta('user_login');
    echo '</td>';
    // ***************************************************************************
    echo '</tr>';
    
    // Close table
    echo '</tbody>';
    echo '</table>';
}

// Optional: Return the array for further use
return $area_array;