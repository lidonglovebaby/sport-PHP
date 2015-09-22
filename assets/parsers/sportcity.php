
<?php
set_time_limit(0);
include 'parser/simple_html_dom.php';


$html = file_get_html('http://www.sportcity.com.mx/horario.asp?clubid=1');
$headers =array();
$a=0;
foreach($html->find('table[id=tablaH]') as $table) {
	foreach($table->find('th') as $th)
	{
		$headers[$a]=(string)$th->plaintext;
		$a=$a+1;
	}

	$clubid = array();
	$a=0;
	foreach($html->find('select[id=ClubHor]') as $select){
		foreach($select->find('option') as $option)
		{
			$clubid[$a]= $option->value;
			$a=$a+1;
		}

		foreach($clubid as $value) { 
			$link = "http://www.sportcity.com.mx/horario.asp?clubid=" . "$value" ;

			$html = file_get_html($link);

			if( $html) 
			{	
				$content = array();
				$i = 0;


				foreach($html->find('table[id=tablaH]') as $table) {
					foreach($table->find('tr') as $tr)
					{	
						$j =0;
						foreach($tr -> find('td') as $td)
						{    
							$td->plaintext = mb_ereg_replace('&nbsp;', '', $td->plaintext);
							$content[$i][$headers[$j]] =trim($td->plaintext);
							$j=$j+1;
						};
						$i=$i+1;		
					}

					print_r(json_encode($content));
					$name = 'sportcity_' . "$value";
					file_put_contents("data/$name.json", json_encode($content));
				}

			}
		}
	}
}
?>