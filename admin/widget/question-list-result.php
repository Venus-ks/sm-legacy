<tr>
    <th>심사수정표<br/>Review Table</th>
    <td>
    <? if($review[$i]['score']): ?>
        <ul style="list-style:none;font-size:1em;padding-left:5px">
            <?php
                $sq	= "SELECT * FROM `ad_check_review` ORDER BY id ";
                $chklist = sql_query($sq);
                $score_arr = explode('|',$k['score']);
                $j=0;
            ?>
            <?php while ($row = sql_fetch_array($chklist)):?>
                <?php $chk_tmp=$row['title'];?>
                <li>
                    <div style="padding:5px;background-color:#EEE"><?=$row['content']?></div>
                    <div style="text-align:right;line-height:10px;padding:5px 0">
                        <label for="q<?=$row['id']?>-sogood">
                            <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-sogood" value="5" <?=($score_arr[$j]==5)?'checked="checked"':''?>>
                            아주 적절&nbsp;&nbsp;&nbsp;
                        </label>
                        <label for="q<?=$row['id']?>-good">
                            <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-good" value="4" <?=($score_arr[$j]==4)?'checked="checked"':''?>>
                            적절&nbsp;&nbsp;&nbsp;
                        </label>
                        <label for="q<?=$row['id']?>">
                            <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>" value="3" <?=($score_arr[$j]==3)?'checked="checked"':''?>>
                            보통&nbsp;&nbsp;&nbsp;
                        </label>
                        <label for="q<?=$row['id']?>-bad">
                            <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-bad" value="2" <?=($score_arr[$j]==2)?'checked="checked"':''?>>
                            부적절&nbsp;&nbsp;&nbsp;
                        </label>
                        <label for="q<?=$row['id']?>-sobad">
                            <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-sobad" value="1" <?=($score_arr[$j]==1)?'checked="checked"':''?>>
                            아주 부적절&nbsp;&nbsp;&nbsp;
                        </label>
                    </div>
                </li>
                <?php $j++?>
            <?php endwhile?>
        </ul>
    <? endif ?>
    </td>
</tr>
