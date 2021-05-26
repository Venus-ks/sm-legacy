<?php
class GoogleTemplateMailer extends PHPMailer
{
	// 프로퍼티 정의
    public $Host = "ssl://smtp.gmail.com"; // SMTP server
	public $Port = 465;
	public $SMTPAuth = true; // enable SMTP authentication
	public $Dbconn;
	public $seq;
	public $tp = array(); //템플릿 기본정보 셋팅용
	public $listMailInfo = array(); //발신 정보 셋팅용
    // 메서드 정의
    public function __construct()
	{
		$this->IsSMTP(); // telling the class to use SMTP
        $this->SMTPDebug = NULL;
	}
	public function sendTemplate($mailto, $step, $target, $result = NULL)
	{
		if(!$this->Dbconn) {
			echo $this->Dbconn->connect_error;
			return false;
		}
		$re = $this->Dbconn->query("SELECT * FROM `ad_mail_template` WHERE `result` = '{$result}' AND `step` = '{$step}' AND target = '{$target}'");
		$row = $re->fetch_object();
		//body 수정
		$title = preg_replace("/\\\/", "", $row->title);
		$body = preg_replace("/\\\/", "", $row->content);
		//키워드별 코드 교체
		foreach($this->tp as $k=>$v) {
			$src = '{{'.$k.'}}';
			$title = str_replace($src,$v,$title);
		}
		foreach($this->tp as $k=>$v) {
			$src = '{{'.$k.'}}';
			$body = str_replace($src,$v,$body);
		}
		$this->Subject = $title;
		$this->MsgHTML($body);
		$this->ClearAddresses();
		$this->AddAddress($mailto, $target);
		//발송
		if(!$this->Send())
		{
			$this->Dbconn->query("insert into ad_mail_log set
						parent_seq	= '{$this->seq}',
						mail_yn	= 'N',
						error_info	= '{$this->ErrorInfo}',
						address	= '{$mailto}',
						regdate	= now()");
		}
		else
		{
			$this->Dbconn->query("insert into ad_mail_log set
						parent_seq	= '{$this->seq}',
						mail_yn	= 'Y',
						address	= '{$mailto}',
						regdate = now()");
		}
	}
	public function addTemplate($mailto, $step, $target, $result = NULL)
	{
		$listMailInfo[] = array(
			'mailto'=>$mailto,
			'step'=>$step,
			'target'=>$target,
			'result'=>$result
		);
	}
	public function excuteSendTemplate()
	{
		if(!$this->Dbconn) {
			echo $this->Dbconn->connect_error;
			return false;
		}
		foreach($listMailInfo as $value)
		{
			if(!isset($value)) continue;
			$this->ClearAddresses();
			$re = $this->Dbconn->query("SELECT * FROM `ad_mail_template` WHERE `result` = '{$value->result}' AND `step` = '{$value->step}' AND target = '{$value->target}'");
			$row = $re->fetch_object();
			//body 수정
			$title = preg_replace("/\\\/", "", $row->title);
			$body = preg_replace("/\\\/", "", $row->content);
			//키워드별 코드 교체
			foreach($this->tp as $k=>$v) {
				$src = '{{'.$k.'}}';
				$title = str_replace($src,$v,$title);
			}
			foreach($this->tp as $k=>$v) {
				$src = '{{'.$k.'}}';
				$body = str_replace($src,$v,$body);
			}
			$this->Subject = $title;
			$this->MsgHTML($body);
			$this->AddAddress($value->mailto, $value->target);
			$this->Subject;
			$this->Body;
			//발송
			if(!$this->Send())
			{
				$this->Dbconn->query("insert into ad_mail_log set
							parent_seq	= '{$this->seq}',
							mail_yn	= 'N',
							error_info	= '{$this->ErrorInfo}',
							address	= '{$mailto}',
							regdate	= now()");
			}
			else
			{
				$this->Dbconn->query("insert into ad_mail_log set
							parent_seq	= '{$this->seq}',
							mail_yn	= 'Y',
							address	= '{$mailto}',
							regdate = now()");
			}
		}
		$listMailInfo = array();
	}
	public function sendInput($mailto, $nameto, $html, $subject=NULL)
	{
		if(empty($mailto)) $mailto = 'hjshyo@hakjisa.co.kr';
		if(isset($subject)) $this->Subject = $subject;
		else $this->Subject = "온라인투고시스템 진행 알림";
		$body = preg_replace("/\\\/", "", $html);
		$this->ClearAddresses();
		$this->MsgHTML($body);
		$this->AddAddress($mailto, $nameto);
		return $this->sendWithLog();
	}

	private function sendWithLog()
	{
		if(!$this->Send()) {
			$this->Dbconn->query("insert into ad_mail_log set
						parent_seq	= '{$this->seq}',
						mail_yn	= 'N',
						error_info	= '{$this->ErrorInfo}',
						address	= '{$mailto}',
						regdate	= now()");
			return false;
		}
		else {
			$this->Dbconn->query("insert into ad_mail_log set
						parent_seq	= '{$this->seq}',
						mail_yn	= 'Y',
						address	= '{$mailto}',
						regdate = now()");
			return true;
		}
	}
}
