<?=validation_errors(); ?>
<?=form_open('faqs/create') ?>

<label for="question">Question</label>
<textarea name="question"></textarea>
<br/>

<input type="submit" name="submit" value="Ask a question" />

</form>
