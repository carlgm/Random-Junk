<?php
/*
Copyright (c) 2010 Carl Goodwin-Morgan

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/

# Allow debug and/or showing of source via $_GET
$debug = false;
$show_source = false;

// Show source for anyone who wants to see
if ($_GET['show_source'] && $show_source == true) {
	show_source($_SERVER['SCRIPT_FILENAME']);
	exit;
}

# Get Stake
if ( $_GET['stake'] ) {
  switch ($_GET['stake']) {
    case 'WC2014':
      $teams = array(); # Put teams in here
      $players = array(); # Put players in here
      break;
    default:
      die("Unknown Stake");
      break;
  }
} else {
  echo "Error: You must define which Stake this is for.";
  exit;
}

# Make numbers and saved results arrays and then count players so we know the maximum amount
$numbers = array();
$saved_results = array();
$total_players = count($players);
$total_teams = count($teams);

/* Sort Teams and Players in A->Z order doesn't work well with mix of upper and lowercase first letters.
   if adapting for unchecked list then need to sort through list and make sure first letter is capitalised */
asort($teams);
asort($players);

// Generate unique random numbers into $numbers array
if (!is_numeric($total_teams)) { 
	exit("Configuration error, couldn't find maxiumum random numbers to generate"); 
}
while (count($numbers) < $total_teams) {
		$finish_number = $total_teams-1;
 		$num = mt_rand(0,$finish_number);
		// Now lets add the number to the random number array list if it doesn't already exist
  		if (!in_array($num,$numbers)) {
  			$numbers[] = $num;
  		}
}

// Show amount of teams to display and players
echo "Teams: <b>".count($teams)."</b> and players <b>".count($players)."</b> <br />";

// For each player - assign a team and display
$count = 0;
foreach ($players as $player) {
        $corrected_aid = $numbers[$count];
        $player_team = $teams[$corrected_aid];
        if ($_GET['debug'] && $debug==true) { 
		echo "Count: $count | UID: $corrected_aid - "; 
	}
        echo "<b>${player}</b> got team <b>${player_team}</b> <br />";
        #$saved_results[$player] = $player_team; // not used at the moment
        $count++;
}

?>
