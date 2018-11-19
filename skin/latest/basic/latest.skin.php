<?
if (!defined("_GNUBOARD_")) exit; // 개별 페이지 접근 불가 
?>


<table width=100% cellpadding=0 cellspacing=0>
<? for ($i=0; $i<count($list); $i++) { ?>
<tr>
    <td colspan=4 align=center>
        <table width=95%>
        <tr>
            <td height=20 align="left"><img src='<?=$latest_skin_path?>/img/latest_icon.gif' align=absmiddle>
          <?
            echo $list[$i]['icon_reply'] . " ";
            echo "<a href='{$list[$i]['href']}'>";
            if ($list[$i]['is_notice'])
                echo "<font style='font-family:돋움; font-size:12px; color:#555555;'><strong>{$list[$i]['subject']}</strong></font>";
            else
                echo "<font style='font-family:돋움; font-size:12px; color:#555555;'>{$list[$i]['subject']}</font>";
            echo "</a>";

            if ($list[$i]['comment_cnt']) 
                echo " <a href=\"{$list[$i]['comment_href']}\"><span style='font-family:돋움; font-size:12px; color:#555555;'>{$list[$i]['comment_cnt']}</span></a>";

            // if ($list[$i]['link']['count']) { echo "[{$list[$i]['link']['count']}]"; }
            // if ($list[$i]['file']['count']) { echo "<{$list[$i]['file']['count']}>"; }

            echo " " . $list[$i]['icon_new'];
            
            echo " " . $list[$i]['icon_link'];
            echo " " . $list[$i]['icon_hot'];
            echo " " . $list[$i]['icon_secret'];
            ?></td></tr>
       
        </table></td>
</tr>
<? } ?>

<? if (count($list) == 0) { ?><tr><td colspan=4 align=center height=50><font color=#555555 style="font-size:12px;">게시물이 없습니다.</a></td></tr><? } ?>

</table>
