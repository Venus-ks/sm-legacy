<?php
class UploadFile 
{
	public function uploadByType($uploaded_file,$type)
	{
		$tmp_file  = $uploaded_file['tmp_name'];
		$filesize  = $uploaded_file['size'];
		$filename  = $uploaded_file['name'];
		$filename  = preg_replace('/(\s|\<|\>|\=|\(|\)|,)/', '_', $filename);
		$rfilename	= iconv("utf-8", "euc-kr", $filename);
		//�ߺ� ���� ������ ���� Ÿ�ӽ������� ���δ�.
		$mcrtime = explode(' ',microtime());
		$mcrtime[0] = substr($mcrtime[0],2,6);
		$rfilename = time().$mcrtime[0]."^".$rfilename;
		$dest_file = "../data/{$type}/".$rfilename;
		$sfilename = iconv("euc-kr", "utf-8", $rfilename);
		if (is_uploaded_file($tmp_file)){
			$error_code = move_uploaded_file($tmp_file, $dest_file) or die($uploaded_file['error']);
		}
		return $sfilename;
	}
}