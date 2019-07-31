<table class="boardType01_write" style="margin-top:20px;">
    <tr>
        <th width="200">원고 종류<br/>Article type</th>
        <td><? if($data['manuscript']){ ?><?=get_manuscript($data['manuscript'])?><? } ?></td>
    </tr>
    <?php foreach($info['file_arr'] as $v):?>
        <tr>
            <?php if($hidden_author != TRUE || $v['review_open'] == TRUE):?>
                <th>
                    <?=$v['title']?><br/><?=$v['eng_title']?>
                </th>
                <td>
                    <?php if($data[$v['name']]):?>
                        <?=end(explode("/",substr(strstr($data[$v['name']], '^'), 1)))?>
                        <a href="/down.php?link=<?=$data[$v['name']]?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
                    <?php else:?>
                        <i>미제출</i>
                    <?php endif?>
                </td>
            <?php endif?>
        </tr>
    <?php endforeach?>
    <tr>
        <th width="150"><strong>심사대상 논문파일<br/>Modified Paper File</strong></th>
        <td>
            <? if($data['modify_file']){ ?>
            <?=end(explode("/",substr(strstr($data['modify_file'], '^'), 1)))?>
            <a href="/down.php?link=<?=$data['modify_file']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
            <? } ?>
        </td>
    </tr>
    <?php /*if($data['step']>10 && $data['response_data']):?>
        <tr>
            <th>논문수정표<br/>Author's Edit Table</th>
            <td>
                <?=end(explode("/",substr(strstr($data['response_data'], '^'), 1)))?> <a href="/down.php?link=<?=$data['response_data']?>"><img src="../images/btn_download.png"  align="absmiddle" /></a>
            </td>
        </tr>
    <?php endif*/?>
</table>
