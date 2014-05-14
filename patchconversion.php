<form name="frm" action="patchconversion.php?ac=upload" method="post" enctype='multipart/form-data'><br />
	<h2 align="center">Batch File Conversion</h2>
	<table align="center">
	<tr><td>Sourch </td><td><input type="text" name="source" size="100"><br/></td></tr>
	<tr><td>Destination</td><td><input type="text" name="destination" size="100"><br/></td></tr>
	<tr><td>File</td><td><textarea  rows="15" cols="76" name="ffile"></textarea><br/></td></tr>
	<tr><td>Path </td><td><input type="text" name="path" size="100"><br/></td></tr>
	<tr align="center"><td colspan="2" ><input align='middle' name='import' type='submit' id='submit' value='Upload' /></td></tr>
	</table>
</form>

<?php
if($_GET['ac']=='upload')
{
	error_reporting(0);
	$userDoc = $_POST['ffile'];
	$text =$userDoc;
	$srcDir1=  $_POST['source'];
	$destDir1=  $_POST['destination'];
	$path=  $_POST['path'];
	foreach(preg_split("/(\r?\n)/", $text ) as $line){
		$path_parts = pathinfo($line);
		$dir=$path_parts['dirname'];
		//$length=strlen($path_parts['dirname']);
		$dir1=str_replace($path, '/', $path_parts['dirname']);
		$files= $path_parts['filename']."<br/>";
		$dirname=str_replace('/', '\\', $dir1);
		$pathname=str_replace('/', '\\', $path);
		$paths = substr($pathname, 0, -1);
		$srcDir= $srcDir1;
		$destDir=  $destDir1;
		if (file_exists($destDir)) { 
			$srcDir = $srcDir1.$dirname;
			$destDir = $destDir1.$dirname;
			if(file_exists($destDir))
			{
				$files= $path_parts['basename'];
				  if (is_dir($destDir)) {
					if (is_writable($destDir)) {
					  if ($handle = opendir($srcDir)) {
						  if (is_file($srcDir . '/' . $files)) {
							copy($srcDir . '/' . $files, $destDir . '/' . $files);	
							$srcslash=str_replace('\\\\', '\\', $srcDir);
							$destslash=str_replace('\\\\', '\\', $destDir);
							echo "<h4>File copied from ".$srcslash . '\\' . $files." -> ".$destslash . '\\' . $files."<br/></h4>";					
						  }
						closedir($handle);
					  } else {
						echo "<h4>$srcDir could not be opened.</h4>";
					  }
					} else {
					  echo "<h4>$destDir is not writable!</h4>";
					}
				  } else {
					echo "<h4>$destDir is not a directory!</h4>";
				  }
			}
			else
			{
				if ($dirname!=$paths){
					mkdir($destDir, 0, true);
					$files= $path_parts['basename'];
					if (file_exists($destDir)) {
					  if (is_dir($destDir)) {
						if (is_writable($destDir)) {
						  if ($handle = opendir($srcDir)) {
							  if (is_file($srcDir . '/' . $files)) {
								copy($srcDir . '/' . $files, $destDir . '/' . $files);
								$srcslash=str_replace('\\\\', '\\', $srcDir);
								$destslash=str_replace('\\\\', '\\', $destDir);
								echo "<h4>File copied from ".$srcslash . '\\' . $files." -> ".$destslash . '\\' . $files."<br/></h4>";	
							  }			
							closedir($handle);
						  } else {
							echo "<h4>$srcDir could not be opened.</h4>";
						  }
						} else {
						  echo "<h4>$destDir is not writable!</h4>";
						}
					  } else {
						echo "<h4>$destDir is not a directory!</h4>";
					  }
					} else {
					  echo "<h3>Directory does not exist\n</h3>";
					}
				}
				else
				{
					$srcDir = $srcDir1;
					$destDir = $destDir1;
					$files= $path_parts['basename'];
					if (file_exists($destDir)) {
					  if (is_dir($destDir)) {
						if (is_writable($destDir)) {
						  if ($handle = opendir($srcDir)) {
							  if (is_file($srcDir . '/' . $files)) {
								copy($srcDir . '/' . $files, $destDir . '/' . $files);
								$srcslash=str_replace('\\\\', '\\', $srcDir);
								$destslash=str_replace('\\\\', '\\', $destDir);
								echo "<h4>File copied from ".$srcslash . '\\' . $files." -> ".$destslash . '\\' . $files."<br/></h4>";	
							  }			
							closedir($handle);
						  } else {
							echo "<h4>$srcDir could not be opened.</h4>";
						  }
						} else {
						  echo "<h4>$destDir is not writable!</h4>";
						}
					  } else {
						echo "<h4>$destDir is not a directory!</h4>";
					  }
					} else {
					  echo "<h3>Directory does not exist\n</h3>";
					}
				}
			}
		} 
		else { 
		 	echo "<h4>Destination Directory does not Exist<br/>";
		}
	}
}
?>