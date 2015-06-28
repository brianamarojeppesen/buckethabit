<?=validation_errors(); ?>
<?=form_open('faqs/answer') ?>

<input type="hidden" name="id" value="<?=$faq['id']; ?>" />

<label for="question">Question</label>
<textarea name="question"><?=$faq['question']; ?></textarea>
<br/>

<label for="answer">Answer</label>
<textarea name="answer"><?=$faq['answer']; ?></textarea>
<br/>

<input type="checkbox" name="live"<?php
     if ($faq['live']) {
          echo ' checked="checked"';
} ?> />

<input type="submit" name="submit" value="Answer question" />

</form>
