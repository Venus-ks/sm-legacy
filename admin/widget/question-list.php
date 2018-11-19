<tr>
    <th width="100"><strong><?=($data['step']>=10)?'2차':'1차'?> 심사결과<br/>Result</strong></th>
    <td style="border-bottom:1px solid #EEE;min-width: 500px;">
        <?php
        $sql	= "SELECT * FROM `ad_check_review` ORDER BY id ";
        $chklist = sql_query($sql);
        ?>
        <ul style="list-style:none;font-size:1em;padding-left:5px">
        <?php while ($row = sql_fetch_array($chklist)):?>
        <?php if($chk_tmp!=$row['title']):?>
        <h3><?=$row['title']?></h3>
        <?php endif?>
        <?php $chk_tmp=$row['title'];?>
        <li>
            <div style="padding:5px;background-color:#EEE"><?=$row['content']?></div>
            <div style="text-align:right;line-height:10px;padding:5px 0">
                <label for="q<?=$row['id']?>-sogood">
                    <input type="radio"name="q<?=$row['id']?>" id="q<?=$row['id']?>-sogood" value="5" required>
                    아주 적절&nbsp;&nbsp;&nbsp;
                </label>
                <label for="q<?=$row['id']?>-good">
                    <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-good" value="4" required>
                    적절&nbsp;&nbsp;&nbsp;
                </label>
                <label for="q<?=$row['id']?>">
                    <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>" value="3" required>
                    보통&nbsp;&nbsp;&nbsp;
                </label>
                <label for="q<?=$row['id']?>-bad">
                    <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-bad" value="2" required>
                    부적절&nbsp;&nbsp;&nbsp;
                </label>
                <label for="q<?=$row['id']?>-sobad">
                    <input type="radio" name="q<?=$row['id']?>" id="q<?=$row['id']?>-sobad" value="1" required>
                    아주 부적절&nbsp;&nbsp;&nbsp;
                </label>
            </div>
        </li>
        <?php endwhile?>
        </ul>
    </td>
</tr>
