<?
	// 한글
	
	function getMovie($loc, $file)
	{
		$filePath = $loc.'/'.$file;
		$fp = fopen($filePath, 'r');
		
		if ($fp)
		{
			$read = fread($fp, filesize($filePath));
			$reads = explode("\r\n", $read);
			
			if (count($reads) < 5)
			{
				return NULL;
			}
			else
			{
				$sTitle = $reads[0];
				$title = $reads[1];
				$code = $reads[2];
				$url = $reads[3];
				$color = $reads[4];
				
				return array(
					'sTitle' => $sTitle,
					'title' => $title,
					'code' => $code,
					'url' => $url,
					'file' => $file,
					'color' => $color
				);
			}
		}
		else
		{
			return NULL;
		}
	}
	
	function getMovies($loc, $count = 99999, $offset = 0)
	{
		$files = array();
		if ($handle = opendir($loc))
		{
			while (false !== ($file = readdir($handle)))
			{
				if ($file != "." && $file != "..")
				{
					$files[] = $file;
				}
			}
			closedir($handle);
		}
		
		$files = array_reverse($files);
		$output = array();
		
		$itemCount = 0;
		foreach ($files as $file)
		{
			if ($offset > $count) continue;
			if ($itemCount >= $count) break;
			
			$result = getMovie($loc, $file);
			
			if ($result !== NULL)
			{
				$output[] = $result;
				$itemCount++;
			}
		}
		
		return $output;
	}
?>