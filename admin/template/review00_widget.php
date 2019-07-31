<? if($review){ ?>
    <? for($i=0;$i<count($review);$i++){ ?>
        <table class="boardType01_write" style="margin-top:20px;">
            <tr>
                <th width="150"><strong>등록일</strong></th>
                <td><?=$review[$i]['regdate']?></td>
            </tr>
            <?php
            //설문형태 요구시
            //include('./widget/question-list-result.php')
            ?>
            <?php
            //코멘트형태 요구시
            //include('./widget/comment-result.php');
            ?>
            <?php
            //첨부형태 요구시
            include('./widget/reviewfile-result.php');
            ?>
            <tr>
                <th width="100"><strong>심사결과<br/>Result</strong></th>
                <td><?=get_result($review[$i]['result'])?></td>
            </tr>
        </table>
    <? } ?>
<? } ?>
<table class="boardType01_write" style="margin-top:20px;">
    <?php
    //설문형태 요구시
    //include('./widget/question-list.php');
    ?>
    <?php
    //코멘트형태 요구시
    //include('./widget/comment.php');
    ?>
    <?php
    //첨부형태 요구시
    include('./widget/reviewfile.php');
    ?>
    <tr>
        <th width="100"><strong>심사결과<br/>Result</strong></th>
        <td>
            <select name="result" style="width:100%;" required>
                <option value="">= Select =</option>
                <?
                if($data['step'] >= 10) $arr = get_result_2nd();
                else $arr = get_result();
                for($i=0;$i<count($arr);$i++){
                ?>
                <option value="<?=$arr[$i]['cvalue']?>"><?=$arr[$i]['ctext']?></option>
                <? } ?>
            </select>
        </td>
    </tr>
</table>
