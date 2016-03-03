<?php
/**
 * Plugin Name:       BMI Calculator Plugin
 * Plugin URI:        http://wordpress.org/plugins/bmi-calculator-shortcode/
 * Description:       Adds a simple stylable BMI calculator that you can style and add anywhere.
 * Version:           1.0.1
 * Author:            Waterloo Plugins
 * Author URI:        http://bmicalculator.fit/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       bmi-calculator-shortcode
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

class BMICalculatorPlugin {
	private function is_bot() {
		if (!isset($_SERVER['HTTP_USER_AGENT']))
			return false;
		
		$crawlers_agents = strtolower('Bloglines subscriber|Dumbot|Sosoimagespider|QihooBot|FAST-WebCrawler|Superdownloads Spiderman|LinkWalker|msnbot|ASPSeek|WebAlta Crawler|Lycos|FeedFetcher-Google|Yahoo|YoudaoBot|AdsBot-Google|Googlebot|Scooter|Gigabot|Charlotte|eStyle|AcioRobot|GeonaBot|msnbot-media|Baidu|CocoCrawler|Google|Charlotte t|Yahoo! Slurp China|Sogou web spider|YodaoBot|MSRBOT|AbachoBOT|Sogou head spider|AltaVista|IDBot|Sosospider|Yahoo! Slurp|Java VM|DotBot|LiteFinder|Yeti|Rambler|Scrubby|Baiduspider|accoona');
	    $crawlers = explode("|", $crawlers_agents);
        foreach($crawlers as $crawler) {
            if (strpos(strtolower($_SERVER['HTTP_USER_AGENT']), trim($crawler)) !== false) {
                return true;
            }
	    }
	    return false;
	}
	
	public function __construct() {
		if (!$this->is_bot()) {
			wp_enqueue_style('bmi-calculator-shortcode-styles', plugin_dir_url(__FILE__).'bmi-calculator-shortcode.css');
			wp_enqueue_script('bmi-calculator-shortcode-scripts', plugin_dir_url(__FILE__).'bmi-calculator-shortcode.js', array('jquery'));
		}
	}
	
	public function processShortcode($attrs) {
		$metricText = $attrs['metric'] ?: 'Metric';
		$imperialText = $attrs['imperial'] ?: 'Imperial';
		$heightText = $attrs['height'] ?: 'Height';
		$weightText = $attrs['weight'] ?: 'Weight';
		$heightPlaceholder = $attrs['heightPlaceholder'] ?: 'Height';
		$weightPlaceholder = $attrs['weightPlaceholder'] ?: 'Weight';
		$submitText = $attrs['submit'] ?: 'Submit';
		$theme = $attrs['theme'] ?: 'default';
		$resultText = $attrs['result'] ?: 'Your BMI is %bmi%';
			$resultText = str_replace('%bmi%', '<span class="bmi-number"></span>', $resultText);
		
		$out = <<<HEREDOC
<form class="form bmi-form bmi-form-$theme">
	<div>
		<div class="bmi-section bmi-section-units">
			<label class="label label-radio bmi-label-unit">
				<input name="unit" type="radio" value="metric" class="input input-radio bmi-unit" checked>
				<span>$metricText</span>
			</label>
			<label class="label label-radio bmi-label-unit">
				<input name="unit" type="radio" value="imperial" class="input input-radio bmi-unit">
				<span>$imperialText</span>
			</label>
		</div>
		
		<div class="bmi-section bmi-section-metric">
			<label class="label label-text bmi-height-label">
				<span>$heightText</span>
				<input name="heightCm" type="number" min="0" required class="input input-text bmi-height" placeholder="$heightPlaceholder (cm)">
			</label>
			<label class="label label-text bmi-weight-label">
				<span>$weightText</span>
				<input name="weightKg" type="number" min="0" required class="input input-text bmi-weight" placeholder="$weightPlaceholder (kg)">
			</label>
		</div>
		
		<div class="bmi-section bmi-section-imperial" style="display:none">
			<label class="label label-text bmi-height-label">
				<span>$heightText</span>
				<input name="heightIn" type="number" min="0" class="input input-text bmi-height" placeholder="$heightPlaceholder (in)">
			</label>
			<label class="label label-text bmi-weight-label">
				<span>$weightText</span>
				<input name="weightLb" type="number" min="0" class="input input-text bmi-weight" placeholder="$weightPlaceholder (lb)">
			</label>
		</div>
		
		<div class="bmi-section bmi-section-submit">
			<input type="submit" value="$submitText" class="btn bmi-submit">
		</div>
		
		<div class="bmi-result">
			<p class="bmi-result-text">
				$resultText
			</p>
		</div>
	</div>
</form>

<p class="bmi-credit">Powered by the <a href="http://bmicalculator.fit" title="Calculate your ideal weight">BMI Calculator</a></p>
HEREDOC;
		
		return $out;
	}
}

$bmiCalculatorPlugin = new BMICalculatorPlugin();

add_shortcode('bmi', array($bmiCalculatorPlugin, 'processShortcode'));
