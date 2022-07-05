<?php
class UploadFile 
{
	public function uploadByType($uploaded_file,$type)
	{
		$tmp_file  = $uploaded_file['tmp_name'];
		$filesize  = $uploaded_file['size'];
		$filename  = $uploaded_file['name'];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/u', '_', $filename);
		// $rfilename	= iconv("utf-8", "euc-kr", $filename);
		$rfilename = $filename;
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "../data/{$type}/".$rfilename;
		// $sfilename = iconv("euc-kr", "utf-8", $rfilename);
		$sfilename = $rfilename;
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($uploaded_file['error']);
		}
		return $sfilename;
	}

	public function uploadByTypeWithFilename($uploaded_file,$type)
	{
		$tmp_file  = $uploaded_file['tmp_name'];
		$filesize  = $uploaded_file['size'];
		$filename  = $uploaded_file['name'];
		$filename  = preg_replace('/[^a-zA-Z0-9가-힣.]/u', '_', $filename);
		// $rfilename	= iconv("UTF-8", "UTF-8", $filename);
		$rfilename = $filename;
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$dest_file = "../data/{$type}/".$rfilename;
		// $sfilename = iconv("UTF-8", "UTF-8", $rfilename);
		$sfilename = $rfilename;
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($uploaded_file['error']);
		}
		return $sfilename;
	}
	
	public function uploadByTypeWithBlind($uploaded_file,$type,$reviewfile_name)
	{
		$tmp_file  = $uploaded_file['tmp_name'];
		$filename  = $uploaded_file['name'];
		$rfilename	= $reviewfile_name.'_'.$type.'.'.pathinfo($filename)['extension'];
		//중복 파일 방지를 위해 타임스탬프를 붙인다.
		$dest_file = "../data/{$type}/".$rfilename;
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($uploaded_file['error']);
		}
		return $rfilename;
	}
}