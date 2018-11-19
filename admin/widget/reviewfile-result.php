<tr>
    <th>심사의견서 파일<br/>Attached Review File</th>
    <td>
    <? if($review[$i]['rfile']){ ?>
        <?=end(explode("/",substr(strstr($review[$i]['rfile'], '^'), 1)))?> <a href="/down.php?link=<?=$review[$i]['rfile']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
    <? } ?>
    </td>
</tr>
