<tr>
    <th>논문심사표<br/>Attached Review File</th>
    <td>
        <input type="file" name="review_file" id="review_file" style="width:100%;" required/>
        <div style="padding-top:5px;">
            <?php if ($data['step'] == '4'):?>
                <a href="<?=$info['review_form_url1']?>" class="btn btn-default">
                    <span class="glyphicon glyphicon-paperclip"></span> 1차 심사의견서
                </a>
            <?php elseif ($data['step'] == '14'):?>
                <a href="<?=$info['review_form_url2']?>" class="btn btn-default">
                    <span class="glyphicon glyphicon-paperclip"></span> 2차 심사의견서
                </a>
            <?php elseif ($data['step'] == '24'):?>
                <a href="<?=$info['review_form_url3']?>" class="btn btn-default">
                    <span class="glyphicon glyphicon-paperclip"></span> 3차 심사의견서
                </a>
            <?php endif ?>
        </div>
    </td>
</tr>
