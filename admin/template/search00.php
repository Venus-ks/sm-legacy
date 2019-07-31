<?php
### SEARCH
if($_GET['sdate'] || $_GET['edate']){
	if($_GET['sdate'] && $_GET['edate']){
		$where .= " AND regdate >= '{$_GET['sdate']}' AND regdate <= '{$_GET['edate']}' ";
	}else if($_GET['sdate'] && !$_GET['edate']){
		$where .= " AND regdate >= '{$_GET['sdate']}' ";
	}else if(!$_GET['sdate'] && $_GET['edate']){
		$where .= " AND regdate <= '{$_GET['edate']}' ";
	}
}
###
if($_GET['sc_cate']=='category' && $_GET['category']){
	$where .= " AND review_category = '{$_GET['category']}' ";
}
if($_GET['sc_cate']=='journal' && $_GET['journal']){
	$where .= " AND journal = '{$_GET['journal']}' ";
}
if($_GET['sc_cate']=='title' && $_GET['sc_text']){
	$where .= " AND title  like '%{$_GET['sc_text']}%' ";
}
if($_GET['sc_cate']=='name' && $_GET['sc_text']){
	$where .= " AND mb_name  like '%{$_GET['sc_text']}%' ";
}
###
?>
<!-- ### SEARCH -->
<form name="form1">
<table width="800" border="0" cellspacing="0" cellpadding="0">
<tr>
    <td width="280">
        <input type="text" name="sdate" id="sdate" style="width:100px;" value="<?=$_GET['sdate']?>"/><a href="javascript:win_calendar('sdate', document.getElementById('sdate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
        &nbsp;
        <input type="text" name="edate" id="edate"  style="width:100px;" value="<?=$_GET['edate']?>"/><a href="javascript:win_calendar('edate', document.getElementById('edate').value, '');"><img src="../images/icon_cal.png" align="middle" /></a>
    </td>
    <td align="left">
        <select name="sc_cate" id="sc_cate" style="width:100px;line-height:21px;" onchange="cateChk(this);">
            <option value="">= Select =</option>
            <option value="category" <? if($_GET['sc_cate']=='category'){ ?>selected<? } ?>>Category</option>
            <option value="title" <? if($_GET['sc_cate']=='title'){ ?>selected<? } ?>>Title</option>
            <option value="name" <? if($_GET['sc_cate']=='name'){ ?>selected<? } ?>>Author</option>
        </select>
        <select name="journal" id="journal" style="width:100px;height:24px;line-height:21px;display:none;">
            <option value="">= 선택 =</option>
            <?
            $jloop = get_journal_list();
            for($i=0;$i<count($jloop);$i++){
            ?>
                <option value="<?=$jloop[$i]['title']?>" <?if($_GET['journal']==$jloop[$i]['title']){?>selected<?}?>><?=$jloop[$i]['title']?></option>
            <?
            }
            ?>
        </select>
        <select name="category" id="category" style="width:100px;height:24px;line-height:21px;display:none;">
            <option value="">= 선택 =</option>
            <?
                $categories = get_category();
                for($i=0;$i<count($categories);$i++){
            ?>
                <option value="<?=$categories[$i]['cvalue']?>"  <? if($_GET['category']==$categories[$i]['cvalue']){ ?>selected<? } ?>><?=$categories[$i]['ctext']?></option>
            <?
                }
            ?>
        </select>
        <input type="text" name="sc_text" id="sc_text" value="<?=$_GET['sc_text']?>"/>
        <input type="image" src="../images/btn_search.png" align="absmiddle" style="border:0px;"/></td>
</tr>
<tr>
    <td height="32">&nbsp;</td>
</tr>

</table>
</form>
<script>
function cateChk(obj){
	if(obj.value == 'journal'){
		$("#journal").show();
		$("#category").hide();
		$("#sc_text").hide();
	}else if(obj.value =='category'){
		$("#journal").hide();
		$("#category").show();
		$("#sc_text").hide();
	}else{
		$("#journal").hide();
		$("#category").hide();
		$("#sc_text").show();
	}
}
<? if($_GET['sc_cate']=='journal'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
<? if($_GET['sc_cate']=='category'){ ?>
cateChk(document.form1.sc_cate);
<? } ?>
</script>
