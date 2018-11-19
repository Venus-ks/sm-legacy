<?php
class CustomSql extends mysqli
{
	public function countReviewsWhere($seq,$where)
	{
		$where = ($where)?"and {$where}":null;
		$sql = "select count(rseq) as cnt from ad_paper_review where parent_seq = '{$seq}' {$where}";
		$re = $this->query($sql);
		$row = $re->fetch_object();
		return $row->cnt;
	}
}